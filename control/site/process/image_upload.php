<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){
	
	$imageFileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $file_name = uniqid("dealer_",false).".".$imageFileType;
    $location = "../../../upload/dealer/".$file_name;
    // Check image format
    if($imageFileType != "jpg" && $imageFileType != "PNG" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
         $response=array("status"=>"error","msg"=>"Please Upload only image");
    }else{
	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)) {
	
	$sql = $conn->query("SELECT * FROM profile_detail
	WHERE pd_user_id='".decr($_SESSION['user_id'])."'")or die($conn->error);
	$row = $sql->fetch_assoc();
	unlink("../../../upload/dealer/".$row['pd_image']."");			
	
	$conn->query("UPDATE profile_detail SET pd_image='$file_name' WHERE pd_user_id='".decr($_SESSION['user_id'])."'") or die($conn->error);


		$response=array("status"=>"success","msg"=>"Image Successfully Uploaded");
 }
	}
	echo json_encode($response);

}
?>
