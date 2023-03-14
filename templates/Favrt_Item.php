<?php
    if(isset($_SESSION['add_to_favrt'])){
        $favrt_Items = explode("|",$_SESSION['add_to_favrt']);
        
        ?>
        <h2 class="row" style="width: 75%; background: #ccee; margin: 10px auto 0px auto; padding: 5px;">Your Favourite's Item</h2>
        <div class="row" style="width: 75%; background: rgb(240,240,240); margin: 0px auto 0px auto; ">
            <?php
                for ($i=0; $i < sizeof($favrt_Items); $i++) {
                    $get_product_BYID = get_products_ByID($favrt_Items[$i]); 
                    ?>  
                    <div class="col-md-3 mt-1">
                        <div class="card m-2">
                            <h3 class="bg-info p-1 text-white rounded-sm"><?php echo $get_product_BYID[0][2]?></h3>
                            <div class=" card-img">
                                <img class="card-img"  src="admin\assets\img\<?php echo $get_product_BYID[0][1]?>">
                            </div>
                            <div class="card-body">
                                <?php
                                    $product_cat = get_categoryTitle_ByRID($get_product_BYID[0][3]);
                                    if($get_product_BYID[0][9] != ""){
                                        ?>
                                            <p for="Description" onclick="javasript:window.location.href='?page=<?php echo $product_cat[0][1]?>&product_id=<?php echo $get_product_BYID[0][0]?>'" style="text-decoration: underline; cursor: pointer;"><?php echo $get_product_BYID[0][7]?></p>
                                        <?php
                                    }else {
                                        ?>
                                            <p for="Description" onclick="javasript:window.location.href='?page=<?php echo $product_cat[0][1]?>&product_id=<?php echo $get_product_BYID[0][0]?>'" style="text-decoration: underline; cursor: pointer;">No Description</p>
                                        <?php
                                    }
                                ?>
                                <p class=" text-success"><?php echo "Rs." . $get_product_BYID[0][9]?></p>

                                <div class="btn-group">
                                    <img product_id="<?php echo $get_product_BYID[0][0]?>" onclick="redirectTo('?page=request_addToCart&product_id=<?php echo $get_product_BYID[0][0]?>')" src="resources\images\card_white.png" class="addCardsetCursor rounded-lg mr-2" width="40" height="40" alt="">
                                    <img onclick="redirectTo('?page=request_addToFavrt&product_id=<?php echo $get_product_BYID[0][0]?>')" src="resources\images\favrt.png" class="addfavrt rounded-lg" width="40" height="40" alt="">
                                    <img src="resources\images\compare.png" class="campare_product rounded-lg ml-2" style="margin-top: -0px;" width="40" height="40" alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
            ?>
        <?php
    }
?>