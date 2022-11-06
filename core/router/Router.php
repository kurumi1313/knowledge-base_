<?php
declare(strict_types=1);

namespace core\router;

use core\router\helper\Route;
use core\router\helper\Url;
use core\error\Error;

class Router
{
    private $config = [];
    private $url    = "";
    private $method = "";  
    private $userRole = "";

    public function __construct(array $config, string $url, string $method, string $userRole)
    {
        $this->config = $config;
        $this->url    = $url;
        $this->method = $method;
        $this->userRole = $userRole;
    }

    public function run() : void
    {
        $result = $this->searchMatches();

        if (($this->userRole === "noauth"))
        {
            if ($result['isAdmin'] && $result['path'] !== '/admin/login' && $result['path'] !== '/admin/auth') $this->redirect('/admin/login');
            if (!$result['isAdmin'] && $result['path'] !== '/login' && $result['path'] !== '/login/auth') $this->redirect('/login');
        }

        if (!$this->checkUserRole($result)) 
        {
            Error::give(403);
        }

        $this->startController($result);
    }

    private function searchMatches() : array
    {
        // get routes by server method (POST, GET, PUT, UPDATE) : array
        $getRoutesByMethod = Route::getRoutesByMethod($this->config['routes'], $this->method);

        // if there are no routes then throws an error 404
        if (!$getRoutesByMethod) Error::give(404);

        // get elements of our parsed URL (path, query) : array
        $parsed_url = Url::parseUrl($this->url);

        foreach ($getRoutesByMethod as $route => $parameters)
        {
            if (!Route::checkParamsInRoute($route))
            {
                if (preg_match('#^' . $route . '$#', $parsed_url['path'])) return $this->createResult($parsed_url['path'], $parsed_url['query'], $parameters);
            }

            if (Route::checkParamsInRoute($route))
            {
                $data = [];
                $explodeRoute = Url::explodeBySlash($route);

                for ($i = 0; $i < count($explodeRoute); $i++)
                {
                    if ($explodeRoute[$i][0] === '{') 
                    {
                        $explodeParams = Route::getParamsFromRoute($explodeRoute[$i]);
                        $explodeRoute[$i] = $this->config['params'][$explodeParams[1]];
                        $data[$i] = $explodeParams[0];
                    }
                }

                $collectedRoute = Url::collectUrl($explodeRoute);

                if (preg_match('#^' . $collectedRoute . '$#', $parsed_url['path'])) 
                {
                    $paramsFromUrl = Url::getPathParams($data, $parsed_url['path']);

                    return $this->createResult($parsed_url['path'], $parsed_url['query'], $parameters, $paramsFromUrl);
                }

            }
        }

        return Error::give(404);
    }

    private function createResult(string $path, array $query, array $parameters, array $paramsFromUrl = []) : array
    {
        $result = [
            "url"           => $this->url,
            "method"        => $this->method,
            "path"          => $path,
            "parameters"    => $parameters,
            "queryParams"   => $query,
            "pathParams"    => $paramsFromUrl,
            "isApi"         => $this->isApi(Url::explodeBySlash($path)),
            "isAdmin"       => $this->isAdmin(Url::explodeBySlash($path)),
            "role"          => $this->config["role"],
        ];

        return $result;
    }

    private function startController(array $data) : void
    {
        list($class, $action) = explode(':', $data['parameters']['controller']);

        $classPath = '\\app\\controllers\\' . $class;

        if (class_exists($classPath)) 
        {
            $class = new $classPath($data);

            if (method_exists($class, $action))
            {
                $class->$action();
            } 
            else 
            {
                Error::give(404);
            }
        }
        else 
        {
            Error::give(404);
        }
    }

    private function checkUserRole(array $data)
    {
        $role = $data['parameters']['role'];

        if ($this->userRole === 'admin') return true;

        if (is_array($role)) 
        {
            foreach ($role as $value)
            {
                if ($this->userRole === $value) return true;
            }

            return false;
        }

        if (($role === 'all') && ($this->userRole !== "noauth")) return true;

        if ($this->userRole === $role) return true;
        
        return false;
    }

    private function isApi(array $path) : bool
    {
        if (array_key_exists(1, $path)) {
			if ($path[1] === 'api') {
				return true;
			}
		}

		return false;
    }

    private function isAdmin(array $path) : bool
    {
        if (array_key_exists(1, $path)) {
			if ($path[1] === 'admin') {
				return true;
			}
		}

		return false;
    }

    private function redirect(string $url)
    {
        header('Location: ' . $url);
        exit();
    }
}