<script type="text/javascript">
$(window).load(function() {
   $(".loader").fadeOut("slow");
	
});

</script>
<style>
.main_loader{
	 position: fixed;
	left: 0px;
	top: 154px;
	width: 100%;
	height: 40%;
	z-index: 9999;
    background: url('/winegarden/app/webroot/images/loader.gif') 50% 30% no-repeat rgb(249,249,249);
    opacity: 1;
	background-color: #e6e6e6;
}

    .loader {
    position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	opacity: 1;
	background-color: #f2f2f2;
}
.cntr_moment {
  width: 100%;
  float: left;
  position: relative;
}
.cntr_moment h4 {
    font-size: 18px;
	width: 100%;
	float: left;
	position: absolute;
	top: 139px;
	left: 0px;
	font-weight: bold;
	line-height: 22px;
	text-align: center;
}
.loader_top{
    background: #000;
    height: 20px;
}
.loader_center{
        background: #fff;
        height: 70px;
        margin-top: 20px;
        text-align: center;
    
}

.loader_foot{
    background: #000;
    height: 90px;
    position: absolute;
    bottom: 0;
    width: 100%;
}

</style>

<div class="loader">
    <div class="loader_top"></div>
    <div class="loader_center"><img src="<?php echo $this->webroot."img/logo.png" ?>"></div>
<div class="main_loader">
	<div class="cntr_moment">
    <h4>One moment...<br />Let's see what's on tap</h4>
    
  </div>
</div>
    <div class="loader_foot"></div>
</div>

<div class="module" id="module-web-store">
    <div class="mobile-overlay">
        <div class="row">
            <div class="medium-8 small-12 small-centered columns">
                <h1 class="heading-thin-large text-center">Wine, beer &amp; liquor delivered in <?php echo $state_name['State']['name']; ?></h1>
                
                

                <div class="store-entry-module row">
                    <div class="address-wrapper">
                        <div class="value-prop__container">
                            <div class="value-prop">
                                <div class="value-prop__icon--wine-glass"></div>
                                <img src="/winegarden/app/webroot/images/small_glass.png" class="cntr_baner" />
                                <h3 class="heading-thin-bold">Browse</h3>
                                <p class="branding">The best local selection</p>
                            </div>
                            <div class="value-prop">
                                <div class="value-prop__icon--cart"></div>
                                <img src="/winegarden/app/webroot/images/cart.png" class="cntr_baner" />
                                <h3 class="heading-thin-bold">Order</h3>
                                <p class="branding">No markups or hidden fees</p>
                            </div>
                            <div class="value-prop">
                                <div class="value-prop__icon--delivery"></div>
                                <img src="/winegarden/app/webroot/images/delivery.png" class="cntr_baner" />
                                <h3 class="heading-thin-bold">Enjoy</h3>
                                <p class="branding">Fast delivery to your door</p>
                            </div>
                        </div>
                        <div id="address-container">
                            <div class="gift-copy">
                                <img class="gift-copy_icon" src="<?php echo $this->webroot.'img/gift_icon-2643bd262fa35a76eade16ae03f6e95a.png'?>" alt="Gift icon">
                                <span class="gift-copy_text">Sending a gift? Use the recipient's address.</span>
                            </div>
                            <div id="email-entry__container"></div>
                             
                            <div id="address-entry">
                                <div data-reactroot="" id="auto_complete" class="">
                                    <div class="address-entry-message small-12 columns hidden">
                                        <p></p>
                                    </div>
                                    <div class="address-entry__input small-12 columns flex-button-group">
                                       <?php
                    if($this->Session->check('topaddress')){
                        $address = $this->Session->read('topaddress');
                        $full_address = $address['address'];
                    }else{
                        $full_address = '';
                    }

                    ?>
                                        <div class="input-container" id="address-input-container"> 
                                             <input id="autocomplete2"  onfocus="(this.value == '') class="address-bar" value="<?php echo ($full_address != '') ? $full_address : ''; ?>" placeholder="Start typing your address" onFocus="geolocate()" type="text" />
