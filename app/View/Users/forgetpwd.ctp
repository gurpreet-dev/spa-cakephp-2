<div class="smart_container">

    <div class="container">
        <div class="row">

            <div class="globel_headding">
                <div class="title_text">Forgot Password</div>
            </div>
            
           <div class="col-sm-4 col-sm-offset-4" id="frgmain">
           	<?php echo $this->Session->flash('forget'); ?>
                <div class="forgot_pge">
                
                    <form action="<?php echo $this->webroot."users/forgetpwd";?>"  method="post" accept-charset="utf-8">
                        <label>Enter your registered Email address, and we’ll send you a password reset link.</label>

                        <div class="form-group">
                            <input type="text"  name="data[User][username]" class="form-control" placeholder="email@abc.com">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-default defult_btn" value="Reset password">
                        </div>
                    </form>

                </div>
            </div>           
        </div>
    </div>
</div>

<?php 
$msg = '';
if(isset($smtp_errors)) { 
$msg .= '<div class="forgot-success"><h2 class="title_text">Forgot Password ?</h2><p>We have sent a reset password link to your email account.</p><a href="#" data-toggle="modal" data-target="#myModal">Login</a></div>';
?>
	<script>
    $(".forgot_pge").css("display","none");
	$(".globel_headding").css("display", "none");
	
	$("#frgmain").html('<?php echo $msg ?>');
    </script>
<?php } ?>
<style>
.forgot-success {
    width: 100%;
    float: left;
    background-color: #f2f2f2;
    padding: 10% 0%;
    text-align: center;
	box-shadow: 4px 6px 7px rgba(0,0,0,0.1);
	margin: 60px 0;
}

.forgot-success h2 {
    width: 100%;
    float: left;
    margin-bottom: 20px;
}

.forgot-success p {
    margin-bottom: 20px;
    width: 100%;
    float: left;
    padding: 0px 1px;
}

.forgot-success a {
    color: #006500;
}
</style>