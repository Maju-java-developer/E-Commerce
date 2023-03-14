<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['loginBtn'])){
        if(isset($_POST['email']) && isset($_POST['password'])){

            $email = $_POST['email'];
            $password = $_POST['password'];
    
            if(!empty($email) && !empty($password)){
                if(isLogin($email,$password)){
                    $userRow = is_adminLogin($email,$password);
                    if($userRow != null){
                        $_SESSION['jobme_laptop_admin_valid'] = true;
                        echo "<script>window.location.href='?page=dashboard'</script>";
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

<div class="col-lg-6 m-auto">
    <!-- form login -->
    <div class="card mt-4 ">
    <h5 class="card-header bg-info text-white text-center py-3">
    <strong>LOGIN</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0 shadow-sm">
    <!-- Form -->
    <form class="text-center" method="POST" style="color: #757575;" action="#!">
        <!-- Email -->
        <div class="md-form">
        <label class="m-2">E-mail</label>
        <input type="email" name="email" class="form-control">
        </div>

        <!-- Password -->
        <div class="md-form">
        <label class="m-2">Password</label>
        <input type="password" name="password" class="form-control">
        </div>

        <?php
            alert_Message("login","error","Something went wrong Try Again!");
            alert_Message("login","valuesErorr","Your Values is empty Please fill them first!");
            ?>
        <div class="d-flex justify-content-around">

        <!-- Sign in button -->
        <button name="loginBtn" class="btn btn-outline-info waves-effect btn-rounded btn-block my-4 z-depth-0" type="submit">LOGIN</button>

    </form>
    <!-- Form -->
    </div>
    </div>
</div>
