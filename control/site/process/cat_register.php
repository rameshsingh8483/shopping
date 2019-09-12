<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
if(empty($_POST['cat']) or !preg_match("/^[A-Za-z ]*$/",$_POST['cat'])){	
$response=array("status"=>"error","msg"=>"Please Enter Category Name !");
echo json_encode($response);	
}else{
	$sql=$conn->query("select * from cat_detail where cat_name='{$_POST['cat']}'")or die($conn->error);
	if($sql->num_rows!=0){	
		$response=array("status"=>"error","msg"=>"Category Name is Already Registered !");
		echo json_encode($response);	
		}else{
			
		$conn->query("INSERT INTO cat_detail(cat_name)VALUES('{$_POST['cat']}')")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Category Registration done !");
			echo json_encode($response);	
		}
	}
}
?>