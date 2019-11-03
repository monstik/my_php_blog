<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{

    public function loginAction()
    {
        $this->view->Render("Страница входа");
    }

    public function registerAction()
    {
        $this->view->Render("Страница регистрации");
    }
}