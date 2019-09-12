<?php
require_once('../include/vdooz.php');
require_once('../include/auth.php');

if(is_ajax()){
if(empty($_POST['plan_id'])){
	
$response=array("status"=>"error", "msg"=>"Select Plan ");	

}else{	

$sql = $conn->query("SELECT * FROM plan_detail WHERE plan_id = '{$_POST['plan_id']}'")or die($conn->error);

$row = $sql->fetch_assoc();

$time = $row['plan_validity']." ".$row['plan_validity_type'];

$date = date("Y-m-d",strtotime(".$time."));

$conn->query("UPDATE user_login SET
user_status = 'active',
user_plan_id='{$_POST['plan_id']}',
user_plan_expire='$date'
WHERE user_id='{$_POST['id']}'")or die($conn->error);
$response=array("status"=>"success", "msg"=>"Dealer Status Updated ".$time);
}
echo json_encode($response);
}
?>