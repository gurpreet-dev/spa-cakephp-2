$(document).ready(function(){
	//alert('dfgrtg');
	
	//$('.btn_cart').on('click', function(event) { 
        $(document).delegate('.btn_cart', 'click', function(){
		var btn = $(this).attr("id");
                var product_quantity = $('#product_quantity').val();
                var cartpage = $('#cartpage').val();
                   
                var quantity ='';
                if(product_quantity === undefined){ 
                    quantity = 1;
                }else{
                   quantity = product_quantity; 
                }
		$.ajax({
			type: "POST",
			url: Shop.basePath + "shop/addtocart", 
			data: {
				id: $(this).attr("id"),
				quantity: quantity, 
				store_id: $(this).attr("data-storeid")
			},
			dataType: "json",
			success: function(data) {
			if(cartpage=='cartpage'){
                         window.location.reload();      
                        }
                        if(data['data']['cartcount'] == 1 && data.alert !='want to store change'){   
                         window.location.reload();        
                        }
            jQuery('#mini-cart-dd').removeClass('invisible');
	   jQuery("#mini-cart-dd").addClass("visible").delay(1000).queue(function(next){
            $(this).removeClass("visible");
            $(this).addClass("invisible");    
              next();
              });
	   
				
				if(data.success){
				//jQuery('#'+btn).html(' ');    		
				jQuery('#'+btn).html('<i class="fa fa-check" aria-hidden="true"></i> In Cart');	
                                //jQuery('#'+btn).html('Add to cart');
                                $('#'+btn).delay(1000).queue(function(n) { 
                                    $(this).html('Add to cart'); n();
                                });
				}
				console.log(data)
				jQuery('.cart-item-count').val(data['data']['cartcount'])
				if(data.alert){	
				if (window.confirm('Are you sure you want to change the shop? While adding item in the cart with the new shop, your previous cart items will be removed.?'))
						{
						   window.location.href= Shop.basePath+ "shop/clear" ;
						}
						//else
						//{    
						 // window.location.href= Shop.basePath;
                                               // }   

                                        } 
			
			
	 var html = '<ul class="cart-dropdown__item-list">'; 
        html += '<div class="animation-list-wrapper">';
		console.log(data)  
		jQuery('#cart_count').html(data['data']['cartcount'])
                jQuery('#crt_count1').val(data['data']['cartcount']) 
                jQuery('#heading-thin-smaller').html(data['data']['cartcount']) 
        $.each(data['data']['products'], function (index, value) {
			//console.log(value)
			 
            html += '<li class="cart-dropdown__item__container">\n\
                  <span class="cart-dropdown__item cart-dropdown__item--product link--black"><img class="cart-dropdown__item__content--secondary cart-dropdown__item__image" src="' + value.Product.image + '" alt="">\n\
                 <div class="cart-dropdown__item__content--main cart-dropdown__item__product"><div class="cart-dropdown__item__name">' + value.Cart.name + '</div>\n\
<div class="cart-dropdown__item__volume" >' + value.Cart.weight+ 'ml</div><div class="cart-dropdown__item__quantity">QTY: ' + value.Cart.quantity+ '</div></maindiv>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__price">' + value.Cart.quantity*value.Cart.price+ '</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__remove"><div class="cart-dropdown__item__remove__icon grey-link remove_item" id=' + value.Cart.product_id + '>×</div></div>';
           
            html += '</span></li>';
        }); 
        html += '</div>\n\
<li class="cart-dropdown__item cart-dropdown__item--subtotal">\n\
 <div class="cart-dropdown__item__content--secondary cart-dropdown__item__image--placeholder"></div>\n\
 <div class="cart-dropdown__item__content--main cart-dropdown__item__subtotal-label">Subtotal:</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__price">$' + data['data']['cartInfo']['subtotal'] + '</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__remove--placeholder"><input type="hidden" id="carttotal" value='+data['data']['cartInfo']['subtotal']+'></div>\n\
</li>\n\
</ul>';  
        $('#added_items').html(html);  
  
        rmv();
			},
			error: function() {
				//alert('big problems !!!');
			}
		});

		return false;

	});
	
	
	
	
	 $.getJSON("http://netin.crystalbiltech.com/winegarden/shop/webdisplaycart", function (data) { 
        var html = '<ul class="cart-dropdown__item-list">';
        html += '<div class="animation-list-wrapper">';
		console.log(data)
		jQuery('#cart_count').html(data['data']['cartcount'])
                jQuery('#crt_count1').val(data['data']['cartcount'])
                jQuery('#heading-thin-smaller').html(data['data']['cartcount'])
        $.each(data['data']['products'], function (index, value) {
			//console.log(value)
			 
            html += '<li class="cart-dropdown__item__container">\n\
                 <span class="cart-dropdown__item cart-dropdown__item--product link--black"><img class="cart-dropdown__item__content--secondary cart-dropdown__item__image" src="' + value.Product.image + '" alt="">\n\
                 <div class="cart-dropdown__item__content--main cart-dropdown__item__product"><div class="cart-dropdown__item__name">' + value.Cart.name + '</div>\n\
<div class="cart-dropdown__item__volume" >' + value.Cart.weight+ 'ml</div><div class="cart-dropdown__item__quantity">QTY: ' + value.Cart.quantity+ '</div></maindiv>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__price">' + value.Cart.quantity*value.Cart.price+ '</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__remove"><div class="cart-dropdown__item__remove__icon grey-link remove_item" id=' + value.Cart.product_id + '>×</div></div>';
           
            html += '</span></li>';
        });  
        html += '</div>\n\
<li class="cart-dropdown__item cart-dropdown__item--subtotal">\n\
 <div class="cart-dropdown__item__content--secondary cart-dropdown__item__image--placeholder"></div>\n\
 <div class="cart-dropdown__item__content--main cart-dropdown__item__subtotal-label">Subtotal:</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__price">$' + data['data']['cartInfo']['subtotal'] + '</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__remove--placeholder"><input type="hidden" id="carttotal" value='+data['data']['cartInfo']['total']+'></div>\n\
</li>\n\
</ul>';
        $('#added_items').html(html);  
  
        rmv();
        //$('#total_items').delay(2000).fadeIn('slow');
    });
	
	
	

	/* $('.btn_cart').on('click', function(event) {

		$.ajax({
			type: "POST",
			url: Shop.basePath + "shop/itemupdate",
			data: {
				id: $(this).attr("id"),
				quantity: 1
			},
			dataType: "json",
			success: function(data) {

				$('#msg').html('<div class="alert alert-success flash-msg">Product Added to Shopping Cart</div>');
				$('#cartbutton').show();
				$('.flash-msg').delay(2000).fadeOut('slow');

			},
			error: function() {
				alert('big problems !!!');
			}
		});

		return false;

	}); */
    
      function rmv() {
        jQuery('.remove_item').off("click").on('click', function () { 
            jQuery.ajax({
                type: "POST",
                url: "http://netin.crystalbiltech.com/winegarden/shop/webremoveitems",  
                data: {
                    id: jQuery(this).attr("id") 
                },
                dataType: "json",
                success: function (data) {   
                    
   var html = '<ul class="cart-dropdown__item-list">';
        html += '<div class="animation-list-wrapper">';
		console.log(data)   
		jQuery('#cart_count').html(data['data']['cartcount'])
                jQuery('#crt_count1').val(data['data']['cartcount'])
                jQuery('#heading-thin-smaller').html(data['data']['cartcount'])
                if(data['data']['cartcount'] == 0){  
                         window.location.reload();      
                        }
        $.each(data['data']['products'], function (index, value) { 
			//console.log(value)
			 
            html += '<li class="cart-dropdown__item__container">\n\
                <span class="cart-dropdown__item cart-dropdown__item--product link--black"><img class="cart-dropdown__item__content--secondary cart-dropdown__item__image" src="' + value.Product.image + '" alt="">\n\
                 <div class="cart-dropdown__item__content--main cart-dropdown__item__product"><div class="cart-dropdown__item__name">' + value.Cart.name + '</div>\n\
<div class="cart-dropdown__item__volume" >' + value.Cart.weight+ 'ml</div><div class="cart-dropdown__item__quantity">QTY: ' + value.Cart.quantity+ '</div></maindiv>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__price">' + value.Cart.quantity*value.Cart.price+ '</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__remove"><div class="cart-dropdown__item__remove__icon grey-link remove_item" id=' + value.Cart.product_id + '>×</div></div>';
           
            html += '</span></li>';
        }); 
        html += '</div>\n\
<li class="cart-dropdown__item cart-dropdown__item--subtotal">\n\
 <div class="cart-dropdown__item__content--secondary cart-dropdown__item__image--placeholder"></div>\n\
 <div class="cart-dropdown__item__content--main cart-dropdown__item__subtotal-label">Subtotal:</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__price">$' + data['data']['cartInfo']['subtotal'] + '</div>\n\
<div class="cart-dropdown__item__content--secondary cart-dropdown__item__remove--placeholder"><input type="hidden" id="carttotal" value='+data['data']['cartInfo']['total']+'></div>\n\
</li>\n\
</ul>'; 
        $('#added_items').html(html);    
  
        rmv();
                },
                error: function () { 
                    //alert('Error!');
                }
            });
            return false;
        });
      
    }  
    
    

});     
    