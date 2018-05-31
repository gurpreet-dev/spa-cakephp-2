<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
		<?php if(empty($user_data['User']['image'])){?>
		<div class="pull-left image">
                <img src="<?php echo $this->request->webroot ?>files/profile_pic/avatar.png" class="img-circle" alt="User Image">
            </div>
		<?php }else{ ?>
            <div class="pull-left image">
                <img src="<?php echo $this->request->webroot ?>images/spa/users/<?php echo $user_data['User']['image']; ?>" class="img-circle" alt="User Image">
            </div>
			<?php } ?>
            <div class="pull-left info">
                <p><?php echo $user_data['User']['first_name'];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
		<li class="treeview">
			<a href="#">
			<i class="fa fa-users"></i>
			<span>Dashboard</span>
			<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Dashboard', array('controller' => 'dashboards', 'action' => 'dashboard', 'admin' => true), array('escape' => false)); ?></li>

			</ul>
        </li>
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-users"></i>
                    <span>All Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Users', array('controller' => 'users', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                        <?php if($loggedUserRole != 'rest_admin'){?>
                        <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).'Add User', array('controller' => 'users', 'action' => 'add', 'admin' => true), array('escape' => false)); ?></li>
                <!--<li><?php //echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Products CSV Export', array('controller' => 'products', 'action' => 'csv', 'admin' => true), array('escape' => false)); ?></li>-->
                        <?php } ?>
                    </ul>
                </li>
		        <li class="treeview">
                    <a href="#">
                    <i class="fa fa-object-group"></i>
                    <span>Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                       <?php if($loggedUserRole!='rest_admin'){?>
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Categories', array('controller' => 'categories', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Add Category', array('controller' => 'categories', 'action' => 'add', 'admin' => true), array('escape' => false)); ?></li>
						 <?php } ?>
                    </ul>
                </li>
				<li class="treeview">
                    <a href="#">
                    <i class="fa fa-barcode"></i>
                    <span>Services</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Services', array('controller' => 'categories', 'action' => 'services', 'admin' => true), array('escape' => false)); ?></li>
                    </ul>
                </li>
				<li class="treeview">
                    <a href="#">
                    <i class="fa fa-inbox"></i>
                    <span>Bookings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Bookings', array('controller' => 'orders', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						
                    </ul>
                </li>
				
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    <span>Booking Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Booking Report', array('controller' => 'salon', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
                    </ul>
                </li>
				
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                    <span>Stores</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Stores', array('controller' => 'users', 'action' => 'stores', 'admin' => true), array('escape' => false)); ?></li>
                    </ul>
                </li>
                
                
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                    <span>Subscriptions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Subscriptions', array('controller' => 'users', 'action' => 'subscriptions', 'admin' => true), array('escape' => false)); ?></li>
                    </ul>
                </li>
				
				<li class="treeview">
                    <a href="#">
                    <i class="fa fa-file-o"></i>
                    <span>Static Pages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Static Pages', array('controller' => 'staticpages', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')).' Add Page', array('controller' => 'staticpages', 'action' => 'add', 'admin' => true), array('escape' => false)); ?></li>
                        <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-circle-o')). __("Faq's"), array('controller' => 'faqs', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						
                    </ul>
                </li>
				
				
				<li class="treeview">
                    <a href="#">
                    <i class="fa fa-link" aria-hidden="true"></i>

                    <span>Links</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Links', array('controller' => 'links', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						
						
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-phone" aria-hidden="true"></i>

                    <span>Contact Us</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Contact Us', array('controller' => 'contacts', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						
						
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-star-o" aria-hidden="true"></i>

                    <span>Review & Rating</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Ratings', array('controller' => 'reviews', 'action' => 'index', 'admin' => true), array('escape' => false)); ?></li>
						
						
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-hand-lizard-o" aria-hidden="true"></i>

                    <span>Recommended Stores</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                 
						<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-angle-double-right')).' Recommended Stores', array('controller' => 'salon', 'action' => 'recommendations', 'admin' => true), array('escape' => false)); ?></li>
						
						
                    </ul>
                </li> 
		</ul>
    </section>
    <!-- /.sidebar -->
</aside>