    <section class="content-header">
      <h1>
        Edit
      </h1>
    </section>

<section class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="box">
                    <div class="box-header with-border">
                        <div class="box-body">
            <?php echo $this->Form->create('Staticpage',array('id'=>'tab','type'=>'file')); ?>                
            <div class="form-group">
				<?php echo $this->Form->input('title',array('class'=>'form-control'));?>
            </div> 
            <div class="form-group">
				<?php echo $this->Form->input('image',array('class' => 'form-control', 'type'=>'file'));?>      
            </div>
            
            <?php if($admin_edit['Staticpage']['image']){ echo $this->Html->Image('/files/staticpage/' . h($admin_edit['Staticpage']['image']), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
            
            }else{
            echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
            } ?>
			<!--<div class="form-group">-->
				<?php //echo $this->Form->input('show_main', array('type' => 'checkbox')); ?> 
            <!--</div>-->
            <div class="form-group">
				<?php echo $this->Form->input('description',array('class'=>'form-control','type'=>'textarea'));?>
            </div>
			<div class="form-group">
				
                <?php echo $this->Form->input('status', array('label' => 'Status',  'type' => 'select', 'options' => array('' => 'Please Select', '1'=>'Active','0'=>'Deactive'),'default'=> $admin_edit['Staticpage']['status'], 'class' => "form-control")); ?>
            </div>
            <input type="hidden" name="data[Staticpage][created]" value="<?php echo date('Y-m-d H:i:s'); ?>">
			<div class="btn-toolbar list-toolbar">
                <button class="btn btn-primary main_btn" name="submit"><i class="fa fa-save" style="margin-right:5px;float:left;margin-top:4px;"></i>Update</button>
                <a href="<?php echo $this->Html->url(array('controller' => 'Staticpages', 'action' => 'admin_index')); ?>" data-toggle="modal" class="btn btn-danger">Cancel</a>
			</div>
            <?php echo $this->Form->end();?>
                    </div>
        </div>
	</div>
</div>
</div>
</section>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.6/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
             selector: "textarea",
             plugins : "media, code",
			 toolbar: "code",
			 menubar: "tools"
    });
    </script>