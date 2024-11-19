<?php
    $host_name = "localhost";
    $user = "root";
    $password = "";
    $db_name = "pinterest";

    $connect = mysqli_connect($host_name, $user, $password, $db_name);
    if($connect){
        mysqli_query($connect, "SET NAMES 'utf8'");
    }
 ?>