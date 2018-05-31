<div class="container">
    <div class="page_heading">
    <h2>Edit Page</h2>
    </div>   
    <div class="row">
        <div class="col-sm-12">
            <div class="form_outer">
                <?php
                //echo "<pre>"; print_r(); echo "</pre>";
                echo $this->Form->Create('Page', array('action' => 'edit'));
                echo $this->Form->input('id');
                echo $this->Form->input('name');
                echo $this->Form->input('content', array('type' => 'textarea', 'label' => 'Page content'));
                echo $this->Form->end('Update');
                ?>
            </div>
        </div>
    </div>  
</div>    
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea',
  plugins: "code",
  toolbar: "code",
  menubar: "tools"
 });
</script>