<?php
declare(strict_types=1);

namespace core\helper;

class Config
{
    private static $config;

    public static function load() : void
    {
        $loadConfig = file_get_contents(DIR . '/config/config.json');
        self::$config = json_decode($loadConfig, true);
    }

    public static function database() : array
    {
        return self::$config['database'];
    }

    public static function router() : array
    {
        return self::$config['router'];
    }

    public static function view() : array
    {
        return self::$config['view'];
    }
}