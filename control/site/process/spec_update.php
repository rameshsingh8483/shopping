<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

if(is_ajax()){

if(empty($_POST['name'])){	
$response=array("status"=>"error","msg"=>"Enter Specification Name !");

}else{

	
		$conn->query("UPDATE specification_detail SET
		spec_name='{$_POST['name']}',
		spec_optional='{$_POST['optional']}',
		spec_filter='{$_POST['filter']}'
		WHERE spec_id='{$_POST['id']}'
		")or die($conn->error);
			$response=array("status"=>"success","msg"=>"Specification Updated !");
		}
			echo json_encode($response);	
}
?>