<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
function Debug($str)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
}