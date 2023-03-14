<?php
    $province = array("Sindh","Punjab","Bolochistan","MWFP");

    if(isset($_GET['page']) && $_GET['page'] == "delivery_information"){
        if(isset($_GET['paymentMethod']) && isset($_GET['ItemIDs']) && isset($_GET['ItemQTY']) && isset($_GET['totalPrice'])){
            // echo "PaymentMethod = " . $_GET['paymentMethod'] ."<br>";
            // echo "ItemIDs = " . $_GET['ItemIDs'] ."<br>";
            // echo "ItemQTY = " . $_GET['ItemQTY'] ."<br>";
            // echo "TotalPrice = " . $_GET['totalPrice'] ."<br>";
    ?>
    <div class="row" style="width: 96%; margin: auto;">
        <!-- Payment Method ! -->
        <div class="col-xl-8 p-2 m-2 card" style="background: rgb(230,230,240);"> 
            <h3>Delivery Infomation</h3>
                <div class="row">
                    <div class="form-group col-xl-6">
                        <label>Full Name</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="text" class="form-control" name="full_name" id="full_name"  placeholder="Enter Full Name">
                    </div>
                    <div class="form-group col-xl-6">
                        <label>Province</label>
                        <select onkeyup="isDeliveryInformationEmpty();" name="province" id="province" class="form-control">
                            <?php
                                for ($i=0; $i < sizeof($province); $i++) { 
                                    echo "<option >$province[$i]</option>";
                                } 
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-xl-6">
                        <label>Phone Number</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="number" class="form-control" name="phone_number" id="phone_number"  placeholder="Enter Phone Number">
                    </div>

                    <div class="form-group col-xl-6">
                        <label>Gmail</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="gmail" class="form-control" name="gmail" id="gmail"  placeholder="Enter Gmail">
                    </div>

                    <div class="form-group col-xl-6">
                        <label>City</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="text" name="city" id="city" class="form-control" placeholder="Enter City">
                    </div>

                    <div class="form-group col-xl-6">
                        <label>Area</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="text" name="area" id="area" class="form-control" placeholder="Enter Area">
                    </div>

                    <div class="form-group col-xl-6">
                        <label>Billing Address</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="text" name="billing_address" id="billing_address" class="form-control" placeholder="Enter Billing Address">
                    </div>

                    <div class="form-group col-xl-6">
                        <label>Delivery Address</label>
                        <input onkeyup="isDeliveryInformationEmpty();" type="text" name="delivery_address" id="delivery_address" class="form-control" placeholder="Enter Delivery Address">
                    </div>
                    <?php if(isset($_SESSION['jobme_laptop_User_ID'])){
                        $userID = $_SESSION['jobme_laptop_User_ID'];
                    }?>

                    <button disabled onclick="redirectDeliveryInfoTo('?page=request_order&ItemIDs=<?php echo $_GET['ItemIDs']?>&ItemQTY=<?php echo $_GET['ItemQTY']?>&UserID=<?php echo $userID?>');" type="submit" id="delivery_info_btn" class="btn btn-primary ml-3">Submit</button>
                </div>
        </div>

        <!-- Creating Hidden Div For gettting Price -->
        <div id="totalPrice" hidden>
            <?php echo $_GET['totalPrice']?>
        </div>
        <!-- Creating Hidden Div For gettting Price -->

        <!-- Proceed To Checkout -->
        <div class="col-xl-3 p-2 m-2 " style="background: rgb(222,222,222); height:  290px;">
        <div class="card p-1 shadow-lg rounded-lg">
            <p>Order Summary</p>

            <div class="m-0 p-0">
                <p class="p-0 float-left" id="sub_total_item">SubTotal ( 0 items)</p>
                <p class="p-0 float-right" id="sub_total">Rs. 0000</p>
            </div>
            
            <div class="m-0 p-0">
                <p class="p-0 float-left" id="shipping_fess_title">Shipping Fess</p>
                <p class="p-0 float-right" id="shipping_fess">Rs. 145</p>
            </div>
            
            <div class="m-0 p-0">
                <p class="p-0 float-left" id="shipping_fess_dis_title">Shipping Fess Discount</p>
                <p class="p-0 float-right" id="shipping_fess_dis">Rs. 45</p>
            </div>
            <hr class="p-0 m-0">
            <div class="m-0 p-0">
                <p class="p-0 m-2 float-left">Total Amount</p>
                <p class="p-0 m-2 float-right text-danger" id="total_amount">00</p>
            </div>
            <hr class="p-0 m-0">

            <p class="p-2 mt-2 disabled bg-light">Proceed To Check Out</p>
        </div>
    </div>
    <!-- Proceed To Checkout -->
    </div>

    <script>    
        var totalPrice =  document.getElementById("totalPrice").innerHTML;
        var total_amountCont = document.getElementById("total_amount");
        total_amountCont.innerHTML = "Rs. " + totalPrice; 
    </script>

<?php

    }else {
        ?>
        <script>
            redirectTo("?page=cart_products");
        </script>
        <?php
    } 
}
?>
