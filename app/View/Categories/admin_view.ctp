<style>
	table{
		width:100%;
		margin:0px;
	}
</style>
<section class="content-header marginbtm">
      <h1>
       Category
      </h1>
    </section>

    <div class="content">
<div class="row">
	<div class="col-sm-6">
		<div class="form_outer box">
			<table class="table table-bordered table-hover">
				<tr>
					<td>Id</td>
					<td><?php echo h($category['Category']['id']); ?></td>
				</tr>				
				<tr>
					<td>Name</td>
					<td><?php echo h($category['Category']['name']); ?></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><?php echo h($category['Category']['description']); ?></td>
				</tr>
                <tr>
					<td>Image</td>
					<td>
                    <?php if($category['Category']['image'] != ''){ ?>
                    <img src="<?php echo $this->webroot; ?>images/spa/category/<?php echo $category['Category']['image']; ?>" /><br />
                    <?php }else{ ?>
                    <img src="<?php echo $this->webroot; ?>files/noimagefound.jpg" /><br />
                    <?php } ?>
                    </td>
				</tr>
                <tr>
					<td>Status</td>
					<td><?php echo $category['Category']['status'] == 1 ? 'Active' : 'Deactivated'; ?></td>
				</tr>
				<tr>
					<td>Created</td>
					<td><?php echo h($category['Category']['created']); ?></td>
				</tr>
				<tr>
					<td>Modified</td>
					<td><?php echo h($category['Category']['modified']); ?></td>
				</tr>
                
			</table>
		</div>
	</div>
</div>

</div>
