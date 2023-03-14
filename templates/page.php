<?php

    // unset($_SESSION['add_to_cart']);
    // unset($_SESSION['jobme_latop_Valid']);

    // if(isset($_SESSION['jobme_latop_Valid'])){
    //     echo " Status :". $_SESSION['jobme_latop_Valid'];
    // }else {
    //     echo "Status : Not Set"; 
    // }

    // if(isset($_SESSION['add_to_cart'])){
    //     echo "<br> Item :". $_SESSION['add_to_cart'] . "<br>";
    // }else {
    //     echo "Status : Not Set"; 
    // }

    if(isset($_GET['page'])){
        if(isset($_SESSION['jobme_laptop_Valid'])){
            if($_SESSION['jobme_laptop_Valid'] == true){
                if($_GET['page'] == "user_profile"){
                    include_once("templates/user_profile.php");
                }else if($_GET['page'] == "Update_user_profile"){
                    include_once("templates/changePassword.php");
                }else {
                    // header("Location: ?page=main");
                }
            }
        }
    }

    // Running Method OF Add Order
    if(isset($_GET['page']) && $_GET['page'] == "request_order"){
        if(isset($_GET['ItemIDs']) && isset($_GET['ItemQTY']) && isset($_GET['UserID'])){
            if(isset($_GET['full_name']) &&
             isset($_GET['proviece']) && 
             isset($_GET['phone_number']) &&
             isset($_GET['gmail']) && 
             isset($_GET['city']) && 
             isset($_GET['area']) && 
             isset($_GET['billing_address']) && 
             isset($_GET['delivery_address'])){
                add_order(
                    $_GET['ItemIDs'],
                    $_GET['ItemQTY'],
                    $_GET['UserID'],
                    $_GET['full_name'],
                    $_GET['proviece'],
                    $_GET['phone_number'],
                    $_GET['gmail'],
                    $_GET['city'],
                    $_GET['area'],
                    $_GET['billing_address'],
                    $_GET['delivery_address']
                );
            }

        }else {
        }
    }
    // Running Method OF Add Order

    if(isset($_SESSION['checked_items'])){
        echo "Checked Items : " .$_SESSION['checked_items'];
    }

    if(isset($_GET['page']) && $_GET['page'] == "checked_request"){
        if(isset($_GET['checked_item'])){
            addToCheckedItem("checked_items",$_GET['checked_item']);
            header("location: ?page=cart_products");   
        }
    }

    $getCategoreis = getCategories();
    foreach($getCategoreis as $cat){
        if(isset($_GET['page']) && $_GET['page'] == $cat[1] && $cat[1] != "All In One"){
            if(!isset($_GET['product_id']) && !isset($_GET['brand_id']) && !isset($_GET['model_rid'])){
                include_once('templates/list_products_by_category.php');
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
            if(isset($_GET['product_id'])){
                include_once('templates/show_single_Product_Info.php');
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == $cat[1] && $cat[1] != "All In One"){
            if(isset($_GET['brand_id'])){
                include_once('templates/list_products_by_brand.php');
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
            if(isset($_GET['model_rid'])){
                include_once("templates/list_product_By_Model.php");
            }
        }

        if(isset($_GET['page']) && $_GET['page'] == $cat[1] && $cat[1] == "All In One"){
            include_once("templates/list_product_ByAll_In_One.php");
        }
    }

    // Add To Cart Condition 
    $getProducts = get_products();
    if(isset($_GET['page']) && $_GET['page'] == "request_addToCart"){
        foreach($getProducts as $product){
            if(isset($_GET['product_id']) && $_GET['product_id'] == $product[0]){
                addToCart("add_to_cart", $_GET['product_id']);
                if ($_SESSION['jobme_laptop_Valid'] == true){
                    header('Location: ?page=cart_products');
                }else {
                    header('Location: ?page=login');
                }
            }
        }
    }
    // Add To Cart Condition:

    // Add To Favrt Condition 
    $getProducts = get_products();
    if(isset($_GET['page']) && $_GET['page'] == "request_addToFavrt"){
        foreach($getProducts as $product){
            if(isset($_GET['product_id']) && $_GET['product_id'] == $product[0]){
                addToCart("add_to_favrt", $_GET['product_id']);
                if ($_SESSION['jobme_laptop_Valid'] == true){
                    header('Location: ?page=favrt_Item');
                }else {
                    header('Location: ?page=login');
                }
            }
        }
    }
    // Add To Favrt Condition 
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if($page == "home"){
            include_once('templates/home.php');
        }
        else if($page == "cart_products"){
            if(isset($_SESSION['jobme_laptop_Valid']) && isset($_SESSION['add_to_cart'])){
                if($_SESSION['jobme_laptop_Valid']){
                    include_once('templates/add_to_cart_products.php');
                }
            }else {
                header("Location: ?page=home");
            }
        }
        else if($page == "favrt_Item"){
            if(isset($_SESSION['jobme_laptop_Valid']) && isset($_SESSION['add_to_favrt'])){
                if($_SESSION['jobme_laptop_Valid'] == true){
                    include_once('templates/Favrt_Item.php');
                }
            }else {
                header("Location: ?page=home");
            }
        } 
        else if ($page == "proceed_to_checkout"){
            include_once('templates/process_to_checkout.php');
        }
        else if ($page == "delivery_information"){
            include_once('templates/delivery_information.php');
        }
        else if ($page == "logout"){
            include_once("templates/logout.php");
        }
        
        if($page == "login" || $page == "register"){
            if(isset($_SESSION['jobme_laptop_Valid'])){
                if($_SESSION['jobme_laptop_Valid'] == true){
                    echo "
                    <script>
                        redirectTo('?page=cart_products');
                    </script>";
                }
            }else {
                if ($page == "login"){
                    include_once("templates/login.php");
                }else if ($page == "register"){
                    include_once("templates/register.php");
                }
            } 
        }
    }else {
        include_once('templates/home.php');
    }
?>
