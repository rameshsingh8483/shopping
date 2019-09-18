<?php
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/slider.php");




$sql = $conn->query("SELECT * FROM cat_detail order by cat_name")or die($conn->error);

?>

<!-- Main Container  -->
<div class="main-container">
<div id="content">
<div class="container">
<div class="row search-select">
<form action="products.php" method="POST">
  <div class="form-group col-md-2 col-sm-4">
    <label for="exampleFormControlSelect1" class="search-label">Product Category</label>
    <select class="form-control" name="cat" id="exampleFormControlSelect1">
      <option value="0">All</option>
	  <?php
      while($row = $sql->fetch_assoc()){
		  echo "<option value=".$row['cat_id'].">".$row['cat_name']."</option>";
	  }
		  ?>
    </select>
  </div>
  <div class="form-group col-md-2 col-sm-4">
    <label for="exampleFormControlSelect1" class="search-label">Select City</label>
	<select class="selectpicker form-control show-tick" name="city[]" multiple>

	  <?php
	  $sql = $conn->query("SELECT * FROM city_detail order by city_name")or die($conn->error);
      while($row = $sql->fetch_assoc()){
		  echo "<option value=".$row['city_id'].">".$row['city_name']."</option>";
	  }
		  ?>
    </select>
  </div>

    <div class="form-group col-md-2 col-sm-4">
    <label for="exampleFormControlSelect1" class="search-label">Price Min</label>
	<input type = "text" class="form-control" name = "price_min" placeholder = "Min.">
	</div>

  <div class="form-group col-md-2 col-sm-4">
    <label for="exampleFormControlSelect1"  class="search-label">Price Max</label>
    <input type = "text" class="form-control" name = "price_max" placeholder = "Max.">
  </div>
    <div class="form-group col-md-2 col-sm-4">

	<input type="submit" class="btn btn-primary search-button" value="Search">
  </div>

</form>
</div>
<?php
//get number of slider
$query = $conn->query("SELECT * FROM slider WHERE slider_type='PRODUCT'")or die($conn->error);

while($result = $query->fetch_assoc()){

//get slider products

$query1 = $conn->query("SELECT * FROM product_profile where vpro_level = '".$result['slider_level']."' and vpro_main_cat = ".$result['slider_main_cat']." and vpro_cat_id = ".$result['slider_cat_id']." and vps_spec_name = 'Price' and vpd_user_status = 'active' ")or die($conn->error);


//if slider related products registered in database then show
if($query1->num_rows != 0){

?>

<div class="so-categories custom-slidercates module clearfix">
	<h3 class="modtitle"><span><?php echo $result['slider_title'];?> </span></h3>
	<div class="modcontent">
		<div class="cat-wrap theme3 font-title yt-content-slider"  data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.2" data-margin="30" data-items_column0="5" data-items_column1="4" data-items_column2="3"  data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="no">

<?php
 while($result1 = $query1->fetch_assoc()){
 $product_image = "upload/product/".$result1['vpro_image'];

//GET Price in specification_detail according to pro_id
			$sql1 = $conn->query("SELECT * FROM product_spec WHERE ps_pro_id = '".$result1['vpro_id']."'")or die($conn->error);

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
					<a href="product_detail.php?block=<?php echo encr($result1['vpro_id']);?>" target="_self" >
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
					<a href="product_detail.php?block=<?php echo encr($result1['vpro_id']);?>" target="_self"> <?php echo $result1['vpro_name'];?></a>
				</div>
			</div>
<?php }?>

		</div>

			<div class="loadeding"></div>
	</div>

</div>
<?php
}
 }
?>

<!-- <button type="button"  class="new-btn">fjhsldfjsdlfksjdflsdafsdafsjdafa</button> -->

<!-- BEST SELLER SLIDER-->
<?php
//get Best Seller slider
$query = $conn->query("SELECT * FROM slider WHERE slider_type='DEALER'")or die($conn->error);

if($query->num_rows != 0){
?>

<div class="so-categories custom-slidercates module clearfix">
	<h3 class="modtitle"><span>Best Seller </span></h3>
	<div class="modcontent">
		<div class="cat-wrap theme3 font-title yt-content-slider"  data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="4" data-items_column2="3"  data-items_column3="2" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="no">
<?php

while($result = $query->fetch_assoc()){

//get slider Dealer information

$query1 = $conn->query("SELECT * FROM user_login
left join profile_detail on user_login.user_id = profile_detail.pd_user_id
where user_id = '".$result['slider_user_id']."'")or die($conn->error);


 $result1 = $query1->fetch_assoc();
 $dealer_image = "upload/DEALER/".$result1['pd_image'];

?>
			<div class="content-box">
				<div class="image-cat">
					<a href="seller_products.php?block5=<?php echo encr($result1['user_id']);?>" target="_self" >
						<img src="<?php echo $dealer_image?>"  style='height:170px !important; width:100% !important;' alt="Ground round enim" class="img-responsive " />
					</a>
				</div>
				<div class="cat-title">

			<p class="price"><span class="price-new"><?php echo $result1['pd_fname'].$result1['pd_lname'];?></span><br>

			</p>

				</div>
			</div>
<?php } ?>
		</div>
			<div class="loadeding"></div>
	</div>

</div>


<?php

}
?>
</div>
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

/*
    $('.all_selected').click(function(){

	//$('select[name=city]').val(1);

	$('.selectpicker').selectpicker('refresh')


    });
	*/
});

$(document).ready(function(){


});
</script>

<?php require_once('include/prefooter.php')?>
<?php require_once('include/footer.php')?>
