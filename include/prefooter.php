<!-- Footer Container -->
    <footer class="footer-container typefooter-4">
        <!-- Footer Top Container -->
     <!-- Top Container -->
        
        <section class="footer-middle ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col_4202  col-style">
                        <div class="infos-footer box-footer">
                            <div class="module">
                                <h3 class="modtitle">Contact Info</h3>
                                <ul >
                                    <li class="adres"><i class="fa fa-map-marker">1</i>Address : 123 Suspendis mattis, Sollicit <br>District,
                                      </li>
                                    <li class="mail"><i class="fa fa-envelope">2</i>Email : support@domain.com</li>
                                    <li class="phone"><i class="fa fa-mobile">3</i>Hotline 1 : 0123-456-78910
                                        <br>Hotline 2: 0987-765-43210</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col_bko7  col-style">
                        <div class="box-account box-footer">
                            <div class="module clearfix">
                                <h3 class="modtitle">My Account</h3>
                                <div class="modcontent">
                                    <ul class="menu">

                                        <li><a href="register.php">Register / Sign up</a>
                                        </li>
									<?php if(!isset($_SESSION['user_id'])){?>									
                                        <li><a href="login.php">Login / Sign in</a>
                                        </li>
									<?php }else{?>
									<li><a href="login.php">Logout</a>
                                        </li>
									<?php }?>
										<li><a href="cart.php">My Cart</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col_6urb  col-style">
                        <div class="box-information box-footer">
                            <div class="module clearfix">
                                <h3 class="modtitle">Information</h3>
                                <div class="modcontent">
                                    <ul class="menu">
                                        <li><a href="about.php">About Us</a>
                                        </li>
                                        <li><a href="contact.php">Contact us</a>
                                        </li>
                                        <li><a href="#">FAQ</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>
                
                </div>
                
            </div>
        </section>
	</footer>