<?php //echo "<pre>"; print_r($salons); echo "</pre>"; ?>

<section class="content-header">
      <h1>
        Recommended Stores
      </h1>
    </section>
<section class="content">
<div class="row">
	<div class="col-sm-12"> 
		<div class="box">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Store ID</th>
					<th>Store Name</th>
					<th class="actions">Actions</th>
				</tr>
				<?php foreach ($salons as $salon): ?>
				<tr>
					<td><?php echo h($salon['User']['id']); ?></td>
					<td><?php echo h($salon['User']['store_name']); ?></td>
					<td class="actions">
                      		<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-danger fa fa-star', 'title' => 'Recommended')), array('controller' => 'users', 'action' => 'recommended', $salon['User']['id']),array('escape'=>false));  ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
</section>