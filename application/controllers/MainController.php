<?php


namespace application\controllers;

use application\lib\Db;
use application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {   $vars = [
        'name' => 'Dania',
        'age' => '19'
    ];
        $db = new Db();
        $db->collum('SELECT id FROM user WHERE name="Вася"');
        $this->view->Render("Главная страница", $vars);
    }
}