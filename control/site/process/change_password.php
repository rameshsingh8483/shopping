<?php 
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
if(empty($_POST['old_password'])) {
	$response=array("status"=>"error", "msg"=>"Please Enter Current Password");

}elseif(empty($_POST['new_password'])) {
	$response=array("status"=>"error", "msg"=>"Please Enter New Password");

}elseif(empty($_POST['conf_password'])){
	$response=array("status"=>"error", "msg"=>"Please Confirm Your Password");

}elseif($_POST['new_password']!=$_POST['conf_password']){
	 $response=array("status"=>"error", "msg"=>"Your Password Dosn't match");

}else{

if($_SESSION['user_type']=='ADMIN'){
$q=$conn->query("SELECT * FROM user_login WHERE user_id='".decr($_SESSION['user_id'])."' and user_password='".$_POST['old_password']."'");
if($q->num_rows!=0)
{
	if($_POST['new_password']==$_POST['conf_password'])
	{
		$conn->query("UPDATE user_login SET user_password='".$_POST['new_password']."' WHERE user_id='".decr($_SESSION['user_id'])."'");
				$response=array("status"=>"success", "msg"=>"Password  Changed");
				
	}else{
	$response=array("status"=>"warning", "msg"=>"Password mismatch");	
	
	}
}else{
	$response=array("status"=>"error", "msg"=>"Please enter Correct Password!");
	
}		
}

//dealer change password
elseif($_SESSION['user_type']=='DEALER'){
$q=$conn->query("SELECT * FROM user_login WHERE user_id='".decr($_SESSION['user_id'])."' and user_password='".$_POST['old_password']."'") or die($conn->error);
if($q->num_rows!=0)
{
	if($_POST['new_password']==$_POST['conf_password'])
	{
		$conn->query("UPDATE user_login SET user_password='".$_POST['new_password']."' WHERE user_id='".decr($_SESSION['user_id'])."'");
				$response=array("status"=>"success", "msg"=>"Password Changed");
	
	}
	else{
	$response=array("status"=>"warning", "msg"=>"Password mismatch");	
	
	}
}
else{
	$response=array("status"=>"error", "msg"=>"Please enter Correct Password!");
	
}		

}
else{
$q=$conn->query("SELECT * FROM user_login WHERE user_id='".decr($_SESSION['user_id'])."' and user_password='".$_POST['old_password']."'") or die($conn->error);
if($q->num_rows!=0)
{
	if($_POST['new_password']==$_POST['conf_password'])
	{
		$conn->query("UPDATE user_login SET user_password='".$_POST['new_password']."' WHERE user_id='".decr($_SESSION['user_id'])."'");
				$response=array("status"=>"success", "msg"=>"Password Changed");
	
	}
	else{
	$response=array("status"=>"warning", "msg"=>"Password mismatch");	
	
	}
}
else{
	$response=array("status"=>"error", "msg"=>"Please enter Correct Password!");
	
}		

}
}
echo json_encode($response);	
}
?>