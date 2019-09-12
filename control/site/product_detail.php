<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

/////////dashboard link

if(isset($_REQUEST['block4'])){	
$sql=$conn->query("SELECT * FROM product_detail WHERE pro_user_id = '".decr($_SESSION['user_id'])."' order by pro_id desc") or die($conn->error);
goto a;	
}

if(isset($_REQUEST['block2'])){	
$sql=$conn->query("SELECT * FROM product_detail order by pro_id desc") or die($conn->error);
goto a;	
}

//table link 
if(isset($_REQUEST['block'])){
$sql=$conn->query("SELECT * FROM product_detail WHERE pro_cat_id='".decr($_REQUEST['block'])."' and pro_level='".$_REQUEST['block1']."' order by pro_id desc") or die($conn->error);
goto a;
}

//table link 
if(isset($_REQUEST['block1'])){
$sql=$conn->query("SELECT * FROM product_detail WHERE pro_user_id='".decr($_REQUEST['block1'])."' and pro_user_type='DEALER' order by pro_id desc") or die($conn->error);
}

//dealer dashboard product link
else{
$sql=$conn->query("SELECT * FROM product_detail WHERE pro_user_id='".decr($_SESSION['user_id'])."' and pro_user_type='ADMIN' order by pro_id desc") or die($conn->error);		
}
a:
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Product Detail</li>
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
                <th>Product name</th>
                <th>Product Type</th>
				<?php if(!isset($_REQUEST['block1'])){?>
                <th>Product Image</th>
				<th>Main Image</th>
                <th>Edit</th>
                <th>Images</th>
				<?php } ?>
                <th>Delete</th>
                
            </tr>
        </thead>
			<tbody>
			<?php
			$counter=1;
			while($row=$sql->fetch_assoc()){
				$folder = "../../upload/product/".$row['pro_image'];
				echo"<tr>
				<td><b>".$counter."</b></td>
				<td><b>".$row['pro_name']."</b></td>
				<td><b>".$row['pro_type']."</b></td>";
				if(is_file($folder)){?>
                <td><a href="<?php echo $folder;?>" download><img class="img-thumnail img-responsive" id="myImg" src='<?php echo $folder; ?>' style="height:50px !important"></a></td>
				 <?php }else{
				echo "<td></td>";
				 }
			if(!isset($_REQUEST['block1'])){
				echo"<td><a href='product_main_image.php?block=".encr($row['pro_id'])."'class='btn btn-info butt'>Main Image</a></td>
				<td><a href='product_update.php?block=".encr($row['pro_id'])."'class='btn btn-primary butt'>Edit</a></td>
				<td><a href='product_images.php?block=".encr($row['pro_id'])."'class='btn btn-info butt'>Images</a></td>";
			
			}
				echo"<td><a href='process/product_delete.php?block=".encr($row['pro_id'])."&block1=".$row['pro_image']."' class='btn btn-danger butt'>Delete</a></td>
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