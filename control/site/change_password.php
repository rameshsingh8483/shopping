<?php
require_once("include/vdooz.php");
require_once("include/top.php");
require_once("include/auth.php");
?>
<!--/login-->

<div class="error_page">
<!--/login-top-->

<div class="error-top up">
<h2 class="inner-tittle page">Augment</h2>
<div class="login">
<h3 class="inner-tittle t-inner">Change Password</h3>
<form action="process/change_password.php" method="POST" id="change-form">

<input type="password" name="old_password" placeholder="Old Password">
<input type="password" name="new_password" placeholder="New Password">
<input type="password" name="conf_password" placeholder="Confirm Password">

<div class="submit"><input type="submit" onclick="myFunction()" value="Change" ></div>
<div class="clearfix"></div>

</form>
</div>

</div>

<!--//login-top-->
</div>
<!--//login-->
<!--footer section start-->
<div class="footer sign">
<div class="error-btn">
<a class="read fourth" href="dashboard.php"> Home</a>
</div>
<p>&copy <?php echo date('Y');?> Augment . All Rights Reserved | Design by <a href="http://vdooz.com/" target="_blank">Vdooz</a></p>
</div>
<!--footer section end-->
<script>
                      $(function(){
                      $("#change-form").submit(function(){
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
                          $("#change-form").trigger("reset");
                       setTimeout(function() {
                            // body...
                      window.location="dashboard.php";
                        },1000)
                      }}});
                      return false;
                      });});
                    //end ajax
</script>    