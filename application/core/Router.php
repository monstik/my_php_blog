<?php

namespace application\core;


class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require_once "application/config/routes.php";
        foreach ($arr as $route => $params) {
            $this->add($route, $params);
        }
    }

    public function add($route, $params)
    {
        $route = "#^" . $route . "$#";
        $this->routes[$route] = $params;
    }

    public function match()
    {
        foreach ($this->routes as $route => $params) {
            $url = trim($_SERVER['REQUEST_URI'], '/');

            if (preg_match("$route", "$url", $matches))
            {
              $this->params = $params;
              return true;
            }

        }
        return false;
    }

    public function run()
    {
       if ($this->match())
       {    $path = "application\controllers\\" . ucfirst($this->params['controller']) ."Controller";
           if(class_exists($path))
           {
               $action = "{$this->params['action']}Action";
               if (method_exists($path,$action))
               {
                   $controller = new $path($this->params);
                    $controller->$action();
               }
               else{
                   View::errorPage('404');
               }
           }
           else{
               View::errorPage('404');
           }
       }
       else{
           View::errorPage('404');
       }
    }
}