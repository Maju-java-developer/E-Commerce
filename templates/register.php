<?php


    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitBtn'])){
        if(
        isset($_POST['First_Name']) &&
        isset($_POST['Last_Name']) && 
        isset($_POST['password']) && 
        isset($_POST['email']) && 
        isset($_POST['Re-Type-password'])){

            $first_name = $_POST['First_Name'];
            $last_name = $_POST['Last_Name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $re_type_password = $_POST['Re-Type-password'];
            
            if(!empty($first_name) && !empty($last_name) && !empty($password) && !empty($re_type_password) && !empty($email)){
                if(!isEmailExit($email)){
                    if($password == $re_type_password){
                        insert_User($first_name,$last_name,$password,$email);

                        $userRow = isLogin($email,$password);
                        if($userRow != null){
                            $USER_VALID = $_SESSION['jobme_laptop_Valid'] = true;
                            $USER_ID = $_SESSION['jobme_laptop_User_ID'] = $userRow[0][0];
                            $USER_FIRST_NAME = $_SESSION['jobme_laptop_First_Name'] = $userRow[0][1];
                            $USER_LAST_NAME = $_SESSION['jobme_laptop_Last_Name'] = $userRow[0][2];
                            $USER_EMAIL = $_SESSION['jobme_laptop_Email'] = $userRow[0][3];
                            header("Location: ?page=register_profile");
                        }

                    }else {
                        header('Location: ?page=register&register=PasswordError');
                    }
                }else {
                    header('Location: ?page=register&register=EmailError');
                }
            }else {
                header('Location: ?page=register&register=ValuesError');
            }
        }else {
            echo "Some Parameters are missing!";
        }
    }

?>
<!-- Material form register -->
<div class=" col-lg-6 m-auto">
    <div class="card mt-3 mb-2">
    <h5 class="card-header info-color white-text text-center py-3">
        <strong>REGISTER</strong>
    </h5>
    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
        <!-- Form -->
        <form class="text-center" method="POST" style="color: #757575;">
            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" name="First_Name" class="form-control" required>
                        <label>First name</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" name="Last_Name" class="form-control" required>
                        <label>Last name</label>
                    </div>
                </div>
            </div>

            <!-- E-mail -->
            <div class="md-form mt-0">
                <input type="email" name="email" class="form-control" required>
                <label>E-mail</label>
            </div>

            <?php
                alert_Message('register','EmailError',"This email is Already Taken Try Again!");
            ?>

            <!-- Password -->
            <div class="md-form">
                <input type="password" name="password" class="form-control" required>
                <label>Password</label>
            </div>

            <!-- Re-Type-Password -->
            <div class="md-form">
                <input type="password" name="Re-Type-password" class="form-control" required>
                <label>Re-Password</label>
            </div>

            <?php
                alert_Message('register','PasswordError',"Your password is un match try again!");
            ?>

            <!-- Sign up button -->
            <button name="submitBtn" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">REGISTER</button>

            <?php
                alert_Message("register","ValuesError","Please Fill All Values First!");
            ?>

            <!-- Social register -->
            <p>or sign up with? <!-- Use Link --> <a href="?page=login">Already Have Account</a> </p> 

            <a type="button" class="btn-floating btn-fb btn-sm">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a type="button" class="btn-floating btn-tw btn-sm">
                <i class="fab fa-twitter"></i>
            </a>
            <a type="button" class="btn-floating btn-li btn-sm" href="htt">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a type="button" class="btn-floating btn-git btn-sm" href="http://instagram.com">
                <i class="fab fa-instagram"></i>
            </a>
            <a type="button" class="btn-floating btn-git btn-sm" href="http://google.com">
                <i class="fab fa-google"></i>
            </a>

        </form>
        <!-- Form -->
    </div>
    </div>
</div>
<!-- Material form register -->
<?php
?>