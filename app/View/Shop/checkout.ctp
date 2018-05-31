<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog guest_width" role="document">
    <div class="modal-content full_page">
      <div class="modal-header brdr_none padding_zero">
        <button type="button" class="close close_icn top_last" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="guest_popup1 margin_zero">
          <h4>Continue as a Guest</h4>
        </div>
        <h4 class="enter_detail gap_detail">Enter Your Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-sm-12">
          <form>
            <div class="guest_form">
              <div class="form-group">
                <input type="text" class="form-control radius_none" id="guest_first_name" placeholder="First Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control radius_none" id="guest_last_name" placeholder="Last Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control radius_none" id="guest_email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="number" class="form-control radius_none" id="guest_number" placeholder="Number">
              </div>
              <!--guest_form-->
              <button type="button" class="btn btn-default default_gren right_btn guest_submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
//echo "<pre>"; print_r($shop); echo "</pre>";
//echo "<pre>"; print_r($salon); echo "</pre>";
?>


<div class="payment_section">
  <div class="container">
    <div class="row">
      <div class="table_heading">
        <h2>Payment</h2>
      </div>
      <div class="col-sm-6">
        <div class="payment_cover">

          <?php if(!$loggeduser){ ?>
          <div class="create_payment">
            <h4>You want to Book as a Guest<br>
              OR<br>
              Create a Login</h4>
            <div class="btn_ment">
              <button type="button" class="btn btn-default default_gren btn_flip" data-toggle="modal" data-target="#myModal">LOGIN</button>
              <button type="button" class="btn btn-default default_explore btn_flop" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#myModal2">GUEST</button>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($shop['Guest']['first_name']) || $loggeduser){ ?>
          <div class="method_pay">
            <h4>Select the Payment Method</h4>
            <span>You will now need to pay a £5 deposit to guarantee the appointment and the rest will need to be paid directly to the therapist on completion of your treatment.</span>
            <br />
            <hr />
            <input type="checkbox" name="t_a_c" id="t_a_c" />I accept the <a href="<?php echo $this->webroot; ?>staticpage/53">terms and conditions</a>.
            <div class="pay_pal">
              <a href="<?php echo $this->webroot ?>shop/payment" class="btn btn-default default_gren" id="pp_check">PAYPAL</a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="payment_book">
          <h4>Booking Summary</h4>
          <div class="booking_content">
            <div class="col-md-6">
              <div class="booking_details border_right"> <i class="fa fa-2x fa-home icn_set"></i> <?php echo ucwords($salon['User']['store_name']); ?> </div>
            </div>
            <div class="col-md-6">
              <div class="booking_details"> <i class="fa fa-2x fa-clock-o icn_set"></i> <?php echo $shop['Start_time']; ?> </div>
            </div>
            <div class="col-md-6">
              <div class="booking_details border_right border_top"> <i class="fa fa-2x fa-calendar icn_set"></i> <?php echo $shop['Booking_date']; ?> </div>
            </div>
            <div class="col-md-6">
              <div class="booking_details border_top"> <i class="fa fa-2x fa-clock-o icn_set"></i> <?php echo $shop['Time']; ?> </div>
            </div>
            <div class="col-md-12 padding_zero">
              <div class="booking_one_line">
                <ul>
                  <li><?php echo $salon['User']['address']; ?></li>
                </ul>
              </div>
            </div>
          </div>
          <!--booking_content-->
          <div class="booking_content" style="margin-top:0;">
          <?php foreach($shop['OrderItem'] as $item){ ?>
            <div class="makeup"> <span><?php echo $item['category']; ?></span> </div>
            <div class="makeup_list">
              <div class="package"><span><?php echo $item['service']; ?></span></div>
              <div class="package_time"><span><i class="fa fa-clock-o"></i><?php echo $item['time']; ?></span></div>
              <div class="package_price"><span><i class="fa fa-gbp"></i><?php echo $item['price']; ?></span></div>
              <!--<div class="women"><span>Women</span></div>-->
            </div>
            <?php } ?>
            
            <div class="makeup_list grand_total" style="padding:0; background:cornsilk;">
              <div class="package"><span>Total</span></div>
              <div class="package_time"><span><i class="fa fa-clock-o"></i><?php echo $shop['Time']; ?></span></div>
              <div class="package_price"><span><i class="fa fa-gbp"></i><?php echo $shop['Price']; ?></span></div>
            </div>
          </div>
          <!--booking_content-->
        </div>
        <!--payment_book-->
      </div>
    </div>
  </div>
</div>

<script>
$(".guest_submit").click(function(){
	var guest_first_name = $("#guest_first_name").val();
	var guest_last_name = $("#guest_last_name").val();
	var guest_email = $("#guest_email").val();
	var guest_number = $("#guest_number").val();
	
	var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;   
	
	var data = {
		first_name: guest_first_name,
		last_name: guest_last_name,
		email: guest_email,
		phone: guest_number
	}
	
	if(guest_first_name == '' || guest_last_name == '' || guest_email == '' || guest_number == ''){
		alert('Please fill all the fields');
	}else if(!email_regex.test(guest_email)){
        alert('Please Enter valid Email Address');
    }else{	
		$.ajax({
			url: '<?php echo $this->webroot ?>shop/addCartUser',
			data: data,
			method: 'post',
			success: function(response){
				location.reload();
			}
		});
	}	
});

$("#pp_check").click(function(){
	if(!$("#t_a_c").is(':checked')){
		 alert('Please check the terms and conditions');
		 return false;
	}
});
</script>