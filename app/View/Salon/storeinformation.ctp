<link href="<?php echo $this->webroot;?>style.css" rel="stylesheet">
<link href="<?php echo $this->webroot;?>font-awesome/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jslider.plastic.css" type="text/css">
<div class="service_banner">

<?php //echo "<pre>"; print_r($reviews); echo "</pre>"; ?>

  <div class="container">
    <div class="row">
    <div class="col-sm-4">
      <div class="list_class" style="background-image:url(<?php echo $this->webroot?>images/spa/banner/<?php echo $data['User']['banner_img'];?>);background-size: cover;width: 100%;"> <img src="<?php echo $this->webroot;?>images/spa/icon/<?php echo $data['User']['icon_img']; ?>">
        <ul>
            <?php for($j = 0; $j < $data['User']['avg_rating']; $j++){ ?>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <?php }
            $unrated = 5-$data['User']['avg_rating'];
            ?>
            <?php for($i=0; $i<$unrated; $i++){ ?>
            <li class="colr_str"><i class="fa fa-star" aria-hidden="true"></i></li>
            <?php } ?>
        </ul>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="slider_list">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php for($i = 0; $i<=$gallerycount-1; $i++) { ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i == 0 ){ echo "active"; } ?>"></li>
            <?php } ?>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <?php 
            $i = 1;
            foreach($gallery as $gal) { ?>
            <div class="item <?php if($i == 1) { echo "active"; }?>"> <img src="<?php echo $this->webroot;?>images/spa/gallery/<?php echo $gal; ?>" alt="<?php echo $gal; ?>" style="width:100%; height:369px;"> </div>
            <?php $i++;  } ?>
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> <span class="sr-only">Next</span> </a> </div>
      </div>
    </div>
    <div class="rob_list">
      <h4><?php echo strtoupper($data['User']['store_name']); ?> In <?php echo ucwords($data['User']['location']); ?></h4>
    </div>
  </div>
