<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'MY TREATMENT HUB');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title');  ?>
	</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $this->webroot."images/spa/fav16.png";?>" />
	<?php
		//echo $this->Html->meta('icon');
		echo $this->Html->css(array('../dashboard/bootstrap/css/bootstrap.min.css', '../dashboard/dist/css/AdminLTE.min.css', '../dashboard/plugins/iCheck/flat/blue.css', '../dashboard/dist/css/skins/_all-skins.min.css'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Font Awesome -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <?php echo $this->Html->script(array('app.js')); ?>
    <?php echo $this->Html->script(array('bootstrap.min.js', 'forms.less')); ?>
   
    <?php echo $this->Html->script(array('../dashboard/plugins/slimScroll/jquery.slimscroll.min.js')) ?>
    
        
    <style>
	.content-wrapper{min-height: 85vh !important;}
	.icheckbox_minimal{
		position: relative;
		width: 48px;
		right: 0;
		height: 40px;
		z-index: 999999;
	}
	
	#CategoryStatus {
		opacity: 999 !important;
		left: 20px !important;
		top: 0 !important;
		bottom: 0 !important;
		right: 0 !important;
	}
	</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php echo $this->element('Dashboard/header'); ?>
        <?php echo $this->element('Dashboard/sidebar'); ?>
  

        <div class="content-wrapper">
            <?php echo $this->fetch('content'); ?>
        </div>
           <?php echo $this->element('Dashboard/footer'); ?>
           
      <div class="control-sidebar-bg"></div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>