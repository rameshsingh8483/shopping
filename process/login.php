<?php
require_once('../include/vdooz.php');
//User login

if(is_ajax()){
if(empty($_POST['mobile'])){
$response=array("status"=>"error", "msg"=>"Enter Valid Mobile");

}elseif(empty($_POST['password'])){
$response=array("status"=>"error", "msg"=>"Please Create Your Password");

}else{	
$sql=$conn->query("SELECT * FROM user_login WHERE user_mobile='{$_POST['mobile']}' AND 
user_password = '{$_POST['password']}' and user_type = 'USER'
") or die($conn->error);

if($sql->num_rows!=0)
	{
		$row = $sql->fetch_assoc();
	
	$_SESSION['user_id']=encr($row['user_id']);
	$response=array("status"=>"success", "msg"=>"Login Success!");	
}else{

	$response=array("status"=>"error", "msg"=>"Invalid mobile or password !");
	}		
}
	echo json_encode($response);	
}		
?>