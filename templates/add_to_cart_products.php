<script>

    if(performance.navigation.type == 2){
        location.reload(true);
    }

</script>

<div class="row" style="width: 98%; margin: auto;">
    <!-- listIng wishlist Product! -->
    <div class="col-xl-8 p-2 m-2" style="background: rgb(222,222,222);"> 
    <div class="bg-white w-100">
        <input onchange="selectAll(this);" class="p-2 float-left" style="margin: 13.4px;" type="checkbox">
        <p class="p-2">Select All</p>
    </div>
    
    <script>var elements = [];</script>
    <?php
    if(isset($_SESSION['add_to_cart'])){
        ?>

        <script>var orderCount = 0;</script>

        <?php
        $add_to_cart_products = explode("|" , $_SESSION['add_to_cart']);
        for($i = 0; $i < sizeof($add_to_cart_products); $i++){
            $getProductsByID = get_products_ByID($add_to_cart_products[$i]);
            $imagePath = $getProductsByID[0][1];
            ?>
            <div class="count" hidden>
                <?php echo $i; ?>
            </div>
            <script>
                orderCount = document.getElementsByClassName("count").length;
                // alert(orderCount);
            </script>
            <div id="orderID_<?php echo $i; ?>" hidden><?php echo $getProductsByID[0][0]; ?></div>

            <div class="card-group" pid="<?php echo $getProductsByID[0][0]; ?>" id="<?php echo $getProductsByID[0][0]; ?>">
                <div class="card mb-1 rounded-lg">
                    <div class="card-body m-0 p-0">
                        <div id="item_qty_alert_<?php echo $i?>" class="p-2 alert-success" style="margin: 3px; display: none">
                        </div>
                        <div class="card-image float-left">
                            <input class="p-1 ml-3" id="checked_item_<?php echo $i?>" price="<?php echo $getProductsByID[0][9]?>" onchange="getCheckedStatus(this,<?php echo $i?>);" type="checkbox">
                            <img src="admin/assets/img/<?php echo $imagePath ?>" class="mr-3 p-3" style="width: 100px; height: 100px; " alt="">
                        </div>

                        <div class="float-left">
                            <p class="p-1 m-2"><?php echo $getProductsByID[0][2]?></p>
                            <p class="p-0 m-0 ml-2"><?php echo $getProductsByID[0][7]?></p>
                            <p class="p-1 ml-2 text-success" id="item_price_<?php echo $i?>"><?php echo "Price: " . $getProductsByID[0][9] . " Pkr"?></p>
                        </div>

                        <div class="float-right p-4 m-3">
                        <button onclick="sub_item('<?php echo $i ?>')" id="sub_btn_<?php echo $i?>" class="rounded-lg border-0 pl-2 pr-2 ">-</button>
                        <input onchange="checkQty(this)" onkeyup="getCheckedStatusQty(this,<?php echo $i?>,<?php echo $getProductsByID[0][11]?>);" id="item_qty_<?php echo $i?>" style="width: 45px; padding-left: 2px; margin: 4px;" class="rounded-lg border-0" value="1" type="number" price="<?php echo $getProductsByID[0][9]; ?>">
                        <button onclick="add_item(<?php echo $i ?>, <?php echo $getProductsByID[0][11]?>)" id="add_btn_<?php echo $i?>" class="rounded-lg border-0">+</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
        }
        ?>

        <script>
        var currentElement;
        // alert("Order Count: " + orderCount);
        for(var i = 0; i < (orderCount); i++){
            currentElement = document.getElementById("orderID_" + i);
            elements.push(currentElement);
        }
        </script>
        <?php
    }
    ?>
    </div>
    <!-- listIng wishlist Product! -->

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

            <!-- <p class="p-2 mt-2 processToCheckOut" onclick="redirectTo('?page=proceed_to_checkout&order=<?php // echo $orderItems; ?>');">Proceed To Check Out</p> -->
            <p class="p-2 mt-2 processToCheckOut" onclick="redirectOrdersTo('?page=proceed_to_checkout', elements)">Proceed To Check Out</p>
        </div>
    </div>
    <!-- Proceed To Checkout -->
    <?php
?>
</div>
