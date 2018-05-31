<?php //echo "<pre>"; print_r($order); echo "</pre>"; ?>

<style>
.star-reviw .fa.checked{color:red;}
</style>

<div class="smart_container">
  <div class="container">
    <div class="row">
      <div class="globel_headding ing_padding">
        <div class="title_text">Booking Details</div>
      </div>
      <div class="col-sm-12">
        <div class="ordrdtls">
          <div class="col-sm-12">
            <h2> Booking Details</h2>
          </div>
          <div class="col-sm-6" style="padding-right:0;">
            <table class="bookgtbl table zero_mgn" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td>Booking ID</td>
                  <td><?php echo $order['Order']['id']; ?></td>
                </tr>
                <tr>
                  <td>Venue</td>
                  <td><?php echo ucwords($order['Salon']['store_name']); ?></td>
                </tr>
                <tr>
                  <td>Booking Date/Time</td>
                  <td>
                  <?php
                  $date = date('d M, Y', strtotime($order['Order']['created']));
                  $time = date('h:i a', strtotime($order['Order']['created']));
                  echo $date. ' ' .$time;
                  ?>
                  </td>
                </tr>
                <tr>
                  <td>Service Date/Time</td>
                  <td><?php
                  	$booking_date = date('d M, Y', strtotime($order['Order']['booking_date']));
                  	echo $booking_date.' '.$order['Order']['start_time'].' to '.$order['Order']['end_time']; ?></td>
                </tr>
                <tr>
                  <td>Amount Paid</td>
                  <td>&#163;<?php echo $order['Order']['paypal_price']; ?></td>
                </tr>
                <tr>
                  <td>Pending Amount</td>
                  <td>&#163;<?php echo $order['Order']['pending_price']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-6" style="padding-left:0;">
           <div class="left_wrds">
            <div class="details">
            
            <?php if($loggeduser == $order['Order']['uid']){ ?>
            <h2><?php echo ucwords($order['User']['store_name']); ?></h2>
              <div class="phn"><span>Mobile: </span><?php echo $order['Order']['phone']; ?></div>
              <div class="adress"><span>Address: </span><div class="com_gmail"> <?php echo $order['User']['address']; ?></div></div>
              </div>
            <?php }else{ ?>
            
              <h2><?php echo ucwords($order['Order']['first_name'].' '.$order['Order']['last_name']); ?></h2>
              <div class="phn"><span>Mobile: </span><?php echo $order['Order']['phone']; ?></div>
              <div class="adress"><span>Email: </span><div class="com_gmail"> <?php echo $order['Order']['email']; ?></div></div>
              </div>
              <?php } ?>
              <!--<div class=""><span>Address:</span> xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx<br>
                xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>-->
            </div>
          </div>
          <div class="col-sm-12">
            <div class="order_tblsec table-responsive">
              <h2>Booking Items</h2>
              <table class="table orditms" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                  	<th class="cat_price">Category</th>
                    <th class="cat_price">Service Name</th>
                    <th class="cat_price">Price</th>
                  </tr>
                  <?php foreach($order['OrderItem'] as $orders){ ?>
                  <tr>
                  	<td><?php echo $orders['category']; ?></td>
                    <td><?php echo $orders['name']; ?></td>
                    <td>&#163;<?php echo $orders['price']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php if($order['Order']['service_status'] == 'completed'){ ?>
            <?php if(empty($reviews)){ ?>
            <?php if($loggeduser == $order['Order']['uid']){ ?>
            <button type="button" class="btn btn-default fltr_colr" data-toggle="modal" data-target="#reviewModal">Rate/Review</button>
            
            
            <?php } ?>
            
            <!-- Modal -->
            <div id="reviewModal" class="modal fade" role="dialog">
                <div class="modal-dialog small_wdth">
                
                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        	<h4 class="modal-title cntr_give">Give Your Rating</h4>
                        </div>	
                        <div class="modal-body" style="min-height:100px;">
                            <div class="alert alert-success" style="display:none;">
                            	<strong>Review has been submitted successfully !!</strong>
                            </div>
                            <div class="review_sec">
                                <div class="star-reviw" style="width: auto; float: none; margin: 0 auto; display: table;">
                                    <div class="stars rating" id="rating" style="padding:4px 0;"> 
                                        <span class="fa fa-star"></span> 
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <input type="hidden" name="rating" id="ratings1">  
                                    </div>   
                                </div>
                                <button type="button" id="sbt-rev" class="btn btn-default fltr_colr">Submit</button>
                                
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
            
            
            <?php }else{ ?>
            <button type="button" class="btn btn-default fltr_colr" onclick="already()">Give Your Rating</button>
            <?php } ?>
            
            <?php } ?>

            <?php
