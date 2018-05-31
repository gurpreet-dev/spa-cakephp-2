<div class="box-header with-border">
                <h3 class="box-title">Reply</h3>
            </div>
<section class="content">
<div class="row">
    <div class="col-sm-6">
		<div class="box">
            
			<?php echo $this->Form->create('Contact');?>
			<div class="box-body">  
			<?php echo $this->Form->input('id'); ?>
            <?php echo $this->Form->input('name',array('type'=>'text', 'class' => 'form-control', 'label' =>'Name', 'required')); ?>
            <?php echo $this->Form->input('email',array('type'=>'text', 'class' => 'form-control', 'label' =>'Email', 'required')); ?>
            
            <?php echo $this->Form->input('email',array('type'=>'textarea', 'class' => 'form-control', 'label' =>'Feedback', 'required')); ?>
            <?php echo $this->Form->input('reply',array('type'=>'textarea', 'class' => 'form-control btm_ctl', 'label' =>'Reply', 'required')); ?>
            <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn')); ?>
            <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>            