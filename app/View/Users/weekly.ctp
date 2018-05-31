<link rel="stylesheet" href="<?php echo $this->webroot . 'full_demo/reset.css'?>">
<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/libs/css/smoothness/jquery-ui-1.8.11.custom.css'?>" />
<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/jquery.weekcalendar.css'?>" />
<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/demo.css'?>" />
<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/skins/default.css'?>" />
<style>
.wc-grid-timeslot-header{vertical-align:top;}
.wc-grid-timeslot-header, .wc-header .wc-time-column-header {width: 62px;}
.weekly-border{border-bottom: 1px dotted #000; height: 21px; font-size: 12px; color: #fff;}
#weekly_header_dates{text-transform:capitalize;}

.myloader{
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.27);
    position: absolute;
    z-index: 999;
}
.myloader > img{
       width: 8%;
    text-align: center;
    margin: auto;
    display: table;
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
}
</style>
<div class="myloader" style="display:none;"> 
<img src="<?php echo $this->webroot ?>images/spa/loading.gif" />
</div>
<script type="text/javascript">
$(function() {
    var startDate;
    var endDate;
    
    var selectCurrentWeek = function() {
        window.setTimeout(function () {
            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }
    
    $('.week-picker').datepicker( {
        showOtherMonths: true,
        selectOtherMonths: true,
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate',"dateFormat", "dd-mm-yyyy");
			//$.datepicker.formatDate('dd-mm-yy', date);
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
            $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
            
            selectCurrentWeek();
			
			updateCalenderDateTime();
			
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
                cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
        }
    });
    
    $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
});

</script>

<script>

function updateCalenderDateTime(){

	var times = '<?php echo json_encode($times); ?>';
	
	times = JSON.parse(times);

	var data = {
		start_date: $('#startDate').text(),
		end_date: $('#endDate').text()
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/datesBetweenTwoDates',
		method: 'post',
		data: data,
		dataType: 'json',
		beforeSend:function(){
			$('.myloader').css('display', 'block');
		},
		success: function(json){
		
			/******** Header date(From - to) *********/
			$('.wc-toolbar .wc-title').html($('#startDate').text()+' - '+$('#endDate').text());
			/******** Header date(From - to) END *********/
			
			/*********** Header (DAYS) From  to ************/
			var html = '';
			html +='<td class="wc-time-column-header"></td>';
			for(var i=0; i < json.length; i++){
				html += '<td class="wc-day-column-header wc-day-1">'+json[i]['day']+'<br>'+json[i]['date']+'</td>';
			}
			html += '<td class="wc-scrollbar-shim" style="width: 17px;"></td>';
			
			$('#weekly_header_dates').html(html);
			/*********** Header (DAYS) From  to  (END)************/
			
			var second_html = '';
			
			/*********** Printing TIME Slots ************/
			second_html +='<td class="wc-grid-timeslot-header">';
			for(var i=0; i < times.length; i++){
				second_html +='<div class="wc-hour-header wc-business-hours">';
				second_html +='<div class="wc-time-header-cell" style="height: 20px; padding: 5px;">'+times[i]+'</span>';
				second_html +='</div>';
				second_html +='</div>';
			}
			second_html +='</td>';
			/*********** Printing TIME Slots (END) ************/
			
			/********** Creating Inner rows ***********/
			for(var i=0; i < json.length; i++){
			
				second_html += '<td class="ui-state-default wc-day-column wc-day-column-first wc-day-column-last '+json[i]['date']+'" data-date="'+json[i]['date']+'">';
				second_html += '<div class="wc-full-height-column wc-day-column-inner day-1 ui-droppable" data-date="'+json[i]['date']+'" style="height: 1840px;">';
				for(var j=0; j < times.length; j++){
					second_html += '<div class="weekly-border" data-time="'+times[j]+'"></div>';
				}
				
				second_html += '</div>';
				second_html += '</td>';
				
			}
			
			$('.wc-grid-row-events').html(second_html);	
			/********** Creating Inner rows (END) ***********/	
			
			
			for(var i=0; i < json.length; i++){
				$("td."+json[i]['date']+" .weekly-border[data-time='"+json[i]['timing_from']+"']").css( "background", "#bbf5bb" ).addClass(' free-day ');
				$("td."+json[i]['date']+" .weekly-border[data-time='"+json[i]['timing_from']+"']").nextUntil( "td."+json[i]['date']+" .weekly-border[data-time='"+json[i]['timing_to']+"']" ).css( "background", "#bbf5bb" ).addClass(' free-day ');
				$("td."+json[i]['date']+" .weekly-border[data-time='"+json[i]['timing_to']+"']").css( "background", "#bbf5bb" ).addClass(' free-day ');
			}	
			
			getUnavailable();	
			getBookings();				
		}
	});
}

