<?php

require_once("../include/vdooz.php");

//print_r2($_POST);

//	$spec_name = 'Price' ;
	
	$condition ='1=1';
	
	$condition.=' and vps_spec_name = "Price"';
	
	$condition.=' and vpd_user_status = "active"';
	
	//Main menu pagination value
	if(isset($_POST['cat_level'])){
		
		if($_POST['cat_level'] == "subcat"){
		
		$condition.=' and vpro_cat_id='.$_POST['cat_id'].'';
		$condition.=' and vpro_cat_subcat="'.$_POST['cat_level'].'"';		
	
	}if($_POST['cat_level'] != "subcat" and $_POST['cat_level'] != "" ){
		
	$condition.=' and vpro_main_cat='.$_POST['cat_id'].''; 
	
	}
	
	}
	//  home ajax search pagination values
	if(isset($_POST['category_id']) and !empty($_POST['category_id'])){				
	
	$condition.=' and vpro_main_cat='.$_POST['category_id'].''; 
	
	}
	
/*	if(isset($_POST['search']) and !empty($_POST['search'])){
	
	$condition.=' and vpro_name="'.$_POST['search'].'"';					
	
	}
*/	
	//close home ajax search values
	
	//advance search post values
	
	if(isset($_POST['cat']) and !empty($_POST['cat'])){				
	
	$condition.=' and vpro_main_cat='.$_POST['cat'].''; 
	}
	if(isset($_POST['type']) and !empty($_POST['type']) and $_POST['type'] !='All'){
	$condition.=' and vpro_type ="'.$_POST['type'].'"';			
	}
	if(isset($_POST['brand']) and !empty($_POST['brand'])){
	$condition.=' and vpro_cat_id='.$_POST['brand'].'';	
	$condition.=' and vpro_level = "brand"';	
	}
	
	if(isset($_POST['subcat']) and !empty($_POST['subcat']) and empty($_POST['brand'])){
	$condition.=' and vpro_cat_id='.$_POST['subcat'].'';				
	$condition.=' and vpro_level = "subcat"';
	}
	
	if(isset($_POST['price_min']) and !empty($_POST['price_min']) and is_numeric($_POST['price_min'])){
	$condition.=' and vps_spec_value >= '.$_POST['price_min'].'';			
	}

	if(isset($_POST['price_max']) and !empty($_POST['price_max'])  and is_numeric($_POST['price_max'])){
	$condition.=' and vps_spec_value <='.$_POST['price_max'].'';			
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

	if(isset($_POST['specification']) and !empty($_POST['specification'])){

foreach($_POST['specification'] as $key => $specification){

if($key==0){

$condition.=' and (vps_spec_value="'.$specification.'"';

}else{

$condition.=' or vps_spec_value="'.$specification.'"';

}

}

$condition.=")";

}

$results_per_page=10;
$data="select * from product_profile where ".$condition;					
//echo "select * from product_profile where ".$condition;					
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
	
//$data="select * from product_profile where ".$condition;					
//echo "select * from product_profile where ".$condition;					
//$sql=$conn->query($data)or die($conn->error);

// determine the sql LIMIT starting number for the results on the displaying page

//$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
//$sql="select * from user_details where ".$conditions." LIMIT ".$this_page_first_result.",".  $results_per_page."";
					
				//$result = $conn->query($sql)or die($conn->error);

						//echo $q->num_rows;

						//$counter=0;
						while($row = $result->fetch_assoc()){
					?>
			   
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
					 mysqli_data_seek($result,0);
					while($row = $result->fetch_assoc()){
						
						$product_image = 'upload/product/'.$row['vpro_image'];
						?>
						<div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12">
						<div class="product-item-container" style="width:100%">
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
								   
									<h4><a href="product.html" title="Chicken swinesha" target="_self"><?php echo $row['vpro_name'];?></a></h4>
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
										<p><?php echo $row['vpro_desc'];?></p>
									</div>
									<div class="list-block">
										<?php
										if(isset($_SESSION['user_id'])){?>
										<button class="addToCart btn-button" id="<?php echo $row['vpro_id'];?>" type="button" title="Add to Cart" onclick="cart.add('101', '1');"><i class="fa fa-shopping-basket"></i>
										</button>
										<?php  }else{ ?>
										 <a href="login.php" class="addToCart btn-button" title="Add to Cart" ><i class="fa fa-shopping-basket"></i>
										</a>
										<?php }?>                                                        
										<!--end quickview-->
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
					
					}
					?>
					</div>
				<!--// End Changed listings-->
		
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
							<div class="clearfix"></div>

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
	//--></script>             			