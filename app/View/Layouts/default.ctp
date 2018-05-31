<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html> 

    <head>
        <meta charset="utf-8" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->Html->charset(); ?>
        <title>

            <?php //echo $this->fetch('title'); ?>
            	My Treatment Hub
           
        </title>
        <link rel="icon" type="image/x-icon" href="<?php echo $this->webroot."images/spa/fav16.png";?>" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot . 'font/stylesheet.css' ?>" />
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXL1lHwsMrAD1zNspu_oCDGimxsP-Plbw&libraries=places"></script> 
        
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>-->
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
        <?php
        //echo $this->Html->meta('icon');

//		echo $this->Html->css('cake.generic');
        echo $this->Html->css(array('saloon-style', 'bootstrap.min', 'DateTimePicker', 'jquery.bxslider.min', 'slick', 'slick-theme'));
        echo $this->Html->script(array('npm', 'bootstrap.min', 'DateTimePicker', 'jquery.bxslider.min', 'slick'));
        echo $this->fetch('meta');
        echo $this->App->js();
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        
        <style>
            /* The side navigation menu */
.sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 1; /* Stay on top */
    top: 0;
    right: 0;
    background-color: #111; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
    transition: margin-left .5s;
    padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
            </style>
        
    <?php if($loggeduser){ ?>   
    <!--------------side-menu--------------------->
    <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onClick="closeNav()">&times;</a>
    <div class="profile_side">
        <?php if($user_data['User']['image'] != ''){ ?>    
        <img src="<?php echo $this->webroot ?>images/spa/users/<?php echo $user_data['User']['image']; ?>">
         <?php }else{ ?>
        <img src="<?php echo $this->webroot ?>images/spa/pic_pro.png">
        <?php } ?>
        
        <?php if($user_data['User']['name'] != ''){ ?>    
        <p><?php echo $user_data['User']['name']; ?></p>
        <?php }else{ ?>
        <p><?php echo $user_data['User']['first_name']; ?></p>
        <?php } ?>
        
    </div>
  
  	<a style="width:100%;" href="<?php echo $this->webroot; ?>users/edit" class="bbok_small">Edit Profile</a>
    <?php if($loggedUserRole == 'freelancer'){ ?>
    <a style="width:100%;" href="<?php echo $this->webroot ?>users/services" class="bbok_small">Services</a>
    <a style="width:100%;" href="<?php echo $this->webroot ?>users/weekly" class="bbok_small">Unavailability/Availability</a>
    <?php } ?>
    <a style="width:100%;" href="<?php echo $this->webroot ?>users/bookings" class="bbok_small">Booking History</a>
    <?php if($loggedUserRole == 'freelancer'){ ?>
    <a style="width:100%;" href="<?php echo $this->webroot ?>users/subscription" class="bbok_small">Subscriptions</a>
    <?php } ?>
    <a style="width:100%;" href="<?php echo $this->webroot ?>users/changepassword" class="bbok_small">Change Password</a>
    <a style="width:100%;" href="<?php echo $this->webroot ?>users/logout" class="bbok_small">Logout</a>
  
</div>
</li>
<!-- Use any element to open the sidenav -->
<span class="bar_white" onClick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span>
<?php } ?>
<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
 
    
    
    <!------------side-menu-end--------------------->
   
        <div class="right_box_fixed">
            <a href="javascript:void(0)" id="right_box_fixed">
                <h4><?php echo $item_count ? $item_count : '0'; ?></h4>
                <i class="fa fa-ticket" aria-hidden="true"></i>
            </a>
            
        </div>
        <a href="#" data-toggle="modal" data-target="#myModalnext" id="showcart" style="display:none;"></a>
        
        
        <!---- Cart modal ---->
        <div class="modal fade" id="myModalnext" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog width_log" role="document">
                <div class="modal-content full_page">
                    <div class="modal-header brdr_none">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="booking_tab">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">CONFIRMATION</a></li>
                                    <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">SCHEDULE</a></li>
                                    <a class="pink_ment" href="payment.html">PAYMENT</a>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active cart-modal" id="home">
                                        <h4>YOUR BOOKING SUMMARY</h4>
                                        
                                        <div class="alert alert-success" style="display:none; margin-bottom:13px !important;">
                                            <strong>Service has been removed.</strong>
                                        </div>

                                        <div class="table-responsive">          
                                            <table class="table" id="cart-tble">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Service</th>
                                                        <th>Time Duration</th>
                                                        <th>Price</th>      
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <table class="tbl table total-conf">
                                        <tr>
                                        	<td width="60%" float="left"><span class="lft_ttl">Total</span></td>
                                            <td width="20%" style="border-left:none;"><i class="fa fa-clock-o" aria-hidden="true"></i> 1 hr 40 mins</td>
                                            <td style="border-left:none;">$43</td>
                                        </tr>
                                        </table>
                                        <!--<div class="total_book">
                                            <h4>Total</h4>
                                            <ul>
                                                <li> <i class="fa fa-clock-o" aria-hidden="true"></i> 1 hr 40 mins</li>
                                                <li>$43</li>
                                            </ul>
                                        </div>-->
                                        <a href="" class="btn btn-default default_gren cart_proceed" style="display:none">PROCEED</a>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="schedule">
                                        <div class="calendr_cover">
                                        
                                            <div class="col-sm-6">
                                                <div class="calender_service" id="cart-calender">


                                                </div><!--check-service-->
                                            </div><!--col-6-->


                                            <div class="col-sm-6">
                                                <div class="time_service cart_time_service">
                                                    <h4>Service Time 30 Minutes</h4>
                                                    <h5>Date: </h5>
                                                    <ul>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="<?php echo $this->webroot ?>shop/payment" class="btn btn-default default_gren cart_proceed" style="display:none">PROCEED</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----Cart modal-end ---->
        
        
        <a href="#" data-toggle="modal" data-target="#empty_cart" id="showemptycart" style="display:none;"></a>
        
        <!-- Empty cart modal -->
        <div id="empty_cart" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content empty_log">
                    <!--div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div-->
                    <div class="modal-body">
                        <img src="<?php echo $this->webroot ?>images/spa/empty.jpg" style="width: auto; height: 162px;float: none;margin: 0 auto; display: table; position: absolute; top: 100px; left: 150px;">
                    </div>
                    <!--div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div-->
                </div>

            </div>
        </div>
        <!-- Empty cart modal (END) -->
        
        
        <!-- Modal -login-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog increase_lnth width_log" role="document">
                <div class="modal-content full_page log_grnd">
                    <div class="modal-header brdr_none">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login to your Account</h4>
                        <div class="alert alert-danger log-danger error-message" style="display:none">
                            <strong>Danger!</strong> Please fill all the fields.
                        </div>
                    </div>
                    <div class="modal-body prple_none">
                        <div class="col-sm-6">
                          <div class="log_inner">
                            <form action="" method="post" id="loginform">
                                <div class="form-group">
                                    <input type="text" class="form-control radius_none" id="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control radius_none" id="password" name="password" placeholder="Password">
                                </div>
                            
                                <div class="butn_login">
                                    <ul>
                                        <li><input type="submit" name="submit" id="log-submit" value="Login"></li>
                                        <li><a href="<?php echo $this->webroot?>users/forgetpwd" class="background_none">Forgot Password?</a></li>
                                    </ul>
                                </div>
                            </form>
                            
                            <div class="new_logo">
                                <h2>New to MTH?<a data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#myModals" id="signupfr">SIGN UP</a></h2>
                            </div> 

                        </div>
                    </div>
                  </div>
                    <div class="col-sm-6">
                        <div class="right_login">
                            <div class="login_image">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            </div>
                            <div class="login_text">
                                <h3>Manage Your Booking</h3>
                                <p>Confirm bookings in one click</p>
                            </div>
                        </div>

                        <div class="right_login">
                            <div class="login_image">
                                <i class="fa fa-bell-o" aria-hidden="true"></i>

                            </div>
                            <div class="login_text">
                               <h3>Be Updated</h3>
                    <p>Get Relevant Information</p>
                </div>
            	</div>
                
                <div class="right_login">
            <div class="login_image">
               <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            	</div>
                <div class="login_text">
                	<h3>Engage Socially</h3>
                    <p>Write Reviews, Get Feedbacks & Ratings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------modal-------------------->
        
        
        <!--sign-up-modal-->
        <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog width_log" role="document">
                <div class="modal-content full_page sign_grnd">
                    <div class="modal-header brdr_none lwss_brd">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">SIGN UP</h4>
                        <p class="seq_ence"> Please enter details to create your account</p>
                        
                        
                        <div class="alert alert-success reg-success" style="display:none">
                            <strong>Success!</strong> Registration successfully.
                        </div>
                        
                        <div class="alert alert-danger reg-danger" style="display:none">
                            <strong>Danger!</strong> Please fill all the fields.
                        </div>
                        
                    </div>
                    <div class="modal-body prple_none">
                        <div class="col-sm-6">
                        <div class="log_inner">
                            <form action="" method="post" id="signupform">
                                <div class="form-group">
                                    <input type="text" name="data[User][first_name]" class="form-control radius_none" id="first_name" placeholder="First name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="data[User][last_name]" class="form-control radius_none" id="last_name" placeholder="Last name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="data[User][email]" class="form-control radius_none" id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="data[User][password]" class="form-control radius_none" id="pass" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="data[User][confirmpassword]" class="form-control radius_none" id="cpass" placeholder="Confirm Password" required>
                                </div>
                            
                            <div class="lancer_less">
                                     <label class="checkbox-inline left_free">
                                    <input type="radio" name="role" value="freelancer" id="role" class="free_lancer">
                                    <span class="green_colr">As Freelancer</span>
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="radio" name="role" value="customer" id="role" class="free_lancer"> 
                                    <span class="green_colr"> As Customer</span>
                                </label>
                                <div id="fiileoutput"></div>
                               </div>
                            
                                <div class="form-group multiFiles" style="display:none" >
                                <p>Do you have Public Liability Insurance?</p>
                                    <input type="file" name="attach[]" class="form-control radius_none" id="multiFiles" accept=".docx, .jpeg, .jpg, .pdf"  multiple="multiple" required>
                                    <span style="color: #fb0303; font-size: 12px;">*Please upload certificates/qualifications. You should be able to upload more than one.</span>
                                    <!--<input type="button" name="button" id="regbu" value="Sign up">-->
                                </div>

                                <div class="butn_login">
                                    <ul>
                                        <li><input type="button" name="button" id="reg-submit" value="Sign up"></li>
                                        <li><a href="<?php echo $this->webroot?>users/forgetpwd" class="background_none">Forgot Password?</a></li>
                                    </ul>
                                </div>
                                
                                    
                            </form>
                            <div class="new_logo">
                                <h2>Already Registered?<a  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#myModal" >LOGIN</a></h2>
                            </div> 

                        </div>
                    </div>
                   </div>
                    <div class="col-sm-6">
                        <div class="right_login">
                            <div class="login_image">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            </div>
                            <div class="login_text">
                                <h3>Manage Your Booking</h3>
                                <p>Confirm bookings in one click</p>
                            </div>
                        </div>

                        <div class="right_login">
                            <div class="login_image">
                                <i class="fa fa-bell-o" aria-hidden="true"></i>

                            </div>
                            <div class="login_text">
                               <h3>Be Updated</h3>
                    <p>Get Relevant Subscriptions</p>
                </div>
            	</div>
                
                <div class="right_login">
            <div class="login_image">
               <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            	</div>
                <div class="login_text">
                	<h3>Engage Socially</h3>
                    <p>Write Reviews, Get Feedbacks & Ratings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------modal end-------------------->
        
        
        <!-- Header section -->
        <div class="header_section">
            <div class="container">
                <div class="row">
					<div class="main_header">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" area-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="<?php echo $this->webroot; ?>" class="navbar-brand"><img src="<?php echo $this->webroot; ?>images/spa/logon-01.png" alt="image not found"></a>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
								<?php foreach($all_links as $link){ ?>
								<?php if($link['Link']['slug'] == 'facebook' || $link['Link']['slug'] == 'twitter'){ ?>
								<li><a href="<?php echo $link['Link']['link']; ?>"><i class="fa fa-<?php echo $link['Link']['slug']; ?>" aria-hidden="true"></i></a></li>
								<?php } ?>
								<?php } ?>
								<li class="left_border"><a href="<?php echo $this->webroot ?>bussinesslist">List your business</a></li>
								<?php if(!$loggeduser){ ?>
								<li><a href="" data-toggle="modal" data-target="#myModal">Login</a></li>
								<?php } else { ?>
								<li><a href="<?php echo $this->webroot; ?>users/view">My account</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
                </div>
            </div>
        </div>
        
        <?php if ($this->here == $this->webroot){ ?>
        
        <div class="banner_section"> 
            <img class="" src="<?php echo $this->webroot; ?>images/banner.jpg">
            <div class="smart_search">
                <div class="container">
                    <div class="search_area">
                        <h3 class="treatment_right">Enjoy professional treatments with<br> highly trained experts</h3>
                        <h2>Book your wellness appointment with the click of a button</h2>
                        <form action="<?php echo $this->webroot; ?>salon/search" method="post">
                        <ul>
                            <li class="input1">
                                <div class="search_outer">
                                    <i class="fa fa-search icon_left"></i>
                                    <input class="padding_right" name="category" type="text" placeholder="Start Typing Services...." id="search-cat" autocomplete="off">
                                    <input class="padding_right" name="category" type="hidden" placeholder="Start Typing Services...." id="search-cat2">
                                    <div class="cat-results"></div>
                                    <i class="fa fa-times icon_right cat-res-cross" aria-hidden="true"></i>

                                </div>
                            </li>
                            <li class="input2">
                                <div class="search_outer"><i class="fa fa-map-marker icon_left" aria-hidden="true"></i>
                                    <input name="location" type="text" placeholder="Enter Postcode" id="search-location" autocomplete="off">
                                    <div class="loc-results"></div>
                                </div>
                            </li>
                            <li class="input3"><input name="date" type="text" placeholder="Select Date and Time" id="" autocomplete="off"  data-field="datetime"><div class="search_outer" id="search-name"></div></li>
                            <li><input name="" type="submit" value="SEARCH" id="search-search"></li>
                        </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php } ?>
        
        
        <!-- Header section (END) -->
        
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->fetch('content'); ?>
        
        
        <!-- Footer section -->
        <div class="footer">
        <div class="main_footer">
            <div class="container">
                <div class="row">
                    
                        <div class="col-sm-3">
                            <div class="heading_contact">
                                <h4>Contact</h4>
                            </div>
                            <div class="contact_info">
                                <ul>
                                    <li><h4>Email Address</h4><div class="contact_right">info@mytreatmenthub.com</div></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="service_salon">
                                <h4>Services</h4>
                                <ul>
                                	<?php if(!empty($pages)){ ?>
                                	<?php foreach($pages as $page){ ?>
                                    <?php if($page['Staticpage']['title'] != 'Privacy Policy'){ ?>
                                    <li><a class="blck_ftr" href="<?php echo $this->webroot ?>staticpage/<?php echo $page['Staticpage']['id']; ?>"><?php echo $page['Staticpage']['title']; ?></a></li>
                                    <?php }} ?>
                                    <?php } ?>
                                    <li><?php  echo $this->Html->link('Contact Us', array('controller' => 'contacts', 'action' => 'index'), array('class' => 'blck_ftr'));?></li>
                                  
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="folow_section">
                                <h4>Follow Us</h4>
                                <ul>
                                	<?php foreach($all_links as $link){ ?>
                                    <?php if($link['Link']['link'] != ''){ ?>
                                    <li><a href="<?php echo $link['Link']['link']; ?>"><i class="fa fa-<?php echo $link['Link']['slug']; ?>" aria-hidden="true"></i></a></li>
                                    <?php } ?>
                                    <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="news_letter">
                                <h4>Newsletter Signup</h4>
                                <p>Enter your Email Address to know about Subscriptions and receive information by email.</p>
                                <div class="alert alert-success" style="display:none; width: 100%;float: left;"></div>
								<div class="news-form">
									<input type="text" id="news-input">
									<button type="button" class="btn btn-default fltr_colr" id="news-btn">Submit</button>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lower-footer">
            <div class="container">
                <!--<h4>Copyright @ 2017<span> ALL RIGHT RESERVED</span></h4>-->
                <h4>My Treatment Hub and the My Treatment Hub logo are trademarks and tradenames of My Treatment Hub Limited and may not be used or reproduced without written consent.<br> &#169; 2017 My Treatment Hub Limited</h4>
            </div>
        </div>
        <!-- Footer section (END) -->
        
        <?php
        $current_date = date("d-m-Y");
    
        $current_day = date('l', strtotime($current_date));
        ?>
        
        <input type="hidden" name="cart_day_this" id="cart_day_this">
        <p id="cart_salon_id" style="display:none;"><?php echo $cart_salon_id; ?></p>
        
    </body>
</html> 

<?php
    $ctime = date("H:i:s");
    echo $limit_time = date("h:i a", floor(strtotime($ctime) / 15 / 60) * 15 * 60);
?>

<script>

$(function() {
    $(".success-message").delay(5000).fadeOut('slow');
});

$(function() {
    $(".error-message").delay(5000).fadeOut('slow');
});

$('#signupform #first_name, #signupform #last_name').keypress(function(e){
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    if(code == 32 || (code>=97 && code<=122)|| (code>=65 && code<=90))
        return true;
    else
        return false;
});

$('.pink_ment').click(function(){
	return false;
});
    
$(document).delegate('.free_lancer', 'click', function(){
	var val = $('input:radio[name=role]:checked').val();
	//
	if(val == 'freelancer'){
		$(".multiFiles").css("display", "block");
	}else{
		$(".multiFiles").css("display", "none");
	}
});
	
    
$(document).delegate("#reg-submit", "click", function(){
    var fname = $('#signupform #first_name').val();
    var lname = $('#signupform #last_name').val();
    var email = $('#signupform #email').val();
    var pass = $('#signupform #pass').val();
    var cpass = $('#signupform #cpass').val();
    var role = $("#signupform #role:checked").val();
    var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;   
	
	var form_data = new FormData();
	var ins = document.getElementById('multiFiles').files.length;
	for (var x = 0; x < ins; x++) {	
		form_data.append("files[]", document.getElementById('multiFiles').files[x]);
	}
	

    var data = {
        first_name: fname,
        last_name: lname,
        email: email,
        pass: cpass,
        role: role//,
		//files: form_data
    }
    
    var msg = '';
    if(role == 'customer'){
        msg = '<strong>Success!</strong> Registration successfully.';
    }else if(role == 'freelancer'){
        msg = 'Your details has  been sent to Admin for Confirmation, Please wait for the Admin to approve your request. ';
    }

    //alert(fname+', '+lname+', '+email+', '+pass+', '+cpass+', '+role);
    //return false;
    if(fname == '' || lname == '' || email == '' || pass == '' || cpass == '' || !$("#signupform #role:checked").val()){
        $(".reg-danger").html('You must fill in all of the fields.');
        $(".reg-danger").css('display', 'block');
    }else if(pass != cpass){
        $(".reg-danger").html('Password and Confirm Password fields do not match.');
        $(".reg-danger").css('display', 'block');
    }else if(!email_regex.test(email)){
        $(".reg-danger").html('Please Enter valid Email Address.');
        $(".reg-danger").css('display', 'block');
    }else if(role == 'freelancer' && ins == '0'){
		$(".reg-danger").html('Please add attachment files.');
        $(".reg-danger").css('display', 'block');
	}else{
		
		   $.ajax({
				url: '<?php echo $this->webroot; ?>users/ajaxsignup',
				method: 'post',
				data: data,
				dataType:'json',
				success: function(response){
				console.log(response);
					if(response.response == 'success'){
						$(".reg-danger").css('display', 'none');
						$(".reg-success").html(msg);
						$(".reg-success").css('display', 'block');
						
						$('#signupform #first_name').val('');
						$('#signupform #last_name').val('');
						$('#signupform #email').val('');
						$('#signupform #pass').val('');
						$('#signupform #cpass').val('');
						$("#signupform #role:checked").val('');
						
						if(role == 'freelancer'){
							$.ajax({
								url: '<?php echo $this->webroot ?>users/ajaxUploadImages', // point to server-side PHP script 
								dataType: 'json', // what to expect back from the PHP script
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,
								type: 'post',
								success: function (json) {
								console.log(json);
									
									if(json.error == 0){
								
										 $.ajax({
											url: '<?php echo $this->webroot; ?>users/updateDocuments',
											method: 'post',
											data: {input: json.input, id: response.last_id},
											dataType:'json',
											success: function(response){
											}
										});
											
									}
								}
							});
					   }
					
					}else if(response.response == 'error'){
						$(".reg-success").css('display', 'none');
						$(".reg-danger").html('<strong>Danger!</strong> Registration unsuccessful.');
						$(".reg-danger").css('display', 'block');
					}else if(response.response == 'exist'){
						$(".reg-success").css('display', 'none');
						$(".reg-danger").html('Email ID already registered. Try with another Email address.');
						$(".reg-danger").css('display', 'block');
					}
				}
		   });
	   
   }
   return false;
});    


$(document).delegate("#log-submit", "click", function(){
   var email = $('#loginform #email').val();
   var password = $('#loginform #password').val();
   
   var data = {
       email: email,
       password: password
   }
   
   var current_controller = '<?php echo $this->Session->read("current_controller") ?>';
   var current_action = '<?php echo $this->Session->read("current_action") ?>';
   
   if(email == '' || password == ''){
       $(".log-danger").html("<strong>Danger!</strong> Please fill all the fields.");
       $(".log-danger").css('display', 'block');
   }else{
       $.ajax({
          url: '<?php echo $this->webroot; ?>users/ajaxlogin',
          method: 'post',
          data: data,
		  dataType: 'html',
          success: function(response){
              if(response == 'success'){
                    $(".log-danger").css('display', 'none');
					
					 /*$.post('<?php echo $this->webroot; ?>users/authRemember', function(data, status){
					 	
					 });*/
					 
					 if(current_action == 'checkout' && current_controller == 'Shop'){
						window.location.href = "<?php echo $this->webroot ?>shop/checkout";
					}else{					
						window.location.href = "<?php echo $this->webroot; ?>";
					}	
 
              }else if(response == 'error'){
                    $(".log-success").css('display', 'none');
                    $(".log-danger").html('<strong>Danger!</strong> Username or password is incorrect.');
                    $(".log-danger").css('display', 'block');
              }else if(response == 'admin'){
                    $(".log-danger").css('display', 'none');
                    window.location.href = "<?php echo $this->webroot; ?>admin/dashboards/dashboard";
              }
          }
        });
   }
   return false;
});   
   
   
$('#search-cat').keyup(function(){
    var value = $(this).val();
    var data = {
        value:value
    }
	
	$("#search-cat2").val(value);
	
    $.ajax({
       url: '<?php echo $this->webroot ?>salon/ajaxgetServices',
       data: data,
       method: 'post',
       dataType: 'json',
       success: function(json){

            console.log(json);

            var html = '<ul>';
            for(var i = 0; i < json.length; i++){
                html +='<li class="search-cat-res" data-id="'+json[i]['Service']['name']+'">'+json[i]['Service']['name']+'</li><br>';
            }
            html += '</ul>';
            $(".cat-results").html(html);
			
			if( value.length == 0 ) {

				$(".cat-results").html('');
			}
        }
    });
    
}); 

$(".cat-res-cross").click(function(){
	$('.cat-results').html('');
	$('#search-cat2').val('');
	$('#search-cat').val('');
});

$(document).delegate('.search-cat-res', 'click', function(){
    var id = $(this).data('id');
    var value = $(this).text();

    $("#search-cat").val(value);
    $("#search-cat2").val(id);
    $(".cat-results").html(''); 
});


$('#search-location').keyup(function(){
    var value = $(this).val();
    var data = {
        value:value
    }

    $.ajax({
       url: '<?php echo $this->webroot ?>salon/ajaxgetLocations',
       data: data,
       method: 'post',
       dataType: 'json',
       success: function(json){


            console.log(json);
			var html = '<div class="cat-res">';
            html += '<ul>';
            for(var i = 0; i < json.length; i++){
                html +='<li class="search-loc-res" data-id="'+json[i]['User']['id']+'">'+json[i]['User']['location']+'</li><br>';
            }
            html += '</ul>';
			html += '</div>';
            $(".loc-results").html(html);
			
			if(value == ''){
				$(".loc-results").html('');
			}
        }
    });

    

}); 

$(document).delegate('.search-loc-res', 'click', function(){
    var id = $(this).data('id');
    var value = $(this).text();

    $("#search-location").val(value);
    $(".loc-results").html(''); 
});

$(document).ready(function(){
    $("#search-name").DateTimePicker({
        dateTimeFormat : "dd-MM-yyyy HH:mm AA"
    });
}); 

$('#search-search').click(function(){
   var cat = $('#search-cat').val();
   var loc = $('#search-location').val();
   var date = $('input[name="date"]').val();
   
   if(cat == '' || loc == ''){
       alert('Please fill all the fields');
       return false;
   }   
});




function showSubscribeDate(){
	 $.ajax({
       url: '<?php echo $this->webroot; ?>users/getSalonSubscribeDate',
       method: 'post',
       dataType: 'json',
       success: function(json){
	   console.log(json);
	   
	   var start_date = json.sub_date.split('-');
	   var end_date = json.exp_date.split('-');
	   
	   	//$( "#cart-calender" ).datepicker({minDate: new Date(json.sub_date), maxDate: new Date(json.exp_date), dateFormat: 'dd-mm-yy'});
		//$( "#cart-calender" ).datepicker({minDate: new Date(start_date[2], start_date[0], start_date[1]), maxDate: new Date(end_date[2], end_date[0], end_date[1]), dateFormat: 'dd-mm-yy'});
		$( "#cart-calender" ).datepicker({minDate: 0, maxDate: new Date(end_date[2], end_date[0], end_date[1]), dateFormat: 'dd-mm-yy'});
		$("#cart-calender").trigger("change");
	   }
	});   
}

$(document).delegate('#right_box_fixed','click', function(){
    
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '0'){
            $('#showemptycart').trigger('click');
        }else{
            showcart();
        }
    });
});

