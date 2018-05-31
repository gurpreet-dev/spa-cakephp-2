<?php $this->set('title_for_layout', 'cart');   ?>   
<input type="hidden" value='cartpage' id="cartpage">
<style type="text/css">
    .cart-order-panel__subtotal{
        display: block !important;
    }
    .cart-order-panel__subtotal span{
        display: block;
        width: 50%;
        float: left;
        text-align: left;
        margin-bottom: 5px;
    }
    .grid-product--cart--default:nth-child(4), .grid-product--cart--default:nth-child(5), .grid-product--cart--default:nth-child(6){
        display:none;
    }
</style>
<?php // echo $this->Html->script(array('cart.js'), array('inline' => false)); 

// echo "<pre>"; print_r($shop['OrderItem']); echo "</pre>";
?>  


<div id="product-detail" class="store-detail-view"></div>
        <div id="cart-detail" class="row store-detail-view" style="display: block;">
            <?php 
           // print_r($cshop);
            if(!empty($cshop['products'])){ ?>
            <div data-reactroot="" class="store-cart">
                <div class="row">
                    <div class="large-12 column"> 
                        <div class="row">
<!--                            <div class="small-12 columns">
                                <h2 class="heading-row heading-row--has-subheader cart__page-heading"> react-text: 10 Your Cart /react-text <a href="/store/" class="heading-row__subheader grey-link">Continue Shopping »</a></h2>
                            </div>-->
                                                        <div class="large-8 medium-8 columns">
                                <!-- react-empty: 30 -->
                                <table class="shipment-table">
                                    <tbody>
                                        <?php if($cshop['cartInfo']['subtotal'] < '25'){ ?>
                                        <tr>
                                        <td colspan="5" class="shipment-table__subheader__cell delivery-cost-prompt delivery-cost-prompt--below-min">You should buy products of above 25$</td>
                                      </tr>
                                        <?php } ?>
                                      <?php   
                                      
                                      foreach ($cshop['products'] as $key => $item):?>
                                        
                                          <tr class="shipment-table__item">
                                        
                                            <td class="shipment-table__item__property shipment-table__item__property--image__container">
                                                <a href="<?php echo $this->webroot."products/view/".$item['Product']['slug']; ?>" class="item__link">
                                                 <?php echo $this->Html->image($item['Product']['image'], array('class' => 'shipment-table__item__property--image')); ?>
                                                <!--<img alt="Corona Extra" src="https://cdn.minibardelivery.com/products/13504/small/corona_20s.jpg" class="shipment-table__item__property--image">-->
                                                </a>
                                            </td>
                                            <td class="shipment-table__item__property shipment-table__item__property--main">
                                                <a href="/store/product/corona-extra/corona-extra-6-pack-12oz-bottles" class="item__link">
                                                    <p class="shipment-table__item__remove-warning hidden">Item will be removed from cart.</p><span class="shipment-table__item__property--name">
                                                    <?php echo $this->Html->link($item['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $item['Product']['slug'])); ?>
                                                    </span>
                                                    <br><span class="shipment-table__item__property--volume">
                                                    <?php echo substr($item['Product']['description'],0,50) ?></span>
                       <br><span class="shipment-table__item__property--price--mobile">$<?php echo $item['Product']['price']; ?>aaaa</span>
                                                </a>
                                            </td>
                                            <td class="shipment-table__item__property shipment-table__item__property--price"><span>$<?php echo $item['Product']['price']; ?>
                                           
                                            </span>
                                            </td>
                                            <td class="shipment-table__item__property shipment-table__item__property--quantity"> 
                                          
         <select class="select--brand select--cart p_count" data-mods="<?php echo $mods; ?>" data-id = "<?php echo $item['Product']['id']; ?>" data-price="<?php echo $item['Product']['price']; ?>" name="data[Product][quantity-<?php echo $key;?>]">
                                                    
                <?php for($i=1; $i<=10; $i++){
                    if($item['Cart']['quantity']==$i){
                        $slected="selected";
                    }else{
                       $slected=""; 
                    }
               echo '<option value='."$i".' '.$slected.'>'.$i.'</option>';  
                    
                } ?>
                       </select>
                                             
                                                <br>
                                          
                                                <!--<a class="shipment-table__item__remove grey-link">Remove</a>-->
                                            </td>
                                             
                                           <td class="shipment-table__item__property shipment-table__item__property--total-price"><span id="subtotalnew"><span class="remove" id="<?php echo $item['Product']['id']; ?>">Remove</span></span></td>
                                             </tr>
                                            <?php endforeach; ?>
                                    
                                            <!--Extra products-->
                                        <?php if($cshop['cartInfo']['subtotal'] < '25'){ ?>    
                                        <tr class="">
                                        <td colspan="5" class="cart-placement__container"><h4 class="heading-cart cart-placement__header--minimum">
                                                <!-- react-text: 97 -->
                                                Easy Extras at
                                                <!-- /react-text -->
                                                <!-- react-text: 98 -->
                                                our store
                                                <!-- /react-text -->
                                            </h4>
                                            
                                            <ul class="grid-product__container grid-product__container--cart grid-product__container--cart--minimum">
                                                <?php foreach($recommended_products as $recommended){ ?>
                                                <li class="grid-product grid-product--cart--minimum grid-product--cart--default">
                                                    <div class="grid-product--cart--minimum__contents"><img class="grid-product__image" src="<?php echo $this->webroot . "images/large/" . $recommended['Product']['image']; ?>" alt="<?php echo $recommended['Product']['name']; ?>">
                                                        <div class="grid-product__contents__subcontainer">
                                                            <h4 class="grid-product__property grid-product__property--name grid-product__property--main"><?php echo $recommended['Product']['name']; ?></h4>
                                                            <h5 class="grid-product__property grid-product__property--volume"><span class="grid-product__property--volume__value"><?php echo $recommended['Product']['weight']; ?>ml</span></h5>
                                                            <h4 class="grid-product__property grid-product__property--price">
                                                                <!-- react-text: 144 -->
                                                                $<?php echo $recommended['Product']['price']; ?>
                                                                <!-- /react-text -->
                                                                <!-- react-text: 145 -->
                                                                <!-- /react-text -->
                                                                <!-- react-empty: 146 -->
                                                            </h4>
                                                        </div>
                                                         
                                                        <a class="button hollow add-to-cart add-to-cart--small btn_cart" data-uid="" id="<?php echo $recommended['Product']['id']; ?>" data-id="<?php echo $recommended['Product']['id']; ?>" data-storeid="<?php echo $recommended['Product']['res_id']; ?>">+</a></div>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <a class="cart-placement__show-more--minimum" href="javascript:void(0)">More</a>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    <!--Extra products (END)-->         
                    
                                       
                                       
                                    </tbody>
                                </table>
                                
                                <div class="cart__bottom-cta small-12 medium-6 medium-push-6 columns">
                                    <p class="minordermsg" style="color:red;"></p> 
                                    <?php if($cshop['cartInfo']['subtotal'] < '25'){ ?>    
                                    <a id="button-home" class="button expand hollow cart__bottom-cta__button" href="<?php echo $this->webroot; ?>">Continue Shopping</a>
                                    <?php }elseif (!empty($loggeduser)) { ?>
                                     <button type="button"  class="btn defult_btn placeorder"><i class="glyphicon glyphicon-arrow-right"></i> Checkout</button>                             
                                    <?php   }else{
                                     echo '<button  class="button expand cart-order-panel__button expand checkout">Proceed to Checkout</button>';   
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="large-4 medium-4 columns">
                                <div>
                                    <div class="panel-group">
                                        <div class="dark-panel center cart-order-panel">
                                            <div class="cart-order-panel__prompt hidden"></div>
                                            <div class="cart-order-panel__subtotal">
                                                <span>Order</span> <span>Items (<?php echo $cshop['cartcount']; ?>):</span>
                                                <span>Subtotal</span> <span> <?php echo $cshop['cartInfo']['subtotal']; ?></span>
                                                <span>Delivery Charge</span><span> <?php echo $cshop['cartInfo']['delivery_fee']; ?></span>
                                                 <span>Total </span><span> <?php echo $cshop['cartInfo']['total']; ?></span>
                                            </div>
                                            <p class="minordermsg" style="color:red;"></p>  
                                             <?php if($cshop['cartInfo']['subtotal'] < '25'){ ?>    
                                    <a id="button-home" class="button expand hollow cart__bottom-cta__button" href="<?php echo $this->webroot; ?>">Continue Shopping</a>

                              <?php   
                                             }elseif (!empty($loggeduser)) { ?>
        <button type="button"  class="btn defult_btn placeorder"><i class="glyphicon glyphicon-arrow-right"></i> Checkout</button>                              
        
       <?php }else{
         echo '<button  class="btn defult_btn checkout">Checkout</button>';    
        }
        ?>
                                            
                                            
                                            
                                        </div>
                                        <div class="dark-panel cart-order-legal">
                                            <p class="center legal">Sales tax, tip, delivery fees and promo codes will be applied when you check out.</p>
                                        </div>
                                    </div>
                                    <div class="show-for-medium-up panel gift small-12 columns">
                                        <h4>Sending a gift?</h4>
                                        <p>Proceed to checkout to select gift options.</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div> 
                <!-- react-empty: 5 -->
                <!-- react-empty: 6 -->
                
                <input type="hidden" id="min_order" value="<?php echo $cshop['store']['Restaurant']['minimum_order']; ?>"> 
                <input type="hidden" id="shoptotal" value="<?php echo $cshop['cartInfo']['total']; ?>"> 

                
                
              
                <!------------------Popular------------------------>
            
                <div id="cart-detail" class="row store-detail-view" style="display: block;">
    <div data-reactroot="" class="store-cart">
        <div class="row">
            <div class="large-12 column">
                <div class="small-12 columns">
                    <div>
                        <h2 class="heading-row cart-placement__header--addons">Perfect Party Add-ons</h2>
                        <ul class="grid-product__container grid-product__container--cart grid-product__container--cart--featured">
                            <?php foreach ($latestproduct as $item) { ?>
                                <li class="grid-product grid-product--cart--featured">
                                    <div class="grid-product__link--image"><img class="grid-product__image" src="<?php echo $this->webroot . "images/large/" . $item['Product']['image']; ?>" alt="<?php echo $item['Product']['name']; ?>"></div>
                                    <div class="grid-product__contents__subcontainer">
                                        <div class="grid-product__link--contents">
                                            <div class="grid-product__property grid-product__property--tag"></div>
                                            <h4 class="grid-product__property grid-product__property--name grid-product__property--main"><?php echo $item['Product']['name']; ?></h4>
                                            <h5 class="grid-product__property grid-product__property--volume"><span class="grid-product__property--volume__value"><?php echo $item['Product']['weight']; ?>ml</span></h5>
                                            <h4 class="grid-product__property grid-product__property--price">
                                                <!-- react-text: 226 -->
                                                $<?php echo $item['Product']['price']; ?>
                                                <!-- /react-text -->
                                                <!-- react-text: 227 -->
                                                <!-- /react-text -->
                                                <!-- react-empty: 228 -->
                                            </h4>
                                        </div>
                                        <div class="add-to-cart__wrapper add-to-cart__wrapper--default"><span class="add-to-cart__prompt heading-thin-smaller">add</span><a class="button hollow add-to-cart add-to-cart--small btn_cart" data-uid="" id="<?php echo $item['Product']['id']; ?>" data-id="<?php echo $item['Product']['id']; ?>" data-storeid="<?php echo $item['Product']['res_id']; ?>">+</a></div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <!------------------end Popular------------------------>
            
                
                  
                
                
                
                
            </div>
            <?php } else { ?>
            
            <div class="row">
            <div class="large-12 column">
            <div class="row">
            <div class="large-12 medium-12 column center empty-cart-warning"><!-- react-empty: 9 --><h3 class="heading-panel">Your Cart is Empty</h3><br><a id="button-home" class="button" href="<?php echo $this->webroot."products/all";?>">Continue Shopping</a></div></div>
            </div></div><!-- react-empty: 5 --><!-- react-empty: 6 -->
            
          
            

                <!--<a href="<?php echo $this->webroot."products/all";?>"> your cart is empty</a>-->
                
                
                <?php // echo $this->Html->link('<i class="glyphicon glyphicon-arrow-right"></i> Your Cart ', array('controller' => 'shop', 'action' => 'index'), array('class' => 'button expand cart-order-panel__button expand', 'escape' => false))  ?>
            
            <?php } ?>
            
            
            
        </div>

        

  

        <div id="checkout-detail" class="row store-detail-view" style="display: none;"></div>
        <div id="store-footer"></div>
        <div id="modal-email-capture" class="reveal-modal small dark"></div>
        <div id="modal-change-address" class="reveal-modal medium"></div>
        <div id="modal-supplier-hours" class="reveal-modal small"></div>
        <div id="modal-supplier" class="reveal-modal small light"></div>
        <div id="modal-alert-box" class="reveal-modal small"></div>
        <div id="layout_footer"></div>
 
    <!-- Layout Section End Here -->
    
    
    


<!-- The Modal -->
<!--div id="myModal" class="modal">


  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>USER LOGIN</h2>
    </div>
    <div class="modal-body">
       <?php echo $this->Form->create('User', array('url'=>array('controller' => 'users','action' => 'login'))); ?>
                <div class="row form-row">
                        <div class="large-12 column">
                            <?php echo $this->Form->input('username', array('label' => 'Email', 'type'=>'email', 'required'=>true)); ?>
                            
                        </div>
                    </div>
                 <div class="row form-row">
                                <div class="large-12 column">
                                    <?php echo $this->Form->input('password', array('label' => 'Password', 'required'=>true)); ?>
                                  </div>
                            </div>
                <?php echo $this->Form->end(__('Submit')); ?>
                <?php if(!$this->Session->check('User') && empty($ses_user))   { ?>   
       <a type="button" class="btn btn-just-icon btn-round fb-fb" id="facebook"><i class="fa fa-facebook">fb login</i></a>
       <?php } ?>
                <div class="row">
                       <p class="center secondary">Need an account? <button id="signupbutton">Sign up</button> </p>
                       
                           
                    </div>
                  
             
    </div>
    <div class="modal-footer">
      <h3>Login</h3>
    </div>
  </div>

</div-->


<!--Sign upmodel-->




<!--div id="signupModal" class="modal">


  <div class="modal-content">
    <div class="modal-header">
      <span class="closesignup">&times;</span>
      <h2>USER SIGNUP</h2>
    </div>
    <div class="modal-body">
        <div class="checkout-panel">
                        <?php echo $this->Form->create('User', array('url'=>array('controller' => 'users','action' => 'add'), 'id'=>'signupformm')); ?>
                        <div class="row form-row">
                                <div class="large-12 column">
                                    <input type="hidden" name="server" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                    <?php echo $this->Form->input('first_name', array('autofocus' => 'autofocus','label' => 'First Name', 'required'=>true)); ?>
                                </div>
                            </div>
                        <div class="row form-row">
                                <div class="large-12 column">
                                    <?php echo $this->Form->input('last_name', array('label' => 'Last Name','required'=>true)); ?>
                                </div>
                            </div>
                        <div class="row form-row">
                                <div class="large-12 column">
                                    <?php echo $this->Form->input('email', array('label' => 'Email', 'type'=>'email', 'required'=>true)); ?>
                                </div>
                            </div>
                           <div class="row form-row">
                                <div class="large-12 column">
                                    <?php echo $this->Form->input('password', array('label' => 'Password','autocomplete' => 'off', 'required'=>true)); ?>
                                </div>
                            </div>
                           <div class="row form-row">
                                <div class="large-12 column">
                                    <?php echo $this->Form->input('confirmpassword', array('label' => 'Confirm Password', 'type'=>'password', 'autocomplete' => 'off', 'required'=>true)); ?>
                                </div>
                            </div>
                        <?php echo $this->Form->input('role', array('type'=>'hidden', 'value'=>'customer')); ?>
                        
                        <?php echo $this->Form->end(__('Submit')); ?>
                    </div>
             
    </div>
    <div class="modal-footer">
      <h3>Login</h3>
    </div>
  </div>

</div-->


  <script>
// Get the modal
 var signupmodel = document.getElementById('signupModal');
var modal = document.getElementById('myModal');
console.log(modal)
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
     signupmodel.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        
    }
}
</script>  
    
<script>
jQuery(document).ready(function(){
 jQuery('.placeorder').on('click', function(e){ 
	 e.preventDefault(); 
       var min_order = jQuery('#min_order').val(); 
       var shoptotal = jQuery('#shoptotal').val(); 
  
       if(min_order ==0){ 
        window.location.href= Shop.basePath+ "shop/address" ; 
		 }else{    
       if (Math.round(min_order) <= Math.round(shoptotal)) {
         window.location.href= Shop.basePath+ "shop/address" ;   
       }else{
             jQuery(".minordermsg").html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Opps! Min Order required: $'+min_order);
             e.preventDefault();
	   }
		 }
         
 });
});
</script>
  
    
 
<script>
    jQuery(".remove").each(function() {
		jQuery(this).replaceWith('<a class="remove" id="' + jQuery(this).attr('id') + '" title="Remove item"><img src="' + Shop.basePath + 'home/images/delete-icon.png" alt="Remove" class="cart_remove" /></a>');
	});
    function ajaxcart(id, quantity, mods){
        $.ajax({
    url: Shop.basePath + "shop/itemupdate",
    method: "POST",
    data: {
                        id: id,
			quantity: quantity
			},
}).success(function(response){
 window.location.reload();
}).error(function(error){
    console.log(error)
})
    }    
        
$(".p_count").change(function(){

var id=$(this).attr("data-id");
var mods=$(this).attr("data-mods");
var quantity=$(this).val();
ajaxcart(id, quantity, mods)

})
jQuery(".remove").click(function(){
    
    $.ajax({
        url: Shop.basePath + "shop/webremoveitems",
        method: "POST",
        data: {
                        id: jQuery(this).attr("id")
			
        }
    }).success(function(response){
     window.location.reload();
      return false;
    }).error(function(){
          console.log(error)
    })
		//ajaxcart(jQuery(this).attr("id"), 0);
return false;
	});

$(".checkout").click(function(){

    var modal = document.getElementById('myModal');
   modal.style.display = "block";
})

$("#UserCartForm").submit(function(e){
 console.log($("#UserCartForm").serialize())
 var username= $("#UserUsername").val();
 var password= $("#UserPassword").val();
 $.ajax({
     url: Shop.basePath + "users/ajaxlogin",
     method: "POST",
     data: $("#UserCartForm").serialize()
 }).success(function(response){
    var result=$.parseJSON(response)
    
    console.log(result) 
    if(result['success']==false){
        alert('log in unsuccessfull');
    }
    if(result['success']==true){
       modal.style.display = "none";
       window.location.reload();
    }
 }).error(function(error){
     console.log(error)
 })
     e.preventDefault();
})
$("#signupbutton").click(function(){
    var signupmodel = document.getElementById('signupModal');
     modal.style.display = "none";
    signupmodel.style.display = "block";
})
$(".closesignup").click(function(){
   signupmodel.style.display = "none";
})
$(".close").click(function(){  
      var myModal = document.getElementById('myModal');
      
   myModal.style.display = "none";
})


$('.cart-placement__show-more--minimum').click(function(){
   if($(this).hasClass('open')){
       $(this).text('More');
       $(".grid-product--cart--default:nth-child(4)" ).css("display", "none");
       $(".grid-product--cart--default:nth-child(5)" ).css("display", "none");
       $(".grid-product--cart--default:nth-child(6)" ).css("display", "none");
       $(this).removeClass('open');
   }else{
       $(this).text('Less');
       $(".grid-product--cart--default:nth-child(4)" ).css("display", "block");
       $(".grid-product--cart--default:nth-child(5)" ).css("display", "block");
       $(".grid-product--cart--default:nth-child(6)" ).css("display", "block");
       $(this).addClass('open');
   }    
});
</script>   