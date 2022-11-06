<?php
declare(strict_types=1);

namespace core;

use core\helper\Server;
use core\helper\Config;
use core\helper\Session;
use core\router\Router;

class App
{
    public function __construct()
    {
        Config::load();
    }

    public function run()
    {
        $router = new Router(Config::router(), Server::getRequestUri(), Server::getRequestMethod(), Session::getUserRole());
        $router->run();
    }
}