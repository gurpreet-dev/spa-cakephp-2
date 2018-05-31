<?php echo $this->set('title_for_layout', 'Order Review'); ?>
<div class="shopping_details">
<div class="row">
    <div class="medium-4 columns ">
        <div class="panel panel-default panelbox">
            <div class="panel-heading">
                <h3 class="panel-title">Customer Info</h3>
            </div>
            <div class="panel-body">
                First Name: <?php echo $shop['Order']['first_name'];?><br />
                Last Name: <?php echo $shop['Order']['last_name'];?><br />
                Email: <?php echo $shop['Order']['email'];?><br />
                Phone: <?php echo $shop['Order']['phone'];?>
            </div>
        </div>
    </div>
    <div class="medium-4 columns ">
        <div class="panel panel-default panelbox">
            <div class="panel-heading">
                <h3 class="panel-title">Shipping Address</h3>
            </div>
            <div class="panel-body"> 
                Shipping Address: <?php echo $shop['Order']['shipping_address'];?><br />
                Shipping City: <?php echo $shop['Order']['shipping_city'];?><br />
                Shipping Zip: <?php echo $shop['Order']['shipping_zip'];?><br />
              
            </div>
        </div>
    </div> 
    
    
    
       <div class="medium-4 columns "> 
        <div class="panel panel-default panelbox">
            <div class="panel-heading">
                <h3 class="panel-title">Pay with Paypal</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $this->webroot."shop/review"?>" method="post">
		    <div class="paymnt_img">
                        <button type="submit" name='submit'>
                            <img src="<?php echo $this->webroot;?>home/images/paypal_icon.png" alt=""> 
                            Proceed to pay
                        </button>
                    </div>
   
		
                </form>
              
            </div>  
        </div>
    </div> 
    
    
    
    </div>

</div>


