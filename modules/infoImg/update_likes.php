<?php
require_once("C://xamppserver//htdocs//pinterest//database//connect.php");

if (isset($_POST['action']) && isset($_POST['item_id'])) { 
    $item_id = intval($_POST['item_id']); 
    $action = $_POST['action']; 
    if ($action == 'like') { 
        $sql = "UPDATE picture SET follow = follow + 1 WHERE id = $item_id"; 
    }   elseif ($action == 'unlike') { 
            $sql = "UPDATE picture SET follow = follow - 1 WHERE id = $item_id"; 
        }
}
if ($connect->query($sql) === TRUE) { 
    $sql = "SELECT * FROM picture WHERE id=$item_id";
        $run = mysqli_query($connect,$sql);
            $num_row = mysqli_num_rows($run);
                if ($num_row > 0) {
                    while($row = mysqli_fetch_array($run)) {
                        echo $row['follow'];
                    }
                }
} 
else { echo "Error: " . $connect->error; }    
?>