<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");
//print_r2($_POST);
if(is_ajax()){
	if(empty($_POST['cat'] or $_POST['subcat'])){
		$response=array("status"=>"error","msg"=>"Please Select Category or Sub-Category!");
		echo json_encode($response);
	}elseif(empty($_POST['name'])){
		$response=array("status"=>"error","msg"=>"Please Enter Product Specification !");
		echo json_encode($response);
	}elseif(empty($_POST['value'])){
		$response=array("status"=>"error","msg"=>"Please Enter Specification Value !");
		echo json_encode($response);
	}else{
		if($_POST['cat']==""){
		$level='subcat';
		$cat_id=$_POST['subcat'];
		}
		else{
		$level='cat';	
		$cat_id=$_POST['cat'];
		}
		$conn->query("INSERT INTO specification_detail(spec_name,spec_optional,spec_values,spec_filter,spec_level,spec_cat_id)VALUES(
		'{$_POST['name']}',
		'{$_POST['optional']}',
		'{$_POST['value']}',
		'{$_POST['filter']}',
		'$level',
		'$cat_id'
		
		)")or die($conn->error);
			$response=array("status"=>"success","msg"=>"New Specificatin Registered !");
			echo json_encode($response);	
		}
	}
?>