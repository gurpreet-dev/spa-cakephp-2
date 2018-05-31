

$(function() {
    $(".success-message").delay(5000).fadeOut('slow');
});

$(function() {
    $(".error-message").delay(5000).fadeOut('slow');
});

$('#signupform #first_name, #signupform #last_name').keypress(function(e){
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    if(code == 32 || (code>=97 && code<=122)|| (code>=65 && code<=90))
        return true;
    else
        return false;
});

$('.pink_ment').click(function(){
	return false;
});
    
    
$(document).delegate("#reg-submit", "click", function(){
    var fname = $('#signupform #first_name').val();
    var lname = $('#signupform #last_name').val();
    var email = $('#signupform #email').val();
    var pass = $('#signupform #pass').val();
    var cpass = $('#signupform #cpass').val();
    var role = $("#signupform #role:checked").val();
    var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;   
	
	var form_data = new FormData();
	var ins = document.getElementById('multiFiles').files.length;
	for (var x = 0; x < ins; x++) {	
		form_data.append("files[]", document.getElementById('multiFiles').files[x]);
	}
	

    var data = {
        first_name: fname,
        last_name: lname,
        email: email,
        pass: cpass,
        role: role//,
		//files: form_data
    }
    
    var msg = '';
    if(role == 'customer'){
        msg = '<strong>Success!</strong> Registration successfully.';
    }else if(role == 'freelancer'){
        msg = 'Your details has  been sent to Admin for Confirmation, Please wait for the Admin to approve your request. ';
    }

    //alert(fname+', '+lname+', '+email+', '+pass+', '+cpass+', '+role);
    //return false;
    if(fname == '' || lname == '' || email == '' || pass == '' || cpass == '' || !$("#signupform #role:checked").val()){
        $(".reg-danger").html('You must fill in all of the fields.');
        $(".reg-danger").css('display', 'block');
    }else if(pass != cpass){
        $(".reg-danger").html('Password and Confirm Password fields do not match.');
        $(".reg-danger").css('display', 'block');
    }else if(!email_regex.test(email)){
        $(".reg-danger").html('Please Enter valid Email Address.');
        $(".reg-danger").css('display', 'block');
    }else if(role == 'freelancer' && ins == '0'){
		$(".reg-danger").html('Please add attachment files.');
        $(".reg-danger").css('display', 'block');
	}else{
		
		   $.ajax({
				url: '<?php echo $this->webroot; ?>users/ajaxsignup',
				method: 'post',
				data: data,
				dataType:'json',
				success: function(response){
					if(response.response == 'success'){
						$(".reg-danger").css('display', 'none');
						$(".reg-success").html(msg);
						$(".reg-success").css('display', 'block');
						
						$('#signupform #first_name').val('');
						$('#signupform #last_name').val('');
						$('#signupform #email').val('');
						$('#signupform #pass').val('');
						$('#signupform #cpass').val('');
						$("#signupform #role:checked").val('');
						
						if(role == 'freelancer'){
							$.ajax({
								url: '<?php echo $this->webroot ?>users/ajaxUploadImages', // point to server-side PHP script 
								dataType: 'json', // what to expect back from the PHP script
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,
								type: 'post',
								success: function (json) {
								console.log(json);
									
									if(json.error == 0){
								
										 $.ajax({
											url: '<?php echo $this->webroot; ?>users/updateDocuments',
											method: 'post',
											data: {input: json.input, id: response.last_id},
											dataType:'json',
											success: function(response){
											}
										});
											
									}
								}
							});
					   }
					
					}else if(response.response == 'error'){
						$(".reg-success").css('display', 'none');
						$(".reg-danger").html('<strong>Danger!</strong> Registration unsuccessful.');
						$(".reg-danger").css('display', 'block');
					}else if(response.response == 'exist'){
						$(".reg-success").css('display', 'none');
						$(".reg-danger").html('Email ID already registered. Try with another Email address.');
						$(".reg-danger").css('display', 'block');
					}
				}
		   });
	   
   }
   return false;
});    


