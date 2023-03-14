<?php
    // Deleteing Varints
    if(isset($_SESSION['jobme_laptop_admin_valid'])){
        if($_SESSION['jobme_laptop_admin_valid'] == true){
    
            if(isset($_GET['page'])){
                if($_GET['page'] == "request_delete" && isset($_GET['productRelID']) && isset($_GET['product_id'])){
                    if(isset($_GET['variants_data'])){
                        delete_variants(
                            $_GET['productRelID'],
                            $_GET['variants_data']
                        );
                    }
                }
            }
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                if($page == "dashboard"){
                    include_once('templates/dashbaord.php'); 
                }
                else if ($page == "list_product"){
                    include_once('templates/listproducts.php'); 
                }
                else if ($page == "add_cat"){
                    add_category(); 
                }
                else if ($page == "add_brand"){
                    add_brand(); 
                }
                else if ($page == "add_model"){
                    add_model(); 
                }
                else if ($page == "add_sub_cat"){
                    add_sub_category(); 
                }
                else if ($page == "delete_product"){
                    delete_product(); 
                }
                else if ($page == "view_product" && $page != "view_orders_details"){
                    include_once('templates/view_product.php'); 
                }
                else if ($page == "view_orders_details" && $page != "view_product"){
                    include_once('templates/view_product.php'); 
                }
                else if ($page == "edit_product"){
                    include_once('templates/edit_product.php'); 
                }
                else if ($page == "add_product"){
                    include_once('templates/addProductactionbar.php'); 
                }
                else if ($page == "orders_list"){
                    include_once('templates/orders.php'); 
                }
                else if ($page == "sale_list"){
                    include_once('templates/sales_report.php'); 
                }
                else if ($page == "delete_user" && isset($_GET['user_id'])){
                    delete_user_and_orders($_GET['user_id']);
                }
                else if ($page == "delete_order" && isset($_GET['order_id']) && isset($_GET['user_id'])){
                    delete_order($_GET['order_id'],$_GET['user_id']);
                }
                else if ($page == "update_order_status" && isset($_GET['status']) && isset($_GET['order_id']) && isset($_GET['user_id'])){
                    update_order_status($_GET['status'],$_GET['order_id'],$_GET['user_id']);
                }
                else {
                    include_once('templates/dashbaord.php'); 
                }
            }else {
                include_once('templates/dashbaord.php'); 
            }
        }
    }else {
        include_once('templates/admin_authenticate.php');
    }

    ?>
