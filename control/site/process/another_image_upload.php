<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
	
	$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $file_name = uniqid("dealer_",false).".".$imageFileType;
    $location = "../../../upload/product/".$file_name;
    // Check image format
    if($imageFileType != "jpg" && $imageFileType != "PNG" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
         $response=array("status"=>"error","msg"=>"Please Upload only image");
    }else{
	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)) {
	 $conn->query("INSERT INTO product_image (pimg_name ,pimg_pro_id ,pimg_user_id)VALUES(
	 '$file_name',
	 '{$_POST['pro_id']}',
	 '".decr($_SESSION['user_id'])."'
	 )") or die($conn->error);
		
		$response=array("status"=>"success","msg"=>"Image Successfully Uploaded");
 }
	}
	echo json_encode($response);

}
?>
