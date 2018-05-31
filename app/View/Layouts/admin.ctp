<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title_for_layout; ?></title>
    <?php echo $this->Html->css(array('font-awesome.min.css', 'summernote.css', 'ionicons.min.css', 'AdminLTE.css', 'bootstrap.min.css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css')); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <?php echo $this->Html->script(array('app.js', 'summernote.min.js', 'bootstrap.min.js', 'admin.js')); ?>

    <?php echo $this->App->js(); ?>

    <?php echo $this->fetch('css'); ?>
    <?php echo $this->fetch('script'); ?>

</head>
<body class="skin-black pace-done">
    
    
    <header class="header">
            <a href="" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Logo
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>             
            </nav>
        </header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 258px;">
<!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas" style="min-height: 1706px;">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php  if($user_data['User']['image']) { $image = $user_data['User']['image']; } else { $image=$this->webroot."files/profile_pic/image1.JPG"; }  ?>
                	<img src="<?php echo $image; ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Hello, <?php echo $loggedname; ?></p>
                    
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        <!-- search form -->
<!--            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button type="submit" name="seach" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Utilities</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Users', array('controller' => 'users', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                        <?php if($loggedUserRole!='rest_admin'){?>
                        <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).'Add User', array('controller' => 'users', 'action' => 'add', 'admin' => true), array('escape' => false)); ?></li>
<!--                        <li><?php //echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Products CSV Export', array('controller' => 'products', 'action' => 'csv', 'admin' => true), array('escape' => false)); ?></li>-->
                        <?php } ?>
                    </ul>
                </li>
                 <?php if($loggedUserRole!='rest_admin'){?>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Categories', array('controller' => 'categories', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                 <?php } ?>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Products', array('controller' => 'products', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Orders', array('controller' => 'orders', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Stores', array('controller' => 'restaurants', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                <?php if($loggedUserRole!='rest_admin'){?>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Static Pages', array('controller' => 'staticpages', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                <li><?php //echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Pages', array('controller' => 'pages', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Links', array('controller' => 'links', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>				
                <?php } ?>
                <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Log Out', array('controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?></li>
            </ul>
        </section>
    <!-- /.sidebar -->
    </aside>
    <aside class="right-side col-md-10">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </aside>

<!-- Right side column. Contains the navbar and content of the page -->
<!-- /.right-side -->
</div>
    

    <?php /* ?><div class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SHOP ADMIN</a>  
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilities<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?></li>
                        <li><?php echo $this->Html->link('User Add', array('controller' => 'users', 'action' => 'add', 'admin' => true)); ?></li>
                        <li><?php echo $this->Html->link('Products CSV Export', array('controller' => 'products', 'action' => 'csv', 'admin' => true)); ?></li>
                    </ul>
                </li>
				<li><?php echo $this->Html->link('Categories', array('controller' => 'categories', 'action' => 'index', 'admin' => true)); ?></li>
				<li><?php echo $this->Html->link('Products', array('controller' => 'products', 'action' => 'index', 'admin' => true)); ?></li>
				<li><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'action' => 'index', 'admin' => true)); ?></li>
				<li><?php echo $this->Html->link('Static Pages', array('controller' => 'staticpages', 'action' => 'index', 'admin' => true)); ?></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Wooden Watches<b class="caret"></b></a>
                    <ul class="dropdown-menu">
						<li><?php echo $this->Html->link('Wood Type', array('controller' => 'woodtypes', 'action' => 'index', 'admin' => true)); ?></li>
						<li><?php echo $this->Html->link('Mechanism', array('controller' => 'mechanisms', 'action' => 'index', 'admin' => true)); ?></li>
						<li><?php echo $this->Html->link('Series', array('controller' => 'series', 'action' => 'index', 'admin' => true)); ?></li>
						<li><?php echo $this->Html->link('Band', array('controller' => 'brands', 'action' => 'index', 'admin' => true)); ?></li>          
             
                    </ul>           
				</li>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Wooden Bracelets <b class="caret"></b></a>
                    <ul class="dropdown-menu">
						<li><?php echo $this->Html->link('Style', array('controller' => 'styles', 'action' => 'index', 'admin' => true)); ?></li>
						<li><?php echo $this->Html->link('Theme', array('controller' => 'themes', 'action' => 'index', 'admin' => true)); ?></li>      
						<li><?php echo $this->Html->link('Material', array('controller' => 'materials', 'action' => 'index', 'admin' => true)); ?></li> 
						<li><?php echo $this->Html->link('Gemstone', array('controller' => 'gemstones', 'action' => 'index', 'admin' => true)); ?></li>
						<li><?php echo $this->Html->link('Color', array('controller' => 'colours', 'action' => 'index', 'admin' => true)); ?></li>
					</ul>
				</li>
				<li><?php echo $this->Html->link('Review', array('controller' => 'reviews', 'action' => 'index', 'admin' => true)); ?></li>
                <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout', 'admin' => false)); ?></li>
				<!-- <li><?php //echo $this->Html->link('Orders Items', array('controller' => 'order_items', 'action' => 'index', 'admin' => true)); ?></li>-->
				<!--<li><?php //echo $this->Html->link('Profile Settings', array('controller' => 'users', 'action' => 'admin_profile', 'admin' => true)); ?></li>-->
            </ul>
        </div>
    </div><?php */ ?>

    <?php /* ?><div class="content">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div><?php */ ?>

    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?></p>
    </div>

    <div class="sqldump">
        <?php //echo $this->element('sql_dump'); ?>
    </div>

</body>
</html>

