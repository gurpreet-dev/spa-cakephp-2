<div class="row push-down">
    <div class="large-5 medium-5 large-centered column">
        <div class="checkout-frame" id="checkout-login-form">
            <h3 class="modal-header logacc" style="width: auto; text-align: center;display: table;padding: 0;border-bottom: 3px solid #006500;font-size: 36px;font-weight: 500;color: #000;float: none;margin: 0 auto;">Log In</h3>
            <div class="checkout-panel" style="margin: 60px 0; width: 100%; float: left;">
                <div class="col-sm-4 col-sm-offset-4 ">
                <?php echo $this->Form->create('User', array('url'=>array('controller' => 'users','action' => 'login'))); ?>
              
                        <div class=" btn_expln">
                      
                            <?php echo $this->Form->input('username', array('label' => 'Email', 'type'=>'email', 'required'=>true, 'class'=>'btn_expln')); ?>
                            </div>
                            
                        
                    
                 
                                <div class=" btn_expln">
                               
                                    <?php echo $this->Form->input('password', array('label' => 'Password', 'required'=>true)); ?>
                                  </div>
                  <div class="sub_xolm">        
                <?php
				 echo $this->Form->submit(__('Submit',true), array('class'=>'btn btn-default fltr_colr button expand')); 
				   echo $this->Form->end();
				?>
                </div>
                <div class="forget_right"><a class="fb-fb" href="<?php echo $this->webroot?>users/forgetpwd">Forgot Password</a></div>
                <?php if(!$this->Session->check('User') && empty($ses_user))   { ?>   
                <a type="button" class="btn btn-just-icon btn-round fb-fb" id="facebook">
                	<!--<img src="/winegarden/app/webroot/img/fb.png" />-->   
   
   						</a>
                         
                <?php } ?>
                <!--<div class="row">
                       <p class="center secondary">Need an account?  <?php echo $this->Html->link('Sign Up',  array(
        'controller' => 'users',
        'action' => 'add',
        'full_base' => true
    )); ?></p>      
                </div>
					-->
			
			</div>
                  
             </div>
        </div>
    </div>
</div>