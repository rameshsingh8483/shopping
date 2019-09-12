<?php 
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/header.php");
/************** Category and Sub Category  ********************************/

if(isset($_REQUEST['block'])){
	
$_REQUEST['block'] = decr($_REQUEST['block']);

if($_REQUEST['block1'] == 'cat'){
	
	$condition ='1=1';
	
	$condition.=' and vpro_main_cat='.$_REQUEST['block'].'';		
	
	$condition.=' and vps_spec_name ="Price"';
	
	$condition.=' and vpd_user_status ="active"';
	
//echo "select * from product_profile where ".$condition;					
$data="select * from product_profile where ".$condition;					

}if($_REQUEST['block1'] == 'subcat'){	


	$condition ='1=1';
	
	$condition.=' and vpro_cat_subcat="'.$_REQUEST['block1'].'"';		

	$condition.=' and vpro_cat_id='.$_REQUEST['block'].'';		
	
	$condition.=' and vps_spec_name ="Price"';
	
	$condition.=' and vpd_user_status ="active"';
	
//echo "select * from product_profile where ".$condition;					
$data="select * from product_profile where ".$condition;					
	
}
}

/************************ Price search ***************************/
else{
	
	$condition ='1=1';
	
	$condition.=' and vps_spec_name ="Price"';
	
	$condition.=' and vpd_user_status ="active"';
	
	if(isset($_POST['category_id']) and !empty($_POST['category_id'])){
	
	$condition.=' and vpro_main_cat='.$_POST['category_id'].'';					
		
	}
	if(isset($_POST['search']) and !empty($_POST['search'])){
	
	$condition.=' and vpro_name="'.$_POST['search'].'"';					
		
	}
	
	if(isset($_POST['cat']) and !empty($_POST['cat'])){
	$condition.=' and vpro_main_cat='.$_POST['cat'].'';				
	}
	
	if(isset($_POST['price_min']) and !empty($_POST['price_min']) and is_numeric($_POST['price_min'])){
	
	$condition.=' and vps_spec_value >='.$_POST['price_min'].'';			
	}

	if(isset($_POST['price_max']) and !empty($_POST['price_max'] and is_numeric($_POST['price_max']))){
	$condition.=' and vps_spec_value <='.$_POST['price_max'].'';			
	}
	if(isset($_POST['type']) and !empty($_POST['type']) and $_POST['type'] !='All'){
	$condition.=' and vpro_type ="'.$_POST['type'].'"';			
	}
	
	if(isset($_POST['city']) and !empty($_POST['city']) and !in_array("All",$_POST['city'])){

foreach($_POST['city'] as $key => $city){

if($key==0){

$condition.=' and (vpro_city_id="'.$city.'"';

}else{

$condition.=' or vpro_city_id="'.$city.'"';

}

}

$condition.=")";

}

//echo "select * from product_profile where ".$condition;					
$data="select * from product_profile where ".$condition;					
	
}

$results_per_page=10;
$number=$conn->query($data)or die($conn->error);

$count=$number->num_rows;
$count = ceil($count/$results_per_page);
						// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql="select * from product_profile where ".$condition." LIMIT ".$this_page_first_result.",".  $results_per_page."";

	$result=$conn->query($sql)or die($conn->error);

	//echo $q->num_rows;

	$counter=0;

