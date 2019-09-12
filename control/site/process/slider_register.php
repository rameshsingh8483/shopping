<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(isset($_REQUEST['block1'])){

$sql = $conn->query("SELECT * FROM slider WHERE slider_user_id = '".decr($_REQUEST['block1'])."'")or die($conn->error);

if($sql->num_rows != 0){
	
	$conn->query("DELETE FROM slider WHERE slider_user_id = '".decr($_REQUEST['block1'])."'")or die($conn->error);
}	
$conn->query("INSERT INTO slider(slider_type,slider_user_id)
	VALUES(
		'DEALER',
		'".decr($_REQUEST['block1'])."'
		)")or die($conn->error);	
	header("Location:../dealer_slider_detail.php");
}else{
if(is_ajax()){
	if(empty($_POST['title'])){
		
			$response=array("status"=>"error","msg"=>"Enter Title");	
		
	}elseif(empty($_POST['cat'])){
		
		$response=array("status"=>"error","msg"=>"Select Cat or Sub-Cat or Brand!");
	
}else{
		if($_POST['cat']!=0){
		$level='cat';
		$cat_id=$_POST['cat'];
		$main_cat = $_POST['cat'];
		$cat_subcat = 'cat';
		
		}if($_POST['subcat']!=0){
		$level='subcat';
		$cat_id=$_POST['subcat'];
		$main_cat = $_POST['cat'];
		$cat_subcat = 'subcat';	
		}if($_POST['brand']!=0){
		$level='brand';
		$cat_id=$_POST['brand'];
		$main_cat = $_POST['cat'];
		}

	$subcat = $_POST['subcat']; 

	$conn->query("INSERT INTO slider(slider_type,slider_title,slider_subcat_id,slider_level,slider_cat_subcat,slider_main_cat,slider_cat_id)
	VALUES(
		'PRODUCT',
		'{$_POST['title']}',
		'{$_POST['subcat']}',
		'$level',
		'$cat_subcat',
		'$main_cat',
		'$cat_id'
		)")or die($conn->error);
		
		$response=array("status"=>"success","msg"=>"New Slider Registered !");
		
		}
		echo json_encode($response);	
	}
}
?>