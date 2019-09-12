<?php
require_once("../include/vdooz.php");	
require_once("../include/auth.php");

$conn->query("UPDATE message_detail SET msg_status = 'read' WHERE msg_id = '{$_REQUEST['block']}'")or die($conn->error);
header("Location:../message_detail.php");

	?>