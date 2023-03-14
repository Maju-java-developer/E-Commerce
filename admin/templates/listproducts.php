<?php
    $product_Heading = array("ID","Product Image","Product_Name","Product Category","Parchasing Price","Qty");
    $get_products = get_products();

    $getcategroy = "";
?>

<!-- Creating Button For Add PRODUCT -->
<div class="col-md-12">
    <div class="card ">
        <div class="card-body ">
            <button class="btn bg-default" onclick="redirectTo('?page=add_product&reqID=true')"> ADD PRODUCT</button>            
        </div>
    </div>
</div>
<!-- Creating Button For Add PRODUCT -->

<!-- Creating List Table OF PRODUCT -->
<div class="col-md-12">
    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">List Products</h4>
            <!-- <p class="card-category">List Products</p> -->
        </div>
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <?php
                    for ($i=0; $i < sizeof($product_Heading); $i++) { 
                        echo "<th>$product_Heading[$i]</th>";
                    }
                    ?>
                    <th class="float-right">
                        Action
                    </th>
                    <?php
                ?>
                </thead>
                <tbody>
                <?php
                    for ($i=0; $i < sizeof($get_products); $i++) {
                        $productImagePath = "";
                        if($get_products[$i][1] != "Array"){
                            $productImagePath = $get_products[$i][1] . "";
                        }else {
                            $productImagePath = "No Image";
                        }
                        
                        echo "<tr>
                        <td>". $get_products[$i][0]." </td>
                        <td><img width='35' src='". $imagesPath.$productImagePath ."'></td>
                        <td>". $get_products[$i][2]." </td>
                        <td>". get_categoryTitle_ByRID($get_products[$i][3])[0][1] ."</td>
                        <td>". $get_products[$i][8]." </td>
                        <td>". $get_products[$i][11]." </td>";
                            ?>  
                            <td class="float-right">
                                <span class="material-icons" style="cursor: pointer;" onclick="redirectTo('?page=edit_product&product_id=<?php echo $get_products[$i][0]; ?>&productRelID=<?php echo $get_products[$i][12]; ?>&reqDel=true');"> 
                                    create
                                </span>
                                <span class="material-icons" style="cursor: pointer;" onclick="redirectTo('?page=view_product&product_id=<?php echo $get_products[$i][0]?>');" >
                                    launch
                                </span>
                                <span class="material-icons" style="cursor: pointer;" data-toggle="modal" data-target="#delete_product_<?php echo $get_products[$i][0]?>">
                                    delete
                                </span>

                                <!-- Confirm Modal For Delete Product -->
                                <div class="modal fade" id="delete_product_<?php echo $get_products[$i][0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">DELETE PRODUCT: <?php echo $get_products[$i][0]?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Are u sure to delete it?</label>
                                        </div>                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                        <button type="button" class="btn btn-primary" onclick="redirectTo('?page=delete_product&product_id=<?php echo $get_products[$i][0]?>&product_rid=<?php echo $get_products[$i][12]?>');" >YES</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- Confirm Modal For Delete Product -->

                            </td>                            
                            <?php
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
