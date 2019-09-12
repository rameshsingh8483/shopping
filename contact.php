<?php 
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/header.php");

?>
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Contact us</a></li>			
		</ul>
		
		<div class="row">
			<div id="content" class="col-sm-12">

				<div class="info-contact clearfix">
					<div class="col-lg-4 col-sm-4 col-xs-12 info-store">
						<div class="row">
							<div class="name-store">
								<h3>Your Store</h3>
							</div>
							<address>
								<div class="address clearfix form-group">
									<div class="icon">
										<i class="fa fa-home"></i>
									</div>
									<div class="text">My Company, 42 avenue des Champs Elysées 75000 Paris France</div>
								</div>
								<div class="phone form-group">
									<div class="icon">
										<i class="fa fa-phone"></i>
									</div>
									<div class="text">Phone : 0123456789</div>
								</div>
								<div class="comment">             
								Maecenas euismod felis et purus consectetur, quis fermentum velition. Aenean egestas quis turpis vehicula.Maecenas euismod felis et purus consectetur, quis fermentum velition. 
								Aenean egestas quis turpis vehicula.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
								The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
								</div>
							</address>
						</div>
					</div>
					<div class="col-lg-8 col-sm-8 col-xs-12 contact-form">
						<form action="process/contact.php" method="post" class="form-horizontal" id="contact-form">
							<fieldset>
								<legend>Contact Form</legend>
								<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-name">Your Name</label>
							<div class="col-sm-10">
								<input type="text" name="name" value="" id="input-name" class="form-control" placeholder ="Your name">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-email">E-Mail /Contact</label>
								<div class="col-sm-10">
									<input type="text" name="email" value="" id="input-email" class="form-control" placeholder ="Your Email or Contact">
									</div>
								</div>
	
								<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-enquiry">Enquiry</label>
									<div class="col-sm-10">
										<textarea name="message" rows="10" id="input-enquiry" class="form-control" placeholder="Your Enquiry"></textarea>
									</div>
								</div>
							</fieldset>
							<div class="buttons">
								<div class="pull-right">
									<button class="btn btn-default buttonGray" type="submit">
										<span>Submit</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Main Container -->
  <script>
                      $(function(){
                      $("#contact-form").submit(function(){
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
                          $("#contact-form").trigger("reset");
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

<?php require_once('include/prefooter.php')?>
<?php require_once('include/footer.php')?>