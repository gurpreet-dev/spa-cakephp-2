<style>
	.form_outer form .input{
		width:100%;
		float:left;
		margin-bottom:11px;
	}
	#CategoryStatus {
    opacity: 999 !important;
    left: -227px;
    top: -11px;
}

</style>
<section class="content-header marginbtm">
      <h1>
       Add Category
      </h1>
    </section>
<section class="content">
<div class="row">
    <div class="col-sm-6">
		<div class="box">
                    <div class="box-body"> 
			<?php echo $this->Form->create('Category', array('type' => 'file')); ?> 
                        <?php //echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$loggeduser));?>
			<?php //echo $this->Form->input('parent_id', array('class' => 'form-control', 'empty' => true)); ?>
                        <?php
                            //echo $this->Form->input('parent_id', array(
                             //   'label' => 'Parent',
                             //   'class' => 'form-control',
                             //   'options' => array(
                             //        '' => 'Keywords',
                             //       '' => $parentName,                 
                             //   )
                            //));
                        ?>
			<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
			<?php //echo $this->Form->input('slug', array('class' => 'form-control')); ?>
            
            <?php echo $this->Form->input('image (Best&nbsp 450*289)', array('type' => 'file','class' => 'form-control', 'required')); ?>
            
			<?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
                         <div class="chk_act tp_chk"><?php echo $this->Form->input('status', array('class' => 'form-control', 'type' => 'checkbox', 'label' => 'Active')); ?></div>
			<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn margintop')); ?>
			<?php echo $this->Form->end(); ?>
                    </div>
		</div>
    </div>
</div>
</section>