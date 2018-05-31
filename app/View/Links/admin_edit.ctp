<div class="box-header with-border">
              <h3 class="box-title">Edit</h3>
        </div>
<section class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
            <?php
            echo $this->Form->Create('Link', array('action' => 'edit'));
            echo $this->Form->input('id');
            echo $this->Form->input('name', array('class' => 'form-control'));
            echo $this->Form->input('slug', array('type' => 'hidden'));
            echo $this->Form->input('link', array('class' => 'form-control'));
            echo $this->Form->end('Update', array('class' => 'main_btn'));
            ?>

        </div>
    </div>
    </div>
    </div>
</section>   


