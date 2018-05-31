<style>
	.pull-right form{
		width:100%;
		float:left;
	}
	.pull-right form .search_username{
		width:100%;
		float:left;
	}
	.search_username .form-control{
		width:auto;
		float:right;
		margin-right:4px;
	}
	.search_username .btn{
		float:right;
	}
	.form_outer{
		margin-bottom:20px;
	}
	table{
		width:100%;
		margin:0px;
	}
	.search_username {
    width: 100%;
    float: left;
}
.up-img_sec {
    width: 100%;
    float: left;
    padding: 12px 0;
}

#staticpageMessage {
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
<section class="content-header marginbtm">
      <h1>
       Static Pages
      </h1>
    </section>

<section class="content">
<div class="row">
	<div class="col-sm-12">
     <?php echo $this->Session->flash('staticpage'); ?>
		<div class="box">
        <div class="col-sm-5 col-sm-offset-7">
			<div class="up-img_sec">
             <?php if (@$keyword) { ?>
                    <a href="" class="btn btn-danger pull-right gap_script">View All</a>
                    <?php } ?>
					<?php echo $this->Form->create("Staticpage", array("class" =>"pull-right")); ?>
						<div class="search_username">
							<button type="submit" class="search_button1 btn btn-primary">Search</button>
							<input type="text" name="keyword" value="<?php if (@$keyword) {
								echo $keyword;
								} ?>" placeholder="Search By Title" class="form-control"/>
						</div>
					<?php echo $this->Form->end(); ?>
                   
			</div>
            </div>
			<?php echo $this->Form->create('Staticpage', array("action" => "deleteall", 'id' => 'mbc')); ?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
					   <th><?php echo $this->Paginator->sort('Title'); ?></th>
						<th><?php echo $this->Paginator->sort('Image'); ?></th>
						<th><?php echo $this->Paginator->sort('Created'); ?></th>
						<th><?php echo $this->Paginator->sort('Status'); ?></th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($staticpages){
					if(isset($staticpages)){
					foreach ($staticpages as $staticpage){ ?>
						<tr>
							<td><?php echo h($staticpage['Staticpage']['title']); ?>&nbsp;</td>
							<td>
							<?php
								$ext = pathinfo($staticpage['Staticpage']['image'], PATHINFO_EXTENSION);
								if(empty($ext)){
								echo  'No Image';
							}
							else
								{
								echo $this->Html->image('../files/staticpage/'.$staticpage['Staticpage']['image']
								,array('alt'=>'Not Image','height'=>'70px','width'=>'100px')); 
								}
							?> 
							</td>
							<td><?php echo h($staticpage['Staticpage']['created']); ?>&nbsp;</td>
							<td>
								<?php if($staticpage['Staticpage']['status']==1){ echo "Active"; }else { echo "Block";}?>&nbsp;
							</td>
							<td class="actions">
                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $staticpage['Staticpage']['id']),array('escape'=>false));  ?>
                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-warning fa fa-pencil', 'title' => 'Edit')), array('action' => 'edit', $staticpage['Staticpage']['id']),array('escape'=>false));  ?>
								<?php //echo $this->Form->postLink(__('Delete'),array('action' => 'delete', $staticpage['Staticpage']['id']), array('class' => 'delete1 btn btn-danger'), __('Are you sure you want to delete # %s?', $staticpage['Staticpage']['id'])); ?>   
							</td>
						</tr>
					 <?php } } } else { { ?> 
					<p class="not_found">NOT FOUND</p>
					 <?php } } ?>
				</tbody>
			</table>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
</section>
<?php echo $this->element('pagination-counter'); ?>
<?php echo $this->element('pagination'); ?>