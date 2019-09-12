
<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

//update dealer plan expire change active status
if($_SESSION['user_type'] == 'DEALER'){
	
		$sql =  $conn->query("SELECT * FROM user_login WHERE user_id = '".decr($_SESSION['user_id'])."'")or die($conn->error);
		
		$row = $sql->fetch_assoc();
		$offset = $row['user_plan_expire'];
        $date = date("Y-m-d");
        
		if ($date == $offset) {
		
		$conn->query("UPDATE user_login SET user_status ='deactive' WHERE user_id = '".decr($_SESSION['user_id'])."'")or die($conn->error);
		
		} 
}
/*******************Admin Dashboard **********************/

$sql1=$conn->query("select * from cat_detail")or die($conn->error);
$count1=$sql1->num_rows;

$sql2=$conn->query("select * from subcat_detail")or die($conn->error);
$count2=$sql2->num_rows;

$sql3=$conn->query("select * from brand_detail")or die($conn->error);
$count3=$sql3->num_rows;

$sql4=$conn->query("select * from user_login WHERE user_type='DEALER' and user_status = 'delete'")or die($conn->error);
$count4=$sql4->num_rows;

$sql5=$conn->query("select * from user_login WHERE user_type='DEALER' and user_status='active'")or die($conn->error);
$count5=$sql5->num_rows;


$sql7=$conn->query("select * from product_profile WHERE vpd_user_type = 'ADMIN' and vps_spec_name = 'Price'")or die($conn->error);
$count7=$sql7->num_rows;

$sql20=$conn->query("select * from product_detail")or die($conn->error);
$count20=$sql20->num_rows;

$sql8=$conn->query("select * from user_login WHERE user_type='DEALER' and user_status='deactive'")or die($conn->error);
$count8=$sql8->num_rows;

$sql9 = $conn->query("select * from user_login WHERE user_type='USER'")or die($conn->error);
$count9 = $sql9->num_rows;

$sql10 = $conn->query("select * from message_detail")or die($conn->error);
$count10 = $sql10->num_rows;

$sql13 = $conn->query("select * from user_login where user_type = 'USER'")or die($conn->error);
$count13 = $sql13->num_rows;

$sql14 = $conn->query("select * from slider WHERE slider_type='PRODUCT'")or die($conn->error);
$count14 = $sql14->num_rows;

$sql15 = $conn->query("select * from slider WHERE slider_type='DEALER'")or die($conn->error);
$count15 = $sql15->num_rows;

/***************Close***************/

/****************Dealer Dashboard**************/

$sql11 = $conn->query("select * from product_detail where pro_user_id = '".decr($_SESSION['user_id'])."' and pro_user_type = 'DEALER'") or die($conn->error);
$count11 = $sql11->num_rows;

