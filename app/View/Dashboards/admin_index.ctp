<style>
	table{
		width:100%;
		margin:0px;
	}
	.form_outer{
		margin-bottom:20px;
	}
	.pull-right .filter,
	.pull-right .search_user{
		width:100%;
		float:left;
	}
	.search_user input.form-control{
		width:auto;
		float:right;
		margin-right:4px;
	}
	.search_user .btn{
		float:right;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
	padding: 5px;
}
</style>
<section class="content-header marginbtm">
      <h1>
       Store Like User
      </h1>
    </section>
<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<!--<div class="up-img_sec"> 
				<form id="" class="col-sm-5 pull-right" method="post" action="<?php echo $this->webroot?>admin/orders">
					<div class="search_user">
						<button type="submit" class="search_button1 btn btn-primary">Search</button>
						<input type="text" class="form-control" name=data[Order][search] placeholder="Search User by Email">
					</div>
				</form>
			</div>-->
			<table class="table table-bordered table-hover">
				<tr>
                                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('id','UserID'); ?></th>
					<th><?php echo $this->Paginator->sort('first_name'); ?></th>
					<th><?php echo $this->Paginator->sort('last_name'); ?></th>
					<th><?php echo $this->Paginator->sort('email'); ?></th>
					<th>Actions</th>
				</tr>
				<?php //print_r($orders);exit;?>
				<?php foreach ($likeuser as $order): ?>
				<tr>
                                        <td><?php echo h($order['Restaurantlike']['id']); ?></td>
                                        <td><?php echo h($order['User']['id']); ?></td>
					<td><?php echo h($order['User']['first_name']); ?></td>
					<td><?php echo h($order['User']['last_name']); ?></td>
					<td><?php echo h($order['User']['email']); ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Restaurantlike']['id']), array('class' => 'view1 btn btn-primary')); ?>
						<?php //echo $this->Html->link('Edit', array('action' => 'edit', $order['Order']['id']), array('class' => 'btn btn-success')); ?>
						<?php //echo $this->Form->postLink('Delete Order', array('action' => 'delete', $order['Restaurantlike']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $order['Restaurantlike']['id'])); ?>
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