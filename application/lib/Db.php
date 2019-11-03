<?php

namespace application\lib;
use PDO;
class Db
{
    protected $db;


    public function __construct()
    {
        $config = require_once "application/config/db.php";
        $this->db= new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}" ,$config['user'], $config['password']);



    }

    public function query($sql)
    {

       $query =  $this->db->query($sql);
        return $query;
        
    }

    public function row($sql)
    {
        $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function collum($sql)
    {
        $result = $this->query($sql)->fetchColumn();
        debug($result);
        return$result;
    }

}