<div class="smart_container">

    <div class="container">
        <div class="row">

            <div class="globel_headding">
                <div class="title_text">Reset Password</div>
            </div>
            
            <?php echo $this->Session->flash('reset'); ?>

            <div class="col-sm-4 col-sm-offset-4">
                <div class="forgot_pge">
                    <?php echo $this->Form->create('User');   ?>
                        <label>Enter your new Password below</label>

                        <div class="form-group"> 
                            <input type="password" class="form-control" id="pass5" placeholder="New Password" name="data[User][password]">
                        </div>

                        <div class="form-group"> 
                            <input type="password" class="form-control" placeholder="Confirm Password" name="data[User][password_confirm]">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-default defult_btn" value="Reset password">
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>           
        </div>
    </div>
</div>

<script type="text/javascript">
          $(document).ready(function() {
                $("#reset").validate({
                    errorElement: 'span',
                    rules: {
                      "data[User][password]": "required",
                        "data[User][password_confirm]": {
                            required: true,
                            minlength: 8,
                            equalTo: "#pass5"
                        }
                    },
                    messages: {
                           "data[User][password_confirm]": {
                            required: "Please Enter confirm password",
                            equalTo: "Confirm Password is not matching your Password"
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
             
</script>