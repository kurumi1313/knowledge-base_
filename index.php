<?php
declare(strict_types=1);
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

function debug($v)
{
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
}

define("DIR", __DIR__);

require_once DIR . '/vendor/autoload.php';
require_once DIR . '/core/bootstrap.php';
