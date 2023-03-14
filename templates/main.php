<?php
    if(is_Profile_Exit()){

        include_once('templates/home.php');

    }else {
        header("Location: ?page=register_profile");
    }
?>