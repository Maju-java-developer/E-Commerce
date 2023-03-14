<?php
  unset($_SESSION['jobme_laptop_Valid']);
  unset($_SESSION['jobme_laptop_User_ID']);
  session_destroy();
    
  header("Location: ?page=login");

?>