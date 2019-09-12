<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
	if(empty($_POST['fname'])){
		$response=array("status"=>"error","msg"=>"Please Enter Name !");

	}elseif(empty($_POST['email']) or !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$response=array("status"=>"error", "msg"=>"Please Enter Email !");

	}elseif(empty($_POST['mobile']) or !is_numeric($_POST['mobile']) || strlen($_POST['mobile'])!=10){
		$response=array("status"=>"error", "msg"=>"Please Enter Valid Mobile number");

	}elseif(empty($_POST['aadhar']) or !is_numeric($_POST['aadhar']) || strlen($_POST['aadhar'])!=12){
		$response=array("status"=>"error", "msg"=>"Please Enter Valid Aadhar");

	}elseif(empty($_POST['shop_name'])){
		$response=array("status"=>"error", "msg"=>"Please Enter Shop Name !");

	}elseif(empty($_POST['d_address'])){
		$response=array("status"=>"error", "msg"=>"Please Enter Shop Address !");

	}elseif(empty($_POST['city'])){
		$response=array("status"=>"error", "msg"=>"Please Select City !");

	}else{
		
		$sql=$conn->query("select * from user_login where user_mobile='{$_POST['mobile']}' ")or die($conn->error);
		if($sql->num_rows!=0){
			$response=array("status"=>"error","msg"=>"Mobile Already Registered  !");

		}else{
		$conn->query("INSERT INTO user_login(user_mobile,user_email,user_password,user_type,user_regi_id)VALUES(
		'{$_POST['mobile']}',
		'{$_POST['email']}',
		'{$_POST['password']}',
		'DEALER',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
		$id = $conn->insert_id;
            
            if($id<1 or !is_numeric($id)){
               $response=array("status"=>"error", "msg"=>"Error");

             }else{
		$conn->query("INSERT INTO profile_detail(pd_fname,pd_lname,pd_shop_name,pd_aadhar,pd_licence,pd_address,pd_shop_address,pd_shop_mobile,pd_city,pd_user_id,pd_regi_id)VALUES(
		'{$_POST['fname']}',
		'{$_POST['lname']}',
		'{$_POST['shop_name']}',
		'{$_POST['aadhar']}',
		'{$_POST['licence']}',
		'{$_POST['d_address']}',
		'{$_POST['s_address']}',
		'{$_POST['s_mobile']}',
		'{$_POST['city']}',
		'$id',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
			$response=array("status"=>"success","msg"=>"New Dealer Registered !");
			
			 }
		}
	}
				echo json_encode($response);	
}
?>