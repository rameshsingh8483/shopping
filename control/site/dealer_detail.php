<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

if(isset($_REQUEST['block2'])){	
$sql=$conn->query("SELECT * FROM user_login
LEFT JOIN profile_detail ON user_login.user_id=profile_detail.pd_user_id
WHERE user_status='{$_REQUEST['block2']}' and user_type = 'DEALER'") or die($conn->error);	
}

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Dealer Detail</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
				<div class="table-responsive">
					<table id="example" class="table  table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>First name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Expire Plan Date</th>
                <th>Status</th>
                <th>Product detail</th>
                <th>Dealer detail</th>
                <th>Delete</th>
                
            </tr>
        </thead>
			<tbody>
			<?php
			$counter=1;
			while($row=$sql->fetch_assoc()){
				
				echo"<tr>
				<td><b>".$counter."</b></td>
				<td><b>".$row['pd_fname']."</b></td>
				<td><b>".$row['pd_lname']."</b></td>
				<td><b>".$row['user_mobile']."</b></td>
				<td><b>".$row['user_email']."</b></td>
				<td><b>".$row['user_plan_expire']."</b></td>
				<td><b>".$row['user_status']."</b ></td>";
				echo"<td><a href='product_detail.php?block1=".encr($row['pd_user_id'])."'class='btn btn-info butt'>Products</a></td>
				<td><a href='dealer_profile.php?block=".encr($row['pd_user_id'])."'class='btn btn-primary butt'>Detail</a></td>
				<td><a href='process/dealer_status.php?block=".encr($row['pd_user_id'])."'class='btn btn-danger butt'>Delete</a></td>
				</tr>";
				$counter++;
			}
				?>
			</tbody>
        </table>
				</div>
			</div>
		</div>
			
			</div> 
	<!--//forms-->											   
</div>
<!--//outer-wp-->
<?
require_once("include/footer.php");
?>