<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){

	$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $file_name = uniqid("banner_",false).".".$imageFileType;
    $location = "../../../upload/banner/".$file_name;
    // Check image format
    if($imageFileType != "jpg" && $imageFileType != "PNG" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
         $response=array("status"=>"error","msg"=>"Please Upload only image");
    }else{
	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)) {
	 $conn->query("UPDATE profile_detail SET pd_banner='$file_name' WHERE pd_user_id='".decr($_SESSION['user_id'])."'") or die($conn->error);
		
		$response=array("status"=>"success","msg"=>"Banner Successfully Uploaded");
 }
	}
	echo json_encode($response);

}
?>
