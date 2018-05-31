<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo "<pre>"; print_r($pages); echo "</pre>";

?>

<div class="row">
    <div class="col-sm-12">
        <h1>All pages</h1>
        <div class="form_outer">
            <table class="table-striped table-bordered table-condensed table-hover">
                <tr>
                    <th>Page</th>
                    <th>Action</th>
                </tr> 
                <?php foreach($pages as $page){ ?>
                <tr>
                    <td><?php echo $page['Page']['name']; ?></td>
                    <td><?php echo $this->Html->link('Edit', array('action' => 'edit', $page['Page']['id']), array('class' => 'btn btn-default btn-xs btn-edit')); ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>    