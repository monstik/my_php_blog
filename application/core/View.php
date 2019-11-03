<?php


namespace application\core;


class View
{

    public $layout = 'default';
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function Render($title, $vars = [])
    {
        ob_start();
        require_once "application/views/{$this->route['controller']}/{$this->route['action']}.php";
        $content = ob_get_clean();
        require_once "application/views/layouts/{$this->layout}.php";


    }


}