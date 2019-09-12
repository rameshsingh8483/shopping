<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

$sql=$conn->query("select * from user_login where user_plan_id='".decr($_REQUEST['block'])."'")or die($conn->error);

if($sql->num_rows!=0)
{
echo "Plan Registered in Dealer Profile";
}else{
$conn->query("DELETE FROM plan_detail WHERE plan_id='".decr($_REQUEST['block'])."'")or die($conn->error);
header("Location:../all_plan.php");
}
?>