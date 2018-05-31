<?php //echo "<pre>"; print_r($subscriptions); echo "</pre>"; ?>

	<div class="box-header">
              <h3 class="box-title">All Subscriptions</h3>

              <div class="box-tools">
                <!--<div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>-->
              </div>
            </div>
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                    <th><?php echo $this->Paginator->sort('id');?></th>
                    <th>Duration</th>
                    <th><?php echo $this->Paginator->sort('subscribe_date');?></th>
                    <th><?php echo $this->Paginator->sort('expire_date');?></th>
                    <th><?php echo $this->Paginator->sort('subscribe_amount');?></th>
                    <th>Status</th>
                    <th><?php echo $this->Paginator->sort('created');?></th>
                    <th><?php echo $this->Paginator->sort('modified');?></th>
                </tr>
                <?php foreach($subscriptions as $sub){ ?>
                <tr>
                  <td><?php echo $sub['Subscription']['id']; ?></td>
                  <td><?php echo date("F", strtotime($sub['Subscription']['subscribe_date'])).' To '.date("F", strtotime($sub['Subscription']['expire_date'])); ?></td>
                  <td><?php echo date('d M, Y', strtotime($sub['Subscription']['subscribe_date'])); ?></td>
                  <td><?php echo date('d M, Y', strtotime($sub['Subscription']['expire_date'])); ?></td>
                  <td>$<?php echo $sub['Subscription']['subscribe_amount']; ?></td>
                  <td>
                  <?php
                  $expire_date = strtotime($sub['Subscription']['expire_date']).'<br>';
                  $current_date = time();
                  
                  
                  if($current_date > $expire_date){
                  	echo '<span class="label label-danger">Expired</span>';
                  }else{
                  	echo '<span class="label label-success">Approved</span>';
                  }
                  ?>
				  </td>
                  <td><?php echo $sub['Subscription']['created']; ?></td>
                  <td><?php echo $sub['Subscription']['modified']; ?></td>
                </tr>
                <?php } ?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <?php echo $this->Paginator->numbers(); ?>
    </section>  