$(document).delegate("#log-submit", "click", function(){
   var email = $('#loginform #email').val();
   var password = $('#loginform #password').val();
   
   var data = {
       email: email,
       password: password
   }
   
   var current_controller = '<?php echo $this->Session->read("current_controller") ?>';
   var current_action = '<?php echo $this->Session->read("current_action") ?>';
   
   if(email == '' || password == ''){
       $(".log-danger").html("<strong>Danger!</strong> Please fill all the fields.")
       $(".log-danger").css('display', 'block');
   }else{
       $.ajax({
          url: '<?php echo $this->webroot; ?>users/ajaxlogin',
          method: 'post',
          data: data,
          success: function(response){
              if(response == 'success'){
                    $(".log-danger").css('display', 'none');
					
					 $.post('<?php echo $this->webroot; ?>users/authRemember', function(data, status){
					 	
					 });
					 
					 if(current_action == 'checkout' && current_controller == 'Shop'){
						window.location.href = "<?php echo $this->webroot ?>shop/checkout";
					}else{					
						window.location.href = "<?php echo $this->webroot; ?>";
					}	
 
              }else if(response == 'error'){
                    $(".log-success").css('display', 'none');
                    $(".log-danger").html('<strong>Danger!</strong> Username or password is incorrect.');
                    $(".log-danger").css('display', 'block');
              }else if(response == 'admin'){
                    $(".log-danger").css('display', 'none');
                    window.location.href = "<?php echo $this->webroot; ?>admin/dashboards/dashboard";
              }
          }
        });
   }
   return false;
});   
   
   
$('#search-cat').keyup(function(){
    var value = $(this).val();
    var data = {
        value:value
    }

    $.ajax({
       url: '<?php echo $this->webroot ?>salon/ajaxgetCategories',
       data: data,
       method: 'post',
       dataType: 'json',
       success: function(json){


            console.log(json);
            var html = '<ul>';
            for(var i = 0; i < json.length; i++){
                html +='<li class="search-cat-res" data-id="'+json[i]['Category']['id']+'">'+json[i]['Category']['name']+'</li><br>';
            }
            html += '</ul>';
            $(".cat-results").html(html);
        }
    });
    if( value.length === 0 ) {
        $(".cat-results").html('');
    }
}); 

$(".cat-res-cross").click(function(){
	$('.cat-results').html('');
	$('#search-cat2').val('');
	$('#search-cat').val('');
});

$(document).delegate('.search-cat-res', 'click', function(){
    var id = $(this).data('id');
    var value = $(this).text();

    $("#search-cat").val(value);
    $("#search-cat2").val(id);
    $(".cat-results").html(''); 
});


$('#search-location').keyup(function(){
    var value = $(this).val();
    var data = {
        value:value
    }

    $.ajax({
       url: '<?php echo $this->webroot ?>salon/ajaxgetLocations',
       data: data,
       method: 'post',
       dataType: 'json',
       success: function(json){


            console.log(json);
			var html = '<div class="cat-res">';
            html += '<ul>';
            for(var i = 0; i < json.length; i++){
                html +='<li class="search-loc-res" data-id="'+json[i]['User']['id']+'">'+json[i]['User']['location']+'</li><br>';
            }
            html += '</ul>';
			html += '</div>';
            $(".loc-results").html(html);
        }
    });

    if(value == ''){
        $(".loc-results").html('');
    }

}); 

$(document).delegate('.search-loc-res', 'click', function(){
    var id = $(this).data('id');
    var value = $(this).text();

    $("#search-location").val(value);
    $(".loc-results").html(''); 
});

$(document).ready(function(){
    $("#search-name").DateTimePicker({
        dateTimeFormat : "dd-MM-yyyy HH:mm AA"
    });
}); 

$('#search-search').click(function(){
   var cat = $('#search-cat').val();
   var loc = $('#search-location').val();
   var date = $('input[name="date"]').val();
   
   if(cat == '' || loc == ''){
       alert('Please fill all the fields');
       return false;
   }   
});


$( "#cart-calender" ).datepicker({ minDate: new Date(), dateFormat: 'dd-mm-yy'});

$(document).delegate('#right_box_fixed','click', function(){
    
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '0'){
            $('#showemptycart').trigger('click');
        }else{
            showcart();
        }
    });
});

