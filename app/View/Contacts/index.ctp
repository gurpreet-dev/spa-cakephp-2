<div class="available_table spa_ctct">
    <div class="container">
        <div class="table_heading">
            <h2>Contact Us</h2>
        </div>
    	<?php echo $this->Session->flash('contactus'); ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <div class="whte_cnt">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Name:</label>
                        <input type="text" class="form-control" name="data[Contact][name]" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="data[Contact][email]" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Phone:</label>
                        <input type="number" class="form-control" name="data[Contact][phone]" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Feedback:</label>
                        <textarea class="form-control" name="data[Contact][feedback]" id="feedback" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-success defult_btn colr_broad" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
</div>