//            if($loggeduser == $order['Order']['uid']){
//            $current_date = date('d-m-Y');
//            $booking_date = $order['Order']['booking_date'];
//            
//            $current_datetime = time();
//            $booking_date = strtotime($order['Order']['booking_date']);
//            
//            if($current_date != $booking_date && $current_datetime < $booking_date){ ?>
            <?php //echo $this->Form->postLink('Cancel Booking', array('action' => 'cancelOrder', $order["Order"]["id"]), array('class' => 'btn defult_btn btn_chdpwd'), __('Are you sure you want to cancel this order?', $order["Order"]["id"])); ?>
            <?php //} ?>
            
            <?php //} ?>
            
            <?php
            if($loggeduser == $order['Order']['uid']){
                $current_date = time();
                
                $booking_date = date('Y-m-d', strtotime($order['Order']['booking_date']));
                $booking_time = date('H:i:s', strtotime($order['Order']['start_time']));
                
                
                $final_booking_time = date(strtotime($order['Order']['booking_date'].' '.$order['Order']['start_time']));
                //round(abs($current_date - $final_booking_time) / 60,2). " minute"; echo '<br>';
                
                $minutes = round(abs($current_date - $final_booking_time) / 60,2);
                $hours = ($minutes) / 60; //echo ' Hours Left<br>';
                
                if($hours > 24 && $current_date < $final_booking_time){
                    if($order['Order']['service_status'] != 'cancelled'){
                        echo $this->Form->postLink('Cancel Booking', array('action' => 'cancelOrder', $order["Order"]["id"]), array('class' => 'btn defult_btn btn_chdpwd'), __('Are you sure you want to cancel this order?', $order["Order"]["id"]));
                    }elseif($order['Order']['service_status'] == 'cancelled'){
                        echo '<div class="alert alert-success">This Booking has been cancelled.</div>';
                    }
                }elseif($order['Order']['service_status'] == 'cancelled'){
                    echo '<div class="alert alert-success">This Booking has been cancelled.</div>';
                }else{
                    echo '<div class="alert alert-warning">You cannot cancel this Booking as cancellation period has expired.</div>';
                }
                
            ?>
            <?php } ?>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('.rating span').each(function(){
	$(this).click(function(){
		if(!$(this).hasClass('checked')){
			$(this).addClass('checked');
			$(this).prevAll().addClass('checked');
			var rate = $('#rating .checked').length;
		}else{
			$(this).nextAll().removeClass('checked');
			var rate = $('#rating .checked').length;
		}

		$('#ratings1').val(rate);
	   
	});
});

$(document).delegate('#sbt-rev', 'click', function(){
	var rating = $("#ratings1").val();
	var salon_id = '<?php echo $order["Order"]["salon_id"] ?>';
	var order_id = '<?php echo $order["Order"]["id"] ?>';
	
	
	if(rating == 0){
		alert("Please give star rating");
	}else{
		$.ajax({
			url: '<?php echo $this->webroot ?>reviews/addReview',
			data: {rating: rating, salon_id: salon_id, order_id: order_id},
			method: 'post',
			success: function(response){
				if(response == 'success'){
					$('#reviewModal .alert').css('display', 'block');
					$('#reviewModal .review_sec').css('display', 'none');
					
					$(document).click(function(){
						location.reload();
					});
				}
			}
		});
	}
});

function already(){
	alert('You have already submitted review.');
}

</script>