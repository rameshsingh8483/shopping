<?php
  require_once("include/vdooz.php");
  session_unset(); 
  session_destroy(); 
  header('location:index.php');
   exit; 
?>