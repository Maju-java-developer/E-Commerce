<?php    
    $catName = "";
    $brand_ID = null;

    $getCategoreis = getCategories();
    $getBrands_byCategory = "";
    
    $get_Products_ByCatAndBrand = "";

    foreach($getCategoreis as $cat){
        if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
            if(isset($_GET['brand_id'])){
                $brand_ID = $_GET['brand_id'];
                $getBrands_byCategory = getBrandsByCategory($cat[4]);

                // Brand Listing SideBar Section:
                ?>
                <div class="row w-100" style="margin: 0px; padding: 2px;">
                    <!-- This Is SideBar Section  -->
                    <div class="col-xl-3 p-0 m-0 product_Category" >
                    <h4 onclick="openBrandsByCategory('brands_list_by_category');" class=" p-2 bg-info text-white" >Brands</h4>
                    <ol id="brands_list_by_category">
                        <?php
                        if($getBrands_byCategory != null){
                            for ($i=0; $i < sizeof($getBrands_byCategory); $i++) {
                                if($getBrands_byCategory[$i][0] == $brand_ID){
                                    $get_Products_ByCatAndBrand = get_products_ByCategoryAndbrand($getBrands_byCategory[$i][5],$cat[4]);
                                    ?>
                                        <li style="text-decoration: underline;"><a href='?page=<?php echo $cat[1] . "&brand_id=".$getBrands_byCategory[$i][0] ?>'><?php echo $getBrands_byCategory[$i][1]?></a></li>
                                    <?php
                                }else {
                                    ?>
                                        <li><a style="color: black;" href='?page=<?php echo $cat[1] . "&brand_id=".$getBrands_byCategory[$i][0] ?>'><?php echo $getBrands_byCategory[$i][1]?></a></li>
                                    <?php
                                }
                            }
                        }else {
                            ?>
                                <li><a href=''>No Have Brands OF This Cateogry</a></li>
                            <?php
                        }
                        ?>
                    </ol>
                </div>
                <!-- Brand Listing SideBar Section: -->

                <!-- This Is Main Content  -->
                <?php
                    listing_products($cat[1],$get_Products_ByCatAndBrand);
                ?>
                <!-- This Is Main Content  -->
                
            </div>
            <!-- row div-->
            <?php
            }
        }
    }
?>