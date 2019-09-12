<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

	$sql=$conn->query("DELETE FROM brand_detail WHERE bd_id='".decr($_REQUEST['block'])."'")or die($conn->error);
	
	header("Location:../dashboard.php");
?>