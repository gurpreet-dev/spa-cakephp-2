   <div class="box-header with-border">
          <h3 class="box-title">Edit Subscription</h3>
        </div>


<section class="content">
  <div class="row">
    <div class="col-sm-6">
      <div class="box ">
        	<form action="" id="" method="post" accept-charset="utf-8">
        	<div class="box-body">
            
                <div class="input text">
                    <label for="UserName">Start date</label>
                    <input name="data[Subscription][subscribe_date]" value="<?php echo $data['Subscription']['subscribe_date']; ?>" class="form-control" required="required" maxlength="255" id="subscribe_date" type="text">
                </div>
                
                <div class="input text">
                    <label for="UserName">Expiry date</label>
                    <input name="data[Subscription][expire_date]"  value="<?php echo $data['Subscription']['expire_date']; ?>" class="form-control" required="required" maxlength="255" id="expire_date" type="text" readonly=true />
                    
                    <input name="data[Subscription][id]" value="<?php echo $data['Subscription']['id']; ?>" type="hidden" />
                    
                    <input name="data[Subscription][user_id]" value="<?php echo $data['Subscription']['user_id']; ?>" type="hidden" />
                    
                </div>
                
                <div class="input text">
                    <label for="UserName">Expiry date</label>
                    <input name="data[Subscription][subscribe_amount]"  value="<?php echo $data['Subscription']['subscribe_amount']; ?>" class="form-control btm_ctl" type="text" readonly=true />
            	</div>

            <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn')); ?>
			</div>
          </form>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
$( "#subscribe_date" ).datepicker({ minDate: new Date(), dateFormat: 'dd-mm-yy'});

$(document).delegate("#subscribe_date", "change", function(){
	
	var date = $(this).val();
	var user_id = "<?php echo $data['Subscription']['user_id'] ?>";
	
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