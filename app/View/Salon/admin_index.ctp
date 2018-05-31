<?php //echo "<pre>"; print_r($salons); echo "</pre>"; ?>

<section class="content-header">
      <h1>
        Booking Report (Stores)
      </h1>
    </section>
<section class="content">
<div class="row">
<?php echo $this->Session->flash('admin_pass'); ?>
<?php echo $this->Session->flash('user_delete'); ?>
	<div class="col-sm-12"> 
		<div class="box">
            <!--<div class="col-sm-6">
                <form id="" method="post" class="pull-right set_rght" action="">
                    <div class="search_user">
                        <button type="submit" class="search_button1 btn btn-primary pull-right adj_crt">Search</button>
                        <input type="text" name="data[Order][start_date]" id="start_date" placehoder="Start Date" value="<?php echo $start_date; ?>" />
                        <input type="text" name="data[Order][end_date]" id="end_date" placehoder="Start Date" value="<?php echo $end_date; ?>"/>
                    </div>
                </form>
                <label>Filter By Date</label>
            </div>-->
            <div class="col-sm-6 col-md-offset-6">
                <div class="up-img_sec"> 
                 	<?php if($keyword != ''){ ?>
                    <a href="" class="btn btn-danger pull-right gap_script">View All</a>
                    <?php } ?>
                    <form id="" class="pull-right" method="post" action="<?php echo $this->webroot?>admin/salon">
                        <div class="search_user">
                            <button type="submit" class="search_button1 btn btn-primary">Search</button>
                            <input type="text" class="form-control" name=data[User][search] placeholder="Search Store By Name" value="<?php echo $keyword; ?>">
                        </div>
                    </form>
				</div>
            </div>
			<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id', 'Store ID');?></th>
					<th><?php echo $this->Paginator->sort('name');?></th>
                    <th><?php echo $this->Paginator->sort('address');?></th>
					<th>Bookings</th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<th class="actions">Actions</th>
				</tr>
				<?php foreach ($salons as $salon): ?>
				<tr>
					<td><?php echo h($salon['User']['id']); ?></td>
					<td><?php echo h($salon['User']['store_name']); ?></td>
					<td><?php echo h($salon['User']['address']); ?></td>
					<td><?php echo count($salon['Bookings']); ?></td>
					<td><?php echo h($salon['User']['created']); ?></td>
					<td><?php echo h($salon['User']['modified']); ?></td>
					<td class="actions">
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-info fa fa-eye', 'title' => 'View')), array('action' => 'view', $salon['User']['id']),array('escape'=>false));  ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
</section>
<?php echo $this->element('pagination-counter'); ?>
<?php echo $this->element('pagination'); ?>

<style>
.up-img_sec {
    width: 100%;
    float: left;
    padding: 12px 0;
}
.form-control {
    width: auto;
    float: left;
  
}
.search_button1.btn.btn-primary {
    width: auto;
    margin-left: 7px;
}

.search_user {
    width: auto;
    float: left;
}
.btn.btn-danger.pull-right {
    margin-right: 11px;
}



</style>
<script>
$("#start_date").datepicker({dateFormat: 'dd-mm-yy'});

$(document).delegate("#start_date", "change", function(){
  	var date = $(this).datepicker('getDate');
	var date = new Date(date);
	var newDate = date.toString('m-d-Y');
	$( "#end_date" ).datepicker({minDate: new Date(newDate), dateFormat: 'dd-mm-yy'});
});

</script>