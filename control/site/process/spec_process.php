<?php
require_once("../include/vdooz.php");
require_once("../include/auth.php");

//spec Process file
if (!empty($_POST["spec1"])) {
    // Capture selected state
    
$sql=$conn->query("SELECT * FROM specification_detail WHERE  spec_level = 'cat' and spec_cat_id = '".$_POST["spec1"]."'") or die($conn->error);
  while($row=$sql->fetch_assoc())
 {
	 if(!empty($row['spec_values'])){
		 $spec_data = explode(",",$row['spec_values']);
	echo"<div class='col-sm-4'><label>".$row['spec_name']." :</label>
	<select name='spec_filter[]' class='form-control'>";
	
		 foreach ($spec_data as $item => $value_data){
	echo"<option>".$value_data."</option>";
		 }
	echo "</select>
	<input type='hidden' class='form-control ' value=".$row['spec_id']." name= 'id[]'>	
	
	</div>";
	 }else{
	echo"<div class='col-sm-4'><label>".$row['spec_name']." :</label>
	<input type='text' class='form-control' placeholder='".$row['spec_values']."' name= 'spec_input[]'>
	<input type='hidden' class='form-control ' value=".$row['spec_id']." name= 'id[]'>	
	
	</div>";	 
	 }
 }
 
}if (!empty($_POST["spec2"])) {
    // Capture selected state
    $spec2 = $_POST["spec2"];

$sql=$conn->query("SELECT * FROM specification_detail WHERE  spec_level = 'subcat' and spec_cat_id = '".$_POST["spec2"]."'") or die($conn->error);
  while($row=$sql->fetch_assoc())
 {
	if(!empty($row['spec_values'])){
		 $spec_data = explode(",",$row['spec_values']);
	echo"<div class='col-sm-4'><label>".$row['spec_name']." :</label>
	<select name='spec_filter[]' class='form-control'>";
	
	foreach ($spec_data as $item => $value_data){
	
	echo"<option >".$value_data."</option>";
		 }
	echo "</select>	
	<input type='hidden' class='form-control ' value=".$row['spec_id']." name= 'filter_id[]'>
	</div>";
	 }else{
	echo"<div class='col-sm-4'><label>".$row['spec_name']." :</label>
	<input type='text' class='form-control' placeholder='".$row['spec_values']."' name='spec_input[]'>
	</div>
	
	<input type='hidden' class='form-control ' value=".$row['spec_id']." name= 'id[]'>";	
	 }
	 
 }     
}
?>