function showcart(){

    $.ajax({
       url: '<?php echo $this->webroot; ?>shop/getCartitems',
       method: 'post',
       dataType: 'json',
       success: function(json){

        var html = '';
        var total = '';
        
        $.each(json.OrderItem, function(key,val) {    
            
            html += '<tr>';
            html += '<td class="venue_left"><p>'+val.category+'</p></td>';
            html += '<td class="venue_left"><p>'+val.service+'</p></td>';
            
            html += '<td class="venue_left">';
            html += '<div class="time_sumry">';
            html += '<ul>';
            html += '<li><i class="fa fa-clock-o" aria-hidden="true"></i></li>';
            html += '<li class="space_left">'+val.time+'</li>';
            html += '</ul>';
            html += '</div>';
            html += '</td>';
            
            html += '<td class="venue_left"><p><i class="fa fa-gbp" aria-hidden="true"></i> <span style=" padding-right:3px;">'+val.price+'</span></p></td>';
            html += '<td class="venue_left"><i class="fa fa-window-close-o rem-cart" aria-hidden="true" data-id="'+val.service_id+'"></i></td>';
            html += '</tr>';
        });
        
        $('#cart-tble tbody').html(html);
        
		
		total +='<td width="56%" float="left"><span class="lft_ttl">Total</span></td>';
        total +='<td style="border-left:none;float: left;width: 50%;"><i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</td>';
        total +='<td style="border-left:none; width:28%;"><i class="fa fa-gbp" aria-hidden="true"></i>' +json.Price +'</td>';

		$('.cart-modal .total-conf tr').html(total);
        
        $('.cart_time_service h4').html('Service time: <span>'+json.Time+'</span> minutes');
        
        
        var data = {
            date: '<?php echo $current_date ?>',
            day: '<?php echo $current_day ?>',
            user_id: json.Salon
        }
        
        
        $.ajax({
            url: '<?php echo $this->webroot; ?>salon/ajaxavailable',
            data: data,
            method: 'post',
            success: function(response){
                $('.cart_time_service ul').html(response);
                
                $('.cart_time_service ul').attr('data-date', '<?php echo $current_date ?>');
                
                $('.cart_time_service ul li').addClass('free_time');
                
                $.ajax({
                    url: '<?php echo $this->webroot; ?>salon/ajaxunavailable',
                    data: data,
                    method: 'post',
                    dataType: 'json',
                    success:function(response){
						if(response != 'nodata'){
							for(var i=0; i < response.length; i++){
	
								var from = response[i]['Unavailability']['hourfrom'];
								var to = response[i]['Unavailability']['hourto'];
	
								$( ".cart_time_service ul li:contains('"+ from +"')" ).css( "background", "#808080" );
								$( ".cart_time_service ul li:contains('"+ from +"')" ).removeClass('free_time');
								$( ".cart_time_service ul li:contains('"+ from +"')" ).nextUntil( ".cart_time_service ul li:contains('"+ to +"')" ).css( "background", "#808080" );
								$( ".cart_time_service ul li:contains('"+ from +"')" ).nextUntil( ".cart_time_service ul li:contains('"+ to +"')" ).removeClass('free_time');
								$( ".cart_time_service ul li:contains('"+ to +"')" ).css( "background", "#808080" );
								$( ".cart_time_service ul li:contains('"+ to +"')" ).removeClass('free_time');
	
							}
						}
                    }
                });  
				
            }
        });
		
        $("#showcart").trigger('click');
        $('.cart_proceed').css('display', 'none');
        $("#cart-calender").trigger("change");
       }
    });
}    

