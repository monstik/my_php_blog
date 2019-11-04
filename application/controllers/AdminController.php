<?php


namespace application\controllers;


use application\core\Controller;

class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }


    public function loginAction()
    {
        $this->view->Render("Вход");
    }

    public function addAction()
    {
        $this->view->Render("Добавить пост");
    }

    public function postsAction()
    {
        $this->view->Render("Посты");
    }

    public function editAction()
    {
        $this->view->Render("Редактировать пост");
    }

    public function logoutAction()
    {
        $this->view->redirect('/');

    }
}