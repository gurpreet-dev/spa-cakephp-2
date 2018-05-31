<div class="smart_container">

    <div class="container">
        <div class="row">

            <div class="globel_headding">
                <div class="title_text">Add Unavailability</div>
            </div>
            
            <?php echo $this->Session->flash('addunavailability'); ?>
            
            <div class="col-sm-4 col-sm-offset-4">
                <div class="forgot_pge">
                    <form action="<?php echo $this->webroot; ?>users/addunavailability" name="addunavailability" method="post"> 

                    <div class="form-group">
                    	<label>Date of Birth</label>
                    	<input type="text" name="data[Unavailability][date]"  class="form-control radius_none"  id="datepicker" required="required">
					</div>
                        
                    
                        <div class="form-group"> 
							<label class="col-sm-2 control-label">Choose Time</label>
                          <div class="col-sm-4">
                             <select name="data[Unavailability][hourfrom]" required="required">
                                <optgroup label="Hours">
                                <?php for($i=0;$i<12;$i++){ ?>
                                <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                <?php } ?>
                                </optgroup>
                             </select> 
                             <select name="data[Unavailability][minutefrom]" required="required">
                                <optgroup label="Minutes">
                                <?php for($i=0;$i<60;$i++){ ?>
                                <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo sprintf('%02d', $i); ?></option>
                                <?php } ?> 
                                </optgroup>
                             </select> 
                             <select name="data[Unavailability][ampmfrom]" required="required">
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
                             </select> 
                             
                            <select name="data[Unavailability][hourto]" required="required">
                                <optgroup label="Hours">
                                <?php for($i=0;$i<12;$i++){ ?>
                                <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                                <?php } ?>
                                </optgroup>
                             </select> 
                             <select name="data[Unavailability][minuteto]" required="required">
                                <optgroup label="Minutes">
                                <?php for($i=0;$i<60;$i++){ ?>
                                <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo sprintf('%02d', $i); ?></option>
                                <?php } ?> 
                                </optgroup>
                             </select> 
                             <select name="data[Unavailability][ampmto]" required="required">
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
                             </select>   
  
                              </div>
                    		</div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="submit" name="submit" class="btn btn-success defult_btn" value="Save" id="submit">
                            </div> 
                        </div>
                    </form>

                </div>
            </div>           
        </div>
    </div>
</div>
<script type="text/javascript">
            $(function () {
                $('#datepicker').datepicker();
            });
        </script>

