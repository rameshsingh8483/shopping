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
		<li class="active">Register New Dealer</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
				
					<form action="process/dealer_register.php" method="POST" id="cat-register"> 
					<div class="form-group"> 
					<label for="dealer-fname">First Name:</label> 
					<input type="text" class="form-control " id="dealer-fname"  name="fname">
					</div>
					<div class="form-group"> 
					<label for="dealer-lname">Last Name:</label> 
					<input type="text" class="form-control " id="dealer-lname" name="lname">
					</div>
					<div class="form-group"> 
					<label for="dealer-email">Email:</label> 
					<input type="text" class="form-control " id="dealer-email" name="email">
					</div>
					<div class="form-group"> 
					<label for="dealer-mobile"> Mobile:</label> 
					<input type="text" class="form-control " id="dealer-mobile"  name="mobile">
					</div>
					<div class="form-group"> 
					<label for="dealer-mobile"> Password:</label> 
					<input type="text" class="form-control " id="dealer-mobile"  name="password">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Aadhar No.:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="aadhar">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Licence:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="licence">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Dealer Address:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="d_address">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Name:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="shop_name">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Mobile:</label> 
					<input type="text" class="form-control " id="dealer-name" name="s_mobile">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Address:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="s_address">
					</div>
					<div class="col-sm-6">
					<label>State</label>
					<select class="form-control1" name="state" onChange="getCity(this.value);">
					<option value="0">Select</option>
					<?php
					$sql=$conn->query("SELECT * FROM state_detail order by state_name")or die($conn->error);
					while($row=$sql->fetch_assoc()){
						echo "<option value='{$row['state_id']}'>{$row['state_name']}</option>";
					}
					?>
					</select>
					</div>
					
					<div class="col-sm-6">
					<label>City</label>
					<select class="form-control1" name="city" id="city-list">
					
					</select>
					</div>
					<button type="submit" class="btn btn-default">Register</button> 
					</form> 
				</div>

		</div>
			
			</div> 
	<!--//forms-->											   
</div>
<!--//outer-wp-->
<script>
                      $(function(){
                      $("#cat-register").submit(function(){
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
                          $("#cat_register").trigger("reset");
                       setTimeout(function() {
                            // body...
                      window.location="dealer_register.php";
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
<?
require_once("include/footer.php");
?>