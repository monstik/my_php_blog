<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getPostList($route)
    {  	$max = 10;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function getCount()
    {
        return $this->db->collum("SELECT COUNT(*) FROM posts");
    }

}