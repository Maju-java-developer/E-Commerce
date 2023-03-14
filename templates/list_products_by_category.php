<?php
    $catName = "";
    $cat_RID = "";
    
    $getCategoreis = getCategories();
    $getBrands_byCategory = "";

    foreach($getCategoreis as $cat){
    if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
        $catName = $cat[1];
        $cat_RID = get_category_ByTitle($catName)[0][4];

        $getBrands_byCategory = getBrandsByCategory($cat[4]);
        $getproducts_byCategory = get_products_ByCategory($cat_RID);

        ?>
        <div class="row w-100" style="margin: 0px; padding: 2px;">
            <!-- This Is SideBar Section -->
            <div class="col-xl-3 p-0 m-0 product_Category" >
                <h4 onclick="openBrandsByCategory('brands_list_by_category');" class=" p-2 bg-info text-white" >Brands</h4>
                <ol id="brands_list_by_category">
                <?php
                if($getBrands_byCategory != null){
                    for ($x=0; $x < sizeof($getBrands_byCategory); $x++) {
                        ?>
                            <li><a href='?page=<?php echo $catName . "&brand_id=".$getBrands_byCategory[$x][0] ?>'><?php echo $getBrands_byCategory[$x][1]?></a></li>
                        <?php
                    }
                }else {
                    ?>
                        <li><a href=''>No Have Brands OF This Cateogry</a></li>
                    <?php
                }
                ?>
                </ol>
            </div>

            <!-- This Is Main Content  -->
            <?php
                listing_products($cat[1],$getproducts_byCategory);
            ?>
            <!-- This Is Main Content  -->

        </div>
        <?php
        }
    }

?>