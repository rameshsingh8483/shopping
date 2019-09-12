<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");
$sql=$conn->query("SELECT * FROM cat_detail order by cat_name");

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Category Detail</li>
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
                <th>Category name</th>
                <th>Subcat Detail</th>
                <th>Brand Detail</th>
				<th>Spec. detail</th>
				<th>Product Detail</th>
                <th>Action</th>
                <th>Action</th>
					
            </tr>
        </thead>
			<tbody>
			<?php
			$counter=1;
			while($row=$sql->fetch_assoc()){
				$var="cat";
				echo"<tr>
				<td>".$counter."</td>
				<td>".$row['cat_name']."</td>
				<td><a href='subcat_detail.php?block=".encr($row['cat_id'])."' class='btn btn-primary butt' target='_blank'>Subcat</a></td>
				<td><a href='brand_detail.php?block=".encr($row['cat_id'])."&block1=".$var."'class='btn btn-info butt' target='_blank'>Brand</a></td>
				<td><a href='spec_detail.php?block=".encr($row['cat_id'])."&block1=".$var."' class='btn btn-warning butt' target='_blank'>Specification</a></td>
				<td><a href='product_detail.php?block=".encr($row['cat_id'])."&block1=".$var."' class='btn btn-info butt' >Product</a></td>
				<td><a href='cat_update.php?block=".encr($row['cat_id'])."'class='btn btn-success butt' target='_blank'>Update</a></td>
				<td><a href='process/cat_delete.php?block=".encr($row['cat_id'])."' class='btn btn-danger butt'>Delete</a></td>
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