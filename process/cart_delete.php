<?php
require_once('../include/vdooz.php');


$conn->query("DELETE FROM cart_detail WHERE cart_pro_id = '".$_REQUEST['block']."' and cart_user_id = '".decr($_SESSION['user_id'])."' ") or die($conn->error);

header("Location:../cart.php");
 
?>