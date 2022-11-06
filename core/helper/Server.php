<?php
declare(strict_types=1);

namespace core\helper;

class Server
{
    public static function getRequestUri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getRequestMethod() : string 
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}