?>
<!-- Main Container  -->
<div class="main-container container ">
	
	<div class="row">
		
		<!--Middle Part Start-->
		<div id="content" class="col-md-8 col-sm-8">
			<div class="products-category search-result">
			   
			   
				<!-- Filters -->
				<div class="product-filter product-filter-top filters-panel">
					<div class="row">
						<div class="col-md-5 col-sm-3 col-xs-12 view-mode">
							
								<div class="list-view">
									
									<button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>
								</div>
					
						</div>
						<div class="short-by-show form-inline text-right col-md-7 col-sm-9 col-xs-12">
						</div>
						
					</div>
				</div>
				<!-- //end Filters -->
				<!--changed listings-->
				<div class="products-list row nopadding-xs so-filter-gird">
					<?php
					
					while($row = $result->fetch_assoc()){
						
						$product_image = 'upload/product/'.$row['vpro_image'];
						?>
					<div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12">
						<div class="product-item-container product-info" style="width:100%">
							<div class="left-block">
								<div class="product-image-container second_img">
									<a href="product_detail.php?block=<?php echo encr($row['vpro_id']);?>" target="_self" >
										<img src="<?php echo $product_image ;?>" class="img-1 img-responsive" alt="image" style="height:250px !important;">
										<img src="<?php echo $product_image ;?>" class="img-2 img-responsive" alt="image" style="height:250px !important;">
									</a>
								</div>
								<div class="box-label"></div>
								
							</div>
							<div class="right-block">
								<div class="caption">
								   
									<h4><?php echo $row['vpro_name'];?></h4>
									<?php
									$sql1 = $conn->query("SELECT * FROM product_spec
									 WHERE ps_pro_id = '{$row['vpro_id']}'")or die($conn->error);
									 while($row1 = $sql1->fetch_assoc())
										 if($row1['ps_spec_name'] =='Price' or $row1['ps_spec_name'] == 'price' or $row1['ps_spec_name'] == 'Rate')
											 goto a;
									?>

									<?php
									a:
									if (is_numeric($row1['ps_spec_value'])){
									$price = $row1['ps_spec_value']*10;
										  $price = $price+$row1['ps_spec_value'];
									}
									?>
									<div class="price">Rs. <?php echo $row1['ps_spec_value']?><span class="price-new"></span>
										<?php if (is_numeric($row1['ps_spec_value'])){
											?>
										<span class="price-old">Rs. <?php echo $price;?></span><?php }?>
									</div>
									<div class="description item-desc">
										<p><?php echo $row['vpro_desc'];?> </p>
									</div>
									<div class="list-block">
									<?php if(isset($_SESSION['user_id'])){?>
										<button class="addToCart btn-button" id="<?php echo $row['vpro_id'];?>" type="button" title="Add to Cart" onclick="cart.add('101', '1');"><i class="fa fa-shopping-basket"></i>
										</button>
										<?php  }else{ ?>
										 <a href="login.php" class="addToCart btn-button" title="Add to Cart" ><i class="fa fa-shopping-basket"></i>
										</a>
										<?php }?>
										<!--quickview-->                                                        
										<!--end quickview-->
									</div>
								</div>
							</div>
						</div>
					</div>
					
<?php
					
					}
					if(!empty($count)){ 
					?>
					<ul class='pagination pagination-style'>
					<li>
					<?php
					$value=1;
					echo"<a href='process/products.php?page=".$value."' class='btn btn-success ch-btn paging-btn'>FIRST</a>";
					if($page>1){
					echo"<a href='process/products.php?page=".($page-1)."' class='btn btn-success ch-btn paging-btn'>PREV</a>";}
					else{
						echo"<a href='javascript:function() { return false; }' class='btn btn-success ch-btn paging-btn'>PREV</a>";
						}
					
					echo"<a href='javascript:function() { return false; }' class='btn btn-success ch-btn paging-btn'> ".$page." </a>";
					if($page<$count){
					
					echo"<a href='process/products.php?page=".($page+1)."' class='btn btn-success ch-btn paging-btn'> NEXT </a>";}
					else{
						echo"<a href='javascript:function() { return false; }' class='btn btn-success ch-btn paging-btn'>NEXT</a>";
						}
					
					echo "<a href='process/products.php?page=".($count)."' class='btn btn-success ch-btn paging-btn'> END </a>
					";
					?>
					</li>
					  
					</ul>
					<?php }else{ ?>
					<h1 style="text-align:center;">No Product Matches</h1>
					<?php } ?>
					</div>
				<!--// End Changed listings-->
				
				<div class="loadeding"></div>
			  
				
			</div>
			
		</div>

		<!--Middle Part End-->

		<!--Right Part Start -->
		<aside class="col-md-4 col-sm-4 content-aside fixed" id="column-left">
			
			<div class="module">
<h3 class="modtitle" style="text-align:center;">Filter </h3>
<div class="modcontent ">
<form action="process/products.php" class="type_2 form-group" method="POST" id="form">
<?php if(isset($_REQUEST['block']) and !empty($count)){
	
	$cat_id = $_REQUEST['block'];
	$cat_level = $_REQUEST['block1'];
	
}else{
	$cat_id = "" ;
	$cat_level = "" ;
}

//Home ajax search

if(isset($_POST['search']) and !empty($count)){
	
	$search = $_POST['search'];
		
}else{
	$search = "" ;
	}
	
if(isset($_POST['category_id']) and !empty($count)){
	
	$category_id = $_POST['category_id'];
		
}else{
	$category_id = "";
	}	
?>
	<input type="hidden" name="cat_id" value="<?php echo $cat_id ; ?>">	
	<input type="hidden" name="cat_level" value="<?php echo $cat_level ; ?>">	
	<input type="hidden" name="search" value="<?php echo $search ; ?>">	
	<input type="hidden" name="category_id" value="<?php echo $category_id ; ?>">
	<div class="table_layout filter-shopby">
		<div class="table_row">
			<!-- - - - - - - - - - - - - - Category filter - - - - - - - - - - - - - - - - -->
			<div class="table_cell" style="z-index: 103;">
				<legend class="legend">Price Range</legend>
				<div class="row">
				
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
				<input class="form-control advance-input" type="text" value="" size="50" autocomplete="off" placeholder="Min." name="price_min">
				</div>
				<div class = "col-lg-5 col-md-5 col-sm-5 col-xs-5">
				<input class="form-control advance-input" type="text" value="" size="50" autocomplete="off" placeholder="Max." name="price_max">
				</div>
				<div class = "col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<button type="text" class="advance-search-btn reload-data fa fa-chevron-right"  style="float:right"></button>
				</div>
				</div>
			</div>
			
			<!---------------Get Category----------------------------->
			<?php
			$sql = $conn->query("SELECT * FROM cat_detail")or die($conn->error);
			
			?>
			<div class="table_cell">
				<fieldset>
					<legend class="legend">Category</legend>
					<select name = "cat" class="form-control advance-select search-inputs" onChange="getSubcat(this.value);">
					<option value="0">All</option>
					<?php while( $row = $sql->fetch_assoc() ){
					?>	
					<option <?php echo (isset($_REQUEST['block']) && $_REQUEST['block']==$row['cat_id']?"Selected":"")?>  value="<?php echo $row['cat_id']?>" ><?php echo $row['cat_name']?></option>
					
					<?php }?>
					</select>
				</fieldset>

			</div><!--/ .table_cell -->
			<!-- - - - - - - - - - - - - - End CATEGORY - - - - - - - - - - - - - - - - -->
			<div class="table_cell">
				<fieldset>
					<legend class="legend">Sub-Category</legend>
					<select class=" search-inputs form-control" name="subcat" id="subcat-list" onChange="getBrand2(this.value);">
					<option value="0">All</option>
					</select>
				</fieldset>

			</div><!--/ .table_cell -->
			<!-- - - - - - - - - - - - - - End SUB CATEGORY - - - - - - - - - - - - - - - - -->
			<div class="table_cell">
				<fieldset>
					<legend class="legend">Brand</legend>
					<select class="form-control search-inputs" id="brand-list" name="brand">
					<option value="0">All</option>
					
					
					</select>
				</fieldset>

			</div>

			<div class="table_cell">
				<fieldset>
				<?php 
				$sql = $conn->query("SELECT * FROM city_detail order by city_name")or die($conn->error);
				?>
					<legend class="legend">City</legend>
					<select class="selectpicker form-control search-inputs " name="city[]" multiple>
					<?php
					if(isset($_POST['city'])){
					while($row = $sql->fetch_assoc()){

						foreach($_POST['city'] as $key => $city){
					if($row['city_id'] == $city){							
					?>	
					<option <?php echo (isset($_POST['city']) && $city==$row['city_id']?"selected":"");?> value="<?php echo $row['city_id']?>"><?php echo $row['city_name']?></option>						
					<?php
					}else{?>
						
					<option value="<?php echo $row['city_id']?>"><?php echo $row['city_name']?></option>						
				<?php	}
					}
					}
					}
					?>
					
					</select>
				</fieldset>

			</div>
			<div class="table_cell">
				<fieldset>
					<legend class="legend">Product type</legend>
				<input type="radio" class='search-inputs pro_type'<?php echo (isset($_POST['type']) && $_POST['type']==""?"checked":"");?> name="type" value="All" >   All<br>

				<input type="radio" class='search-inputs pro_type' <?php echo (isset($_POST['type']) && $_POST['type']=="New"?"checked":"");?> name="type" value="New" >   NEW<br>
				
				<input type="radio" class='search-inputs pro_type' <?php echo (isset($_POST['type']) && $_POST['type']=="Old"?"checked":"");?> name="type" value="Old" > OLD<br>
				
				<input type="radio" class='search-inputs pro_type' <?php echo (isset($_POST['type']) && $_POST['type']=="Refurbished"?"checked":"");?> name="type" value="Refurbished"> Refurbished<br>					
				</fieldset>

			</div>
			
				<div class="table_cell">
				<fieldset>
					<legend class="legend">SPECIFICATION</legend>
					
					<div id="spec-list">
					
					</div>
				</fieldset>

			</div>
			<!--/ .table_cell -->
			<!-- - - - - - - - - - - - - - End SUB CATEGORY - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->
			
			<!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->
			


		</div><!--/ .table_row -->
		
	</div><!--/ .table_layout -->

	
</form>
</div>

</div>
</aside>
		<!--Right Part End -->
		
		
	</div>
	<!--Middle Part End-->
</div>
<!-- //Main Container -->


<!----Get Subcat , Brand and Specification accordiing to Cat------------>
<script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "process/cat_process.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcat-list").empty();
		$("#subcat-list").html(data);
		getBrand(val);
		getSpec(val);
	}
	});
}

