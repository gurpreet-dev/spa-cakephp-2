<?php //echo "<pre>"; print_r($orders); echo "</pre>"; ?>
<section class="content-header marginbtm">
      <h1>
       Bookings
      </h1>
    </section>
<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box table-responsive" style="height: 540px; overflow: scroll;">
        	<div class="col-sm-6">
            	<form id="" method="post" class="pull-right set_rght" action="<?php echo $this->webroot?>admin/orders">
                    <div class="search_user">
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" name="data[Order][start_date]" id="start_date" class="form-control" placeholder="Start Date" value="<?php echo $start_date; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" name="data[Order][end_date]" id="end_date" class="form-control" placeholder="Start Date" value="<?php echo $end_date; ?>"/>
                            </div>
                        </div>
                        
                        <div class="col-md-10">
                        <div class="form-group">
                        <select name="data[Order][store]" id="store" class="form-control" required>
                            <option value="">Select Store</option>
                            <?php foreach($stores as $st){ ?>
                            <?php if($st['User']['store_name'] != '' ){ ?>
                            <?php if($store == $st['User']['id'] ){ ?>
                            <option value="<?php echo $st['User']['id']; ?>" selected="selected"><?php echo ucwords($st['User']['store_name']); ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $st['User']['id']; ?>"><?php echo ucwords($st['User']['store_name']); ?></option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        </div>
                        </div>
                        
                        <div class="col-md-2">
                        <button type="submit" class="search_button1 btn btn-primary pull-right adj_crt">Search</button>
                        </div>
                        
                    </div>
                </form>
                <label>Filter By Date</label>
            </div>
			<div class="col-sm-6">
                <div class="up-img_sec"> 
                    
                    <form id="" method="post" class="pull-right set_rght" action="<?php echo $this->webroot?>admin/orders">
                        <div class="search_user">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" name=data[Order][search] placeholder="Search By Keyword Value" value="<?php echo $keyword; ?>" required>
                                </div>
                            </div>   
                            
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="data[Order][type]" class="form-control" required>
                                    <option value="">Search by Keyword</option>
                                    <option value="id">Booking ID</option>
                                    <option value="first_name">First Name</option>
                                    <option value="email">Email</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="search_button1 btn btn-primary pull-right adj_crt">Search</button>
                                </div>
                            </div>    
                        </div>
                    </form>
                    
                </div>
                <div class="col-md-12">
                     <a href="" class="btn btn-danger pull-right gap_script">View All</a>
                </div>
            </div>
			<table class="table table-bordered table-hover">
				<tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('uid'); ?></th>
					<th><?php echo $this->Paginator->sort('first_name'); ?></th>
					<th><?php echo $this->Paginator->sort('last_name'); ?></th>
					<th><?php echo $this->Paginator->sort('email'); ?></th>
					<th class="gory_blck">Store name</th>
					<th><?php echo $this->Paginator->sort('phone'); ?></th>
                    <th><?php echo $this->Paginator->sort('total', 'Total Price'); ?></th>
                    <th><?php echo $this->Paginator->sort('paypal_price', 'Advance Paid'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('service_status'); ?></th>
                    <th><?php echo $this->Paginator->sort('refund_status'); ?></th>
					<th class="gory_blck">Actions</th>
				</tr>
				<?php //print_r($orders);exit;?>
				<?php foreach ($orders as $order): ?>
				<tr>
                    <td><?php echo h($order['Order']['id']); ?></td>
                    <td>
                    <?php
                    if($order['Order']['uid'] != '0'){
                    	echo h($order['Order']['uid']);
                    }elseif($order['Order']['uid'] == '0'){
                    	echo '<span class="label label-info">Guest</span>';
                    }
                    ?></td>
					<td><?php echo h($order['Order']['first_name']); ?></td>
					<td><?php echo h($order['Order']['last_name']); ?></td>
					<td><?php echo h($order['Order']['email']); ?></td>
					<td><?php echo h($order['Salon']['store_name']); ?></td>
					<td><?php echo h($order['Order']['phone']); ?></td>
					<td><?php echo h($order['Order']['total']); ?></td>
                    <td><?php echo h($order['Order']['paypal_price']); ?></td>
					<td><?php echo h($order['Order']['created']); ?></td>
                    <td><?php echo h($order['Order']['service_status']); ?></td>
                    
                    <?php if($order['Order']['service_status'] == 'cancelled' && $order['Order']['refund_status'] != 'completed'){ ?>
                    <td><?php echo $this->Html->link('Pay', array('action' => 'servicestatus', $order['Order']['id'])); ?></td>
                    <?php }else{ ?>
                    <td><?php echo ucwords($order['Order']['refund_status']); ?></td>
                    <?php } ?>
                    
                    
					<td class="actions">
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $order['Order']['id']),array('escape'=>false));  ?>
						<?php //echo $this->Html->link('Edit', array('action' => 'edit', $order['Order']['id']), array('class' => 'btn btn-success')); ?>
						<?php //echo $this->Form->postLink('Delete Order', array('action' => 'delete', $order['Order']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
</section>
<?php echo $this->element('pagination-counter'); ?>
<?php echo $this->element('pagination'); ?>

<style>
.sft_non {
    width: 38%;
    float: left;
    margin-right: 3px;
}

.adj_crt {
    width: auto;
    float: left;
    margin-left: 10px;
}

.set_rght {
    width: auto;
    float: left;
}
.search_user {
    width: auto;
    float: left;
	padding: 12px 0;
}

.srch_col {
    width: 43%;
    float: left;
}

</style>


<script>
$("#start_date").datepicker({dateFormat: 'dd-mm-yy'});
var date = $('#start_date').val();

if(date != ''){
	var date = new Date(date);
	var newDate = date.toString('m-d-Y');
	$( "#end_date" ).datepicker({minDate: new Date(newDate), dateFormat: 'dd-mm-yy'});
}
$(document).delegate("#start_date", "change", function(){
  	var date = $(this).datepicker('getDate');
	var date = new Date(date);
	var newDate = date.toString('m-d-Y');
	$( "#end_date" ).datepicker({minDate: new Date(newDate), dateFormat: 'dd-mm-yy'});
});



//$( "#cart-calender").datepicker({minDate: new Date('<?php echo $sub_date ?>'), maxDate: new Date('<?php echo $exp_date ?>'), dateFormat: 'dd-mm-yy'});
</script>