$(document).delegate('.rem-cart', 'click',function(){
    var service_id = $(this).attr('data-id');
    
    var data = {
        service_id: service_id
    }
    
    $.ajax({
       url: '<?php echo $this->webroot; ?>shop/ajaxremovefromcart',
       data: data,
       method: 'post',
       success: function(response){
           if(response == 'removed'){
               
            $('#btn'+service_id).html('BOOK NOW');
            $('#btn'+service_id).attr('data-action', 'add');
            $('#btn'+service_id).removeClass('rmove_cart');
               
                    $.ajax({
                    url: '<?php echo $this->webroot; ?>shop/getCartitems',
                    method: 'post',
                    dataType: 'json',
                    success: function(json){
                        if(json.length == '0'){
                            $('#cart-tble tbody').html('');

                            //$('.cart-modal .total_book ul').html('');
							
							$('.cart-modal .total-conf tr').html('');
                        }else{

                            var html = '';
                            var total = '';

                            $.each(json.OrderItem, function(key,val) {    

                                html += '<tr>';
                                html += '<td class="venue_left"><p>'+val.category+'</p></td>';
                                html += '<td class="venue_left"><p>'+val.service+'</p></td>';

                                html += '<td class="venue_left">';
                                html += '<div class="time_sumry">';
                                html += '<ul>';
                                html += '<li><i class="fa fa-clock-o" aria-hidden="true"></i></li>';
                                html += '<li class="space_left">'+val.time+'</li>';
                                html += '</ul>';
                                html += '</div>';
                                html += '</td>';

                                html += '<td class="venue_left"><p>'+val.price+'</p></td>';
                                html += '<td class="venue_left"><i class="fa fa-window-close-o rem-cart" aria-hidden="true" data-id="'+val.service_id+'"></i></td>';
                                html += '</tr>';

                                //console.log(val);      
                            });

                            $('#cart-tble tbody').html(html);
                            
                            $('.cart-modal .alert').css('display', 'block');
                            //$(".cart-modal .alert").delay(2000).fadeOut('slow');//

                            /*total += '<li> <i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</li>';
                            total += '<li>'+ json.Price +'</li>';*/
							
							total +='<td width="56%" float="left"><span class="lft_ttl">Total</span></td>';
                            total +='<td style="border-left:none;float: left;width: 50%;"><i class="fa fa-clock-o" aria-hidden="true"></i>'+ json.Time +'</td>';
        					total +='<td style="border-left:none;width: 28%;"><i class="fa fa-gbp" aria-hidden="true"></i>' +json.Price +'</td>';

                            //$('.cart-modal .total_book ul').html(total);
							
							$('.cart-modal .total-conf tr').html(total);
                            
                            $('.cart_time_service h4').html('Service time: <span>'+json.Time+'</span> minutes');
                            
//                            $('#btn'+service_id).html('BOOK NOW');
//                            $('#btn'+service_id).attr('data-action', 'add');
//                            $('#btn'+service_id).removeClass('rmove_cart');
                            
                        }
                    }
                 });
            }  
            $("#cart-calender").trigger("change");
            updateCartCountonremove();
       }
   });    
});


    
$(document).delegate('#myModalnext .close', 'click', function(){
        location.reload();
});

function updateCartCountonremove(){
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '0'){
            $("#showcart").trigger('click');
            $('#showemptycart').trigger('click');
        }
    });
}

function updateCartCount(){
    $.post('<?php echo $this->webroot; ?>shop/getCartCount', function(data, status){
        $('#right_box_fixed h4').html(data);
        
        if(data == '1'){
            showcart();
        }
    });
}



<!------side-menu--------->

/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
} 


    $(document).delegate("#cart-calender", "change", function(){
    	
		
	
        var selected = $(this).val();
        var date = $(this).datepicker('getDate');
        
        $("#cart_day_this").val(date);
        
        $('.cart_time_service h5').html('Date: '+selected);
        
        var click_type = 'calender';
       
	   	//getCartSalonId();
	   
        updateCartDates(selected, date, click_type, '', '');
        
            
    });

    $(document).delegate('.free_time', 'click', function(){
        var value = $(this).text();
        var minutes = $('.cart_time_service h4 span').text();
        var date = $('.cart_time_service ul').attr('data-date');

        var data = {
            from_time: value,
            minutes: minutes,
            date: date
        }
        
        $.ajax({
            url: '<?php echo $this->webroot; ?>shop/selectCartDate',
            data: data,
            method: 'post',
            dataType: 'json',
            success: function(response){
                //alert(date+', '+value+', '+response);
                //console.log(response);
                var date_time = $('#cart_day_this').val();
                
                var click_type = 'ontime';
                
                //alert(date+', '+date_time);
				
				console.log(value+', '+response);
                
                updateCartDates(date, date_time, click_type, value, response);
                
            }
        });
    });

    function updateCartDates(selected, datess, click_type, freevalue, freeresponse){   
	
        var weekday = new Array();
        
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";
        
        
        
        var dayOfWeek = weekday[new Date(datess).getDay()];
		
		var user_id = $('#cart_salon_id').text();
        
        var data = {date: selected, user_id: user_id, day: dayOfWeek}
	
        console.log(data);
        var start_time = '';
                                    
        var end_time = '';
        getOrderBookings(selected);
        if(user_id != ''){
		
		
		
		
            $.ajax({
               url: <?php echo $this->webroot; ?>+'salon/ajaxavailable',
               data: data,
               method: 'post',
               success:function(response){
			   console.log(response);
                   $('.cart_time_service ul').html(response);
                   $('.cart_time_service ul').attr('data-date', selected);
                   $('.cart_time_service ul li').addClass('free_time');

                   $.ajax({
                        url: <?php echo $this->webroot; ?>+'salon/ajaxunavailable',
                        data: data,
                        method: 'post',
                        dataType: 'json',
                        success:function(response){
                            
                            if(response != 'nodata'){
                                for(var i=0; i < response.length; i++){

                                    var from = response[i]['Unavailability']['hourfrom'];
                                    var to = response[i]['Unavailability']['hourto'];

                                    $( ".cart_time_service ul li:contains('"+ from +"')" ).css( "background", "#808080" ).removeClass('free_time');
                                    $( ".cart_time_service ul li:contains('"+ from +"')" ).nextUntil( ".cart_time_service ul li:contains('"+ to +"')" ).css( "background", "#808080" );
                                    $( ".cart_time_service ul li:contains('"+ to +"')" ).css( "background", "#808080" ).removeClass('free_time');
                                }
                            }
							
                            if(click_type == 'ontime'){
                                if(freeresponse.length != '0'){
                                    var error = '0';
                                    for(var i=0; i < freeresponse.length; i++){
                                        if($( ".cart_time_service ul li:contains('"+ freeresponse[i] +"')" ).hasClass("free_time")){
                                            $( ".cart_time_service ul li.free_time:contains('"+ freeresponse[i] +"')" ).css( "background", "#ef3b85" );
                                            $('.cart_proceed').css('display', 'block');
                                            
                                            error = '0';
                                            
                                            if(i == '0'){
                                                start_time = freeresponse[i];
                                            }
                                            
                                            if(i == freeresponse.length - 1){
                                                end_time = freeresponse[i];
                                            }
                                            
                                        }else{       
                                            error = '1';
                                        }
                                    }
                                    
									console.log(start_time+', '+end_time);
									
                                    if(start_time != '' || end_time != ''){
                                        
                                        $(document).delegate('.cart_proceed', 'click', function(event){
                                            event.preventDefault();
                                            
                                            updateDateTimeInCart(start_time, end_time, selected);
                                            
                                        });
                                        
                                    }
                                    
                                    if(error == '1'){
                                        alert('We have found some busy time between your selected time. So you cannot select this time!!!');
                                        $("#cart-calender").trigger("change");
                                        $('.cart_proceed').css('display', 'none');
                                    }                               
                                }
                            }
					    }
                    }); 
                }
            });
        }
    }


