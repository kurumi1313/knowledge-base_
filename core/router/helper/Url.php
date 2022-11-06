<?php
declare(strict_types=1);

namespace core\router\helper;

class Url
{
    private static $params = [];

    public static function parseUrl(string $url, bool $flag = true) : array
    {
        $parsed_url = parse_url($url);

        if (!$flag) return $parsed_url;

        self::$params['query'] = self::getQueryParams((!empty($parsed_url['query'])) ? $parsed_url['query'] : "");   
        self::$params['path'] = $parsed_url['path'];

        return self::$params;
    }

    public static function getQueryParams(string $query) : array
    {
        parse_str($query, $result);

		return $result;
    }

    public static function getPathParams(array $data, string $url) : array 
    {
        $explodeUrl = self::explodeBySlash($url);
        $pathParams = [];

        foreach ($data as $index => $name)
        {
            $pathParams[$data[$index]] = $explodeUrl[$index];
        }

        return $pathParams;
    }

    public static function explodeBySlash(string $url) : array 
    {
        $explodedUrl = explode('/', $url);
        $explodedUrl[0] = '/';
        $explodedUrl = array_diff($explodedUrl, array(''));
        
        return $explodedUrl;
    }

    public static function collectUrl(array $elements) : string 
    {
        $url = '/';

		for ($i = 1; $i < count($elements); $i++) {
			$url .= ($i === 1) ? $elements[$i] : '/' . $elements[$i];
		}

		return $url;
    }
}