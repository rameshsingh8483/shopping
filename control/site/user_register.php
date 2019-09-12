<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
?>								<!--/login-->

<div class="error_page">
<!--/login-top-->

<div class="error-top">
<h2 class="inner-tittle page">Augment</h2>
<div class="login">
<h3 class="inner-tittle t-inner">User Register</h3>
<form action="process/user_register.php" method="POST" id="user-register">
<input type="text" class="text" placeholder="First Name" name="fname">
<input type="text" class="text" placeholder="Last Name" name="lname">
<input type="text" class="text" placeholder="Address" name="address">
<input type="text" name="mobile" placeholder="Mobile">
<input type="password" name="password" placeholder="Password">	
<input type="hidden" value="USER" name="type">
<label>State / City</label>
<select class="form-control1" name="state" onChange="getCity(this.value);">
<option value="0" >Select State</option>
<?php
$sql=$conn->query("SELECT * FROM state_detail order by state_name")or die($conn->error);
while($row=$sql->fetch_assoc()){
echo "<option value='{$row['state_id']}'>{$row['state_name']}</option>";
}
?>
</select>	
<select class="form-control1" name="city" id="city-list">
					
</select>		
<div class="sign-up">

<input type="submit" value="Register">

</div>
<div class="clearfix"></div>
</div>
</form>
</div>

</div>
</div>
<!--//login-top-->

<!--//login-->
<!--footer section start-->
<div class="footer">
<div class="error-btn">
<a class="read fourth" href="dashboard.php">Home</a>
</div>
<p>&copy <?php echo date('Y')?> Augment . All Rights Reserved | Design by <a href="http://vdooz.com/" target="_blank">Vdooz.</a></p>
</div>
<script>
$(function(){
$("#user-register").submit(function(){
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
$("#user-register").trigger("reset");
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
function getCity(val) {
$.ajax({
type: "POST",
url: "process/city_process.php",
data:'state1='+val,
success: function(data){
$("#city-list").html(data);

}
});
}
</script> 
<?php
require_once("include/top.php");
?>