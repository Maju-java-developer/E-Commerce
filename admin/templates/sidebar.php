<?php

    // $sideBarmenus = getMenuRow();
    // $menu = null;

    // foreach($sideBarmenus as $sideBarmenu){
    //     $type = $sideBarmenu[5];
    //     if($type == "SideBar"){
    //         $menu = $sideBarmenu;
    //     }
    // }

    // $sideBarMenuTitles = explode(",",$menu[1]);
    // $size = sizeof($sideBarMenuTitles);
    // echo "<script>alert('$size');</script>";

    // for ($i=0; $i < sizeof($sideBarMenuTitles); $i++) { 
    //     echo "<script>alert('$sideBarMenuTitles[$i]');</script>";
    // }
    
?>

<div class="sidebar" data-image="assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.jobme.pk" class="simple-text">
                JobME.pk
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item active">

                <a class="nav-link p-2" href="?page=dashboard">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
               <a class="nav-link p-2" href="?page=list_product">
                    <i class="fa fa-cubes"></i>
                    <p>Product</p>
                </a>
                <a class="nav-link p-2" href="?page=orders_list">
                    <i class="fa fa-list"></i>
                    <p>Orders</p>
                </a>
                <a class="nav-link p-2" href="?page=sale_list">
                    <i class="fa fa-list"></i>
                    <p>Sales</p>
                </a>

            </li>
        </ul>
    </div>
</div>