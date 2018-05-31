<section class="news-letter_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <?php echo $this->Session->flash('cancelorder'); ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Paypal Email address</label>
                        <input type="email" name="paypal_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">*Please enter your paypal email address for refund.</small><br>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    .news-letter_sec{
        width:100%;
        float:left;
        padding:90px 0px;
    }
    .news-letter_sec form button{
    border: none;
    border-radius: 0px;
    background: none;
    box-shadow: none;
    text-transform: uppercase;
    background: #006500;
    }
    .news-letter_sec form button:hover{
        background: #ef3b85;
    }
</style>