<?php
$product_Sale_Heading = array("ID","Product Title","Product Margin","Product Qty","Product Sale Date");

for ($i = 0; $i < 6; $i++){
?>
<div class=" col-md-4 ">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h6 class="text-lg-center">SALES</h6>
                <hr class=" p-1 m-1">
            </div>

            <div>
                <img src="<?php echo $imagesPath . "Cash.png" ?>" class="float-left" width="60">
                <p class="float-right ">90000 : Pkr</p>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<?php
    include_once('templates/sales_report.php'); 
?>
<!-- <div class="col-md-12">
    <div class="card card-plain table-plain-bg">

        <div class="card-header ">
            <h4 class="card-title">SALES PRODUCTS LIST</h4>
        </div>

        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover">
                <thead>
                <?php
                // for ($i=0; $i < sizeof($product_Sale_Heading); $i++) { 
                //     echo "<th>". $product_Sale_Heading[$i]. "</th>";
                // }   
                ?>
                </thead>
                <tbody>
                <?php
                // for ($x=0; $x < 3; $x++) { 
                //     echo "<tr>
                //         <td>". ($x + 1) ." </td>
                //         <td>Dakota Rice</td>
                //         <td>$36,738</td>
                //         <td>Niger</td>
                //         <td>Oud-Turnhout</td>
                //     </tr>";
                // }   
                ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
 -->
