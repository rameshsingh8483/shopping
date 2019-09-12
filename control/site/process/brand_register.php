<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");
if(is_ajax()){
	
	if(empty($_POST['cat'] or $_POST['subcat'])){
		$response=array("status"=>"error","msg"=>"Please Select Category or Sub-category !");
		
	}elseif(empty($_POST['brand'])){
		$response=array("status"=>"error","msg"=>"Please Enter Brand Name !");
		
	}else{
		
		if($_POST['subcat']==0){
		$level='cat';
		$cat_id=$_POST['cat'];
		
		}else{
		$level='subcat';	
		$cat_id=$_POST['subcat'];
		}
		
		$sql=$conn->query("select * from brand_detail where bd_name='{$_POST['brand']}' and bd_level='$level' and bd_cat_id='$cat_id'")or die($conn->error);
		
		if($sql->num_rows!=0){
			$response=array("status"=>"error","msg"=>"Brand Already Registered in ".$level);
		
		}else{
		$conn->query("INSERT INTO brand_detail(bd_name,bd_level,bd_cat_id)VALUES(
		'{$_POST['brand']}',
		'$level',
		'$cat_id'
		)")or die($conn->error);
		
		$response=array("status"=>"success","msg"=>"New Brand Registered !");
		
		}
	}
		echo json_encode($response);	
}
?>