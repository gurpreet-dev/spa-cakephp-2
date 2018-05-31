<section class="content-header">

<div class="col-md-4 col-md-offset-4">
<div class="form11">
    <h2>Admin Login</h2>
    
    <div class="shot_less"><?php echo $this->Session->flash('admin_only_login'); ?></div>
     
<div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" method="post" action="<?php echo $this->webroot ?>admin/users/login">
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email</label>
          <div class="col-md-12">
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="data[User][username]">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password</label>
          <div class="col-md-12">          
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="data[User][password]">
            <div class="alert-warning" id= "passerror" style="display:none;"></div>
          </div>
        </div>
    
        <div class="form-group">        
          <div class="col-md-12">
          <div class="clr_rnb">
            <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </div>
     </form>   
    </div>
</div>
</div>
</div>
</section>
<style>
.clr_rnb input[type="submit"] {
    background-color: #006500;
    border: #006500;
}

.main-sidebar{display:none;}
header{display:none;}
footer{display:none;}
.form11 {
    width: 100%;
    float: left;
    padding: 15px;
    box-shadow: 0 0 10px #ccc;
    background: #fff;
    border-radius: 4px;
    margin-top: 80px;
}
.left-side{display:none;}
.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #ecf0f5 !important;
}
.content-wrapper, .right-side, .main-footer{
margin-left:0 !important;
}
.right-side {
    width: 100% !important;
    float: left;
    height: 627px;
	background-image:url(/spa/images/spa/log_rf.png);
	background-size:cover;
}
.shot_less .alert-danger {
    padding: 8px !important;
    margin-left: 0px;
	margin-bottom: 10px;
}


</style>