<style>
	.form_outer{
		margin-bottom:20px;
	}
	table{
		width:100%;
		margin:0px;
	}
	table tr .actions{
		width:29% !important;
	}
	.pull-right .search_user{
		width:100%;
		float:left;
	}
	.pull-right .btn{
		float:right;
	}
	.pull-right input.form-control{
		width:auto;
		float:right;
		margin-right:4px;
	}
.up-img_sec {
    width: 100%;
    float: left;
    padding: 12px;
}
#successMessage{
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
<!-- <div class="page_heading">
	<h2>Users</h2>
</div> -->

<section class="content-header">
      <h1>
        Subscriptions
      </h1>
    </section>

<section class="content">
<div class="row">
	<div class="col-sm-12">
    	
        <?php echo $this->Session->flash('success'); ?>
     
		<div class="box">
			<div class="up-img_sec"> 
            	<?php echo $this->Html->link('Add Subscription', array('action' => 'subadd'), array('class' => 'btn btn-success')); ?>
                
                <?php if($keyword != ''){ ?>
                <a href="" class="btn btn-danger pull-right gap_script">View All</a>
                <?php } ?>
				<form id="" class="pull-right" method="post" action="<?php echo $this->webroot?>admin/users/subscriptions">
					<div class="search_user">
						<button type="submit" class="search_button1 btn btn-primary">Search</button>
						<input type="text" class="form-control" name=data[User][search] placeholder="Search User by Email" value="<?php echo $keyword; ?>">
					</div>
				</form>
                
			</div>
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('store_name');?></th>
					<th><?php echo $this->Paginator->sort('username');?></th>
                    <th><?php echo $this->Paginator->sort('subscription');?></th>
					<th><?php echo $this->Paginator->sort('subscribe_date', 'From');?></th>
                    <th>Days Elapsed</th>
                    <th>Days Remaining</th>
					<th><?php echo $this->Paginator->sort('expire_date', 'To');?></th>
                    <th><?php echo $this->Paginator->sort('subscribe_amount', 'Total Amount');?></th>
					<th class="actions">Actions</th>
				</tr>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['id']); ?></td>
					<td><?php echo h($user['User']['store_name']); ?></td>
					<td><?php echo h($user['User']['username']); ?></td>
                    <td>
                    <?php if($user['User']['subscription_status'] == 'subscribed'){ ?>
                    <span class="label label-success"><?php echo h($user['User']['subscription_status']); ?></span>
                    <?php }elseif($user['User']['subscription_status'] == 'pending'){ ?>
                    <span class="label label-info"><?php echo h($user['User']['subscription_status']); ?></span>
                    <?php } ?>
                    </td>
					<td><?php echo h($user['User']['subscribe_date']); ?></td>
                    <?php
                        $start_date=date_create($user['User']['subscribe_date']);
                        $current_date=date_create(date('d-m-Y'));
                        $diff=date_diff($start_date,$current_date);
                    ?>
                    
                    
                    <td>
                    <?php
                    
                    	if (strpos($diff->format("%R%a"), '-') !== false) {
                        	echo '0';
                        }else{
                        	$elapsed = str_replace('+', '', $diff->format("%R%a"));
                            $elapsed = str_replace('-', '', $elapsed);
                            echo $elapsed;
                        }
                    
                        
                    ?>
                    </td>
                    
                    <?php
                    
                    	if (strpos($diff->format("%R%a"), '-') !== false) {
                        	$current_date=date_create($user['User']['subscribe_date']);
                        }else{
                        	$current_date=date_create(date('d-m-Y'));
                        }
                        $end_date=date_create($user['User']['expire_date']);
                        
                        $diff2=date_diff($current_date, $end_date);
                    ?>
                    
                    <td>
                    <?php
                        $remaining = str_replace('+', '', $diff2->format("%R%a"));
                        $remaining = str_replace('-', '', $remaining);
                        echo $remaining;
                    ?></td>
					<td><?php echo h($user['User']['expire_date']); ?></td>
                    <td>&#163;<?php echo h($user['User']['subscribe_amount']); ?></td>
					<td class="actions">
                        
                   <?php
                    
                    if($user['User']['role'] == 'freelancer'){
                        if($user['User']['active'] == '1'){

                            //echo $this->Html->link('Edit subscription', array('action' => 'subedit', $user['User']['id']), array('class' => 'btn btn-success'));
                            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-warning fa fa-edit', 'title' => 'Edit')), array('action' => 'subedit', $user['User']['id']),array('escape'=>false));

                        }
                        
                        //echo $this->Html->link('View subscriptions', array('action' => 'subview', $user['User']['id']), array('class' => 'btn btn-info'));
                         echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'subview', $user['User']['id']),array('escape'=>false)); 
                    }
                    
                    ?>
                        
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