function getBrand(val) {
	$.ajax({
	type: "POST",
	url: "process/cat_process.php",
	data:'cat_id2='+val,
	success: function(data){
//		$("#brand-list").empty();
		$("#brand-list").html(data);
		
	}
	});
}
</script>

<script>

function getSpec(val){
$.ajax({
type:"POST",
url:"process/spec_process.php",
data:'spec1='+val,
success:function(data){
//$("#spec-list").empty();
$("#spec-list").html(data);
}
});
}
</script>

<!-----Get Brand and specification According to subcat------->
<script>
function getBrand2(val){
$.ajax({
type:"POST",
url:"process/cat_process.php",
data:'brand2='+val,
success:function(data){
//$("#brand-list").empty();	
$("#brand-list").html(data);
getSpec2(val);
}
});
}
</script>

<script>

function getSpec2(val){
$.ajax({
type:"POST",
url:"process/spec_process.php",
data:'spec2='+val,
success:function(data){
//$("#subcat-list").empty();
$("#spec-list").html(data);
}
});
}

</script>

<script>
//search ajax

  $(".search-inputs").on('change',function(){
	
	//$(".search-result").html('<img src="assets/images/ajax-loader.gif" alt="loader">');
	
	$.post("process/products.php",

	$("form").serialize(),

	function(data){

		$(".search-result").html(data);

	});
return false;
	});

  $(".reload-data").on('click',function(){
	  
//	  $(".search-result").html('<img src="assets/images/ajax-loader.gif" alt="loader">');
	  
	$.post("process/products.php",

	$("form").serialize(),

	function(data){
		$(".search-result").html(data);
	
	});
return false;
	});


</script>

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
<script type="text/javascript"><!--
	// Check if Cookie exists
		if($.cookie('display')){
			view = $.cookie('display');
		}else{
			view = 'grid';
		}
		if(view) display(view);
		
		
		$(document).on('click',".paging-btn",function(){
  $.post($(this).attr("href"),$("#form").serialize(),function(data){
	  
	$(".search-result").html(data);
	});
	return false;
	});
	//--></script>             			

<?php require_once('include/prefooter.php')?>
<?php require_once('include/footer.php')?>