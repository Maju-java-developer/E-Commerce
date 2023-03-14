<?php

include_once("inc/sessions.php");

// -------- Functions ------------
include_once("../inc/general.php");
// -------- Functions ------------

// -------- Functions ------------
include_once("../inc/functions.php");
// -------- Functions ------------

include_once("inc/extras.php");

include_once('templates/head.php');

if(isset($_SESSION['jobme_laptop_admin_valid'])){
    if($_SESSION['jobme_laptop_admin_valid'] == true){
        include_once('templates/head.php');
        include_once('templates/sidebar.php');
        include_once('templates/main.php');
        include_once('templates/footer.php');
    }
}else {
    include_once('templates/admin_authenticate.php');
}

?>