<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['changeBtn'])){
        if(isset($_POST['current_pass']) && isset($_POST['new_pass']) && isset($_POST['reset_pass'])){
            $new_pass = $_POST['new_pass'];
            $reset_pass = $_POST['reset_pass'];
            if(get_userPassword_BYID($_SESSION['jobme_laptop_User_ID'],$_POST['current_pass'])){
                if($new_pass == $reset_pass){
                    changePassword($new_pass,$_SESSION['jobme_laptop_User_ID']);
                }else {
                    header("Location: ?page=Update_user_profile&error=12");
                }                            
            }else {
                header("Location: ?page=Update_user_profile&error=11");
            }
        }
    }
?>

<form method="POST" class="m-auto" style="width: 70%;">
  <div class="form-row rounded-lg" style="background-color: rgb(230, 230, 230); margin:10px 0px 0px 0px; padding: 1px">
    <h2 class="mb-4 p-1">Change Password</h2>
    <div class="form-group col-md-12">
      <label for="inputEmail4">Current Password</label>
      <input type="password" class="form-control" name="current_pass" id="current_pass" placeholder="Current Password">
    </div>

    <?php
        if(isset($_GET['page']) && $_GET['page'] == "Update_user_profile"){
            if(isset($_GET['error']) && $_GET['error'] == "11"){
                ?>
                    <p class="alert-danger p-2 ml-1" style="width:99%;">Your Current Password is wrong Please try Again!</p>
                <?php
            }
        }
    ?>
    
    <div class="form-group col-md-12">
      <label for="inputEmail4">New Password</label>
      <input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="New Password">
    </div>

    <div class="form-group col-md-12">
      <label for="inputEmail4">Reset Password</label>
      <input type="password" class="form-control" name="reset_pass" id="reset_pass" placeholder="Reset Your Password">
    </div>

    <?php
        if(isset($_GET['page']) && $_GET['page'] == "Update_user_profile"){
            if(isset($_GET['error']) && $_GET['error'] == "12"){
                ?>
                    <p class="alert-danger p-2 ml-1" style="width:99%;">Your new Password is not corrent!</p>
                <?php
            }
        }
    ?>

    <button class="btn btn-primary" name="changeBtn">Change</button>
  </div>
</form>