
<div class="profile_section">
    <div class="globel_headding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title_text">My Account</div>
				</div>
			</div>
		</div>
    </div>
	
	<?php if($user['User']['role'] == 'freelancer'){ ?>
	<div class="profile_sec">
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="padding:0px;">
					<div class="col-md-4 col-sm-4">
						<div class="profile-wrap imge_set">
							<?php if($user['User']['banner_img'] != ''){ ?>
								<img src="<?php echo $this->webroot; ?>images/spa/banner/<?php echo $user['User']['banner_img']; ?>">
                            <?php } else { ?>
								No Banner Image
                            <?php } ?>
							<div class="icon-wrap rap_con">
								<?php if($user['User']['icon_img'] != ''){ ?>
									<img src="<?php echo $this->webroot; ?>images/spa/icon/<?php echo $user['User']['icon_img']; ?>">
								<?php } else { ?>
									No Icon Image
								<?php } ?>
							</div>
						</div>
					</div><!-- End Here -->
					      
					<div class="col-md-8 col-sm-8">
						<!--div id="myCarousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php
								if($user['User']['gallery_img'] != ''){
									$images = explode(',', $user['User']['gallery_img']);
									$i = 1;
									foreach($images as $image){ 
								?>
								<div class="item<?php echo ($i == 1) ? ' active' : '' ?>">
									<img src="<?php echo $this->webroot; ?>images/spa/gallery/<?php echo $image; ?>">
								</div>
								<?php
								$i++;
								} ?>
								<?php } ?>
                                
                                 <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                 <a class="next" onclick="plusSlides(1)">&#10095;</a>
							</div>
						</div-->
                        
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
  <!-- <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>-->

    <!-- Wrapper for slides -->
    <?php if($user['User']['gallery_img'] != ''){ ?>
    <div class="carousel-inner">
        <?php
        $images = explode(',', $user['User']['gallery_img']);
        $i = 1;
        foreach($images as $image){ 
        ?>
        <div class="item<?php echo ($i == 1) ? ' active' : '' ?>">
        <img src="<?php echo $this->webroot; ?>images/spa/gallery/<?php echo $image; ?>">
        </div>
        <?php
        $i++;
        } ?>
        
        </div>
    
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
 	<?php }else{ ?>
    	<span>No Gallery Images Found</span>
    <?php } ?>                 
                        
                        
                        
                        
                        
                        
                        
					</div> <!-- Slide End Here -->
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
<div class="container">
	<div class="row">
    	<div class="col-md-8 col-md-offset-2">
        	<div class="table-responsive">          
                <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>Profile Pic</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['image'] != ''){ ?>
                            <img src="<?php echo $this->webroot; ?>images/spa/users/<?php echo $user['User']['image']; ?>">
                            <?php } else { ?>
                            <img src="<?php echo $this->webroot; ?>images/spa/no_image.jpg">
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>First Name</strong></td>
                            <td class="text-left"><?php echo $user['User']['first_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Last Name</strong></td>
                            <td class="text-left"><?php echo $user['User']['last_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Role</strong></td>
                            <td class="text-left"><?php echo ucwords($user['User']['role']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Email</strong></td>
                            <td class="text-left"><?php echo $user['User']['email']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Paypal Email</strong></td>
                            <td class="text-left"><?php echo $user['User']['paypl_email']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Phone</strong></td>
                            <td class="text-left"><?php echo $user['User']['phone']; ?></td>
                        </tr>
                        
                        <?php if($user['User']['role'] != 'freelancer'){ ?>
                        <tr>
                            <td class="text-left"><strong>Postcode</strong></td>
                            <td class="text-left"><?php echo $user['User']['zip']; ?></td>
                        </tr>
                        <?php } ?>
                        
                        <tr>
                            <td class="text-left"><strong>Gender</strong></td>
                            <td class="text-left"><?php echo ucwords($user['User']['gender']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>DOB</strong></td>
                            <td class="text-left"><?php echo $user['User']['birth']; ?></td>
                        </tr>
                        <?php if($user['User']['role'] != 'freelancer'){ ?>
                        <tr>
                            <td class="text-left"><strong>Address</strong></td>
                            <td class="text-left"><?php echo $user['User']['address']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <?php if($user['User']['role'] == 'freelancer'){ ?>
                <h1 class="locte_sze">Location Setting</h1>
                <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>Store Name</strong></td>
                            <td class="text-left"><?php echo $user['User']['store_name'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Location (city)</strong></td>
                            <td class="text-left"><?php echo $user['User']['location'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Postcode</strong></td>
                            <td class="text-left"><?php echo $user['User']['zip'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Full Address</strong></td>
                            <td class="text-left"><?php echo $user['User']['address'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php } ?>
                
                <?php if($user['User']['role'] == 'freelancer'){ ?>
                <h1 class="locte_sze">Working hours</h1>
                <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>Sunday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['sunday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['sunday_timing_from'] ?> to <?php echo $user['User']['sunday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Monday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['monday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['monday_timing_from'] ?> to <?php echo $user['User']['monday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Tuesday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['tuesday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['tuesday_timing_from'] ?> to <?php echo $user['User']['tuesday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Wednesday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['wednesday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['wednesday_timing_from'] ?> to <?php echo $user['User']['wednesday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Thursday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['thursday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['thursday_timing_from'] ?> to <?php echo $user['User']['thursday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Friday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['friday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['friday_timing_from'] ?> to <?php echo $user['User']['friday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>Saturday</strong></td>
                            <td class="text-left">
                            <?php if($user['User']['saturday_timing_from'] != ''){ ?>
                            <?php echo $user['User']['saturday_timing_from'] ?> to <?php echo $user['User']['saturday_timing_to'] ?>
                            <?php }else{ ?>
                            Non Working   
                            <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <table class="table table-striped table-bordered table-hover table-condensed table-responsive">
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>About</strong></td>
                            <td class="text-left"><?php echo $user['User']['about'] ?></td>
                        </tr>
                     </tbody>
                 </table>                 
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>


<!-------java script------->
