<?php //echo "<pre>"; print_r($services); echo "</pre>";?>
<div class="smart_container edit_grnd">

    <div class="container">
        <div class="row">

            <div class="globel_headding">
                <div class="title_text">Edit Service</div>
            </div>
            
            <?php echo $this->Session->flash('editservice'); ?>
            
            <div class="col-sm-6 col-sm-offset-3">
                <div class="forgot_pge">
                    <?php echo $this->Form->create(); ?> 

                        <div class="form-group"> 
                            <select name="data[Service][category_id]" class="form-control" id="category_id" required>
                                <option value="">Choose category</option>
                                <?php foreach($categories as $category){ ?>
                                <option value="<?php echo $category['Category']['id']; ?>" <?php if($services['Service']['category_id']==$category['Category']['id']) { echo " selected "; }?> ><?php echo $category['Category']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group"> 
                            <input type="text" name="data[Service][name]" value="<?php echo $services['Service']['name']; ?>" class="form-control" placeholder="Service Name" id="name" required>
                        </div>
                        
                        <div class="form-group"> 
                            <input type="text" name="data[Service][price]" value="<?php echo $services['Service']['price']; ?>"  class="form-control" placeholder="Service Price" id="price" required>
                        </div>
                    
                        <div class="form-group"> 
                            <input type="number" name="data[Service][duration]" value="<?php echo $services['Service']['duration']; ?>"  class="form-control" placeholder="Service Duration" id="duration" required>
                        </div>
                    
                        <div class="form-group"> 
                            <div class="col-md-6">
                                <?php if($services['Service']['status'] == '1'){ ?>
                                <input type="radio" name="data[Service][status]" value="1" checked="checked" required>Active
                                <?php }else{ ?>
                                <input type="radio" name="data[Service][status]" value="1" required>Active
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <?php if($services['Service']['status'] == '0'){ ?>
                                <input type="radio" name="data[Service][status]" value="0" checked="checked" required>Deactivate
                                <?php }else{ ?>
                                <input type="radio" name="data[Service][status]" value="0" required>Deactivate
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">

                                <input type="submit" name="submit" class="btn btn-success defult_btn" value="Save" id="submit">
                            </div> 
                            <div class="col-md-6">
                                <input type="reset" name="cancel" class="btn btn-default defult_btn" value="Cancel" id="cancel">
                            </div> 
                        </div>
                    <?php echo $this->Form->end(); ?>

                </div>
            </div>           
        </div>
    </div>
</div>

<script>
$('#cancel').click(function(){
	window.location.href = '<?php echo $this->webroot ?>users/services';
    //$('.form-control').attr('value', '');
});    
</script>
