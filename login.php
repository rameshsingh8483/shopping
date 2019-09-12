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
			<li><a href="#">Login</a></li>
		</ul>
		
		<div class="row">
			<div id="content" class="col-sm-12">
				<div class="page-login">
				
					<div class="account-border">
						<div class="row">
							<div class="col-sm-6 new-customer">
								<div class="well product-info">
									<h2><i class="fa fa-file-o" aria-hidden="true"></i> New Customer</h2>
									<p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
								</div>
								<div class="bottom-form">
									<a href="register.php" class="btn btn-default pull-right">Continue</a>
								</div>
							</div>
							
							<form action="process/login.php" method="post" id="login-form">
								<div class="col-sm-6 customer-login">
									<div class="well product-info">
										<h1> Login Here</h1>
		
										<div class="form-group">
											<label class="control-label " for="input-mobile">Mobile/Username</label>
											<input type="text" name="mobile" value="" id="input-mobile" class="form-control" />
										</div>
										<div class="form-group">
											<label class="control-label " for="input-password">Password</label>
											<input type="password" name="password" value="" id="input-password" class="form-control" />
										</div>
									</div>
									<div class="bottom-form">
										<!--<a href="#" class="forgot">Forgotten Password?</a>-->
										<input type="submit" value="Login" class="btn btn-default pull-right" />
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- //Main Container -->
		              <script>
                      $(function(){
                      $("#login-form").submit(function(){
                      Noty.closeAll();
                      var n = new Noty({type:"alert",theme:"sunset",text:"Please Wait",killer:true,timeout:false}).show();
                      $.ajax({
                      type: "POST",
                      dataType: "json",
                      url: $(this).attr("action"),
                      data: $(this).serialize(),
                      success: function(data) {
					//	console.log(data);  
                      n.setText(data.msg);
                      n.setType(data.status);
                      if(data.status=="success"){
                          $("#login-form").trigger("reset");
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