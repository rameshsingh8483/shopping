<?php 
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
if(empty($_POST['name'])) {
	$response=array("status"=>"error", "msg"=>"Please Enter Plan name!");
	echo json_encode($response);
}elseif(empty($_POST['price']) or !preg_match("/^[0-9]*$/",$_POST['price'])) {
	$response=array("status"=>"error", "msg"=>"Please Enter Plan Price!");
	echo json_encode($response);
}elseif(empty($_POST['validity'])){
	 $response=array("status"=>"error", "msg"=>"Please Select Validity !");
	 echo json_encode($response);
}elseif(empty($_POST['validity_type'])){
	 $response=array("status"=>"error", "msg"=>"Please Select Validity Time  !");
	 echo json_encode($response);
}else{
		$conn->query("INSERT INTO plan_detail (plan_name,plan_price,plan_validity,plan_validity_type) 
		values(
		'{$_POST['name']}',
		'{$_POST['price']}',
		'{$_POST['validity']}',
		'{$_POST['validity_type']}'
		)") or die($conn->error);
				$response=array("status"=>"success", "msg"=>"Plan Registered");
				echo json_encode($response);	
				
}
}
?>