function showcart(){
	showSubscribeDate();
    $.ajax({
       url: '<?php echo $this->webroot; ?>shop/getCartitems',
       method: 'post',
       dataType: 'json',
       success: function(json){

        var html = '';
        var total = '';
        
        $.each(json.OrderItem, function(key,val) {    
            
            html += '<tr>';
            html += '<td class="venue_left"><p>'+val.category+'</p></td>';
            html += '<td class="venue_left"><p>'+val.service+'</p></td>';
            
            html += '<td class="venue_left">';
            html += '<div class="time_sumry">';
            html += '<ul>';
            html += '<li><i class="fa fa-clock-o" aria-hidden="true"></i></li>';
            html += '<li class="space_left">'+val.time+'</li>';
            html += '</ul>';
            html += '</div>';
            html += '</td>';
            
            html += '<td class="venue_left"><p><i class="fa fa-gbp" aria-hidden="true"></i> <span style=" padding-right:3px;">'+val.price+'</span></p></td>';
            html += '<td class="venue_left"><i class="fa fa-window-close-o rem-cart" aria-hidden="true" data-id="'+val.service_id+'"></i></td>';
            html += '</tr>';
        });
        
        $('#cart-tble tbody').html(html);
        
		
		total +='<td width="56%" float="left"><span class="lft_ttl">Total</span></td>';
        total +='<td style="border-left:none;float: left;width: 50%;"><i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</td>';
        total +='<td style="border-left:none; width:28%;"><i class="fa fa-gbp" aria-hidden="true"></i>' +json.Price +'</td>';

		$('.cart-modal .total-conf tr').html(total);
        
        $('.cart_time_service h4').html('Service time: <span>'+json.Time+'</span> minutes');
        
        
        var data = {
            date: '<?php echo $current_date ?>',
            day: '<?php echo $current_day ?>',
            user_id: json.Salon
        }
        
        
        $.ajax({
            url: '<?php echo $this->webroot; ?>salon/ajaxavailable',
            data: data,
            method: 'post',
            success: function(response){
                $('.cart_time_service ul').html(response);
                
                $('.cart_time_service ul').attr('data-date', '<?php echo $current_date ?>');
                
				
            }
        });
		
        $("#showcart").trigger('click');
        $('.cart_proceed').css('display', 'none');
        $("#cart-calender").trigger("change");
       }
    });
}    

