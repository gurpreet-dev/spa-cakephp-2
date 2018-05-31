<?php 
    echo $this->set('title_for_layout', 'Profile Details');  
?>  
<script type="text/javascript">
    (function(e,t,n){var r=e.querySelectorAll("html")[0];
        r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")
    })
    (document,window,0);
</script>
<script src="<?php echo $this->webroot; ?>js/freshslider.min.js"></script>
<link href="<?php echo $this->webroot; ?>css/freshslider.min.css" rel="stylesheet">
<!-- HTML Section Start Here -->

<!-- New Design -->
<div class="title-bar">
    <div class="row">
        <div class="large-12 column center">
            <h1 class="heading-title">Account</h1>
        </div>
    </div>
</div>
<?php //echo "<pre>"; print_r($data); echo "</pre>"; ?>
<div class="row">
<div class="large-3 medium-3 column nav-column">
<h3 class="subhead-2">Account</h3>
<ul class="no-bullets">
<li><a href="">Personal Info</a></li>
<li><a href="<?php echo $this->webroot; ?>users/edit">Edit profile</a></li>
<li><a href="<?php echo $this->webroot; ?>shop/wishlist">Wishlist</a></li>
<li><a href="<?php echo $this->webroot; ?>orders/orderlist">Orders</a></li>
<li><a href="<?php echo $this->webroot; ?>shop/referrals">Refer Friends</a></li>
<li><a href="<?php echo $this->webroot; ?>users/logout">Sign Out</a></li>
</ul>
</div>
<div class="large-9 medium-9 column">
<?php echo $this->Form->create('User'); ?>
<h3 class="subhead-2">Update Personal Infomation</h3>
<div class="row">
<?php echo $this->Form->input('id'); ?>
<div class="large-6 column">
    <?php echo $this->Form->input('first_name', array('id' => 'pfirst_name')); ?>
</div>
<div class="large-6 column">
<?php echo $this->Form->input('last_name', array('id' => 'plast_name')); ?>
</div>
</div>
<div class="row">
<div class="large-12 column">
<?php echo $this->Form->input('email', array('id' => 'pemail')); ?>
    <input type="hidden" name="data[User][type]" value="personal">
</div>
   
</div>
<!--<input type="submit" name="submit" value="Update Personal Information" class="button">-->
<?php echo $this->Form->end(array('id' => 'chper', 'class' => 'button', 'value'=>'Update Personal Information', 'label'=>'Update Personal Information')); ?> 

<?php echo $this->Form->create('User'); ?>
<h3 class="subhead-2">Change Password</h3>
<div class="row">
    <?php echo $this->Form->input('id'); ?>
<div class="large-6 column">
<label for="registered_account_password">Password</label>
<input type="password" name="pass" id="npass">
</div>
<div class="large-6 column">
<label for="registered_account_password_confirmation">Password confirmation</label>
<input type="password" name="cpass" id="cpass">
</div>
</div>
<input type="hidden" name="data[User][type]" value="password">
<?php echo $this->Form->end(array('id' => 'chpas', 'class' => 'button', 'value'=>'Change password', 'label'=>'Change password')); ?> 
</div>
</div>
<!-- New Design (End) -->


<?php /* ?>
<div class="module-product-placement small-12 column">
    <div>
        <div class="row">
            <div class="small-12">
                <h2 class="heading-row heading-row--has-subheader">Profile Details</h2>
                <?php echo $this->Session->flash('pwdupdate') ?>
                <ul class="profile_det">
                    <li class="left_sec">
                        <div class="shipment1">
                            <?php  if($data['User']['image']) { $image=$data['User']['image'];?> 
                            <img src="<?php echo $this->webroot."files/profile_pic/".$image; ?>" width="380" height="500" alt="" class="img-rounded img-responsive" />
                            <?php }else { $image = $this->webroot."files/noimagefound.jpg"; }  ?>
                        </div>
                        <form action="<?php echo $this->webroot; ?>users/myaccount" method="POST" enctype= "multipart/form-data" class="upload_pic1" >
                            <div class="upload-btn ">
                                <input type="file" name="data[User][image]" value="" id="file-2" class="" data-multiple-caption="{count} files selected" multiple />
                                <span>Choose your image</span>
                            </div>
                            <input type="submit" name="Submit" value="Submit" class="upload_pic12 btn defult_btn">
                        </form>
                    </li>
                    <li class="right_sec">
                        <div class="user_details">
                            <span class="text1"><?php echo $data['User']['first_name']; ?> <a href="<?php echo $this->webroot; ?>users/track_order" class="order-btn"> My Orders</a><a href="<?php echo $this->webroot; ?>shop/wishlist" class="order-btn"> My Wishlist</a></span>
                            <span class="text2 text4"><b>E-mail</b>: <?php echo $data['User']['email']; ?> </span>
                        </div>
                        <div class="edit_profile">
                            <a href="<?php echo $this->webroot; ?>users/edit" class="btn_edit"> Edit Profile</a>
                            <a href="<?php echo $this->webroot; ?>users/changepassword" class="btn btn-sm defult_btn ">Change Password</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php */ ?> 
<!-- HTML Section End Here -->

<script>
    $('#chper').click(function(){
       var first_name = $('#pfirst_name').val();
       var last_name = $('#plast_name').val();
       var email = $('#pemail').val();
       
       if(first_name == '' || last_name == '' || email == ''){
           alert('Please fill all the fields');
           return false;
       }
       
    });
    
    $('#chpas').click(function(){
       var npass = $('#npass').val();
       var cpass = $('#cpass').val();
       
       if(npass == '' || cpass == ''){
           alert('Please fill all the fields');
           return false;
       }else if(npass != cpass){
           alert('New and confirm password is not equal');
           return false;
       }
       
    });
</script>