<!--                                            <input type="text" name="address-input" id="autocomplete" class="address-input" placeholder="Enter your delivery address" value="" autocomplete="off" required="">-->
                                           <input type="hidden" name=data[Restaurant][lat] class="field" id="latitude1">
                                           <input type="hidden" name=data[Restaurant][long] class="field" id="longitude1">
                                            <a class="close-button enter-new hidden"></a>
                                            <div id="recent-address-container" class="">
                                                <ul></ul>
                                            </div>
                                        </div>
                                            <div class="button black address-button" id="address-button1">
                                 Explore
                            </div>     
<!--                                        <div class="button black address-button" id="address-button"> <input type="submit" name="submit" class="button black address-button" id="address-button" value="Explore">react-text: 11 Explore /react-text <div class="button__loader"></div>-->
                                     
                                            
                                        </div></div></div></div>
                            <p class="legal-thin">✓ I'm 21+ years of age and agree to the <a href="/terms">terms of service</a>.</p>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

</div>
<div class="rowmargin2">
<div class="row">
<div class=" large-8 medium-8 columns small-centered">
<h2 class="section-title center">
    <?php echo $state_name['State']['name']; ?> Delivery</h2>
<p class="left"></p><p></p><p></p>
</div>
</div>
</div>
<div class="module-product-placement small-12 column">
            <div>
                <div class="row" data-reactroot="" data-reactid="1" data-react-checksum="-2028791971">
                    <div class="small-12 column" data-reactid="2">
                        <?php
             
                             
                                $heading = 'MOST POPULAR WINE';
                            
                        ?>
                        
                        
                         
                     
                        <h2 class="heading-row heading-row--has-subheader" data-reactid="3"> <?php echo $heading; ?> <a class="heading-row__subheader hidden" data-reactid="5">  Â» </a></h2>
                        <div class="alert-danger" style="display:none;"><strong>Error</strong> Please add items to cart from same store!</div>
                        <div class="alert-success" style="display:none;"><strong>Success</strong> Product is added to cart</div>
                        <div class="alert-warning" style="display:none;"><strong>Warning: </strong> Product is already exists in cart.</div>
                        <ul class="grid-product__container grid-product__container--featured grid-product__container--featured--large" id="pro-con" data-reactid="7">
                            <?php if(!empty($productswatch)){ ?>
                            <?php //echo "<pre>"; print_r($productswatch); echo "</pre>"; ?>
                          <?php foreach ($productswatch as $val){ ?> 
                        <!---------product_item--------------->
                        <li class="grid-product grid-product--featured grid-product--featured--anonymous wishlist-sec" data-reactid="8">
                            
                            
                        <!-- Wishlist icon    -->
                        <?php if($loggeduser){ ?>
                            <?php 
                            //echo count($val['Productlike']);
                            if (count($val['Productlike']) > 0) {
                                
                                $all_likes = array();
                                $i = 0;
                                foreach ($val['Productlike'] as $prolike) {
                                    if($prolike['user_id'] == $loggeduser && $prolike['product_id'] == $val['Product']['id']){
                                    $all_likes[$i] = $prolike['user_id'];
                                    }
                                    $i++;
                                }
                                
                                

                                if(in_array($loggeduser, $all_likes)){ ?> 
                                    <i data-id="<?php echo $val ['Product']['id']; ?>" class="fa fa-heart prolike" aria-hidden="true"></i>
                                <?php } else { ?>
                                    <i data-id="<?php echo $val ['Product']['id']; ?>" class="fa fa-heart-o prolike" aria-hidden="true"></i>
                                <?php }
                            }
                              
                            else { ?> 
                                <i data-id="<?php echo $val ['Product']['id']; ?>" class="fa fa-heart-o prolike" aria-hidden="true"></i>
                            <?php }
                        } ?>
                        <!-- Wishlist icon  (END) -->       
                                
                        <div class="actions" data-reactid="9">
                        <?php if($val['Product']['stock'] != '0'){ ?>
                        <a class="button small expand btn_cart"  id="<?php echo $val['Product']['id']; ?>" data-id="<?php echo $val['Product']['id']; ?>" data-storeid="<?php echo $val['Product']['res_id']; ?>" href="javascript:void(0)">Add to cart
                        </a> 
                        <?php }else{ ?>
                            <a class="button small expand" href="javascript:void(0)">Out of stock  </a> 
                        <?php } ?>
                    
                        </div>
                        <a class="grid-product__contents" href="<?php echo $this->webroot . "product/" . $val['Product']['slug']; ?>" data-category="product placement" data-reactid="11">
                        <?php echo $this->Html->Image('/images/large/' . $val['Product']['image'], array('alt' => $val['Product']['name'], 'class' => 'grid-product__image')); ?>  
                        
                        <h4 class="grid-product__property grid-product__property--name grid-product__property--main" data-reactid="13"><?php echo $val['Product']['name']; ?></h4>
                        <h3 class="grid-product__property grid-product__property--name grid-product__property--main"><?php echo $val['Restaurant']['name']; ?></h3>
                        <h5 class="grid-product__property grid-product__property--volume"><span class="grid-product__property--volume__value"><?php echo $val['Product']['weight']; ?>ml</span></h5>
                        <h4 class="grid-product__property grid-product__property--price">$<?php echo $val['Product']['price']; ?></h4>
                        <p><?php //echo $val['Restaurant']['name']; ?></p>
                        </a>
                        </li>
                        
                        <!---------product_item--------------->
                        <?php }
                        ?>
                        <?php } else { ?>
                        <h2>No results found</h2>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
      
   
   
 <!-------------new-section------------------>

<div>
    <?php if(!empty($states)){ ?>
<div class="rowmargin2">
<div class="row">
<h2 class="section-title center"> Delivering nationwide </h2>
<div class="large-4 medium-8 columns medium-centered large-uncentered">
<ul class="center cities">
    <?php foreach($states as $state){ 
                                
    $name = $state['State']['name'].', denmark';  

    $address = $name; // Google HQ
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;

    ?>
<li> <a href="<?php echo $this->webroot ?>shop/region?code=<?php echo $state['State']['code']; ?>&lat=<?php echo $latitude; ?>&long=<?php echo $longitude; ?>"><?php echo $state['State']['name']; ?></a></li>
    <?php } ?>
</ul>
</div>
</div>
</div>
    <?php } ?>
</div>
   
<?php // echo "<pre>"; print_r($allres); echo "</pre>"; ?>		 
<script> 
 /*$(document).delegate('.prolike', 'click', function(){
   var pid=$(this).attr("data-id");
    var uid = "<?php //echo $loggeduser; ?>"
    var product=$(this);
    $.ajax({
    url: "<?php //echo $this->webroot ?>/products/ajaxproductlikes",
    method: "POST",
    data: {product_id: pid, user_id: uid}
        }).success(function(response){
            console.log(response)
            var data1=$.parseJSON(response);
            console.log(data1)
            console.log(product);
            if(data1['like']==1){
              product.attr('class', 'fa fa-heart prolike');
            }else if(data1['like']==0){
                product.attr('class', 'fa fa-heart-o prolike');
            }
        }).error(function(error){
            console.log(error)
        })
    
}) */
    
  $(document).ready(function(){
     var search = "<?php echo $search ?>";
     
     if(search != '0'){
        $('html, body').animate({
            scrollTop: $(".module-product-placement").offset().top
        }, 2000);
     }
  });    

    





 

 

  $('#grd').on('click', function (e) {
                e.preventDefault();
                $('.lst,#grd').hide();
                $('.grd,#lst').show();
            });
            $('#lst').on('click', function (e) {
                e.preventDefault();


                $('.grd,#lst').hide();
                $('.lst,#grd').show();
            });
            function verhoz() {
                $('#grd').on('click', function (e) {
                    e.preventDefault();
                    $('.lst,#grd').hide();
                    $('.grd,#lst').show();
                });
                $('#lst').on('click', function (e) {
                    e.preventDefault();
                    $('.grd,#lst').hide();
                    $('.lst,#grd').show();
                });
            }
		
  
  <!------------slider-script----------------->
  	$(document).on('ready', function() {
    $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2
      });
    });

</script>

