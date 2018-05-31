<style>
	table{
		width:100%;
		margin:0px;
	}
	.input_file-sec{
		margin:0px;
	}
</style>
<!--<div class="page_heading">
	<h2>Product</h2>
</div>-->
<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box">
		<div class="box-header">
		<!-- <h3 class="box-title">Cart</h3> -->
		 <div class="nav-tabs-custom">
           <ul class="nav nav-tabs pull-right" style="border:none;">
              
              <li class="pull-left header"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
 Cart</li>
            </ul>
</div>

<!--			<div class="up-img_sec">
				<h2>Upload Image</h2>
				<?php //echo $this->Form->create('Product', array('type' => 'file')); ?>
				<?php //echo $this->Form->input('id', array('value' => $product['Product']['id'])); ?>
				<?php //echo $this->Form->input('slug', array('type' => 'hidden', 'value' => $product['Product']['slug'])); ?>
				<div class="input_file-sec">
                                    
				<?php //echo $this->Form->input('image', array('type' => 'file','div'=>false)); ?>
					<span class="input_img">Choose Image</span>
					<?php //echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
					<?php //echo $this->Form->end(); ?>
				</div>
			</div>-->
			<table class="table table-bordered table-hover dataTable">
				<tr>
					<td>Id</td>
					<td><?php echo h($cart['Cart']['id']); ?></td>
				</tr>
				<tr>
                                    <td>Session ID</td>
                                    <td><?php echo h($cart['Cart']['sessionid']); ?></td>
                                        
                                    </td>
				</tr>
				<tr>
					<td>Product ID</td>
					<td><?php echo h($cart['Cart']['product_id']); ?></td>
				</tr>
				<tr>
					<td>UID</td>
					<td><?php echo h($cart['Cart']['uid']); ?></td>
				</tr>
				<tr>
					<td>Store ID</td>
					<td><?php echo h($cart['Cart']['store_id']); ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?php echo h($cart['Cart']['name']); ?></td>
				</tr>
				
				<tr>
					<td>Email</td>
					<td><?php echo h($cart['User']['username']); ?></td>
				</tr>
                                
                <tr>
				<td>Image</td>
                <td><img src="<?php echo $this->webroot?>images/large/<?php echo h($cart['Product']['image']); ?>"></td>
				</tr>
                                
				<tr>
					<td>Price</td>
					<td><?php echo h($cart['Cart']['price']); ?></td>
				</tr>
                                <tr>
					<td>Quantity</td>
					<td><?php echo h($cart['Cart']['quantity']); ?></td>
				</tr>
				<tr>
					<td>Total</td>
					<td><?php echo h($cart['Cart']['subtotal']); ?></td>
				</tr>
								
				<tr>
					<td>Created</td>
					<td><?php echo h($cart['Cart']['created']); ?></td>
				</tr>
				<tr>
					<td>Modified</td>
					<td><?php echo h($cart['Cart']['modified']); ?></td>
				</tr>
			</table>
		</div>
       <button style="margin:10px;" type="button" class="btn btn-info btn-lg main_btn" data-toggle="modal" data-target="#myModal">Send Email</button>
	</div>
	</div> 
</div>
    
    
    
   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="<?php echo $this->webroot?>admin/Carts/emailSend" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="emailto" placeholder="Email to:" value="<?php echo $cart['User']['email']?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" name="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                 <div class="box-footer clearfix">
                <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                        <i class="fa fa-arrow-circle-right"></i></button>
            </div>
              </form>
            </div>
           
          </div>
      
    </div>
  </div>
  

</section>

<style>
img{
	width: 10%;
	float: left;
}
.nav-tabs-custom {
    margin-bottom: 5px;
    background: #fff;
    box-shadow:none;
    border-radius:0px; 
}
</style>