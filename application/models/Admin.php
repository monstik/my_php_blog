<?php

namespace application\models;

use application\core\Model;

class Admin extends Model
{
    public $error;

    public function loginValidation($post)
    {
       $config = require_once 'application/config/admin.php';
       if($config['login'] != $post['login'] or $config['password'] != $post['password'])
       {
           $this->error = "Логин или пароль указан неверно";
           return false;
       }
        return true;
    }
}