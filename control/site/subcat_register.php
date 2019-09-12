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
<li class="active">Sub-Cat Register</li>
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
		<form class="form-horizontal" action="process/subcat_register.php" method="POST" id="subcat-register">
			
			<div class="form-group">
				<div class="col-sm-6"><select name="cat" id="selector1" class="form-control1">
					<option value="0">Select Category</option>
					<?php
					$sql=$conn->query("SELECT * FROM cat_detail order by cat_name")or die($conn->error);
					while($row=$sql->fetch_assoc()){
					echo"<option value='".$row['cat_id']."'>
					{$row['cat_name']}
					</option>";	
					}
					?>
				</select></div>
				<div class="col-sm-6"> <input type="text" class="form-control" id="subcat-name" placeholder="Enter Sub-Category" name="subcat"> </div>
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
$("#subcat-register").submit(function(){
Noty.closeAll();
var n = new Noty({type:"alert",theme:"sunset",text:"Please Wait",killer:true,timeout:false}).show();
$.ajax({
type: "POST",
dataType: "json",
url: $(this).attr("action"),
data: $(this).serialize(),
success: function(data) {
//						console.log(data);
n.setText(data.msg);
n.setType(data.status);
if(data.status=="success"){
$("#subcat-register").trigger("reset");
setTimeout(function() {
// body...
window.location="spec_register.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    
<?
require_once("include/footer.php");
?>