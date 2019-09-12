<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

//print_r2($_POST);
if(is_ajax()){

if(empty($_POST['cat'] or $_POST['subcat'])){
	$response=array("status"=>"error","msg"=>"Select Category or Sub-Category!");

}elseif(empty($_POST['name'])){
	$response=array("status"=>"error","msg"=>"Enter Product Specification !");

}else{
	
	$spec_main_cat = $_POST['cat'];
	
	if($_POST['subcat']==0){
	$level = "cat";
	$cat_id = $_POST['cat'];
	
	}else{
	$level = "subcat";	
	$cat_id = $_POST['subcat']; 
	}
	
	///////check First specification Price or not
	$sql = $conn->query("select * from specification_detail where spec_level = '".$level."'  and spec_cat_id = ".$cat_id."")or die($conn->error);
	
	if($sql->num_rows == 0){
		if(($_POST['name'] != 'Price')){
			$response=array("status"=>"error","msg"=>" Enter Frist specfication Price ");
			goto a;
		}
	}
	
	if(isset($_POST['value']))
		$value = implode("," , $_POST['value']);
	
	else
	   $value = "";	
   
//	echo "select * from specification_detail where spec_name='{$_POST['name']}' and spec_level = '".$level."'  and spec_cat_id = ".$cat_id."";	
		
	$sql = $conn->query("select * from specification_detail where spec_name='{$_POST['name']}' and spec_level = '".$level."'  and spec_cat_id = ".$cat_id."")or die($conn->error);
	
	if( $sql->num_rows != 0 ){	
	$response=array("status"=>"error","msg"=>"Specification is already Registered in these ".$level);

	}else{
	$conn->query("INSERT INTO specification_detail(spec_name,spec_values,spec_optional,spec_filter,spec_level,spec_cat_id,spec_main_cat)VALUES(
	'{$_POST['name']}',
	'$value',
	'{$_POST['optional']}',
	'{$_POST['filter']}',
	'$level',
	'$cat_id',
	'$spec_main_cat'
	
	)")or die($conn->error);
		$response=array("status"=>"success","msg"=>"New Specificatin Registered !");
	
	}
}
		a:
		echo json_encode($response);
}
?>