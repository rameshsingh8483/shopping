<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");

$sql=$conn->query("SELECT * FROM cat_detail WHERE cat_id='".decr($_REQUEST['block'])."'")or die($conn->error);
$row=$sql->fetch_assoc();

?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Category Modify</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
					<form action="process/cat_update.php" method="POST" id="cat-register"> <div class="form-group"> <label>Category Name:</label> <input type="text" class="form-control" value="<?php echo $row['cat_name']?>" name="cat"><input type="hidden" name="cat_id" value="<?php echo $row['cat_id']?>"> </div> <button type="submit" class="btn btn-success">Update</button>
					<a href="cat_detail.php" class="btn btn-warning">Cancel</a> 					
					</form> 
				</div>

		</div>
			
			</div> 
	<!--//forms-->											   
</div>
<!--//outer-wp-->
<script>
                      $(function(){
                      $("#cat-register").submit(function(){
                      Noty.closeAll();
                      var n = new Noty({type:"alert",theme:"sunset",text:"Please Wait",killer:true,timeout:false}).show();
                      $.ajax({
                      type: "POST",
                      dataType: "json",
                      url: $(this).attr("action"),
					  data: $(this).serialize(),
					  success: function(data) {
//						console.log(data);
                      n.setText(data.msg);
                      n.setType(data.status);
                      if(data.status=="success"){
                        
						setTimeout(function() {
                            // body...
                      window.location="cat_detail.php";
                        },1000)
                      }}});
                      return false;
                      });});
                    //end ajax
</script>    
<?
require_once("include/footer.php");
?>