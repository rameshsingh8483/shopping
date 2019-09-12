<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

if(isset($_REQUEST['block'])){
$sql=$conn->query("SELECT * FROM user_login
LEFT JOIN profile_detail ON user_login.user_id=profile_detail.pd_user_id
WHERE user_type='{$_REQUEST['block']}' and user_regi_id = '".decr($_SESSION['user_id'])."'") or die($conn->error);
}

if(isset($_REQUEST['block1'])){
$sql=$conn->query("SELECT * FROM user_login
LEFT JOIN profile_detail ON user_login.user_id=profile_detail.pd_user_id
WHERE user_type='DEALER' and user_regi_id = '".decr($_REQUEST['block1'])."'") or die($conn->error);
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
                <th>Aadhar</th>
                <th>Licence</th>
                <th>Address</th>
                <th>Shop Name</th>
                <th>Shop Mobile</th>
                <th>Shop Address</th>
                <th>Status</th>
				<?php if($_SESSION['user_type'] == 'ADMIN'){
				?>
				<th>Profile</th>
                <?php }?>
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
				<td><b>".$row['pd_aadhar']."</b></td>
				<td><b>".$row['pd_licence']."</b></td>
				<td><b>".$row['pd_address']."</b></td>
				<td><b>".$row['pd_shop_name']."</b></td>
				<td><b>".$row['pd_shop_mobile']."</b></td>
				<td><b>".$row['pd_shop_address']."</b></td>
				<td><b>".$row['user_status']."</b></td>";
				if($_SESSION['user_type'] == 'ADMIN'){
				echo "<td><a href='dealer_profile.php?block=".encr($row['pd_user_id'])."' class='btn btn-info butt'>Profile</a></td>";
				}
				echo "</tr>";
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