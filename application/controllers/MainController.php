<?php


namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

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
        if (!empty($_POST)) {
            if (!$this->model->contactValidation($_POST)) {
                $this->view->message('Error', $this->model->error);
            }
            $message = $_POST['name'] . '|' . $_POST['email'] . '|' . $_POST['text'];

                mail('d.krawets2026@gmail.com', 'Сообщение из блога', $message );
                $this->view->message('succes', 'Сообщение отправлено администратору');
        }

        $this->view->Render("Обратная связь");
    }

    public function postAction()
    {
        $adminModel = new Admin();
        if (!$adminModel->is_post_exist($this->route['page'])) {
            $this->view->errorPage(404);
        }
        $vars = [
            'data' => $this->model->getPost($this->route['page']),
        ];
        $this->view->Render("Посты", $vars);
    }
}