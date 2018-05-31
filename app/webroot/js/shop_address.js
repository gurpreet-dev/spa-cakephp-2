jQuery(document).ready(function(){

	jQuery('#OrderSameaddress').click(function(){

		if(jQuery('#OrderSameaddress').attr("checked", "checked")) {

			jQuery('#OrderShippingAddress').val(jQuery('#OrderBillingAddress').val());
			jQuery('#OrderShippingAddress2').val(jQuery('#OrderBillingAddress2').val());
			jQuery('#OrderShippingCity').val(jQuery('#OrderBillingCity').val());
			jQuery('#OrderShippingState').val(jQuery('#OrderBillingState').val());
			jQuery('#OrderShippingZip').val(jQuery('#OrderBillingZip').val());
			jQuery('#OrderShippingCountry').val(jQuery('#OrderBillingCountry').val());

		} else {

			jQuery("#OrderShippingAddress").val('');
			jQuery('#OrderShippingAddress2').val('');
			jQuery('#OrderShippingCity').val('');
			jQuery('#OrderShippingState').val('');
			jQuery('#OrderShippingZip').val('');
			jQuery('#OrderShippingCountry').val('');

		}

	});

});
