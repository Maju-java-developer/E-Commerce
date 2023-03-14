<!--Navbar -->

<?php
  
?>

<nav class="mb-1 navbar navbar-expand-lg navbar-dark blue-gradient">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>

        <!-- This Section is About Dropdown Menu-->
        <div class="nav-item dropdown">
        <div class="nav-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
        </div>

        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
          <li class="dropdown-submenu">
                <a  class="dropdown-item" style="padding: 1px; margin-top: 5px;" tabindex="-1" href="#">Laptops</a>
                <ul class="dropdown-menu p-3">
                  <div class="p-2" style="width: 600px;">
                      <h3 class="w-100" style="margin: 0px; margin-bottom: 5px; padding: 0px;">Laptops</h3>
                      <table style="width: 100%;">

                        <tr>
                          <th>APPLE</th>
                          <th>DELL</th>
                          <th>HP</th>
                        </tr>

                        <tr>
                          <td><a href="#" style="padding:0px; margin:0px;">iMac</a></td>
                          <td><a href="#" style="padding:0px; margin:0px;">iMac</a></td>
                        </tr>

                        <tr>
                          <td><a href="#" style="padding:0px; margin:0px;">iMac</a></td>
                          <!-- <td><a href="#" style="padding:0px; margin:0px;">iMac</a></td> -->
                        </tr>
                      </table>
                  </div>
                </ul>
            </li>
            <!-- closing here dropdown subMenu! -->

            </ul>
            <!-- Close Ul OF Multi Level DropDown Menu! -->
        </div>
        <!-- closed here Dropdown div -->
        </div>
    </ul>

    <!-- Its From Left side Code -->
    <ul class="navbar-nav ml-auto nav-flex-icons">
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
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>

    </ul>
  </div>
</nav>
<!--/.Navbar -->



<!-- Work able Code For Dropdwon Menu-->

<!-- // $subMenuTitles = explode("|",$menuTitles[$i]);
                        // $subMenuLinks = explode('|',$menuLinks[$i]); -->
                        
                        // // <!-- Category In Dropdown -->
                        <!-- // echo "<li class='nav-item dropdown'>";
                        // for ($x=0; $x < sizeof($subMenuTitles); $x++) { 
                        //     if($x == 0){ -->
                                ?>
    <!-- //         <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
    //         aria-haspopup="true" aria-expanded="false"><?php echo $subMenuTitles[$x]?>
    //         </a>
    //         <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
    //         <?php 
    //     }

    //     if($x < sizeof($subMenuTitles) && $x != 0){
    //         echo "<a class='dropdown-item' href='$subMenuLinks[$x]'>$subMenuTitles[$x]</a>";
    //     }

    //     if($x == sizeof($subMenuTitles) -1){
    //         echo "</div>"; 
    //     }
    // }
    // echo "</li>";

//     <!-- <li class="nav-item">
//     <a class="nav-link" href="#">Sales</a>
// </li>
// <li class="nav-item">
//     <a class="nav-link" href="#"> Products</a>
// </li> -->
// </ul>
// <!-- Menus -->






// Product Card
// <!-- <div class="col-xl-9">
// <p style="font-size: 4rem;"><?php echo $cat[1]?></p>
// <p> <?php echo ""?> Items 1-45 of 50</p>
// <hr>

// <div class="row">
//     <?php
//         if($get_product_by_Model != null){
//             for ($i=0; $i < sizeof($get_product_by_Model); $i++) {
//             ?>  
//             <div class="col-md-3">
//                 <div class="card m-2">
//                     <h3 class="bg-info p-1 text-white rounded-sm"><?php echo $get_product_by_Model[$i][2]?></h3>
//                     <div class=" card-img">
//                         <img class="card-img"  src="admin\assets\img\<?php echo $get_product_by_Model[$i][1]?>">
//                     </div>
//                     <div class="card-body">
//                         <?php
//                             $product_cat = get_categoryTitle_ByRID($get_product_by_Model[$i][3]);
//                             if($get_product_by_Model[$i][9] != ""){
//                                 ?>
//                                     <p for="Description" onclick="javasript:window.location.href='?page=<?php echo $product_cat[0][1]?>&product_id=<?php echo $get_product_by_Model[$i][0]?>'" style="text-decoration: underline; cursor: pointer;"><?php echo $get_product_by_Model[$i][7]?></p>
//                                 <?php
//                             }else {
//                                 ?>
//                                     <p for="Description" onclick="javasript:window.location.href='?page=<?php echo $product_cat[0][1]?>&product_id=<?php echo $get_product_by_Model[$i][0]?>'" style="text-decoration: underline; cursor: pointer;">No Description</p>
//                                 <?php
//                             }
//                         ?>
//                         <p class=" text-success"><?php echo "Rs." . $get_product_by_Model[$i][9]?></p>

//                         <div class="btn-group">
//                             <img src="resources\images\card_white.png" class="addCardsetCursor rounded-lg mr-2" width="40" height="40" alt="">
//                             <img src="resources\images\favrt.png" class="addfavrt rounded-lg" width="40" height="40" alt="">
//                             <img src="resources\images\compare.png" class="campare_product rounded-lg ml-2" style="margin-top: -0px;" width="40" height="40" alt="">
//                         </div>

//                     </div>
//                 </div>
//             </div>
//             <?php
//             }
//         }else {
//             ?>
//                 <div class="p-3 m-1 bg-danger w-100">We have couldn't find products of your wishist</div>
//             <?php
//         }
//     ?>

// </div>
// <!-- row div-->
