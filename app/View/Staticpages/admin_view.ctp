<style>
	table{
		width:100%;
		margin:0px;
	}
	table img{
		width:100%;
	}
</style>

<section class="content-header marginbtm">
      <h1>
       View Static Pages
      </h1>
    </section>

    <div class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<table class="table table-bordered table-hover dataTable">
				<tbody>
					<tr>
						<td>Position:</td>
						<td><?php echo h($staticpage['Staticpage']['position']); ?></td>
					</tr>
					<tr>
						<td>Title:</td>
						<td><?php echo h($staticpage['Staticpage']['title']); ?></td>
					</tr>
					<tr>
						<td>Image:</td>
						<td>
							<?php echo $this->Html->image('../files/staticpage/'.$staticpage['Staticpage']['image'],
							array('alt'=>'Staticpage Image','style'=>'height:150px;')); ?>
						</td>
					</tr>
					<tr>
						<td>Created:</td>
						<td><?php echo h($staticpage['Staticpage']['created']); ?></td>
					</tr>
					<tr>
						<td>Status:</td>
						<td><?php  if($staticpage['Staticpage']['status']==1) { echo 'Active';}else{echo "Deactive";} ?></td>
					</tr>
                    <?php if($staticpage['Staticpage']['id'] != '52'){ ?>
					<tr>
						<td>Description:</td>
						<td><?php echo html_entity_decode($staticpage['Staticpage']['description'], ENT_QUOTES, "UTF-8");; ?></td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
