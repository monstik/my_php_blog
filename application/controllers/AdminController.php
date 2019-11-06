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

        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/add');
        }

        if (!empty($_POST)) {

            if ($this->model->loginValidation($_POST)) {
                $_SESSION['admin'] = true;
                $this->view->location('admin/add');
            } else {
                $this->view->message('Error', $this->model->error);
            }

        }

        $this->view->Render("Вход");
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->addPostValidation($_POST)) {

                $this->model->addPost($_POST);
                $this->view->message("Succes", "Пост успешно добавлен");

            } else {
                $this->view->message("Error", $this->model->error);
            }
        }


        $this->view->Render("добавить пост");

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
        unset($_SESSION['admin']);
        $this->view->redirect('');

    }
}