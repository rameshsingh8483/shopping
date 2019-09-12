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
<?php
$sql=$conn->query("SELECT * FROM product_image WHERE pimg_pro_id='".decr($_REQUEST['block'])."'")or die($conn->error);
while($data=$sql->fetch_assoc()){ 
 $image = "../../upload/product/".$data['pimg_name'];
				
	?>
	<div class="col-sm-3">
	
		<img src="<?php echo $image;?>" class="img-responsive" style="height:150px;width:100%">
		<input type="button" id="<?php echo $data['pimg_id'];?>" class="image_delete" value="Delete">
	</div>
<?php
}
?>
<div class="clearfix"></div>
<div class="col-md-4 col-sm-6 col-xs-6">
<form action="process/another_image_upload.php" method="POST" id="brand-register">
<label for="image" class="btn btn-primary pro-image-css">Choose New Image</label>
<input type="file" name="file" id="image" style="display:none;">
<input type="submit" value="Upload" class="btn btn-info">
<input type="hidden" value="<?php echo decr($_REQUEST['block']);?>" name="pro_id">
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
window.location="product_detail.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    
<script>
$(document).ready(function(){
    $('.image_delete').click(function(){
		
		$.ajax({
		type:"POST",
		url:"process/image_delete.php",
		data:'id='+ $(this).attr('id'),
		success:function(data){
		window.location="product_detail.php";
	
			}
		});
		
    });
});
</script>   	
<?
require_once("include/footer.php");
?>