<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1> Dashboard <small>Control panel</small> </h1>
  <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Bookings</span> <span class="info-box-number"><?php echo $apporders; ?><small></small></span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-red"><i class="ion ion-person"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Freelancers</span> <span class="info-box-number"><?php echo $freelancers_count; ?></span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-green"><i class="ion ion-ribbon-b"></i></span>
        <div class="info-box-content"> <span class="info-box-text">Services</span> <span class="info-box-number"><?php echo $services_count; ?></span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
        <div class="info-box-content"> <span class="info-box-text">New Members</span> <span class="info-box-number"><?php echo $customers_count; ?></span> </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.content -->
  <div class="row">
    <!-- /.col -->
    
    <!-- /.col -->
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Stores</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
          <?php foreach($freelancers as $free){ ?>
          <?php if($free['User']['store_name'] != ''){ ?>
            <li class="item">
              <div class="product-img">
              <?php if($free['User']['icon_img'] != ''){ ?>
              <img src="<?php echo $this->webroot; ?>images/spa/icon/<?php echo $free['User']['icon_img']; ?>" alt="User Image">
              <?php }else{ ?>
              <img src="<?php echo $this->webroot; ?>files/noimagefound.jpg" alt="User Image">
              <?php } ?>
              </div>
              <div class="product-info"> <a href="javascript:void(0)" class="product-title"><?php echo ucwords($free['User']['store_name']); ?> <!--<span class="label label-warning pull-right">$1800</span>--></a> <span class="product-description"><?php echo substr($free['User']['about'],0,150); ?> </span> </div>
            </li>
            <?php } ?>
            <?php } ?>
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center"> <a href="javascript:void(0)" class="uppercase"></a> </div>
        <!-- /.box-footer -->
      </div>
    </div>
    <div class="col-md-6">
      <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Members</h3>
          <div class="box-tools pull-right"> <!--<span class="label label-danger">8 New Members</span>-->
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
        <?php if(!empty($customers)){ ?>
          <ul class="users-list clearfix">
            <?php foreach($customers as $user){ ?>
            <li>
              <?php if($user['User']['image'] != ''){ ?>
              <img src="<?php echo $this->webroot; ?>images/spa/users/<?php echo $user['User']['image']; ?>" alt="User Image">
              <?php }else{ ?>
              <img src="<?php echo $this->webroot; ?>files/noimagefound.jpg" alt="User Image">
              <?php } ?>
              <a class="users-list-name" href="<?php echo $this->webroot; ?>admin/users/view/<?php echo $user['User']['id']; ?>"><?php echo $user['User']['first_name'] .' '. $user['User']['last_name']; ?></a> <span class="users-list-date"></span> </li>
            <?php } ?>
          </ul>
          <?php } ?>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center"> <a href="<?php echo $this->webroot ?>admin/users" class="uppercase">View All Users</a> </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->
    </div>
  </div>
</section>
