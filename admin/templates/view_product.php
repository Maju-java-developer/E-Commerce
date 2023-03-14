<?php
    $get_product = "";
    // This is section of Viewing Products Information:
    if(isset($_GET['page']) && $_GET['page'] == "view_product"){
        if(isset($_GET['product_id'])){
            $get_product = get_products_ByID($_GET['product_id']);
            $get_variants = get_ProductVarint_ByRID($get_product[0][12]);
            
            ?>
            <div class="col-xl-12 bg-default">
                <div class="card">
                    <div class="card-body p-0 m-0">
                        <p class="m-2 float-left">Product ID = <?php echo $get_product[0][0]?></p>
                        <p class="m-2 float-right">Created_Date: <?php echo $get_product[0][13]?></p>
                    </div>
                </div>

                <div class=" col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-left col-md-3"> 
                                <img src="<?php echo $imagesPath.$get_product[0][1]?>" style="width: 100% !important; height: 200px !important; object-fit: cover; border-radius: 10px; margin-bottom: 40px;" alt="">
                            </div>
                            <div class="float-left col-md-4 p-1 m-0">
                                <p class="p-1 m-0">Product Title: <?php echo $get_product[0][2]?></p>
                                <p class="p-1 m-0">Product Sub Category: <?php echo get_sub_Cat_ByRID($get_product[0][4])[0][1];?></p>
                                <p class="p-1 m-0">Product Brand: <?php echo get_brand_ByRID($get_product[0][5])[0][1];?></p>
                                <p class="p-1 m-0">Product Model: <?php echo get_Model_ByRID($get_product[0][6])[0][1];?></p>
                                <p class="p-1 m-0">Product Description: <?php echo $get_product[0][7]?></p>
                            </div>

                            <div class="float-left col-md-5 p-1 m-0">
                                <p class="p-1 m-0">Product Category: <?php echo get_categoryTitle_ByRID($get_product[0][3])[0][1];?></p>
                                <p class="p-1 m-0">Product Parchasing Price: <?php echo $get_product[0][8]?></p>
                                <p class="p-1 m-0">Product Selling Price: <?php echo $get_product[0][9]?></p>
                                <p class="p-1 m-0">Product Margin: <?php echo $get_product[0][10]?></p>
                                <p class="p-1 m-0">Product Quantity: <?php echo $get_product[0][11]?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="p-0 m-0 mb-3">Product Variants Values</h5>
                            <?php 
                            if($get_variants != null){
                                for ($i=0; $i < sizeof($get_variants); $i++) { 
                                ?>
                                    <h5 class="bg-info p-2 mb-1 text-light" onclick="openVariantsValues('variants_title_<?php echo $i?>');" style="border-radius: 10px;"><?php echo $get_variants[$i][1]?></h5>
                                    <ol id="variants_title_<?php echo $i?>" style="display: none;">
                                        <?php
                                            $varinats_values = explode("|",$get_variants[$i][2]); 
                                            for ($x=0; $x < sizeof($varinats_values); $x++) { 
                                                echo "<li>$varinats_values[$x]</li>";   
                                            }
                                        ?>
                                    </ol>
                                <?php
                                }
                            }else {
                                ?>
                                    <h5 class=" bg-danger p-3 mb-1 text-light" style="border-radius: 10px;">No Have Varinats Of This Products</h5>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }else {
            echo "<script>redirectTo('". $_SERVER['PHP_SELF'] ."?page=error&errorCode=9');</script>";
        }
    }
    // ---------------------------------------------------
    // This is section of Viewing Products Information:
    // ---------------------------------------------------

    // ---------------------------------------------------------
    // This is section of Viewing Order's Person Information:
    // ---------------------------------------------------------

    if(isset($_GET['page']) && $_GET['page'] == "view_orders_details"){
        if(isset($_GET['user_id'])){

            $user_ID = $_GET['user_id'];
            $get_user_info = get_userBYID($user_ID);
            $get_address_info = get_Address_ByUserID($user_ID);
            $get_order_info = get_orders_ByUserID($user_ID);

            ?>
            <div class="col-xl-12 bg-default">
                <div class="card">
                    <div class="card-body p-0 m-0">
                        <p class="m-2 float-left">User ID = <?php echo $_GET['user_id']?></p>
                    </div>
                </div>

                <div class=" col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-left col-md-3"> 
                                <img src="../resources/images/JobME.png" style="width: 100% !important; height: 200px !important; object-fit: cover; border-radius: 10px; margin-bottom: 40px;" alt="">
                            </div>
                            <div class="float-left col-md-4 p-1 m-0">
                                <p class="p-1 m-0">User Name: <?php echo $get_user_info[0][1]." ".$get_user_info[0][2]?></p>
                                <p class="p-1 m-0">Gmail: <?php echo $get_user_info[0][3]?></p>
                                <p class="p-1 m-0">Total Item: <?php echo "10";?></p>
                                <p class="p-1 m-0">Total Price : <?php echo "20000 pkr"?></p>
                            </div>
                            <?php

                            if($get_address_info != null){
                                $phoneNumber = $get_address_info[0][3];
                                $city = $get_address_info[0][5];
                                $area = $get_address_info[0][6];
                                $billing_addreess = $get_address_info[0][7];
                                $delivery_addreess = $get_address_info[0][8];
                            }else{
                                $phoneNumber = "No Contact Yet Added!";
                                $city = "No City Yet Added!";;
                                $area = "No Area Yet Added!";
                                $billing_addreess = "No Billing Addrees Yet Added!";
                                $delivery_addreess = "No Delivery Address Yet Added!";;
                            }

                            ?>
                            <div class="float-left col-md-5 p-1 m-0">
                                <p class="p-1 m-0">Phone Number: <?php echo $phoneNumber?></p>
                                <p class="p-1 m-0">City: <?php echo $city?></p>
                                <p class="p-1 m-0">Area: <?php echo $area?></p>
                                <p class="p-1 m-0">Billing_Address: <?php echo $billing_addreess?></p>
                                <p class="p-1 m-0">Delivery_Infomation: <?php echo $delivery_addreess?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Personal Information -->

                <!-- Listing Order Details  -->
                <?php

                if($get_order_info != null){
                    $orders_Heading = array("ID", "Product Image","Product Name","Product Category","QTY","Date","Status");
                    ?>
                    <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <?php
                            for ($i=0; $i < sizeof($orders_Heading); $i++) { 
                                echo "<th>$orders_Heading[$i]</th>";
                            }
                            ?>
                            <td class="float-right">
                                Action
                            </td>
                            <?php
        
                        ?>
                        </thead>
                        <tbody>
                        <?php
                            for ($i=0; $i < sizeof($get_order_info); $i++) {
                                $get_products = get_products_ByID($get_order_info[$i][2]); 
                                
                                $productImagePath = "";
                                if($get_products[0][1] != "Array"){
                                    $productImagePath = $get_products[0][1] . "";
                                }else {
                                    $productImagePath = "No Image";
                                }
                                
                                echo "<tr>
                                <td>". $get_products[0][0]." </td>
                                <td><img width='35' height='37' src='". $imagesPath.$productImagePath ."'></td>
                                <td>". $get_products[0][2]." </td>
                                <td>". get_categoryTitle_ByRID($get_products[0][3])[0][1] ."</td>
                                <td>". $get_order_info[$i][3]." </td>
                                <td>". $get_order_info[$i][4]." </td>";

                                $status = ["-- None --", "Pending", "Dispatched", "On The Way", "Delivered"];

                                ?>
                                <script>
                                    function updateOrderStatus(element){
                                        var status_val = $(element).val();
                                        var order_id = $(element).attr("order_id");
                                        var user_id = $(element).attr("user_id");
                                        
                                        redirectTo("?page=update_order_status&status="+status_val+"&order_id="+order_id+"&user_id="+user_id);
                                    }
                                </script>

                                <td><select user_id="<?php echo $_GET['user_id']?>" order_id="<?php echo $get_order_info[$i][0]?>" onchange="updateOrderStatus(this);">
                                <?php
                                foreach($status as $values){
                                    if($get_order_info[$i][5] == $values){
                                        echo "<option selected>". $values ."</option>";
                                    }else{
                                        echo "<option>". $values ."</option>";
                                    }
                                }
                                ?>
                                </select></td>
                                <?php

                                // <td>". $get_orders[$i][5]." </td>";
                                    ?>  
                                    <td class="float-right">
                                        <span class="material-icons" style="cursor: pointer;" > 
                                            create
                                        </span>
                                        <span class="material-icons" style="cursor: pointer;" data-toggle="modal" data-target="#delete_order_<?php echo $get_order_info[$i][0]?>">
                                            delete
                                        </span>

                                        <!-- Confirm Modal For Delete Product -->
                                        <div class="modal fade" id="delete_order_<?php echo $get_order_info[$i][0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">DELETE ORDER: <?php echo $get_order_info[$i][0]?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Are u sure to delete it?</label>
                                                </div>                        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                                <button type="button" class="btn btn-primary" onclick="redirectTo('?page=delete_order&order_id=<?php echo $get_order_info[$i][0].'&user_id='.$_GET['user_id']  ?>');" >YES</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- Confirm Modal For Delete Product -->

                                    </td>                            
                                    <?php
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>
            </div>
            <?php

        }else {
            echo "<script>redirectTo('". $_SERVER['PHP_SELF'] ."?page=error&errorCode=9');</script>";
        }
    }
    // ---------------------------------------------------------
    // This is section of Viewing Order's Person Information:
    // ---------------------------------------------------------
    
?>

