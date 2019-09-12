<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$banner = $conn->query("SELECT * FROM profile_detail where pd_user_id = '".decr($_SESSION['user_id'])."'")or die($conn->error);

$data1 = $banner->fetch_assoc();

$banner_image = "../../upload/banner/".$data1['pd_banner'];

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Banner</li>
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
<form class="form-horizontal" action="process/banner_update.php" enctype="multipart/form-data" method="POST" id="brand-register" >

<div class="form-group">
<div class="col-md-12"><img src="<?php echo $banner_image;?>" class="img-responsive banner-image"/></div>
	
	<div class="col-sm-12"><label for="banner">Choose Banner</label> <input type="file" class="form-control" name="file" id="banner" style="display:none;">
	</div>
	<div class="clearfix"></div>
	</div>
<button type="submit" class="btn btn-default">Update</button> 
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
setTimeout(function() {
// body...
window.location="banner_update.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    
<?
require_once("include/footer.php");
?>