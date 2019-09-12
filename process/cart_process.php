<?php
require_once('../include/vdooz.php');

if (! empty($_POST["id"])) {
    

$sql = $conn->query("SELECT * FROM product_profile WHERE vpro_id = '".$_POST['id']."' and vps_spec_name = 'Price' ") or die($conn->error);
  
   $row = $sql->fetch_assoc();

// check already added product in cart

$sql1 = $conn->query("SELECT * FROM cart_detail WHERE cart_pro_id = '".$_POST['id']."' and cart_user_id = '".decr($_SESSION['user_id'])."' ") or die($conn->error);
 
if( $sql1->num_rows == 0){
 
	$data = $conn->query("INSERT INTO cart_detail (cart_pro_name,cart_pro_image,cart_pro_price,cart_pro_id,cart_user_id)VALUES(
	'{$row['vpro_name']}',
	'{$row['vpro_image']}',
	'{$row['vps_spec_value']}',
	'{$row['vpro_id']}',
	'".decr($_SESSION['user_id'])."'
	)
	")or die($conn->error);

}

}
?>