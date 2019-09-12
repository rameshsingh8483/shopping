<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

		$sql = $conn->query("SELECT * FROM product_image
		WHERE pimg_id='".$_POST['id']."'
		")or die($conn->error);
		
		$row = $sql->fetch_assoc();
		unlink("../../../upload/product/".$row['pimg_name']."");			
		
		$conn->query("DELETE FROM product_image
		WHERE pimg_id='".$_POST['id']."'
		")or die($conn->error);

	
?>