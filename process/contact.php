<?php
require_once('../include/vdooz.php');
//User Register

if(is_ajax()){
if(empty($_POST['name'])){
$response=array("status"=>"error", "msg"=>"Enter Your name ");

}elseif(empty($_POST['email'])){
$response=array("status"=>"error", "msg"=>"Enter Valid Mobile or Email");

}elseif(empty($_POST['message'])){
$response=array("status"=>"error", "msg"=>"Enter your Enquiry");

}else{
	
	$conn->query("INSERT INTO message_detail (msg_user_name,msg_user_email,msg_user_enquiry)
	VALUES(
	'{$_POST['name']}',
	'{$_POST['email']}',
	'{$_POST['message']}'
	)")or die($conn->error);
	
	$response=array("status"=>"success", "msg"=>"Message sent !");
	}			
	echo json_encode($response);	
}			
?>