<?php
    if(isset($_SESSION['jobme_laptop_Valid']) && $_SESSION['jobme_laptop_Valid'] == true){
        if(isset($_GET['page']) && $_GET['page'] == "user_profile"){
            $get_userInfo = get_userBYID($_SESSION['jobme_laptop_User_ID']);
            $get_userAddress = get_userAddress_BYID($_SESSION['jobme_laptop_User_ID']);

            $userData = [];
            $user_AddressData = [];

            // Pushing Select Attributes To User From User Row;
            array_push($userData,"UserName: ".$get_userInfo[0][1]." ".$get_userInfo[0][2]);
            array_push($userData,"Gmail: " .$get_userInfo[0][3]);
            array_push($userData,"Join Date: ".$get_userInfo[0][6]);

            // Pushing Select Attributes To User From Address Row;
            array_push($user_AddressData,"Phone Number: " . $get_userAddress[0][3]);
            array_push($user_AddressData,"City: " . $get_userAddress[0][5]);
            array_push($user_AddressData,"Area: " . $get_userAddress[0][6]);
            array_push($user_AddressData,"Billing Address: " . $get_userAddress[0][7]);
            array_push($user_AddressData,"Delivery Address: " . $get_userAddress[0][8]);

        ?>
        <div class="row mt-2" style="width: 75%; margin: auto; background-color: rgb(235,235,235);">
            <div class="w-100">
                <h5 class="p-2 m-2 blue-gradient-rgba rounded-lg">Personal Information</h5>
                <?php
                    for ($i=0; $i < sizeof($userData); $i++) { 
                        ?>
                            <p style="color: #204080; font-size:large; margin: 0px 0px 3px 10px; padding: 2px;"><?php echo $userData[$i]?> </p>
                            <hr style="width: 99%; margin:0px; padding: 0px;">
                        <?php       
                    }
                ?>
            </div>

            <div class="w-100">
                <h5 class="p-2 m-2 blue-gradient-rgba rounded-lg">Other's Information</h5>
                <?php
                    for ($i=0; $i < sizeof($user_AddressData); $i++) { 
                        ?>
                            <p style="color: #204080; font-size:large; margin: 0px 0px 3px 10px; padding: 2px;"><?php echo $user_AddressData[$i]?> </p>
                            <hr style="width: 99%; margin:0px; padding: 0px;">
                        <?php       
                    }
                ?>
            </div>

            <div class="btn-group mt-2">
                <button class="btn btn-primary mr-2 rounded-lg">EDIT</button>
                <button class="btn btn-secondary rounded-lg" onclick="redirectTo('?page=Update_user_profile')">CHANGE PASSWORD</button>
            </div>
        </div>
    <?php
    }
}
// Show User Inforamtion End!

?>