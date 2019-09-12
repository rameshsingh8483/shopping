<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Product Register</li>
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
<form class="form-horizontal" action="process/product_register.php" enctype="multipart/form-data" method="POST" id="brand-register" >

<div class="form-group">
	<div class="col-sm-4"><label>Category</label><select name="cat" id="cat-id" class="form-control1" onChange="getCat(this.value);">
		<option value="0">Select</option>
		<?php
		$sql=$conn->query("SELECT * FROM cat_detail")or die($conn->error);

		while($row=$sql->fetch_assoc()){
		
		echo"<option value='".$row['cat_id']."'>{$row['cat_name']}</option>";	
		}
		?>
	</select></div>
	<div class="col-sm-4"><label>Sub Category</label><select id="subcat-list" name="subcat" class="form-control1" onChange="getBrand2(this.value);">
	<option value="0">Select</option>
	
	</select>
	</div>
	<div class="col-sm-4"><label>Brand</label><select id="brand-list" name="brand" class="form-control1">
	<option value="0">Select</option>
	
	</select>
	</div>
	<div class="col-sm-4"><label>Product type</label><select name="type" id="pname" class="form-control1">
	<option value="0">Select</option>
	<option>New</option>
	<option>Old</option>
	<option>Refurbished</option>
	</select>
	</div>
	<div class="col-sm-4"><label>Product Name:</label> <input type="text" class="form-control" placeholder="Enter Product name" name="name"> 
	</div>
	<div class="col-sm-4"><label>Select City</label>
	
	<select name="city" class="form-control1">
	<option value="0">Select</option>
	<?php
		$sql=$conn->query("SELECT * FROM city_detail")or die($conn->error);

		while($row=$sql->fetch_assoc()){
		
		echo"<option value='".$row['city_id']."'>{$row['city_name']}</option>";	
		}
		?>
	</select>
	</div>
	<div class="col-sm-4"><label>Product Main Image:</label> <input type="file" class="form-control" name="file">
	</div>
	<div class="col-sm-4"><label>Product Image 2:</label> <input type="file" class="form-control" name="file1">
	</div>
	<div class="col-sm-4"><label>Product Image 3:</label> <input type="file" class="form-control" name="file2">
	</div>
	<div class="col-sm-4"><label>Product Image 4:</label> <input type="file" class="form-control" name="file3">
	</div>
	<div class="col-sm-4"><label>Product Image 5:</label> <input type="file" class="form-control" name="file4">
	</div>
	<div class="clearfix"></div>
	
	<div class="col-sm-12"><label>Product Description:</label><textarea rows="3" name="desc" class="form-control" placeholder="Write Description of Product"></textarea>
	</div>
	<div class="clearfix"></div>
	
	<div id="spec-list">
	
	</div>
	
	
	</div>

<button type="submit" class="btn btn-default">Register</button> 
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
contentType: false,
success: function(data) {
//console.log(data);
n.setText(data.msg);
n.setType(data.status);
if(data.status=="success"){
$("#brand-register").trigger("reset");
setTimeout(function() {
// body...
window.location="dashboard.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    

<script>
//cat and sub-cat process
function getCat(val) {
$.ajax({
type: "POST",
url: "process/cat_process.php",
data:'subcat1='+val,
success: function(data){
$("#subcat-list").html(data);
getBrand(val);
getSpec1(val);
}
});
}
</script>
<script>
function getBrand(val){
$.ajax({
type:"POST",
url:"process/cat_process.php",
data:'brand1='+val,
success:function(data){
$("#brand-list").html(data);
}
});
}
</script>
<script>
function getSpec1(val){
$.ajax({
type:"POST",
url:"process/spec_process.php",
data:'spec1='+val,
success:function(data){
$("#spec-list").html(data);
}
});
}
</script>


<script>
function getBrand2(val){
$.ajax({
type:"POST",
url:"process/cat_process.php",
data:'brand2='+val,
success:function(data){
$("#brand-list").html(data);
getSpec2(val);
}
});
}
</script>

<script>
function getSpec2(val){
$.ajax({
type:"POST",
url:"process/spec_process.php",
data:'spec2='+val,
success:function(data){
$("#spec-list").html(data);
}
});
}
</script>
<?
require_once("include/footer.php");
?>