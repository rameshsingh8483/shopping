<?php
require_once("include/vdooz.php");
require_once("include/auth.php");
require_once("include/top.php");
require_once("include/header.php");
require_once("include/sider.php");
?>
<!--//outer-wp-->
<div class="outter-wp">
<!--/sub-heard-part-->
<div class="sub-heard-part">
   <ol class="breadcrumb m-b-0">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active">Register New Category</li>
	</ol>
</div>	
<!--/sub-heard-part-->	
<!--/forms-->
<div class="forms-main">
	
		<div class="graph-form">
				<div class="form-body">
					<form action="process/cat_register.php" method="POST" id="cat-register"> <div class="form-group"> <label for="cat-name">Category Name:</label> <input type="text" class="form-control" id="cat-name" placeholder="Category name" name="cat"> </div> <button type="submit" class="btn btn-default">Register</button> 
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
                          $("#cat_register").trigger("reset");
                       setTimeout(function() {
                            // body...
                      window.location="subcat_register.php";
                        },1000)
                      }}});
                      return false;
                      });});
                    //end ajax
</script>    
<?
require_once("include/footer.php");
?>