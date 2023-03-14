<?php

$getCategoreis = getCategories();
$get_product_by_ID = "";
$get_product_variants_by_RID = "";

foreach($getCategoreis as $cat){
    $page = $_GET['page'];
    $product_id = $_GET['product_id'];
    
    if(isset($page) && $page == $cat[1]){
        if(isset($product_id)){

            $get_product_by_ID = get_products_ByID($product_id);
            $get_product_variants_by_RID = get_ProductVarint_ByRID($get_product_by_ID[0][12]);
            
            ?>
            <div class="row w-100">
                <div class="col-xl-4">
                    <div class="card m-2" style="border-radius: 10%;">
                        <img class=" w-100 h-100 bg-white" style="border-radius: 10%;" width="300" height="300" src="admin\assets\img\<?php echo $get_product_by_ID[0][1]?>">
                    </div>
                </div>

                <!-- <p class="bg-info header-title p-2"><?php echo $get_product_by_ID[0][2] ?></p> -->

                <div class="col-xl-8">
                    <div class="card mt-3">
                        <div class="card-header p-0 m-0">
                            <h3 class="header-title m-2 p-2"><?php echo $get_product_by_ID[0][2] ?></h3>
                        </div>
                    <div class="card-body">
                        <p><?php echo $get_product_by_ID[0][7] ?></p>
                        <p>More Information</p>

                        <?php
                            for ($i=0; $i < sizeof($get_product_variants_by_RID); $i++) { 
                                $productTitle = $get_product_variants_by_RID[$i][1];
                                $productValues = explode("|",$get_product_variants_by_RID[$i][2]);
                                
                                ?>
                                    <h5 class="bg-info p-2 m-1" style="border-radius: 10px; color: #fff;"><?php echo $productTitle?></h5>
                                <?php

                                for ($x=0; $x < sizeof($productValues); $x++) {
                                    ?>
                                    <ul style="list-style-type: none; padding: 10px 0px 0px 20px;">
                                    <?php
                                    if(strtolower($productTitle) == strtolower("Color") || strtolower($productTitle . " ") == strtolower("Color ") || strtolower(" " . $productTitle) == strtolower(" Color") || strtolower(" " . $productTitle . " ") == strtolower(" Color ")){
                                    ?>
                                        <div title="<?php echo $productValues[$x]; ?>" style="background: <?php echo $productValues[$x]; ?>; border-radius: 100%; width: 25px; height: 25px; float: left; margin-right: 10px;">&nbsp;</div><li><?php echo $productValues[$x]?></li>
                                        <?php
                                    }else{
                                        ?>
                                        <li title="<?php echo $productValues[$x]; ?>"><?php echo $productValues[$x]?></li>
                                        <?php
                                    }
                                        ?>
                                    </ul>
                                    <?php
                                }
                            }
                        ?>

                        <div class="btn-group">
                            <div onclick="window.location.href='?page=product_buy&product_id=<?php echo $_GET['product_id']?>'" class="actionOnAddCard mr-2">
                                <img src="resources\images\card_white.png" class="addCardsetCursor float-left rounded-lg mr-2" width="50" height="50" alt="">
                                <p class="mt-3 float-left">Buy Now</p>
                            </div>

                            <div onclick="window.location.href='?page=request_addToCart&product_id=<?php echo $_GET['product_id']?>'" class="actionOnAddCard">
                                <img src="resources\images\card_white.png" class="addCardsetCursor float-left rounded-lg mr-2" width="50" height="50" alt="">
                                <p class=" mt-3 float-left">Add To Card</p>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
