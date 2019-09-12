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
<li class="active">Register New Slider</li>
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
<form class="form-horizontal" action="process/slider_register.php" enctype="multipart/form-data" method="POST" id="brand-register" >

<div class="form-group">

<div class="col-sm-4"><label>Slider Title</label>
<input type="text" name="title" class="form-control1">
</div>
	<div class="col-sm-4"><label>Slider Category</label><select name="cat" id="cat-id" class="form-control1" onChange="getCat(this.value);">
		<option value="0">Select</option>
		<?php
		$sql=$conn->query("SELECT * FROM cat_detail")or die($conn->error);

		while($row=$sql->fetch_assoc()){
		
		echo"<option value='".$row['cat_id']."'>{$row['cat_name']}</option>";	
		}
		?>
	</select></div>
	<div class="col-sm-4"><label>Slider Sub-Cat</label><select id="subcat-list" name="subcat" class="form-control1" onChange="getBrand2(this.value);">
	<option value="0">Select</option>
	
	</select>
	</div>
	<div class="col-sm-4"><label>Slider Brand</label><select id="brand-list" name="brand" class="form-control1">
	<option value="0">Select</option>
	
	</select>
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
function getBrand2(val){
$.ajax({
type:"POST",
url:"process/cat_process.php",
data:'brand2='+val,
success:function(data){
$("#brand-list").html(data);
}
});
}
</script>

<?
require_once("include/footer.php");
?>