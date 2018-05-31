<style>
	.form_outer span{
		width:100%;
		float:left;
		margin-bottom:11px;
	}
	.form_outer span strong{
		font-weight:bold;
	}
	.form_outer form label{
		width:100%;
		float:left;
		margin-bottom:11px;
	}
	.form_outer form .form-control{
		width:auto;
		float:left;
		margin-right:4px;
	}
	.form_outer form .btn{
		float:left;
	}
</style>
<section class="content-header">
      <h1>
        Change Password
      </h1>
    </section>
<div class="content">
<div class="row">
<?php echo $this->Session->flash('admin_pass'); ?>
    <div class="col-sm-6">
		<div class="box">
<div class="box-body">
		<div class="box-header with-border" style="padding:10px 0;">
			<h3 class="box-title"><strong>Username</strong> : <?php echo $this->Form->value('User.username'); ?></h3>
		</div>
			<?php echo $this->Form->create('User');?>
			<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
			<?php echo $this->Form->input('password', array('class' => 'form-control', 'value' => '')); ?>
			<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn margintop'));?>
			<?php echo $this->Form->end();?>
		</div>
    </div>
        </div>
</div>
</div>