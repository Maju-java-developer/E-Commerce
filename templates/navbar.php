<?php
    
    $menuRow = getMenuRow();
    $getCategories = getCategories();

    ?>
    <!--Navbar -->
    <nav class=" navbar navbar-expand-lg navbar-dark blue-gradient sticky-top">
    <img src="resources\images\jobMe.png" class="mr-2" width="45" height="45" alt="">
    <a class="navbar-brand" href="#">JobMe Laptop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
        aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Content-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav mr-auto">
        <?php
        foreach($menuRow as $row){
            if($row[5] == "Logged_In"){
                $menuTitles = explode(',',$row[1]);
                $menuLinks = explode(',',$row[3]);

                for ($i=0; $i < sizeof($menuTitles); $i++) {
                    if(strpos($menuTitles[$i],"|") === false){
                        if($i == 0){
                            ?>
                            <!-- Menus -->
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo $menuLinks[$i] ?>"><?php echo $menuTitles[$i]?>
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <?php
                        }else {
                        ?>
                        <!-- Menus -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $menuLinks[$i] ?>"><?php echo $menuTitles[$i]?>
                            <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php
                        }
                    }else {
                        ?>
                        <!-- This Section is About Dropdown Menu-->
                        <div class="nav-item dropdown">
                        
                        <div class="nav-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </div>

                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                        <?php
                        for ($x =0; $x < sizeof($getCategories); $x++) {
                            $categoryName = $getCategories[$x][1];
                            ?>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item nav-link text-dark p-2" style="padding: 2px;" tabindex="-1" href="?page=<?php echo $categoryName ?>"><?php echo $getCategories[$x][1]?></a>
                                <div class="dropdown-menu p-3">
                                    <div class="p-2" style="width: 700px;">
                                        <h3><?php echo $categoryName ?></h3>
                                        <hr>
                                        <div class="row">
                                            <?php
                                            $getBrandsByCategory = getBrandsByCategory($getCategories[$x][4]); 
                                            for ($y=0; $y < sizeof($getBrandsByCategory); $y++) { 
                                                $brand_RID = $getBrandsByCategory[$y][5];
                                                $Category_RID = $getCategories[$x][4];
                                                $getModelsByBrands = getModelsByBrands($brand_RID,$Category_RID);

                                                if($getModelsByBrands != null){
                                                ?>
                                                <div class="col-md-3 mb-2">
                                                    <h3 style="cursor: pointer;" onclick="redirectTo('?page=<?php echo $categoryName ?>&brand_id=<?php echo $getModelsByBrands[$y][0] ?>')" ><?php echo $getBrandsByCategory[$y][1]; ?></h3>
                                                    <?php
                                                    ?>
                                                    <ul style="list-style-type: none; margin: 0px; padding: 0px;">
                                                    <?php
                                                    for ($z=0; $z < sizeof($getModelsByBrands); $z++) {
                                                        echo "<li><a class='p-0 m-0' href=' ?page=". $categoryName ."&model_rid=". $getModelsByBrands[$z][3] ." '> ". $getModelsByBrands[$z][1] ."</a></li>";
                                                    }
                                                    echo "</ul>"
                                                    ?>
                                                </div>
                                                <?php
                                                }                                                        
                                            }
                                            ?>
                                        </div>
                                        <!-- Closing Div Tagg Of Row -->
                                    </div>
                                </div>
                                <!-- Closing Div Dropdown SubMenu Tagg  -->
                            </li>
                            <!-- Closing Submenu Tagg -->
                            <?php
                        }
                        ?>
                        <!-- <li class="dropdown-submenu">
                                <a class="dropdown-item nav-link text-dark p-2" style="padding: 2px;" tabindex="-1" href="#">Laptops</a>
                         -->
                                <!-- <div class="dropdown-menu p-3">
                                    <div class="p-2" style="width: 700px;">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <h3>DELL</h3>
                                                <ul style="list-style-type: none; margin: 0px; padding: 0px;">
                                                    <li>XPS</li>
                                                    <li>Inspiron</li>
                                                    <li>Latitude</li>
                                                    <li>Vostro</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            <!-- </li> -->
                            <!-- closing here dropdown subMenu! -->

                            </ul>
                            <!-- Close Ul OF Multi Level DropDown Menu! -->
                        </div>
                        <!-- closed here Dropdown div -->

                        <?php
                    } 
                }
            }
        }
        ?>
        <!-- Profile Side Code -->
        <?php
            if(isset($_SESSION['jobme_laptop_Valid'])){
                if($_SESSION['jobme_laptop_Valid'] == true){
                    ?>
                    <ul class="navbar-nav ml-auto nav-fslex-icons">
                            <li class="nav-item">
                                <?php
                                if(isset($_SESSION['add_to_cart'])){
                                    ?>
                                        <img onclick="redirectTo('?page=cart_products');" src="resources/images/card_white.png" width="50" height="50" alt="">
                                    <?php
                                }else {
                                    ?>
                                        <img src="resources/images/card_white.png" width="50" height="50" alt="">
                                    <?php
                                } 
                                ?>
                            </li>
        
                            <li class="nav-item">
                                <a class="nav-link waves-effect waves-light">
                                <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link waves-effect waves-light">
                                <i class="fab fa-google-plus-g"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                <!-- <img class="fas fa-user"></img> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                                    <a class="dropdown-item" href="?page=user_profile">
                                        <img width="40" height="40" class="rounded-lg mr-1" src="resources\images\0.jpg" alt="">
                                        <?php echo $_SESSION['jobme_laptop_First_Name']?>
                                    </a>
                                    <a class="dropdown-item" href="?page=logout">Logout</a>
                                    <a class="dropdown-item" href="?page=favrt_Item">Favroutie</a>
                                </div>
                            </li>
                        </ul>
                    <?php
                }
            }
        ?>
        <!-- Profile Side Code -->
    </div>
    <!--/.Menu Content Close -->
    </nav>
<!--/.Navbar Close Here -->
    <?php
?>