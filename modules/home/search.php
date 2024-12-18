<?php
    require_once("./templates/navbar.php");
    require_once("./database/connect.php");
?>
<div class="main-home">
    <div class="grid">
        <?php
        $search = $_GET['search'];
        $sql = "select * from picture where title like '%$search%'";
        $run = mysqli_query($connect, $sql);
        $num = mysqli_num_rows($run);
       if($num >= 1){
            while($row = mysqli_fetch_array($run)){
                echo '<a href="">
                        <img src="'.$row['link'].'" alt="">
                    </a>';
            }
       } else{
            echo '<h2 style = "color:#b1aaaa; margin:250px 500px; text-align:center;        width:max-content;">
                    Không tìm thấy kết quả nào
                </h2>';
       }
        ?>
    </div>
</div