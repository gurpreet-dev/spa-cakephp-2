

<div class="profile_section">
    
    <?php //echo "<pre>"; print_r($data); echo "</pre>"; exit();  ?>
    <?php if($data['User']['role']=="customer") { ?>
    <div class="globel_headding">
        <div class="title_text">Profile Setting</div>
    </div>
    <div class="container">
        <?php echo $this->Session->flash('success') ?>
        <form action="<?php echo $this->webroot; ?>users/edit" method="post" enctype="multipart/form-data">
        <div class="row">
        
            <div class="col-sm-8 col-sm-offset-2">
                <div class="border_all ">
                <div class="main_sign shift_grn">
            <div class="main_profile pro_grn">
                <div class="col-sm-4">
                    <div class="profile_image">
                        <h3>Account Detail</h3>
                        <?php if($data['User']['image'] != ''){ ?>
                        <img src="<?php echo $this->webroot; ?>images/spa/users/<?php echo $data['User']['image']; ?>" id="profile-blah">
                        <?php } else { ?>
                        <img src="<?php echo $this->webroot; ?>images/spa/no_image.jpg" id="profile-blah">
                        <?php } ?>
                        
                        <input type="file" name="data[User][profileimg]" accept="image/*">
                        
                    </div>
                </div>
                
                <div class="col-sm-8">
                    <div class="form_profile">
                        

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="data[User][email]" value="<?php echo $data['User']['email'] ?>" class="form-control radius_none" id="usr" disabled="disabled" required="required">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" name="data[User][role]" value="<?php echo $data['User']['role'] ?>" class="form-control radius_none" id="pwd" disabled="disabled" required="required">
                            <input type="hidden" name="data[User][role]" value="<?php echo $data['User']['role']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Paypal Email</label>
                                <input class="form-control radius_none" name="data[User][paypl_email]" value="<?php echo $data['User']['paypl_email']; ?>" id="usr" type="text" required="required">
                            </div>

                        
                    </div>
                </div>
            </div>
            <div class="general_cover gren_lwr">
                <div class="info_general">
                    <h3 class="gnrl_info paading_all">General Information</h3>
                </div>

                <div class="col-sm-6">                  
                   
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control radius_none" id="usr" name="data[User][first_name]" value="<?php echo $data['User']['first_name'] ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="data[User][last_name]" class="form-control radius_none" value="<?php echo $data['User']['last_name'] ?>" id="usr" required="required">
                        </div>

                        <div class="form-group">
                            <label>Zipcode</label>
                            <input type="text" name="data[User][zip]" value="<?php echo $data['User']['zip'] ?>" class="form-control radius_none" id="userzip" required="required">
                            
                            <input type="hidden" name="data[User][latitude]" value="<?php echo $data['User']['latitude'] ?>" class="form-control radius_none" id="userlat" required="required">
                            
                            <input type="hidden" name="data[User][longitude]" value="<?php echo $data['User']['longitude'] ?>" class="form-control radius_none" id="userlong" required="required">
                        </div>

                 
                </div>

                <div class="col-sm-6">                  
                 
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="text" name="data[User][birth]" value="<?php echo $data['User']['birth'] ?>" class="form-control radius_none"  id="datepicker" required="required">
                        </div>
                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="number" name="data[User][phone]" value="<?php echo $data['User']['phone'] ?>" class="form-control radius_none" id="pwd" required="required">
                        </div>
                    
                        <div class="form-group">
                            <label style="width: 100%; float: left;">Gender</label>
                            <div class="radio-inline">
                                <?php if($data['User']['gender'] == 'male'){ ?>
                                <input type="radio" name="data[User][gender]" value="male" checked="checked">Male
                                <?php }else{ ?>
                                <input type="radio" name="data[User][gender]" value="male">Male
                                <?php } ?>
                            </div>

                            <div class="radio-inline left_radio">
                                <?php if($data['User']['gender'] == 'female'){ ?>
                                <input type="radio" name="data[User][gender]" value="female" checked="checked">Female
                                <?php }else{ ?>
                                <input type="radio" name="data[User][gender]" value="female">Female
                                <?php } ?>
                            </div>
                        </div>
                    

                </div>



                <div class="col-sm-12">
                    
                        <div class="form-group">
                            <label for="comment">Address</label>
                            <textarea class="form-control" rows="5" id="comment" name="data[User][address]" required="required"><?php echo $data['User']['address']; ?></textarea>
                        </div>
                   
                    <input type="submit" class="btn btn-default fltr_colr left_sve" value="SUCCESSS" name="submit">
					</div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        </form>
    </div>  <?php } elseif ($data['User']['role']=="freelancer") { ?>
       <div class="container">
        <?php echo $this->Session->flash('success') ?>
       
        <form action="<?php echo $this->webroot; ?>users/edit" method="post" enctype="multipart/form-data">
            <div class="row">
            
            <div class="globel_headding">
    <div class="title_text">Profile Setting</div>
   </div>
                <div class="col-sm-8 col-sm-offset-2">
                <div class="border_all ">
                <div class="main_sign">
             
                    <div class="col-sm-4">
                    <h3 class="acc_sign">Account Detail</h3>
                        <div class="profile_image">    
                            <?php if($data['User']['image'] != ''){ ?>
                            <img src="<?php echo $this->webroot; ?>images/spa/users/<?php echo $data['User']['image']; ?>" id="profile-blah">
                            <?php }else{ ?>
                            <img src="<?php echo $this->webroot; ?>images/spa/no_image.jpg" id="profile-blah">
                            <?php } ?>
                           <!-- <img src="<?php echo $this->webroot; ?>images/spa/icon-camera.png" class="cam_icn">-->

                            <input type="file" name="data[User][profileimg]">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form_profile">
  
    <div class="form-group">
    <label>Email</label>
      <input class="form-control radius_none" id="usr" type="text" name="data[User][email]" value="<?php echo $data['User']['email']; ?>" disabled="disabled">
    </div>
    <input type="hidden" name="data[User][role]" value="<?php echo $data['User']['role']; ?>">
    <div class="form-group">
    <label>Role</label>
      <input class="form-control radius_none" name="data[User][role]" value="<?php echo $data['User']['role']; ?>" id="pwd" disabled="" type="text" required="required">
    </div>
    
                                </div>
                                </div>
                            </div>
                            <div class="general_up">
                            <div class="info_general">
                                        <h3 class="gnrl_info">General Information</h3>
                                        </div>
                                        
                                <div class="col-sm-12">                  
                             
                       <div class="form-group col-sm-6">
                        <label> Designation</label>
      <input class="form-control radius_none" name="data[User][designation]" value="<?php echo $data['User']['designation']; ?>" id="usr" type="text" required="required">
                                </div>
                        <div class="form-group col-sm-6">
                        <label>Paypal Email</label>
      <input class="form-control radius_none" name="data[User][paypl_email]" value="<?php echo $data['User']['paypl_email']; ?>" id="usr" type="text" required="required">
                                </div>
            
                        <div class="form-group col-sm-6">
                        <label>Date of Birth</label>
                        <input class="form-control radius_none" name="data[User][birth]"  value="<?php echo $data['User']['birth']; ?>" type="text" id="datepicker" required="required">
                        </div>
                        <div class="form-group col-sm-6">
                        <label>Phone number</label>
                          <input class="form-control radius_none" name="data[User][phone]" value="<?php echo $data['User']['phone']; ?>" id="pwd" type="number" required="required">
                               </div>
                             
                          
                                  <div class="form-group col-sm-6">
                                      <label style="width: 100%; float: left;">Gender</label>
                                   <div class="radio-inline">
                                       <input name="data[User][gender]" value="male" <?php if($data['User']['gender']=="male"){ echo " checked"; } ?> type="radio" required="required">Male
                                       </div>
                                       
                                    <div class="radio-inline left_radio">
                                      <input name="data[User][gender]" value="female" <?php if($data['User']['gender']=="female"){ echo " checked"; } ?> type="radio" required="required">Female
                                    </div>
                                </div>
                                
                                           <div class="store_setting">
                                   <div class="info_general">
                                        <h3>Location Setting</h3>
                                        </div>
                                  
                                    <div class="form-group col-sm-6">
                        <label> Store Name</label>
      <input class="form-control radius_none" name="data[User][store_name]" value="<?php echo $data['User']['store_name']; ?>" id="usr" type="text" required="required">
                                </div>
                                 <div class="form-group col-sm-6">
                        <label> Location (city)</label>
      <input class="form-control radius_none" id="usr" value="<?php echo $data['User']['location']; ?>" name="data[User][location]" type="text" required="required">
                                </div>
                                
                                <div class="form-group col-sm-6">
                                <label>Postcode</label>
                                <input class="form-control radius_none" name="data[User][zip]" value="<?php echo $data['User']['zip']; ?>" id="userzip" type="text" required="required">
                                
                                <input type="hidden" name="data[User][latitude]" value="<?php echo $data['User']['latitude'] ?>" class="form-control radius_none" id="userlat" required="required">
                            
                            <input type="hidden" name="data[User][longitude]" value="<?php echo $data['User']['longitude'] ?>" class="form-control radius_none" id="userlong" required="required">
                                
                                </div>
                                               
                                <div class="form-group col-sm-6">
                                <label>Full address</label>
                                <textarea class="form-control radius_none" name="data[User][address]" required="required"><?php echo $data['User']['address']; ?></textarea>
                                </div>
                                
                                      
                                   <div class="form-group">
                                      <div class="col-sm-12">
                                      
                                      <div class="info_general">
                                        <h3 class="work_left">Working Hours</h3>
                                        </div>                                    
                                      </div>
                                   </div>
                                   
                                   <div class="form_mainouter">
                                   
                                    <!-- Monday timings -->           
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Monday</label>
                                      <div class="col-sm-10">
                                      	<?php if($data['User']['monday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="monday_timing" data-id="monday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="monday_timing" data-id="monday_timing" />
                                          <?php } ?>
                                         <?php
                                            $monday_hour_from = explode(':', $data['User']['monday_timing_from']);
                                            $monday_hour_from_ampm = explode(' ', $data['User']['monday_timing_from']);
                                            
                                            $monday_hour_to = explode(':', $data['User']['monday_timing_to']);
                                            $monday_hour_to_ampm = explode(' ', $data['User']['monday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][monday_hour_from]" class="monday_timing">
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
                                         <select name="data[User][monday_minute_from]" class="monday_timing">
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
                                         <select name="data[User][monday_ampm_from]" class="monday_timing">
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
                                          
                                         </select> <span class="too">To</span>
                                         <select name="data[User][monday_hour_to]" class="monday_timing">
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
                                         <select name="data[User][monday_minute_to]" class="monday_timing">
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
                                         <select name="data[User][monday_ampm_to]" class="monday_timing">
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
                                      <div class="col-sm-10">
                                          <?php if($data['User']['tuesday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="tuesday_timing" data-id="tuesday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="tuesday_timing" data-id="tuesday_timing" />
                                          <?php } ?>
                                         <?php
                                            $tuesday_hour_from = explode(':', $data['User']['tuesday_timing_from']);
                                            $tuesday_hour_from_ampm = explode(' ', $data['User']['tuesday_timing_from']);
                                            
                                            $tuesday_hour_to = explode(':', $data['User']['tuesday_timing_to']);
                                            $tuesday_hour_to_ampm = explode(' ', $data['User']['tuesday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][tuesday_hour_from]" class="tuesday_timing">
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
                                         <select name="data[User][tuesday_minute_from]" class="tuesday_timing">
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
                                         <select name="data[User][tuesday_ampm_from]" class="tuesday_timing">
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
                                          
                                         </select> <span class="too">To</span>
                                         <select name="data[User][tuesday_hour_to]" class="tuesday_timing">
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
                                         <select name="data[User][tuesday_minute_to]" class="tuesday_timing">
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
                                         <select name="data[User][tuesday_ampm_to]" class="tuesday_timing">
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
                                      <div class="col-sm-10">
                                          <?php if($data['User']['wednesday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="wednesday_timing" data-id="wednesday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="wednesday_timing" data-id="wednesday_timing" />
                                          <?php } ?>
                                         <?php
                                            $wednesday_hour_from = explode(':', $data['User']['wednesday_timing_from']);
                                            $wednesday_hour_from_ampm = explode(' ', $data['User']['wednesday_timing_from']);
                                            
                                            $wednesday_hour_to = explode(':', $data['User']['wednesday_timing_to']);
                                            $wednesday_hour_to_ampm = explode(' ', $data['User']['wednesday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][wednesday_hour_from]" class="wednesday_timing">
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
                                         <select name="data[User][wednesday_minute_from]" class="wednesday_timing">
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
                                         <select name="data[User][wednesday_ampm_from]" class="wednesday_timing">
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
                                          
                                         </select> <span class="too">To</span>
                                         <select name="data[User][wednesday_hour_to]" class="wednesday_timing">
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
                                         <select name="data[User][wednesday_minute_to]" class="wednesday_timing">
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
                                         <select name="data[User][wednesday_ampm_to]" class="wednesday_timing">
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
                                      <div class="col-sm-10">
                                           <?php if($data['User']['thursday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="thursday_timing" data-id="thursday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="thursday_timing" data-id="thursday_timing" />
                                          <?php } ?>
                                         <?php
                                            $thursday_hour_from = explode(':', $data['User']['thursday_timing_from']);
                                            $thursday_hour_from_ampm = explode(' ', $data['User']['thursday_timing_from']);
                                            
                                            $thursday_hour_to = explode(':', $data['User']['thursday_timing_to']);
                                            $thursday_hour_to_ampm = explode(' ', $data['User']['thursday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][thursday_hour_from]" class="thursday_timing">
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
                                         <select name="data[User][thursday_minute_from]" class="thursday_timing">
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
                                         <select name="data[User][thursday_ampm_from]" class="thursday_timing">
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
                                          
                                         </select> <span class="too">To</span>
                                         <select name="data[User][thursday_hour_to]" class="thursday_timing">
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
                                         <select name="data[User][thursday_minute_to]" class="thursday_timing">
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
                                         <select name="data[User][thursday_ampm_to]" class="thursday_timing">
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
                                      <div class="col-sm-10">
                                          <?php if($data['User']['friday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="friday_timing" data-id="friday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="friday_timing" data-id="friday_timing" />
                                          <?php } ?>
                                         <?php
                                            $friday_hour_from = explode(':', $data['User']['friday_timing_from']);
                                            $friday_hour_from_ampm = explode(' ', $data['User']['friday_timing_from']);
                                            
                                            $friday_hour_to = explode(':', $data['User']['friday_timing_to']);
                                            $friday_hour_to_ampm = explode(' ', $data['User']['friday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][friday_hour_from]" class="friday_timing">
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
                                         <select name="data[User][friday_minute_from]" class="friday_timing">
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
                                         <select name="data[User][friday_ampm_from]" class="friday_timing">
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
                                          
                                         </select> <span class="too">To</span>
                                         <select name="data[User][friday_hour_to]" class="friday_timing">
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
                                         <select name="data[User][friday_minute_to]" class="friday_timing">
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
                                         <select name="data[User][friday_ampm_to]" class="friday_timing">
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
                                      <div class="col-sm-10">
                                           <?php if($data['User']['saturday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="saturday_timing" data-id="saturday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="saturday_timing" data-id="saturday_timing" />
                                          <?php } ?>
                                         <?php
                                            $saturday_hour_from = explode(':', $data['User']['saturday_timing_from']);
                                            $saturday_hour_from_ampm = explode(' ', $data['User']['saturday_timing_from']);
                                            
                                            $saturday_hour_to = explode(':', $data['User']['saturday_timing_to']);
                                            $saturday_hour_to_ampm = explode(' ', $data['User']['saturday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][saturday_hour_from]" class="saturday_timing">
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
                                         <select name="data[User][saturday_minute_from]" class="saturday_timing">
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
                                         <select name="data[User][saturday_ampm_from]" class="saturday_timing">
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
                                          
                                         </select>  <span class="too">To</span>
                                         <select name="data[User][saturday_hour_to]" class="saturday_timing">
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
                                         <select name="data[User][saturday_minute_to]" class="saturday_timing">
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
                                         <select name="data[User][saturday_ampm_to]" class="saturday_timing">
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
                                      <div class="col-sm-10">
                                          <?php if($data['User']['sunday_timing_from'] != ''){ ?>
                                      		<input type="checkbox" name="sunday_timing" data-id="sunday_timing" checked="checked"/>
                                          <?php }else{ ?>
                                          <input type="checkbox" name="sunday_timing" data-id="sunday_timing" />
                                          <?php } ?>
                                         <?php
                                            $sunday_hour_from = explode(':', $data['User']['sunday_timing_from']);
                                            $sunday_hour_from_ampm = explode(' ', $data['User']['sunday_timing_from']);
                                            
                                            $sunday_hour_to = explode(':', $data['User']['sunday_timing_to']);
                                            $sunday_hour_to_ampm = explode(' ', $data['User']['sunday_timing_to']);
                                         ?>
                                          
                                         <select name="data[User][sunday_hour_from]" class="sunday_timing">
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
                                         <select name="data[User][sunday_minute_from]" class="sunday_timing">
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
                                         <select name="data[User][sunday_ampm_from]" class="sunday_timing">
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
                                          
                                         </select> <span class="too">To</span>
                                         <select name="data[User][sunday_hour_to]" class="sunday_timing">
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
                                         <select name="data[User][sunday_minute_to]" class="sunday_timing">
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
                                         <select name="data[User][sunday_ampm_to]" class="sunday_timing">
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
                                    </div>
                                    <!-- sunday timings (End) -->
                                      
                                 <div class="form-group">
                          <label class="lower_about" for="comment">About</label>
                          <textarea class="form-control" name="data[User][about]" rows="5" id="comment" required="required"> <?php echo $data['User']['about']; ?></textarea>
                        </div>
                        
                        
                                    <div class="col-md-12">            
                        <div class="image_get col-sm-6" style="padding-left:0px;">
                            <h4>Banner Image <span style="font-size:14px; font-weight:700;">(Best&nbsp376*250)</span></h4>
                            <span class="btn btn-default btn-file right_load upload_pic">
                                <h4 class="load_img">
                                    <img src="<?php echo $this->webroot; ?>images/spa/10.png">
<!--                                    <img src="#" alt="Preview" width="70" height="24"  id="blah"> --> Upload Image</h4>
                                <input type="file" id="FilePhoto" name="data[User][banner]">
                            </span>
                            
                            <?php if($data['User']['banner_img'] != ''){ ?>
                            <img src="<?php echo $this->webroot; ?>images/spa/banner/<?php echo $data['User']['banner_img']; ?>" id="blah">
                            <?php } ?>
                          </div>
                                      
                        <div class="image_get col-sm-6">
                            <h4>Icon</h4>
                            <div class="cover_icon">
                            <span class="btn btn-default btn-file right_load icon_load">
                                <h4 class="load_img">
                                    <img src="<?php echo $this->webroot; ?>images/spa/11.png">
<!--                                    <img src="#" id="blahicon" alt="Preview" width="70" height="24">--> Upload Image</h4> 
                              <input type="file" id="FilePhotoicon" name="data[User][icon]" onchange="readURLicon(this)">
                            </span>
                            </div>
                            <?php if($data['User']['icon_img'] != ''){ ?>
                            <img src="<?php echo $this->webroot; ?>images/spa/icon/<?php echo $data['User']['icon_img']; ?>" id="blahicon">
                            <?php } ?>
                        </div>
                                    </div>
                                               
                        <div class="image_get col-sm-12">
                            <h4 class="galery_load">Gallery</h4>
                            <span class="btn btn-default btn-file right_load1">
                                <h4 class="load_img">
                                    <img src="<?php echo $this->webroot; ?>images/spa/10.png">
<!--                                    <img src="#" class="blahgallery" alt="Preview" width="70" height="24">--> Upload Image</h4> 
                                <input type="file" id="FilePhotogallery" name="data[User][gallery][]" onchange="readURLgallery(this)" multiple>
                            </span>
                            <div class="cover_galery">
                            <div class="row">
                            
                            <?php if($data['User']['gallery_img'] != ''){
                                
                                $images = explode(',', $data['User']['gallery_img']);
                                
                                foreach($images as $image){ 
                            ?>
                                <div class="col-md-3">
                                 <div class="root_img">
                                    <img src="<?php echo $this->webroot; ?>images/spa/gallery/<?php echo $image; ?>">
                                </div>
                               </div>
                            <?php } ?>
                            <?php } ?>
                            </div>
                           </div>
                        </div>
                                      
                                        </div>
                                      <div class="form-group col-sm-12">
                        <input type="submit" class="btn btn-default fltr_colr left_sve" value="SAVE" name="submit">
                        
                         </div>
                         </div>
                       </div>
                  </div>
               </div>
            </div>
            </form>
          </div>
   <?php } ?>
</div>

<script>
    $(function () {
        $('#datepicker').datepicker({ dateFormat: 'dd/mm/yy', maxDate: 0 });
    });
    
     function readURLbanner(input) {

           if (input.files && input.files[0]) {

               var reader = new FileReader();

               reader.onload = function(e) {
                   
                   if (!$('#blah').length > 0) {
                        $('#FilePhoto').parent().parent().append('<img src="" id="blah">');
                    }
                   

                   $('#blah').attr('src', e.target.result);

               }

               reader.readAsDataURL(input.files[0]);

           }

       }

       $("#FilePhoto").change(function() {
           readURLbanner(this);

       });
       
       
       
       function readURLicon(input) {

           if (input.files && input.files[0]) {

               var reader = new FileReader();

               reader.onload = function(e) {
                   
                   if (!$('#blahicon').length > 0) {
                        $('#FilePhotoicon').parent().parent().append('<img src="" id="blahicon">');
                    }

                   $('#blahicon').attr('src', e.target.result);

               }

               reader.readAsDataURL(input.files[0]);

           }

       }

       $("#FilePhotoicon").change(function() {

           readURLicon(this);

       });
       function readURLgallery(input) {

           if (input.files && input.files[0]) {

               var reader = new FileReader();

               reader.onload = function(e) {

                   $('.blahgallery').attr('src', e.target.result);

               }

               reader.readAsDataURL(input.files[0]);

           }

       }

       $("#FilePhotogallery").change(function() {

           readURLgallery(this);

       });
       
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("input[name='data[User][profileimg]']").change(function(){
            readURL(this);
        });
        
		
		$('#userzip').keyup(function(){
			var value = $(this).val();
			var data = {
				value:value
			}
			
			$.ajax({
			   url: '<?php echo $this->webroot ?>users/ajaxgetLatLong',
			   data: data,
			   method: 'post',
			   dataType: 'json',
			   success: function(json){
		
					console.log(json);
					
					$('#userlat').val(json.lat);
					$('#userlong').val(json.lng);
					
				}
			});
			
		}); 
        

</script>