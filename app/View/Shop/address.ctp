<?php echo $this->set('title_for_layout', 'Checkout'); ?>
<!---------------------order_detls------------------>
<?php echo $this->Html->script(array('cart.js'), array('inline' => false)); ?>
<?php echo $this->Html->script(array('shop_address.js'), array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.validate.js', 'additional-methods.js'), array('inline' => false)); ?>

<?php //echo "<pre>"; print_r($shop); echo "</pre>"; ?>
<?php //echo "<pre>"; print_r($user_data); echo "</pre>"; ?>

<div class="container">
    <div class="col-sm-12">
        <div class="fancy">
            <h2>Checkout</h2>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <form action="<?php echo $this->webroot."shop/review"?>" method="post">
            <div class="col-sm-9 col-sm-offset-2" id="">
                <div class="ordr_addrssinr">
                    
                    <div class="row">
                        
                    <?php if($loggeduser){ ?>

                        <input type="hidden" name="uid" value="<?php echo $loggeduser ;?>">
                        <input type="hidden" name="first_name" value="<?php echo $user_data['User']['first_name']; ?>">
                        <input type="hidden" name="last_name" value="<?php echo $user_data['User']['last_name']; ?>">
                        <input type="hidden" name="phone" value="<?php echo $user_data['User']['phone']; ?>">
                        <input type="hidden" name="email" value="<?php echo $user_data['User']['email']; ?>">

                    <?php }else{ ?>
                            
                        <div class="col-sm-12">
                        <?php echo $this->Form->input('first_name', array('class' => 'form-control','placeholder'=> 'Enter First Name here', 'required' => 'required')); ?>
                            
                        </div>
                        <input type="hidden" name="uid" value="0">
                        <div class="col-sm-12">
                            <?php echo $this->Form->input('last_name', array('class' => 'form-control','placeholder'=> 'Enter Last Name Here', 'required' => 'required')); ?>
                        </div>
                        
                        <div class="col-sm-12">
                            <?php echo $this->Form->input('phone', array('class' => 'form-control field','placeholder'=> 'Phone Number', 'required' => 'required' , 'type' => 'text', 'autocomplete' => 'off', 'maxlength' => '10')); ?>
                        </div>
                        
                        <div class="col-sm-12">
                            <?php echo $this->Form->input('email', array('class' => 'form-control','placeholder'=> 'Enter Email Here', 'required' => 'required')); ?>
                        </div>
                        
                    <?php } ?>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-sm-12">
                            <label>Address</label>
                            <?php echo $this->Form->textarea('address', array('class' => 'form-control','placeholder'=> 'Enter Address Here','cols'=>'2', 'required' => 'required')); ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <?php echo $this->Form->input('city', array('class' => 'form-control','placeholder'=> 'Enter City Name Here','pattern'=>'[a-zA-Z ]+', 'autocomplete' => 'off', 'required' => 'required')); ?> </div>
                        <div class="col-sm-3">
                            <?php echo $this->Form->input('state', array('type' => 'form-control', 'class' => 'form-control','placeholder'=> 'Enter State Name Here','pattern'=>'[a-zA-Z ]+', 'autocomplete' => 'off', 'required' => 'required')); ?> </div>
                        <div class="col-sm-3">
                            <?php echo $this->Form->input('zip', array('class' => 'form-control field','placeholder'=> 'Enter Zip Code Here', 'autocomplete' => 'off', 'required' => 'required')); ?> </div>
                        <div class="col-sm-3">
                            <?php echo $this->Form->input('country', array('type' => 'form-control', 'class' => 'form-control','placeholder'=> 'Enter Country Name Here','pattern'=>'[a-zA-Z ]+', 'autocomplete' => 'off', 'required' => 'required')); ?> </div>
                    </div>
                                          
                    <div class="row">
                        <div class="clearfix">
                            <div class="sav_btn">
                                <?php echo $this->Form->button('Save &amp; Continue', array('class' => 'btn defult_btn2','id'=>'sub'));?> </div>
                        </div>
                    </div>
                                          
                </div>
            </div>
                              
            </form>
            
        </div>
    </div>
</div>    

<script type="text/javascript">
    

    
   
 jQuery.noConflict()(function ($) {   
    
jQuery(document).ready(function() {
   
          var editaddressform = jQuery("#orderaddress").validate({   
	errorClass: "my-error-class",
   	validClass: "my-valid-class", 
        rules: {
              "data[Order][first_name]" : { 
                lettersonly:true,       
                required: true 
                  } 
                 ,"data[Order][phone]": {  
                 number:true,
                minlength: 10,
                maxlength: 10
 
                  },
				  "data[Order][email]": {  
                 email:true,
               
                  },
				  "data[Order][shipping_address]":{
					  required: true   
				  },
				"data[Order][shipping_city]":{
					 required: true ,
					 lettersonly:true    
				}/*,
				"data[Order][shipping_state]":{
				 required: true ,
			     lettersonly:true 	
				}
				,
				"data[Order][shipping_country]":{
				 required: true ,
			     lettersonly:true 	 
				}*/ ,"data[Order][shipping_zip]": {  
                 number:true  
                  }
        },
        messages: {
          
          "data[Order][first_name]": {     
                    required: "Please enter valid first name", 
                },
             "data[Order][phone]": {  
                    required: "Please enter valid number(10 digits)",  
                },
				 "data[Order][email]": {  
                    required: "Please enter valid email id)",  
                }
        }
    });



    jQuery('#orderaddress').on('submit', function () {
    if(editaddressform.form()){ 
     
    } else {  
        return false;  
    }
});



	});
        }); 
  
</script>  