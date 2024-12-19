<?php

$servername = "localhost";
$username = "root";        
$password = "";          
$dbname = "pinterest";   

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

$error_message = "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($email) || empty($password) || empty($dob)) {
        $error_message = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email không hợp lệ.";
    } elseif (strlen($password) < 8) {
        $error_message = "Mật khẩu phải ít nhất 8 ký tự.";
    } else {

      $sql = "INSERT INTO users (email, password, dateofbirth) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $email, $password, $dob);

            if ($stmt->execute()) {
                echo "<script>alert('Đăng ký thành công!');</script>";
                $stmt->close();
                header("Location: http://localhost:8080/pinterest/?module=manage&action=login");
                exit();
            } else {
                $error_message = "Lỗi: Không thể lưu thông tin đăng ký.";
            }
        } else {
            $error_message = "Lỗi: Không thể chuẩn bị câu lệnh SQL.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/css/ionicons.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body,
    html {
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
        background: url('./img/overlay.jpg') no-repeat center / cover;
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
        flex-direction: column;
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
        font-weight: 300;
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

    .password-container {
        position: relative;
        margin-bottom: 15px;
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

    .eye-icon {
        position: absolute;
        top: 50%;
        right: 44px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 15px;
        color: #007bff;
    }

    form {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: flex-start;
    }

    .date-container {
        margin-bottom: 30px;
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
        border-radius: 25px;
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
                <label for="email">Email</label>
                <div class="input-container">
                    <ion-icon name="mail-outline" class="left"></ion-icon>
                    <input type="text" id="email" name="email" placeholder="Email"
                        value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <label for="password">Mật khẩu</label>
                <div class="password-container">
                    <input type="password" id="password" class="password-input" name="password"
                        placeholder="Tạo mật khẩu"
                        value="<?php echo htmlspecialchars($password); ?>">
                    <i class="fas fa-eye eye-icon" id="toggle-password"
                        onclick="togglePassword()"></i>
                </div>

                <label for="dob">Ngày sinh</label>
                <div class="input-container">
                    <ion-icon name="calendar-outline" class="left"></ion-icon>
                    <input type="date" id="dob" name="dob"
                        value="<?php echo htmlspecialchars($dob); ?>">
                </div>

                <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
                <?php endif; ?>

                <button class="continue-btn" type="submit">Tiếp tục</button>
            </form>
        </div>
    </div>

    <script>
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

    function validateForm() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const dob = document.getElementById('dob').value;
        const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        let errorMessage = "";

        if (email === "" && password === "" && dob === "") {
            errorMessage = "Email hoặc mật khẩu không hợp lệ.";
        } else {
            if (email === "" || password === "") {
                errorMessage = "Email hoặc mật khẩu không hợp lệ.";
            } else if (dob === "") {
                errorMessage = "Ngày sinh không được để trống.";
            } else if (!emailPattern.test(email)) {
                errorMessage = "Email hoặc mật khẩu không hợp lệ.";
            } else if (password.length < 8) {
                errorMessage = "Email hoặc mật khẩu không hợp lệ.";
            }
        }

        if (errorMessage !== "") {
            alert(errorMessage);
            return false;
        }
    }
    </script>
</body>

</html>