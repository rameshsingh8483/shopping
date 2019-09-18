<?php
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/header.php");

if(isset($_REQUEST['block5'])){


//get info to print dealer detail
$sql1 = $conn->query("SELECT * FROM profile_detail
LEFT JOIN user_login ON user_login.user_id = profile_detail.pd_user_id
WHERE pd_user_id = '".decr($_REQUEST['block5'])."'")or die($conn->error);

$row1 = $sql1->fetch_assoc();

$seller_image = 'upload/dealer/'.$row1['pd_image'];

$banner_image = 'upload/banner/'.$row1['pd_banner'];


}else{

// clicked product info
$find = $conn->query("SELECT * FROM product_detail WHERE pro_id = '".decr($_REQUEST['block1'])."'")or die($conn->error);

$data = $find->fetch_assoc();

$product_image = 'upload/product/'.$data['pro_image'];


//get info to print dealer detail
$sql1 = $conn->query("SELECT * FROM profile_detail
LEFT JOIN user_login ON user_login.user_id = profile_detail.pd_user_id
WHERE pd_user_id = '".decr($_REQUEST['block'])."'")or die($conn->error);

$row1 = $sql1->fetch_assoc();

$seller_image = 'upload/dealer/'.$row1['pd_image'];

$banner_image = 'upload/banner/'.$row1['pd_banner'];
}
?>
<!-- Main Container  -->
<div class="main-container container">
<?php if (!isset($_REQUEST['block5'])){?>
<div class="row">
<div id="content" class="col-sm-12 item-article">
<a href="#"><img src="<?php echo $banner_image;?>" class="img-responsive slider-image"></a>
<div class="row box-1-about">
<div class="col-md-8 welcome-about-us">
<!--<div class="title-about-us">
<h2>Welcome To <?php echo $row1['pd_shop_name'];?> </h2>
</div>-->

<div class="content-about-us">
<div class="image-about-us product-info">
<img src="<?php echo $seller_image;?>" class="img-responsive profile-picture">
<h2 style="text-align:center;">Seller Profile</h2>
</div>

<div class="des-about-us product-info"> <img src="<?php echo $product_image;?>" class="img-responsive banner-image">

<div class="list-block">
	<?php if(isset($_SESSION['user_id'])){?>
		<button class="addToCart btn-button cart-pro" id="<?php echo $data['pro_id'];?>" type="button" title="Add to Cart" onclick="cart.add('101', '1');"><i class="fa fa-shopping-basket"></i> Add To Cart
		</button>
		<?php  }else{ ?>
		 <a href="login.php" class="addToCart btn-button cart-pro" title="Add to Cart" ><i class="fa fa-shopping-basket"></i>Add To Cart
		</a>
		<?php }?>
		<!--quickview-->
		<!--end quickview-->
	</div>
</div>
</div>
</div>
<div class="col-md-4 why-choose-us">
<!--<div class="title-about-us">
<h2>Seller Personal Detail</h2>
</div>-->
<div class="content-why product-info">
<ul class="why-list">
<li><span class="span-info">Name : <?php echo $row1['pd_fname']." ".$row1['pd_lname'];?></span></li>
<li><span class="span-info">Mobile : <?php echo $row1['user_mobile']." , ".$row1['pd_shop_mobile'];?></span></li>
<li><span class="span-info">Email : <?php echo $row1['user_email'];?></span></li>
<li><span class="span-info">Shop Address : <?php echo $row1['pd_shop_address'];?></span></li>

</ul>
</div>
</div>
<div class="col-md-12 our-member">
<div class="title-about-us">
<h2><b><?php echo $row1['pd_fname'];?> Other Products</b></h2>
</div>
</div>
</div>
</div>
</div>
<?php }else{ ?>

<div class="row">
<div id="content" class="col-sm-12 item-article">
<a href="#"><img src="<?php echo $banner_image;?>" class="img-responsive slider-image"></a>
<div class="row box-1-about">

<div class="col-md-4 ">
<!--<div class="title-about-us">
<h2>Welcome To <?php echo $row1['pd_shop_name'];?> </h2>
</div>-->

<div class="content-about-us">
<div class="image-about-us product-info">
<img src="<?php echo $seller_image;?>" class="img-responsive profile-picture">
<h2 style="text-align:center;">Seller Profile</h2>
</div>

</div>
</div>
<div class="col-md-8 ">
<!--<div class="title-about-us">
<h2>Seller Personal Detail</h2>
</div>-->
<div class="content-why product-info">
<ul class="why-list">
<li><span class="span-info">Name : <?php echo $row1['pd_fname']." ".$row1['pd_lname'];?></span></li>
<li><span class="span-info">Mobile : <?php echo $row1['user_mobile']." , ".$row1['pd_shop_mobile'];?></span></li>
<li><span class="span-info">Email : <?php echo $row1['user_email'];?></span></li>
<li><span class="span-info">Shop Address : <?php echo $row1['pd_shop_address'];?></span></li>

</ul>
</div>
</div>
<div class="col-md-12 our-member">
<div class="title-about-us">
<h2><b><?php echo $row1['pd_fname'];?> Other Products</b></h2>
</div>
</div>
</div>
</div>
</div>
<?php
}
$query = $conn->query("SELECT * FROM cat_detail")or die($conn->error);
while($res = $query->fetch_assoc()){

if(isset($_REQUEST['block5'])){

 $sql = $conn->query("SELECT * FROM product_detail
 WHERE pro_user_id = '".decr($_REQUEST['block5'])."' and pro_main_cat = '".$res['cat_id']."'")or die($conn->error);

}else{

 $sql = $conn->query("SELECT * FROM product_detail
 WHERE pro_user_id = '".decr($_REQUEST['block'])."' and pro_main_cat = '".$res['cat_id']."'")or die($conn->error);

}
if($sql->num_rows !=0 ){
	?>
<div class="row product-info seller-product-info">


<!--Middle Part Start-->
<div class="so-categories custom-slidercates module clearfix">
	<h3 class="modtitle"><b><?php echo $res['cat_name']?> Products</b></h3>
	<div class="modcontent">
		<div class="cat-wrap theme3 font-title yt-content-slider"  data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="4" data-items_column2="3"  data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
<?php
 while($row = $sql->fetch_assoc()){
 $product_image = "upload/product/".$row['pro_image'];

//GET Price in specification_detail according to pro_id
			$sql1 = $conn->query("SELECT * FROM product_spec WHERE ps_pro_id = '".$row['pro_id']."'")or die($conn->error);

			while($row1 = $sql1->fetch_assoc())
			{
				if($row1['ps_spec_name'] == 'Price' or $row1['ps_spec_name'] == 'Rate' or $row1['ps_spec_name'] == 'price'){
					goto c;
				}
			}

c:
?>
			<div class="content-box">
				<div class="image-cat">
					<a href="product_detail.php?block=<?php echo encr($row['pro_id']);?>" target="_self" >
						<img src="<?php echo $product_image?>"  style='height:170px !important; width:100% !important;' alt="Ground round enim" class="img-responsive " />
					</a>
				</div>
				<div class="cat-title">
		<?php
			if (is_numeric($row1['ps_spec_value'])){
			$price = $row1['ps_spec_value']/10;
				  $price = $price+$row1['ps_spec_value'];
			}
			?>
			<p class="price"><span class="price-new">Rs.<?php echo $row1['ps_spec_value'];?></span><br>
			<?php if (is_numeric($row1['ps_spec_value'])){
			?>
				<span class="price-old">Rs. <?php echo $price;?></span>
			<?php }?>
			</p>
					<a href="product_detail.php?block=<?php echo encr($row['pro_id']);?>" target="_self"> <?php echo $row['pro_name'];?></a>
				</div>
			</div>
<?php }?>

		</div>
	</div>
	<div class="loadeding"></div>
</div>

</div>

<?php
}
}
?>
<!--Middle Part End-->
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

<script>
function display(view) {
$('.products-list').removeClass('list grid').addClass(view);
$('.list-view .btn').removeClass('active');
if(view == 'list') {
//$('.products-list .product-layout').addClass('col-lg-12');
// $('.products-list .product-layout .left-block').addClass('col-md-4');
// $('.products-list .product-layout .right-block').addClass('col-md-8');
$('.products-list .product-layout .item-desc').removeClass('hidden');
$('.products-list .product-layout .list-block').removeClass('hidden');
$('.products-list .product-layout .button-group').addClass('hidden');
$('.list-view .' + view).addClass('active');
$.cookie('display', 'list');
}
}
</script>
<script type="text/javascript">
// Check if Cookie exists
if($.cookie('display')){
view = $.cookie('display');
}else{
view = 'grid';
}
if(view) display(view);
</script>
<?php
require_once('include/prefooter.php');
require_once('include/footer.php');
?>
