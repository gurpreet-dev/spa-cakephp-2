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

            <?php echo $this->fetch('title'); ?>
        </title>
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
        <?php
        echo $this->Html->meta('icon');

//		echo $this->Html->css('cake.generic');
        echo $this->Html->css(array('saloon-style', 'bootstrap.min', 'DateTimePicker'));
        echo $this->Html->script(array('npm', 'bootstrap.min', 'DateTimePicker', 'oauthpopup', 'slick', 'progress', 'addtocart'));
        echo $this->fetch('meta');
        echo $this->App->js();
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div class="right_box_fixed">
            <a href="javascript:void(0)" id="right_box_fixed">
                <h4><?php echo $item_count ? $item_count : '0'; ?></h4>
                <i class="fa fa-ticket" aria-hidden="true"></i>
            </a>
            
        </div>
        <a href="#" data-toggle="modal" data-target="#myModalnext" id="showcart" style="display:none;"></a>
        
        
        <!----modal---->
        <div class="modal fade" id="myModalnext" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
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
                                                    <tr>
                                                        <td class="venue_left">
                                                            <div class="summary_logo">
                                                                <img src="images/list_logo.png">
                                                                <ul>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li> 
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td class="venue_left"><p>ROB ROY<br>ABC/XYZ BLOCK D,<br>Madhyam Gram, Kolkata<br>West Bengal - 700132</p></td>
                                                        <td class="venue_left"><p>XY Haircutting Salon For Boy and Girl</p></td>
                                                        <td class="venue_left">
                                                            <div class="time_sumry">
                                                                <ul>
                                                                    <li><i class="fa fa-clock-o" aria-hidden="true"></i></li>
                                                                    <li class="space_left">1 hr 40 mins</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td class="venue_left"><p>$43</p></td>
                                                        
                                                        <td class="venue_left"><i class="fa fa-window-close-o" aria-hidden="true"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="total_book">
                                            <h4>Total</h4>
                                            <ul>
                                                <li> <i class="fa fa-clock-o" aria-hidden="true"></i> 1 hr 40 mins</li>
                                                <li>$43</li>
                                            </ul>
                                        </div>
                                        <button type="button" class="btn btn-default default_gren">PROCEED</button>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="schedule">
                                        <div class="calendr_cover">
                                            <div class="col-sm-6">
                                                <div class="calender_service" id="cart-calender">


                                                </div><!--check-service-->
                                            </div><!--col-6-->


                                            <div class="col-sm-6">
                                                <div class="time_service">
                                                    <h4>Service Time 30 Minutes</h4>
                                                    <ul>
                                                    </ul>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-default default_gren">PROCEED</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----modal-end---->
        
        
        
        
        
        <!-- Modal -login-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content full_page">
                    <div class="modal-header brdr_none">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login to your Account</h4>
                        <div class="alert alert-danger log-danger" style="display:none">
                            <strong>Danger!</strong> Please fill all the fields.
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-6">
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
                                <h2>New to Logo?<a data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#myModals">SIGN UP</a></h2>
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
                                <h3>Manage Your Booking</h3>
                                <p>Confirm bookings in one click</p>
                            </div>
                        </div>

                        <div class="right_login">
                            <div class="login_image">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            </div>
                            <div class="login_text">
                                <h3>Manage Your Booking</h3>
                                <p>Confirm bookings in one click</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------modal-------------------->
        
        
        <!--sign-up-modal-->
        <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content full_page">
                    <div class="modal-header brdr_none">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">SIGN UP</h4>
                        <p> Please enter details to create your account</p>
                        
                        
                        <div class="alert alert-success reg-success" style="display:none">
                            <strong>Success!</strong> Registration successfully.
                        </div>
                        
                        <div class="alert alert-danger reg-danger" style="display:none">
                            <strong>Danger!</strong> Please fill all the fields.
                        </div>
                        
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-6">
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
                            
                                <label class="checkbox-inline">
                                    <input type="radio" name="role" value="freelancer" id="role">
                                    <span class="green_colr">As Freelancer</span>
                                </label>
                                    <label class="checkbox-inline">
                                    <input type="radio" name="role" value="customer" id="role"> <span class="green_colr"> As Customer</span>
                                </label>
                            
                            
                                <div class="butn_login">
                                    <ul>
                                        <li><input type="submit" name="submit" id="reg-submit" value="Sign up"></li>
                                        <li><a href="<?php echo $this->webroot?>users/forgetpwd" class="background_none">Forgot Password?</a></li>
                                    </ul>
                                </div>

                            </form>
                            <div class="new_logo">
                                <h2>Already Registered?<a  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#myModal" >LOGIN</a></h2>
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
                                <h3>Manage Your Booking</h3>
                                <p>Confirm bookings in one click</p>
                            </div>
                        </div>

                        <div class="right_login">
                            <div class="login_image">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            </div>
                            <div class="login_text">
                                <h3>Manage Your Booking</h3>
                                <p>Confirm bookings in one click</p>
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
                        <div class="col-sm-6">
                            <div class="logo_left"><a href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>images/logo.png" alt="image not found"></a></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="list_business">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li class="left_border"><a href="#">List your business</a></li>
                                    <?php if(!$loggeduser){ ?>
                                    <li><a href="" data-toggle="modal" data-target="#myModal">Login</a></li>
                                    <?php } else { ?>
                                    <li><a href="<?php echo $this->webroot; ?>users/edit">My account</a></li>
                                    <li><a href="<?php echo $this->webroot; ?>users/logout">Logout</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="menu">
                                <ul>
                                    <li class="rigth_brdr"><a href="#">Hair Removal</a></li>
                                    <li><a href="#">Massage</a></li>
                                    <li><a href="#">Face</a></li>
                                    <li><a href="#">Body</a></li>
                                </ul>
                            </div>
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
                        <h3 class="treatment_right">Enticing treatment in LOGO<br> with highly trained experts</h3>
                        <h2>Book your wellness appointment with the click of a button</h2>
                        <form action="<?php echo $this->webroot; ?>salon/search" method="post">
                        <ul>
                            <li class="input1">
                                <div class="search_outer">
                                    <i class="fa fa-search icon_left"></i>
                                    <input class="padding_right" name="category" type="text" placeholder="Start Typing Services...." id="search-cat" autocomplete="off">
                                    <input class="padding_right" name="category" type="hidden" placeholder="Start Typing Services...." id="search-cat2">
                                    <div class="cat-results"></div>
                                    <i class="fa fa-times icon_right" aria-hidden="true"></i>

                                </div>
                            </li>
                            <li class="input2">
                                <div class="search_outer"><i class="fa fa-map-marker icon_left" aria-hidden="true"></i>
                                    <input name="location" type="text" placeholder="Enter postcode or current location" id="search-location" autocomplete="off">
                                    <div class="loc-results"></div>
                                </div>
                            </li>
                            <li class="input1"><input name="date" type="text" placeholder="Select Date and Time" id="" autocomplete="off"  data-field="datetime"><div class="search_outer" id="search-name"></div></li>
                            <li><input name="" type="submit" value="search" id="search-search"></li>
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
            <div class="container">
                <div class="row">
                    <div class="main_footer">
                        <div class="col-sm-3">
                            <div class="heading_contact">
                                <h4>Contact</h4>
                            </div>
                            <div class="contact_info">
                                <ul>
                                    <li><h4>Address</h4><div class="contact_right">121 King Street,Melbourne Victoria 3000</div></li>
                                    <li><h4>Address</h4><div class="contact_right">121 King Street,Melbourne Victoria 3000</div></li>
                                    <li><h4>Address</h4><div class="contact_right">121 King Street,Melbourne Victoria 3000</div></li>
                                    <li class="lower_none"><h4>Address</h4><div class="contact_right">121 King Street,Melbourne Victoria 3000</div></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="service_salon">
                                <h4>Services</h4>
                                <ul>
                                    <li>Saloons</li>
                                    <li>Giftcards</li>
                                    <li>Terms $ Conditions</li>
                                    <li>Work With US</li>
                                    <li>Contact Us</li>
                                    <li>Delivery Information</li>
                                    <li>Return Policy</li>
                                    <li>Privacy &amp; Security</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="folow_section">
                                <h4>Follow Us</h4>
                                <ul>
                                    <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-instagram" aria-hidden="true"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="news_letter">
                                <h4>Newsletter Signup</h4>
                                <p>Enter your email address to subscribeand receive notifications of new posts by email.</p>
                                <a>FIND MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lower-footer">
            <div class="container">
                <h4>Copyright @ 2017<span> ALL RIGHT RESERVED</span></h4>
            </div>
        </div>
        <!-- Footer section (END) -->
        
        <?php
        echo $current_date = date("d-m-Y");
    
        echo $current_day = date('l', strtotime($current_date));
        ?>
        
        
        
    </body>
</html> 
<script>
$(document).delegate("#reg-submit", "click", function(){
   var fname = $('#signupform #first_name').val();
   var lname = $('#signupform #last_name').val();
   var email = $('#signupform #email').val();
   var pass = $('#signupform #pass').val();
   var cpass = $('#signupform #cpass').val();
   var role = $("#signupform #role:checked").val();
   
   var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;   
   
   var data = {
       first_name: fname,
       last_name: lname,
       email: email,
       pass: cpass,
       role: role
   }
   
   //alert(fname+', '+lname+', '+email+', '+pass+', '+cpass+', '+role);
   //return false;
   if(fname == '' || lname == '' || email == '' || pass == '' || cpass == '' || !$("#signupform #role:checked").val()){
       $(".reg-danger").html('<strong>Danger!</strong> Please fill all the fields.');
       $(".reg-danger").css('display', 'block');
   }else if(pass != cpass){
       $(".reg-danger").html('<strong>Danger!</strong> Password and confirm password do not match.');
       $(".reg-danger").css('display', 'block');
   }else if(!email_regex.test(email)){
       $(".reg-danger").html('<strong>Danger!</strong> Please enter valid email address.');
       $(".reg-danger").css('display', 'block');
    }else{
       $.ajax({
          url: '<?php echo $this->webroot; ?>users/ajaxsignup',
          method: 'post',
          data: data,
          success: function(response){
              if(response == 'success'){
                    $(".reg-danger").css('display', 'none');
                    $(".reg-success").css('display', 'block');
                    
                    $('#signupform #first_name').val('');
                    $('#signupform #last_name').val('');
                    $('#signupform #email').val('');
                    $('#signupform #pass').val('');
                    $('#signupform #cpass').val('');
                    $("#signupform #role:checked").val('');
                    
              }else if(response == 'error'){
                  $(".reg-success").css('display', 'none');
                    $(".reg-danger").html('<strong>Danger!</strong> Registration unsuccessful.');
                    $(".reg-danger").css('display', 'block');
              }else if(response == 'exist'){
                  $(".reg-success").css('display', 'none');
                    $(".reg-danger").html('<strong>Danger!</strong> Email already exists.');
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
   
   if(email == '' || password == ''){
       $(".log-danger").html("<strong>Danger!</strong> Please fill all the fields.")
       $(".log-danger").css('display', 'block');
   }else{
       $.ajax({
          url: '<?php echo $this->webroot; ?>users/ajaxlogin',
          method: 'post',
          data: data,
          success: function(response){
              if(response == 'success'){
                    $(".log-danger").css('display', 'none');
                    window.location.href = "<?php echo $this->webroot; ?>";
                    
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

    $.ajax({
       url: '<?php echo $this->webroot ?>salon/ajaxgetCategories',
       data: data,
       method: 'post',
       dataType: 'json',
       success: function(json){


            console.log(json);
            var html = '<ul>';
            for(var i = 0; i < json.length; i++){
                html +='<li class="search-cat-res" data-id="'+json[i]['Category']['id']+'">'+json[i]['Category']['name']+'</li><br>';
            }
            html += '</ul>';
            $(".cat-results").html(html);
        }
    });
    if( value.length === 0 ) {
        $(".cat-results").html('');
    }
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
            var html = '<ul>';
            for(var i = 0; i < json.length; i++){
                html +='<li class="search-loc-res" data-id="'+json[i]['User']['id']+'">'+json[i]['User']['location']+'</li><br>';
            }
            html += '</ul>';
            $(".loc-results").html(html);
        }
    });

    if(value == ''){
        $(".loc-results").html('');
    }

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
   
   if(cat == '' || loc == '' || date == ''){
       alert('Please fill all the fields');
       return false;
   }   
});


$( "#cart-calender" ).datepicker({ minDate: new Date(), dateFormat: 'dd-mm-yy'});

$(document).delegate('#right_box_fixed','click', function(){
    showcart();
});

function showcart(){
    //alert('hello');
    $.ajax({
       url: '<?php echo $this->webroot; ?>shop/getCartitems',
       method: 'post',
       dataType: 'json',
       success: function(json){
           console.log(json);    
           //return false;
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
        
        total += '<li> <i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</li>';
        total += '<li>'+ json.Price +'</li>';
        
        $('.cart-modal .total_book ul').html(total);
        
        
        var data = {
            date: '<?php echo $current_date ?>',
            day: '<?php echo $current_date ?>',
            user_id: json.User
        }
        
        
        $.ajax({
            url: '<?php echo $this->webroot; ?>salon/ajaxavailable',
            data: data,
            method: 'post',
            success: function(response){
                console.log(response)
                
            }
        });
        
        
        
        
        $("#showcart").trigger('click');
       }
    });
    
    
    //$("#showcart").trigger('click'); 
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
            
                    $.ajax({
                    url: '<?php echo $this->webroot; ?>shop/getCartitems',
                    method: 'post',
                    dataType: 'json',
                    success: function(json){
                        console.log(json);    
                        //return false;
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

                     total += '<li> <i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</li>';
                     total += '<li>'+ json.Price +'</li>';

                     $('.cart-modal .total_book ul').html(total);

                    }
                 });

            }  
            updateCartCount();
       }
   });    
});


    
$(document).delegate('#myModalnext .close', 'click', function(){
        location.reload();
});

function updateCartCount(){
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '1'){
            showcart();
        }
    });
}

</script>