<?php
echo $this->set('title_for_layout', 'Order Success'); ?>
  <div class="container" style="padding:5% 0;">
    <div class="col-sm-12">
      <!--div class="fancy">
        <h2>Booking Success</h2>
      </div-->
    </div>
    
    
    
    
    
    <div class="col-sm-12">
      <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
      <div class="order-confrm">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="track-order">
  <tr>
    <td colspan="2" style="background-color: #ef3b85;"><h1 class="font_book">Booking Successful</h1></td>   
  </tr>
  <tr>
    <td class="text-center whitebg_color" colspan="2" style="background-color: #fff;padding-top: 52px !important;"><img src="<?php echo $this->webroot;?>home/images/confrm-order.png" alt="" class="msage_pic" >  
    <div class="set_word">
    <h4>You're all set!</h4>
    <h5>Order #: <?php echo $_GET['order_id']; ?></h5>
    <p>Thanks for being awesome,<br />we hope you enjoy your purchase! </p>
   
    </div>
    </td>
  </tr>   
  <!--tr>
  	<td  colspan="2" class="text-center whitebg_color"> 
            <span class="blue_color">Thank you for your booking on LOGO!</span><br/> 
            <span class="blue_color">Booking Id : <?php if(isset($_GET['order_id'])){ echo $_GET['order_id']; } ?></span>
        </td>   
  </tr-->  
</table>


        </div>
        </div>

      
        
        
      </div>
    </div>
    
    
  </div>