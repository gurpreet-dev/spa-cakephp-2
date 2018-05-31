<style>
	.form_outer{
		margin-bottom:20px;
	}
	.form_outer.no-margin{
		margin:0px;
	}
	table{
		width:100%;
		margin:0px;
	}
</style>
<section class="content-header marginbtm">
      <h1>
       Like Details
      </h1>
    </section>
<section class="content">
<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<table class="table table-bordered table-hover">
				<tr>
					<td>Id</td>
					<td><?php echo h($likeuser['Restaurantlike']['id']); ?></td>
				</tr>
                                <tr>
					<td>User Id</td>
					<td><?php echo h($likeuser['User']['id']); ?></td>
				</tr>
				<tr>
					<td>First Name</td>
					<td><?php echo h($likeuser['User']['first_name']); ?></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><?php echo h($likeuser['User']['last_name']); ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo h($likeuser['User']['email']); ?></td>
				</tr>
				
			 
				
			</table>
		</div>
	</div>
</div>
    <div class="content">
<div class="row">
  <div class="col-md-6">
          <!-- quick email widget -->
		      
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="<?php echo $this->webroot?>admin/dashboards/emailSend" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="emailto" placeholder="Email to:" value="<?php echo $likeuser['User']['email'];?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" name="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                 <div class="box-footer clearfix">
                <button type="submit" class="pull-right btn btn-default main_btn" id="sendEmail">Send
                        <i class="fa fa-arrow-circle-right"></i></button>
            </div>
              </form>
            </div>
            
          </div>

          </div>
          </div>
          </div>
</section>
