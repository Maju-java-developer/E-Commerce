<?php
    $catName = "";
    $cat_RID = "";
    
    $getCategories = "";
    $get_products = "";
    foreach($getCategoreis as $cat){
    if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
        $catName = $cat[1];
        $cat_RID = get_category_ByTitle($catName)[0][4];

        $getCategories = getCategories();
        $get_products = get_products();

        ?>
        <div class="row w-100" style="margin: 0px; padding: 2px;">
            <!-- This Is SideBar Section -->
            <div class="col-xl-3 p-0 m-0 product_Category" >
                <h4 onclick="openBrandsByCategory('brands_list_by_category');" class=" p-2 bg-info text-white" >Categories</h4>
                <ol id="brands_list_by_category">
                <?php
                if($getCategories != null){
                    for ($x=0; $x < sizeof($getCategories); $x++) {
                        if($getCategoreis[$x][1] == $catName){
                            ?>
                                <li style="text-decoration: underline;"><a href='?page=<?php echo $getCategoreis[$x][1]?>'><?php echo $getCategories[$x][1]?></a></li>
                            <?php
                        }else{
                            ?>
                                <li><a href='?page=<?php echo $getCategories[$x][1] ?>'><?php echo $getCategories[$x][1]?></a></li>
                            <?php
                        }
                    }
                }else {
                    ?>
                        <li><a href=''>No Have Category OF This Cateogry</a></li>
                    <?php
                }
                ?>
                </ol>
            </div>

            <!-- This Is Main Content  -->
            <?php 
                listing_products($cat[1],$get_products);
            ?>
            <!-- This Is Main Content  -->

        </div>
        <?php
        }
    }

?>