$(document).delegate('.rem-cart', 'click',function(){
    var service_id = $(this).attr('data-id');
    
    var data = {
        service_id: service_id
    }
    
    $.ajax({
       url: '<?php echo $this->webroot; ?>shop/ajaxremovefromcart',
       data: data,
       method: 'post',
       success: function(response){
           if(response == 'removed'){
               
            $('#btn'+service_id).html('BOOK NOW');
            $('#btn'+service_id).attr('data-action', 'add');
            $('#btn'+service_id).removeClass('rmove_cart');
               
                    $.ajax({
                    url: '<?php echo $this->webroot; ?>shop/getCartitems',
                    method: 'post',
                    dataType: 'json',
                    success: function(json){
                        if(json.length == '0'){
                            $('#cart-tble tbody').html('');

                            //$('.cart-modal .total_book ul').html('');
							
							$('.cart-modal .total-conf tr').html('');
                        }else{

                            var html = '';
                            var total = '';

                            $.each(json.OrderItem, function(key,val) {    

                                html += '<tr>';
                                html += '<td class="venue_left"><p>'+val.category+'</p></td>';
                                html += '<td class="venue_left"><p>'+val.service+'</p></td>';

                                html += '<td class="venue_left">';
                                html += '<div class="time_sumry">';
                                html += '<ul>';
                                html += '<li><i class="fa fa-clock-o" aria-hidden="true"></i></li>';
                                html += '<li class="space_left">'+val.time+'</li>';
                                html += '</ul>';
                                html += '</div>';
                                html += '</td>';

                                html += '<td class="venue_left"><p>'+val.price+'</p></td>';
                                html += '<td class="venue_left"><i class="fa fa-window-close-o rem-cart" aria-hidden="true" data-id="'+val.service_id+'"></i></td>';
                                html += '</tr>';

                                //console.log(val);      
                            });

                            $('#cart-tble tbody').html(html);
                            
                            $('.cart-modal .alert').css('display', 'block');
                            //$(".cart-modal .alert").delay(2000).fadeOut('slow');//

                            /*total += '<li> <i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</li>';
                            total += '<li>'+ json.Price +'</li>';*/
							
							total +='<td width="56%" float="left"><span class="lft_ttl">Total</span></td>';
                            total +='<td style="border-left:none;float: left;width: 50%;"><i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</td>';
        					total +='<td style="border-left:none;width: 28%;"><i class="fa fa-gbp" aria-hidden="true"></i>' +json.Price +'</td>';

                            //$('.cart-modal .total_book ul').html(total);
							
							$('.cart-modal .total-conf tr').html(total);
                            
                            $('.cart_time_service h4').html('Service time: <span>'+json.Time+'</span> minutes');
                            
//                            $('#btn'+service_id).html('BOOK NOW');
//                            $('#btn'+service_id).attr('data-action', 'add');
//                            $('#btn'+service_id).removeClass('rmove_cart');
                            
                        }
                    }
                 });
            }  
            $("#cart-calender").trigger("change");
            updateCartCountonremove();
       }
   });    
});


    
$(document).delegate('#myModalnext .close', 'click', function(){
        location.reload();
});

