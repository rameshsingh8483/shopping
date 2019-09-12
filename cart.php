<?php 
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/header.php");
if(isset($_SESSION['user_id'])){
$sql = $conn->query("SELECT * FROM cart_detail
LEFT JOIN user_login ON user_login.user_id = cart_detail.cart_user_id
LEFT JOIN profile_detail ON profile_detail.pd_user_id = cart_detail.cart_user_id
WHERE cart_user_id = '".decr($_SESSION['user_id'])."'")or die($conn->error);
}	
?>
    
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Shopping Cart</a></li>
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h2 class="title">Shopping Cart</h2>
            <div class="table-responsive form-group">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center">Image</td>
                    <td class="text-left"> Name</td>
                    <td class="text-left"> Price</td>
                    <td class="text-left"> Seller Name</td>
                    <td class="text-left"> Seller Mobile</td>
                    <td class="text-left"> Seller Email</td>
					<td class="text-center">Remove</td>
                    </tr>
                </thead>
				
                <tbody>
				<?php
				if( $sql->num_rows != 0){
				while( $row = $sql->fetch_assoc()){
					
					$product_image = "upload/product/".$row['cart_pro_image'];
				?>
                  <tr>
                    <td class="text-center"><a href="product_detail.php?block=<?php echo encr($row['cart_pro_id']);?>"><img width="170px" height ="100px" src="<?php echo $product_image;?>"  class="img-thumbnail" /></a></td>
                    <td class="text-left"><a href="product_detail.php?block=<?php echo encr($row['cart_pro_id']);?>"><?php echo $row['cart_pro_name'];?></a><br />
                     </td>
                    <td class="text-left"><?php echo $row['cart_pro_price'];?></td>					
                    
                    <td class="text-left"><?php echo $row['pd_fname'].$row['pd_lname'];?></td>
                    <td class="text-left"><?php echo $row['user_mobile'];?></td>
                    <td class="text-left"><?php echo $row['user_email'];?></td>
					<td class="text-center">  
                        <a href="process/cart_delete.php?block=<?php echo $row['cart_pro_id'];?>" data-toggle="tooltip" title="Remove" class="btn btn-danger" onClick=""><i class="fa fa-times-circle"></i></button>
                        </span></div></td>
                  </tr>
				  <?php 
						}
						}
				  ?>
 
                </tbody>
              </table>
            </div>
      
</div>
        <!--Middle Part End -->
			
		</div>
	</div>
	<!-- //Main Container -->


<script>
$(document).ready(function(){
    $('.addToCart').click(function(){
		
		$.ajax({
		type:"POST",
		url:"process/cart_process.php",
		data:'id='+ $(this).attr('id'),
		success:function(data){
	
			}
		});
		
    });
});
</script> 
	
<?php require_once('include/prefooter.php')?>
<?php require_once('include/footer.php')?>