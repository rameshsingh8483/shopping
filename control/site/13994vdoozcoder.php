<?php
require_once("include/top.php");
?>								<!--/login-->

<div class="error_page">
<!--/login-top-->

<div class="error-top">
<h2 class="inner-tittle page">Admin Login</h2>
	<div class="login">
	<h3 class="inner-tittle t-inner">Login</h3>
			
			<form action="process/login.php" method="POST" id="login-form">
					<input type="text" name="mobile" placeholder="User name">
					<input type="password" name="password" placeholder="Password">
					<input type="hidden" name="user_type" value="ADMIN">
					<div class="submit"><input type="submit" onclick="myFunction()" value="Login" ></div>
					<div class="clearfix"></div>
					
					<div class="new">
						<p><label class="checkbox11"><input type="checkbox" name="checkbox"><i> </i>Forgot Password ?</label></p>
						<div class="clearfix"></div>
					</div>
				</form>
	</div>

	
</div>


<!--//login-top-->
</div>

<!--//login-->
<!--footer section start-->
<div class="footer">

<p>&copy <?php echo date('Y');?> Augment . All Rights Reserved | Design by <a href="http://vdooz.com/" target="_blank">Vdooz</a></p>
</div>
<!--footer section end-->

<script>
$(function(){
$("#login-form").submit(function(){
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
$("#login-form").trigger("reset");
setTimeout(function() {
// body...
window.location="dashboard.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    
