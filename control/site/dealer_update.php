<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

if(isset($_REQUEST['block'])){
$sql=$conn->query("SELECT * FROM profile_detail
LEFT JOIN city_detail ON city_detail.city_id=profile_detail.pd_city
 WHERE pd_user_id='".decr($_REQUEST['block'])."'")or die($conn->error);

}else{

$sql=$conn->query("SELECT * FROM profile_detail
LEFT JOIN user_login ON user_login.user_id=profile_detail.pd_user_id
LEFT JOIN city_detail ON city_detail.city_id=profile_detail.pd_city
 WHERE pd_user_id='".decr($_SESSION['user_id'])."'")or die($conn->error);
	
}
$row=$sql->fetch_assoc();

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Dealer Modify</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
				
					<form action="process/dealer_update.php" method="POST" id="cat-register"> 
					<div class="form-group"> 
					<label for="dealer-fname">First Name:</label> 
					<input type="text" class="form-control " id="dealer-fname"  name="fname" value="<?php echo $row['pd_fname']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-lname">Last Name:</label> 
					<input type="text" class="form-control " id="dealer-lname" name="lname"  value="<?php echo $row['pd_lname']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Aadhar No.:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="aadhar"  value="<?php echo $row['pd_aadhar']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Licence:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="licence" value="<?php echo $row['pd_licence']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Dealer Address:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="d_address"  value="<?php echo $row['pd_address']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Name:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="shop_name"  value="<?php echo $row['pd_shop_name']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Mobile:</label> 
					<input type="text" class="form-control " id="dealer-name" name="s_mobile" value="<?php echo $row['pd_shop_mobile']?>">
					</div>
					<div class="form-group"> 
					<label for="dealer-name">Shop Address:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="s_address" value="<?php echo $row['pd_shop_address']?>">
					</div>
					<?php 
					if($row['user_plan_expire'] != "0000-00-00"){
					?>
					<div class="form-group"> 
					<label for="dealer-name">Plan Expire Date:</label> 
					<input type="text" class="form-control " id="dealer-name"  name="s_address" value="<?php echo $row['user_plan_expire']?>" disabled>
					</div>
					<?php } ?>
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
					<div class="col-sm-6">
					<label>City</label>
					<select class="form-control1" name="city" id="city-list">
					<?php
					$sql=$conn->query("SELECT * FROM city_detail order by city_name")or die($conn->error);
					while($data=$sql->fetch_assoc()){
						echo "<option ".($row['pd_city']==$data['city_id']?"Selected":"")." value='{$data['city_id']}'>{$data['city_name']}</option>";
					}
					?>
					</select>
					<input type="hidden" name="user_id" value="<?php echo $row['pd_user_id']?>">
					</div>
					<div class="col-sm-6">
					</div>
					<button type="submit" class="btn btn-default">Update</button> 
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