function updateCartCountonremove(){
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '0'){
            $("#showcart").trigger('click');
            $('#showemptycart').trigger('click');
        }
    });
}

function updateCartCount(){
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '1'){
            showcart();
        }
    });
}

</script>

<!------side-menu--------->
<script>
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
} 

</script>

<script>
    $(document).delegate("#cart-calender", "change", function(){
    	
		
	
        var selected = $(this).val();
        var date = $(this).datepicker('getDate');
        
        $("#cart_day_this").val(date);
        
        $('.cart_time_service h5').html('Date: '+selected);
        
        var click_type = 'calender';
       
	   	//getCartSalonId();
	   
        updateCartDates(selected, date, click_type, '', '');
        
            
    });
</script> 

<script>
    $(document).delegate('.booking_tab .free_time', 'click', function(){
        var value = $(this).text();
        var minutes = $('.cart_time_service h4 span').text();
        var date = $('.cart_time_service ul').attr('data-date');

        var data = {
            from_time: value,
            minutes: minutes,
            date: date
        }
        
        $.ajax({
            url: '<?php echo $this->webroot; ?>shop/selectCartDate',
            data: data,
            method: 'post',
            dataType: 'json',
            success: function(response){
                //alert(date+', '+value+', '+response);
                //console.log(response);
                var date_time = $('#cart_day_this').val();
                
                var click_type = 'ontime';
                
                //alert(date+', '+date_time);
				
				console.log(value+', '+response);
                
                updateCartDates(date, date_time, click_type, value, response);
                
            }
        });
    });
