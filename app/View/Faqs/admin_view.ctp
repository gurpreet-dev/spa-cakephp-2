<section class="content-header">
      <h1>
      Faq Detail
      </h1>
    </section>

<div class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="form_outer box">
                <table class="table table-bordered table-hover dataTable">
                    <tr>
                        <td>Id</td>
                        <td><?php echo h($faq['Faq']['id']); ?></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><?php echo h($faq['Faq']['title']); ?></td>
                    </tr>
                    <tr>
                        <td>Decsription</td>
                        <td><?php echo h($faq['Faq']['description']); ?></td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td><?php echo h($faq['Faq']['created']); ?></td>
                    </tr>
                    <tr>
                        <td>Modified</td>
                        <td><?php echo h($faq['Faq']['modified']); ?></td>
                    </tr>
                 </table>
            </div>
       	</div>
   	</div>
</div>                    