function getOrderBookings(date){
	var user_id = $('#cart_salon_id').text();
	$.ajax({
		url: '<?php echo $this->webroot ?>shop/ajaxGetOrderBookings',
		data: {date: date, salon_id: user_id},
		method: 'post',
		success: function(response){
		console.log(response);
			if(response != ''){
			
				response = JSON.parse(response);
			
				for(var i=0; i<response.length; i++){
					$( ".cart_time_service ul li:contains('"+ response[i].Order.start_time +"')" ).css( "background", "#808080" ).removeClass('free_time');
					$( ".cart_time_service ul li:contains('"+ response[i].Order.start_time +"')" ).nextUntil( ".cart_time_service ul li:contains('"+ response[i].Order.end_time +"')" ).css( "background", "#808080" ).removeClass('free_time');;
					$( ".cart_time_service ul li:contains('"+ response[i].Order.end_time +"')" ).css( "background", "#808080" ).removeClass('free_time');
				}
			}
		}
	});
}


    function updateDateTimeInCart(start_time, end_time, date){
        
        var data = {
            start_time: start_time,
            end_time: end_time,
            date: date
        }
		
        $.ajax({
           url: '<?php echo $this->webroot ?>shop/addDateTimeInCart',
           data: data,
           method: 'post',
           success: function(response){
               window.location.href = '<?php echo $this->webroot ?>shop/checkout';
           }
        });
    }

<style>
tabel.tbl tr td:nth-child(1) { width:60%;}
</style>
$(document).ready(function(){
	$('.free_lancer').click(function(){
		var val = $('input:radio[name=role]:checked').val();
		//
		if(val == 'freelancer'){
			$("#multiFiles").css("display", "block");
		}else{
			$("#multiFiles").css("display", "none");
		}
	});
});

/*$(document).delegate('#regbu', 'click', function(e){		
	var form_data = new FormData();
	var ins = document.getElementById('multiFiles').files.length;
	for (var x = 0; x < ins; x++) {
	
		console.log(document.getElementById('multiFiles').files[x]);
	
		form_data.append("files[]", document.getElementById('multiFiles').files[x]);
	}
	$.ajax({
		url: '<?php echo $this->webroot ?>users/ajaxUploadImages', // point to server-side PHP script 
		dataType: 'text', // what to expect back from the PHP script
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: 'post',
		success: function (response) {
			$('#msg').html(response); // display success response from the PHP script
		},
		error: function (response) {
			$('#msg').html(response); // display error response from the PHP script
		}
	});
});*/