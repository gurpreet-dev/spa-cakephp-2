<div id="cart-detail" class="row store-detail-view" style="display: block;">
    <div data-reactroot=""  class="store-cart">
        <h1 style="font-size: 15px;">Wishlist</h1>
        <div class="row">
            <div class="large-12 column"> 
                <div class="alert-danger" style="display:none;"><strong>Error: </strong> Please add items to cart from same store.</div>
                <div class="alert-success" style="display:none;"><strong>Success: </strong> Product is added to cart.</div>
                <div class="row">
                        <div class="large-12 medium-12 medium-pull-4 columns">
                        <!-- react-empty: 30 -->
                        <table class="shipment-table">
                            <tbody>     
                                <?php if(!empty($wishlist)){ ?>
                                  <a style="float:right; margin-bottom: 15px;" class="deletewishlist button" data-uid="<?php echo $loggeduser; ?>" data-id="" href="javascript:void(0)">Delete All</a>
                                <?php foreach($wishlist as $product){ ?>
                                <tr class="shipment-table__item">  
                                    
                                    <td class="shipment-table__item__property shipment-table__item__property--image__container">
                                        <a href="<?php echo $this->webroot ?>product/<?php echo $product['Product']['slug'] ?>" class="item__link">
                                       <?php echo $this->Html->image('/images/large/' . $product['Product']['image'], array('class' => 'shipment-table__item__property--image')); ?>
                                        </a>
                                        </td>
                                        <td class="shipment-table__item__property shipment-table__item__property--main">
                                        <a href="/store/product/corona-extra/corona-extra-6-pack-12oz-bottles" class="item__link">
                                        <p class="shipment-table__item__remove-warning hidden">Item will be removed from cart.</p><span class="shipment-table__item__property--name">
                                        </span></a><?php echo $this->Html->link( $product['Product']['slug'], array('class' => 'shipment-table__item__property--image')); ?>                                            
                                        <br><span class="shipment-table__item__property--volume">
                                        <?php echo substr($product['Product']['description'],0,50) ?></span>     
                                        </p></span></td>
                                        <td class="shipment-table__item__property shipment-table__item__property--price"><span>$<?php echo $product['Product']['price']; ?>                                        
                                        </span>
                                        </td>
                                        <td style="width: 176px;">
                                            <a class="button btn defult_btn btn_cart" id="<?php echo $product['Product']['id']; ?>" data-id="<?php echo $product['Product']['id']; ?>" data-storeid="<?php echo $product['Product']['res_id']; ?>" href="javascript:void(0)">Add to cart
                                    </a>
                                        </td>
                                        <td>
                                            <a class="deletewishlist" data-uid="<?php echo $loggeduser; ?>" data-id="<?php echo $product['Product']['id']; ?>" href="javascript:void(0)"><i style="font-size: 23px;" class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                        
                                           
                                            
                                             </tr><?php } ?>
                                <?php }else{ ?>
                            <h2>Wishlist Empty</h2>
                                <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- react-empty: 5 -->
                <!-- react-empty: 6 -->
            </div>
                    </div>


<script>
    $(document).delegate('.deletewishlist', 'click', function(){
       var user_id = $(this).data('uid');
       var product_id = $(this).data('id');
       
       var data = {
           user_id: user_id,
           product_id: product_id
       }
       
       $.ajax({
          url: '<?php echo $this->webroot ?>products/ajaxproductlikes',
          data: data,
          method: 'post',
          success: function(){
              location.reload();
            }    
       });      
    });
    </script>