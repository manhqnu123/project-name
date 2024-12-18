<?php
    require_once("./database/connect.php");
    $email = $_COOKIE['Email'];
    $Pass = $_COOKIE["Pass"];
    $getSql = "select * from users where email = '$email' and password = '$Pass'";
    $run = mysqli_query($connect,$getSql);
    while($row = mysqli_fetch_array($run)){
        $idUser = $row['id'];
        $nameUser = $row['username'];
    }
    $idPicture = $_POST['id'];
    $text = $_POST['data'];
    $sql = "insert into comment(idUsers,content, idPicture) values ($idUser,'$text',$idPicture)";
    mysqli_query($connect,$sql);
 ?>