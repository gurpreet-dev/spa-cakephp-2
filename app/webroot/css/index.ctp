<style>
    .restaurants li img{
        width:200px;
    }
</style>
<div class="restaurants index">
    <h2>All stores</h2>
    <?php //echo "<pre>"; print_r($restaurants); echo "</pre>"; ?>
<ul>
	<?php foreach ($restaurants as $restaurant){ ?>
            <li>
                <img src="<?php echo $this->webroot; ?>/files/restaurants/<?php echo $restaurant['Restaurant']['logo']; ?>">
            <?php echo $this->Html->link($restaurant['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $restaurant['Restaurant']['id'])); ?>
            <?php echo h($restaurant['Restaurant']['address']); ?>
            <?php echo h($restaurant['Restaurant']['city']); ?>
            <?php echo h($restaurant['Restaurant']['state']); ?>
            <?php echo h($restaurant['Restaurant']['zip']); ?>
            <?php echo h($restaurant['Restaurant']['country']); ?>
            </li>
        <?php } ?>
	</ul>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>


