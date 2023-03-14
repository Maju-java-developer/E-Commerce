<?php

    $model_rid = null;
    $cat_RID = "";
    $getCategoreis = getCategories();
    $get_product_by_Model = "";

    foreach($getCategoreis as $cat){
        if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
            if(isset($_GET['model_rid'])){

                $catName = $cat[1];
                $model_rid = $_GET['model_rid'];
                $cat_RID = get_category_ByTitle($catName)[0][4];
                
                $get_product_by_Model = get_products_ByCategoryAndModel($model_rid,$cat_RID);
                // Brand Listing SideBar Section:
                ?>
                <div class="row w-100" style="margin: 0px; padding: 2px;">
                    <!-- This Is SideBar Section  -->
                    <div class="col-xl-3 p-0 m-0 product_Category" >
                    <h4 onclick="openBrandsByCategory('brands_list_by_category');" class=" p-2 bg-info text-white" >Category</h4>
                    <ol id="brands_list_by_category">
                        <?php
                        if($getCategoreis != null){
                            for ($i=0; $i < sizeof($getCategoreis); $i++) {
                                if($getCategoreis[$i][0] == $cat[0]){
                                    ?>
                                        <li style="text-decoration: underline;"><a href='?page=<?php echo $cat[1]?>'><?php echo $getCategoreis[$i][1]?></a></li>
                                    <?php
                                }else {
                                    ?>
                                        <li><a style="color: black;" href='?page=<?php echo $cat[1]?>'><?php echo $getCategoreis[$i][1]?></a></li>
                                    <?php
                                }
                            }
                        }else {
                            ?>
                                <li><a href=''>No Have Category yet!</a></li>
                            <?php
                        }
                        ?>
                    </ol>
                </div> 
                <!-- Brand Listing SideBar Section: -->

                <!-- This Is Main Content  -->
                <?php
                    listing_products($cat[1],$get_product_by_Model);
                ?>
                <!-- This Is Main Content  -->
            </div>
            <?php
            }
        }
    }
?>