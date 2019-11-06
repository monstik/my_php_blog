<?php

namespace application\models;

use application\core\Model;

class Admin extends Model
{
    public $error;

    public function loginValidation($post)
    {
        $config = require_once 'application/config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
            $this->error = "Логин или пароль указан неверно";
            return false;
        }
        return true;
    }

    public function addPostValidation($post)
    {
        if (strlen($post['name']) <= 5 or strlen($post['name']) >= 50) {
            $this->error = "Название должно иметь от 5 до 50 символов";
            return false;
        }
        if (strlen($post['description']) <= 10 or strlen($post['description']) >= 500) {
            $this->error = "описание должно иметь от 10 до 500 символов";
            return false;
        }
        if (strlen($post['text']) <= 10) {
            $this->error = "текс должнен иметь от 10 символов";
            return false;
        }
        if (empty($_FILES["img"]["name"])) {
            $this->error = "Вы забыли загрузить картинку";
            return false;
        }
        return true;

    }

    public function addPost($post)
    {
        $params= [
            'id' => '',
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text'],
        ];
        $this->db->query('INSERT INTO posts VALUES ( :id, :name, :description, :text)', $params);
        $this->uploadFile('img', $this->db->lastInserId());
    }

    public function uploadFile($name, $id)
    {
        if(is_uploaded_file($_FILES[$name]['tmp_name']))
        {
            $upload_dir = "public/materials/";
            move_uploaded_file($_FILES[$name]['tmp_name'], $upload_dir. $id . ".jpg");
        }
        else
        {
            $this->error = "невозможно загрузить файл";
        }
    }


}