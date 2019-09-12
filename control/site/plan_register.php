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
<li class="active">Register New Plan</li>
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
	
			<form class="form-horizontal" action="process/plan_register.php" method="POST" id="brand-register" >
				
				<div class="form-group">
				<div class="col-sm-6"><label>Plan Name:</label> <input type="text" class="form-control1" name="name" placeholder = "Plan name "> 
					</div>
				<div class="col-sm-6"><label>Plan Price:</label> <input type="number" class="form-control1" name="price" placeholder = "Plan Price "> 
					</div>	
					<div class="col-sm-4"><label>Validity:</label>
					<select name="validity" class="form-control1">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
					</select>
					</div>
					<div class="col-sm-4"><label>Validity Time:</label>
					<select name="validity_type" class="form-control1">
					<option>MONTH</option>
					<option>YEAR</option>
					</select>
					</div>
				
					
					<div class="clearfix"></div>
				<button type="submit" class="btn btn-default">Register</button> 
					
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
$("#brand-register").trigger("reset");
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