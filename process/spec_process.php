<?php
require_once("../include/vdooz.php");
//spec Process file
if (!empty($_POST["spec1"])) {
    // Capture selected Spec

$sql=$conn->query("SELECT * FROM specification_detail WHERE  spec_level = 'cat' and spec_filter = '1' and spec_cat_id = '".$_POST["spec1"]."'") or die($conn->error);
 
 while( $row1 = $sql->fetch_assoc() )
 {
	 $result = explode(',',$row1['spec_values']);
	 
	 foreach($result as $value){
	 ?>

<input type='checkbox' class='search-inputs pro_type' name="specification[]" value="<?php echo $value;?>"><span style="margin-left:10px ;"><?php echo $value;?></span>
<br>

 <?php 
	 }
 }
 
}if (!empty($_POST["spec2"])) {
    // Capture selected Spec
    $spec2 = $_POST["spec2"];

$sql = $conn->query("SELECT * FROM specification_detail WHERE  spec_level = 'subcat' and spec_filter = '1' and spec_cat_id = '".$_POST["spec2"]."'") or die($conn->error);

  while( $row1 = $sql->fetch_assoc() )
 {
	 $result = explode(',',$row1['spec_values']);
	 ?>
	 <h1 class="legend"><?php echo $row1['spec_name'];?></h2>
	 <?php foreach($result as $value){
	 ?>

<input type='checkbox' class='search-inputs pro_type' name="specification[]" value="<?php echo $value;?>"><span style="margin-left:10px ;"><?php echo $value;?></span>
<br>

 <?php 
	 }
 }
 }
?>
 <script>
 $(".search-inputs").on('change',function(){
	
	//$(".search-result").html('<img src="assets/images/ajax-loader.gif" alt="loader">');
	
	$.post("process/products.php",

	$("form").serialize(),

	function(data){

		$(".search-result").html(data);

	});
return false;
	});
 </script>