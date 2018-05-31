<div class="row push-down">
    <div class="large-10 medium-10 large-centered column">
        <div class="checkout-frame">
            <div class="modal-header mega-header">
                <h1 class="">Share with friends</h1>
                <h2>Get free drinks for spreading the word.</h2>
            </div>
            <div class="checkout-panel mega-body">
                <div class="row">                   
                    <div class="large-5 medium-5 column" style="display: table; float: none; margin: 0 auto;">
                    <ul class="actions">
                    <?php if($loggeduser){ ?>
                        <?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; ?>
                        <?php $url = $actual_link.$this->webroot; ?>
                    <!--<li><span class="code-block">NK060012</span></li>-->
                    <li><a class="button-v2 icon icon-twitter twitter" href="https://twitter.com/home?status=Get%20all%20types%20of%20wine%20on%20<?php echo $url ?>" target="_blank">Tweet it out</a></li>
                    <li><a class="button-v2 icon icon-facebook facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>" target="_blank">Share on Facebook</a></li>
                    <li><a class="button-v2 icon icon-email" href="mailto:?&body=Get%20all%20types%20of%20wine%20on%20<?php echo $url ?>" target="_blank">Email friends</a></li>
                    <?php }else{ ?>
                    <li><a class="button-v2" href="<?php echo $this->webroot ?>users/login">Login</a></li>
                    <li><a class="button-v2" href="<?php echo $this->webroot ?>users/add">Register</a></li>
                    <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

