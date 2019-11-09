<?php


namespace application\controllers;


use application\core\Controller;
use application\lib\Pagination;
use application\models\Main;

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
            if ($this->model->addPostValidation($_POST, 'add')) {

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
        $mainModel = new Main;
        $pagination = new Pagination($this->route, $mainModel->getCount());
        $vars = [
            'list' => $mainModel->getPostList($this->route),
            'pagination' => $pagination->getPages(),
        ];
        $this->view->Render("Посты", $vars);
    }

    public function editAction()
    {
        if (!$this->model->is_post_exist($this->route['page'])) {
            $this->view->errorPage(404);
        }

        if (!empty($_POST)) {
            if (!$this->model->addPostValidation($_POST, 'edit')) {
                $this->view->message('Error', $this->model->error);
            } else {
                $this->model->editPost($_POST, $this->route['page']);
                $this->view->message('succes', 'Пост успешно отредактирован');
            }
        }
        $vars = [
            'data' => $this->model->postData($this->route['page'])[0],
        ];
        $this->view->Render("Редактировать пост", $vars);
    }

    public function deleteAction()
    {
        if (!$this->model->is_post_exist($this->route['page'])) {
            $this->view->errorPage(404);
        }

        $this->model->deletePost($this->view->route['page']);

        $this->view->redirect('admin/posts');
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('');

    }
}