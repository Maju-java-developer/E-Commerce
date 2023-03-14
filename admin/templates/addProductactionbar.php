<?php

    $relationID = "";
    if(isset($_COOKIE['product_rid'])){
        $relationID = $_COOKIE['product_rid'];
    }else{
        echo "<script>redirectTo('?page=error&errorMessage=Relation ID cannot be empty');</script>";
    }

    if($relationID == ""){
        echo "<script>redirectTo('?page=error&errorMessage=Relation ID cannot be empty');</script>";
    }

    $getCategories = getCategories();
    $getSubCategory = get_sub_category();
    $getBrands = get_brands();
    $getModel = get_models();

    if(isset($_GET['page'])){
        if($_GET['page'] == "add_product"){
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

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['product_title'])&& isset($_POST['choose_cat'])
        && isset($_POST['choose_brand']) && isset($_POST['product_margin'])
        && isset($_POST['choose_model']) && isset($_POST['choose_sub_cat'])
        && isset($_POST['product_desc']) && isset($_POST['product_Qty'])
        && isset($_POST['product_parching_price']) && isset($_POST['product_selling_price'])){

            $product_title = $_POST['product_title'];
            $product_cat_RID = get_category_ByTitle($_POST['choose_cat'])[0][4];
            $product_brand_RID = get_brandRID_ByTitle($_POST['choose_brand'])[0][0];
            $product_model_RID = get_ModelRID_ByTitle($_POST['choose_model'])[0][0];
            $product_sub_cat_RID = get_subCatRID_ByTitle($_POST['choose_sub_cat'])[0][0];
            $product_desc = $_POST['product_desc'];
            $product_Qty = $_POST['product_Qty'];
            $product_parching_price = $_POST['product_parching_price'];
            $product_selling_price = $_POST['product_selling_price'];
            $product_margin = $_POST['product_margin'];

            $imageStatusUpload = "";
            $getImagePath = upload_file("product_img","assets/img/");

            if($getImagePath != null){
                $imageStatusUpload = $getImagePath;
            }else {
                $imageStatusUpload = "image_upload_error";
            }

            if($imageStatusUpload != "image_upload_error"){
                if($relationID != ""){
                    add_product(
                        $imageStatusUpload,
                        $product_title,
                        $product_desc,
                        $product_cat_RID,
                        $product_brand_RID,
                        $product_model_RID,
                        $product_sub_cat_RID,
                        $product_parching_price,
                        $product_selling_price,
                        $product_margin,
                        $product_Qty,
                        $relationID
                    );
                }
            }else {
                echo "<script>alert('Image is not uploaded sorry give us Image in png jpeg or jpg!:')</script>;";
                // echo "<script>window.location.href='?page=add_product&add_product=extension_error'</script>"; 
            }

        }else {
            ?>
                <script>alert('Some Parameter are wrong!')</script>
            <?php
        }
    }

?>

<div class="col-xl-12">
<div class="card">
    <div class="header">
        <h4 class="title pl-2">Add Product</h4>
    </div>
    <div class="content p-2">
        <form method="POST" enctype="multipart/form-data" action="#">
            <div class="row">
                <!-- Product Title -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Product Title</label>
                        <input type="text" class="form-control" name="product_title" placeholder="Product Title">
                    </div>
                </div>

                <!-- product Avatar -->
                <div class="col-md-3">
                    <div class="form-group">
                        <img src="../resources/images/jobMe.png" id="add_product_img_preview" style="margin-top: -17px; padding:2px" width="40" height="40" alt="">
                        <input type="file" class="form-control" name="product_img" onchange="readURL(this, '#add_product_img_preview');" id="product_img" placeholder="Product Image">
                    </div>
                </div>

                <!-- Choose Category Select-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Choose Category</label>
                        <?php echo create_Select("choose_cat","choose_cat",$getCategories)?>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <button type="button" class="form-control" style="margin-top: 21.5px;" data-toggle="modal" data-target="#add_category">+</button>
                    </div>
                </div>
                <!-- Choose Category Select END-->
            </div>

            <!-- Alert Message For Extension_error -->
            <div class="row">
                <div class="col-md-12">
                        <?php echo alert_Message("add_product","extension_error","extension not allowed, please choose a jpg jpeg or png image")?>
                </div>
            </div>

            <div class="row">
                <!-- Choose Brand Select -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Choose Brands</label>
                        <?php echo create_Select("choose_brand","choose_brand",$getBrands)?>
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
                        <?php echo create_Select("choose_model","choose_model",$getModel)?>
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
                        <?php echo create_Select("choose_sub_cat","choose_sub_cat",$getSubCategory)?>
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
                        <textarea name="product_desc" id="product_desc" class="form-control" cols="10"></textarea>
                    </div>
                </div>

                <!-- Product Qty -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Product Qty</label>
                        <input type="number" class="form-control" name="product_Qty" id="product_Qty" cols="10">
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Product Parching Price -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Product Parching Price</label>
                        <input type="number" class="form-control" name="product_parching_price" id="product_parching_price" placeholder="Product Parching Price">
                    </div>
                </div>

                <!-- Product Selling Price -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Product Selling Price</label>
                        <input type="number" onkeyup="autoMargin();" class="form-control" name="product_selling_price" id="Product_selling_price" placeholder="product Selling Price">
                    </div>
                </div>

                <!-- Product Margin Price -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Margin</label>
                        <input type="number" class="form-control" onkeyup="autoSellingPrice();" name="product_margin" id="margin" placeholder="Margin">
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
        <button type="submit" name="addProductBtn" onclick="getVariantValues();" class="btn btn-info btn-fill">Add Product</button>
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
