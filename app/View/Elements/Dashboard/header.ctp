<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet" />
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo $this->request->webroot ?>admin/dashboards/dashboard" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>Dashboard</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Dashboard</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                       
                      
                      
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if(empty($user_data['User']['image'])){ ?>
                                    <img src="<?php echo $this->request->webroot ?>files/profile_pic/avatar.png" class="user-image" alt="User Image">
                               
                                <?php }else{
                                ?>
                                <img src="<?php echo $this->request->webroot ?>images/spa/users/<?php echo $user_data['User']['image']; ?>" class="user-image" alt="User Image">
                                
                                <?php } ?>
                                <span class="hidden-xs">Hello, <?php echo $user_data['User']['first_name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo $this->request->webroot ?>images/spa/users/<?php echo $user_data['User']['image']; ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $user_data['User']['first_name'];?> - Administrator
                                    </p>
                                </li>
                                <!-- Menu Body -->
<!--                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                     /.row 
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= $this->request->webroot ?>admin/Users/view/<?php echo $user_data['User']['id']; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= $this->request->webroot ?>admin/Users/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>