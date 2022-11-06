<?php
declare(strict_types=1);

namespace core\error;

class Error
{
    public static function give(int $code = 404) : void
    {
        http_response_code($code);
        require DIR . '/core/error/errors/' . $code . '.php';
        exit();
    }
}