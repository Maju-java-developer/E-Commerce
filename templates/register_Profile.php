<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitBtn'])){
        if(
        isset($_POST['address']) && isset($_POST['billing_address']) &&
        isset($_POST['delivery_address']) && isset($_POST['phone'])){

            $address = $_POST['address'];
            $billing_address = $_POST['billing_address'];
            $delivery_address = $_POST['delivery_address'];
            $phone = $_POST['phone'];

            $uplodImageStatus = "";
            $getUplaodDocPath = upload_image_file('user_img','resources/images/');

            if($getUplaodDocPath){
                $uplodImageStatus = $getUplaodDocPath;
            }else {
                $uplodImageStatus = "uplaod_Image_error";
            }

            if($uplodImageStatus != "uplaod_Image_error"){
                insert_Profile(
                    $phone,
                    $address,
                    $billing_address,
                    $delivery_address,
                    $uplodImageStatus
                );

                header("Location: ?page=main");
            }

        }else {
            echo "Some Parameter are missing!";
        }
    }

?>
<div class=" col-lg-6 m-auto">
    <div class="card mt-3 mb-2">
    <h5 class="card-header info-color white-text text-center py-3">
        <strong>USER PROFILE</strong>
    </h5>
    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
        <!-- Form -->
        <form class="text-center" method="POST" style="color: #757575;" enctype="multipart/form-data">

            <!-- Image -->
            <div class="md-form">
                <input type="file" name="user_img" class="form-control" required>
            </div>

            <?php
            alert_Message('register_profile',"extentionError","extension not allowed, please choose a jpg jpeg or png file");
            alert_Message('register_profile',"sizeError","File size must be excately 2 MB!");
            ?>
            <!-- Address -->
            <div class="md-form">
                <input type="text" name="address" class="form-control" required>
                <label>Address</label>
            </div>

            <!-- Billing_Address -->
            <div class="md-form mt-0">
                <input type="text" name="billing_address" class="form-control" required>
                <label>Billing Addrees</label>
            </div>

            <!-- Delivery_Address -->
            <div class="md-form">
                <input type="text" name="delivery_address" class="form-control" required>
                <label>Delivery Address</label>
            </div>

            <!-- Phone -->
            <div class="md-form">
                <input type="number" name="phone" class="form-control" required>
                <label>Phone</label>
            </div>

            <!-- Sign up button -->
            <button name="submitBtn" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">REGISTER PROFILE</button>

            <?php
                alert_Message("register_profile","ValuesError","Please Fill All Values First!");
            ?>

            <!-- Social register -->
            <p>If you don't want to fill your profile now so you may? <!-- Use Link --> <a href="?page=logout">LOGOUT</a> </p> 

        </form>
        <!-- Form -->
    </div>
    </div>
</div>
<!-- Material form register -->
    
    <?php
?>