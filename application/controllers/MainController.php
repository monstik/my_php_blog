<?php


namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class MainController extends Controller
{
    public function indexAction()
    {
        $pagination = new Pagination($this->route, $this->model->getCount());
        $vars = [
            'list' => $this->model->getPostList($this->route),
            'pagination' => $pagination->getPages(),
        ];
        $this->view->Render("Главная страница", $vars);
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