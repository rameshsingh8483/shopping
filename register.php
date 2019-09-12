<?php
require_once('include/vdooz.php');
require_once('include/top.php');
require_once('include/header.php');
?>
   
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Account</a></li>
			<li><a href="#">Register</a></li>
		</ul>
		
		<div class="row">
			<div id="content" class="col-md-8 col-sm-2 col-xs-12 col-md-offset-2 product-info register-page">
				<h2 class="title">Register Account</h2>
				<p>If you already have an account with us, please login at the <a href="login.php">login page</a>.</p>
				<form action="process/register.php" method="post" class="form-horizontal account-register clearfix" id="register-form">
					<fieldset id="account">
						<legend></legend>
						
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-firstname">First Name</label>
							<div class="col-sm-10">
								<input type="text" name="fname" value="" placeholder="Your first name" id="input-firstname" class="form-control">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
							<div class="col-sm-10">
								<input type="text" name="lname" value="" placeholder="Your last name" id="input-lastname" class="form-control">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-email">Mobile</label>
							<div class="col-sm-10">
								<input type="text" name="mobile" value="" placeholder="Enter your vaild mobile" id="input-email" class="form-control">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-telephone">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" value="" placeholder="Create your password" id="input-telephone" class="form-control">
								<input type="hidden" name="type" value='USER'>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-4 col-sm-offset-3 ">
								<input type="submit" value="Register" class="btn btn-primary form-control">
							</div>
						</div>
					</fieldset>

				</form>
			</div>
		</div>
	</div>
	<!-- //Main Container -->
	              <script>
                      $(function(){
                      $("#register-form").submit(function(){
                      Noty.closeAll();
                      var n = new Noty({type:"alert",theme:"sunset",text:"Please Wait",killer:true,timeout:false}).show();
                      $.ajax({
                      type: "POST",
                      dataType: "json",
                      url: $(this).attr("action"),
                      data: $(this).serialize(),
                      success: function(data) {
                      n.setText(data.msg);
                      n.setType(data.status);
                      if(data.status=="success"){
                          $("#register-form").trigger("reset");
                       setTimeout(function() {
                            // body...
                      window.location="index.php";
                        },1500)
                      }}});
                      return false;
                      });
                      });
                    //end ajax
                </script>

		
<?php
require_once('include/prefooter.php');
require_once('include/footer.php');
?>