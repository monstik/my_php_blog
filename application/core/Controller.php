<?php


namespace application\core;

use application\models\Main;

abstract class Controller
{
    public $route;
    public $view;
    protected $acl;
    protected $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);

        if (!$this->checkAcl()) {
            View::errorPage(403);
        }

        $this->model = $this->loadModel($route['controller']);


    }

    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }

    }

    public function checkAcl()
    {
        $this->acl = require_once "application/acl/{$this->route['controller']}.php ";

        if ($this->isAcl('all')) {

            return true;
        } elseif (isset($_SESSION['admin'])  and $this->isAcl('admin')) {
            return true;
        }
        // if ($_SESSION['ad'])


    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl["$key"]);
    }


}