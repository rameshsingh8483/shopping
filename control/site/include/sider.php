<!--/sidebar-menu-->
<div class="sidebar-menu">
<header class="logo">
<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="dashboard.php"> <span id="logo"> <h1>Augment</h1></span> 
<!--<img id="logo" src="" alt="Logo"/>--> 
</a> 
</header>
<?php if($_SESSION['user_type'] == 'DEALER'){?>
<div class="down menu-down">	
<?php
$find = $conn->query("SELECT * FROM profile_detail Where pd_user_id = '".decr($_SESSION['user_id'])."'")or die($conn->error);
$data = $find->fetch_assoc();

$img = "../../upload/dealer/".$data['pd_image'];

?>	<form action="process/image_upload.php" enctype="multipart/form-data" method="POST" id="testimage"> 
	 <a href="#"> <img src="<?php echo $img;?>" class="dealer-img"></a><br>
	 <label for="test">Edit Profile</label>
	 <input type="file" name="file" id="test" style="display:none;">
	 <p><input type="submit" value="UPLOAD"></p>
	  
	 
	</form>	
	</div>
<?php } ?>	
	   <div class="menu">
				<ul id="menu" >

					<?php if($_SESSION['user_type'] == 'ADMIN' or $_SESSION['user_type'] == 'DEALER'){?>
					<li id="menu-academico" ><a href="#"><i class="fa fa-tachometer"></i> <span>PRODUCT</span> <span class="fa fa-angle-right" style="float: right"></span></a>
					   <ul id="menu-academico-sub" >
						<li id="menu-academico-avaliacoes" ><a href="product_register.php">New Register</a></li>
						
						</ul>
					</li>
					<?php }?>
					<?php if($_SESSION['user_type'] == 'ADMIN'){?>
						
					<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>USER</span> <span class="fa fa-angle-right" style="float: right"></span></a>
						   <ul id="menu-academico-sub" >
							<li id="menu-academico-avaliacoes" ><a href="user_register.php">New Register</a></li>
							<li id="menu-academico-avaliacoes" ><a href="user_detail.php">Profiles</a></li>
							
						  </ul>
					</li>
					<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>SLIDER</span> <span class="fa fa-angle-right" style="float: right"></span></a>
						 <ul id="menu-academico-sub" >
							<li id="menu-academico-avaliacoes" ><a href="product_slider_register.php">Product Slider</a></li>
							<li id="menu-academico-avaliacoes" ><a href="dealer_slider_register.php">Seller Slider</a></li>
							
						  </ul> 
					</li>
					<?php  } ?>
					
					<?php if($_SESSION['user_type'] == 'ADMIN' or $_SESSION['user_type'] == 'USER'){?>
					<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>DEALERS</span> <span class="fa fa-angle-right" style="float: right"></span></a>
						   <ul id="menu-academico-sub" >
							<li id="menu-academico-avaliacoes" ><a href="dealer_register.php">New Register</a></li>
							
						  </ul>
					</li>
					<?php } ?>
					<?php if($_SESSION['user_type'] == 'ADMIN'){?>
					<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>CATEGORY</span> <span class="fa fa-angle-right" style="float: right"></span></a>
					   <ul id="menu-academico-sub" >
						<li id="menu-academico-avaliacoes" ><a href="cat_register.php">Add Category</a></li>
						
					  </ul>
					</li>
					
					<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>SUB-CATEGORY</span><span class="fa fa-angle-right" style="float: right"></span></a>
					   <ul id="menu-academico-sub" >
						<li id="menu-academico-avaliacoes" ><a href="subcat_register.php">Add Sub-Category</a></li>
						
					  </ul>
					</li>
					
					<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>BRAND</span> <span class="fa fa-angle-right" style="float: right"></span></a>
					   <ul id="menu-academico-sub" >
						<li id="menu-academico-avaliacoes" ><a href="brand_register.php">Add New Brand</a></li>
					  </ul>
					</li>
					<li id="menu-academico" ><a href="#"><i class="fa lnr lnr-book"></i> <span>SPECIFICATION</span> <span class="fa fa-angle-right" style="float: right"></span></a>
					   <ul id="menu-academico-sub" >
						<li id="menu-academico-avaliacoes" ><a href="spec_register.php">Add New Specification</a></li>
						
						</ul>
					</li>
					<li id="menu-academico" ><a href="#"><i class="lnr lnr-layers"></i> <span>PLANS</span> <span class="fa fa-angle-right" style="float: right"></span></a>
					   <ul id="menu-academico-sub" >
						<li id="menu-academico-boletim" ><a href="all_plan.php">All Plan </a></li>
						<li id="menu-academico-avaliacoes" ><a href="plan_register.php">Register Plan</a></li>
					  </ul>
					</li>
					<?php }
					if($_SESSION['user_type'] == 'DEALER'){
					?>
					
					<li id="menu-academico" ><a href="dealer_update.php"><i class="fa fa-table"></i> <span>PROFILE</span></a>
						   
					</li>
					<li id="menu-academico" ><a href="banner_update.php"><i class="fa fa-table"></i> <span>BANNER</span></a>
						   
					</li>
					<?php } ?>
					
				  </ul>
				
			</div>
		  </div>
<script>
$(function(){
$("#testimage").submit(function(){
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
window.location="dashboard.php";
},1000)
}}});
return false;
});});
//end ajax
</script>    		  