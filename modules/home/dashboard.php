<?php
    require_once("./templates/navbar.php");
    require_once("./database/connect.php");
?>
<div class="main-home">
    <div class="grid">
        <?php
        $sql = "select * from picture order by rand() limit 20";
        $run = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($run)){
            echo '<a href="">
                    <img src="'.$row['link'].'" alt="">
                </a>';
        }
        ?>
    </div>
</div