</script> 

  

<script>
    
    function updateCartDates(selected, datess, click_type, freevalue, freeresponse){   
	
        var weekday = new Array();
        
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";
        
        
        
        var dayOfWeek = weekday[new Date(datess).getDay()];
		
		var user_id = $('#cart_salon_id').text();
        
        var data = {date: selected, user_id: user_id, day: dayOfWeek}
	
        var start_time = '';
                                    
        var end_time = '';
		
        //getOrderBookings(selected);
		
        if(user_id != ''){

            $.ajax({
               url: <?php echo $this->webroot; ?>+'salon/ajaxavailable',
               data: data,
               method: 'post',
               success:function(response){
			   console.log(response);
                   $('.cart_time_service ul').html(response);
                   $('.cart_time_service ul').attr('data-date', selected);
                   //$('.cart_time_service ul li').addClass('free_time');

                   
							
                            if(click_type == 'ontime'){
                                if(freeresponse.length != '0'){
                                    var error = '0';
                                    for(var i=0; i < freeresponse.length; i++){
                                        if($( ".cart_time_service ul li:contains('"+ freeresponse[i] +"')" ).hasClass("free_time")){
                                            $( ".cart_time_service ul li.free_time:contains('"+ freeresponse[i] +"')" ).css( "background", "#ef3b85" );
                                            $('.cart_proceed').css('display', 'block');
                                            
                                            
                                            
                                            if(i == '0'){
                                                start_time = freeresponse[i];
                                            }
                                            
                                            if(i == freeresponse.length - 1){
                                                end_time = freeresponse[i];
                                            }
                                            
                                        }else{       
                                            error = '1';
                                        }
                                    }
                                    
									console.log(start_time+', '+end_time);
									
                                    if(start_time != '' || end_time != ''){
                                        
                                        $(document).delegate('.cart_proceed', 'click', function(event){
                                            event.preventDefault();
                                            /*alert(start_time+', '+end_time+', '+selected);
											return false;*/
                                            updateDateTimeInCart(start_time, end_time, selected);
                                            
                                        });
                                        
                                    }
                                    
                                    if(error == '1'){
                                        alert('We have found some busy time between your selected time. So you cannot select this time!!!');
                                        $("#cart-calender").trigger("change");
                                        $('.cart_proceed').css('display', 'none');
                                    }                               
                                }
                            }
                }
            });
        }
    }
