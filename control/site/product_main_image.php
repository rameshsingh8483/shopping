<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM product_detail WHERE pro_id='".decr($_REQUEST['block'])."'")or die($conn->error);

$data=$sql->fetch_assoc(); 
 $image = "../../upload/product/".$data['pro_image'];

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Product Images</li>
</ol>
</div>	
<hr>

<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">

<!--/forms-inner-->
<div class="forms-inner">

<!--/set-2-->
<div class="set-1">
<div class="graph-2 general">

<div class="form-body">
	
<div class="form-group">
<div class="row">
<div class="col-sm-6">
			<img src="<?php echo $image;?>" class="img-responsive" style="height:200px;width:100%">
	<form action="process/proudct_image_update.php" method="POST" id="brand-register">
<label for="image1" class="btn btn-info pro-image-css">Choose New Image</label>
<input type="file" name="file" id="image1" style="display:none;">
<input type="hidden" name="pro_id" value="<?php echo decr($_REQUEST['block']);?>">
<input type="submit" value="Update" class="btn btn-warning">
</form>

	</div>

</div>

</div>
</div>
</div>
</div>
<!--//set-2-->

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