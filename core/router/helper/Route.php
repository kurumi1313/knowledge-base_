<?php
declare(strict_types=1);

namespace core\router\helper;

class Route
{
    public static function getRoutesByMethod(array $routes, string $method) : array
    {
        return (array_key_exists(mb_strtoupper($method), $routes)) ? $routes[$method] : [];
    }

    public static function checkParamsInRoute(string $route) : bool
    {
        return strpos($route, '{') !== false ? true : false;
    }

    public static function getParamsFromRoute(string $route) : array
    {
        $removeHooks = preg_split("/[{}]+/", $route);
        $removeSpaces = array_diff($removeHooks, array(""));

        return explode(':', $removeSpaces[1]);
    }
    
}