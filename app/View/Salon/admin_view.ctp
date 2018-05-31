<?php //echo "<pre>"; print_r($user); echo "</pre>"; ?>

<section class="content-header">
      <h1>
        Bookings
      </h1>
    </section>
    

<div class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="form_outer box">
			<table class="table table-bordered table-hover dataTable">
				<tr>
					<td>Id</td>
					<td><?php echo h($user['User']['id']); ?></td>
				</tr>
				<tr>
					<td>Role</td>
					<td><?php echo h($user['User']['role']); ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?php echo h($user['User']['first_name']); ?></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td><?php echo h($user['User']['gender']); ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo h($user['User']['username']); ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo h($user['User']['address']); ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><?php echo h($user['User']['phone']); ?></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td><?php echo h($user['User']['zip']); ?></td>
				</tr>
				<?php  if($user['User']['role']=='freelancer') { ?>
				<tr>
					<td>Store Name</td>
					<td><?php echo h($user['User']['store_name']); ?></td>
				</tr>
                <?php } ?>
				
				
				
                                <tr>
					<td>Profile pic</td>
					<td>
                                            <?php if($user['User']['image']){ echo $this->Html->Image('/images/spa/users/' . h($user['User']['image']), array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            
                                            }else{
                                                echo $this->Html->Image('/files/noimagefound.jpg' , array('width' => 100, 'height' => 100, 'alt' => 'image not found', 'class' => 'image'));
                                            } ?>
                                            
                                            </td>
				</tr>
				<tr>
					<td>Bookings Complete</td>
					<td><?php echo count($user['Bookings']); ?></td>
				</tr>
				<tr>
					<td>Created</td>
					<td><?php echo h($user['User']['created']); ?></td>
				</tr>
				<tr>
					<td>Modified</td>
					<td><?php echo h($user['User']['modified']); ?></td>
				</tr>
			</table>
			<?php //echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-success')); ?>
            <?php //echo $this->Html->link('Change Password', array('action' => 'password', $user['User']['id']), array('class' => 'btn btn-success')); ?>
		</div>
	</div>
</div>
</div>    