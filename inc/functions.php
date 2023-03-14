<?php

    // Add Select Item Into Cart!  
    function addToCart($sessNam, $sessVal){
        if(isset($_SESSION[$sessNam])){
            if($_SESSION[$sessNam] == null || $_SESSION[$sessNam] == ""){
                $_SESSION[$sessNam] = $sessVal;
            }else{
                foreach(explode("|", $_SESSION[$sessNam]) as $tempVal){
                    if($sessVal == $tempVal){
                        // header("Location:?page=exit");
                        if(isset($_SESSION['jobme_laptop_Valid'])){
                            if ($_SESSION['jobme_laptop_Valid'] == true){
                                header('Location: ?page=cart_products');
                            }
                        }else {
                            header('Location: ?page=login');
                        }
                        exit();
                    }
                }
                $_SESSION[$sessNam] = $_SESSION[$sessNam] . "|" . $sessVal;
            }
        }else{
            $_SESSION[$sessNam] = $sessVal;
        }
    }
    // Add Select Item Into Cart!

    function addToCheckedItem($sessNam, $sessVal){
        if(isset($_SESSION[$sessNam])){
            if($_SESSION[$sessNam] == null || $_SESSION[$sessNam] == ""){
                $_SESSION[$sessNam] = $sessVal;
            }else{
                foreach(explode("|", $_SESSION[$sessNam]) as $tempVal){
                    if($sessVal == $tempVal){
                        header('Location: ?page=cart_products');
                        exit();
                    }
                }
                $_SESSION[$sessNam] = $_SESSION[$sessNam] . "|" . $sessVal;
            }
        }else{
            $_SESSION[$sessNam] = $sessVal;
        }
    }

    // GetHeaderImage 
    function get_headersImg(){
        $conn = connect();
        $query = "SELECT * FROM header ORDER BY Created_At LIMIT 3;";

        $headerResult = $conn->query($query) or die($conn->error);
        $headerRow = $headerResult->fetch_all(PDO::FETCH_ASSOC);

        return $headerRow;
    }

    // Method Of Upload File
    function upload_file($imageName, $imagePath){
        $errors = array();
        $file_name = $_FILES[$imageName]['name'];
        $file_size = $_FILES[$imageName]['size'];
        $file_tmp = $_FILES[$imageName]['tmp_name'];
        $file_type = $_FILES[$imageName]['type'];

        $extension = array("png","jpg","jpeg");
        
        $fileExlodeExtension = explode(".",$_FILES[$imageName]['name']);

        $file_ext = strtolower(end($fileExlodeExtension));

        if(in_array($file_ext, $extension) == false){
            $errors[] = "extension not allowed, please choose a jpg jpeg or png image!"; 
            // $errors[] = "extension not allowed, please choose a jpg jpeg or png image!"; 
        }

        if($file_size > 5000000){
            $errors[] = "File size must be excately 2 MB!";
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp,$imagePath.$file_name);
            return $file_name;
        }else {
            return $errors;
        }
    }

    function alert($title){
        ?>
            <script>
                alert("<?php echo $title ?>");
            </script>
        <?php
    }
    // 
    function SetHeaderTitleByPage(){
        if(isset($_GET['page'])){
            $page = $_GET['page'];
            if($page == "login"){
                $title = "Login";
            }
            else if($page == "register"){
                $title = "Register";
            }
            else if($page == "home"){
                $title = "Home";
            }
            else if($page == "register_profile"){
                $title = "Register_Profile";
            }
            else if($page == "main"){
                $title = "Main";
            }
        }else {
            $title = "Login";
        }

        
        $getCategoreis = getCategories();
        foreach($getCategoreis as $cat){
            if(isset($_GET['page']) && $_GET['page'] == $cat[1]){
                $title = $_GET['page'];
            }
        }

        return $title;
    }

    // Add Product
    function add_product($product_image,$product_title,$product_desc,$product_cat,$brand_RID,$model_RID,$product_sub_cat,$product_parching_price,$product_selling_price,$product_margin,$product_Qty,$product_RID){
        $conn = connect();
        $add_product_query = "INSERT INTO products (
            Product_Image,            
            Product_Title,
            Product_Description,
            Product_Category,
            Brand_RID,
            Model_RID,
            Product_Sub_Category,
            Product_Purchasing_Price,
            Product_Selling_Price,
            Product_Margin,
            Product_Qty,
            Product_RID,
            Created_At
            )VALUES(
            '". $product_image ."',
            '". $product_title ."',
            '". $product_desc ."',
            '". $product_cat ."',
            '". $brand_RID ."',
            '". $model_RID ."',
            '". $product_sub_cat ."',
            '". $product_parching_price ."',
            '". $product_selling_price ."',
            '". $product_margin ."',
            '". $product_Qty ."',
            '". $product_RID ."',
            NOW()
        );";

        $add_qty_query = "INSERT INTO quantities (
            Product_RID,
            Quantity,
            Quantity_Alert,
            Created_At
            )VALUES(
            '". $product_RID ."',
            '". $product_Qty ."',
            3,
            NOW()
        )";

        if($conn->query($add_product_query) && $conn->query($add_qty_query) or die ("Query Error: " .$conn->error)){
            echo "
            <script>
                window.location.href='?page=list_product'
            </script>";
        }else {
            echo "something Wrong!";
        }     
    }

    // Update Product All Fields
    function update_productAll($product_image,$product_title,$product_desc,$product_cat,$brand_RID,$model_RID,$product_sub_cat,$product_parching_price,$product_selling_price,$product_margin,$product_Qty){
        if(isset($_COOKIE['product_id']) && isset($_COOKIE['productRelID'])){
            $pid = $_COOKIE['product_id'];
            $pRelId = $_COOKIE['productRelID'];
            $conn = connect();

            $update_query = "UPDATE products SET 
            Product_Image = '". $product_image ."',            
            Product_Title = '". $product_title ."',
            Product_Description = '". $product_desc ."',
            Product_Category = '". $product_cat ."',
            Brand_RID = '". $brand_RID ."',
            Model_RID = '". $model_RID ."',
            Product_Sub_Category = '". $product_sub_cat ."',
            Product_Purchasing_Price = '". $product_parching_price ."',
            Product_Selling_Price = '". $product_selling_price ."',
            Product_Margin = '". $product_margin ."',
            Product_Qty = '". $product_Qty ."' 
            WHERE PID = $pid 
            AND Product_RID = '". $pRelId ."'";

            if($conn->query($update_query) or die ("Query Error: " .$conn->error)){
                echo "
                <script>
                    window.location.href='?page=list_product'
                </script>";
            }else {
                echo "something Wrong!". $conn->error;
            }     
    
        }        
    }

    // Update Product All Fields
    function update_product_WithoutImage($product_title,$product_desc,$product_cat,$brand_RID,$model_RID,$product_sub_cat,$product_parching_price,$product_selling_price,$product_margin,$product_Qty){
        if(isset($_COOKIE['product_id']) && isset($_COOKIE['productRelID'])){
            $pid = $_COOKIE['product_id'];
            $pRelId = $_COOKIE['productRelID'];
            $conn = connect();

            $update_query = "UPDATE products SET 
            Product_Title = '". $product_title ."',
            Product_Description = '". $product_desc ."',
            Product_Category = '". $product_cat ."',
            Brand_RID = '". $brand_RID ."',
            Model_RID = '". $model_RID ."',
            Product_Sub_Category = '". $product_sub_cat ."',
            Product_Purchasing_Price = '". $product_parching_price ."',
            Product_Selling_Price = '". $product_selling_price ."',
            Product_Margin = '". $product_margin ."',
            Product_Qty = '". $product_Qty ."' 
            WHERE PID = $pid 
            AND Product_RID = '". $pRelId ."'";

            if($conn->query($update_query) or die ("Query Error: " .$conn->error)){
                echo "
                <script>
                    window.location.href='?page=list_product'
                </script>";
            }else {
                echo "something Wrong!". $conn->error;
            }     
    
        }        
    }

    // Delete_product Accourding To Product_ID;
    function delete_product(){
        if(isset($_GET['product_id']) && isset($_GET['product_rid'])){
            $product_ID = $_GET['product_id'];
            $product_RID = $_GET['product_rid'];
            
            $conn = connect();
            $delete_product_query = "DELETE FROM products WHERE PID = $product_ID ;";
            $delete_product_varinat_query = "DELETE FROM variants WHERE Variant_RID = '". $product_RID ."' ;";
            
            if($conn->query($delete_product_query) && $conn->query($delete_product_varinat_query) or die ("Query Error: " .$conn->error)){
                echo "<script>window.location.href='?page=list_product'</script>";
            }else {
                echo "Something went Wrong!";
            }
        }else {
            echo "Something went Wrong in parameters!";
        }
    }

    // Getting Products
    function get_products(){
        $conn = connect();
        $get_product_query = "SELECT * FROM products LIMIT 0,40;";

        $productResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $productsRow = $productResult->fetch_all(PDO::FETCH_ASSOC);

        return $productsRow;
    }

    // Getting Products Info By Product ID!
    function get_products_ByID($id){
        $conn = connect();
        $get_product_query = "SELECT * FROM products WHERE PID = $id;";

        $productResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $productsRow = $productResult->fetch_all(PDO::FETCH_ASSOC);

        return $productsRow;
    }

    // Getting Products Info By Product Category!
    function get_products_ByCategory($category_RID){
        $conn = connect();
        $get_product_query = "SELECT * FROM products WHERE Product_Category = '". $category_RID. "' ORDER BY Created_At LIMIT 40;";

        $productResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $productsRow = $productResult->fetch_all(PDO::FETCH_ASSOC);

        return $productsRow;
    }

    // Getting Products Info By Product Accourding Brand RID!
    function get_products_ByCategoryAndbrand($brand_RID,$cat_RID){
        $conn = connect();
        $get_product_query = "SELECT * FROM products WHERE
            Brand_RID = '". $brand_RID . "' 
            AND  
            Product_Category = '". $cat_RID ."' ORDER BY Created_At LIMIT 40;
        ";

        $productResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $productsRow = $productResult->fetch_all(PDO::FETCH_ASSOC);

        return $productsRow;
    }

    // Getting Products Info By Accourding Product Category & Model_RID!
    function get_products_ByCategoryAndModel($model_RID,$cat_RID){
        $conn = connect();
        $get_product_query = "SELECT * FROM products WHERE
            Model_RID = '". $model_RID . "' 
            AND  
            Product_Category = '". $cat_RID ."' ORDER BY Created_At LIMIT 40;
        ";

        $productResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $productsRow = $productResult->fetch_all(PDO::FETCH_ASSOC);

        return $productsRow;
    }
    
    function listing_products($cat_Name,$get_product){
        ?>
        <div class="col-xl-9">
        <p style="font-size: 4rem;"><?php echo $cat_Name?></p>
        <p> <?php echo ""?> Items 1-45 of 50</p>
        <hr>

        <div class="row">
            <?php
                if($get_product != null){
                    for ($i=0; $i < sizeof($get_product); $i++) {
                    ?>  
                    <div class="col-md-3">
                        <div class="card m-2">
                            <h3 class="bg-info p-1 text-white rounded-sm"><?php echo $get_product[$i][2]?></h3>
                            <div class=" card-img">
                                <img class="card-img"  src="admin\assets\img\<?php echo $get_product[$i][1]?>">
                            </div>
                            <div class="card-body">
                                <?php
                                    $product_cat = get_categoryTitle_ByRID($get_product[$i][3]);
                                    if($get_product[$i][9] != ""){
                                        ?>
                                            <p for="Description" onclick="javasript:window.location.href='?page=<?php echo $product_cat[0][1]?>&product_id=<?php echo $get_product[$i][0]?>'" style="text-decoration: underline; cursor: pointer;"><?php echo $get_product[$i][7]?></p>
                                        <?php
                                    }else {
                                        ?>
                                            <p for="Description" onclick="javasript:window.location.href='?page=<?php echo $product_cat[0][1]?>&product_id=<?php echo $get_product[$i][0]?>'" style="text-decoration: underline; cursor: pointer;">No Description</p>
                                        <?php
                                    }
                                ?>
                                <p class=" text-success"><?php echo "Rs." . $get_product[$i][9]?></p>

                                <div class="btn-group">
                                    <img product_id="<?php echo $get_product[$i][0]?>" onclick="redirectTo('?page=request_addToCart&product_id=<?php echo $get_product[$i][0]?>')" src="resources\images\card_white.png" class="addCardsetCursor rounded-lg mr-2" width="40" height="40" alt="">
                                    <img onclick="redirectTo('?page=request_addToFavrt&product_id=<?php echo $get_product[$i][0]?>')" src="resources\images\favrt.png" class="addfavrt rounded-lg" width="40" height="40" alt="">
                                    <img src="resources\images\compare.png" class="campare_product rounded-lg ml-2" style="margin-top: -0px;" width="40" height="40" alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }else {
                    ?>
                        <div class="p-3 m-1 bg-danger w-100">We have couldn't find products of your wishist</div>
                    <?php
                }
            ?>
        </div>
       <?php
    }

    // Add Variants 
    function add_variants($variants_RID,$variants_title,$variants_desc,$variants_values){
        $conn = connect();

        $variantTitleArr = explode(':', $variants_title);
        $variantValuesArr = explode(':', $variants_values);
        $variantDescArr = explode(':', $variants_desc);

        $success = false;

        for($i = 0; $i < (sizeof($variantTitleArr)-1); $i++){
            $query = "INSERT INTO variants(
                Variant_Title,
                Variant_Description,
                Variant_Values,
                Variant_RID,
                Created_At)VALUES(
                '". $variantTitleArr[$i] ."',
                '". $variantDescArr[$i] ."',
                '". $variantValuesArr[$i] ."',
                '". $variants_RID ."',
                NOW()
            );";
    
            if($conn->query($query) or die ("Query Error: " .$conn->error)){
                // echo "<script>window.location.href='?page=list_product'</script>";
                if($i >= (sizeof($variantTitleArr)-2)){
                    $success = true;
                }
            }else {
                // echo "Something Wrong!";
            }
        }

        if($success){
            echo "<script>window.location.href='?page=list_product&status=exit'</script>";
        }
    }

    // Delete Varinats:
    function delete_variants($variants_RID, $data){
        $conn = connect();

        // $data = "Size_12x14 : Color_RED|GREEN|BLUE:";
        $mainData = explode(":",$data);
        $success = false;
        for($i = 0; $i < (sizeof($mainData)-1); $i++){
    
            $subvalues = explode("_", $mainData[$i]);

            $query = "DELETE FROM variants WHERE 
            Variant_Title = '". $subvalues[0] ."' 
            AND 
            Variant_Values = '". $subvalues[1] ."'  
            AND 
            Variant_RID = '". $variants_RID ."'";

            if($conn->query($query) or die ("Query Error: " .$conn->error)){
                // echo "<script>window.location.href='?page=list_product'</script>";
                if($i >= (sizeof($mainData)-2)){
                    $success = true;
                }
            }else {
                // echo "Something Wrong!";
            }
        }

        if($success){
            echo "<script>window.location.href='?page=list_product&status=exit'</script>";
        }
    }

    // Making Hand ALert Message
    function alert_Message($page,$errorTitle,$alertMessage){
        if(isset($_GET[$page])){
            if($_GET[$page] == $errorTitle){
                ?>
                    <div class=" alert-danger">
                        <p style="padding: 1.2%;"><?php echo $alertMessage ?></p>
                    </div>
                <?php   
            }
        }
    }

    // Generating_RalationID For Every Single Recrod!
    function generate_RID(){
        $randomiseOne = rand(0,99999); 
        $randomiseTwo = rand(0,9999); 
        $randomiseThree = rand(0,99999); 
        $randomiseFour = rand(0,999999); 
                
        $randomiseExtra = rand(0,500);

        $generate_RID = "RID_".$randomiseOne ."_". $randomiseTwo ."_". $randomiseThree. "_". $randomiseFour. "_". $randomiseExtra;  
        return $generate_RID;
    }

    // Creating Selecting Value
    function create_Select($phpID,$javascriptID,$data){
        ?>
            <select name="<?php echo $phpID?>" id="<?php echo $javascriptID?>" class="form-control">
                <?php
                    for ($i=0; $i < sizeof($data); $i++) { 
                        echo "<option>".$data[$i][1]. "</option>";
                    }
                ?>
            </select>
        <?php
    }

    function create_SelectedOptions($phpID, $javascriptID, $data, $selected){
        ?>
            <select name="<?php echo $phpID?>" id="<?php echo $javascriptID?>" class="form-control">
                <?php
                    for ($i=0; $i < sizeof($data); $i++) {
                        if($data[$i][1] == $selected){
                            echo "<option selected>".$data[$i][1]. "</option>";
                        }else{
                            echo "<option>".$data[$i][1]. "</option>";
                        }
                    }
                ?>
            </select>
        <?php
    }

    // Getting navbar menu
    function getMenuRow(){
        $conn = connect();
        $query = "SELECT * FROM menus;";

        $menuResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $menuRow = $menuResult->fetch_all(PDO::FETCH_ASSOC);

        return $menuRow;
    }

    // Add Category 
    function add_category(){
        if(isset($_GET['cat_title']) && isset($_GET['cat_desc'])){
            $conn = connect();
            $cateogry_title = $_GET['cat_title'];
            $category_desc = $_GET['cat_desc'];
            $category_RID = generate_RID();

            $add_category_query = "INSERT INTO categories(
                Category_Title,
                Category_Description,
                Category_RID,
                Created_At)VALUES(
                '" . $cateogry_title . "',
                '" . $category_desc . "',
                '" . $category_RID . "',
                NOW()
            );";

            if($conn->query($add_category_query) or die ("Query Error: " .$conn->error)){
                echo "<script>window.location.href='?page=add_product'</script>";
            }else {
                echo "Something went wrong!";
            }
        }

    }

    // Getting Category 
    function getCategories(){
        $conn = connect();
        $query = "SELECT * FROM categories;";

        $categoriesResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $categoreisRow = $categoriesResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoreisRow;
    }

    // Getting Category RID according to Category Name: 
    function get_category_ByTitle($category_title){
        $conn = connect();
        $query = "SELECT * FROM categories WHERE Category_Title = '" . $category_title . "';";

        $categoryResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $categoryRow = $categoryResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoryRow;
    }

    // Getting Category Title according to Category RID: 
    function get_categoryTitle_ByRID($category_RID){
        $conn = connect();
        $query = "SELECT * FROM categories WHERE Category_RID = '" . $category_RID . "';";

        $categoryResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $categoryRow = $categoryResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoryRow;
    }

    // Getting Brands Accourding To Category_RID! 
    function getBrandsByCategory($category_RID){
        $conn = connect();
        $query = "SELECT * FROM brands WHERE Category_RID = '". $category_RID ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandsRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandsRow;
    }

    // Getting Brand Accourding To Brand_Title! 
    function get_brand_ByTitle($brand_Title){
        $conn = connect();
        $query = "SELECT * FROM brands WHERE Brand_Title = '". $brand_Title ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandRow;
    }

    // Getting Brand Accourding To Brand_RID! 
    function get_brand_ByRID($brand_RID){
        $conn = connect();
        $query = "SELECT * FROM brands WHERE Brand_RID = '". $brand_RID ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandRow;
    }

    // Getting BrandRID Accourding To Brand_Title! 
    function get_brandRID_ByTitle($brand_Title){
        $conn = connect();
        $query = "SELECT Brand_RID FROM brands WHERE Brand_Title = '". $brand_Title ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandRow;
    }
    
    // Getting Brands 
    function get_brands(){
        $conn = connect();
        $query = "SELECT * FROM brands;";

        $categoriesResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $categoreisRow = $categoriesResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoreisRow;
    }

    // Add Brand 
    function add_brand(){
        if(isset($_GET['brand_title']) && isset($_GET['brand_desc']) && isset($_GET['brand_cat'])){
            $conn = connect();

            $brand_title = $_GET['brand_title'];
            $brand_desc = $_GET['brand_desc'];
            $category_RID = get_category_ByTitle($_GET['brand_cat'])[0][4];
            $brand_RID = generate_RID();
            
            $query = "INSERT INTO brands(
                Brand_Title,
                Brand_Description,
                Brand_RID,
                Category_RID,
                Created_At
                )VALUES(
                '". $brand_title ."',
                '". $brand_desc ."',    
                '". $brand_RID ."',
                '". $category_RID ."',
                NOW()
            );";

            if($conn->query($query) or die ("Query Error: " .$conn->error)){
                echo "<script>window.location.href='?page=add_product&status=exit'</script>";
            }else {
                echo "Something went wrong!" .$conn->error;
            }
        }
    }

    // Getting Models Accourding To Brands_RID AND Category_RID! 
    function getModelsByBrands($brand_RID,$category_RID){
        $conn = connect();
        $query = "SELECT * FROM models WHERE brand_RID = '". $brand_RID ."' AND Category_RID = '". $category_RID ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandsRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandsRow;
    }

    // Getting Model Accourding To Model_RID! 
    function get_Model_ByRID($model_RID){
        $conn = connect();
        $query = "SELECT * FROM models WHERE Model_RID = '". $model_RID ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandsRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandsRow;
    }

    // Getting ModelRID Accourding To Model_TITLE! 
    function get_ModelRID_ByTitle($model_title){
        $conn = connect();
        $query = "SELECT Model_RID FROM models WHERE Model_Title = '". $model_title ."' ;";

        $brandResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $brandsRow = $brandResult->fetch_all(PDO::FETCH_ASSOC);

        return $brandsRow;
    }
    
    // Getting Models 
    function get_models(){
        $conn = connect();
        $query = "SELECT * FROM models;";

        $categoriesResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $categoreisRow = $categoriesResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoreisRow;
    }

    // Add Model 
    function add_model(){
        if(isset($_GET['model_title']) && isset($_GET['model_desc']) && isset($_GET['model_cat'])){
            $conn = connect();
            
            $model_title = $_GET['model_title'];
            $model_desc = $_GET['model_desc'];
            $brand_RID = get_brand_ByTitle($_GET['model_cat'])[0][5];
            $category_RID = get_brand_ByTitle($_GET['model_cat'])[0][6];
            $model_RID = generate_RID();
            
            $query = "INSERT INTO models (
                Model_Title,
                Model_Description,
                Model_RID,
                Category_RID,
                Brand_RID,
                Created_At
                )VALUES(
                '". $model_title ."',
                '". $model_desc ."',    
                '". $model_RID ."',
                '". $category_RID ."',
                '". $brand_RID ."',
                NOW()
            );";

            if($conn->query($query) or die ("Query Error: " .$conn->error)){
                echo "<script>window.location.href='?page=add_product&status=exit'</script>";
            }else {
                echo "Something went wrong!" .$conn->error;
            }
        }
    }
    
    // Getting Models 
    function get_sub_category(){
        $conn = connect();
        $query = "SELECT * FROM sub_category;";

        $categoriesResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $categoreisRow = $categoriesResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoreisRow;
    }

    // Getting Sub Category Record Accourding to sub_cat_title  
    function get_subCatRID_ByTitle($sub_cat_title){
        $conn = connect();
        $query = "SELECT Sub_Category_RID FROM sub_category WHERE Sub_Category_Title = '". $sub_cat_title ."' ;";

        $categoriesResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $categoreisRow = $categoriesResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoreisRow;
    }

    // Getting Sub Category Record Accourding to sub_cat_RID  
    function get_sub_Cat_ByRID($sub_cat_rid){
        $conn = connect();
        $query = "SELECT * FROM sub_category WHERE Sub_Category_RID = '". $sub_cat_rid ."' ;";

        $categoriesResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $categoreisRow = $categoriesResult->fetch_all(PDO::FETCH_ASSOC);

        return $categoreisRow;
    }

    //Add To Sub Category 
    function add_sub_category(){
        if(isset($_GET['sub_cat_title']) && isset($_GET['sub_cat_desc']) && isset($_GET['sub_parent_cat'])){
            $conn = connect();

            $sub_cat_title = $_GET['sub_cat_title'];
            $sub_cat_desc = $_GET['sub_cat_desc'];
            $category_RID = get_category_ByTitle($_GET['sub_parent_cat'])[0][4];
            $sub_cat_RID = generate_RID();
            
            $query = "INSERT INTO sub_category(
                Sub_Category_Title,
                Sub_Category_Description,
                Parent_Category,
                Sub_Category_RID,
                Created_At
                )VALUES(
                '". $sub_cat_title ."',
                '". $sub_cat_desc ."',    
                '". $category_RID ."',
                '". $sub_cat_RID ."',
                NOW()
            );";

            if($conn->query($query) or die ("Query Error: " .$conn->error)){
                echo "<script>window.location.href='?page=add_product&status=exit'</script>";
            }else {
                echo "Something went wrong!" .$conn->error;
            }

        }else {
            echo "Something is missing In parameters!";
        }
    }

    // Getting Product Variants Values Accourding To Product RID
    function get_ProductVarint_ByRID($product_RID){
        $conn = connect();
        $query = "SELECT * FROM variants WHERE Variant_RID = '" . $product_RID . "';";

        $variantsResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $variantsRows = $variantsResult->fetch_all(PDO::FETCH_ASSOC);

        return $variantsRows;
    }

    // Add Order Address:  
    function add_Orderaddress($UserID,$full_name,$province,$phone_number,$gamil,$city,$area,$billing_address,$delivery_address,$order_RID){
        $conn = connect();

        $address_query = "INSERT INTO Address (
            UserID, 
            User_Name,
            Phone_Number,
            Gmail,
            City,
            Area,
            Billing_Address,
            Delivery_Address,
            TimeStamp,
            Created_At,
            Address_RID) VALUES (
            ". $UserID .", 
            '". $full_name ."', 
            '". $phone_number ."', 
            '". $gamil ."',
            '". $city ."',
            '". $area ."', 
            '". $billing_address ."', 
            '". $delivery_address ."', 
            NOW(), 
            NOW(), 
            '". $order_RID ."'
        );";

        if($conn->query($address_query) or die($conn->error)){
            // echo "
            // <script>
            //     redirectTo('?page=home');
            // </script>";
        }else {
            echo "Error : " . $conn->error;
        }

    }

    // Updating order Status 
    function update_order_status($status,$order_id,$user_id){
        $conn = connect();
        $upate_order_status = "UPDATE orders SET Order_Status = '". $status ."' WHERE OID = $order_id";
        
        if($conn->query($upate_order_status)){
            header("Location: ?page=view_orders_details&user_id=".$user_id);
        }else{
            echo "Error: " . $conn->error;
        }
        
    }
    // Delete Order According To Order_ID;
    function delete_order($order_id,$user_id){
        $conn = connect();
        $delete_orders_query = "DELETE FROM orders WHERE OID = $order_id;";

        if( $conn->query($delete_orders_query)){
            header("Location: ?page=view_orders_details&user_id=".$user_id);
        }else{
            echo "Error: " . $conn->error;
        }
    } 

    // Get_Address By User_ID;
    function get_Address_ByUserID($user_ID){
        $conn = connect();
        $address_query = "SELECT * FROM address WHERE UserID = $user_ID ";

        $address_Result = $conn->query($address_query) or die ("Query Error: " .$conn->error);
        $address_Row = $address_Result->fetch_all(PDO::FETCH_ASSOC);

        return $address_Row;
    }

    // Insert Orders Reuqest
    function add_order($ItemIDs,$ItemQTY,$UserID,$full_name,$province,$phone_number,$gamil,$city,$area,$billing_address,$delivery_address){
        $conn = connect();

        $order_RID = generate_RID();
        $product_IDs = explode("|", $ItemIDs);
        $product_Qty = explode("|", $ItemQTY);

        $success = false;

        for($i = 0; $i < (sizeof($product_IDs)-1); $i++){
            $product_ID = explode("_", $product_IDs[$i]);
            $product_Qty = explode("_", $product_Qty[$i]);
            
            $order_query = "INSERT INTO Orders (
                User_ID,
                Item_IDs,
                Item_QTY,
                Order_Date,
                Order_Status,
                Order_RID) VALUES (
                ". $UserID .",
                '". $product_ID[1] ."',
                '". $product_Qty[1] ."', 
                NOW(),
                'Pending', 
                '". $order_RID ."'
            );";
        
            if($conn->query($order_query) or die ("Query Error: " .$conn->error)){
                // echo "<script>window.location.href='?page=list_product'</script>";
                if($i >= (sizeof($product_IDs)-2)){
                    $success = true;
                }
            }else {
                // echo "Something Wrong!";
            }
        }
            if($success){
                add_Orderaddress(
                    $UserID,
                    $full_name,
                    $province,
                    $phone_number,
                    $gamil,$city,
                    $area,
                    $billing_address,
                    $delivery_address,
                    $order_RID
                );
                header("Location: ?page=home");
                unset($_SESSION['add_to_cart']);
            }
    }
    // Insert Orders Reuqest

    function get_orders_ByUserID($user_ID){
        $conn = connect();
        $get_product_query = "SELECT * FROM orders WHERE User_ID = $user_ID";

        $orderResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $orderRow = $orderResult->fetch_all(PDO::FETCH_ASSOC);

        return $orderRow;
    }

    // Get Orders 
    function get_orders(){
        $conn = connect();
        $get_product_query = "SELECT * FROM orders";

        $orderResult = $conn->query($get_product_query) or die ("Query Error: " .$conn->error);
        $orderRow = $orderResult->fetch_all(PDO::FETCH_ASSOC);

        return $orderRow;
    }
    
    // Connectoin
    function connect(){
        $host = "localhost";
        $userName = "root";
        $password = "";
        $database = "jobme_laptop_portal";

        $conn = new mysqli($host,$userName,$password,$database);
        return $conn;
    }

    // We are checking email for is it exit or not from our database
    function isEmailExit($email){
        $conn = connect();
        $query = "SELECT email FROM users WHERE email = '". $email ."'";

        $emailResult = $conn->query($query) or die ("Query Error :" .$conn->error);
        $emailRow = $emailResult->fetch_all(PDO::FETCH_ASSOC);

        if($emailRow != null){
            return true;
        }else {
            return false;
        }
        return false;
    }

    // Change User_Password 
    function changePassword($password , $uid){
        $conn = connect();
        $change_pass_query = "UPDATE users SET Password = '". $password ."' WHERE UID = $uid; ";

        if($conn->query($change_pass_query) or die($conn->error)){
            header("Location: ?page=user_profile");
        }else{
            echo "Error: " . $conn->error;
        }
    }

    // InsertUser Of registtion Data In Users
    function insert_User($first_name,$last_name,$password,$email){
        $query = "INSERT INTO users(
            First_Name,
            Last_Name,
            Password,
            Email,
            Created_At,
            TimeStamp)
            VALUES ('". $first_name ."', '". $last_name ."', '". $password ."', '". $email."',NOW(),NOW()
        );";

        $conn = connect();

        if($conn->query($query) or die($conn->error)){
            header("Location: ?page=register_profile");
        }else{ 
            echo "Something went wrong with query!";
        }
    }

    // Delete Users And There Orders
    function delete_user_and_orders($user_id){
        $conn = connect();
        $delete_user_query = "DELETE FROM users WHERE UID = $user_id;";
        $delete_orders_query = "DELETE FROM orders WHERE User_ID = $user_id;";

        if($conn->query($delete_user_query) && $conn->query($delete_orders_query)){
            header("Location: ?page=orders_list");
        }else{
            echo "Error: " . $conn->error;
        }
    } 
    
    function uploadImage($imageName,$imagesPath){
        $image = $_FILES[$imageName]['name'];
    
        // image file directory
        $target = $imagesPath.basename($image);

        if (move_uploaded_file($_FILES[$imageName]['tmp_name'], $target)) {
            return $image;
        }else{
            return false;
        }
    }

    function upload_image_file($imageName, $imagePath){
        $errors = array();
        $file_name = $_FILES[$imageName]['name'];
        $file_size = $_FILES[$imageName]['size'];
        $file_tmp = $_FILES[$imageName]['tmp_name'];
        $file_type = $_FILES[$imageName]['type'];

        $extension = array("jpg","jpeg","png");
        
        $fileExlodeExtension = explode(".",$_FILES[$imageName]['name']);

        $file_ext = strtolower(end($fileExlodeExtension));

        if(in_array($file_ext, $extension) == false){
            $errors[] = "extension not allowed, please choose a jpg jpeg or png file!"; 
            header("Location: ?page=register_profile&register_profile=extentionError");
        }

        if($file_size > 5000000){
            $errors[] = "File size must be excately 2 MB!";
            header("Location: ?page=register_profile&register_profile=sizeError");
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp,$imagePath.$file_name);    
            return $file_name;
        }else {
            return $errors;
        }
    }

    // Method For Profile Data
    function insert_Profile($phone,$address,$billing_Address,$delivery_Address,$user_avatar){
        $profileQuery = "INSERT INTO profile(
            Phone,
            Address,
            Billing_Address,
            Delivery_Address,
            User_ID,
            User_Avatar,
            Created_At,
            TimeStamp)
            VALUES ('". $phone ."',
            '". $address ."', 
            '". $billing_Address ."', 
            '". $delivery_Address."',
            ". $_SESSION['jobme_laptop_User_ID'] .",
            '". $user_avatar ."',
            NOW(),
            NOW()
        );";

        $conn = connect();

        if($conn->query($profileQuery) or die($conn->error)){
            header("Location: ?page=main");
        }else{ 
            echo "Something went wrong with query!";
        }
    }

    // Check Profile If is exit or Not
    function is_Profile_Exit(){
        $currentuser_ID = false;
        $rows = "";
        
        if(isset($_SESSION['jobme_laptop_User_ID'])){
            $currentuser_ID = $_SESSION['jobme_laptop_User_ID'];
        }

        if($currentuser_ID == false){
        }else{
            $selectProfileQuery = "SELECT * FROM profile WHERE User_ID = $currentuser_ID";

            $conn = connect();

            $profileResult = $conn->query($selectProfileQuery) or die ("Query Error: " .$conn->errno);
            $rows = $profileResult->fetch_all(PDO::FETCH_ASSOC);
        }

        return $rows;
    }

    // Check User Login!
    function isLogin($email,$password){
        $conn = connect();
        $query = "SELECT * FROM users WHERE Email = '". $email ."' AND Password = '". $password ."'; ";

        $loginResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $userRow = $loginResult->fetch_all(PDO::FETCH_ASSOC);
    
        return $userRow;
    }

    // Get User Data By According UserID!
    function get_userBYID($userID){
        $conn = connect();
        $query = "SELECT * FROM users WHERE UID = '". $userID ."'; ";

        $userResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $userRow = $userResult->fetch_all(PDO::FETCH_ASSOC);
    
        return $userRow;
    }

    // Getting User!
    function get_user(){
        $conn = connect();
        $query = "SELECT * FROM users;";

        $userResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $userRow = $userResult->fetch_all(PDO::FETCH_ASSOC);
    
        return $userRow;
    }

    // Get User Address By According UserID!
    function get_userAddress_BYID($userID){
        $conn = connect();
        $query = "SELECT * FROM address WHERE UserID = '". $userID ."'; ";

        $userResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $userRow = $userResult->fetch_all(PDO::FETCH_ASSOC);
    
        return $userRow;
    }
    
    // Checking login Authenticate:
    function is_adminLogin($email,$password){
        $conn = connect();
        $query = "SELECT * FROM users WHERE 
        Email = '". $email ."' 
        AND 
        Password = '". $password ."' 
        AND 
        Status = 'admin';";

        $loginResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $userRow = $loginResult->fetch_all(PDO::FETCH_ASSOC);
    
        return $userRow;
    }
    // Get Password By User ID 

    function get_userPassword_BYID($userID,$password){
        $conn = connect();
        $query = "SELECT Password FROM users WHERE
            UID = '". $userID ."' 
            AND 
            Password = '". $password ."';
        ";

        $userResult = $conn->query($query) or die ("Query Error: " .$conn->error);
        $userRow = $userResult->fetch_all(PDO::FETCH_ASSOC);
    
        if($userRow != null){
            return true;
        }else {
            return false;
        }
        return false;
    }

?>