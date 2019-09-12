<?php
require_once('../include/vdooz.php');
//User Register

if(is_ajax()){
if(empty($_POST['fname'])){
$response=array("status"=>"error", "msg"=>"Please Enter Your First name ");

}elseif(empty($_POST['lname'])){
$response=array("status"=>"error", "msg"=>"Please Enter Your Last name");

}elseif(empty($_POST['mobile'])or !is_numeric($_POST['mobile']) || strlen($_POST['mobile'])!=10){
$response=array("status"=>"error", "msg"=>"Enter Valid Mobile");

}elseif(empty($_POST['password'])){
$response=array("status"=>"error", "msg"=>"Please Create Your Password");

}else{
/////////Check unique mobile no	
$sql=$conn->query("SELECT * FROM user_login WHERE user_mobile='{$_POST['mobile']}'") or die($conn->error);

if($sql->num_rows!=0)
	{
	$response=array("status"=>"success", "msg"=>"Mobile Already Registered!");	
}else{

// if Mobile is unique then insert value
	
	$sql=$conn->query("INSERT INTO user_login (user_mobile,user_password,user_type)
	VALUES(
	'{$_POST['mobile']}',
	'{$_POST['password']}',
	'{$_POST['type']}'
	)")or die($conn->error);
	
	//store primary key in profile_detail table
	$id = $conn->insert_id;
	
	$sql=$conn->query("INSERT INTO profile_detail(pd_fname,pd_lname,pd_user_id)
	VALUES(
	'{$_POST['fname']}',
	'{$_POST['lname']}',
	'$id'
	)")or die($conn->error);
	$response=array("status"=>"success", "msg"=>"Registration done");
	}			
}
	echo json_encode($response);	
}			
?>