</script>

<script>

function getOrderBookings(date){
	var user_id = $('#cart_salon_id').text();
	$.ajax({
		url: '<?php echo $this->webroot ?>shop/ajaxGetOrderBookings',
		data: {date: date, salon_id: user_id},
		method: 'post',
		success: function(response){
		console.log(response);
			if(response != ''){
			
				response = JSON.parse(response);
			
				for(var i=0; i<response.length; i++){
					$( ".cart_time_service ul li:contains('"+ response[i].Order.start_time +"')" ).css( "background", "#808080" ).removeClass('free_time');
					$( ".cart_time_service ul li:contains('"+ response[i].Order.start_time +"')" ).nextUntil( ".cart_time_service ul li:contains('"+ response[i].Order.end_time +"')" ).css( "background", "#808080" ).removeClass('free_time');;
					$( ".cart_time_service ul li:contains('"+ response[i].Order.end_time +"')" ).css( "background", "#808080" ).removeClass('free_time');
				}
			}
		}
	});
}

</script>

<script>
    function updateDateTimeInCart(start_time, end_time, date){
        
        var data = {
            start_time: start_time,
            end_time: end_time,
            date: date
        }
		
        $.ajax({
           url: '<?php echo $this->webroot ?>shop/addDateTimeInCart',
           data: data,
           method: 'post',
           success: function(response){
               window.location.href = '<?php echo $this->webroot ?>shop/checkout';
           }
        });
    }
</script> 

<style>
tabel.tbl tr td:nth-child(1) { width:60%;}
</style>
<script>

$(document).delegate('#news-btn', 'click', function(e){		
	var email = $("#news-input").val();
	var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	if(!email_regex.test(email)){
			alert('Please Enter valid Email Address');
	}else{
		$.ajax({
			url: '<?php echo $this->webroot ?>shop/newsletter_email',
			method: 'post',
			data: {email: email},
			success: function(response){
				$('.news_letter .alert').html(response);
				$('.news_letter .alert').css('display', 'block');
				$("#news-input").val('');
			}
		});
	}
});
</script>