<?php
    require_once("./templates/navbar.php");
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    function updateLikes(item_id) {
        let heart = document.querySelector(".fa-heart");
        let action = "";
        if (heart.classList.contains("fa-regular")) {
            heart.classList.replace("fa-regular", "fa-solid");
            action = "like";
        } else {
            heart.classList.replace("fa-solid", "fa-regular");
            action = "unlike";
        }
        const xhr = new XMLHttpRequest();
        xhr.open("POST",
            "/pinterest/modules/infoImg/update_likes.php", true);
        xhr.setRequestHeader(
            "Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange =
            function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("likes-count").textContent = xhr.responseText;
                    } else {
                        console.error("Failed to update likes");
                    }
                }
            };
        xhr.send("action=" + action + "&item_id=" + item_id);
    }
    </script>
    <script>
    $(document).ready(function() {
        $('#comment-form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "http://localhost:8080/pinterest/modules/infoImg/binhluan.php",
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    $('#comment-form')[0].reset();
                    loadComments();
                }
            });
        });

        function loadComments() {
            $.ajax({
                url: "http://localhost:8888/pinterest/modules/infoImg/loadbinhluan.php",
                method: "GET",
                success: function(data) {
                    $('#dsbinhluan').html(data);
                }
            });
        }
        loadComments();
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
</head>
<style>
body {
    background-color: #D9D9D9;
}

.container {
    position: relative;
    left: 50px;
    width: 60%;
    background-color: white;
}

.comment {
    width: 100%;
    height: 500px;
    display: flex;

}

.left {
    padding: 10px;
    width: 35%;
    height: 100%;
}

.left img {
    width: 100%;
    height: 100%;
    object-fit: cover;

}

.right {
    width: 65%;
    height: 100%;
    position: absolute;
    left: 30%;
}

.comment-form {
    width: 100%;
    position: absolute;
    bottom: 10px;
    left: 100px;
}

.save {
    position: absolute;
    background-color: red;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 20px;
    box-shadow: none;
    left: 300px;
}

.btn-info {
    outline: none;
    border: 1px solid black;
    color: black;
    width: 200px;
    height: 40px;
    border-radius: 20px;
}

.heart {
    position: absolute;
    border: none;
    color: black;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    border-radius: 50%;
    padding: 15px 15px;
    left: 100px;
}

.share {
    position: absolute;
    background-color: white;
    border: none;
    color: black;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    border-radius: 50%;
    padding: 15px 15px;
    left: 180px;

}

.dot {
    position: absolute;
    background-color: white;
    border: none;
    color: black;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    border-radius: 50%;
    padding: 15px 15px;
    left: 230px;
}

.like {
    position: absolute;
    top: 15px;
    left: 160px;
}

.binhluan {
    position: absolute;
    left: 120px;
    top: 50px;
}

#text {
    width: 50%;
    height: 30px;
    outline: none;
    border: 1px solid #ececec;
    border-radius: 25px;
    padding: 2px 20px;
}

.icon {
    position: absolute;
    right: 60%;
    top: 50%;
    transform: translateY(-50%);
}

.icon:nth-child(2) {
    right: 55%;
}

.fa-heart.active {
    background-color: pink;
}

.comment-user {
    font-size: 1.3rem;
    padding: 0 15px;
}

.comment-content {
    font-size: 1rem;
    font-weight: 400;
}

#dsbinhluan {
    margin-top: 30px;
    height: 350px;
    overflow: auto;
}

#dsbinhluan::-webkit-scrollbar {
    display: none;
}
</style>

<body>

    <button type="submit" class="btn-info bg-light " name="back">
        <i class="fa-solid fa-arrow-left "></i>
        Dành cho bạn
    </button>
    <div class="container">
        <div class="comment">
            <div class="left">
                <?php
                    require_once("./database/connect.php");
                    $id=$_GET['id'];
                    $sql = "SELECT * FROM picture WHERE id = $id";
                    $run = mysqli_query($connect,$sql);
                    $num_row = mysqli_num_rows($run);
                    if($num_row>0){
                        while($row = mysqli_fetch_array($run)) {
                            echo '<img src='.$row['link'].'>';
                            
                        }
                    }
                ?>
            </div>
            <div class="right">
                <div class="acc">
                    <p class="like" id="likes-count">
                        <?php
                    require_once("./database/connect.php");
                    $sql = "SELECT * FROM picture WHERE id=$id";
                        $run = mysqli_query($connect,$sql);
                        $num_row = mysqli_num_rows($run);
                        if ($num_row > 0) {
                            while($row = mysqli_fetch_array($run)) {
                                echo $row['follow'];
                            }
                        }
                    ?>
                    </p>
                    <button class="heart" id="button"
                        onclick="updateLikes(<?php $id = $_GET['id']; echo $id ?>)"><i
                            class="fa-regular fa-heart h"></i></button>
                    <button class="share"><i
                            class="fa-solid fa-arrow-up-from-bracket h"></i></button>
                    <button class="dot"><i class="fa-solid fa-ellipsis h"></i></button>
                    <Button type="submit" class="save">Lưu</Button>
                </div>
                <div class="binhluan" id="dsbinhluan">
                    <?php
                        require_once("./database/connect.php");
                        $email = $_COOKIE['Email'];
                        $Pass = $_COOKIE["Pass"];
                        $getSql = "select * from users where email = '$email' and password = '$Pass'";
                        $run = mysqli_query($connect,$getSql);
                        while($row = mysqli_fetch_array($run)){
                            $nameUser = $row['username'];
                        }
                        $getCmt = "select * from comment where idPicture = $id";
                        $cmt = mysqli_query($connect, $getCmt);
                        while($rCmt = mysqli_fetch_array($cmt)){
                            echo '<div class = "comment-item">
                                <span class="comment-user">'.$nameUser.'</span>
                                <span class="comment-content">'.$rCmt['content'].'</span>
                            </div> <span style="padding-left:30px">Trả lời</span>
                            <i
                            class="fa-regular fa-heart h"></i>';
                            
                        }
                     ?>
                </div>
                <form class="comment-form" id="comment-form" method="post"
                    data-id="<?php echo $id; ?>">
                    <input type="text" id="text" name="text" required placeholder="Thêm nhận xét">
                    <i class="fa-regular fa-image icon"></i>
                    <i class="fa-solid fa-face-smile icon"></i>

                </form>
            </div>
        </div>
    </div>

    <script>
    document.querySelector(".btn-info").addEventListener("click", () => {
        window.location.href = "http://localhost:8080/pinterest/"
    })
    $("#text").keydown(function(event) {
        if (event.keyCode === 13) {
            let text = $("#text").val();
            let id = $("#comment-form").attr("data-id");
            $.post("http://localhost:8080/pinterest/?module=infoImg&action=binhluan", {
                data: text,
                id: id
            })
            window.location.href =
                "http://localhost:8080/pinterest/?module=infoImg&action=infoimg&id=" + id;
        }
    })
    </script>
</body>

</html>