</script>

<script>

function getUnavailable(){

	var start_date = $('#startDate').text();
	var end_date = $('#endDate').text();

	var data = {
		start_date: $('#startDate').text(),
		end_date: $('#endDate').text()
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/ajaxWeeklyUnavailable',
		method: 'post',
		data: data,
		dataType: 'json',
		success: function(obj){
		
			$.each(obj, function(key, value) {
				if(value.length != 0){
					
					for(var i=0; i < value.length; i++ ){

						$("td."+value[i].Unavailability.date+" .weekly-border[data-time='"+value[i].Unavailability.hourfrom+"']").css( "background", "#808080" ).switchClass('free-day', 'busy-time').attr('data-id', value[i].Unavailability.id);		
						
						if(value[i].Unavailability.note != null){
							var note = value[i].Unavailability.note;
						}else{
							var note = 'No note';
						}
						
						$("td."+value[i].Unavailability.date+" .weekly-border[data-time='"+value[i].Unavailability.hourfrom+"']").text(note);
						
						$("td."+value[i].Unavailability.date+" .weekly-border[data-time='"+value[i].Unavailability.hourfrom+"']").next("td."+value[i].Unavailability.date+" .weekly-border").text(value[i].Unavailability.hourfrom+' To '+value[i].Unavailability.hourto);
						
						$("td."+value[i].Unavailability.date+" .weekly-border[data-time='"+value[i].Unavailability.hourfrom+"']").nextUntil( "td."+value[i].Unavailability.date+" .weekly-border[data-time='"+value[i].Unavailability.hourto+"']" ).css( "background", "#808080" ).switchClass('free-day', 'busy-time').attr('data-id', value[i].Unavailability.id);			
						$("td."+value[i].Unavailability.date+" .weekly-border[data-time='"+value[i].Unavailability.hourto+"']").css( "background", "#808080" ).switchClass('free-day', 'busy-time').attr('data-id', value[i].Unavailability.id);			
					}
				}
			});
		}
	});	
}

function getBookings(){
	var data = {
		start_date: $('#startDate').text(),
		end_date: $('#endDate').text()
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/ajaxWeeklyBookings',
		method: 'post',
		data: data,
		dataType: 'json',
		success: function(obj){
			$.each(obj, function(key, value) {
				if(value.length != 0){
					
					for(var i=0; i < value.length; i++ ){

						$("td."+value[i].Order.booking_date+" .weekly-border[data-time='"+value[i].Order.start_time+"']").css( "background", "#f8b2cf" ).switchClass('free-day', 'booked');				
						$("td."+value[i].Order.booking_date+" .weekly-border[data-time='"+value[i].Order.start_time+"']").text(value[i].Order.first_name+' '+value[i].Order.last_name);	
						
						$("td."+value[i].Order.booking_date+" .weekly-border[data-time='"+value[i].Order.start_time+"']").next("td."+value[i].Order.booking_date+" .weekly-border").text(value[i].Order.start_time+' To '+value[i].Order.end_time);
							
						$("td."+value[i].Order.booking_date+" .weekly-border[data-time='"+value[i].Order.start_time+"']").nextUntil( "td."+value[i].Order.booking_date+" .weekly-border[data-time='"+value[i].Order.end_time+"']" ).css( "background", "#f8b2cf" ).switchClass('free-day', 'booked');
						$("td."+value[i].Order.booking_date+" .weekly-border[data-time='"+value[i].Order.end_time+"']").css( "background", "#f8b2cf" ).switchClass('free-day', 'booked');	
					}
				}
			});
			
			$('.myloader').css('display', 'none');	
		}
	});	
}

</script>

<script>

