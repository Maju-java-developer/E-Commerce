<?php
    if(isset($_GET['page'])){
        if($_GET['page'] == "login"){
            include_once('templates/login.php');
        }
        else if ($_GET['page'] == "register"){
            include_once('templates/register.php');
        }
        else if ($_GET['page'] == "home"){
            include_once('templates/home.php');
        }
    }else {
        include_once('templates/login.php');
    }
?>
