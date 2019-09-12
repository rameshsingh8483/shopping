<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
if(empty($_POST['subcat']) or !preg_match("/^[A-Za-z ]*$/",$_POST['subcat'])){	
$response=array("status"=>"error","msg"=>"Please Enter Sub-Category Name !");
echo json_encode($response);	
}else{
	$sql=$conn->query("select * from subcat_detail where subcat_name='{$_POST['subcat']}' and subcat_id!='{$_POST['subcat_id']}'")or die($conn->error);
	if($sql->num_rows!=0){	
		$response=array("status"=>"error","msg"=>"Sub-Category Name is Already Registered !");
		echo json_encode($response);	
		}else{
		$conn->query("UPDATE subcat_detail SET
		subcat_name='{$_POST['subcat']}'
		WHERE subcat_id='{$_POST['subcat_id']}'
		")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Sub Category Updated !");
			echo json_encode($response);	
		}
	}
}
?>