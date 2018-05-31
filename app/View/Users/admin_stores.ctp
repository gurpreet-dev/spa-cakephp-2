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
    padding: 12px 0;
}
.form-control {
    width: auto;
    float: left;
  
}
.search_button1.btn.btn-primary {
    width: auto;
    margin-left: 7px;
}

.search_user {
    width: auto;
    float: left;
}
.btn.btn-danger.pull-right {
    margin-right: 11px;
}
.rght_sd{
	margin-right:10px;
	}
	#storesMessage{
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
        Stores
      </h1>
    </section>

<section class="content">
<div class="row">
<?php echo $this->Session->flash('stores'); ?>
	<div class="col-sm-12"> 
		<div class="box">
        <div class="col-sm-8 col-sm-offset-4">
			<div class="up-img_sec"> 
              <?php if($keyword != ''){ ?>
                <a href="" class="btn btn-danger pull-right gap_script">View All</a>
                <?php } ?>
				<form id="" method="post" class="pull-right" action="<?php echo $this->webroot?>admin/users/stores">
					<div class="search_user">
						<button type="submit" class="search_button1 btn btn-primary">Search</button>
                        
						<input type="text" class="form-control" name=data[User][search] placeholder="Search By Keyword Value" value="<?php echo $keyword; ?>" required>
                        <select name="data[User][type]" class="form-control rght_sd" required>
                            <option value="">Search by Keyword</option>
                            <option value="store_name">Store Name</option>
                            <option value="email">Email</option>
                       	</select>
					</div>
				</form>
              
			</div>
            </div>
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('store_name');?></th>
					<th><?php echo $this->Paginator->sort('username', 'Email');?></th>
                    <th><?php echo $this->Paginator->sort('subscription');?></th>
                    <th><?php echo $this->Paginator->sort('avg_rating', 'Average Rating');?></th>
					<th><?php echo $this->Paginator->sort('active');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<th class="actions">Actions</th>
				</tr>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['id']); ?></td>
					<td><?php echo h($user['User']['store_name']); ?></td>
					<td><?php echo h($user['User']['username']); ?></td>
                    <td>
                    <?php if($user['User']['subscription_status'] == 'expired' && $user['User']['subscription'] == '0'){ ?>
                    <span class="label label-warning">Not subscribed Yet</span>
                    <?php }elseif($user['User']['subscription_status'] == 'expired'){ ?>
                    <span class="label label-warning"><?php echo $user['User']['subscription_status']; ?></span>
                    <?php }elseif($user['User']['subscription_status'] == 'subscribed'){ ?>
                    <span class="label label-success"><?php echo $user['User']['subscription_status']; ?></span>
                    <?php }elseif($user['User']['subscription_status'] == 'pending'){ ?>
                    <span class="label label-info"><?php echo $user['User']['subscription_status']; ?></span>
                    <?php } ?></td>
                    <td><?php
                    if($user['User']['avg_rating'] =='0'){ ?>
                    <span class="label label-danger"><?php echo h($user['User']['avg_rating']); ?> <i class="fa fa-star" aria-hidden="true"></i></span>
                    <?php }elseif($user['User']['avg_rating'] < '4'){ ?>
                    <span class="label label-warning"><?php echo h($user['User']['avg_rating']); ?> <i class="fa fa-star" aria-hidden="true"></i></span>
                    <?php }else{ ?>
                    <span class="label label-success"><?php echo h($user['User']['avg_rating']); ?> <i class="fa fa-star" aria-hidden="true"></i></span>
                    <?php } ?></td>
					<td><?php echo h($user['User']['active']); ?></td>
					<td><?php echo h($user['User']['created']); ?></td>
					<td><?php echo h($user['User']['modified']); ?></td>
					<td class="actions">
                        
                   <?php
                    
                    /*if($user['User']['role'] == 'freelancer'){
                        if($user['User']['active'] == '1'){

                            echo $this->Html->link('Add subscription', array('action' => 'subadd', $user['User']['id']), array('class' => 'btn btn-success'));

                        }
                    }*/
                    
                    //echo $this->Html->link('View subscriptions', array('action' => 'subview', $user['User']['id']), array('class' => 'btn btn-info'));
                    
                    /*echo $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',array('action'=>'subview',$user['User']['id']),array('class' => 'btn btn-small'));*/
                   echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $user['User']['id']),array('escape'=>false)); 
                   if($user['User']['recommended'] == 0){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-danger fa fa-star-o', 'title' => 'Not recommended')), array('action' => 'recommended', $user['User']['id']),array('escape'=>false)); 
                   }else{
                   	echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-danger fa fa-star', 'title' => 'Recommended')), array('action' => 'recommended', $user['User']['id']),array('escape'=>false)); 
                   }
                   if($user['User']['active'] == 0){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-danger fa fa-ban', 'title' => 'Blocked')), array('action' => 'block', $user['User']['id']),array('escape'=>false)); 
                    }else{
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-unlock-alt', 'title' => 'Unblocked')), array('action' => 'block', $user['User']['id']),array('escape'=>false));
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