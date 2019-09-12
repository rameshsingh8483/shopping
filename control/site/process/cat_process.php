<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");
//subcat Process file
if (!empty($_POST["subcat1"])) {
    // Capture selected state
    $subcat = $_POST["subcat1"];

$find=$conn->query("SELECT * FROM subcat_detail WHERE subcat_cat_id='$subcat' order by subcat_name") or die($conn->error);
  echo "<option value='0'>Select</option>";      
 while($row=$find->fetch_assoc())
 {
  echo "<option value='{$row['subcat_id']}'>".$row['subcat_name']."</option>";
 }     
}
if(!empty($_POST['brand1'])){
	
	$sql=$conn->query("SELECT * FROM brand_detail WHERE bd_cat_id = '{$_POST['brand1']}' and bd_level = 'cat'  order by bd_name")or die($conn->error);
	echo"<option value='0'>Select</option>";
	while($row=$sql->fetch_assoc())
	{
	echo "<option value='{$row['bd_id']}'>".$row['bd_name']."</option>";
	}	
	
}

if(!empty($_POST['brand2'])){
	
	$sql=$conn->query("SELECT * FROM brand_detail WHERE bd_cat_id = '{$_POST['brand2']}' and bd_level = 'subcat'  order by bd_name")or die($conn->error);
	echo"<option value='0'>Select</option>";
	while($row=$sql->fetch_assoc())
	{
	echo "<option value='{$row['bd_id']}'>".$row['bd_name']."</option>";
	}	
	
}
?>