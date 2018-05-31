<style>
    .ftr_pagination .pagination > li.current{
        /* border: 1px solid #dadada; */
        padding: 8px 14px;
        /* height: 36px; */
        line-height: 36px;
        background-color: #000;
        color: #fff;
    }
</style>
<div class="alert-danger" style="display:none;"><strong>Error: </strong> Please add items to cart from same store.</div>
<div class="alert-success" style="display:none;"><strong>Success: </strong> Product is added to cart.</div>
<div class="alert-warning" style="display:none;"><strong>Warning: </strong> Product is already exists in cart.</div>
<?php
 //echo "<pre>"; print_r($products); echo "</pre>";
if (!empty($products)):
    ?>  
    <ul class="grid-product__container grid-product__container--featured grid-product__container--featured--large" data-reactid="7">
     <?php foreach ($products as $val){ ?> 
                        <!---------product_item--------------->
                        <li class="grid-product grid-product--featured grid-product--featured--anonymous" data-reactid="8">
                        <?php if($loggeduser){ 
                           ?>
                       <?php 
                        if(count($val['Productlike'])>0){
                            foreach($val['Productlike'] as $prolike){
                             if($prolike['user_id'] != $loggeduser ){
                                 ?> 
                            
                             <i data-id="<?php echo $val ['Product']['id']; ?>" class="fa fa-heart-o prolike" aria-hidden="true"></i>
                            <?php
                                 
                             }else if($prolike['user_id'] == $loggeduser){
                                 ?>
                                 <i data-id="<?php echo $val ['Product']['id']; ?>" class="fa fa-heart prolike" aria-hidden="true"></i> 
                            <?php     
                             }
                               }
                               
                        }else{
                             ?> 
                            <i data-id="<?php echo $val ['Product']['id']; ?>" class="fa fa-heart-o prolike" aria-hidden="true"></i>
                            <?php
                        }
                               
                               
                                }  ?>
                        <div class="actions" data-reactid="9"> 
                        <?php if($val['Product']['stock'] != 0){ ?>
                        <a class="button small expand  btn_cart" id="<?php echo $val['Product']['id']; ?>" data-uid="<?php echo $loggeduser; ?>" data-id="<?php echo $val['Product']['id']; ?>" data-storeid="<?php echo $val['Product']['res_id']; ?>" href="javascript:void(0)">Add to cart
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
                        </a>
                        </li>
                        
                        <!---------product_item--------------->
                        <?php }
                        ?>
    </ul>
    <?php
    $paginator = $this->Paginator;
    ?>
    <div class="col-xs-12">

        <?php
        echo $this->Paginator->numbers(array(
            'before' => '<div class="pagination-sm ftr_pagination"><ul class="pagination pagination-primary">',
            'separator' => '',
            'tag' => 'li',
            'after' => '</ul></div>'
        ));
        ?>

    </div>	
    <?php
else:
    echo "Product Not find";
endif;
?>


<!------------------Featured starts-------------------------->

<?php
if (!empty($category['Category']['name'])):

    foreach ($popular as $popval) {
        
    }
    if ($popval['Review'] != null) {
        ?>
        <div class="col-sm-12">
            <div class="featurd_rivew voffset6">
                <div class="col-xs-12">
                    <div class="fancy">
                        <h2>Featured Reviews</h2>
                    </div>
                </div>
                <div class="fetrd_continer">
                    <?php
                    if (!empty($popular)):
                        foreach ($popular as $popval):
                            ?> 
                            <div class="col-sm-6">
                                <p><strong><?php echo $popval['Review'][0]['name']; ?></strong></p>
                                <div class="product_rating rating"> 

                                    <?php
                                    $avRating = $popval['Review'][0]['Product']['avg_rating'];
                                    $i = round($avRating);
                                    for ($j = 0; $j < $i; $j++) {
                                        ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>


                                        <?php } for ($h = 0; $h < 5 - $i; $h++) {
                                        ?>  

                                        <i class="fa fa-star-o" aria-hidden="true"></i>  
                                        <?php
                                    }
                                    ?>   

                                </div>
                                <p class="voffset2 headr"><?php echo $popval['Review'][0]['Product']['name']; ?></p>
                                <p><?php echo $popval['Review'][0]['Product']['description']; ?>
                                </p>
                                <p class="voffset3"><?php echo $popval['Review'][0]['created']; ?></p>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?> 
                </div>    
            </div>
        </div>
        <?php
    }
endif;
?>
<!------------------Featured end--------------------------> 


<!-----------------Shop on Instagram-------------------> 




