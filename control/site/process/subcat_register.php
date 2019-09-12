<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
if(empty($_POST['cat']) or !preg_match("/^[0-9 ]*$/",$_POST['cat'])){	
$response=array("status"=>"error","msg"=>"Please Select Category !");
echo json_encode($response);	
}elseif(empty($_POST['subcat'])){	
$response=array("status"=>"error","msg"=>"Please Enter Sub-Cat name !");
echo json_encode($response);	
}else{
	$sql=$conn->query("select * from subcat_detail where subcat_name='{$_POST['subcat']}' and subcat_cat_id='{$_POST['cat']}'")or die($conn->error);
	if($sql->num_rows!=0){	
		$response=array("status"=>"error","msg"=>"Sub-Cat name is Already Registered in these Category !");
		echo json_encode($response);	
		}else{
			
		$conn->query("INSERT INTO subcat_detail(subcat_name,subcat_cat_id)VALUES('{$_POST['subcat']}','{$_POST['cat']}')")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Category Registration done !");
			echo json_encode($response);	
		}
	}
}
?>