<style>
	table{
		width:100%;
		margin:0px;
	}
</style>

<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Parent Category</h3>
                    </div>
			<table class="table table-bordered table-hover dataTable">
				<tr>
					<td>Id</td>
					<td><?php echo h($category['ParentCategory']['id']); ?></td>
				</tr>
				
				<tr>
					<td>Name</td>
					<td><?php echo h($category['ParentCategory']['name']); ?></td>
				</tr>
				
				
				<tr>
					<td>Created</td>
					<td><?php echo h($category['ParentCategory']['created']); ?></td>
				</tr>
				<tr>
					<td>Modified</td>
					<td><?php echo h($category['ParentCategory']['modified']); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</section>
