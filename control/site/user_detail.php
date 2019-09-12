<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM user_login
LEFT JOIN profile_detail ON user_login.user_id=profile_detail.pd_user_id
LEFT JOIN city_detail ON profile_detail.pd_city=city_detail.city_id
WHERE user_type='USER'") or die($conn->error);	
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Users Detail</li>
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Password</th>
                <th>Address</th>
                <th>City</th>
                <th>Registered Dealer</th>
                <th>Action</th>
                
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
				<td><b>".$row['user_password']."</b></td>
				<td><b>".$row['pd_address']."</b></td>
				<td><b>".$row['city_name']."</b></td>
				<td><a href='user_dealer.php?block1=".encr($row['pd_user_id'])."' class='btn btn-success butt'>Dealers</a></td>
				<td><a href='process/user_delete.php?block=".encr($row['pd_user_id'])."' class='btn btn-danger butt'>Delete</a></td>
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