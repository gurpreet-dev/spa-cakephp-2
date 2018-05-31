<style>
	table{
		width:100%;
		margin:0px;
	}
</style>

<section class="content-header">
      <h1>
      <?php if($user['User']['role'] == 'admin'){ ?>
      Admin Profile
      <?php }else{ ?>
      User Profile
      <?php } ?>
        
      </h1>
    </section>
<?php //echo "<pre>"; print_r($user); echo "</pre>"; ?>
<div class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="form_outer box">
			<table class="table table-bordered table-hover dataTable">
				<tr>
					<td>Id</td>
					<td><?php echo h($user['User']['id']); ?></td>
				</tr>
				<tr>
					<td>Role</td>
					<td><?php echo h($user['User']['role']); ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?php echo h($user['User']['first_name']); ?></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td><?php echo h($user['User']['gender']); ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo h($user['User']['username']); ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo h($user['User']['address']); ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><?php echo h($user['User']['phone']); ?></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td><?php echo h($user['User']['zip']); ?></td>
				</tr>
                <?php if($user['User']['role'] == 'freelancer'){ ?>
                <tr>
					<td>Sunday Timing</td>
					<td><?php
                    	if($user['User']['sunday_timing_from'] != '' && $user['User']['sunday_timing_to'] != ''){
                    echo h($user['User']['sunday_timing_from']).' to '.$user['User']['sunday_timing_to'];
                    }else{
                    	echo 'No Timings';
                    } ?></td>
				</tr>
                <tr>
					<td>Monday Timing</td>
					<td><?php
                    if($user['User']['monday_timing_from'] != '' && $user['User']['monday_timing_to'] != ''){
                     echo h($user['User']['monday_timing_from']).' to '.$user['User']['monday_timing_to'];}else{
                    	echo 'No Timings';
                    } ?></td>
				</tr>
                <tr>
					<td>Tuesday Timing</td>
					<td><?php
                    if($user['User']['tuesday_timing_from'] != '' && $user['User']['tuesday_timing_to'] != ''){
                    echo h($user['User']['tuesday_timing_from']).' to '.$user['User']['tuesday_timing_to'];}else{
                    	echo 'No Timings';
                    }  ?></td>
				</tr>
                <tr>
					<td>Wednesday Timing</td>
					<td><?php
                    if($user['User']['wednesday_timing_from'] != '' && $user['User']['wednesday_timing_to'] != ''){
                    echo h($user['User']['wednesday_timing_from']).' to '.$user['User']['wednesday_timing_to'];}else{
                    	echo 'No Timings';
                    }  ?></td>
				</tr>
                <tr>
					<td>Thursday Timing</td>
					<td><?php
                    if($user['User']['thursday_timing_from'] != '' && $user['User']['thursday_timing_to'] != ''){
                     echo h($user['User']['thursday_timing_from']).' to '.$user['User']['thursday_timing_to'];}else{
                    	echo 'No Timings';
                    } ?></td>
				</tr>
                <tr>
					<td>Friday Timing</td>
					<td><?php
                    if($user['User']['friday_timing_from'] != '' && $user['User']['friday_timing_to'] != ''){
                    echo h($user['User']['friday_timing_from']).' to '.$user['User']['friday_timing_to'];}else{
                    	echo 'No Timings';
                    } ?></td>
				</tr>
                <tr>
					<td>Saturday Timing</td>
					<td><?php
                     if($user['User']['saturday_timing_from'] != '' && $user['User']['saturday_timing_to'] != ''){
                    echo h($user['User']['saturday_timing_from']).' to '.$user['User']['saturday_timing_to'];}else{
                    	echo 'No Timings';
                    } ?></td>
				</tr>
                <?php } ?>
                                <tr>
					<td>Profile pic</td>
					<td>
                                            <?php if($user['User']['image']){ echo $this->Html->Image('/images/spa/users/' . h($user['User']['image']), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            
                                            }else{
                                                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            } ?>
                                            
                                            </td>
				</tr>
                <?php if($user['User']['role'] == 'freelancer'){ ?>
                <td>Banner Image</td>
					<td>
                                            <?php if(isset($user['User']['banner_img'])){ echo $this->Html->Image('/images/spa/banner/' . h($user['User']['banner_img']), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            
                                            }else{
                                                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            } ?>
                                            
                                            </td>
				</tr>
				<tr>
					<td>Icon Image</td>
					<td>
                                            <?php if(isset($user['User']['icon_img'])){ echo $this->Html->Image('/images/spa/icon/' . h($user['User']['icon_img']), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            
                                            }else{
                                                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            } ?>
                                            
                                            </td>
				</tr>
				<tr>
					<td>Gallery</td>
					<td>
                                            <?php
                                            if($user['User']['gallery_img'] != ''){
                                          $arr = explode(",",$user['User']['gallery_img']);
                                          
                                          	foreach ($arr as $val) {
                                             echo $this->Html->Image('/images/spa/gallery/' . h($val), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            
                                            }
                                          }else{
                                          	 echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                          }
                                             /*foreach ($arr as $val) {
                                             if(isset($val)){ echo $this->Html->Image('/images/spa/gallery/' . h($val), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            
                                            }else{
                                                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            }  }*/ ?>
                                            
                                            </td>
				</tr>
                
                <tr>
					<td>Documents</td>
					<td>
                    <?php 
                    	if($user['User']['attachments'] != ''){
                    		$documents = explode(',',$user['User']['attachments']);
                            
                            for($i=0; $i<count($documents); $i++){ ?>
                            	<u><em><a href="<?php echo $this->webroot ?>files/spa/users/<?php echo $documents[$i]; ?>" download><?php echo $documents[$i]; ?></a></em></u><br />
                            <?php
                            }
                                	
                        }else{
                        	echo 'No Documents Attached.';
                        }
                    ?>
                    </td>
				</tr>
                
                
                <?php } ?>
				<tr>
					<td>Active</td>
					<td><?php echo h($user['User']['active']); ?></td>
				</tr>
				<tr>
					<td>Created</td>
					<td><?php echo h($user['User']['created']); ?></td>
				</tr>
				<tr>
					<td>Modified</td>
					<td><?php echo h($user['User']['modified']); ?></td>
				</tr>
			</table>
            <?php if($user['User']['role'] == 'admin'){ ?>
			<?php echo $this->Html->link('Edit Profile', array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-success edit_pro')); ?>
            <?php echo $this->Html->link('Change Password', array('action' => 'password', $user['User']['id']), array('class' => 'btn btn-success edit_pro')); ?>
            <?php } ?>
		</div>
	</div>
</div>
</div>