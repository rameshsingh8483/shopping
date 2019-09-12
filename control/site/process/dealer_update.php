<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
	if(empty($_POST['fname'])){
		$response=array("status"=>"error","msg"=>"Please Enter Name !");

	}elseif(empty($_POST['aadhar']) or !is_numeric($_POST['aadhar']) || strlen($_POST['aadhar'])!=12){
		$response=array("status"=>"error", "msg"=>"Please Enter Valid Aadhar");

	}elseif(empty($_POST['shop_name'])){
		$response=array("status"=>"error", "msg"=>"Please Enter Shop Name !");

	}elseif(empty($_POST['d_address'])){
		$response=array("status"=>"error", "msg"=>"Please Enter Shop Address !");

	}elseif(empty($_POST['city'])){
		$response=array("status"=>"error", "msg"=>"Please Select City !");

	}else{
		$conn->query("UPDATE profile_detail SET
		pd_fname='{$_POST['fname']}',
		pd_lname='{$_POST['lname']}',
		pd_shop_name='{$_POST['shop_name']}',
		pd_aadhar='{$_POST['aadhar']}',
		pd_licence='{$_POST['licence']}',
		pd_address='{$_POST['d_address']}',
		pd_shop_address='{$_POST['s_address']}',
		pd_shop_mobile='{$_POST['s_mobile']}',
		pd_city='{$_POST['city']}'
		WHERE pd_user_id='{$_POST['user_id']}'
		")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Dealer Updated !");
		 }
		 			echo json_encode($response);	

}
?>