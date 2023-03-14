<?php

    // setcookie('imageUploadStatus', false, time() + (86400 * 60), "/");

    // if(isset($_GET['page']) && $_GET['page'] == "edit_product"){
    //     if(isset($_GET['imageStatus']) && $_GET['imageStatus'] == "true"){
    //         setcookie('imageUploadStatus', true, time() + (86400 * 60), "/");
    //     }
    //     if(isset($_GET['imageStatus']) && $_GET['imageStatus'] == "false"){
    //         setcookie('imageUploadStatus', false, time() + (86400 * 60), "/");
    //     }
    // }

    if(isset($_GET['page']) && $_GET['page'] == "add_product"){
        if(isset($_GET['reqID']) && $_GET['reqID'] == "true"){
            setcookie('product_rid', generate_RID(), time() + (86400 * 60), "/");
            echo "
            <script>
                window.location = '". $_SERVER['PHP_SELF'] ."?page=add_product';
            </script>
            ";
        }
    }else{
        setcookie('product_rid', '', time() - (86400 * 60), "/");
    }

    if(isset($_GET['page']) && $_GET['page'] == "edit_product"){
        // echo "<script>alert('Working Edit Page');</script>";
        if(isset($_GET['productRelID']) && isset($_GET['product_id']) && isset($_GET['reqDel']) && $_GET['reqDel'] == true){
                setcookie('productRelID', $_GET['productRelID'], time() + (86400 * 60), "/");
                setcookie('product_id', $_GET['product_id'], time() + (86400 * 60), "/");
                // setcookie('imageUploadStatus', false, time() + (86400 * 60), "/");

                // alert("Image Status " . $_COOKIE['imageUploadStatus']);                

                echo "
                <script>
                    window.location = '". $_SERVER['PHP_SELF'] ."?page=edit_product&productRelID=". $_GET['productRelID'] ."&product_id=". $_GET['product_id'] ."';
                </script>
                ";

            // echo "<script>alert('Working Product REL ID');</script>";

            // echo "
            // <script>
            //     window.location = '". $_SERVER['PHP_SELF'] ."&page=edit_product';
            // </script>
            // ";

            // echo "<script>alert('". $_COOKIE['productRelID'] ."')</script>";
        }else{
            // echo "<script>alert('Not Working Product REL ID');</script>";
        }
    }else{
        // echo "<script>alert('Not Working Edit Page');</script>";
        // setcookie('productRelID', '', time() - (86400 * 60), "/");
        // setcookie('product_id', '', time() - (86400 * 60), "/");
    }

    // Images Path Definition
    $imagesPath = "assets/img/";
    
?>