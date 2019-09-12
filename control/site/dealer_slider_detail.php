<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM slider
LEFT JOIN user_login ON slider.slider_user_id=user_login.user_id
LEFT JOIN profile_detail ON slider.slider_user_id=profile_detail.pd_user_id
WHERE slider_type='DEALER' ") or die($conn->error);	

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Registered Dealer Slider Detail</li>
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
                <th>Remove Slider List</th>
                
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
				echo"<td><a href='process/slider_delete.php?block1=".encr($row['pd_user_id'])."'class='btn btn-danger butt'>Remove </a></td>
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