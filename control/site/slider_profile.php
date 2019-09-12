<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$query = $conn->query("SELECT * FROM slider WHERE slider_id = '".decr($_REQUEST['block'])."'")or die($conn->error);

$data = $query->fetch_assoc();

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Slider</li>
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
<form class="form-horizontal" action="process/add_slider.php" enctype="multipart/form-data" method="POST" id="brand-register" >

<div class="form-group">
	<div class="col-sm-4">
<label>Category</label>
		
		<?php
		$sql=$conn->query("SELECT * FROM cat_detail where cat_id = '".$data['slider_main_cat']."' ")or die($conn->error);

		$row=$sql->fetch_assoc();
		
		echo"<input type='text' value='".$row['cat_name']."' class='form-control1' disabled>";	
		
		?>
	</div>
<div class="col-sm-4">
<label>Sub-Category</label>
		
		<?php
		$sql=$conn->query("SELECT * FROM subcat_detail where subcat_id = '".$data['slider_subcat_id']."' ")or die($conn->error);

		$row=$sql->fetch_assoc();
		
		echo"<input type='text' value='".$row['subcat_name']."' class='form-control1' disabled>";	
		
		?>
	</div>
<?php if($data['slider_level'] == "brand"){?>
<div class="col-sm-4">
<label>brand</label>
		
		<?php
	$sql = $conn->query("SELECT * FROM brand_detail where bd_id = '".$data['slider_cat_id']."'")or die($conn->error);

		$row=$sql->fetch_assoc();
		
		echo"<input type='text' value='".$row['bd_name']."' class='form-control1' disabled>";	
		
		?>
	</div>
<?php } ?>
	</div>

<a href="process/slider_delete.php?block=<?php echo encr($data['slider_id'])?>" class="btn btn-danger">Delete</a> 
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