  <?php

    $imagesPath = "resources/images/";
    $get_header = get_headersImg();
    
    $size = sizeof($get_header);
  ?>

  <div class="slideshow-container">
    <!-- Creating Header Images -->
      <?php
      for ($i=0; $i < $size; $i++) {
        ?>
          <div class="mySlides custom_fade">
            <div class="numbertext"><?php echo "$i / " . $size?></div>
            <img src="<?php echo $imagesPath.$get_header[$i][1]?>" style="width:100%">
            <div class="text"><?php echo $get_header[$i][2]?></div>
          </div>
        <?php
      }
      ?>
          
      <!-- Creating Prev & Next Btn -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
      <br>

      <!-- Creating Image Dot -->

      <div style="text-align:center">
        <?php 
          for ($i=0; $i < $size; $i++) {
            $index = ($i + 1); 
            echo"
              <span class='dot' onclick='currentSlide($index)'></span> 
            ";
          }
        ?>
    </div>

  <script>
      var slideIndex = 1;
      showSlides(slideIndex);
  </script>