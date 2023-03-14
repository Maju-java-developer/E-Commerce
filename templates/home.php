<?php

  function TopSellingItems($contanirid,$heading){
    $product_images = ['laptop_1.jpeg','laptop_2.jpg','laptop_3.jpeg','laptop_5.jpeg','laptop_6.jpeg'];
    
    $product_titles = ['DELL XPS','HP',"TOSHIBA","Apple","Samsung"];
    $product_description = ["xyz","xyz","xyz","xyz","xyz"];
    $product_prices = [120000,100000,50000,30000,1500000];

    // $productfilePath = "";
    // echo $productfilePath ."/". $product_images[0];
  ?>

  <div class="contanir-fluid">
  <div id="<?php echo $contanirid?>" class="carousel slide w-100" data-ride="carousel">
    <div class="carousel-inner w-100" role="listbox">
      <div class="blue-gradient p-3 m-auto"  style="width: 95%;">
        Top Selling <?php echo $heading ?>
        <!-- <a href="">View All</a> -->
      </div>

      <?php
        for ($i=0; $i < sizeof($product_titles); $i++) { 
          if($i == 0){
            echo "<div class='carousel-item active'>";
          }else {
            echo "<div class='carousel-item'>";
          }
          ?>
            <div class="col-lg-3 col-md-6 p-3">
              <div class="card m-2 rounded-lg shadow-lg">
                <h5 class="card-header bg-info p-2"><?php echo $product_titles[$i]?></h5>
                  <div class="card-body">
                      <div class=" card-img">
                        <img class="card-img "  src="resources\images\<?php echo $product_images[$i] ?>">
                      </div>
                      <p class=" mt-2">asdas asdas asd asdasd asdas d sad asd sada sd sad as da</p>
                      <p class="text-success"><?php echo "Price: ".$product_prices[$i] ." Pkr" ?></p>

                      <div class="btn-group">
                        <img src="resources\images\card_white.png" class="addCardsetCursor rounded-lg mr-2" width="40" height="40" alt="">
                        <img src="resources\images\favrt.png" class="addfavrt rounded-lg" width="40" height="40" alt="">
                        <img src="resources\images\compare.png" class="campare_product rounded-lg ml-2" style="margin-top: -0px;" width="40" height="40" alt="">
                      </div>

                      <!-- <div class="btn-group">
                      <?php //include_once('inc/constants.php'); ?>
                        <img src="resources\images\<?php
//                         $constants = new Constants();
  //                       echo $constants->getIcons()[0];
                         ?>" width="50" height="50" alt="">
                        <img src="resources\images\<?php  // echo $constants->getIcons()[1]; ?>" width="55" height="55" alt="">
                        <img src="resources\images\<?php // echo $constants->getIcons()[2];?>" width="60" height="60" alt="">
                      </div> -->
                  </div>
              </div>
            </div>
          </div>
          <?php
        }
      ?>
  </div>
    <a class="carousel-control-prev" href="#<?php echo $contanirid?>" role="button" data-slide="prev">
      <img src="resources\images\arrow-left.png" style="width: 100px;" alt="">

      <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
      <!-- <span class="sr-only">Previous</span> -->
    </a>
    <a class="carousel-control-next" href="#<?php echo $contanirid?>" role="button" data-slide="next">
      <img src="resources\images\arrow-right.png" style="width: 100px;"  alt="">
      <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span> -->
    </a>
  </div>
  
  <div class="align-content-center" style="text-align: center;">
    <button class="btn btn-info mb-2">View All</button>
  </div>

  </div>
<?php
}

TopSellingItems("myCarousel","Laptops");
TopSellingItems("myCarouselOne","Gaming Laptops");
TopSellingItems("myCarouselTwo","Apple Macbook");

?>
