<style>
	.form_outer form .input{
		width:100%;
		float:left;
		margin-bottom:11px;
	}
   #CategoryStatus{
	opacity: 999 !important;
    left: -231px;
     top: -10px;

	}
	.btn.btn-primary.main_btn.gaptop {
    margin-bottom: 10px;
}

</style>
<!--<div class="page_heading">
	<h2>Edit Category</h2>
</div>-->
<div class="box-header with-border">
                        <h3 class="box-title">Edit</h3>
                        </div>
<section class="content">
<div class="row">
    <div class="col col-sm-6">
		<div class="box">
                    <div class="box-header with-border">
			<?php echo $this->Form->create('Category', array('type' => 'file')); ?>
			<?php echo $this->Form->input('id'); ?>
                        <?php echo $this->Form->input('user_id', array('class' => 'form-control','type'=>'hidden')); ?>
			<?php //echo $this->Form->input('parent_id', array('class' => 'form-control', 'empty' => true)); ?>
			<?php
//                            echo $this->Form->input('parent_id', array(
//                                'label' => 'Parent',
//                                'class' => 'form-control',
//                                'options' => array(
//                                     '' => 'Keywords',
//                                    '' => $parentName,                 
//                                ),
//                                'selected' => $parentName
//                            ));
                        ?>
                        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
			<?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
            
            <?php echo $this->Form->input('image (Best&nbsp 450*289)', array('type' => 'file','class' => 'form-control')); ?>
            
            <?php if($data['Category']['image'] != ''){ ?>
            <img src="<?php echo $this->webroot; ?>images/spa/category/<?php echo $data['Category']['image']; ?>" /><br />
            <?php } ?>
            
			<?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
                        <?php
                        if($this->request->data['User']['status'] == 0){
                            echo $this->Form->input('status', array('class' => 'form-control', 'type' => 'checkbox', 'label' => 'Active'));
                        }else{
                            echo $this->Form->input('status', array('class' => 'form-control', 'type' => 'checkbox', 'checked' => 'checked', 'label' => 'Active'));
                        }
                        ?>
			<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn gaptop')); ?>
			<?php echo $this->Form->end(); ?>
                        </div>
                    </div>
		</div>
</div>
</section>