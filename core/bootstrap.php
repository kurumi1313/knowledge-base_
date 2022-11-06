<?php
declare(strict_types=1);

namespace core;

try 
{
    $app = new App();
    $app->run();
} 
catch(\ErrorException $e) 
{
    exit($e->getMessage());
}