/****************USER Dashboard**************/
$sql12=$conn->query("select * from user_login WHERE user_type='DEALER' and user_regi_id='".decr($_SESSION['user_id'])."'")or die($conn->error);
$count12=$sql12->num_rows;
?>
<div class="outter-wp">
<!--custom-widgets-->
<div class="custom-widgets">
	<?php if($_SESSION['user_type'] == 'ADMIN'){?>
   <div class="row-one">
		<div class="col-md-3 widget">
			<div class="stats-left">
				<a href="cat_detail.php"><h5>Total Category</h5>
				<h4><?php echo $count1;?></h4></a>
			</div>

			<div class="clearfix"> </div>	
		</div>
		<div class="col-md-3 widget states-mdl">
			<div class="stats-left">
				<?php
				$var="subcat";
				echo"<a href='subcat_detail.php?block2=".$var."'><h5>Total Subcat</h5>
				<h4>".$count2."</h4></a>";?>
			</div>

			<div class="clearfix"> </div>	
		</div>
		<div class="col-md-3 widget states-thrd">
			<div class="stats-left">
				<?php $var="brand";
				echo"<a href='brand_detail.php?block2=".$var."'><h5>Total Brand</h5>
				<h4>".$count3."</h4></a>";?>
			</div>

			<div class="clearfix"> </div>	
		</div>
		
		<div class="col-md-3 widget states-last">
			<div class="stats-left">
				<?php $var="product";
				echo"<a href='product_detail.php'><h5>My Product</h5>
				<h4>".$count7."</h4></a>";?>
			</div>
		</div>
		<div class="clearfix"> </div>	
	</div>

	<div class="row-one">
		<div class="col-md-3 widget">
			<div class="stats-left">
				<?php $var="active";
				echo"<a href='dealer_detail.php?block2=".$var."'><h5>Active Dealer</h5>
				<h4>".$count5."</h4></a>";?>
				</div>

		</div>
		<div class="col-md-3 widget states-mdl">
			<div class="stats-left">
			<?php $var="deactive";
				echo"<a href='dealer_detail.php?block2=".$var."'><h5>Deactive Dealer</h5>
				<h4>".$count8."</h4></a>";?>
				
			</div>
		</div>
		<div class="col-md-3 widget states-thrd">
			<div class="stats-left">
			<?php $var="delete";
				echo"<a href='dealer_detail.php?block2=".$var."'><h5>Delete Dealer</h5>
				<h4>".$count4."</h4></a>";?>

			</div>

		</div>
		<div class="col-md-3 widget states-last">
			<div class="stats-left ">
				<?php $var="USER";
				echo"<a href='user_detail.php?block=".$var."'><h5>Total User</h5>
				<h4>".$count9."</h4></a>";?>
			</div>

		</div>
	</div>
	
	<div class="row-one">
		<div class="col-md-3 widget">
			<div class="stats-left ">
				<a href='user_detail.php'><h5>USERS</h5>
				<h4><?php echo $count13;?></h4></a>
			</div>

			
		</div>
		
		<div class="col-md-3 widget states-mdl">
			<div class="stats-left">
				<a href='message_detail.php'><h5>Message</h5>
				<h4><?php echo $count10;?></h4></a>
			</div>

			<div class="clearfix"> </div>	
		</div>
		<div class="col-md-3 widget states-thrd">
			<div class="stats-left">
				<a href='slider_detail.php'><h5>Product Slider</h5>
				<h4><?php echo $count14;?></h4></a>
			</div>

		</div>
		<div class="col-md-3 widget states-last">
			<div class="stats-left">
			<a href='dealer_slider_detail.php'>
				<h5>Best Dealer Slider</h5>
				
				<h4><?php if($count15 != 0) echo "1";else echo"0";?></h4>
				</a>
			</div>

			<div class="clearfix"> </div>	
		</div>
		
	</div>
	<div class="row-one">
		<div class="col-md-3 widget">
			<div class="stats-left ">
				<h5>All Product</h5>
				<h4><?php echo $count20;?></h4>
			</div>

			
		</div>
		
	</div>
	<?php }
	if($_SESSION['user_type'] == 'DEALER'){
	?>
	<div class="row-one">
		<div class="col-md-3 widget">
			<div class="stats-left ">
				<?php $var ='DEALER';?>
				<a href='product_detail.php?block4=<?php echo $var; ?>'><h5>Products</h5>
				<h4><?php echo $count11;?></h4></a>
			</div>

			<div class="clearfix"> </div>	
		</div>
		
	</div>
	<?PHP }
	
	if($_SESSION['user_type'] == 'USER'){
	?>
	<div class="row-one">
		<div class="col-md-3 widget">
			<div class="stats-left ">
			<?php $var="DEALER";
				echo"<a href='user_dealer.php?block=".$var."'><h5>Total Dealer</h5>
				<h4>".$count12."</h4></a>";?>
			</div>

			<div class="clearfix"> </div>	
		</div>
		
	</div>
	<?PHP }?>

</div>
<!--//custom-widgets-->
</div>

<?php
//require_once("include/footer.php");	
?>								 