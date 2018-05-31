
<section class="content-header marginbtm">
      <h1>
       All Link
      </h1>
    </section>


<section class="content">
<div class="row">
    <div class="col-sm-12">

        <div class="box">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr> 
                <?php foreach($links as $link){ ?>
                <tr>
                    <td><?php echo $link['Link']['name']; ?></td>
                    <td><?php echo $link['Link']['link']; ?></td>
                    <td><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-warning fa fa-pencil', 'title' => 'Edit')), array('action' => 'edit', $link['Link']['id']),array('escape'=>false));  ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</section>    