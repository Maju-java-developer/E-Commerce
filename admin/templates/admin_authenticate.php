<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "admin_login"){
        include_once('templates/admin_login.php');
    }else if($page == "admin_register"){
        // Inculde Admin Register Page!
    }else {
        echo "<script>window.location.href='?page=admin_login'</script>";
    }
}else {
    include_once('templates/admin_login.php');
}
?>
