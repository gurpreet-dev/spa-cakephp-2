<?php //echo "<pre>"; print_r($services); echo "</pre>"; ?>

<section class="content-header">
      <h1>
        Services
      </h1>
    </section>
<section class="content">
<div class="row">
	<div class="col-sm-12"> 
		<div class="box">
        <div class="col-sm-5 col-sm-offset-7">
			<div class="up-img_sec"> 
            <?php if($keyword != ''){ ?>
                <a href="" class="btn btn-danger pull-right gap_script">View All</a>
                <?php } ?>
				<form id="" class="pull-right" method="post" action="">
					<div class="search_user">
						
						<input type="text" class="form-control" name=data[Service][search] placeholder="Search Service By Name" value="<?php echo $keyword; ?>">
                        <button type="submit" class="search_button1 btn btn-primary">Search</button>
					</div>
				</form>
                 
			</div>
            </div>
			<table id="example" class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('name', 'Service name');?></th>
					<th class="gory_blck"><?php echo 'Category name';?></th>
                    <th class="gory_blck"><?php echo 'Added By (Store Name)';?></th>
					<th><?php echo $this->Paginator->sort('status');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<th class="actions gory_blck">Actions</th>
				</tr>
				<?php foreach ($services as $service): ?>
				<tr>
					<td><?php echo h($service['Service']['id']); ?></td>
					<td><?php echo h($service['Service']['name']); ?></td>
					<td><?php echo h($service['Category']['name']); ?></td>
                    <td><?php echo h($service['User']['store_name']); ?></td>
					<td>
                    <?php
                    if($service['Service']['status'] == 1){
                    	echo 'Activated';
                    }else{
                    	echo 'Deactivated';
                    }
                    
                    ?>
                    </td>
					<td><?php echo h($service['User']['created']); ?></td>
					<td><?php echo h($service['User']['modified']); ?></td>
					<td class="actions">
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'service', $service['Service']['id']),array('escape'=>false));  ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
</section>
<?php echo $this->Paginator->numbers(); ?>

<style>
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
    float: left;
    margin-left: 7px;
}

.search_user {
    width: auto;
    float: left;
}
.btn.btn-danger.pull-right {
    margin-right: 11px;
}



</style>