  <div class="box-header with-border">
                     <h3 class="box-title">Add Static Page</h3>
                </div>
<section class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="box">
            <?php echo $this->Form->create('Staticpage',array('id'=>'tab','type'=>'file')); ?>
                    <div class="box-body">
				<!--<div class="form-group"> 
					<label>Position</label>
					<?php echo $this->Form->select('position',array('about'=>'About Us', 'blog' => 'Blog', 'outstory' => 'Our Story', 
					't&c'=>'Term & Conditions','return&exchange' => 'Return & Exchange',
					'about_wear_org' => 'About Wear Organic','green&plant' => 'Green Plant', 'home' => 'Welcome to Shop','faq' => 'Faq'),
					array('class'=>'form-control','empty' => '--Select position--','required'))
					?>
				</div>-->
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="data[Staticpage][title]" class="form-control span12">                        
				</div>
				<div class="form-group">
					<label>Image</label> 
					<input class="form-control" type="file" name="data[Staticpage][image]">
				</div>  
				<div class="form-group">
					<?php echo $this->Form->input('show_main', array('type' => 'checkbox')); ?> 
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea rows="2" name="data[Staticpage][description]" class="form-control" id="edi" ></textarea>
				</div>
				
				<input type="hidden" name="data[Staticpage][created]" value="<?php echo date('Y-m-d H:i:s'); ?>">
				<input type="hidden" name="data[Staticpage][status]" value="1">
				<div class="btn-toolbar list-toolbar">
					<button class="btn btn-primary main_btn" name="submit">Save</button>
				</div>
                    </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
</section>
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.6/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
             selector: "#edi",
             plugins : "media"

    });
    </script>