<?php
    require_once("./templates/navbar.php");
    require_once("./database/connect.php");
    $email = $_COOKIE['Email'];
    $Pass = $_COOKIE['Pass'];
    $sql = "select * from users where email = '$email' and password = '$Pass'";
    $run = mysqli_query($connect,$sql);
    while($row = mysqli_fetch_array($run)){
        $name = $row['username'];
        $surname = $row['surname'];
    }
    
?>
<style>
input[type="file"] {
    display: none;
}

.sidebar {
    position: relative;
    width: max-content;

}

.sidebar ul li {
    padding: 10px;
    cursor: pointer;
    font-size: 1.3rem;
    position: relative;
}

.sidebar ul li.active::before {
    content: "";
    width: 100%;
    height: 2px;
    background-color: black;
    position: absolute;
    bottom: 0;
}

.sidebar-content {
    position: absolute;
    top: 100px;
    right: 25%;
}

.tab.active {
    display: block;
}

.para-text {
    width: 50%;

}

.intro-profile input {
    width: 200px;
    height: 40px;
    outline: none;
    border: none;
    margin-right: 8px;
    background-color: #ececec;
    color: black;
    border-radius: 20px;
    padding: 5px 20px;
}

.grp-label {
    display: flex;
    gap: 208px;
}

.intro-input textarea {
    width: 416px;
    height: 50px;
    background-color: #ececec;
    outline: none;
    border: none;
    border-radius: 25px;
    resize: none;
    padding: 10px 20px;
}

.grp-btn {
    margin-left: 100px;
}

.grp-btn button {
    width: 100px;
    height: 50px;
    outline: none;
    border: none;
    background-color: #ff3b31;
    color: white;
    border-radius: 25px;
    margin: 10px 20px;
}

.hidden {
    display: none;
}
</style>
<div class="body-manage">
    <div class="sidebar">
        <ul>
            <li onclick="ChangeTab('profile')" class="active">Chỉnh sửa hồ sơ</li>
            <li onclick="ChangeTab('account')" class="">Quản lý tài khoản</li>
            <li onclick="ChangeTab('notify')" class="">Thông báo</li>
            <li onclick="ChangeTab('security')" class="">Bảo mật</li>
        </ul>
    </div>
    <div class="sidebar-content">
        <div id="profile" class="tab hidden">
            <h2>Chỉnh sửa hồ sơ</h2>
            <p class="para-text">
                Hãy giữ riêng tư thông tin cá nhân của bạn. Thông tin bạn thêm vào
                đây hiển thị cho bất cứ ai thấy hồ sơ của bạn.
            </p>
            <form method="post" id="uploadForm" enctype="multipart/form-data">
                <span>Ảnh</span>
                <div class="change-picture">
                    <img src="" alt="">
                    <input type="file" name="avatar" id="avatar">
                    <label for="avatar">Thay đổi</label>
                </div>
                <div class="intro-profile">
                    <div class="grp-label">
                        <span>Tên</span>
                        <span>Họ</span>
                    </div>
                    <input type="text" name="name" id="name" value="<?php echo $name?>">
                    <input type="text" name="surname" id="surname" value="<?php echo $surname?>">
                </div>
                <span>Giới thiệu</span>
                <div class="intro-input">
                    <textarea name="" id=""></textarea>
                </div>
                <div class="grp-btn">
                    <button>Thiết lập lại</button>
                    <button type="submit" name="update" class="update">Lưu</button>
                </div>
            </form>
        </div>
        <!-- <div id="account" class="tab hidden">
            <h2>Quản lý tài khoản</h2>
            <p class="para-text">
                Hãy giữ riêng tư thông tin cá nhân của bạn. Thông tin bạn thêm vào
                đây hiển thị cho bất cứ ai thấy hồ sơ của bạn.
            </p>
            <form method="post" id="uploadForm" enctype="multipart/form-data">
                <span>Ảnh</span>
                <div class="change-picture">
                    <img src="" alt="">
                    <input type="file" name="avatar" id="avatar" accept="image/*" required>
                    <label for="avatar">Thay đổi</label>
                </div>
                <div class="intro-profile">
                    <div class="grp-label">
                        <span>Tên</span>
                        <span>Họ</span>
                    </div>
                    <input type="text" name="name" id="name" value="">
                    <input type=" text" name="surname" id="surname">
                </div>
                <span>Giới thiệu</span>
                <div class="intro-input">
                    <textarea name="" id=""></textarea>
                </div>
                <div class="grp-btn">
                    <button class="reset">Thiết lập lại</button>
                    <button type="submit" name="update">Lưu</button>
                </div>
            </form>
        </div> -->
    </div>
</div>
<script>
document.querySelector(".update").addEventListener("click", () => {
    window.location.href = "http://localhost:8080/pinterest/?module=user&action=Manage";
})

function ChangeTab(tabId, e) {
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.id === tabId) {
            tab.classList.add('active');
        }
    });
}
// Khởi động với tab "profile"
document.addEventListener('DOMContentLoaded', () => {
    ChangeTab('profile');

});
</script>
<?php
    require_once("./database/connect.php");
    if(isset($_POST['update'])){
        $n = $_POST['name'];
        $s = $_POST['surname'];
        $file = $_FILES['avatar']['name'];
        $insert = "update users set username = '$n', surname = '$s' where email = '$email' and password = '$Pass'";
        $run = mysqli_query($connect, $insert);
    }
?>