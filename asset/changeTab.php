<?php  
if (isset($_GET['tab'])) {  
    $tab = $_GET['tab'];  
    switch ($tab) {  
        case 'Chỉnh-sửa-hồ-sơ':  
            echo '<h1 style="color:red;">âjskđjdjđ</h1>';  
            break;  
        case 'tab2':  
            echo "Tab 2";  
            break;  
        case 'tab3':  
            echo "Tab 3";  
            break;  
        default:  
            echo "Nội dung không xác định";  
            break;  
    }  
}  
?>