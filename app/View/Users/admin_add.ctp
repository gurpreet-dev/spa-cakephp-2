<style>
	.form_outer form .input{
		width:100%;
		float:left;
		margin-bottom:11px;
	}
	.form_outer form label{
		width:100%;
		float:left;
	}
	#UserActive{
	position: absolute;
    opacity: 999 !important;
    left: 19px;
}

</style>
<div class="box-header with-border">
              <h3 class="box-title">User Registration</h3>
        </div>
<section class="content">
<div class="row">
    <div class="col-sm-6">
		<div class="box ">
		
        <?php echo $this->Form->create('User');?>
		<div class="box-body">
        <?php echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('admin' => 'admin', 'freelancer'=>'Freelancer', 'customer'=>'Customer'))); ?>
        <?php echo $this->Form->input('name', array('class' => 'form-control','required')); ?>
        <?php echo $this->Form->input('username', array('class' => 'form-control','required','label'=>'Email')); ?>
        <?php echo $this->Form->input('password', array('class' => 'form-control','required')); ?>
       <div class="chk_act"> <?php echo $this->Form->input('active', array('type' => 'checkbox','required')); ?></div>
               <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn')); ?>
		</div>
        <?php echo $this->Form->end(); ?>
		
		</div>
    </div>
</div>
</section>