<?php
session_start();

$error_message = ""; // Biến chứa thông báo lỗi

$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Định nghĩa email và mật khẩu hợp lệ
    $valid_email = "user@example.com";
    $valid_password = "password123";

    // Kiểm tra các trường có bị để trống không
    if (empty($email) || empty($password) || empty($dob)) {
        $error_message = "Email hoặc mật khẩu không hợp lệ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Kiểm tra tính hợp lệ của email
        $error_message = "Email hoặc mật khẩu không hợp lệ";
    } elseif (strlen($password) < 8) {
        // Kiểm tra độ dài của mật khẩu
        $error_message = "Email hoặc mật khẩu không hợp lệ";
    } elseif ($email !== $valid_email || $password !== $valid_password) {
        // Kiểm tra email và mật khẩu hợp lệ
        $error_message = "";
    } else {
        // Nếu không có lỗi, tiến hành xử lý tiếp
        $_SESSION['user'] = $email;
        echo "<script>alert('Đăng nhập thành công!');</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body, html {
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
}

.container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: url('anhnen.png') no-repeat center / cover;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.91);
    z-index: 1;
}

.form-container {
    position: relative;
    background: rgba(255, 255, 255, 1);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 495px;
    width: 100%;
    margin: auto;
    display: flex;
    flex-direction: column; /* Sử dụng flex-direction: column */
    justify-content: space-between;
    height: 80vh;
    z-index: 2;
}

.close-btn {
    position: absolute;
    top: 8px;
    right: -78px;
    background-color: transparent;
    border: none;
    font-size: 40px;
    color: #ff0000;
    cursor: pointer;
    z-index: 3;
}

h2 {
    text-align: center;
    margin-bottom: 5px;
}

h3 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.1em;
}

label {
    display: block;
    margin-bottom: 5px;
}

.input-container {
    position: relative;
    margin-bottom: 15px;
}

.input-container ion-icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

.input-container ion-icon.left {
    left: 10px;
}

.input-container input {
    width: 100%;
    padding: 12px;
    padding-left: 40px;
    padding-right: 40px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Định dạng cho trường tạo mật khẩu */
.password-container {
    position: relative;
    margin-bottom: 15px; /* Giảm khoảng cách */
}

.password-input {
    width: 100%;
    padding: 12px;
    padding-left: 40px;
    padding-right: 40px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Định dạng cho biểu tượng con mắt */
.eye-icon {
    position: absolute;
    top: 50%;
    right: 44px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 15px;
    color: #007bff;
}

/* Cập nhật form container cho bố cục dọc */
form {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: flex-start;
}

/* Định dạng cho trường ngày sinh */
.date-container {
    margin-bottom: 30px; /* Khoảng cách dưới trường ngày sinh */
}

.date-container input {
    width: 100%;
    padding: 12px;
    padding-left: 40px;
    padding-right: 40px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button.continue-btn {
    width: 40%;
    padding: 10px;
    background-color: #ff0000;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    align-self: center;
    margin-top: 20px;
}

button.continue-btn:hover {
    background-color: #cc0000;
}

button.close-btn {
    position: absolute;
    top: 35px;
    right: 10px;
    background-color: transparent;
    border: none;
    font-size: 40px;
    color: #ff0000;
    cursor: pointer;
    z-index: 3;
}

button.close-btn:hover {
    color: #cc0000;
}
</style>
</head>
<body>
    <div class="container">
        <div class="overlay"></div>
        <div class="form-container">
            <button class="close-btn">&times;</button>
            <h2>Chào mừng đến với</h2>
            <h2>Doe</h2>
            <h3>Tìm ý tưởng mới để thử</h3>

            <!-- Form đăng ký -->
            <form id="registration-form" action="" method="post" onsubmit="return validateForm()">
                <!-- Trường Email -->
                <label for="email">Email</label>
                <div class="input-container">
                    <ion-icon name="mail-outline" class="left"></ion-icon>
                    <input type="text" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <!-- Trường Mật khẩu -->
                <label for="password">Mật khẩu</label>
                <div class="password-container">
                    <input type="password" id="password" class="password-input" name="password" placeholder="Tạo mật khẩu" value="<?php echo htmlspecialchars($password); ?>">
                    <i class="fas fa-eye eye-icon" id="toggle-password" onclick="togglePassword()"></i>
                </div>

                <!-- Trường Ngày sinh -->
                <label for="dob">Ngày sinh</label>
                <div class="input-container">
                    <ion-icon name="calendar-outline" class="left"></ion-icon>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
                </div>

                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if (!empty($error_message)): ?>
                    <div class="error-message">
                        <p><?php echo htmlspecialchars($error_message); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Nút Tiếp tục -->
                <button class="continue-btn" type="submit">Tiếp tục</button>
            </form>
        </div>
    </div>

    <script>
        // Hàm bật/tắt hiển thị mật khẩu
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Hàm kiểm tra form
        function validateForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const dob = document.getElementById('dob').value;
            const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
            let errorMessage = "";

            // Kiểm tra tất cả các trường có bị bỏ trống không
            if (email === "" && password === "" && dob === "") {
                errorMessage = "Email hoặc mật khẩu không hợp lệ.";
            } else {
                // Kiểm tra các trường riêng lẻ
                if (email === "" || password === "") {
                    errorMessage = "Email hoặc mật khẩu không hợp lệ.";
                } else if (dob === "") {
                    errorMessage = "Ngày sinh không được để trống.";
                } else if (!emailPattern.test(email)) {
                    // Kiểm tra tính hợp lệ của email
                    errorMessage = "Email hoặc mật khẩu không hợp lệ.";
                } else if (password.length < 8) {
                    // Kiểm tra độ dài của mật khẩu
                    errorMessage = "Email hoặc mật khẩu không hợp lệ.";
                }
            }

            // Nếu có lỗi, hiển thị thông báo lỗi và ngăn submit form
            if (errorMessage !== "") {
                alert(errorMessage);
                return false;
            }


        }
    </script>
</body>
</html>
