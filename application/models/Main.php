<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public $error;

    public function getPostList($route)
    {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function contactValidation($post)
    {
        $nameL = iconv_strlen($post['name']);
        $textL = iconv_strlen($post['text']);

        if ($nameL < 3 or $nameL > 20)
        {
            $this->error = "Имя должно быть от 3 до 20 символов";
            return false;
        }
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->error = "Неправильно указан email";
            return false;
        }
        if ($textL <10 or $textL > 500)
        {
            $this->error = "Сообщение должно быть от 10 до 500 символов";
            return false;
        }

        return true;

    }


    public function getPost($id)
    {
        $params = [
            'id' => $id,
        ];

        return $this->db->row('SELECT * FROM posts WHERE id = :id', $params)[0];
    }


    public function getCount()
    {
        return $this->db->collum("SELECT COUNT(*) FROM posts");
    }

}