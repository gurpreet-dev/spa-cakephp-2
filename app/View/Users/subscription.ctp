<?php //echo "<pre>"; print_r($user); echo "</pre>"; ?>
<?php //echo "<pre>"; print_r($subscriptions); echo "</pre>"; ?>

<style>
.subscription_table {
    width: 100%;
    float: left;
    padding: 5% 0;
 background-image:url(../images/subs.jpg);
 background-attachment:scroll;
 background-size:cover;
}
</style>


<!---------main-content----------->
<div class="subscription_table">
  <div class="container">
    <div class="col-sm-12">
      <div class="table_heading">
        <h2>Subscriptions</h2>
      </div>
      
      <?php if(!empty($subscriptions)){ ?>
      <table class="table border_light">
        <thead class="thead-inverse pink_heading">
          <tr>
            <th>Purchased On</th>
            <th>Purchased For</th>
            <th>Total Amount Paid</th>
            <th>Days Elapsed</th>
            <th>Days Remaining</th>
            <th>Next Renewal Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($subscriptions as $subscription){ ?>
          <tr>
            <th scope="row"><?php echo $subscription['Subscription']['subscribe_date']; ?></th>
            <td>
            <?php echo date("F", strtotime($subscription['Subscription']['subscribe_date'])).' To '.date("F", strtotime($subscription['Subscription']['expire_date'])); ?>
            
            </td>
            <td>&#163;<?php echo $subscription['Subscription']['subscribe_amount']; ?></td>
            
            <?php
            	$start_date=date_create($subscription['Subscription']['subscribe_date']);
                $current_date=date_create(date('d-m-Y'));
                $diff=date_diff($start_date,$current_date);
            ?>
            
            
            <td>
            <?php
            	if (strpos($diff->format("%R%a"), '-') !== false) {
                    echo '0';
                }else{
                    $elapsed = str_replace('+', '', $diff->format("%R%a"));
                    $elapsed = str_replace('-', '', $elapsed);
                    echo $elapsed;
                }
            ?>
            </td>
            
           	<?php
            	if (strpos($diff->format("%R%a"), '-') !== false) {
                    $current_date=date_create($subscription['Subscription']['subscribe_date']);
                }else{
                    $current_date=date_create(date('d-m-Y'));
                }
            	$end_date=date_create($subscription['Subscription']['expire_date']);
                
                $diff=date_diff($current_date, $end_date);
            ?>
            
            <td>
            <?php
            	$remaining = str_replace('+', '', $diff->format("%R%a"));
            	$remaining = str_replace('-', '', $remaining);
                echo $remaining;
            ?></td>
            <td><?php echo $subscription['Subscription']['expire_date']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php }else{ ?>
      <span>No Subscriptions Yet</span>
      <?php } ?>
    </div>
  </div>
</div>
