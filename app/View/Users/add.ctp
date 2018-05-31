 <div class="row push-down">
            <div class="large-5 medium-5 large-centered column">
                <div class="checkout-frame" id="checkout-login-form">
                    <h3 class="modal-header logacc" style="width: auto; text-align: center;display: table;padding: 0;border-bottom: 3px solid #006500;font-size: 36px;font-weight: 500;color: #000;float: none;margin: 0 auto;">Create an account</h3>
                    
          <div class="checkout-panel" style="margin: 60px 0; width: 100%; float: left;">
                    <div class="col-sm-4 col-sm-offset-4">
                        <?php echo $this->Form->create('User', array('url'=>array('controller' => 'users','action' => 'add'))); ?>
                    
                    <div class=" btn_expln">
                                    <?php echo $this->Form->input('first_name', array('autofocus' => 'autofocus','label' => 'First Name', 'required'=>true)); ?>
                              </div>
                          
                                <div class="btn_expln">
                                    <?php echo $this->Form->input('last_name', array('label' => 'Last Name','required'=>true)); ?>
                                </div>
                           
                        
                                <div class="btn_expln">
                                    <?php echo $this->Form->input('email', array('label' => 'Email', 'type'=>'email', 'required'=>true)); ?>
                                </div>
                        
                           
                                <div class="btn_expln">
                                    <?php echo $this->Form->input('password', array('label' => 'Password','autocomplete' => 'off', 'required'=>true)); ?>
                                </div>
                           
                                <div class="btn_expln">
                                    <?php echo $this->Form->input('confirmpassword', array('label' => 'Confirm Password', 'type'=>'password', 'autocomplete' => 'off', 'required'=>true)); ?>
                                </div>
                            </div>
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="btn_expln lw_role">
                                <label for="Role">Role</label>
                                <input type="radio" name="data[User][role]" value="freelancer">Freelancer
                                <input type="radio" name="data[User][role]" value="customer">Customer
                            </div>
                                </div>
                      
                        <input type="hidden" name="server" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                        <?php //echo $this->Form->input('role', array('type'=>'hidden', 'value'=>'customer')); ?>
                        
                        <!--<?php //echo $this->Form->end(__('Submit')); ?>-->
                        <div class="sub_abs">
                        <?php
				 echo $this->Form->submit(__('Submit',true), array('class'=>'btn btn-default fltr_colr button expand', 'id' => 'btnadd')); 
				   echo $this->Form->end();
				?>
                </div>
                        
                    </div>
                </div>
            </div>
        </div>
  </div>
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB4wBrdbmpvE5M1fA_dLsiM42L_7VsT_rQ"></script>
    <script src="assets/pages/signup-887f8e074e13e91e09918e0bd00879f9.js"></script>


</html>

<script>
    $("#btnadd").click(function(){
       if('input["type=radio"]' == ''){
           alert('Please select Role to sign up');
           return false;
       }
    });
    </script>