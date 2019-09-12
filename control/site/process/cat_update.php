<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
if(empty($_POST['cat']) or !preg_match("/^[A-Za-z ]*$/",$_POST['cat'])){	
$response=array("status"=>"error","msg"=>"Please Enter Category Name !");
echo json_encode($response);	
}else{
	$sql=$conn->query("select * from cat_detail where cat_name='{$_POST['cat']}' and cat_id!='{$_POST['cat_id']}'")or die($conn->error);
	if($sql->num_rows!=0){	
		$response=array("status"=>"error","msg"=>"Category Name is Already Registered !");
		echo json_encode($response);	
		}else{
		$conn->query("UPDATE cat_detail SET
		cat_name='{$_POST['cat']}'
		WHERE cat_id='{$_POST['cat_id']}'
		")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Category Updated !");
			echo json_encode($response);	
		}
	}
}
?>