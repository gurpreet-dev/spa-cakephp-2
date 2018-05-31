<div class="smart_container add_grnd">

    <div class="container">
        <div class="row">

            <div class="globel_headding">
                <div class="title_text">Add Service</div>
            </div>
            
            <?php echo $this->Session->flash('addservice'); ?>
            
            <div class="col-sm-6 col-sm-offset-3">
                <div class="forgot_pge">
                    <form action="<?php echo $this->webroot; ?>users/addservice" name="addservice" method="post"> 

                        <div class="form-group"> 
                            <select name="data[Service][category_id]" class="form-control" id="category_id" required>
                                <option value="">Choose category</option>
                                <?php foreach($categories as $category){ ?>
                                <option value="<?php echo $category['Category']['id']; ?>"><?php echo $category['Category']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group"> 
                            <input type="text" name="data[Service][name]" class="form-control" placeholder="Service Name" id="name" required>
                        </div>
                        
                        <div class="form-group"> 
                            <input type="text" name="data[Service][price]" class="form-control" placeholder="Service Price (in pounds)" id="price" required>
                        </div>
                    
                        <div class="form-group"> 
                            <input type="number" name="data[Service][duration]" class="form-control" placeholder="Service Duration (in minutes)" id="duration" required>
                        </div>
                    
                        <div class="form-group"> 
                            <div class="col-md-6">
                            <input type="radio" name="data[Service][status]" value="1" required> Active
                            </div>
                            
                            <div class="col-md-3 col-md-offset-3" style="text-align:left; padding-left:0px;">
                            <input type="radio" name="data[Service][status]" value="0" required> Deactive
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="submit" name="submit" class="btn btn-success defult_btn colr_broad" value="Save" id="submit">
                            </div> 
                            <div class="col-md-6" style="text-align:right;">
                                <input type="reset" name="cancel" class="btn btn-default defult_btn colr_broad" value="Reset">
                            </div> 
                        </div>
                    </form>

                </div>
            </div>           
        </div>
    </div>
</div>


