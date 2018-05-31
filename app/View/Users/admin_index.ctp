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
#admin_passMessage {
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
        Users
      </h1>
    </section>

<section class="content">
<div class="row">
<?php echo $this->Session->flash('admin_pass'); ?>
<?php echo $this->Session->flash('user_delete'); ?>
	<div class="col-sm-12"> 
		<div class="box">
			<div class="up-img_sec"> 
            <?php if($keyword != ''){ ?>
                <a href="" class="btn pull-right btn-danger gap_script">View All</a>
                <?php } ?>
				<form id="" class="pull-right" method="post" action="<?php echo $this->webroot?>admin/Users">
					<div class="search_user">
						<button type="submit" class="search_button1 btn btn-primary">Search</button>
						<input type="text" class="form-control" name=data[User][search] placeholder="Search User by Email" value="<?php echo $keyword; ?>">
					</div>
				</form>
                

			</div>
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('role');?></th>
					<th><?php echo $this->Paginator->sort('name');?></th>
					<th><?php echo $this->Paginator->sort('username');?></th>
					<th><?php echo $this->Paginator->sort('active');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<th class="actions">Actions</th>
				</tr>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['id']); ?></td>
					<td><?php echo h($user['User']['role']); ?></td>
					<td><?php echo h($user['User']['name']); ?></td>
					<td><?php echo h($user['User']['username']); ?></td>
					<td><?php echo h($user['User']['active']); ?></td>
					<td><?php echo h($user['User']['created']); ?></td>
					<td><?php echo h($user['User']['modified']); ?></td>
					<td class="actions">
                                            
                        
                                            
                                            
                                            
						<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $user['User']['id']),array('escape'=>false));  ?>
						<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-warning fa fa-lock', 'title' => 'Change Password')), array('action' => 'password', $user['User']['id']),array('escape'=>false)); ?>
						<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-success fa fa-pencil', 'title' => 'Edit')), array('action' => 'edit', $user['User']['id']),array('escape'=>false)); ?>
						<?php echo $this->Form->postLink('', array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger fa fa-trash', 'title' => 'Delete'), __('Are you sure you want to delete # %s?', $user['User']['id']));?>
                        
                        
                        <?php if($user['User']['active'] == '1'){ ?>
                        <?php echo $this->Form->postLink('', array('action' => 'userblock', $user['User']['id']), array('class' => 'btn btn-danger last_lock fa fa-unlock-alt', 'title' => 'Unblocked'), __('Are you sure you want to block # %s?', $user['User']['id'])); ?>
                        <?php }else{ ?>
                        <?php echo $this->Form->postLink('', array('action' => 'userblock', $user['User']['id']), array('class' => 'btn btn-danger last_lock fa fa-ban', 'title' => 'Blocked'), __('Are you sure you want to unblock # %s?', $user['User']['id'])); ?>
                        <?php } ?>
                        
                        <?php
                        
                        if($user['User']['role'] == 'freelancer'){
                            if($user['User']['active'] == '1'){
                                echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-default fa fa-check', 'title' => 'Approved')), array('action' => 'index', $user['User']['id']),array('escape'=>false, 'onclick' => 'return false;'));
                            }else{
                                echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-success fa fa-check', 'title' => 'Unapproved')), array('action' => 'index', $user['User']['id']),array('escape'=>false));
                            }
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