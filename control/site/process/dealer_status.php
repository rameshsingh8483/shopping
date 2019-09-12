<?php
require_once("../include/vdooz.php");	
require_once("../include/auth.php");

$conn->query("UPDATE user_login SET user_status = 'delete' where user_id = '".decr($_REQUEST['block'])."' and user_type = 'DEALER'")or die($conn->error);

$conn->query("DELETE FROM slider where slider_user_id = '".decr($_REQUEST['block'])."' and slider_type = 'DEALER'")or die($conn->error);

header("Location:../dashboard.php");

	?>