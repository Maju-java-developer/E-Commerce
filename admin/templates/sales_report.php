<?php
    $product_Sale_Heading = array("ID","Product Title","Product Margin","Product Qty","Product Sale Date");
?>

<div class="col-md-12">
    <div class="card card-plain table-plain-bg">

        <div class="card-header ">
            <h4 class="card-title">SALES PRODUCTS LIST</h4>
        </div>

        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover">
                <thead>
                <?php
                for ($i=0; $i < sizeof($product_Sale_Heading); $i++) { 
                    echo "<th>". $product_Sale_Heading[$i]. "</th>";
                }   
                ?>
                <th class="float-right">
                Action
                </th>
                
                </thead>
                <tbody>
                <?php
                for ($x=0; $x < 3; $x++) { 
                    echo "<tr>
                        <td>". ($x + 1) ." </td>
                        <td>Dakota Rice</td>
                        <td>$36,738</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>";
                    ?>
                    <td class="float-right">
                        <span class="material-icons" style="cursor: pointer;" > 
                            create
                        </span>
                        <span class="material-icons" style="cursor: pointer;" onclick="redirectTo('?page=view_product&product_id=<?php echo $get_products[$i][0]?>');" >
                                launch
                        </span>
                        <span class="material-icons" style="cursor: pointer;" data-toggle="modal" data-target="#delete_order_<?php //echo $get_order_info[$i][0]?>">
                            delete
                        </span>
                    </td>
                    <?php
                }   
                ?>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>


