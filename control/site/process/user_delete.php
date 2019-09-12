<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

		$conn->query("DELETE FROM user_login 
		WHERE user_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		
		$conn->query("DELETE FROM profile_detail 
		WHERE pd_user_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		header("Location:../user_detail.php");
	?>