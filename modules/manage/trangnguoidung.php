<?php
    require_once("./templates/navbar.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao diện người dùng</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #fff;
        color: #333;
    }

    .header {
        padding: 20px;
        text-align: center;
    }


    .profile-info {
        margin: 20px 0;
        text-align: center;
    }

    .profile-logo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .username {
        font-size: 24px;
        font-weight: bold;
        display: block;
        margin-top: 20px;
    }

    .followers {
        color: #777;
        font-size: 14px;
        margin-top: 5px;
    }

    .actions {
        margin: 20px 0;
    }

    .btn-profile {
        padding: 10px 20px;
        border: none;
        background-color: #ddd;
        border-radius: 20px;
        cursor: pointer;
        margin: 0 10px;
        font-weight: bold;
    }

    .tabs {
        display: flex;
        justify-content: center;
        margin: 40px 0;
        border-bottom: 2px solid #ddd;
    }

    .tab {
        padding: 10px 20px;
        cursor: pointer;
        margin: 0 10px;
        font-size: 16px;
        text-align: center;
    }

    .tab.active {
        border-bottom: 2px solid #000;
        font-weight: bold;
    }

    .tab-content {
        display: none;
        padding: 20px;
        text-align: center;
    }

    .tab-content.active {
        display: block;
    }
    </style>
</head>

<body>
    <?php
    // Thông tin kết nối cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'pinterest');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }	

    // Lấy thông tin người dùng
    $sql = "SELECT username, followers, avt FROM users LIMIT 1";
    $result = $conn->query($sql);

    $username = "Không có dữ liệu";
    $followers = "0";
    $image = "default.png";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $followers = $row['followers'];
        $image = $row['avt'];
    }

    $conn->close();
    ?>

    <div class="header">
        <div class="profile-info">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="Profile Image"
                class="profile-logo">
            <span class="username"><?php echo htmlspecialchars($username); ?></span>
            <span class="followers"><?php echo htmlspecialchars($followers); ?> followers</span>
        </div>

        <div class="actions">
            <button class="btn-profile">Chia sẻ</button>
            <a href="http://localhost:8080/pinterest/?module=user&action=Manage"><button
                    class="btn-profile">Chỉnh sửa hồ sơ</button></a>
        </div>

        <div class="tabs">
            <span class="tab active" data-tab="saved">Đã lưu</span>
            <span class="tab" data-tab="created">Đã tạo</span>
        </div>
    </div>

    <div class="tab-content active" id="saved">
        <h2>Đã lưu</h2>
        <p>Nội dung các ghim đã lưu sẽ hiển thị ở đây.</p>
    </div>

    <div class="tab-content" id="created">
        <h2>Đã tạo</h2>
        <p>Nội dung các ghim đã tạo sẽ hiển thị ở đây.</p>

        <!-- Ở đây bạn có thể hiển thị nội dung khác thay vì form tải ảnh -->
    </div>

    <script>
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Xóa lớp 'active' khỏi tất cả các tab và nội dung
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

            // Thêm lớp 'active' cho tab được chọn và nội dung tương ứng
            tab.classList.add('active');
            const target = tab.getAttribute('data-tab');
            document.getElementById(target).classList.add('active');
        });
    });
    </script>
</body>

</html>