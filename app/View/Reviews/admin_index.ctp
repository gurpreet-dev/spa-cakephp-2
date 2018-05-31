<style>
	table{
		width:100%;
		margin:0px;
	}
	.form_outer{
		margin-bottom:20px;
	}
	
	table tr th:nth-child(5),
	table tr th:nth-child(6),
	table tr th:nth-child(7),
	table tr th:nth-child(8){
		width:11% !important;
	}
	.page_heading {
    padding-left: 15px;
    padding-top: 1px;
}
#reviewMessage {
    background-color: #00a65a;
	border:1px solid #008d4c;
    color: #fff;
    padding: 7px;
    font-size: 16px;
    margin-bottom: 10px;
	margin-left: 15px;
margin-right: 15px;
border-radius: 3px;
font-weight: 400;

}

</style>
<div class="page_heading">
	<h2><?php echo __('Reviews'); ?></h2>
</div>
<section class="content">
<div class="row">
<?php echo $this->Session->flash('review'); ?>
	<div class="col-sm-12"> 
		<div class="box">
			<table class="table table-bordered table-hover">
            <thead>
					<tr>
							<th><?php echo $this->Paginator->sort('id'); ?></th> 
							<th><?php echo $this->Paginator->sort('order_id', 'Order ID'); ?></th>
							<th><?php echo $this->Paginator->sort('salon_id', 'Store ID'); ?></th>
							<th class="gory_blck">Store Name</th>
                            <th class="gory_blck">User ID</th>
                            <th class="gory_blck">User Name</th>
							<th><?php echo $this->Paginator->sort('rating'); ?></th>
							<th><?php echo $this->Paginator->sort('created'); ?></th>
							<th><?php echo $this->Paginator->sort('modified'); ?></th>         
							<th class="actions gory_blck"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>
				<tbody>
                
                <?php foreach ($reviews as $time): ?>
					<tr>
						<td><?php echo h($time['Review']['id']); ?>&nbsp;</td>
						<td><?php echo h($time['Review']['order_id']); ?>&nbsp;</td>

						<td><?php echo h($time['Review']['salon_id']); ?>&nbsp;</td>
						<td><?php echo h($time['Salon']['store_name']); ?>&nbsp;</td>
						<td><?php echo h($time['Review']['user_id']); ?>&nbsp;</td>
						<td><?php echo h($time['User']['first_name'].' '.$time['User']['last_name']); ?>&nbsp;</td>
                        <td><?php echo h($time['Review']['rating']); ?>&nbsp;</td>
						<td><?php echo h($time['Review']['created']); ?>&nbsp;</td>
						<td><?php echo h($time['Review']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php //echo $this->Html->link(__('View'), array('action' => 'view', $time['Review']['id']), array('class' => 'btn btn-primary btn-view')); ?>
                            
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-pencil', 'title' => 'Edit')), array('action' => 'edit', $time['Review']['id']),array('escape'=>false));  ?>
							
							<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $time['Review']['id']), array('class' => 'btn btn-danger btn-view'), array(), __('Are you sure you want to delete # %s?', $time['Review']['id'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
                
							</tbody></table>
		</div>
	</div>
</div>
</section>
<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	
	</p>
	<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>