jQuery(document).ready(function(){

	jQuery('.numeric1').on('keypress', function(event) {
		if (event.keyCode == 13) {
			return true;
		}
		return (/\d/.test(String.fromCharCode(event.keyCode)));
	});

	jQuery('.numeric').on('keyup change', function(event) {

		var quantity = Math.round(jQuery(this).val());

		if ((event.keyCode == 46 || event.keyCode == 8) && quantity > 0) {
		} else {
			if(/\d/.test(String.fromCharCode(event.keyCode)) === false) {
				return false;
			}
		}

		ajaxcart(jQuery(this).attr("data-id"), quantity, jQuery(this).attr("data-mods"));

	});

	jQuery(".remove").each(function() {
		jQuery(this).replaceWith('<a class="remove" id="' + jQuery(this).attr('id') + '" href="' + Shop.basePath + 'shop/remove/' + jQuery(this).attr('id') + '" title="Remove item"><img src="' + Shop.basePath + 'home/images/delete-icon.png" alt="Remove" /></a>');
	});

	jQuery(".remove").click(function() { 
		ajaxcart(jQuery(this).attr("id"), 0);
		window.location.reload();
		return false;
	});

	function ajaxcart(id, quantity, mods) {

		if(quantity === 0) {
			jQuery('#row-' + id).fadeOut(1000, function(){ jQuery('#row-' + id).remove(); });
		}

		jQuery.ajax({
			type: "POST",
			url: Shop.basePath + "shop/itemupdate",
			data: {
				id: id,
				mods: mods,
				quantity: quantity
			},
			dataType: "json",
			success: function(data) {
				jQuery.each(data.OrderItem, function(key, value) {
					if(jQuery('#subtotal_' + key).html() != value.subtotal) {
						jQuery('#ProductQuantity-' + key).val(value.quantity);
						jQuery('#subtotal_' + key).html(value.subtotal).animate({ backgroundColor: "#ff8" }, 100).animate({ backgroundColor: "#fff" }, 500);
					}
				});
				jQuery('#subtotal').html('$' + data.Order.total).animate({ backgroundColor: "#ff8" }, 100).animate({ backgroundColor: "#fff" }, 500);
				jQuery('#total').html('$' + data.Order.total).animate({ backgroundColor: "#ff8" }, 100).animate({ backgroundColor: "#fff" }, 500);
				if(data.Order.total === 0) {
					window.location.replace(Shop.basePath + "shop/clear");
				}
			},
			error: function() {
				window.location.replace(Shop.basePath + "shop/clear");
			}
		});
	}

});
