<?php
require_once('../include/vdooz.php');

//Subcat Process file
if (! empty($_POST["cat_id"])) {
    
	$cat_id = $_POST["cat_id"];

$find = $conn->query("SELECT * FROM subcat_detail WHERE subcat_cat_id='$cat_id' order by subcat_name") or die($conn->error);
  echo "<option value='0'>Select</option>";      
 
 while( $row = $find->fetch_assoc() ){
  echo "<option value='{$row['subcat_id']}'>".$row['subcat_name']."</option>";
 }     

}

    // selecte Brand
if (! empty($_POST["cat_id2"])) {
    $cat_id2 = $_POST["cat_id2"];

$find1 = $conn->query("SELECT * FROM brand_detail WHERE bd_cat_id='$cat_id2' AND bd_level = 'cat' order by bd_name") or die($conn->error);

echo "<option value='0'>Select</option>";      
 while( $row1 = $find1->fetch_assoc() )
 {
  echo "<option value='{$row1['bd_id']}'>".$row1['bd_name']."</option>";
 }     
}

// selecte Brand
if (! empty($_POST["brand2"])) {
    $cat_id2 = $_POST["brand2"];

$find1 = $conn->query("SELECT * FROM brand_detail WHERE bd_cat_id='$cat_id2' AND bd_level = 'subcat' order by bd_name") or die($conn->error);

echo "<option value='0'>Select</option>";      
 while( $row1 = $find1->fetch_assoc() )
 {
  echo "<option value='{$row1['bd_id']}'>".$row1['bd_name']."</option>";
 }     
}

?>