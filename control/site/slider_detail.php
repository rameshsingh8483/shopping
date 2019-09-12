<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM slider ") or die($conn->error);	

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Slider Detail</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
				<div class="table-responsive">
					<table id="example" class="table  table-striped table-bordered nowrap ">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Slider</th>
                <th>Action</th>
                <th>Action</th>
                
                
            </tr>
        </thead>
			<tbody>
			<?php
			$counter=1;
			while($row=$sql->fetch_assoc()){
				echo"<tr>
				<td><b>".$counter."</b></td>
				<td><b>Slider ".$counter."</b></td>
				<td><a href='slider_profile.php?block=".encr($row['slider_id'])."' class='btn btn-info butt'>Detail</a></td>
				<td><a href='process/slider_delete.php?block=".encr($row['slider_id'])."' class='btn btn-danger butt'>Delete</a></td>
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