$(document).delegate('.weekly-border.free-day', 'click', function(){
	var date = $(this).parent().attr('data-date');
	var time = $(this).attr('data-time');
	
	$('#ua-Modal #date').text(date);
	$('#ua-Modal #from_time').text(time);
	
	$('#weekly-note').val('');
	
	var data = {
		date: date,
		time: time
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/ajaxGetTimeAfterTime',
		method: 'post',
		data: data,
		dataType: 'json',
		success: function(json){	
			var html = '';
			for(var i=1; i < json.length; i++){
				html +='<option>'+json[i]+'</option>';
			}			
			$('#to_time select').html(html);
		}
	});
	$('#ua-Modal-btn').trigger('click');
});

</script>

<script>

$(document).delegate('#add-una', 'click', function(){
	var note = $('#ua-Modal #weekly-note').val();
	var date = $('#ua-Modal #date').text();
	var start = $('#ua-Modal #from_time').text();
	var end = $('#ua-Modal #to_time select').val();
	
	if(note == ''){
		alert('Please add note for unavailability');
	}else{
		$.ajax({
			url: '<?php echo $this->webroot ?>users/ajaxAddUnvailability',
			method: 'post',
			data: {note:note, date: date, start: start, end: end},
			success: function(response){
				if(response == 'success'){
					$('#ua-Modal #close-mod').trigger('click');
					updateCalenderDateTime();
				}
			}
		});
	}
});

</script>

<script>

$(document).delegate('.weekly-border.busy-time', 'click', function(){
	var date = $(this).parent().attr('data-date');
	var id = $(this).attr('data-id');
	
	//$('#weekly-note').val('');
	
	var data = {
		id: id
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/ajaxGetUnavailabilityById',
		data: data,
		method: 'post',
		dataType: 'json',
		success: function(json){
		
			console.log(json)
		
			$('#ua-edit-Modal #weekly-note').val(json.Unavailability.note);
			$('#ua-edit-Modal #date').text(json.Unavailability.date);
			$('#ua-edit-Modal #una-id').val(id);			
			
			var html = '';
			
			for(var i=0; i<json.times.length; i++){
				if(json.Unavailability.hourfrom == json.times[i]){
					html +='<option selected="selected">'+json.times[i]+'</option>';
				}else{
					html +='<option>'+json.times[i]+'</option>';
				}
			}
			$('#ua-edit-Modal #from_time select').html(html);
			
			
			var html = '';
			
			for(var i=1; i<json.times.length; i++){
				if(json.Unavailability.hourto == json.times[i]){
					html +='<option selected="selected">'+json.times[i]+'</option>';
				}else{
					html +='<option>'+json.times[i]+'</option>';
				}
			}
			$('#ua-edit-Modal #to_time select').html(html);
			
			$('#ua-edit-Modal-btn').trigger('click');
		}
	});
	
});

</script>

<script>

$(document).delegate('#ua-edit-Modal #edit-una', 'click', function(){
	var date = $('#ua-edit-Modal #date').text();
	var from = $('#ua-edit-Modal #from_time select').val();
	var to = $('#ua-edit-Modal #to_time select').val();
	var note = $('#ua-edit-Modal #weekly-note').val();
	var id = $('#ua-edit-Modal #una-id').val();
	
	var data = {date: date, from: from, to: to, note: note, id: id}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>users/ajaxEditWeeklyUnavailability',
		data: data,
		method: 'post',
		success: function(response){
			if(response == 'success'){
				$('#ua-edit-Modal #close-mod').trigger('click');
				updateCalenderDateTime();
			}else if(response == 'error'){
				alert('Error');
			}
		}
	});	
});

</script>

<script>

$(document).delegate('#ua-edit-Modal #del-una', 'click', function(){

	var id = $('#ua-edit-Modal #una-id').val();
	
	var data = {id: id}
	
	var r = confirm("Are you sure you want to delete your entry?");
	if (r == true) {
		$.ajax({
			url: '<?php echo $this->webroot ?>users/ajaxDeleteWeeklyUnavailability',
			data: data,
			method: 'post',
			success: function(response){
				if(response == 'success'){
					$('#una-alert-succ').css('display', 'block');
					$('#ua-edit-Modal #close-mod').trigger('click');
					updateCalenderDateTime();
				}else if(response == 'error'){
					alert('Error');
				}
			}
		});
	}
});


</script>
<div class="container">
<div class="table_heading lity_heading">
<h2>Availability/Unavailability</h2>
</div>