</div>
</div>
<div class="rob_Section">
   	<div class="container">
    	<div class="row">
        
        	<div class="col-sm-4">
            	<div class="four_available">
                	<div class="rob_heading">
                	<h4><?php echo strtoupper($data['User']['store_name']); ?> IN THE <?php echo strtoupper($data['User']['location']); ?></h4>
                        <p><?php echo $data['User']['address']; ?></p>
                        <p>Postcode: <?php echo $data['User']['zip']; ?></p>
                    	</div>
                         
                        <div class="opening_list">
                            <h4>OPENING HOURS</h4>
                            <?php if($data['User']['sunday_timing_from'] != ''){ ?>
                            <h5>Sunday<span><?php echo $data['User']['sunday_timing_from'] ?> to <?php echo $data['User']['sunday_timing_to'] ?></span></h5> 
                            <?php }else{ ?>
                            <h5>Sunday<span>Not Working</span></h5>    
                            <?php } ?>
                              
                            <?php if($data['User']['monday_timing_from'] != ''){ ?>      
                            <h5>Monday<span><?php echo $data['User']['monday_timing_from'] ?> to <?php echo $data['User']['monday_timing_to'] ?></span></h5>
                            <?php }else{ ?>
                            <h5>Monday<span>Not Working</span></h5>    
                            <?php } ?>
                            
                            <?php if($data['User']['tuesday_timing_from'] != ''){ ?> 
                            <h5>Tuesday<span><?php echo $data['User']['tuesday_timing_from'] ?> to <?php echo $data['User']['tuesday_timing_to'] ?></span></h5>
                            <?php }else{ ?>
                            <h5>Tuesday<span>Not Working</span></h5>    
                            <?php } ?>
                            
                            <?php if($data['User']['wednesday_timing_from'] != ''){ ?>
                            <h5>Wednesday<span><?php echo $data['User']['wednesday_timing_from'] ?> to <?php echo $data['User']['wednesday_timing_to'] ?></span></h5>
                            <?php }else{ ?>
                            <h5>Wednesday<span>Not Working</span></h5>    
                            <?php } ?>
                            
                            <?php if($data['User']['thursday_timing_from'] != ''){ ?>
                            <h5>Thursday<span><?php echo $data['User']['thursday_timing_from'] ?> to <?php echo $data['User']['thursday_timing_to'] ?></span></h5>
                            <?php }else{ ?>
                            <h5>Thursday<span>Not Working</span></h5>    
                            <?php } ?>
                            
                            <?php if($data['User']['friday_timing_from'] != ''){ ?>
                            <h5>Friday<span><?php echo $data['User']['friday_timing_from'] ?> to <?php echo $data['User']['friday_timing_to'] ?></span></h5>
                            <?php }else{ ?>
                            <h5>Friday<span>Not Working</span></h5>    
                            <?php } ?>
                            
                            <?php if($data['User']['saturday_timing_from'] != ''){ ?>
                            <h5>Saturday<span><?php echo $data['User']['saturday_timing_from'] ?> to <?php echo $data['User']['saturday_timing_to'] ?></span></h5>
                            <?php }else{ ?>
                            <h5>Saturday<span>Not Working</span></h5>    
                            <?php } ?>
                        </div> 

                        <div class="contact_list">
                            <h4>CONTACT INFO</h4>
                            <h5><?php echo $data['User']['phone']; ?></h5>
                            <h5><?php echo $data['User']['email']; ?></h5>
                        </div> 
                	</div>
            	</div>
                 
                    
                        <div class="col-sm-8">
                        
      
                       <div class="service_found srvce_wid">
                             <!-- Nav tabs -->
  <ul class="nav nav-tabs down_style" role="tablist">
    <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">ABOUT</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">SERVICES</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">REVIEWS (<?php echo count($reviews); ?>)</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" style="min-height:257px;">
  
    <div role="tabpanel" class="tab-pane active" id="about"><?php echo $data['User']['about']; ?></div>
    
    <div role="tabpanel" class="tab-pane" id="profile">


    
    <div class="panel-group custom_acc" id="accordion" role="tablist" aria-multiselectable="true">
		<?php 
       $i = 1; 
        foreach($categories as $category) {
         $users = array();
       	foreach($category['Service'] as $service) { 
        	$users[] = $service['user_id'];
        }
        ?>
        
        
      <?php if(in_array($user_id, $users) && !empty($category['Service'])){ ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                <h4 class="panel-title">
                    <a class="head_acc" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                        <i class="more-less glyphicon glyphicon-chevron-up"></i>
                        <?php echo $category['Category']['name']; ?>
                    </a>
                </h4>
            </div>
            <?php if(!empty($category)) { ?>
            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                <div class="panel-body body_zero">
                      <div class="accordion-inner">
                        <div class="accor_tble">
                        <table class="table">
                          <tbody>
                          <?php foreach($category['Service'] as $service) { 
                          	if($service['user_id'] == $user_id && $service['status'] != 0) { ?>
                            <tr>
                              <td class="cut_grey left_cut"><?php echo $service['name']; ?></td>
                              <td class="cut_grey"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $service['duration']; ?></td>
                              <td>&#163;&nbsp;<?php echo $service['price']; ?></td>
                              
                              <?php if(in_array($service['id'], $cart)){ ?>
                              
                              <td><button type="button" id="btn<?php echo $service['id']; ?>" class="btn btn-default default_explore ajaxaddcart rmove_cart" data-action="remove" data-cat="<?php echo $category['Category']['name']; ?>" data-service="<?php echo $service['name']; ?>" data-time="<?php echo $service['duration']; ?>" data-price="<?php echo $service['price']; ?>" data-serviceid="<?php echo $service['id']; ?>" data-userid="<?php echo $user_id; ?>">REMOVE</button></td>
                              <?php }else{ ?>
                              <td><button type="button" id="btn<?php echo $service['id']; ?>" class="btn btn-default default_explore ajaxaddcart" data-action="add" data-cat="<?php echo $category['Category']['name']; ?>" data-service="<?php echo $service['name']; ?>" data-time="<?php echo $service['duration']; ?>" data-price="<?php echo $service['price']; ?>" data-serviceid="<?php echo $service['id']; ?>" data-userid="<?php echo $user_id; ?>">BOOK NOW</button></td>
                              <?php } ?>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                          </tbody>
                        </table>
                        </div>
                        </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
<?php $i++;  }?>
 
    </div><!-- panel-group -->
    
    
<!-- container -->

    

</div>
    
    <div role="tabpanel" class="tab-pane" id="messages">
    
    	<?php if(!empty($reviews)){ ?>
        <?php foreach($reviews as $review){ ?>
        <a href="javascript:void(0)" class="rvw_sec">
        <?php if($review['User']['image'] != ''){ ?>
        <span><img src="<?php echo $this->webroot ?>images/spa/users/<?php echo $review['User']['image'] ?>" alt="images"></span>
        <?php }else{ ?>
        <span><img src="<?php echo $this->webroot ?>images/spa/no_image.jpg" alt="images"></span>
        <?php } ?>
        <div class="right_list">
            <div class="reviews">
                <ul>
                	<?php for($i = 0; $i < $review['Review']['rating']; $i++){ ?>
                    	<li class="active"><i class="fa fa-star"></i></li>
                        <?php
                    }
                    
                    $unrated = 5-$review['Review']['rating'];
                    
                    for($j=0; $j<$unrated; $j++){ ?>
                    	<li class="colr_str"><i class="fa fa-star"></i></li>
                    <?php    
                    }

                    ?>
                    
                    <!--<li><i class="fa fa-star"></i></li>-->
                    
                </ul>
                
                </div>
                    <h3></h3>
                <div class="reviews_text">
                <ul>
                    <li class="active"><?php echo $review['User']['first_name'].' '.$review['User']['last_name']; ?></li>
                    <li><i class="fa fa-check-circle-o" aria-hidden="true"></i></li>
                    <li class="active"><?php echo date('d M, Y', strtotime($review['Review']['created'])); ?></li>
                </ul>
        	</div>
        </div>
        </a>
        <?php } ?>
        <!--<a href="#">Load More</a>-->
    	<?php }else{ ?>
         <img src="<?php echo $this->webroot ?>images/spa/no-review.png" class="cntr_oop" style="padding:13% 0 15px 0;" />
         <h2 style="width:100%; float:left; text-align:center; color:#006500; margin-top:0px;">No Reviews Yet!</h2>
        <?php } ?>
    
    
    
    </div>
    
    
  </div><!--tab-end-->
                         </div><!--srvc-->
                         <div class="check_section spce_empt">
                         	<div class="check_heading">
                            	<h2>Check availability</h2>
                            	</div>
                                <div class="calendr_cover">
                                <div class="col-sm-6">
                                	<div class="calender_service ">
                                    <div id="datepicker"></div>
            

                                    </div><!--check-service-->
                                </div><!--col-6-->
                                
                                
                                <div class="col-sm-6">
                                	<div class="time_service" id="available-data">
<!--                                    	<h4>Service Time 30 Minutes</h4>-->
                                        <ul>
                                        
                                        </ul>
                                    	</div>
                                	</div>
                                   </div>
                                   <div class="white_fault">
                                  <!-- <button type="button" class="btn btn-default default_gren">Submit</button>-->
                                   </div>
                         	</div><!--section-->
                         
                         <?php if(!empty($reviews)){ ?>
        
                         <div class="review_section">
                         	<div class="review_heading">
                         	<h2>Reviews</h2>
                         	</div>
                           
                         	<?php foreach($reviews as $review){ ?>
                            <a href="#" class="rvw_sec">
                            <?php if($review['User']['image'] != ''){ ?>
                            <span><img src="<?php echo $this->webroot ?>images/spa/users/<?php echo $review['User']['image'] ?>" alt="images"></span>
                            <?php }else{ ?>
                            <span><img src="<?php echo $this->webroot ?>images/spa/no_image.jpg" alt="images"></span>
                            <?php } ?>
                            
                            <div class="right_list">
                            
                            <div class="reviews">
                            <ul>
                            <?php for($i = 0; $i < $review['Review']['rating']; $i++){ ?>
                            <li class="active"><i class="fa fa-star"></i></li>
                            <?php } ?>
                            
                            <?php
                            $unrated = 5-$review['Review']['rating'];
                            
                            for($j=0; $j<$unrated; $j++){ ?>
                            <li class="colr_str"><i class="fa fa-star"></i></li>
                            <?php    
                            }
                            
                            ?>
                            </ul>
                            </div>
                            <h3></h3>
                            <div class="reviews_text">
                            <ul>
                            <li class="active"><?php echo $review['User']['first_name'].' '.$review['User']['last_name']; ?></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i></li>
                            <li class="active"><?php echo date('d M, Y', strtotime($review['User']['created'])); ?></li>
                            
                            </ul>
                            </div>
                            </div>
                            </a>
							<?php } ?>
                            
                            </div>
                       	</div><!--8-->
						<?php } ?>
                      
                      
                      
                   </div><!--row-->
                   </div>
                   </div>
<?php
$current_date = date("d-m-Y");
    
$current_day = date('l', strtotime($current_date));

?>
<script>

  $( function() {
	var salon_id = '<?php echo $salon_id ?>';
	
	

	
	$.ajax({
       url: '<?php echo $this->webroot; ?>users/getStoreSubscribeDate',
       method: 'post',
	   data: {salon_id: salon_id},
       dataType: 'json',
       success: function(json){
	   console.log('SI: '+json);
	   console.log(json);
	   console.log(json.sub_date);
	   var start_date = json.sub_date.split('-');
	   var end_date = json.exp_date.split('-');

	   //$( "#datepicker" ).datepicker({minDate: new Date(start_date[2], start_date[0], start_date[1]), maxDate: new Date(end_date[2], end_date[0], end_date[1]), dateFormat: 'dd-mm-yy'});
	   $( "#datepicker" ).datepicker({minDate: 0, maxDate: new Date(end_date[2], end_date[0], end_date[1]), dateFormat: 'dd-mm-yy'});

		$("#datepicker").trigger("change");
	   }
	});   
	
	$("#datepicker").on("change",function(){
        var selected = $(this).val();
		
        var date = $(this).datepicker('getDate');
        
        var weekday = new Array();
        
        weekday[0] = "Monday";
        weekday[1] = "Tuesday";
        weekday[2] = "Wednesday";
        weekday[3] = "Thursday";
        weekday[4] = "Friday";
        weekday[5] = "Saturday";
        weekday[6] = "Sunday";
        
        var dayOfWeek = weekday[date.getUTCDay()];
        
        var user_id = '<?php echo $user_id ?>';
        
        var data = {date: selected, user_id: user_id, day: dayOfWeek}
        
		allBookings(selected);
		
        $.ajax({
           url: '<?php echo $this->webroot; ?>salon/ajaxavailable',
           data: data,
           method: 'post',
           success:function(response){
               $('#available-data ul').html(response);
           }
        });
    });    
});
  
  /*$(window).load(function(){
  	//showSubscribeDate2();
    $("#datepicker").trigger("change");
	//$("#datepicker").datepicker("setDate", new Date());
  });*/
  
</script>

<script>

function allBookings(date){

	$.ajax({
		url: '<?php echo $this->webroot ?>shop/ajaxGetOrderBookings',
		data: {date: date, salon_id: '<?php echo $user_id; ?>'},
		method: 'post',
		success: function(response){
		
			if(response != ''){
			
				response = JSON.parse(response);
			console.log(response);
				for(var i=0; i<response.length; i++){
				//alert(response[i].Order.start_time);
					$( ".time_service ul li:contains('"+ response[i].Order.start_time +"')" ).css( "background", "#808080" );
					$( ".time_service ul li:contains('"+ response[i].Order.start_time +"')" ).nextUntil( ".time_service ul li:contains('"+ response[i].Order.end_time +"')" ).css( "background", "#808080" );
					$( ".time_service ul li:contains('"+ response[i].Order.end_time +"')" ).css( "background", "#808080" );
				}
			}
		}
	});
}

</script>

<script>

    function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-chevron-up glyphicon-chevron-down');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
   
<script>
	$(document).ready(function(){
	   $('.time_service li').click(function() {
		$(this).toggleClass("pink");
	});
		
	});
</script>

<script>
    $(document).delegate('.ajaxaddcart', 'click', function(){
        
       var category = $(this).data('cat');
       var service = $(this).data('service');
       var time = $(this).data('time');
       var price = $(this).data('price');
       var service_id = $(this).data('serviceid');
       var user_id = $(this).data('userid');
       
       var action = $(this).attr('data-action');
           
       
       var cart_item_count = '<?php echo $item_count ?>';
       
       var data = {
           category: category,
           service: service,
           time: time,
           price: price,
           service_id: service_id,
           user_id: user_id
       }
       
       if(action == 'add'){
           var url = '<?php echo $this->webroot; ?>shop/ajaxaddtocart';
       }else if(action == 'remove'){
           var url = '<?php echo $this->webroot; ?>shop/ajaxremovefromcart';
       }    
       
       //alert(category+', '+service+', '+time+', '+price+', '+service_id);
       
       $.ajax({
          url: url,
          data: data,
          method: 'post',
          success: function(response){

            if(response == 'added'){
                $('#btn'+service_id).html('REMOVE');
                $('#btn'+service_id).attr('data-action', 'remove');
                $('#btn'+service_id).addClass('rmove_cart');
                
                updateCartCount();

            }else if(response == 'removed'){
                $('#btn'+service_id).html('BOOK NOW');
                $('#btn'+service_id).attr('data-action', 'add');
                $('#btn'+service_id).removeClass('rmove_cart');
                
                updateCartCount();
                
            }else if(response == 'notadded'){
                var r = confirm("Are you sure you want to change the Therapist? While adding services in the cart with the new Therapist, your previous cart services will be removed. ");
                if (r == true) {
                    deleteCartData();
                }
            } 
			$('#cart_salon_id').text(user_id);  
          }
       });
    });
    
function deleteCartData(){
    $.post('<?php echo $this->webroot; ?>shop/deleteCartData', function(data, status){
        location.reload();
    });
}
</script>