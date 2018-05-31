<style>
	.form_outer{
		margin-bottom:20px;
	}
	.form_outer table{
		width:100%;
		margin:0px;
	}
</style>

<section class="content-header marginbtm">
      <h1>
        Parent Categories
      </h1>
    </section>

                    <div class="btn-toolbar list-toolbar">
            <?php echo $this->Form->create('ParentCategory', array()); ?>
 <!--<div class="col-sm-2">
        <?php  //echo $this->Form->input('name', ['options' => $restaurnt, 'label' =>false,'class' => 'form-control','empty'=>'Choose restaurant']);  ?>

        </div>-->
            <div class="col-lg-2">
              
                 
                 <?php
                echo $this->Form->input('filter', array(
                    'label' => false,
                    'class' => 'form-control',
                    'options' => array(
                         '' => 'Keywords',
                        'name' => 'Name',
                        'slug' => 'Slug',                        
                    ),
                    //'selected' => $all['filter']
                    'required'
                ));
                ?>


            </div>
 <div class="col-lg-2">
                <?php echo $this->Form->input('name', array('label' => false, 'id' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Write keyword', 'value' => $all['name'],'required')); ?>

            </div>
            
            <div class="col-lg-4">
                <?php
                echo $this->Form->button('Search', array('class' => 'btn btn-default resCat'));
                //echo $this->Form->end();
                ?>
                &nbsp; &nbsp;
                <?php echo $this->Html->link('View All', array('controller' => 'ParentCategories', 'action' => 'admin_reset', 'admin' => true), array('class' => 'btn btn-danger margn_rght')); ?>
            </div><br/><br/>
            <div class="btn-group">     
            </div>
        </div>
			<section class="content-header">
<div class="row">
	<div class="col-sm-12">
		<div class="box">		
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions">Actions</th>
				</tr>
                                <?php if(!empty($paretcat)){?>
				<?php foreach ($paretcat as $category): ?>
					<tr>
						<td><?php echo h($category['ParentCategory']['id']); ?></td>
						<td><?php echo h($category['ParentCategory']['name']); ?></td>
						<td><?php echo h($category['ParentCategory']['created']); ?></td>
						<td><?php echo h($category['ParentCategory']['modified']); ?></td>
						<td class="actions">
							<?php echo $this->Html->link('View', array('action' => 'view', $category['ParentCategory']['id']), array('class' => 'btn btn-primary')); ?>
							<?php echo $this->Html->link('Edit', array('action' => 'edit', $category['ParentCategory']['id']), array('class' => 'btn btn-success')); ?>
							<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $category['ParentCategory']['id']), array('class' => 'delete1 btn btn-danger'), __('Are you sure you want to delete # %s?', $category['ParentCategory']['id']));?>
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
