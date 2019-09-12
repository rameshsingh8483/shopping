
<?php 
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/header.php");

//product_detail tables 
$sql = $conn->query("SELECT * FROM product_detail WHERE pro_id = '".decr($_REQUEST['block'])."'")or die($conn->error); 

$row = $sql->fetch_assoc();

$product_image = 'upload/product/'.$row['pro_image'];

//product_spec tables 
$sql1 = $conn->query("SELECT * FROM product_spec WHERE ps_pro_id = '".decr($_REQUEST['block'])."'")or die($conn->error); 




//GET images
$find = $conn->query("SELECT * FROM product_image WHERE pimg_pro_id = '".decr($_REQUEST['block'])."' ")or die($conn->error); 


?>
<!-- Main Container  -->
<div class="main-container container">
<ul class="breadcrumb">
<li><a href="index.php">Home</a></li>
<li><a href="#"><?php echo $row['pro_name'];?></a></li>
</ul>

<div class="row">

<!--Middle Part Start-->
<div id="content" class="col-md-12 col-sm-12">

<div class="product-view ">
<div class="left-content-product">
<div class="row product-info">
<div class="content-product-left col-md-5 col-sm-12 col-xs-12">
<div id="thumb-slider-vertical" class="thumb-vertical-outer">
<!-- <span class="btn-more prev-thumb nt"><i class="fa fa-angle-up"></i></span>
<span class="btn-more next-thumb nt"><i class="fa fa-angle-down"></i></span> -->
<ul class="thumb-vertical">
<li class="owl2-item">
<a data-index="0" class="img thumbnail" data-image="<?php echo $product_image;?>">
	<img src="<?php echo $product_image;?>">
</a>
</li>
<?php 
while($data = $find->fetch_assoc()){
$product = 'upload/product/'.$data['pimg_name'];								
?>

<li class="owl2-item">
<a data-index="0" class="img thumbnail" data-image="<?php echo $product;?>">
	<img src="<?php echo $product;?>">
</a>
</li>
<?php } ?>	


</ul>


</div>

<div class="large-image  vertical">
<img itemprop="image" class="product-image-zoom slider-image" src="<?php echo $product_image;?>" data-zoom-image="<?php echo $product_image;?>" >
</div>


</div>

<div class="content-product-right col-md-7 col-sm-12 col-xs-12 product-info">
<div class="title-product">
<h1 class="product-name"><?php echo $row['pro_name'];?></h1>
<h3 class="specification-title">Specifications </h3>
</div>
<div class="product-box-desc product-desc">

<?php while($row1 = $sql1->fetch_assoc()){?>
<div class="row">
<div class="price-tax col-md-6 col-sm-6"><span class=" quickview-spec"><?php echo $row1['ps_spec_name'];?></span></div><div class="price-tax col-md-6 col-sm-6"><span class=" quickview-value"> <?php echo $row1['ps_spec_value'];?></span></div>
</div>
<hr>
<?php 
}
?>	
</div>
<div id="product">


<div class="form-group box-info-product">
<?php if(isset($_SESSION['user_id'])){?>
<div class="cart">
<input type="button" data-toggle="tooltip" title="" value="Add to Cart" data-loading-text="Loading..." id="<?php echo $row['pro_id']?>" class="btn btn-mega btn-lg addToCart" onclick="cart.add('42', '1');" data-original-title="Add to Cart">
</div>

<div class="cart">
<a data-toggle="tooltip" title="" href="seller_products.php?block=<?php echo encr($row['pro_user_id'])?>&&block1=<?php echo encr($row['pro_id'])?>" class="btn btn-primary pro-seller" data-original-title="Seller Detail">Seller detail</a>
</div>
<?php 
}else{
?>
<div class="cart">
<a href="login.php" data-toggle="tooltip" title="" class="btn btn-primary pro-seller" data-original-title="Add to Cart" data-original-title="Add To Cart">Add To Cart</a>
</div>
<div class="cart">
<a href="login.php" data-toggle="tooltip" title="" class="btn btn-primary pro-seller" data-original-title="Seller Detail" data-original-title="Seller Detail">Seller Detail</a>
</div>
<?php }?>
<!--
<div class="add-to-links wish_comp">
<ul class="blank list-inline">
<li class="wishlist">
	<a class="icon" data-toggle="tooltip" title=""
	onclick="wishlist.add('50');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i>
	</a>
</li>
<li class="compare">
	<a class="icon" data-toggle="tooltip" title=""
	onclick="compare.add('50');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i>
	</a>
</li>
</ul>
</div>-->

</div>

</div>
<!-- end box info product -->


</div>
</div>
</div>


</div>

<!-- Product Tabs -->
<div class="producttab">
<div class="tabsslider horizontal-tabs  col-xs-12">
<ul class="nav nav-tabs">
<li class="active "><a data-toggle="tab" href="#tab-1">Description</a></li>
<?php if(isset($_SESSION['user_id'])){?>
<li class="active"><a href="seller_products.php?block=<?php echo encr($row['pro_user_id'])?>&&block1=<?php echo encr($row['pro_id'])?>" class="seller-btn" target="_self">Seller detail</a></li>
<?php }else{?>
<li class="active"><a href="login.php" class="seller-btn">Seller detail</a></li>
<?php } ?>
</ul>
<div class="tab-content col-xs-12">
<div id="tab-1" class="tab-pane fade active in">
<p>
<?php echo $row['pro_desc']?></p>								
</div>
</div>
</div>
</div>
<!-- //Product Tabs -->


</div>
<!--Middle Part End-->

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


<?php
require_once('include/prefooter.php');
require_once('include/footer.php');
?>