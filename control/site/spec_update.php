<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$_REQUEST['block'] = decr($_REQUEST['block']);

$sql =  $conn->query("SELECT * FROM specification_detail WHERE spec_id = '".$_REQUEST['block']."'")or die($conn->error);
 
 $row = $sql->fetch_assoc();
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Specification Modify</li>
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
	
			<form class="form-horizontal" action="process/spec_update.php" method="POST" id="brand-register">
				
				<div class="form-group">
					
					<div class="col-sm-3"><label>Filterable:</label>
					<select name="filter" class="form-control1">
					<option value="1">YES</option>
					<option value="0">NO</option>
					</select>
					</div>
					<div class="col-sm-3"><label>Optional:</label>
					<select name="optional" class="form-control1">
					<option <?php echo $row['spec_optional'] == 1 ?"Selected":""?> value="1">YES</option>
					
					<option <?php $row['spec_optional'] == 0 ?"Selected":""?>value="0">NO</option>					</select>
					</div>
					<div class="col-sm-6"><label>Specification Name:</label> <input type="text" class="form-control1" name="name" value="<?php echo $row['spec_name'];?>"> 
					<input type="hidden" name="id" value="<?php echo $row['spec_id']?>">
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
data: $(this).serialize(),
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
<script>
//Residantial country state and city detail
function getCat(val) {
$.ajax({
type: "POST",
url: "process/cat_process.php",
data:'subcat1='+val,
success: function(data){
$("#subcat-list").html(data);

}
});
}
</script>
<?
require_once("include/footer.php");
?>