<!---------- Unavailability Modal ------------>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ua-Modal" id="ua-Modal-btn" style="display:none;">Open Modal</button>
<div id="ua-Modal" class="modal fade" role="dialog" style="font-size: 16px;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="background-image:url(<?php echo $this->webroot ?>images/avail.jpg);background-size: cover;width: 100%;float: left;height: 26%;">
    <button type="button" class="close" id="close-mod" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"><span aria-hidden="true">×</span></button>
    <!--button type="button" class="close" data-dismiss="modal" style="display:none;" id="close-mod">&times;</button-->
      <div class="modal-body avail_modals unav_add">
      <h1>Add Unavailability</h1>
      <table class="table-bordered" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin-top: 20px;">
      	<tr class="brdr_dull">
        	<td class="rv_line">Date</td><td id="date"></td>
            <td class="fom_left">From</td><td id="from_time"></td>
            <td class="to_frm">To</td><td id="to_time"><select required></select></td>
        </tr>

        <tr class="brdr_dull"><td>Note</td><td colspan="5"><textarea name="weekly-note" id="weekly-note" required></textarea></td></tr>
      </table>
       <button type="button" class="btn btn-default fltr_colr" id="add-una">Add</button>
      </div>
    </div>
  </div>
</div>
<!---------- Unavailability Modal (END) ------------>

<!---------- Unavailability Edit Modal ------------>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ua-edit-Modal" id="ua-edit-Modal-btn" style="display:none;">Open Modal</button>
<div id="ua-edit-Modal" class="modal fade" role="dialog" style="font-size: 16px;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="background-image:url(<?php echo $this->webroot ?>images/avail.jpg);background-size: cover;width: 100%;float: left;height: 26%;">
    <button type="button" class="close" id="close-mod" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"><span aria-hidden="true">×</span></button>
    <!--button type="button" class="close" data-dismiss="modal" style="display:none;" id="close-mod">&times;</button-->
      <div class="modal-body avail_modals unav_add">
      <h1>Edit Unavailability</h1>
      <table class="table-bordered" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin-top: 20px;">
      	<tr class="brdr_dull">
        <td  class="rv_line">Date</td><td id="date"></td>
        <td class="fom_left">From</td><td id="from_time"><select required></select></td>
        <td class="to_frm">To</td><td id="to_time"><select required></select></td>
        </tr>
        
        <tr class="brdr_dull"><td>Note</td><td colspan="5"><textarea name="weekly-note" id="weekly-note" required></textarea></td></tr>
        <input type="hidden" id="una-id" />
      </table>
       <div class="brdr_dull1">
       <div class="col-sm-6">
       <button type="button" class="btn btn-default fltr_colr" id="edit-una">Update</button>
       </div>
       <div class="col-sm-6">
        <button type="button" class="btn btn-default fltr_colr rmove_cart" id="del-una">Delete</button>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
<!---------- Unavailability Edit Modal (END) ------------>


<?php //echo "<pre>"; print_r($times); echo "</pre>"; ?>
    
    <div class="col-md-3">
        <div class="week-picker"></div>
        <br /><br />
       
       <div style="visibility:hidden;">
        <label class="week_lngh">Week :</label> <span id="startDate"></span> - <span id="endDate"></span>
    </div>
    </div>
    
    <div class="col-md-9">    
   	<div id="calendar">
        <div class="ui-widget wc-container">
            <div class="ui-widget-header wc-toolbar">
                <h1 class="wc-title" style="height: 23px; line-height: 23px;"></h1>
            </div>
            <div class="ui-widget-content wc-header">
                <table>
                    <tbody>
                        <tr id="weekly_header_dates"></tr>
                    </tbody>
                </table>
            </div>
            <div class="wc-scrollable-grid" style="height: 550px;">
                <table class="wc-time-slots">
                    <tbody>
                        <tr class="wc-grid-row-timeslot">
                            <td class="wc-grid-timeslot-header" rowspan="2"></td>
                            <td colspan="7">
                            </td>
                        </tr>
                        <tr class="wc-grid-row-oddeven"></tr>
                        <tr class="wc-grid-row-events"></tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
   </div>


<script>

$(window).load(function(){

    $('.week-picker td.ui-datepicker-today .ui-state-highlight').trigger('click');
});  
</script> 


<script>
$('p').click(function(){
	$('.week-picker').css('display', 'block');
});


</script>

   
  
    