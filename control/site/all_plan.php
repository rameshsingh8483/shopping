
<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

		$sql=$conn->query("select * from plan_detail ") or die($conn->error);
				
				
?>
<div class="outter-wp">
<!--custom-widgets-->
<div class="custom-widgets">
   <div class="row-one">
   <?php while($row=$sql->fetch_assoc()){?>
		<div class="col-md-4">
			<div class="stats-left">
				<a href="plan_update.php?block=<?php echo encr($row['plan_id'])?>"><h4><?php echo $row['plan_name']?></h4>
				<h5><?php echo $row['plan_validity']." ".$row['plan_validity_type'];?></h5>
				<h5>Rs. <?php echo $row['plan_price'];?></h5></a>
			</div>

			<div class="clearfix"> </div>	
		</div>
		
		
   <?php }?>
		
		<div class="clearfix"> </div>	
	</div>

</div>
<!--//custom-widgets-->
</div>

<?php
require_once("include/footer.php");	
?>								 