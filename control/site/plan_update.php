<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("select * from plan_detail where plan_id = '".decr($_REQUEST['block'])."'") or die($conn->error);

$row=$sql->fetch_assoc();

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active"><?php echo $row['plan_name'];?> Plan</li>
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
	
			<form class="form-horizontal" action="process/plan_update.php" method="POST" id="brand-register" >
				
				<div class="form-group">
				<div class="col-sm-6"><label>Plan Name:</label> <input type="text" class="form-control1" name="name" value="<?php echo $row['plan_name'];?>"> 
					</div>
				<div class="col-sm-6"><label>Plan Price:</label> <input type="number" class="form-control1" name="price" value="<?php echo $row['plan_price'];?>"> 
					</div>	
					<div class="col-sm-4"><label>Validity:</label>
					<select name="validity" class="form-control1">
					<option <?php echo $row['plan_validity'] == '1'?"selected":""?>>1</option>
					<option <?php echo $row['plan_validity'] == '2'?"selected":""?>>2</option>
					<option <?php echo $row['plan_validity'] == '3'?"selected":""?>>3</option>
					<option <?php echo $row['plan_validity'] == '4'?"selected":""?>>4</option>
					<option <?php echo $row['plan_validity'] == '5'?"selected":""?>>5</option>
					<option <?php echo $row['plan_validity'] == '6'?"selected":""?>>6</option>
					<option <?php echo $row['plan_validity'] == '7'?"selected":""?>>7</option>
					<option <?php echo $row['plan_validity'] == '8'?"selected":""?>>8</option>
					<option <?php echo $row['plan_validity'] == '9'?"selected":""?>>9</option>
					<option <?php echo $row['plan_validity'] == '10'?"selected":""?>>10</option>
					<option <?php echo $row['plan_validity'] == '11'?"selected":""?>>11</option>
					<option <?php echo $row['plan_validity'] == '12'?"selected":""?>>12</option>
					</select>
					</div>
					<div class="col-sm-4"><label>Validity Time:</label>
					<select name="validity_type" class="form-control1">
					<option <?php echo $row['plan_validity_type'] == 'MONTH'?"selected":""?>>MONTH</option>
					<option <?php echo $row['plan_validity_type'] == 'YEAR'?"selected":""?>>YEAR</option>
					</select>
					</div>
				<input type="hidden" name="id" value="<?php echo $row['plan_id'];?>">
					
					<div class="clearfix"></div>
				<button type="submit" class="btn btn-default">UPDATE</button> 
				<!--<a href="process/plan_delete.php?block=<?php// echo encr($row['plan_id']);?>" class="btn btn-danger">DELETE</a> 
					-->
				</div>
				
			
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
window.location="all_plan.php";
},1000)
}}});
return false;
});});
//end ajax
</script>
<?
require_once("include/footer.php");
?>