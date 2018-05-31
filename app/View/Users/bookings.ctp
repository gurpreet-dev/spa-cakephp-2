<?php //echo "<pre>"; print_r($orders); echo "</pre>"; ?>
<style>.service_status.disabled{background: #dadada !important;}</style>
<div class="available_table">
    <div class="container">
    	<?php echo $this->Session->flash('bookings'); ?>
        <div class="col-sm-12">
            <div class="table_heading">
            	<h2>Booking History</h2>
            </div>
            
            <?php if(!empty($orders)){ ?>
            <table class="table border_light">
                <thead class="thead-inverse pink_heading">
                    <tr>
                        <th>Booking ID</th>
                        <?php if($loggedUserRole == 'customer'){ ?>
                        <th>Venue</th>
                        <?php }else{ ?>
                        <th>Customer Name</th>
                        <?php } ?>
                        <th>Service Date/Time</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach($orders as $order){ ?>
                    <tr>
                        <th scope="row"><?php echo $this->Html->link($order['Order']['id'], array('action' => 'booking', $order['Order']['id'])); ?></th>
                        
                        <?php if($loggedUserRole == 'customer' || $order['Order']['salon_id'] == $order['Order']['uid'] || $order['Order']['uid'] == $loggeduser){ ?>
                        <td><?php echo ucwords($order['Salon']['store_name']); ?></td>
                        <?php } else { ?>
                        <td><?php echo ucwords($order['Order']['first_name']. ' ' .$order['Order']['last_name']); ?></td>
                        <?php } ?>
                        
                        <td><?php echo $order['Order']['booking_date']; ?> &nbsp;&nbsp; <?php echo $order['Order']['start_time']; ?> to <?php echo $order['Order']['end_time']; ?></td>
                        <td>&#163;<?php echo $order['Order']['total']; ?></td>
                        <td>
                                        
                        <?php if($loggeduser == $order['Order']['uid']){ ?>
                        <?php if($order['Order']['service_status'] == 'pending'){ ?>
                        Pending
                        <?php }elseif($order['Order']['service_status'] == 'completed'){ ?>
                        Completed
                        <?php }elseif($order['Order']['service_status'] == 'cancelled'){ ?>
                        Cancelled
                        <?php } ?>
                        <?php }else{ ?>
                        
                        <?php //if($order['Order']['cancelled_by'] == 'customer'){
                        if($order['Order']['service_status'] == 'cancelled'){
                            $disabled = ' disabled';
                        }else{
                            $disabled = '';
                        } ?>
                        
                        <select name="service_status" class="service_status<?php echo $disabled; ?>" data-id="<?php echo $order['Order']['id']; ?>"<?php echo $disabled; ?>>
                        	<?php if($order['Order']['service_status'] == 'pending'){ ?>
                            <option value="pending" selected="selected">Pending</option>
                            <?php } else { ?>
                            <option value="pending">Pending</option>
                            <?php } ?>
                            
                            <?php if($order['Order']['service_status'] == 'completed'){ ?>
                            <option value="completed" selected="selected">Completed</option>
                            <?php } else { ?>
                            <option value="completed">Completed</option>
                            <?php } ?>
                            
                            <?php
                            $current_date = time();


                            $booking_date = date('Y-m-d', strtotime($order['Order']['booking_date']));
                            $booking_time = date('H:i:s', strtotime($order['Order']['start_time']));


                            $final_booking_time = date(strtotime($order['Order']['created']));

                            //round(abs($current_date - $final_booking_time) / 60,2). " minute"; echo '<br>';

                            $minutes = round(abs($current_date - $final_booking_time) / 60,2);

                            $hours = ($minutes) / 60; //echo ' Hours Left<br>';

                            if($hours < 24){

                                ?>

                            <?php if($order['Order']['service_status'] == 'cancelled'){ ?>
                            <option value="cancelled" selected="selected">Cancelled</option>
                            <?php } else { ?>   
                            <option value="cancelled">Cancelled</option>
                            <?php } ?>

                            <?php }else{ ?>
                            <?php if($order['Order']['service_status'] == 'cancelled'){ ?>
                            <option value="cancelled" selected="selected">Cancelled</option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php echo $this->Paginator->numbers(); ?>
            <?php }else{ ?>
          <img src="<?php echo $this->webroot ?>images/spa/no-history.png" class="cntr_oop oop_bordr" />
            <?php } ?>
        </div>	
    </div>
</div>

<script>
$(document).delegate('select[name="service_status"]', 'change', function(){
	var order_id = $(this).attr('data-id');
	var value = $(this).val();
	
	
	var data = {
		order_id: order_id,
		value: value
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/updateServiceStatus',
		data: data,
		method: 'post',
		success: function(response){
		}
	});
	
});
</script>