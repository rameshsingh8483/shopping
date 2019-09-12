<?php
require_once("../include/vdooz.php");

if(is_ajax()){
if(empty($_POST['mobile'])/* or !preg_match("/^[0-9 ]*$/",$_POST['mobile'])*/){	
$response=array("status"=>"error","msg"=>"Please enter valid Mobile !");

}elseif(empty($_POST['password'])){
$response=array("status"=>"error","msg"=>"Please enter correct Password !");

}else{
	
if($_POST['user_type']=='ADMIN'){
$sql=$conn->query("select * from user_login where user_mobile='{$_POST['mobile']}' and user_password='{$_POST['password']}'")or die($conn->error);

if($sql->num_rows!=0){	
$row=$sql->fetch_assoc();
$_SESSION['user_id']=encr($row['user_id']);
$_SESSION['user_type']='ADMIN';
$time = time()+60*60*24*30*12;
     setcookie('cuser', encr($row['user_id']),$time,'/');
	 $response=array("status"=>"success","msg"=>"Admin login done !");

}else
	$response=array("status"=>"error","msg"=>"Invalid Mobile or Password");

}elseif($_POST['user_type']=='DEALER'){
$sql=$conn->query("select * from user_login where user_mobile='{$_POST['mobile']}' and user_password='{$_POST['password']}'")or die($conn->error);	

if($sql->num_rows!=0){	
$row=$sql->fetch_assoc();
$_SESSION['user_id']=encr($row['user_id']);
$_SESSION['user_type']=$row['user_type'];
$time = time()+60*60*24*30*12;
     setcookie('cuser', encr($row['user_id']),$time,'/');
	 $response=array("status"=>"success","msg"=>"Dealer Login Done");

}else
$response=array("status"=>"error","msg"=>"Invalid mobile or Password !");

	}else{
$sql=$conn->query("select * from user_login where user_mobile='{$_POST['mobile']}' and user_password='{$_POST['password']}'")or die($conn->error);	

if($sql->num_rows!=0){	
$row=$sql->fetch_assoc();
$_SESSION['user_id']=encr($row['user_id']);
$_SESSION['user_type']=$row['user_type'];
$time = time()+60*60*24*30*12;
     setcookie('cuser', encr($row['user_id']),$time,'/');
	 $response=array("status"=>"success","msg"=>"User Login Done");

}else
$response=array("status"=>"error","msg"=>"Invalid mobile or Password !");
	
}	
}
echo json_encode($response);	

}
?>