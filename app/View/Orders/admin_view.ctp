<?php //echo "<pre>"; print_r($order); echo "</pre>"; ?>
<style>
	.form_outer{
		margin-bottom:20px;
	}
	.form_outer.no-margin{
		margin:0px;
	}
	table{
		width:100%;
		margin:0px;
	}
</style>
<section class="content-header marginbtm">
      <h1>
       Booking Details
      </h1>
    </section>
<section class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="box">
			<table class="table table-bordered table-hover">
				<tr>
					<td>Id</td>
					<td><?php echo h($order['Order']['id']); ?></td>
				</tr>
                <tr>
					<td>User ID</td>
					<td><?php
                    if($order['Order']['uid'] != '0'){
                    echo h($order['Order']['uid']);
                    }else{ 
                    echo 'Guest';
                    } ?></td>
				</tr>
				<tr>
					<td>First Name</td>
					<td><?php echo h($order['Order']['first_name']); ?></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><?php echo h($order['Order']['last_name']); ?></td>
				</tr>
				<tr>
					<td>Customer Email</td>
					<td><?php echo h($order['Order']['email']); ?></td>
				</tr>
                                <tr>
					<td>Customer Paypal Email</td>
					<td><?php
                                        if($order['Order']['uid'] != 0){
                                            echo h($order['User']['paypl_email']);
                                        }else{
                                            echo h($order['Order']['paypal_email']);
                                        }?></td>
				</tr>
                <tr>
					<td>Customer Phone</td>
					<td><?php echo h($order['Order']['phone']); ?></td>
				</tr>
                <tr>
					<td>Customer Profile Pic</td>
					<td>
                        <?php if($order['User']['image']){ echo $this->Html->Image('/images/spa/users/' . h($order['User']['image']), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                        
                        }else{
                        echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                        } ?>
                </td>
				</tr>
                <tr>
					<td>Store ID</td>
					<td><?php echo h($order['Order']['salon_id']); ?></td>
				</tr>
				<tr>
					<td>Store Name</td>
					<td><?php echo h($order['Salon']['store_name']); ?></td>
				</tr>
			 	<tr>
					<td>Store Address</td>
					<td><?php echo h($order['Salon']['address']); ?></td>
				</tr>
				<tr>
					<td>Category</td>
					<td><?php echo h($order['OrderItem'][0]['category']); ?></td>
				</tr>
				
				<tr>
					<td>No. of Services</td>
					<td><?php echo h($order['Order']['order_item_count']); ?></td>
				</tr>
				
				
				<tr>
					<td>Service Count</td>
					<td><?php echo h($order['Order']['order_item_count']); ?></td>
				</tr>
                <tr>
					<td>Booking Date</td>
					<td><?php echo h($order['Order']['booking_date']); ?></td>
				</tr>
				<tr>
					<td>Start Time</td>
					<td><?php echo h($order['Order']['start_time']); ?></td>
				</tr>
				<tr>
					<td>End Time</td>
					<td><?php echo h($order['Order']['end_time']); ?></td>
				</tr>
                <tr>
					<td>Total Price</td>
					<td>&#163;<?php echo h($order['Order']['total']); ?></td>
				</tr>
				<tr>
					<td>Advance Paid</td>
					<td>&#163;<?php echo h($order['Order']['paypal_price']); ?></td>
				</tr>
				<tr>
					<td>Pending Price</td>
					<td>&#163;<?php echo h($order['Order']['pending_price']); ?></td>
				</tr>
				<tr>
					<td>Created</td>
					<td><?php echo h($order['Order']['created']); ?></td>
				</tr>
                <tr>
					<td>Service Status</td>
					<td><?php echo h($order['Order']['service_status']); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</section>
<section class="content-header marginbtm">
      <h1>
       Services
      </h1>
    </section>

<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box">
		<div class="form_outer no-margin">
			<?php if (!empty($order['OrderItem'])): ?>
			<table class="table-striped table-bordered table-condensed table-hover">
				<tr>
					<th>Id</th>
					<th>Order ID</th>
					<th>Service ID</th>
					<th>Service Name</th>
					<th>Category Name</th>
					<th>Duration (in minutes)</th>
					<th>Total Price</th>
					<th>Actions</th>
				</tr>
				<?php foreach ($order['OrderItem'] as $orderItem): ?>
				<tr>
					<td><?php echo $orderItem['id']; ?></td>
					<td><?php echo $orderItem['order_id']; ?></td>
					<td><?php echo $orderItem['service_id']; ?></td>
					<td><?php echo $orderItem['name']; ?></td>
					<td><?php echo $orderItem['category']; ?></td>
					<td><?php echo $orderItem['time']; ?></td>
					<td>&#163;<?php echo $orderItem['price']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link('View', array('controller' => 'order_items', 'action' => 'view', $orderItem['id']), array('class' => 'view1 btn btn-primary')); ?>
						<?php //echo $this->Html->link('Edit', array('controller' => 'order_items', 'action' => 'edit', $orderItem['id']), array('class' => 'view1 btn btn-primary')); ?>
						<?php //echo $this->Form->postLink('Delete', array('controller' => 'order_items', 'action' => 'delete', $orderItem['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $orderItem['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
	</div>
		</div>
</div>
</section>