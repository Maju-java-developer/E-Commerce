<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>JobMeLaptop | <?php echo SetHeaderTitleByPage()?>  </title>
  <!-- MDB icon -->
  <link rel="icon" href="resources\images\JobMe.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom stsyles (optional) -->
  <link rel="stylesheet" href="css/style.css">
  
</head>
<body>
  <!-- Start your project here-->
<div class="container-fluid p-0">
    <?php

      include_once('templates/navbar.php');
      
      ?>
      <!-- <header class=" w-100 bg-danger mb-1 " style="height: 400px;"> -->
      <?php
        if(isset($_GET['page'])){
          if($_GET['page'] == "home"){
            include_once('templates/headerCarousel.php');
          }
        } 
      ?>
      <!-- </header> -->
      <?php

    ?>