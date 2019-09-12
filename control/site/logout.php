<?php
  require_once("include/vdooz.php");
  
  $var=$_SESSION['user_type'];
  if($var=='ADMIN'){
  session_unset(); 
  session_destroy(); 
  unset($_COOKIE[$admin_id]);
  $res = setcookie($cookie_name, '', time() - 60*60*24*30*12);
  header('location:13994vdoozcoder.php');
   exit; 
  }
  if($var=='DEALER'){
	session_unset(); 
  session_destroy(); 
  unset($_COOKIE[$user_id]);
  $res = setcookie($cookie_name, '', time() - 60*60*24*30*12);
  header('location:index.php');
   exit;  
  }
  if($var=='USER'){
	session_unset(); 
  session_destroy(); 
  unset($_COOKIE[$user_id]);
  $res = setcookie($cookie_name, '', time() - 60*60*24*30*12);
  header('location:user_login.php');
   exit;  
  }
?>
