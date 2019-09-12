<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

		$conn->query("DELETE FROM product_detail
		WHERE pro_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		
		$conn->query("DELETE FROM product_spec
		WHERE ps_pro_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		
		unlink("../../../upload/product/".$_REQUEST['block1']."");	
	
		$sql = $conn->query("SELECT * FROM product_image
		WHERE pimg_pro_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
			
		while($row = $sql->fetch_assoc()){	
			
		unlink("../../../upload/product/".$row['pimg_name']."");	
		
		}
		$conn->query("DELETE FROM product_image
		WHERE pimg_pro_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		
		$conn->query("DELETE FROM cart_detail
		WHERE cart_pro_id='".decr($_REQUEST['block'])."'
		")or die($conn->error);
		
	header("Location:../dashboard.php");	
	
?>