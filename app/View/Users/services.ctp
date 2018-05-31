<div class="smart_container ">

    <div class="container">
        <div class="row">
           <div class="covr_vice">
           <div class="table_heading">
            	<h2>Services</h2>
            </div> 

            <?php echo $this->Session->flash('editservice'); ?>
            <?php echo $this->Session->flash('addservice'); ?>

            <div class="col-sm-12" style="padding:0px;">
                <div class="pull-right"><a href="<?php echo $this->webroot . 'users/addservice'; ?>"><button class="btn defult_btn">Add service</button></a></div>
                <div class="service_pg">
                    <?php if(!empty($services)){ ?>
                    <table class="table servicetbl" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>Sr no.</th>
                                <th>Service Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td data-label="Sr no."><?php echo $i; ?></td>
                                    <td data-label="Services Name"><?php echo $service['Service']['name']; ?></td>
                                    <td data-label="Category"><?php echo $service['Category']['name']; ?></td>
                                    <td data-label="Status"><span><?php if ($service['Service']['status'] == 1) {
                                echo "Active";
                            } else {
                                echo "Deactivate";
                            } ?></span> </td>
                                    <td data-label="Action">
                                        <a href="<?php echo $this->webroot . 'users/editservice/' . $service['Service']['id']; ?>"><button class="btn btn-default fltr_colr">Edit</button></a></td>

                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php }else{ ?>
                    <img src="<?php echo $this->webroot ?>files/No-results-found.png" class="mar_nig" />
                    <?php } ?>
                </div>
            </div>           
        </div>
    </div>
</div>
</div>