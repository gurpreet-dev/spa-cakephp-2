<style>
	.form_outer{
		margin-bottom:20px;
	}
	.form_outer table{
		width:100%;
		margin:0px;
	}
	.btn.btn-primary.resCat {
    width: auto;
    float: left;
    margin-left: 8px;
}

   .input.text.required{
	 width: auto;
	  float: left;
			}
	.btn.btn-danger.margn_rght{
	  width: auto;
	  float: right; 
	  background-color: #f068a0;
border-color: #f068a0;
	  }
	 .up-img_sec {
		width: 100%;
		float: left;
		padding: 12px 0;
                }
.btn.btn-danger.margn_rght:hover, .btn-danger:active, .btn-danger.hover {
	background-color: #ef3b85;
}
.admin_table td img {
    width: 100px;
}
#categoryMessage {
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
       Categories
      </h1>
    </section>
 
<section class="content">
<div class="row">
<?php echo $this->Session->flash('category'); ?>
	<div class="col-sm-12">
		<div class="box">
        <div class="col-sm-5 col-sm-offset-7">
        <div class="up-img_sec">
        <?php echo $this->Html->link('View All', array('controller' => 'categories', 'action' => 'admin_reset', 'admin' => true), array('class' => 'btn btn-danger pull-right margn_rght gap_script')); ?>
        	<?php echo $this->Form->create('Category', array('class' =>'pull-right')); ?>
            <?php echo $this->Form->input('name', array('label' => false, 'id' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Search By Category Name', 'value' => $name,'required')); ?>
            <?php
            echo $this->Form->button('Search', array('class' => 'btn btn-primary resCat'));
            echo $this->Form->end();
            ?>
            &nbsp; &nbsp;
            
        </div>
        </div>
			<table class="table admin_table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					
					<!--<th><?php //echo $this->Paginator->sort('lft'); ?></th>
					<th><?php //echo $this->Paginator->sort('rght'); ?></th>-->
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<!--<th><?php echo $this->Paginator->sort('slug'); ?></th>-->
					<th><?php echo $this->Paginator->sort('description'); ?></th>
                    <th><?php echo $this->Paginator->sort('image'); ?></th>
                                        <th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions gory_blck">Actions</th>
				</tr>
                                <?php if(!empty($categories)){?>
				<?php foreach ($categories as $category): ?>
					<tr>
						<td><?php echo h($category['Category']['id']); ?></td>
						
						<!--<td><?php //echo h($category['Category']['lft']); ?></td>
						<td><?php //echo h($category['Category']['rght']); ?></td>-->
						<td><?php echo h($category['Category']['name']); ?></td>
                        
						<!--<td><?php echo h($category['Category']['slug']); ?></td>-->
						<td><?php echo h($category['Category']['description']); ?></td>
                        
                        <td>
                        <?php if($category['Category']['image'] != ''){ ?>
                        <img src="<?php echo $this->webroot; ?>images/spa/category/<?php echo $category['Category']['image']; ?>" /><br />
                        <?php }else{ ?>
                        <img src="<?php echo $this->webroot; ?>files/noimagefound.jpg" /><br />
                        <?php } ?>
                        </td>
                        <td>
                        <?php if($category['Category']['status'] == 0){
                        echo 'Deactivated';
                        }else{
                        echo 'Activated';
                        }
                        ?>
                        </td>
						<td><?php echo h($category['Category']['created']); ?></td>
						<td><?php echo h($category['Category']['modified']); ?></td>
						<td class="actions">
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $category['Category']['id']),array('escape'=>false));  ?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-success fa fa-pencil', 'title' => 'Edit')), array('action' => 'edit', $category['Category']['id']),array('escape'=>false)); ?>
                            <?php echo $this->Form->postLink('', array('action' => 'delete', $category['Category']['id']), array('class' => 'btn btn-danger fa fa-trash', 'title' => 'Delete'), __('Are you sure you want to delete # %s?', $category['Category']['id']));?>
						</td>
					</tr>
				<?php endforeach; ?>
                                <?php }else{
                                ?>
                                        <center><?php echo "No Result Found";?></center>
                                <?php } ?>
			</table>
		</div>
	</div>
</div>
</section>
<?php echo $this->element('pagination-counter'); ?>
<?php echo $this->element('pagination'); ?>

<?php //echo $this->Tree->generate($categoriestree, array('element' => 'categories/tree_item', 'class' => 'categorytree', 'id' => 'categorytree')); ?>
