<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM profile_detail
LEFT JOIN city_detail ON city_detail.city_id=profile_detail.pd_city
LEFT JOIN user_login ON user_login.user_id=profile_detail.pd_user_id
 WHERE pd_user_id='".decr($_REQUEST['block'])."'")or die($conn->error);
$row=$sql->fetch_assoc();
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active"><?php echo $row['pd_fname']?> Profile</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
				
					<form action="process/update_status.php" method="POST" id="cat-register"> 
					<div class="form-group"> 
					<label for="dealer-fname">First Name:</label> 
					<input type="hidden" name="id" value="<?php echo $row['pd_user_id']?>">
					<input type="text" class="form-control " id="dealer-fname" 
					name="fname" value="<?php echo $row['pd_fname']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-lname">Last Name:</label> 
					<input type="text" class="form-control " id="dealer-lname" name="lname"  value="<?php echo $row['pd_lname']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Mobile No.:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="aadhar"  value="<?php echo $row['user_mobile']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Email :</label> 
					<input type="text" class="form-control " id="dealer-name"  name="aadhar"  value="<?php echo $row['user_email']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Password:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="aadhar"  value="<?php echo $row['user_password']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Aadhar No.:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="aadhar"  value="<?php echo $row['pd_aadhar']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Licence:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="licence" value="<?php echo $row['pd_licence']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Dealer Address:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="d_address"  value="<?php echo $row['pd_address']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Name:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="shop_name"  value="<?php echo $row['pd_shop_name']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Mobile:</label> 
					<input type="text" class="form-control " id="dealer-name" name="s_mobile" value="<?php echo $row['pd_shop_mobile']?>" disabled>
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Address:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="s_address" value="<?php echo $row['pd_shop_address']?>" disabled>
					</div>
					<!--<div class="col-sm-6">
					<label>State</label>
					<select class="form-control1" name="state" onChange="getCity(this.value);">
					<option value="0">Select</option>
					<?php
					/*$sql=$conn->query("SELECT * FROM state_detail order by state_name")or die($conn->error);
					while($row=$sql->fetch_assoc()){
						echo "<option ".$row['']."value='{$row['state_id']}'>{$row['state_name']}</option>";
					}*/
					?>
					</select>
					</div>-->
					<div class="form-group">
					<label>City</label>
					<?php
					$sql=$conn->query("SELECT * FROM city_detail WHERE city_id='".$row['pd_city']."'")or die($conn->error);
					$row=$sql->fetch_assoc();
					?>
					<input type="text" class="form-control " id="dealer-name"  name="city" value="<?php echo $row['city_name']?>" disabled>
					</div>
					<?php if($_SESSION['user_type'] == 'ADMIN'){
						
					$sql=$conn->query("select * from plan_detail ") or die($conn->error);
					
						?>
					<div class="form-group">
					<label><b>Register Plan for Dealer</b></label>
					<select class="form-control" name="plan_id">
					<option value="0">Select Plan </option>
					<?php while($row=$sql->fetch_assoc()){
					echo "<option value='".$row['plan_id']."'>".$row['plan_name']."</option>";
					}
					?>
					</select>
					</div>
					
					<input type="submit" value="Plan Update">
					<?php } ?>
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
<?
require_once("include/footer.php");
?>