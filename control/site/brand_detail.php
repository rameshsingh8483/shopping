<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

if(isset($_REQUEST['block2'])){	
$sql=$conn->query("SELECT * FROM brand_detail order by bd_name") or die($conn->error);	

}if(isset($_REQUEST['block'])){
$sql=$conn->query("SELECT * FROM brand_detail WHERE bd_cat_id='".decr($_REQUEST['block'])."' and bd_level='".$_REQUEST['block1']."' order by bd_name") or die($conn->error);
}

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Brand Detail</li>
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
                <th>Brand name</th>
                <th>Product</th>
                <th>Action</th>
                <th>Action</th>
                
            </tr>
        </thead>
			<tbody>
			<?php
			$var="brand";
			$counter=1;
			while($row=$sql->fetch_assoc()){
				echo"<tr>
				<td><b>".$counter."</b></td>
				<td><b>".$row['bd_name']."</b></td>
				<td><a href='product_detail.php?block=".encr($row['bd_id'])."&block1=".$var."' class='btn btn-primary butt' >Product</a></td>
				<td><a href='brand_update.php?block=".encr($row['bd_id'])."'class='btn btn-success butt'>Update</a></td>
				<td><a href='process/brand_delete.php?block=".encr($row['bd_id'])."' class='btn btn-danger butt'>Delete</a></td>
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