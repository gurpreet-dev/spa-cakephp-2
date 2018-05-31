<?php //echo "<pre>"; print_r($service); echo "</pre>"; ?>


<section class="content-header">
    <h1>View</h1>
</section>

<div class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="form_outer box">
                <table class="table table-bordered table-hover dataTable">
                    <tr>
                        <td>Id</td>
                        <td><?php echo h($service['Service']['id']); ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo h($service['Service']['name']); ?></td>
                    </tr>
                    <tr>
                        <td>Category name</td>
                        <td><?php echo h($service['Category']['name']); ?></td>
                    </tr>
                    <tr>
                        <td>Added BY (Store Name)</td>
                        <td><?php echo h(ucwords($service['User']['store_name'])); ?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>&#163;<?php echo h($service['Service']['price']); ?></td>
                    </tr>
                    <tr>
                        <td>Duration (in minutes)</td>
                        <td><?php echo h($service['Service']['duration']); ?></td>
                    </tr>
                    <tr>
                        <td>Created On</td>
                        <td><?php echo h($service['Service']['created']); ?></td>
                    </tr>
                    <tr>
                        <td>Modified On</td>
                        <td><?php echo h($service['Service']['modified']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>                