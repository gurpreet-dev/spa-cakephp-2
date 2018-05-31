<div class="box-header with-border">
    <h3 class="box-title">Edit Faq</h3>
</div>

<section class="content">
<div class="row">
    <div class="col-sm-6">
		<div class="box">
			<?php echo $this->Form->create('Faq'); ?>
			<div class="box-body"> 
            <?php
                echo $this->Form->input('id');
                echo $this->Form->input('title', array('class' => 'form-control'));
                echo $this->Form->input('description', array('class' => 'form-control'));
            ?>
            <?php echo $this->Form->end(__('Submit')); ?>
            </div>
        </div>
    </div>
</div> 