<?php
    require_once("./database/connect.php");
    if(isset($_POST['login'])){
        $Email = $_POST['Email'];
        $Pass = $_POST['pass'];
        $sql = "select * from users where Email = '$Email' and password ='$Pass'";
        $run = mysqli_query($connect,$sql);
        $num = mysqli_num_rows($run);
        $errors = [];
        if($num == 1) {
            header("Location:http://localhost:8080/pinterest/");
            exit();
        }
        if($num != 1 && $Email != "" && $Pass !=""){
            $errors['wrong'] = "Sai Email hoặc mật khẩu";
        }
        if($Email == "" && $Pass == ""){
            $errors["emt"] = "Vui lòng nhập Email và mật khẩu";
         } 
        
        if($Email != "" && $Pass == ""){
            $errors["emt"] = "Vui lòng nhập mật khẩu";
        }
         if($Email == "" && $Pass != ""){
            $errors["emt"] = "Vui lòng nhập Email";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
.login-page {
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    position: relative;
    color: #B60000;
}

.login-page img {
    width: 70%;
    object-fit: cover;
}

.container {
    z-index: 999;
    position: absolute;
    top: 40%;
    left: 40%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border: 1px solid black;
    border-radius: 10px;
    padding: 40px;
    color: black;
}

.h5 {
    cursor: pointer;
}

.fb,
.gg,
.btn {
    width: 100%;
    outline: none;
    border: none;
    border-radius: 3px;
    height: 40px;
}

.fb {
    color: #fff !important;
    background-color: blue;
    margin-bottom: 10px;
}

.gg {
    color: black;
}

.ps-check {
    position: relative;
}

.fa-eye {
    position: absolute;
    top: 60%;
    right: 5%;
}

.nav {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0 40px;
    z-index: 999;
}

.nav .img img {
    width: 100px;
    object-fit: cover;
}

.nav .img {
    font-weight: 700;
    font-size: 1.6rem;
}

.nav-left,
.nav-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-left a,
.nav-right a {
    padding: 10px;
    font-weight: bold;
}

a {
    text-decoration: none;

}

.nav-right button {
    padding: 5px;
    border-radius: 20px;
    border: none;
}

.login {
    background-color: #E60026;
}

.login a {
    color: #fff !important;
}
</style>

<body>
    <div class="login-page">
        <div class="nav">
            <div class="nav-left">
                <div class="img">
                    <img src="./img/logopin.png" alt="">
                    Pinterest
                </div>
                <a href="">Today</a>
                <a href="">Watch</a>
                <a href="">Shop</a>
                <a href="">Explode</a>
            </div>
            <div class="nav-right">
                <a href="">About</a>
                <a href="">Business</a>
                <a href="">Blog</a>
                <button class="login"><a href="">Login</a></button>
                <button class=" sign-up"><a href="">Sign up</a></button>
            </div>
        </div>
        <img src="./img/z6031057825210_3f4ffb3e73e7986fb151f060fcc815b2.jpg">
        <form action="" method="post" class="container " style="width: 25%;margin-top: 5%;">
            <div class="mb-3">
                <label for="Email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="Email" name="Email"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3 ps-check">
                <label for="Password" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" name="pass">
                <i class="fa-solid fa-eye "></i>
            </div>
            <p class="h5">Quên mật khẩu?</p>
            <?php 
    echo !empty($errors["emt"])?'<p style="color:red;">'.$errors["emt"].'</p>' : ' ' ;
    echo !empty($errors["wrong"])?'<p style="color:red;">'.$errors["wrong"].'</p>' : ' ' ;
  ?>
            <button type="submit" class="btn btn-danger" name="login">Đăng nhập</button>
            <p class="text-center h5">Hoặc</p>
            <div> <button class="fb" name="facebook">Đăng nhập với Facebook</button></div>
            <div><button class="gg" name="google">Đăng nhập với Google</button></div>


        </form>
    </div>

</body>

</html>