<?php
declare(strict_types=1);

namespace core\helper;

class Session 
{
    public static function getUserRole() : string
    {
        return (!empty($_SESSION['userInfo']['role'])) ? $_SESSION['userInfo']['role'] : "noauth";
    }
}