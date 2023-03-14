<?php
    
    // Checking To User According This Method!
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['loginBtn'])){
        if(isset($_POST['email']) && isset($_POST['password'])){

            $email = $_POST['email'];
            $password = $_POST['password'];
    
            if(!empty($email) && !empty($password)){
                if(isLogin($email,$password)){
                    $userRow = isLogin($email,$password);
                    if($userRow != null){
                        $USER_VALID = $_SESSION['jobme_laptop_Valid'] = true;
                        $USER_ID = $_SESSION['jobme_laptop_User_ID'] = $userRow[0][0];
                        $USER_FIRST_NAME = $_SESSION['jobme_laptop_First_Name'] = $userRow[0][1];
                        $USER_LAST_NAME = $_SESSION['jobme_laptop_Last_Name'] = $userRow[0][2];
                        $USER_EMAIL = $_SESSION['jobme_laptop_Email'] = $userRow[0][3];

                        header("Location: ?page=cart_products");
                    }
                }else {
                    header("Location: ?page=login&login=error");
                }
            }else {
                header("Location: ?page=login&login=valuesError");
            }
        }else{
            echo "Some Parameters are missing!";
        }       
    }

    ?>
    <div class="col-lg-5 m-auto">
        <!-- form login -->
        <div class="card mt-3">
        <h5 class="card-header blue-gradient white-text text-center py-3">
        <strong>LOGIN</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0 shadow-sm">
        <!-- Form -->
        <form class="text-center" method="POST" style="color: #757575;" action="#!">
            <!-- Email -->
            <div class="md-form">
            <input type="email" name="email" class="form-control">
            <label>E-mail</label>
            </div>

            <!-- Password -->
            <div class="md-form">
            <input type="password" name="password" class="form-control">
            <label>Password</label>
            </div>

            <?php
                alert_Message("login","error","Something went wrong Try Again!");
                alert_Message("login","valuesErorr","Your Values is empty Please fill them first!");
                ?>
            <div class="d-flex justify-content-around">
            <div>
                <!-- Remember me -->
                <div class="form-check">
                <input type="checkbox" class="form-check-input" name="rememberMe">
                <label class="form-check-label">Remember me</label>
                </div>
            </div>

            <div>
                <!-- Forgot password -->
                <a href="">Forgot password?</a>
            </div>
            </div>

            <!-- Sign in button -->
            <button name="loginBtn" class="btn btn-outline-info waves-effect btn-rounded btn-block my-4 z-depth-0" type="submit">LOGIN</button>

            <!-- Register -->
            <p>Not a member?
            <a href="?page=register">Register</a>
            </p>

            <!-- Social login -->
            <p>or sign in with:</p>

            <a type="button" class="btn-floating btn-fb btn-sm">
            <i class="fab fa-facebook-f"></i>
            </a>

            <a type="button" class="btn-floating btn-tw btn-sm">
            <i class="fab fa-twitter"></i>
            </a>

            <a type="button" class="btn-floating btn-li btn-sm">
            <i class="fab fa-linkedin-in"></i>
            </a>

            <a type="button" class="btn-floating btn-git btn-sm">
            <i class="fab fa-github"></i>
            </a>

        </form>
        <!-- Form -->
        </div>
        </div>
    </div>
        <!-- Material form login -->
    <?php
?>