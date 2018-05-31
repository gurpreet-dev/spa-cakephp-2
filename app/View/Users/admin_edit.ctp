
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
	.btn.btn-primary.main_btn {
    margin-top: 15px;
}
</style>
<div class="box-header with-border">
			<h3 class="box-title">Edit User Details</h3>
		</div>

<section class="content">
<div class="row">
    <div class="col-sm-6">
		<div class="box">
		
			<?php echo $this->Form->create('User',array('type'=>'file'));?>
			<div class="box-body">  
			<?php echo $this->Form->input('id'); ?>
			<?php if($loggedUserRole != 'rest_admin'){
			   echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('admin' => 'admin', 'customer' => 'customer','freelancer'=>'Freelancer'), 'disabled')); 
			} else {
				echo $this->Form->input('role', array('class' => 'form-control', 'options' => array('rest_admin'=>'Store admin')));
			} ?>
			
			<?php echo $this->Form->input('username', array('class' => 'form-control','label'=>'Email', 'disabled' => 'disabled')); ?>
            
            
            <?php if($user['User']['role']=="customer" || $user['User']['role']=="admin") {   ?>
            	<?php echo $this->Form->input('first_name', array('class' => 'form-control')); ?>
                <?php echo $this->Form->input('last_name', array('class' => 'form-control')); ?>
                <label>Gender</label>
                <input name="data[User][gender]" value="male" <?php if($user['User']['gender']=="male"){ echo " checked"; } ?> type="radio" required="required">Male
                
                <input name="data[User][gender]" value="female" <?php if($user['User']['gender']=="female"){ echo " checked"; } ?> type="radio" required="required">Female  
                
                <label class="brth_full">Date of Birth</label>
                <input type="text" name="data[User][birth]" value="<?php echo $user['User']['birth'] ?>" class="form-control radius_none"  id="datepicker" required="required">  
                
                <?php 
                echo $this->Form->input('zip',array('class' => 'form-control', 'label' =>'Pin code'));
                echo $this->Form->input('address',array('type'=>'textarea', 'class' => 'form-control', 'label' =>'Full address')); ?>
               
           
             <?php } ?>
             
            <label>Phone</label>
            <input type="text" name="data[User][phone]" value="<?php echo $user['User']['phone'] ?>" class="form-control radius_none"  required="required">
             
             
             <?php if($user['User']['role']=="freelancer") { 

            	echo $this->Form->input('designation', array('class' => 'form-control','label'=>'Designation'));
            	echo $this->Form->input('paypl_email', array('class' => 'form-control','label'=>'Paypal email'));
            	echo $this->Form->input('store_name', array('class' => 'form-control','label'=>'Store Name'));
            	echo $this->Form->input('location', array('class' => 'form-control','label'=>'Location'));
            	echo $this->Form->input('zip',array('class' => 'form-control', 'label' =>'Pin code'));
            	echo $this->Form->input('address',array('type'=>'textarea', 'class' => 'form-control', 'label' =>'Full address'));
            	echo $this->Form->input('about',array('class' => 'form-control', 'label' =>'About')); ?>
            	<label>Date of Birth</label>
                            <input type="text" name="data[User][birth]" value="<?php echo $user['User']['birth'] ?>" class="form-control radius_none"  id="datepicker" required="required">
            	 Gender
                                       <input name="data[User][gender]" value="male" <?php if($user['User']['gender']=="male"){ echo " checked"; } ?> type="radio" required="required">Male
                                      
                                      <input name="data[User][gender]" value="female" <?php if($user['User']['gender']=="female"){ echo " checked"; } ?> type="radio" required="required">Female
            		 <div class="form-group">
                                      <div class="col-sm-12">
                                      <label>Working Hour</label>                                       
                                      </div>
                                   </div>
                                   
                                    <!-- Monday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Monday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $monday_hour_from = explode(':', $user['User']['monday_timing_from']);
                                            $monday_hour_from_ampm = explode(' ', $user['User']['monday_timing_from']);
                                            
                                            $monday_hour_to = explode(':', $user['User']['monday_timing_to']);
                                            $monday_hour_to_ampm = explode(' ', $user['User']['monday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][monday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($monday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][monday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($monday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][monday_ampm_from]" required="required">
                                            <?php if($monday_hour_from_ampm[1] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($monday_hour_from_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][monday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($monday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][monday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($monday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][monday_ampm_to]" required="required">
                                            <?php if($monday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($monday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- Monday timings (End) -->
                                    
                                    <!-- Tuesday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Tuesday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $tuesday_hour_from = explode(':', $user['User']['tuesday_timing_from']);
                                            $tuesday_hour_from_ampm = explode(' ', $user['User']['tuesday_timing_from']);
                                            
                                            $tuesday_hour_to = explode(':', $user['User']['tuesday_timing_to']);
                                            $tuesday_hour_to_ampm = explode(' ', $user['User']['tuesday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][tuesday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($tuesday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][tuesday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($tuesday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][tuesday_ampm_from]" required="required">
                                            <?php if($tuesday_hour_from_ampm[0] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($tuesday_hour_from_ampm[0] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][tuesday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($tuesday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][tuesday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($tuesday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][tuesday_ampm_to]" required="required">
                                            <?php if($tuesday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($tuesday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- Tuesday timings (End) -->
                                    
                                    <!-- wednesday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Wednesday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $wednesday_hour_from = explode(':', $user['User']['wednesday_timing_from']);
                                            $wednesday_hour_from_ampm = explode(' ', $user['User']['wednesday_timing_from']);
                                            
                                            $wednesday_hour_to = explode(':', $user['User']['wednesday_timing_to']);
                                            $wednesday_hour_to_ampm = explode(' ', $user['User']['wednesday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][wednesday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($wednesday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][wednesday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($wednesday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][wednesday_ampm_from]" required="required">
                                            <?php if($wednesday_hour_from_ampm[0] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($wednesday_hour_from_ampm[0] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][wednesday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($wednesday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][wednesday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($wednesday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][wednesday_ampm_to]" required="required">
                                            <?php if($wednesday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($wednesday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- wednesday timings (End) -->
                                    
                                    <!-- thursday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Thursday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $thursday_hour_from = explode(':', $user['User']['thursday_timing_from']);
                                            $thursday_hour_from_ampm = explode(' ', $user['User']['thursday_timing_from']);
                                            
                                            $thursday_hour_to = explode(':', $user['User']['thursday_timing_to']);
                                            $thursday_hour_to_ampm = explode(' ', $user['User']['thursday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][thursday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($thursday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][thursday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($thursday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][thursday_ampm_from]" required="required">
                                            <?php if($thursday_hour_from_ampm[0] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($thursday_hour_from_ampm[0] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][thursday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($thursday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][thursday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($thursday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][thursday_ampm_to]" required="required">
                                            <?php if($thursday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($thursday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- thursday timings (End) -->
                                    
                                    <!-- friday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Friday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $friday_hour_from = explode(':', $user['User']['friday_timing_from']);
                                            $friday_hour_from_ampm = explode(' ', $user['User']['friday_timing_from']);
                                            
                                            $friday_hour_to = explode(':', $user['User']['friday_timing_to']);
                                            $friday_hour_to_ampm = explode(' ', $user['User']['friday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][friday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($friday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][friday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($friday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][friday_ampm_from]" required="required">
                                            <?php if($friday_hour_from_ampm[0] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($friday_hour_from_ampm[0] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][friday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($friday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][friday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($friday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][friday_ampm_to]" required="required">
                                            <?php if($friday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($friday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- friday timings (End) -->
                                    
                                    <!-- saturday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Saturday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $saturday_hour_from = explode(':', $user['User']['saturday_timing_from']);
                                            $saturday_hour_from_ampm = explode(' ', $user['User']['saturday_timing_from']);
                                            
                                            $saturday_hour_to = explode(':', $user['User']['saturday_timing_to']);
                                            $saturday_hour_to_ampm = explode(' ', $user['User']['saturday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][saturday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($saturday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][saturday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($saturday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][saturday_ampm_from]" required="required">
                                            <?php if($saturday_hour_from_ampm[0] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($saturday_hour_from_ampm[0] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][saturday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($saturday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][saturday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($saturday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][saturday_ampm_to]" required="required">
                                            <?php if($saturday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($saturday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- saturday timings (End) -->
                                    
                                    <!-- sunday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Sunday</label>
                                      <div class="col-sm-4">
                                          
                                         <?php
                                            $sunday_hour_from = explode(':', $user['User']['sunday_timing_from']);
                                            $sunday_hour_from_ampm = explode(' ', $user['User']['sunday_timing_from']);
                                            
                                            $sunday_hour_to = explode(':', $user['User']['sunday_timing_to']);
                                            $sunday_hour_to_ampm = explode(' ', $user['User']['sunday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][sunday_hour_from]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($sunday_hour_from[0] == $i+1){ ?>    
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][sunday_minute_from]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($sunday_hour_from[1] == $count){ ?> 
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][sunday_ampm_from]" required="required">
                                            <?php if($sunday_hour_from_ampm[0] == 'am'){ ?>
                                             <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($sunday_hour_from_ampm[0] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> --
                                         <select name="data[User][sunday_hour_to]" required="required">
                                            <optgroup label="Hours">
                                            <?php for($i=0;$i<12;$i++){ ?>
                                            <?php if($sunday_hour_to[0] == $i+1){ ?>
                                                <option value="<?php echo sprintf('%02d', $i+1); ?>" selected="selected"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                            <?php } ?>
                                            <?php } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][sunday_minute_to]" required="required">
                                            <optgroup label="Minutes">
                                            <?php
                                            $count = 0;
                                            for($i=0;$i<4;$i++){ ?>
                                            <?php if($sunday_hour_to[1] == $count){ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>" selected="selected"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo sprintf('%02d', $count); ?>"><?php echo sprintf('%02d', $count); ?></option>
                                            <?php } ?>
                                            <?php
                                            $count = $count+15;
                                            } ?> 
                                            </optgroup>
                                         </select> 
                                         <select name="data[User][sunday_ampm_to]" required="required">
                                            <?php if($sunday_hour_to_ampm[1] == 'am'){ ?>
                                            <option value="am" selected="selected">AM</option>
                                            <?php }else{ ?>
                                            <option value="am">AM</option>
                                            <?php } ?>
                                            <?php if($sunday_hour_to_ampm[1] == 'pm'){ ?>
                                            <option value="pm" selected="selected">PM</option>
                                            <?php }else{ ?>
                                            <option value="pm">PM</option>
                                            <?php } ?>
                                          
                                         </select> 
                                        <!-- <input class="form-control" id="focusedInput" value="Click to focus..." type="text" required="required"> -->
                                      </div>
                                    </div>
                                    <!-- sunday timings (End) -->
                 <hr>                     
                <?php
                if($user['User']['icon_img']){
                echo $this->Html->Image('/images/spa/icon/' . $user['User']['icon_img'], array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image'));
                }else{
                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image'));
                }
                echo $this->Form->input('icon', array('type' => 'file', 'class' => 'form-control padng11')); 
                ?>
                
                <hr>
                
                <?php
                if($user['User']['banner_img']){
                echo $this->Html->Image('/images/spa/banner/' . $user['User']['banner_img'], array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image'));
                }else{
                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image'));
                }
                echo $this->Form->input('banner', array('type' => 'file', 'class' => 'form-control padng11')); 
                } ?>                    
                
                <hr>
                
                
                
                <hr />
                
                <?php if($user['User']['gallery_img']){
                	$gallery = explode(',', $user['User']['gallery_img']);
                    
                    foreach($gallery as $image){ ?>
                    
                    <div class="col-md-4">
                    	<?php echo $this->Html->Image('/images/spa/gallery/' . $image, array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image')); ?>
                    </div>
                    
                    
                    <?php }
                    
                } ?>
                
                <?php if($user['User']['role'] == 'freelancer'){ ?>
                <div class="input file">
                <label>Gallery Images</label>
                <input type="file" class="form-control" name="data[User][gallery][]" multiple />
                </div>
                <?php } ?>
                
                 <label>Profile Pic</label>
                <input type="file" name="data[User][image]" class="form-control radius_none">  
                
                <div class="input file">
                <?php if($user['User']['image']){
                echo $this->Html->Image('/images/spa/users/' . $user['User']['image'], array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image'));
                }else{
                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 150, 'height' => 150, 'alt' => 'image not found', 'class' => 'image'));
                }
                ?>
                </div>   
                <?php echo $this->Form->input('role', array('type' => 'hidden')); ?>
			<?php //echo $this->Form->input('active', array('type' => 'checkbox','class'=>'activecheckbox main_btn')); ?>
			<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn')); ?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
    </div>
</div>
</section>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>