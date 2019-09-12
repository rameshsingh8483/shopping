<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

	$sql=$conn->query("DELETE FROM subcat_detail WHERE subcat_id='".decr($_REQUEST['block'])."'")or die($conn->error);
	
	header("Location:../dashboard.php");

?>