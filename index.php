<?php
use application\core\Router;
require_once "application/lib/Dev.php";
spl_autoload_register(function($class)
{
    $path = $class . ".php";
    if (file_exists($path))
    {
        require_once $path;
    }
});



$router = new Router();
$router->run();