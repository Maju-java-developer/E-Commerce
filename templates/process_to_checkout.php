<?php 
    $payentMethods = array(
        "Pay VIA VISA Creadit / Debit Card",
        "Pay Using Bank Tranfer",
        "Cash On Delivery"
    );

    $payentMethodsLinks = array(
        "Pay_VIA_VISA_Creadit_Or_Debit_Card",
        "Pay_Using_Bank_Tranfer",
        "Cash_On_Delivery"
    );

    $orderInfo = "";

    if(isset($_GET['page']) && $_GET['page'] == "proceed_to_checkout"){
        if(isset($_GET['ItemIDs']) && isset($_GET['ItemQTY']) && isset($_GET['totalPrice'])){
        $orderInfo = "&ItemIDs=". $_GET['ItemIDs'] . "&ItemQTY=" . $_GET['ItemQTY'] . "&totalPrice=" . $_GET['totalPrice'];
        echo $orderInfo;
        ?>
        <div class="row" style="width: 98%; margin: auto;">
            <!-- Payment Method ! -->
            <div class="col-xl-8 p-2 m-2" style=" height: 270px; background: rgb(222,222,222);"> 
                <div class="card" style="margin-bottom: 20px;">
                    <h3 class="m-3 ">Payment Method</h3>
                    <?php
                        for ($i=0; $i < sizeof($payentMethods); $i++) {
                            if(isset($_SESSION['jobme_laptop_Valid'])){
                                if($_SESSION['jobme_laptop_Valid'] == true){
                                    ?>
                                        <div onclick="redirectTo('?page=delivery_information&paymentMethod=<?php echo $payentMethodsLinks[$i] .$orderInfo  ?>')" class="selectpaymentMethod p-3 text-white" style="margin: 1px 10px 5px 10px;">
                                            <?php  echo $payentMethods[$i]?>
                                        </div>
                                    <?php
                                }
                            }else {
                                ?>
                                    <div onclick="redirectTo('?page=login')" class="selectpaymentMethod p-3 text-white" style="margin: 1px 10px 5px 10px;">
                                        <?php  echo $payentMethods[$i]?>
                                    </div>
                                <?php
                            }
                        
                        }
                    ?>            
                </div>
            </div>
            <!-- Payment Method -->

            <div id="totalPrice" hidden>
                <?php echo $_GET['totalPrice']?>
            </div>

            <!-- Order Summery -->
            <div class="col-xl-3 p-2 m-2 " style="background: rgb(222,222,222); height:  345px;">
                <div class="card p-1 shadow-lg rounded-lg">
                    <p class="p-2 bg-light text-black-50 processToCheckOut" style="display: disab;">Proceed To Pay</p>
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

                    <p class="p-2 mt-2 bg-light text-black-50 processToCheckOut" style="display: disab;">Proceed To Pay</p>
                </div>
            </div
            >
            <!-- Order Summery -->
            <script>    
                var totalPrice =  document.getElementById("totalPrice").innerHTML;
                var total_amountCont = document.getElementById("total_amount");
                total_amountCont.innerHTML = "Rs. " + totalPrice; 
            </script>

        </div>
    <?php
    }else {
        ?>
            <script>
                window.location.href = "?page=cart_products";
            </script>
        <?php
    }
}
?>