<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

		$conn->query("DELETE FROM cat_detail 
		WHERE cat_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		header("Location:../cat_detail.php");
	?>