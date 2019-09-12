<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

//city Process file
if (!empty($_POST["state1"])) {
    // Capture selected state
    $state = $_POST["state1"];

$sql=$conn->query("SELECT * FROM city_detail WHERE city_state_id='$state' order by city_name") or die($conn->error);
  echo "<option value='0'>Select</option>";      
 while($row=$sql->fetch_assoc())
 {
  echo "<option value='{$row['city_id']}'>".$row['city_name']."</option>";
 }     
}
?>