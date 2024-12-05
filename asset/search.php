<?php
    require_once("C:\\xamppserver\\htdocs\\pinterest\\database\\connect.php");
    
    $data = $_POST['data'];
    $query = "select * from picture where title like '%d$data%' OR authorName like '%$data%'";
    $run_query = mysqli_query($connect, $query);
    $num = mysqli_num_rows($run_query);
    
    if($num > 0){
        while($row = mysqli_fetch_array($run_query)){
            echo '<div class="search-menu--item">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>'.$row['name'].'</span>
                </div>';
        }
    } else{
        echo '<h4 style = "text-align:center; color: #b1aaaa">Không tìm thấy nội dụng bạn muốn tìm</h4>';
    }
?>