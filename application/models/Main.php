<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getPosts()
    {
        $data = $this->db->row('SELECT id, name, description FROM posts LIMIT 1, 20');
       return $data;
    }

}