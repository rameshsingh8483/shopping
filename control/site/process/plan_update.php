<?php
require_once('../include/vdooz.php');
require_once('../include/auth.php');

//print_r2($_POST);
if(is_ajax()){
if(empty($_POST['name'])){
	$response=array("status"=>"error", "msg"=>"Please Plan name!");
	echo json_encode($response);
}
elseif(empty($_POST['price']) or !preg_match("/^[0-9]*$/",$_POST['price'])) {
	$response=array("status"=>"error", "msg"=>"Please Enter Plan Price!");
	echo json_encode($response);
}else{
$conn->query("UPDATE plan_detail SET
plan_name='{$_POST['name']}',
plan_price='{$_POST['price']}',
plan_validity='{$_POST['validity']}',
plan_validity_type='{$_POST['validity_type']}'
WHERE plan_id='{$_POST['id']}'")or die($conn->error);
$response=array("status"=>"success", "msg"=>"Plan Updated");
echo json_encode($response);
}
}
?>