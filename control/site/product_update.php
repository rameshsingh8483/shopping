<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM product_profile WHERE vpro_id='".decr($_REQUEST['block'])."' and vps_spec_name = 'Price'")or die($conn->error);
$data=$sql->fetch_assoc();

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Product Update</li>
</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">

<!--/forms-inner-->
<div class="forms-inner">

<!--/set-2-->
<div class="set-1">
<div class="graph-2 general">

<div class="grid-1">
<div class="form-body">
<form class="form-horizontal" action="process/product_update.php" enctype="multipart/form-data" method="POST" id="brand-register" >

<div class="form-group">
	
	<div class="col-sm-4"><label>Product type</label><select name="type" id="pname" class="form-control1">
	<option <?php echo $data['vpro_type'] == 'New'?"Selected":"";?>>New</option>
	<option <?php echo $data['vpro_type'] == 'Old'?"Selected":"";?>>Old</option>
	<option <?php echo $data['vpro_type'] == 'Refurbished'?"Selected":"";?>>Refurbished</option>
	</select>
	</div>
	<div class="col-sm-4"><label>Product Name:</label> <input type="text" class="form-control" value="<?php echo $data['vpro_name'];?>" name="name"> 
	</div>
	<div class="col-sm-4"><label>Select City</label>
	
	<select name="city" class="form-control1">
	<?php
		$sql=$conn->query("SELECT * FROM city_detail order by city_name")or die($conn->error);

		while($row=$sql->fetch_assoc()){
		
		echo"<option ".($data['vpro_city_id'] == $row['city_id']?"Selected":"")." value='".$row['city_id']."'>{$row['city_name']}</option>";	
		}
		?>
	</select>
	</div>
	<?php 
		$sql=$conn->query("SELECT * FROM product_profile WHERE vpro_id='".decr($_REQUEST['block'])."'")or die($conn->error);
 
 while($row=$sql->fetch_assoc()){
	 
	$find=$conn->query("SELECT * FROM specification_detail WHERE spec_id='".$row['vps_spec_id']."'")or die($conn->error);
 
 while($row1=$find->fetch_assoc()){
		$data2 = explode(',',$row1['spec_values']);
	echo"<div class='col-sm-4'><label>".$row1['spec_name']." :</label>
	<select class='form-control' name= 'spec_input[]'>";
		foreach($data2 as $value){
		echo "<option ".($value == $row['vps_spec_value']?'selected':'')." value=".$value.">".$value." </option>";
		}
		echo "<input type='hidden' class='form-control ' value=".$row['vps_spec_id']." name= 'id[]'>	
	</select>
	</div>";
 }

 }
	?>
		<div class="clearfix"></div>
	
	<div class="col-sm-12"><label>Product Description:</label><input type="text" class="form-control" name="desc" value="<?php echo $data['vpro_desc']?>">
	</div>
	
	<input type="hidden" name="pro_id" value="<?php echo decr($_REQUEST['block']);?>">


	
	</div>

<button type="submit" class="btn btn-default">Save Changes</button> 
</form>
</div>

</div>
</div>
</div>
<!--//set-2-->

</div>
<!--//forms-inner-->
</div> 
<!--//forms-->											   
</div>
<!--//outer-wp-->
<script>
$(function(){
$("#brand-register").submit(function(){
Noty.closeAll();
var n = new Noty({type:"alert",theme:"sunset",text:"Please Wait",killer:true,timeout:false}).show();
$.ajax({
type: "POST",
dataType: "json",
url: $(this).attr("action"),
data: new FormData(this),
processData: false,
//contentType: false,
success: function(data) {
console.log(data);
n.setText(data.msg);
n.setType(data.status);
if(data.status=="success"){
setTimeout(function() {
// body...
window.location="dashboard.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    

<?
require_once("include/footer.php");
?>