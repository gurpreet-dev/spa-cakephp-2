<div class="long_section">
  <div class="container">
    <div class="row">
      <div class="aboutus-home">
        <div class="aboutus-home-box">
          <div class="col-sm-2">
            <div class="aboutus-home-box1">
              <h1> How MTH works </h1>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="col-sm-3">
              <div class="aboutus-home-box2"> <img src="<?php echo $this->webroot; ?>images/spa/service.png" alt="service" class="img-responsive">
                <h2 class="service_text"> <span>Select Services</span><br>
                  Choose from a wide range of services. </h2>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="aboutus-home-box3"> <img src="<?php echo $this->webroot; ?>images/spa/date.png" alt="date icon image" class="img-responsive">
                <h2 class="service_text1"> <span>Pick Date and Time</span><br>
                  Book Treatment/Classes at your convenience, anytime and anywhere in London. </h2>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="aboutus-home-box4"> <img src="<?php echo $this->webroot; ?>images/spa/receive.png" alt="recieve" class="img-responsive">
                <h2> <span>Receive Confirmation</span><br>
                  Upon booking, you'll immediately receive confirmation with relevant details. </h2>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="aboutus-home-box5"> <img src="<?php echo $this->webroot; ?>images/spa/enjoy.png" alt="pamper yourself" class="img-responsive">
                <h2> <span>Enjoy the Experience</span><br>
                  Relax and enjoy because, you deserve it. </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div><!-- End Here -->
<?php if(!empty($recommendations)){ ?>
<section class="rocomend_sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="globel_headding">
					<h1 class="title_text">Recommended For You</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="recomend_inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="recomend_slider">
                    
                    	<?php foreach($recommendations as $rec){ ?>
						<div class="slide">
							<div class="top_sec">
								<figure>
                                    <?php if($rec['User']['banner_img'] != ''){ ?>
                                    <img src="<?php echo $this->webroot; ?>images/spa/banner/<?php echo $rec['User']['banner_img']; ?>">
                                    <?php }else{ ?>
                                    <img src="<?php echo $this->webroot; ?>files/noimagefound.jpg">
                                    <?php } ?>
								</figure>
							</div>
							<div class="bottom_sec">
								<div class="rating">
									<ul>                                        
                                        <?php for($i=0;$i<ceil($rec['User']['avg_rating']);$i++){ ?>
                                        <li class="un_check"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <?php } ?>
                                        <?php
                                        $unchecked = 5-ceil($rec['User']['avg_rating']);
                                        for($j=0; $j<$unchecked;$j++){
                                        ?>
                                        <li class="checked"><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <?php } ?>
                                        
										<span>( <?php echo count($rec['Ratings']); ?> Rates )</span>
									</ul>
								</div>
								<div class="saloon_name">
									<h5><?php echo $rec['User']['store_name']; ?></h5>
								</div>
								<div class="location">
									<ul>
										<li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $rec['User']['address']; ?></li>
									</ul>
								</div>
								<div class="btn-sec">
									<a href="salon/storeinformation/<?php echo base64_encode("user".$rec['User']['id']); ?>" class="btn btn-primary btn-exp">Explore More</a>
								</div>
							</div>
						</div><!-- Slide End Here -->
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clr"></div>
</section><!-- End Here -->
<?php } ?>
<section class="services_sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="globel_headding">
					<h1 class="title_text">Our Services</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="clr"></div>
	<div class="service_inner">
		<div class="container-fluid">
			<div class="row">
				<div class="service_slider">
                
                    <?php
                    
                    $i=0;
                    foreach($categories as $cat){ 
                    
                    if($cat['Category']['image'] != ''){
                    $img = $this->webroot."images/spa/category/".$cat['Category']['image'];
                    }else{
                    $img = $this->webroot."files/noimagefound.jpg";
                    }
                    
                    
                    
                    $image1 = '<div class="top_sec">
								<figure>
									<img src="'.$img.'">
								</figure>
							</div>';
                    
                    
                    $content1 = '<div class="bottom_sec">
								<div class="inner-display">								
									<h3>'.$cat["Category"]["name"].'</h3>'.$cat["Category"]["description"].'</div>
							</div>';
                    
                    
                    if($i%2 != 0){
                    $image = $content1;
                    $content = $image1;
                    } else{
                    $image = $image1;
                    $content = $content1;
                    }    
                    
                    ?>
                    
					<div class="col-md-4 col-sm-3 col-xs-12">
						<div class="outer_wrap">
							<?php echo $image; ?>
                            <?php echo $content; ?>
						</div>
					</div><!-- End Here -->
                    <?php $i++; ?>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clr"></div>
</section><!-- End Here -->
<section class="why_logo">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="globel_headding">
					<h1 class="title_text">Why MTH</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="mth-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 no-padding">
					<div class="col-md-4 col-sm-4">
						<div class="box-outer">
							<div class="box-inner">
								<div class="head_sec">
									<h4>Qualified and tested professionals</h4>
								</div>
								<div class="img_sec">
									<figure>
										<img src="<?php echo $this->webroot ?>images/spa/s2.png" alt="ICON">
									</figure>
								</div>
								<div class="bottom-sec">
									<p>We have very high bar on allowing therapists to list on MTH. We aim to try and test as many of our therapists as possible.</p>
								</div>
							</div>
						</div>
					</div><!-- End Here -->
					<div class="col-md-4 col-sm-4">
						<div class="box-outer">
							<div class="box-inner">
								<div class="head_sec">
									<h4>Background Checked</h4>
								</div>
								<div class="img_sec">
									<figure>
										<img src="<?php echo $this->webroot ?>images/spa/s7.png" alt="ICON">
									</figure>
								</div>
								<div class="bottom-sec">
									<p>All therapists are vetted and background checked before they become part of MTH family.</p>
								</div>
							</div>
						</div>
					</div><!-- End Here -->
					<div class="col-md-4 col-sm-4">
						<div class="box-outer">
							<div class="box-inner">
								<div class="head_sec">
									<h4>Satisfaction Guaranteed</h4>
								</div>
								<div class="img_sec">
									<figure>
										<img src="<?php echo $this->webroot ?>images/spa/s3.png" alt="ICON">
									</figure>
								</div>
								<div class="bottom-sec">
									<p>If you feel you are not satisfied with our services, please do let us know, all complaints will be followed up and dealt with.</p>
								</div>
							</div>
						</div>
					</div><!-- End Here -->
				</div>
			</div>
		</div>
	</div>
</section><!-- End Here -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.recomend_slider').bxSlider({
			auto: true,
			autoControls: true,
			slideWidth: 290,
			minSlides: 1,
			maxSlides: 3,
			slideMargin: 10
		});
		$('.service_slider').bxSlider({
			auto: true,
			autoControls: true,
			slideWidth: 450,
			minSlides: 1,
			maxSlides: 3,
			slideMargin: 0
		});
	});
</script>