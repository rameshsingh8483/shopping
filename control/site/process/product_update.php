<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

print_r2($_POST);
if(is_ajax()){
	
	//Check product register validation
	if(empty($_POST['type'])){
		$response=array("status"=>"error","msg"=>"Select Product type !");

	}elseif(empty($_POST['name'])){
		$response=array("status"=>"error","msg"=>"Enter Product Name !");

	}elseif(empty($_POST['city'])){
		$response=array("status"=>"error","msg"=>"Select City !");

	// End product validation
	
	//Change file name with unique name
	}else{          	
//if all validation done
		
	//insert product detail in product_detail table
		$conn->query("UPDATE product_detail SET
		pro_name = '{$_POST['name']}',
		pro_type = '{$_POST['type']}',
		pro_desc = '{$_POST['desc']}',
		pro_city_id = '{$_POST['city']}'
		WHERE pro_user_id = '".decr($_SESSION['user_id'])."'
		and pro_id = '{$_POST['pro_id']}'
		
		")or die($conn->error);
			

	//close 	
	
	$array = array();	
foreach($_POST['id'] as $key => $id){

if($key >=0){
	
$sql = $conn->query("SELECT * FROM specification_detail where spec_id = '$id' ")or die($conn->error);	 
	
$row = $sql->fetch_assoc();	
	
$conn->query("UPDATE product_spec SET
ps_spec_name = '".$row['spec_name']."'
 where ps_spec_id = '$id'")or die($conn->error);

}
$array[$key] = $id;
}	


//create array to storing ps_id 

foreach($_POST['spec_input'] as $key => $value){
if($key >=0){
	//insert some data in product_spec table
	$conn->query("UPDATE  product_spec SET
	ps_spec_value = '$value'
	WHERE ps_spec_id = '".$array[$key]."'
	and ps_pro_id = '{$_POST['pro_id']}'
	")or die($conn->error);
	
}
}	
//close 

//update ps_spec_id and spec_name in product_spec table
//close
	$response=array("status"=>"success","msg"=>"Changed Successfull !");
	}
	msg:
		echo json_encode($response);	
	}
		
?>	