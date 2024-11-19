<?php
    session_start();
    require_once("config.php");
    if(isset($_GET['module'])){
        if(is_string($_GET['module'])){
            $module = trim($_GET['module']);
        }
    }
    if(isset($_GET['action'])){
        if(is_string($_GET['action'])){
            $action = trim($_GET['action']);
        }
    }

    $path = "modules/". $module ."/". $action. ".php";
    if(file_exists($path)){
        require_once($path);
    }
?>