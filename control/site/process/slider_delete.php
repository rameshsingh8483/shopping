<?php
require_once("../include/auth.php");
require_once("../include/vdooz.php");

if(isset($_REQUEST['block1'])){

	$conn->query("DELETE FROM slider 
		WHERE slider_user_id='".decr($_REQUEST['block1'])."'
		")or die($conn->error);
	header("Location:../dealer_slider_detail.php");

}else{
		$conn->query("DELETE FROM slider 
		WHERE slider_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		header("Location:../slider_detail.php");
}
	?>