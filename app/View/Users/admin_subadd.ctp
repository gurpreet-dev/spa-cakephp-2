<div class="box-header with-border">
          <h3 class="box-title">Add Subscription</h3>
        </div>


<section class="content">
  <div class="row">
    <div class="col-sm-6">
      <div class="box ">
        <form action="" id="" method="post" accept-charset="utf-8">
        	<div class="box-body">
            
            <div class="input text">
              <label for="UserName">Freelancer</label>
              <select name="data[Subscription][id]" class="form-control" id="user_id" required>
              <option value="">Please select</option>
              	<?php foreach($users as $user){ ?>
                <option value="<?php echo $user['User']['id']; ?>"><?php echo $user['User']['store_name']; ?></option>
                <?php } ?>
              </select>
            </div>
            
            
            <div class="input text">
              <label for="UserName">Start date</label>
              <input name="data[Subscription][subscribe_date]" class="form-control" required="required" maxlength="255" id="subscribe_date" type="text" required disabled="disabled">
            </div>
            
            <div class="input text">
              <label for="UserUsername">Expiry date</label>
              <input name="data[Subscription][expire_date]" class="form-control" required="required" maxlength="255" id="expire_date" type="text" readonly=true />
            </div>
            
            <div class="input text">
              <label for="UserUsername">Amount</label>
              <input name="data[Subscription][subscribe_amount]" class="form-control" value="20.00" required="required" maxlength="255" id="UserUsername" type="text" readonly="readonly">
            </div>
            <button class="btn btn-primary main_btn" type="submit">Add Subscription</button>
          </div>
          </form>
        </form>
      </div>
    </div>
  </div>
</section>
<script>

$("#user_id").change(function(){
	var value = $(this).val();
	
	if(value != ''){
		$('#subscribe_date').removeAttr('disabled');
	}else{
		$('#subscribe_date').attr('disabled', 'disabled');
	}
	
});


$( "#subscribe_date" ).datepicker({ minDate: new Date(), dateFormat: 'dd-mm-yy'});

$(document).delegate("#subscribe_date", "change", function(){
	
	var date = $(this).val();
	var user_id = $("#user_id").val();
	
	var data = {
		date: date,
		user_id: user_id
	}
	
	$.ajax({
		url: '<?php echo $this->webroot ?>admin/users/dateAfterMonth',
		data: data,
		method: 'post',
		success: function(response){
			$("#expire_date").val(response);
		}
	});
	
		
});
</script>