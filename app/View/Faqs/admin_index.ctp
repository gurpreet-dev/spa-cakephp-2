<section class="content-header marginbtm">
      <h1>
       FAQ's
      </h1>
    </section>
<section class="content">
<div class="row">
<?php echo $this->Session->flash('faq'); ?>
	<div class="col-sm-12">
		<div class="box table-responsive" style="height: 540px; overflow: scroll;">
        	<?php echo $this->Html->link('Add Faq', array('action' => 'add'), array('class' => 'btn btn-success')); ?>
			<div class="col-sm-5 col-sm-offset-7">
                <div class="up-img_sec"> 
                  <?php if($keyword != ''){ ?>
                    <a href="" class="btn btn-danger pull-right">View All</a>
                    <?php } ?>
                    <form id="" method="post" class="pull-right" action="<?php echo $this->webroot?>admin/orders">
                        <div class="search_user">
                            <button type="submit" class="search_button1 btn btn-primary">Search</button>
                            <input type="text" class="form-control" name=data[Faq][search] placeholder="Search By Keyword Value" value="<?php echo $keyword; ?>" required>
                        </div>
                    </form>
                  
                </div>
            </div>
			<table class="table table-bordered table-hover">
				<tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('title'); ?></th>
					<th><?php echo $this->Paginator->sort('description'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="gory_blck">Actions</th>
				</tr>
				<?php foreach ($faqs as $faq): ?>
				<tr>
                    <td><?php echo h($faq['Faq']['id']); ?></td>
                    
					<td><?php echo h($faq['Faq']['title']); ?></td>
					<td><?php echo h($faq['Faq']['description']); ?></td>
					<td><?php echo h($faq['Faq']['created']); ?></td>
                    <td><?php echo h($faq['Faq']['modified']); ?></td>
					<td class="actions">
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $faq['Faq']['id']),array('escape'=>false));  ?>
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-success fa fa-pencil', 'title' => 'Edit')), array('action' => 'edit', $faq['Faq']['id']),array('escape'=>false)); ?>
						<?php echo $this->Form->postLink('', array('action' => 'delete', $faq['Faq']['id']), array('class' => 'btn btn-danger fa fa-trash'), __('Are you sure you want to delete # %s?', $faq['Faq']['id'])); ?>
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