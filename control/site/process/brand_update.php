<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

$counter=0;
if(is_ajax()){
if(empty($_POST['brand'])){	
$response=array("status"=>"error","msg"=>"Please Enter Brand Name !");
echo json_encode($response);	
}else{
	$sql=$conn->query("select * from brand_detail where bd_name='{$_POST['brand']}' and bd_id='{$_POST['bd_id']}'")or die($conn->error);
	$row=$sql->fetch_assoc();
	
	$sql1=$conn->query("select * from brand_detail where bd_name='{$_POST['brand']}' and bd_id!='{$_POST['bd_id']}' and bd_level='".$row['bd_level']."' and bd_cat_id='".$row['bd_cat_id']."'")or die($conn->error);
	if($sql1->num_rows!=0){
		$response=array("status"=>"error","msg"=>"Brand Name Already Registered !");
		echo json_encode($response);	
	}else{
		$conn->query("UPDATE brand_detail SET
		bd_name='{$_POST['brand']}'
		WHERE bd_id='{$_POST['bd_id']}'
		")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Brand Updated !");
			echo json_encode($response);	
		}
	}
}
?>