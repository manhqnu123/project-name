<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinterest</title>
    <link rel="stylesheet" href="./css/style.css?ver=<?php echo rand(); ?>">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <header class="nav">
        <div class="logo">
            <img src="./img/logopin.png" alt="" srcset=""
                style="width:50px; height:50px; object-fit: cover;">
            <a href="http://localhost:8080/pinterest/" style="text-decoration: none;">Trang chủ</a>
            <span class=" Upload">Tạo</span>
        </div>
        <div class="nav-search">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="search" name="search" id="search" placeholder="Tìm kiếm">
            <div class="nav-search--menu">
            </div>
        </div>
        <div class="nav-user">
            <i class="fa-solid fa-bell nav-user--item"></i>
            <i class="fa-solid fa-comment-dots nav-user--item"></i>
            <img src="https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-photo-700-205577532.jpg"
                alt="" srcset="" class="nav-user--item"
                style="width:50px; height:50px; object-fit: cover; border-radius:50%;">
            <i class="fa-solid fa-angle-down nav-user--item " id="dropdownMenuButton1"
                data-bs-toggle="dropdown"></i>
            <ul class=" dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Chuyển tài khoản</a></li>
                <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
            </ul>
        </div>
        </div>
    </header>
</body>
<script>
$(document).ready(function() {
    $(document).on('click', function(e) {
        var dropdown = $('.nav-search--menu');
        var searchInput = $('#search');
        // Kiểm tra nếu click không nằm trong dropdown và thanh tìm kiếm  
        if (!dropdown.is(e.target) && !searchInput.is(e.target) &&
            dropdown.has(e.target).length === 0) {
            dropdown.hide(); // Ẩn dropdown  
            searchInput.val("");
        }
    });
    $('#search').keydown(function(event) {
        if (event.keyCode === 13) { // Kiểm tra mã phím (Enter)  
            // Thực hiện hành động khi nhấn Enter  
            window.location.href = "#";
        }
    });
    $("#search").keyup(function(event) {
        $(".nav-search--menu").show();
        search();
    })


    function search() {
        var input_val = $("#search").val();
        $.post("http://localhost:8080/pinterest/asset/search.php", {
            data: input_val
        }, function(data) {
            $(".nav-search--menu").html(data);
        })
    }
});
</script>

</html>