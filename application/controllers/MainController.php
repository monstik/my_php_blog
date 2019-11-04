<?php


namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->Render("Главная страница");
    }

    public function aboutAction()
    {
        $this->view->Render("Обо мне");
    }

    public function contactAction()
    {
        $this->view->Render("Обратная связь");
    }

    public function postAction()
    {
        $this->view->Render("Посты");
    }
}