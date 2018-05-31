 <?php echo $this->set('title_for_layout', 'Change your Password'); ?>
 <div class="smart_container">
  <div class="container">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="row">  
      <div class="nww_passwrd" style="margin: 5% 0;">
     
        <div class="error-message" role="alert" id="passalert">
        	
        </div> 
     
      <div class="globel_headding">
                <div class="title_text pass_top">Change your Password</div>
            </div>
      <?php echo $this->Session->flash('changepass') ?>
      <?php echo $this->Form->create('User', array('id' => 'changepassword')); ?>
      <div class="col-sm-12">
     
  <div class="form-inr">
	<div class="form-group label-floating">
		<label>Old Password</label>
		   <input name="data[User][old_password]" type="password" class="form-control login-field focus_frm" value="" placeholder="Enter current password" id="opass" />
		
	</div>
	
	<div class="form-group label-floating">
		<label >New Password</label>
		    <input name="data[User][new_password]" type="password" class="form-control login-field focus_frm" value="" placeholder="Enter new password" id="npass" />
		
	</div>



	<div class="form-group label-floating">
		<label>Confirm Password</label>
		<input name="data[User][cpassword]" type="password" class="form-control login-field focus_frm" value="" placeholder="Retype new password" id="confipass" />
	</div>

      </div>
    </div>
    
    <div class="col-sm-12">

    <div class="reser_btn">
   
    	<input class="btn defult_btn btn_chdpwd" name="submit" type="submit" value="CHANGE PASSWORD">
       
    
       </div> 
 
    </div>
    <?php echo $this->Form->end(); ?>
      	
      </div>
      </div>
    </div>
  </div>
  </div>
  </div>
   
  <script type="text/javascript">
 $(document).ready(function(){
      $("#passalert").css("display", "none");
      $('.btn_chdpwd').click(function(event){
	  	//event.preventDefault();
         var opass = $('#opass').val().length;
         var npass = $('#npass').val().length;
         var cpass = $('#confipass').val().length;
         if(opass <= 0 || npass <= 0 || cpass <= 0){
             $("#passalert").html("Please fill all the field");
			 $("#passalert").css("display", "block");
             return false;
         }else if($('#npass').val() != $('#confipass').val()){
		     $("#passalert").html("Your Passwords doesnot match.");
			 $("#passalert").css("display", "block");
             return false;
         }
		 //$('#changepassword').submit();
		 //return false;
      });
  });    
      
   /* $("#changepassword").validate({
        errorElement: 'span',
        rules: {
            "opass": "required",
             "npass": "required",
            "cpass": {
                required: true,
                minlength: 8,
                equalTo: "#npass"
            }

        },
        messages: {
            "opass": "Please Enter Old password",
            "npass": "Please Enter New password",
            "cpass": {
                required: "Please Enter confirm password",
                equalTo: "Confirm Password is not matching your Password"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });*/
</script> 