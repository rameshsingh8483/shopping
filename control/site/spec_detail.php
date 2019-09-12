<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM specification_detail WHERE spec_cat_id='".decr($_REQUEST['block'])."' and spec_level='".$_REQUEST['block1']."' order by spec_name") or die($conn->error);
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Product Specification Detail</li>
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
                <th><h4>Sr. No.</h4></th>
                <th><h4>Spec. name</h4></th>
                <th><h4>Optional</h4></th>
                <th><h4>Filter</h4></th>
                <th><h4>Action</h4></th>
                <th><h4>Action</h4></th>
                
            </tr>
        </thead>
			<tbody>
			<?php
			$counter=1;
			while($row=$sql->fetch_assoc()){
				if($row['spec_optional']==1)
					$row['spec_optional']="Yes";
				else
					$row['spec_optional']="No";
				if($row['spec_filter']==1)
					$row['spec_filter']="Yes";
				else
					$row['spec_filter']="No";
				echo"<tr>
				<td>".$counter."</td>
				<td>".$row['spec_name']."</td>
				<td>".$row['spec_optional']."</td>
				<td>".$row['spec_filter']."</td>
				<td><a href='spec_update.php?block=".encr($row['spec_id'])."'class='btn btn-success butt'>Update</a></td>
				<td><a href='prcess/spec_delete.php?block=".encr($row['spec_id'])."' class='btn btn-danger butt'>Delete</a></td>
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