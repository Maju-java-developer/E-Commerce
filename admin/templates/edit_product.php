<?php
    $relationID = "";
    if(isset($_COOKIE['productRelID'])){
        $relationID = $_COOKIE['productRelID'];
    }else{
        echo "<script>redirectTo('?page=error&errorMessage=1');</script>";
    }

    if($relationID == ""){
        echo "<script>redirectTo('?page=error&errorMessage=2');</script>";
    }

    // We are Adding Variants In Edit Product! 
    if(isset($_GET['page'])){
        if($_GET['page'] == "edit_product" && isset($_GET['product_id'])){
            if(isset($_GET['variants_title']) && isset($_GET['variants_values']) && isset($_GET['variants_desc'])){
                add_variants(
                    $relationID,
                    $_GET['variants_title'],
                    $_GET['variants_desc'],
                    $_GET['variants_values']
                );
            }
        }
    }
    // We are Adding Variants In Edit Product! 

    // We are Deleting Variants In Edit Product! 
    // if(isset($_GET['page'])){
    //     echo "Im gettting page!";
    //     if($_GET['page'] == "request_delete" && isset($_GET['productRelID']) && isset($_GET['product_id'])){
    //         echo "Im gettting Values!";
    //         if(isset($_GET['variants_data'])){
    //             delete_variants(
    //                 $_GET['productRelID'],
    //                 $_GET['variants_data']
    //             );
    //         }
    //     }
    // }
    // We are Deleting Variants In Edit Product! 

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['updateProductBtn'])){
        if(isset($_POST['product_title'])&& isset($_POST['choose_cat'])
        && isset($_POST['choose_brand']) && isset($_POST['product_margin'])
        && isset($_POST['choose_model']) && isset($_POST['choose_sub_cat'])
        && isset($_POST['product_desc']) && isset($_POST['product_Qty'])
        && isset($_POST['product_parching_price']) && isset($_POST['product_selling_price'])){

            $update_product_title = $_POST['product_title'];
            $update_product_cat_RID = get_category_ByTitle($_POST['choose_cat'])[0][4];
            $update_product_brand_RID = get_brandRID_ByTitle($_POST['choose_brand'])[0][0];
            $update_product_model_RID = get_ModelRID_ByTitle($_POST['choose_model'])[0][0];
            $update_product_sub_cat_RID = get_subCatRID_ByTitle($_POST['choose_sub_cat'])[0][0];
            $update_product_desc = $_POST['product_desc'];
            $update_product_Qty = $_POST['product_Qty'];
            $update_product_parching_price = $_POST['product_parching_price'];
            $update_product_selling_price = $_POST['product_selling_price'];
            $update_product_margin = $_POST['product_margin'];

            $uplaodUpadateImageStatus = "";
            $getUpdateImagePath = uploadImage("product_img","assets/img/");

            if($getUpdateImagePath){
                $uplaodUpadateImageStatus = $getUpdateImagePath;
            }else {
                $uplaodUpadateImageStatus = "update_image_not_uploaded";
            }

            if($uplaodUpadateImageStatus == "update_image_not_uploaded"){
                // Here We will Run Query of Updated To product Of Without Image!
                update_product_WithoutImage(
                    $update_product_title,
                    $update_product_desc,
                    $update_product_cat_RID,
                    $update_product_brand_RID,
                    $update_product_model_RID,
                    $update_product_sub_cat_RID,
                    $update_product_parching_price,
                    $update_product_selling_price,
                    $update_product_margin,
                    $update_product_Qty
                );
                // echo "You Haven,t selected Product image for update!" . $uplaodUpadateImageStatus;
            }else {
                if($uplaodUpadateImageStatus != false){
                    update_productAll(
                        $uplaodUpadateImageStatus,
                        $update_product_title,
                        $update_product_desc,
                        $update_product_cat_RID,
                        $update_product_brand_RID,
                        $update_product_model_RID,
                        $update_product_sub_cat_RID,
                        $update_product_parching_price,
                        $update_product_selling_price,
                        $update_product_margin,
                        $update_product_Qty
                    );
                // Here We will Run Query of Updated To product WIth Image!
                echo "You Have selected Product image for update!" . $uplaodUpadateImageStatus;
                }
            }  
        }else {
            echo "Some Paramteters are missing!";
        }
    }

    $getCategories = getCategories();
    $getSubCategory = get_sub_category();
    $getBrands = get_brands();
    $getModel = get_models();

    if(isset($_GET['page']) && $_GET['page'] == 'edit_product'){
    if(isset($_GET['product_id'])){
        $getProductInfo = get_products_ByID($_GET['product_id']);
        $getProductVariants = get_ProductVarint_ByRID($getProductInfo[0][12]);

        if(!isset($_COOKIE['productRelID']) || !isset($_COOKIE['product_id'])){
            echo "
            <script>
                window.location = '". $_SERVER['PHP_SELF'] ."&page=error&errorCode=404';
            </script>
            ";
        }else{
            if($_COOKIE['productRelID'] == "" || $_COOKIE['product_id'] == ""){
                echo "
                <script>
                    window.location = '". $_SERVER['PHP_SELF'] ."&page=error&errorCode=405';
                </script>
                ";
            }
        }

    ?>
    <div class="col-xl-12">
    <div class="card">
        <div class="header">
        <h4 class="title pl-2">Edit Product</h4>
        </div>
        <div class="content p-2">
            <form method="POST" enctype="multipart/form-data" action="#">
                <div class="row">
                    <!-- Product Title -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Title</label>
                            <input type="text" class="form-control" name="product_title" placeholder="Product Title" value="<?php echo $getProductInfo[0][2]; ?>">
                        </div>
                    </div>

                    <!-- product Avatar -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <img src="<?php echo $imagesPath.$getProductInfo[0][1]?>" id="product_img_preview" style="margin-top: -17px; padding:2px" width="40" height="40" alt="">
                            <div id="imageUploadStatus"></div>
                            <input type="file" class="form-control" name="product_img" id="product_img" onchange="readURL(this, '#product_img_preview');" placeholder="Product Image">
                        </div>
                    </div>

                    <!-- Choose Category Select-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Choose Category</label>
                            <?php echo create_SelectedOptions("choose_cat", "choose_cat", $getCategories,get_categoryTitle_ByRID($getProductInfo[0][3])[0][1]); ?>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" class="form-control" style="margin-top: 21.5px;" data-toggle="modal" data-target="#add_category">+</button>
                        </div>
                    </div>
                    <!-- Choose Category Select END-->
                </div>

                <div class="row">
                    <!-- Choose Brand Select -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Choose Brands</label>
                            <?php echo create_SelectedOptions("choose_brand","choose_brand",$getBrands,get_brand_ByRID($getProductInfo[0][5])[0][1]);?>
                        </div>
                    </div>

                    <!-- Choose Brands Button -->
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" class="form-control" style="margin-top: 21.5px;" data-toggle="modal" data-target="#add_brand">+</button>
                        </div>
                    </div>

                    <!-- Choose Model Select -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Choose Model</label>
                            <?php echo create_SelectedOptions("choose_model","choose_model",$getModel,get_Model_ByRID($getProductInfo[0][6])[0][1]);?>
                        </div>
                    </div>

                    <!-- Choose Model Button -->
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" class="form-control" style="margin-top: 21.5px;" data-toggle="modal" data-target="#add_model">+</button>
                        </div>
                    </div>

                    <!-- Choose Sub Category Select -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Choose sub Category</label>
                            <?php echo create_SelectedOptions("choose_sub_cat","choose_sub_cat",$getSubCategory,get_sub_Cat_ByRID($getProductInfo[0][4])[0][1]);?>
                        </div>
                    </div>

                    <!-- Choose Sub Category Button -->
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" class="form-control" style="margin-top: 21.5px;" data-toggle="modal" data-target="#add_sub_category">+</button>
                        </div>
                    </div>
                    <!-- Choose Sub Category Button -->
                </div>

                <!-- Description -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="product_desc" id="product_desc" class="form-control" cols="10"><?php echo $getProductInfo[0][7]?></textarea>
                        </div>
                    </div>

                    <!-- Product Qty -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Product Qty</label>
                            <input type="number" value="<?php echo $getProductInfo[0][11]?>" class="form-control" name="product_Qty" id="product_Qty" cols="10">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <!-- Product Parching Price -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Parching Price</label>
                            <input type="number" value="<?php echo $getProductInfo[0][8]?>" class="form-control" name="product_parching_price" id="product_parching_price" placeholder="Product Parching Price">
                        </div>
                    </div>

                    <!-- Product Selling Price -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Selling Price</label>
                            <input type="number" value="<?php echo $getProductInfo[0][9]?>" onkeyup="autoMargin();" class="form-control" name="product_selling_price" id="Product_selling_price" placeholder="product Selling Price">
                        </div>
                    </div>

                    <!-- Product Margin Price -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Margin</label>
                            <input type="number" value="<?php echo $getProductInfo[0][10]?>" class="form-control" onkeyup="autoSellingPrice();" name="product_margin" id="margin" placeholder="Margin">
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="p-0 m-0 mb-3">Product Variants Values</h5>
                            <?php
                                $variantSlotID = 0;
                            ?>
                            <div id="variantsSlot<?php //echo $variantSlotID; ?>">
                            <?php 
                            if($getProductVariants != null){
                                $varInd = 0;
                                foreach ($getProductVariants as $productVariant) { 
                                ?>
                                    <div id="variant_block_<?php echo $variantSlotID; ?>">
                                        <h5 class="bg-info p-2 mb-1 text-light" id="<?php $varInd?>" onclick="openVariantsValues('variants_title_<?php echo $varInd?>');" style="border-radius: 10px;"><?php echo $productVariant[1]?>
                                            <i class="material-icons float-right setCurser" onclick="removeEditVariant('variant_block_<?php echo $variantSlotID; ?>'); addRemovedVarints('<?php echo $productVariant[1].'_'.$productVariant[2] ?>'); " style="margin-top: -3px;">delete</i>
                                        </h5>
                                        <ol id="variants_title_<?php echo $varInd?>" style="display: none;">
                                            <?php
                                                $productValues = explode("|",$productVariant[2]); 
                                                for ($x=0; $x < sizeof($productValues); $x++) { 
                                                    echo "<li>$productValues[$x]</li>";   
                                                }
                                            ?>
                                        </ol>
                                    </div>
                                <?php

                                $varInd += 1;
                                $variantSlotID += 1;
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
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-2">
                            <h5 class="p-0 m-0 mb-3"> Selected Variants For Delete</h5>
                            <div class="card-body">
                                <div id="deleted_varaints_contanir">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Variants Button -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button"  class="btn btn-dark w-100" data-toggle="modal" data-target="#addVariants">
                                Add Varints
                            </button>
                            <div id="variants">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="btn btn-primary" onclick="getVariantValues(); alert(variants_title[0]);">ADD PRODUCT</div> -->
            <button type="submit" onclick=" getVariantValuesEdit('<?php echo $getProductInfo[0][0]; ?>'); getVariantValuesForDelete(<?php echo $_COOKIE['product_id']?>,'<?php echo $_COOKIE['productRelID']?>');" name="updateProductBtn" class="btn btn-info btn-fill">Update Product</button>

            <div class="clearfix"></div>
    </form>

    <!-- Modal Are Here -->

    <!-- Add Category Modal -->
    <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label>Category Title</label>
                <input type="text" id="cat_title" class="form-control border-0" placeholder="Category Title" required>
            </div>                        
            <div class="form-group">
                <label>Category Description</label>
                <input type="text" id="cat_desc" class="form-control border-0" placeholder="Category Description" required>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="postCategory()" data-dismiss="modal" class="btn btn-primary">Add Category</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Add Category Modal -->

    <!-- Add Brand modal -->
    <div class="modal fade" id="add_brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Brand Title</label>
                <input type="text" id="brand_title" class="form-control border-0" placeholder="Brand Title" required>
            </div>                        

            <div class="form-group">
                <label>Brand Description</label>
                <input type="text" id="brand_desc" class="form-control border-0" placeholder="Brand Description" required>
            </div>

            <div class="form-group">
                <label>Choose Category</label>
                <?php echo create_Select("","choose_cat_modal",$getCategories)?>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="postBrand();" data-dismiss="modal" class="btn btn-primary">Add Brand</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Add Brand modal -->

    <!-- Add Model Modal -->
    <div class="modal fade" id="add_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Model</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Model Title</label>
                <input type="text" id="model_title" class="form-control border-0" placeholder="Model Title" required>
            </div>                        
            <div class="form-group">
                <label>Model Description</label>
                <input type="text" id="model_desc" class="form-control border-0" placeholder="Model Description" required>
            </div>
            <div class="form-group">
                <label>Choose Brand</label>
                <?php echo create_Select("","choose_brand_modal",$getBrands)?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="postModel()" name="add_model" class="btn btn-primary">Add Model</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Add Model modal -->

    <!-- Add Sub Category modal -->
    <div class="modal fade" id="add_sub_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Sub Category Title</label>
                <input type="text" id="sub_cat_title" class="form-control border-0" placeholder="Sub Category Title" required>
            </div>                        
            <div class="form-group">
                <label>Sub Category Description</label>
                <input type="text" id="sub_cat_desc" class="form-control border-0" placeholder="Sub Category Description" required>
            </div>
            <div class="form-group">
                <label>Sub Category Description</label>
                <?php echo create_Select("","sub_parent_cat",$getCategories)?>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="postSubCategory()" class="btn btn-primary">Add Sub Category</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Add Sub Category modal -->

    <!-- Variants Modal -->
    <div class="modal fade" id="addVariants" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Variants</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Variant Title</label>
                <input type="text" id="variant_title" class="form-control border-0" placeholder="Variant Title" required>
            </div>                        
            <div class="form-group">
                <label>Variant Description</label>
                <input type="text" id="variant_desc" class="form-control border-0" placeholder="Variant Description" required>
            </div>

            <div class="form-group">
                <label>Variant Values</label>
                <input type="text" id="variant_values" class="form-control border-0" placeholder="Variant Values" required>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="addVariantSlot()" class="btn btn-primary">Add Variant</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Variants Modal -->

    <?php

    }else{
        echo "<script>redirectTo('". $_SERVER['PHP_SELF'] ."?page=error&errorCode=10');</script>";
    }
}

?>