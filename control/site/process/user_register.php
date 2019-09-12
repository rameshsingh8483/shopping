<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
	if(empty($_POST['fname'])){
		$response=array("status"=>"error","msg"=>"Please Enter First Name !");

	}elseif(empty($_POST['mobile']) or !is_numeric($_POST['mobile']) || strlen($_POST['mobile'])!=10){
		$response=array("status"=>"error", "msg"=>"Please Enter Valid Mobile number");

	}elseif(empty($_POST['address'])){
		$response=array("status"=>"error", "msg"=>"Enter User Address");

	}elseif(empty($_POST['password'])){
		$response=array("status"=>"error", "msg"=>"Create User password");

	}elseif(empty($_POST['password'])){
		$response=array("status"=>"error", "msg"=>"Create User password");

	}elseif(empty($_POST['city'])){
		$response=array("status"=>"error", "msg"=>"Please Select City !");

	}else{
		
		$sql=$conn->query("select * from user_login where user_mobile='{$_POST['mobile']}' ")or die($conn->error);
		if($sql->num_rows!=0){
			$response=array("status"=>"error","msg"=>"Mobile Already Registered  !");

		}else{
		$conn->query("INSERT INTO user_login(user_mobile,user_password,user_type)VALUES(
		'{$_POST['mobile']}',
		'{$_POST['password']}',
		'USER'
		)")or die($conn->error);
		$id = $conn->insert_id;
            
            if($id<1 or !is_numeric($id)){
               $response=array("status"=>"error", "msg"=>"Error");

             }else{
		$conn->query("INSERT INTO profile_detail(pd_fname,pd_lname,pd_address,pd_city,pd_user_id)VALUES(
		'{$_POST['fname']}',
		'{$_POST['lname']}',
		'{$_POST['address']}',
		'{$_POST['city']}',
		'$id'
		)")or die($conn->error);
			$response=array("status"=>"success","msg"=>"User Registered !");

			 }
		}
	}
				echo json_encode($response);	
}
?>