<style>
	table{
		width:100%;
		margin:0px;
	}
	table img{
		width:100%;
	}
</style>
<?php //echo "<pre>"; print_r($orderitem); echo "</pre>"; ?>
<section class="content-header marginbtm">
      <h1>
       Service Detail
      </h1>
    </section>
    <div class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="form_outer box">
			<table class="table-striped table-bordered table-condensed table-hover">
				<tbody>
					<tr>
						<td>ID</td>
						<td><?php echo $orderitem['OrderItem']['id'];?></td>
					</tr>
					<tr>
						<td>Booking ID</td>
						<td><a href="<?php echo $this->webroot."admin/orders/view".$orderitem['OrderItem']['order_id'];?>"><?php echo $orderitem['OrderItem']['order_id'];?></a></td>
					</tr>
					<tr>
						<td>Service ID</td>
						<td><?php echo $orderitem['OrderItem']['service_id'];?></td>
					</tr>
					<tr>
						<td>Service Name</td>
						<td><?php echo $orderitem['OrderItem']['name'];?></td>
					</tr>
					<tr>
						<td>Category Name</td>
						<td><?php echo $orderitem['OrderItem']['category'];?></td>
					</tr>
					<tr>
						<td>Duration (in minutes)</td>
						<td><?php echo $orderitem['OrderItem']['time'];?></td>
					</tr>
					<tr>
						<td>Total Price</td>
						<td>&#163;<?php echo $orderitem['OrderItem']['price'];?></td>
					</tr>
                    <tr>
						<td>Booking Date</td>
						<td><?php echo $orderitem['Order']['booking_date'];?></td>
					</tr>
                    <tr>
						<td>Start time</td>
						<td><?php echo $orderitem['Order']['start_time'];?></td>
					</tr>
                    <tr>
						<td>Finish time</td>
						<td><?php echo $orderitem['Order']['end_time'];?></td>
					</tr>
					<tr>
						<td>Store Name</td>
						<td><?php echo $orderitem['Order']['Salon']['store_name'];?></td>
					</tr>
                    <tr>
						<td>Store Address</td>
						<td><?php echo $orderitem['Order']['Salon']['address'];?></td>
					</tr>
					<tr>
						<td>Created</td>
						<td><?php echo $orderitem['OrderItem']['created'];?></td>
					</tr>
					<tr>
						<td>Modified</td>
						<td><?php echo $orderitem['OrderItem']['modified'];?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>