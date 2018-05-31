<section class="content-header">
      <h1>
        Contacts
      </h1>
    </section>

<section class="content">
<div class="row">
<?php echo $this->Session->flash('contact'); ?>
	<div class="col-sm-12"> 
		<div class="box">
        <div class="col-sm-5 col-sm-offset-7">
			<div class="up-img_sec"> 
				<form id="" class="pull-right" method="post" action="<?php echo $this->webroot?>admin/contacts">
					<div class="search_user">
						<button type="submit" class="search_button1 btn btn-primary">Search</button>
						<input type="text" class="form-control" name=data[Contact][search] placeholder="Search By User's name" value="<?php echo $keyword; ?>">
					</div>
				</form>
                <?php if($keyword != ''){ ?>
                <a href="" class="btn btn-danger pull-right">View All</a>
                <?php } ?>
              </div>
			</div>
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
                    <th><?php echo $this->Paginator->sort('name');?></th>
					<th><?php echo $this->Paginator->sort('email');?></th>
					<th><?php echo $this->Paginator->sort('phone');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
                    <th><?php echo $this->Paginator->sort('answered');?></th>
					<th class="actions">Actions</th>
				</tr>
				<?php foreach ($contacts as $contact): ?>
				<tr>
					<td><?php echo h($contact['Contact']['id']); ?></td>
					<td><?php echo h($contact['Contact']['name']); ?></td>
					<td><?php echo h($contact['Contact']['email']); ?></td>
					<td><?php echo h($contact['Contact']['phone']); ?></td>
					<td><?php echo h($contact['Contact']['created']); ?></td>
                    <td>
                    <?php if($contact['Contact']['answered'] == '0'){ ?>
                    <span class="label label-danger">Not Answered</span>
                    <?php }else{ ?>
                    <span class="label label-success">Answered</span>
                    <?php } ?>
                    </td>
                    
                    
					<td class="actions">
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-success fa fa-reply', 'title' => 'Reply')), array('action' => 'edit', $contact['Contact']['id']),array('escape'=>false));  ?>     
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

#contactMessage {
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
