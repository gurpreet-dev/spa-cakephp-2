<link rel="stylesheet" href="<?php echo $this->webroot . 'full_demo/reset.css'?>">
 <link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/libs/css/smoothness/jquery-ui-1.8.11.custom.css'?>" />

	<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/jquery.weekcalendar.css'?>" />
	<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/demo.css'?>" />
									
	<link rel='stylesheet' type='text/css' href="<?php echo $this->webroot . 'full_demo/skins/default.css'?>" />
	
    
    
    
    <script type='text/javascript' src="<?php echo $this->webroot . 'full_demo/libs/jquery-1.4.4.min.js'?>"></script>
    <script type='text/javascript' src="<?php echo $this->webroot . 'full_demo/libs/jquery-ui-1.8.11.custom.min.js'?>"></script>
	<script type="text/javascript" src="<?php echo $this->webroot . 'full_demo/themeswitchertool.js'?>"></script>
    
  <script>
	  $(document).ready(function(){
	    $('#switcher').themeswitcher();
	  });
  </script>
  	<script type="text/javascript" src="<?php echo $this->webroot . 'full_demo/libs/date.js'?>"></script>
	<script type='text/javascript' src="<?php echo $this->webroot . 'full_demo/jquery.weekcalendar.js'?>"></script>
	<script type='text/javascript' src="<?php echo $this->webroot . 'full_demo/demo.js'?>"></script>
<section class="content-header">
      <h1>
       Weeekly Datetime
      </h1>
    </section>
    
    
    <style>
	.wc-grid-timeslot-header{vertical-align:top;}
	</style>
    
<div class="container">
  <h2>Table</h2>
	<h1>jQuery Week Calendar (full demo)</h1>
<!--	<div id="about_button_container">
		<button type="button" id="about_button">About this demo</button>
	</div>
-->	<div id='calendar'></div>
	<div id="event_edit_container">
		<form>
			<input type="hidden" />
			<ul>
				<li>
					<span>Date: </span><span class="date_holder"></span> 
				</li>
				<li>
					<label for="start">Start Time: </label><select name="start"><option value="">Select Start Time</option></select>
				</li>
				<li>
					<label for="end">End Time: </label><select name="end"><option value="">Select End Time</option></select>
				</li>
				<li>
					<label for="title">Title: </label><input type="text" name="title" />
				</li>
				<li>
					<label for="body">Body: </label><textarea name="body"></textarea>
				</li>
			</ul>
		</form>
	</div>
	
	
</div>
