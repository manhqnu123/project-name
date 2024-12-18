<?php 
setcookie("Email", "", time() -3600);
setcookie("pass", "", time() -3600);
header("Location:http://localhost:8080/pinterest/")
?>