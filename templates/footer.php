
  </div>
  <!-- End your project here-->

  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.slim.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
  <script type="text/javascript" src="js/carousel.js"></script>
   <!-- Your custom Script (optional) -->
   <script type="text/javascript" src="js/script.js"></script>
 
  <?php
  if(isset($_GET['page']) && $_GET['page'] == "exit"){
    ?>
    <script>
      window.close();    
    </script>
    <?php
  
  }
  
  ?>
</body>
</html>
