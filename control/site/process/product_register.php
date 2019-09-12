<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

//print_r2($_POST);
if(is_ajax()){
	
	//Check product register validation
	if(empty($_POST['cat'] or $_POST['subcat'])){
		$response=array("status"=>"error","msg"=>"Please Select Category or Sub-category !");

	}elseif(empty($_POST['type'])){
		$response=array("status"=>"error","msg"=>"Select Product type !");

	}elseif(empty($_POST['name'])){
		$response=array("status"=>"error","msg"=>"Enter Product Name !");

	}elseif(empty($_POST['city'])){
		$response=array("status"=>"error","msg"=>"Select City !");

	}elseif(empty($_FILES)){
		$response=array("status"=>"error","msg"=>"Choose Product Main Image !");
	}elseif(empty($_POST['id'])){
		$response=array("status"=>"error","msg"=>"Register Product Specification  !");

	}
	// End product validation
	
	//Change file name with unique name
	else{            
	$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $file_name = uniqid("product_",false).".".$imageFileType;
    $location = "../../../upload/product/".$file_name;
	
	///close unique name
    
	// Check image format
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        $response=array("status"=>"error","msg"=>"Choose Product Main Image  !"); 
    
	}else{

//check specification optional validation

//get input text value

if(isset($_POST['spec_input'])){
$array1 = array();

foreach($_POST['spec_input'] as $key => $inputvalue){
if($key >=0){

 $array1[$key] = $inputvalue;
}
}

}
//select values

if(isset($_POST['spec_filter'])){
$array2 = array();

foreach($_POST['spec_filter'] as $key => $selectvalue){
if($key >=0){

 $array2[$key] = $selectvalue;

}
}
}
//close input value


// check optional value and input field value 	
if(isset($_POST['id'])){
foreach($_POST['id'] as $key => $id){
if($key >=0){
	$sql = $conn->query("SELECT * FROM specification_detail where spec_id = '$id' ")or die($conn->error);	 
	
	$row = $sql->fetch_assoc();
  
  if( ($row['spec_optional'] == 1) and ($array1[$key] == "")){
	$response=array("status"=>"error","msg"=>"Optional Specification ".$row['spec_name']);
	goto msg;
}
}
}
}	
//close validation optional value
	
//if all validation done

		$main_cat = $_POST['cat'];

	//store sub_cat , level and cat_id according to selected value

	if( $_POST['subcat'] == 0 ){
		$cat_subcat = 'cat';
		$cat_id = $_POST['cat'];		
		$level = 'cat';
		
		}else{
		$cat_subcat = 'subcat';	
		$cat_id = $_POST['subcat'];
		$level = 'subcat';
		}
	
	
	//insert product detail in product_detail table
	
		if(move_uploaded_file($_FILES['file']['tmp_name'],$location)) {

		if( $_POST['brand'] != "" and $_POST['brand'] !=0 ){
		
		$level = 'brand';
		$cat_id = $_POST['brand'];
		}
		$conn->query("INSERT INTO product_detail(pro_name,pro_type,pro_image,pro_level,pro_desc,pro_cat_subcat,pro_cat_id,pro_main_cat,pro_city_id,pro_user_type,pro_user_id)VALUES(
		'{$_POST['name']}',
		'{$_POST['type']}',
		'$file_name',
		'$level',
		'{$_POST['desc']}',
		'$cat_subcat',
		'$cat_id',
		'$main_cat',
		'{$_POST['city']}',
		'".$_SESSION['user_type']."',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
			
		}	
		
	//close 	
		
	$pro_id = $conn->insert_id;


	//insert image in product_image table
	if(isset($_FILES['file1'])){
	$imageFile1 = pathinfo($_FILES['file1']['name'],PATHINFO_EXTENSION);
    $file1 = uniqid("product_",false).".".$imageFile1;
    $location1 = "../../../upload/product/".$file1;
	
	if(move_uploaded_file($_FILES['file1']['tmp_name'],$location1)) {

		$conn->query("INSERT INTO product_image(pimg_name,pimg_pro_id,pimg_user_id)VALUES(
		'$file1',
		'$pro_id',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
			
		}
	}
	if(isset($_FILES['file2'])){
	$imageFile2 = pathinfo($_FILES['file2']['name'],PATHINFO_EXTENSION);
    $file2 = uniqid("product_",false).".".$imageFile2;
    $location2 = "../../../upload/product/".$file2;
	if(move_uploaded_file($_FILES['file2']['tmp_name'],$location2)) {

		$conn->query("INSERT INTO product_image(pimg_name,pimg_pro_id,pimg_user_id)VALUES(
		'$file2',
		'$pro_id',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
			
		}
	}
	if(isset($_FILES['file3'])){
	$imageFile3 = pathinfo($_FILES['file3']['name'],PATHINFO_EXTENSION);
    $file3 = uniqid("product_",false).".".$imageFile3;
    $location3 = "../../../upload/product/".$file3;
	if(move_uploaded_file($_FILES['file3']['tmp_name'],$location3)) {

		$conn->query("INSERT INTO product_image(pimg_name,pimg_pro_id,pimg_user_id)VALUES(
		'$file3',
		'$pro_id',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
			
		}
	}
	if(isset($_FILES['file4'])){
	$imageFile4 = pathinfo($_FILES['file4']['name'],PATHINFO_EXTENSION);
    $file4 = uniqid("product_",false).".".$imageFile4;
    $location4 = "../../../upload/product/".$file4;
	if(move_uploaded_file($_FILES['file4']['tmp_name'],$location4)) {

		$conn->query("INSERT INTO product_image(pimg_name,pimg_pro_id,pimg_user_id)VALUES(
		'$file4',
		'$pro_id',
		'".decr($_SESSION['user_id'])."'
		)")or die($conn->error);
			
		}
	}	

//create array to store input ps_id 
if(isset($_POST['spec_input'])){
$array = array();

foreach($array1 as $key => $value){
if($key >=0){
	//insert some data in product_spec table
	$conn->query("INSERT INTO product_spec(ps_spec_value,ps_spec_type,ps_pro_id)VALUES(
		'$value',
		'{$_POST['type']}',
		'$pro_id'
		)")or die($conn->error);
	
	$ps_id = $conn->insert_id;
	$array[$key] = $ps_id;   //set ps_id in array 
	 
}
}	

//close 

//update ps_spec_id and spec_name in product_spec table
foreach($_POST['id'] as $key => $id){

if($key >=0){
	
$sql = $conn->query("SELECT * FROM specification_detail where spec_id = '$id' ")or die($conn->error);	 
	
$row = $sql->fetch_assoc();	
	
$conn->query("UPDATE product_spec SET ps_spec_id = '$id',
ps_spec_name = '".$row['spec_name']."'
where ps_id = '".$array[$key]."'")or die($conn->error);

}
}	

}

//close


//create array to store select ps_id 
if(isset($_POST['filter_id'])){
$array3 = array();

foreach($array2 as $key => $value){
if($key >=0){
	//insert some data in product_spec table
	$conn->query("INSERT INTO product_spec(ps_spec_value,ps_spec_type,ps_pro_id)VALUES(
		'$value',
		'{$_POST['type']}',
		'$pro_id'
		)")or die($conn->error);
	
	$ps_id = $conn->insert_id;
	 $array3[$key] = $ps_id;   //set ps_id in array 
	 
}
}	
//close 

//update ps_spec_id and spec_name in product_spec table
foreach($_POST['filter_id'] as $key => $id){

if($key >=0){
	
$sql = $conn->query("SELECT * FROM specification_detail where spec_id = '$id' ")or die($conn->error);	 
	
$row = $sql->fetch_assoc();	
	
$conn->query("UPDATE product_spec SET ps_spec_id = '$id',
ps_spec_name = '".$row['spec_name']."'
where ps_id = '".$array3[$key]."'")or die($conn->error);

}
}

}	
	$response=array("status"=>"success","msg"=>"Product inserted Successfully !");
	}
	}
	msg:
		echo json_encode($response);	
	}
		
?>	