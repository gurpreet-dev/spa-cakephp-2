
 <div class="available_table margin_lity">
 	<div class="container">
 <div class="col-sm-12">
 	<div class="table_heading">
    	<h2>Availability/Unavailability</h2>
    	</div>
        <button type="button" class="btn btn-success btn_avail"  data-toggle="modal" data-target="#unavModal"s>ADD UNAVAILABILITY</button>
  <table class="table border_light">
 
  <thead class="thead-inverse pink_heading">
    <tr>
      <th></th>
      <th>Monday</th>
      <th>Tuesday</th>
      <th>Wednesday</th>
      <th>Thursday</th>
      <th>Friday</th>
      <th>Saturday</th>
      <th>Sunday</th>
    </tr>
  </thead>
  <tbody>
  <?php $i = 1; ?>
  <?php foreach($unavilabilities as $unavilability){ ?>
      <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $unavilability['Unavailability']['date']; ?></td>
      <td><?php echo $unavilability['Unavailability']['hourfrom'] . ' - ' . $unavilability['Unavailability']['hourto'];?></td>
      <td><?php  echo $this->Form->postLink(__('Delete'), array('action' => 'deleteunavilability', $unavilability['Unavailability']['id']), array('class' => 'delete1 btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $unavilability['Unavailability']['id'])); ?></td>
      <td><?php  echo $this->Form->postLink(__('Delete'), array('action' => 'deleteunavilability', $unavilability['Unavailability']['id']), array('class' => 'delete1 btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $unavilability['Unavailability']['id'])); ?></td>
      <td><?php  echo $this->Form->postLink(__('Delete'), array('action' => 'deleteunavilability', $unavilability['Unavailability']['id']), array('class' => 'delete1 btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $unavilability['Unavailability']['id'])); ?></td><td><?php  echo $this->Form->postLink(__('Delete'), array('action' => 'deleteunavilability', $unavilability['Unavailability']['id']), array('class' => 'delete1 btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $unavilability['Unavailability']['id'])); ?></td>
      <td><?php  echo $this->Form->postLink(__('Delete'), array('action' => 'deleteunavilability', $unavilability['Unavailability']['id']), array('class' => 'delete1 btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $unavilability['Unavailability']['id'])); ?></td>
      
    </tr>
<?php $i++; ?>
  <?php } ?>
  </tbody>
</table>
 	</div>	
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="unavModal">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo $this->webroot; ?>users/addunavailability" name="addunavailability" method="post"> 
    <div class="modal-content" style="background-image:url(<?php echo $this->webroot?>images/avail.jpg);background-size: cover;width: 100%;float: left;height: 26%;">
    
    	<div class="modal-body avail_modals">
    		<h2>Please Select Unavailability Date/Time</h2>
    
    		<div class="col-sm-4">
    			<div class="date_mnth">
    				<input type="text" name="data[Unavailability][date]"  placeholder = "Choose Date" class="form-control radius_none"  id="datepicker" required="required">
    			</div>
    		</div>
    	<div class="col-sm-4" style="padding-right:0px;">
           <div class="demo">
    		<select name="data[Unavailability][hourfrom]" required="required">
    			<optgroup label="Hours">
    			<?php for($i=0;$i<12;$i++){ ?>
    			<option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
    			<?php } ?>
    			</optgroup>
    		</select> 
            <select name="data[Unavailability][minutefrom]" required="required">
                <optgroup label="Minutes">
                <?php for($i=0;$i<60;$i++){ ?>
                <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo sprintf('%02d', $i); ?></option>
                <?php } ?> 
                </optgroup>
            </select> 
            <select name="data[Unavailability][ampmfrom]" required="required">
                <option value="am">AM</option>
                <option value="pm">PM</option>
            </select> 
             </div>
   	 	</div>
        <div class="col-sm-4" style="padding-right:0px;">
        		<div class="demo">
            <select name="data[Unavailability][hourto]" required="required">
                <optgroup label="Hours">
                <?php for($i=0;$i<12;$i++){ ?>
                <option value="<?php echo sprintf('%02d', $i+1); ?>"><?php echo sprintf('%02d', $i+1); ?></option>
                <?php } ?>
                </optgroup>
            </select> 
            <select name="data[Unavailability][minuteto]" required="required">
                <optgroup label="Minutes">
                <?php for($i=0;$i<60;$i++){ ?>
                <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo sprintf('%02d', $i); ?></option>
                <?php } ?> 
                </optgroup>
            </select> 
            <select name="data[Unavailability][ampmto]" required="required">
                <option value="am">AM</option>
                <option value="pm">PM</option>
            </select>   
            </div>
        </div>
    
    </div>
    
    <div class="modal-footer center_btn">
    <input type="submit" name="submit" class="btn btn-success defult_btn" value="Save" id="submit">
    <button type="button" class="btn btn-default grey_fault" data-dismiss="modal">Cancel</button>
    </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script type="text/javascript">
            $(function () {
                $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
            });
        </script>
<style>
/*------------------------------AVAILABILITY-PAGE----------------------------------------*/

.available_table {
    width: 100%;
    float: left;
    margin: 5% 0;
}
.table_heading{
	width:100%;
	float:left;
	margin-bottom:30px;
}
.table_heading h2 {
   width: auto;
  display: table;
  padding: 0;
  border-bottom: 3px solid #006500;
  font-size: 36px;
  font-weight: 500;
  color:#000;
  float:none;
  margin:0 auto;
  
}
.pink_heading {
    width: 100%;
    background: #ef3b85;
    color: #fff;
	font-size:17px;
}
.table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    border-left: 2px solid #ddd !important;
	border-top:0px !important;
}
.table.border_light {
    border: 2px solid #dddd;
}
.table > thead > tr > th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
    border-left: 2px solid #fff;
}
.btn.btn-success.btn_avail {
    width: auto;
    float: right;
    margin-bottom: 20px;
	background-color:#006500;
}

.modal-body.avail_modals {
  width: 100%;
  float: left;
  margin-bottom:20px;
}
.modal-body.avail_modals h2 {
  width: 100%;
  float: left;
  color: #ef3b85;
  font-size: 34px;
  text-align: center;
  line-height: 44px;
  font-weight: 400;
  padding-bottom:10px;
}
.center_btn {
    width: 100%;
    text-align: center;
    padding: 23px 0;
}
.save_gren {
    width: auto;
    background-color: #006500;
    padding: 6px 16px;
}
.grey_fault {
    width: auto;
    background-color: #999999;
    padding: 6px 16px;
	color:#fff;
}
/*-------------date-picker--------------------*/

.ui-helper-hidden {
    display: none;
}
.ui-helper-hidden-accessible {
    border: 0 none;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}
.ui-helper-reset {
    border: 0 none;
    font-size: 100%;
    line-height: 1.3;
    list-style: outside none none;
    margin: 0;
    outline: 0 none;
    padding: 0;
    text-decoration: none;
}
.ui-helper-clearfix::before, .ui-helper-clearfix::after {
    border-collapse: collapse;
    content: "";
    display: table;
}
.ui-helper-clearfix::after {
    clear: both;
}
.ui-helper-zfix {
    height: 100%;
    left: 0;
    opacity: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
.ui-front {
    z-index: 100;
}
.ui-state-disabled {
    cursor: default;
    pointer-events: none;
}
.ui-icon {
    background-repeat: no-repeat;
    display: inline-block;
    margin-top: -0.25em;
    overflow: hidden;
    position: relative;
    text-indent: -99999px;
    vertical-align: middle;
}
.ui-widget-icon-block {
    display: block;
    left: 50%;
    margin-left: -8px;
}
.ui-widget-overlay {
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
}
.ui-accordion .ui-accordion-header {
    cursor: pointer;
    display: block;
    font-size: 100%;
    margin: 2px 0 0;
    padding: 0.5em 0.5em 0.5em 0.7em;
    position: relative;
}
.ui-accordion .ui-accordion-content {
    border-top: 0 none;
    overflow: auto;
    padding: 1em 2.2em;
}
.ui-autocomplete {
    cursor: default;
    left: 0;
    position: absolute;
    top: 0;
}
.ui-menu {
    display: block;
    list-style: outside none none;
    margin: 0;
    outline: 0 none;
    padding: 0;
}
.ui-menu .ui-menu {
    position: absolute;
}
.ui-menu .ui-menu-item {
    cursor: pointer;
    list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7");
    margin: 0;
}
.ui-menu .ui-menu-item-wrapper {
    padding: 3px 1em 3px 0.4em;
    position: relative;
}
.ui-menu .ui-menu-divider {
    border-width: 1px 0 0;
    font-size: 0;
    height: 0;
    line-height: 0;
    margin: 5px 0;
}
.ui-menu .ui-state-focus, .ui-menu .ui-state-active {
    margin: -1px;
}
.ui-menu-icons {
    position: relative;
}
.ui-menu-icons .ui-menu-item-wrapper {
    padding-left: 2em;
}
.ui-menu .ui-icon {
    bottom: 0;
    left: 0.2em;
    margin: auto 0;
    position: absolute;
    top: 0;
}
.ui-menu .ui-menu-icon {
    left: auto;
    right: 0;
}
.ui-button {
    -moz-user-select: none;
    cursor: pointer;
    display: inline-block;
    line-height: normal;
    margin-right: 0.1em;
    overflow: visible;
    padding: 0.4em 1em;
    position: relative;
    text-align: center;
    vertical-align: middle;
}
.ui-button, .ui-button:link, .ui-button:visited, .ui-button:hover, .ui-button:active {
    text-decoration: none;
}
.ui-button-icon-only {
    box-sizing: border-box;
    text-indent: -9999px;
    white-space: nowrap;
    width: 2em;
}
input.ui-button.ui-button-icon-only {
    text-indent: 0;
}
.ui-button-icon-only .ui-icon {
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    position: absolute;
    top: 50%;
}
.ui-button.ui-icon-notext .ui-icon {
    height: 2.1em;
    padding: 0;
    text-indent: -9999px;
    white-space: nowrap;
    width: 2.1em;
}
input.ui-button.ui-icon-notext .ui-icon {
    height: auto;
    padding: 0.4em 1em;
    text-indent: 0;
    white-space: normal;
    width: auto;
}
input.ui-button::-moz-focus-inner, button.ui-button::-moz-focus-inner {
    border: 0 none;
    padding: 0;
}
.ui-controlgroup {
    display: inline-block;
    vertical-align: middle;
}
.ui-controlgroup > .ui-controlgroup-item {
    float: left;
    margin-left: 0;
    margin-right: 0;
}
.ui-controlgroup > .ui-controlgroup-item:focus, .ui-controlgroup > .ui-controlgroup-item.ui-visual-focus {
    z-index: 9999;
}
.ui-controlgroup-vertical > .ui-controlgroup-item {
    display: block;
    float: none;
    margin-bottom: 0;
    margin-top: 0;
    text-align: left;
    width: 100%;
}
.ui-controlgroup-vertical .ui-controlgroup-item {
    box-sizing: border-box;
}
.ui-controlgroup .ui-controlgroup-label {
    padding: 0.4em 1em;
}
.ui-controlgroup .ui-controlgroup-label span {
    font-size: 80%;
}
.ui-controlgroup-horizontal .ui-controlgroup-label + .ui-controlgroup-item {
    border-left: medium none;
}
.ui-controlgroup-vertical .ui-controlgroup-label + .ui-controlgroup-item {
    border-top: medium none;
}
.ui-controlgroup-horizontal .ui-controlgroup-label.ui-widget-content {
    border-right: medium none;
}
.ui-controlgroup-vertical .ui-controlgroup-label.ui-widget-content {
    border-bottom: medium none;
}
.ui-controlgroup-vertical .ui-spinner-input {
    width: calc(100% - 2.4em);
}
.ui-controlgroup-vertical .ui-spinner .ui-spinner-up {
    border-top-style: solid;
}
.ui-checkboxradio-label .ui-icon-background {
    border: medium none;
    border-radius: 0.12em;
    box-shadow: 1px 1px 1px #ccc inset;
}
.ui-checkboxradio-radio-label .ui-icon-background {
    border: medium none;
    border-radius: 1em;
    height: 16px;
    overflow: visible;
    width: 16px;
}
.ui-checkboxradio-radio-label.ui-checkboxradio-checked .ui-icon, .ui-checkboxradio-radio-label.ui-checkboxradio-checked:hover .ui-icon {
    background-image: none;
    border-style: solid;
    border-width: 4px;
    height: 8px;
    width: 8px;
}
.ui-checkboxradio-disabled {
    pointer-events: none;
}
.ui-datepicker {
    display: none;
    padding: 0.2em 0.2em 0;
    width: 17em;
}
.ui-datepicker .ui-datepicker-header {
    padding: 0.2em 0;
    position: relative;
}
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
    height: 1.8em;
    position: absolute;
    top: 2px;
    width: 1.8em;
}
.ui-datepicker .ui-datepicker-prev-hover, .ui-datepicker .ui-datepicker-next-hover {
    top: 1px;
}
.ui-datepicker .ui-datepicker-prev {
    left: 2px;
}
.ui-datepicker .ui-datepicker-next {
    right: 2px;
}
.ui-datepicker .ui-datepicker-prev-hover {
    left: 1px;
}
.ui-datepicker .ui-datepicker-next-hover {
    right: 1px;
}
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {
    display: block;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    position: absolute;
    top: 50%;
}
.ui-datepicker .ui-datepicker-title {
    line-height: 1.8em;
    margin: 0 2.3em;
    text-align: center;
}
.ui-datepicker .ui-datepicker-title select {
    font-size: 1em;
    margin: 1px 0;
}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
    width: 45%;
}
.ui-datepicker table {
    border-collapse: collapse;
    font-size: 0.9em;
    margin: 0 0 0.4em;
    width: 100%;
}
.ui-datepicker th {
    border: 0 none;
    font-weight: bold;
    padding: 0.7em 0.3em;
    text-align: center;
}
.ui-datepicker td {
    border: 0 none;
    padding: 1px;
}
.ui-datepicker td span, .ui-datepicker td a {
    display: block;
    padding: 0.2em;
    text-align: right;
    text-decoration: none;
}
.ui-datepicker .ui-datepicker-buttonpane {
    background-image: none;
    border-bottom: 0 none;
    border-left: 0 none;
    border-right: 0 none;
    margin: 0.7em 0 0;
    padding: 0 0.2em;
}
.ui-datepicker .ui-datepicker-buttonpane button {
    cursor: pointer;
    float: right;
    margin: 0.5em 0.2em 0.4em;
    overflow: visible;
    padding: 0.2em 0.6em 0.3em;
    width: auto;
}
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
    float: left;
}
.ui-datepicker.ui-datepicker-multi {
    width: auto;
}
.ui-datepicker-multi .ui-datepicker-group {
    float: left;
}
.ui-datepicker-multi .ui-datepicker-group table {
    margin: 0 auto 0.4em;
    width: 95%;
}
.ui-datepicker-multi-2 .ui-datepicker-group {
    width: 50%;
}
.ui-datepicker-multi-3 .ui-datepicker-group {
    width: 33.3%;
}
.ui-datepicker-multi-4 .ui-datepicker-group {
    width: 25%;
}
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header, .ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header {
    border-left-width: 0;
}
.ui-datepicker-multi .ui-datepicker-buttonpane {
    clear: left;
}
.ui-datepicker-row-break {
    clear: both;
    font-size: 0;
    width: 100%;
}
.ui-datepicker-rtl {
    direction: rtl;
}
.ui-datepicker-rtl .ui-datepicker-prev {
    left: auto;
    right: 2px;
}
.ui-datepicker-rtl .ui-datepicker-next {
    left: 2px;
    right: auto;
}
.ui-datepicker-rtl .ui-datepicker-prev:hover {
    left: auto;
    right: 1px;
}
.ui-datepicker-rtl .ui-datepicker-next:hover {
    left: 1px;
    right: auto;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane {
    clear: right;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button {
    float: left;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current, .ui-datepicker-rtl .ui-datepicker-group {
    float: right;
}
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header, .ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header {
    border-left-width: 1px;
    border-right-width: 0;
}
.ui-datepicker .ui-icon {
    background-repeat: no-repeat;
    display: block;
    left: 0.5em;
    overflow: hidden;
    text-indent: -99999px;
    top: 0.3em;
}
.ui-dialog {
    left: 0;
    outline: 0 none;
    padding: 0.2em;
    position: absolute;
    top: 0;
}
.ui-dialog .ui-dialog-titlebar {
    padding: 0.4em 1em;
    position: relative;
}
.ui-dialog .ui-dialog-title {
    float: left;
    margin: 0.1em 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 90%;
}
.ui-dialog .ui-dialog-titlebar-close {
    height: 20px;
    margin: -10px 0 0;
    padding: 1px;
    position: absolute;
    right: 0.3em;
    top: 50%;
    width: 20px;
}
.ui-dialog .ui-dialog-content {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 0 none;
    overflow: auto;
    padding: 0.5em 1em;
    position: relative;
}
.ui-dialog .ui-dialog-buttonpane {
    background-image: none;
    border-width: 1px 0 0;
    margin-top: 0.5em;
    padding: 0.3em 1em 0.5em 0.4em;
    text-align: left;

}
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset {
    float: right;
}
.ui-dialog .ui-dialog-buttonpane button {
    cursor: pointer;
    margin: 0.5em 0.4em 0.5em 0;
}
.ui-dialog .ui-resizable-n {
    height: 2px;
    top: 0;
}
.ui-dialog .ui-resizable-e {
    right: 0;
    width: 2px;
}
.ui-dialog .ui-resizable-s {
    bottom: 0;
    height: 2px;
}
.ui-dialog .ui-resizable-w {
    left: 0;
    width: 2px;
}
.ui-dialog .ui-resizable-se, .ui-dialog .ui-resizable-sw, .ui-dialog .ui-resizable-ne, .ui-dialog .ui-resizable-nw {
    height: 7px;
    width: 7px;
}
.ui-dialog .ui-resizable-se {
    bottom: 0;
    right: 0;
}
.ui-dialog .ui-resizable-sw {
    bottom: 0;
    left: 0;
}
.ui-dialog .ui-resizable-ne {
    right: 0;
    top: 0;
}
.ui-dialog .ui-resizable-nw {
    left: 0;
    top: 0;
}
.ui-draggable .ui-dialog-titlebar {
    cursor: move;
}
.ui-draggable-handle {
    touch-action: none;
}
.ui-resizable {
    position: relative;
}
.ui-resizable-handle {
    display: block;
    font-size: 0.1px;
    position: absolute;
    touch-action: none;
}
.ui-resizable-disabled .ui-resizable-handle, .ui-resizable-autohide .ui-resizable-handle {
    display: none;
}
.ui-resizable-n {
    cursor: n-resize;
    height: 7px;
    left: 0;
    top: -5px;
    width: 100%;
}
.ui-resizable-s {
    bottom: -5px;
    cursor: s-resize;
    height: 7px;
    left: 0;
    width: 100%;
}
.ui-resizable-e {
    cursor: e-resize;
    height: 100%;
    right: -5px;
    top: 0;
    width: 7px;
}
.ui-resizable-w {
    cursor: w-resize;
    height: 100%;
    left: -5px;
    top: 0;
    width: 7px;
}
.ui-resizable-se {
    bottom: 1px;
    cursor: se-resize;
    height: 12px;
    right: 1px;
    width: 12px;
}
.ui-resizable-sw {
    bottom: -5px;
    cursor: sw-resize;
    height: 9px;
    left: -5px;
    width: 9px;
}
.ui-resizable-nw {
    cursor: nw-resize;
    height: 9px;
    left: -5px;
    top: -5px;
    width: 9px;
}
.ui-resizable-ne {
    cursor: ne-resize;
    height: 9px;
    right: -5px;
    top: -5px;
    width: 9px;
}
.ui-progressbar {
    height: 2em;
    overflow: hidden;
    text-align: left;
}
.ui-progressbar .ui-progressbar-value {
    height: 100%;
    margin: -1px;
}
.ui-progressbar .ui-progressbar-overlay {
    background: rgba(0, 0, 0, 0) url("data:image/gif;base64,R0lGODlhKAAoAIABAAAAAP///yH/C05FVFNDQVBFMi4wAwEAAAAh+QQJAQABACwAAAAAKAAoAAACkYwNqXrdC52DS06a7MFZI+4FHBCKoDeWKXqymPqGqxvJrXZbMx7Ttc+w9XgU2FB3lOyQRWET2IFGiU9m1frDVpxZZc6bfHwv4c1YXP6k1Vdy292Fb6UkuvFtXpvWSzA+HycXJHUXiGYIiMg2R6W459gnWGfHNdjIqDWVqemH2ekpObkpOlppWUqZiqr6edqqWQAAIfkECQEAAQAsAAAAACgAKAAAApSMgZnGfaqcg1E2uuzDmmHUBR8Qil95hiPKqWn3aqtLsS18y7G1SzNeowWBENtQd+T1JktP05nzPTdJZlR6vUxNWWjV+vUWhWNkWFwxl9VpZRedYcflIOLafaa28XdsH/ynlcc1uPVDZxQIR0K25+cICCmoqCe5mGhZOfeYSUh5yJcJyrkZWWpaR8doJ2o4NYq62lAAACH5BAkBAAEALAAAAAAoACgAAAKVDI4Yy22ZnINRNqosw0Bv7i1gyHUkFj7oSaWlu3ovC8GxNso5fluz3qLVhBVeT/Lz7ZTHyxL5dDalQWPVOsQWtRnuwXaFTj9jVVh8pma9JjZ4zYSj5ZOyma7uuolffh+IR5aW97cHuBUXKGKXlKjn+DiHWMcYJah4N0lYCMlJOXipGRr5qdgoSTrqWSq6WFl2ypoaUAAAIfkECQEAAQAsAAAAACgAKAAAApaEb6HLgd/iO7FNWtcFWe+ufODGjRfoiJ2akShbueb0wtI50zm02pbvwfWEMWBQ1zKGlLIhskiEPm9R6vRXxV4ZzWT2yHOGpWMyorblKlNp8HmHEb/lCXjcW7bmtXP8Xt229OVWR1fod2eWqNfHuMjXCPkIGNileOiImVmCOEmoSfn3yXlJWmoHGhqp6ilYuWYpmTqKUgAAIfkECQEAAQAsAAAAACgAKAAAApiEH6kb58biQ3FNWtMFWW3eNVcojuFGfqnZqSebuS06w5V80/X02pKe8zFwP6EFWOT1lDFk8rGERh1TTNOocQ61Hm4Xm2VexUHpzjymViHrFbiELsefVrn6XKfnt2Q9G/+Xdie499XHd2g4h7ioOGhXGJboGAnXSBnoBwKYyfioubZJ2Hn0RuRZaflZOil56Zp6iioKSXpUAAAh+QQJAQABACwAAAAAKAAoAAACkoQRqRvnxuI7kU1a1UU5bd5tnSeOZXhmn5lWK3qNTWvRdQxP8qvaC+/yaYQzXO7BMvaUEmJRd3TsiMAgswmNYrSgZdYrTX6tSHGZO73ezuAw2uxuQ+BbeZfMxsexY35+/Qe4J1inV0g4x3WHuMhIl2jXOKT2Q+VU5fgoSUI52VfZyfkJGkha6jmY+aaYdirq+lQAACH5BAkBAAEALAAAAAAoACgAAAKWBIKpYe0L3YNKToqswUlvznigd4wiR4KhZrKt9Upqip61i9E3vMvxRdHlbEFiEXfk9YARYxOZZD6VQ2pUunBmtRXo1Lf8hMVVcNl8JafV38aM2/Fu5V16Bn63r6xt97j09+MXSFi4BniGFae3hzbH9+hYBzkpuUh5aZmHuanZOZgIuvbGiNeomCnaxxap2upaCZsq+1kAACH5BAkBAAEALAAAAAAoACgAAAKXjI8By5zf4kOxTVrXNVlv1X0d8IGZGKLnNpYtm8Lr9cqVeuOSvfOW79D9aDHizNhDJidFZhNydEahOaDH6nomtJjp1tutKoNWkvA6JqfRVLHU/QUfau9l2x7G54d1fl995xcIGAdXqMfBNadoYrhH+Mg2KBlpVpbluCiXmMnZ2Sh4GBqJ+ckIOqqJ6LmKSllZmsoq6wpQAAAh+QQJAQABACwAAAAAKAAoAAAClYx/oLvoxuJDkU1a1YUZbJ59nSd2ZXhWqbRa2/gF8Gu2DY3iqs7yrq+xBYEkYvFSM8aSSObE+ZgRl1BHFZNr7pRCavZ5BW2142hY3AN/zWtsmf12p9XxxFl2lpLn1rseztfXZjdIWIf2s5dItwjYKBgo9yg5pHgzJXTEeGlZuenpyPmpGQoKOWkYmSpaSnqKileI2FAAACH5BAkBAAEALAAAAAAoACgAAAKVjB+gu+jG4kORTVrVhRlsnn2dJ3ZleFaptFrb+CXmO9OozeL5VfP99HvAWhpiUdcwkpBH3825AwYdU8xTqlLGhtCosArKMpvfa1mMRae9VvWZfeB2XfPkeLmm18lUcBj+p5dnN8jXZ3YIGEhYuOUn45aoCDkp16hl5IjYJvjWKcnoGQpqyPlpOhr3aElaqrq56Bq7VAAAOw==") repeat scroll 0 0;
    height: 100%;
    opacity: 0.25;
}
.ui-progressbar-indeterminate .ui-progressbar-value {
    background-image: none;
}
.ui-selectable {
    touch-action: none;
}
.ui-selectable-helper {
    border: 1px dotted black;
    position: absolute;
    z-index: 100;
}
.ui-selectmenu-menu {
    display: none;
    left: 0;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 0;
}
.ui-selectmenu-menu .ui-menu {
    overflow-x: hidden;
    overflow-y: auto;
    padding-bottom: 1px;
}
.ui-selectmenu-menu .ui-menu .ui-selectmenu-optgroup {
    border: 0 none;
    font-size: 1em;
    font-weight: bold;
    height: auto;
    line-height: 1.5;
    margin: 0.5em 0 0;
    padding: 2px 0.4em;
}
.ui-selectmenu-open {
    display: block;
}
.ui-selectmenu-text {
    display: block;
    margin-right: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.ui-selectmenu-button.ui-button {
    text-align: left;
    white-space: nowrap;
    width: 14em;
}
.ui-selectmenu-icon.ui-icon {
    float: right;
    margin-top: 0;
}
.ui-slider {
    position: relative;
    text-align: left;
}
.ui-slider .ui-slider-handle {
    cursor: default;
    height: 1.2em;
    position: absolute;
    touch-action: none;
    width: 1.2em;
    z-index: 2;
}
.ui-slider .ui-slider-range {
    background-position: 0 0;
    border: 0 none;
    display: block;
    font-size: 0.7em;
    position: absolute;
    z-index: 1;
}
.ui-slider.ui-state-disabled .ui-slider-handle, .ui-slider.ui-state-disabled .ui-slider-range {
    filter: inherit;
}
.ui-slider-horizontal {
    height: 0.8em;
}
.ui-slider-horizontal .ui-slider-handle {
    margin-left: -0.6em;
    top: -0.3em;
}
.ui-slider-horizontal .ui-slider-range {
    height: 100%;
    top: 0;
}
.ui-slider-horizontal .ui-slider-range-min {
    left: 0;
}
.ui-slider-horizontal .ui-slider-range-max {
    right: 0;
}
.ui-slider-vertical {
    height: 100px;
    width: 0.8em;
}
.ui-slider-vertical .ui-slider-handle {
    left: -0.3em;
    margin-bottom: -0.6em;
    margin-left: 0;
}
.ui-slider-vertical .ui-slider-range {
    left: 0;
    width: 100%;
}
.ui-slider-vertical .ui-slider-range-min {
    bottom: 0;
}
.ui-slider-vertical .ui-slider-range-max {
    top: 0;
}
.ui-sortable-handle {
    touch-action: none;
}
.ui-spinner {
    display: inline-block;
    overflow: hidden;
    padding: 0;
    position: relative;
    vertical-align: middle;
}
.ui-spinner-input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: inherit;
    margin: 0.2em 2em 0.2em 0.4em;
    padding: 0.222em 0;
    vertical-align: middle;
}
.ui-spinner-button {
    cursor: default;
    display: block;
    font-size: 0.5em;
    height: 50%;
    margin: 0;
    overflow: hidden;
    padding: 0;
    position: absolute;
    right: 0;
    text-align: center;
    width: 1.6em;
}
.ui-spinner a.ui-spinner-button {
    border-bottom-style: none;
    border-right-style: none;
    border-top-style: none;
}
.ui-spinner-up {
    top: 0;
}
.ui-spinner-down {
    bottom: 0;
}
.ui-tabs {
    padding: 0.2em;
    position: relative;
}
.ui-tabs .ui-tabs-nav {
    margin: 0;
    padding: 0.2em 0.2em 0;
}
.ui-tabs .ui-tabs-nav li {
    border-bottom-width: 0;
    float: left;
    list-style: outside none none;
    margin: 1px 0.2em 0 0;
    padding: 0;
    position: relative;
    top: 0;
    white-space: nowrap;
}
.ui-tabs .ui-tabs-nav .ui-tabs-anchor {
    float: left;
    padding: 0.5em 1em;
    text-decoration: none;
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active {
    margin-bottom: -1px;
    padding-bottom: 1px;
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor, .ui-tabs .ui-tabs-nav li.ui-state-disabled .ui-tabs-anchor, .ui-tabs .ui-tabs-nav li.ui-tabs-loading .ui-tabs-anchor {
    cursor: text;
}
.ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    cursor: pointer;
}
.ui-tabs .ui-tabs-panel {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border-width: 0;
    display: block;
    padding: 1em 1.4em;
}
.ui-tooltip {
    max-width: 300px;
    padding: 8px;
    position: absolute;
    z-index: 9999;
}
body .ui-tooltip {
    border-width: 2px;
}
.ui-widget {
    font-family: Arial,Helvetica,sans-serif;
    font-size: 1em;
}
.ui-widget .ui-widget {
    font-size: 1em;
}
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {
    font-family: Arial,Helvetica,sans-serif;
    font-size: 1em;
}
.ui-widget.ui-widget-content {
    border: 1px solid #c5c5c5;
}
.ui-widget-content {
    background: #ffffff none repeat scroll 0 0;
    border: 1px solid #dddddd;
    color: #333333;
}
.ui-widget-content a {
    color: #333333;
}
.ui-widget-header {
    background: #e9e9e9 none repeat scroll 0 0;
    border: 1px solid #dddddd;
    color: #333333;
    font-weight: bold;
}
.ui-widget-header a {
    color: #333333;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    background: #f6f6f6 none repeat scroll 0 0;
    border: 1px solid #c5c5c5;
    color: #454545;
    font-weight: normal;
}
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a.ui-button:link, a.ui-button:visited, .ui-button {
    color: #454545;
    text-decoration: none;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, .ui-button:hover, .ui-button:focus {
    background: #ededed none repeat scroll 0 0;
    border: 1px solid #cccccc;
    color: #2b2b2b;
    font-weight: normal;
}
.ui-state-hover a, .ui-state-hover a:hover, .ui-state-hover a:link, .ui-state-hover a:visited, .ui-state-focus a, .ui-state-focus a:hover, .ui-state-focus a:link, .ui-state-focus a:visited, a.ui-button:hover, a.ui-button:focus {
    color: #2b2b2b;
    text-decoration: none;
}
.ui-visual-focus {
    box-shadow: 0 0 3px 1px rgb(94, 158, 214);
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
    background: #007fff none repeat scroll 0 0;
    border: 1px solid #003eff;
    color: #ffffff;
    font-weight: normal;
}
.ui-icon-background, .ui-state-active .ui-icon-background {
    background-color: #ffffff;
    border: medium none #003eff;
}
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
    color: #ffffff;
    text-decoration: none;
}
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
    background: #fffa90 none repeat scroll 0 0;
    border: 1px solid #dad55e;
    color: #777620;
}
.ui-state-checked {
    background: #fffa90 none repeat scroll 0 0;
    border: 1px solid #dad55e;
}
.ui-state-highlight a, .ui-widget-content .ui-state-highlight a, .ui-widget-header .ui-state-highlight a {
    color: #777620;
}
.ui-state-error, .ui-widget-content .ui-state-error, .ui-widget-header .ui-state-error {
    background: #fddfdf none repeat scroll 0 0;
    border: 1px solid #f1a899;
    color: #5f3f3f;
}
.ui-state-error a, .ui-widget-content .ui-state-error a, .ui-widget-header .ui-state-error a {
    color: #5f3f3f;
}
.ui-state-error-text, .ui-widget-content .ui-state-error-text, .ui-widget-header .ui-state-error-text {
    color: #5f3f3f;
}
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary {
    font-weight: bold;
}
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary, .ui-widget-header .ui-priority-secondary {
    font-weight: normal;
    opacity: 0.7;
}
.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled {
    background-image: none;
    opacity: 0.35;
}
.ui-state-disabled .ui-icon {
}
.ui-icon {
    height: 16px;
    width: 16px;
}
.ui-icon, .ui-widget-content .ui-icon {
    background-image: url(<?php echo $this->webroot?>"images/spa/ui-icons.png");
}
.ui-widget-header .ui-icon {
    background-image: url(<?php echo $this->webroot?>"images/spa/ui-icons.png");
}
.ui-state-hover .ui-icon, .ui-state-focus .ui-icon, .ui-button:hover .ui-icon, .ui-button:focus .ui-icon {
    background-image: url("images/ui-icons_555555_256x240.png");
}
.ui-state-active .ui-icon, .ui-button:active .ui-icon {
    background-image: url("images/ui-icons_ffffff_256x240.png");
}
.ui-state-highlight .ui-icon, .ui-button .ui-state-highlight.ui-icon {
    background-image: url("images/ui-icons_777620_256x240.png");
}
.ui-state-error .ui-icon, .ui-state-error-text .ui-icon {
    background-image: url("images/ui-icons_cc0000_256x240.png");
}
.ui-button .ui-icon {
    background-image: url("images/ui-icons_777777_256x240.png");
}
.ui-icon-blank {
    background-position: 16px 16px;
}
.ui-icon-caret-1-n {
    background-position: 0 0;
}
.ui-icon-caret-1-ne {
    background-position: -16px 0;
}
.ui-icon-caret-1-e {
    background-position: -32px 0;
}
.ui-icon-caret-1-se {
    background-position: -48px 0;
}
.ui-icon-caret-1-s {
    background-position: -65px 0;
}
.ui-icon-caret-1-sw {
    background-position: -80px 0;
}
.ui-icon-caret-1-w {
    background-position: -96px 0;
}
.ui-icon-caret-1-nw {
    background-position: -112px 0;
}
.ui-icon-caret-2-n-s {
    background-position: -128px 0;
}
.ui-icon-caret-2-e-w {
    background-position: -144px 0;
}
.ui-icon-triangle-1-n {
    background-position: 0 -16px;
}
.ui-icon-triangle-1-ne {
    background-position: -16px -16px;
}
.ui-icon-triangle-1-e {
    background-position: -32px -16px;
}
.ui-icon-triangle-1-se {
    background-position: -48px -16px;
}
.ui-icon-triangle-1-s {
    background-position: -65px -16px;
}
.ui-icon-triangle-1-sw {
    background-position: -80px -16px;
}
.ui-icon-triangle-1-w {
    background-position: -96px -16px;
}
.ui-icon-triangle-1-nw {
    background-position: -112px -16px;
}
.ui-icon-triangle-2-n-s {
    background-position: -128px -16px;
}
.ui-icon-triangle-2-e-w {
    background-position: -144px -16px;
}
.ui-icon-arrow-1-n {
    background-position: 0 -32px;
}
.ui-icon-arrow-1-ne {
    background-position: -16px -32px;
}
.ui-icon-arrow-1-e {
    background-position: -32px -32px;
}
.ui-icon-arrow-1-se {
    background-position: -48px -32px;
}
.ui-icon-arrow-1-s {
    background-position: -65px -32px;
}
.ui-icon-arrow-1-sw {
    background-position: -80px -32px;
}
.ui-icon-arrow-1-w {
    background-position: -96px -32px;
}
.ui-icon-arrow-1-nw {
    background-position: -112px -32px;
}
.ui-icon-arrow-2-n-s {
    background-position: -128px -32px;
}
.ui-icon-arrow-2-ne-sw {
    background-position: -144px -32px;
}
.ui-icon-arrow-2-e-w {
    background-position: -160px -32px;
}
.ui-icon-arrow-2-se-nw {
    background-position: -176px -32px;
}
.ui-icon-arrowstop-1-n {
    background-position: -192px -32px;
}
.ui-icon-arrowstop-1-e {
    background-position: -208px -32px;
}
.ui-icon-arrowstop-1-s {
    background-position: -224px -32px;
}
.ui-icon-arrowstop-1-w {
    background-position: -240px -32px;
}
.ui-icon-arrowthick-1-n {
    background-position: 1px -48px;
}
.ui-icon-arrowthick-1-ne {

    background-position: -16px -48px;
}
.ui-icon-arrowthick-1-e {
    background-position: -32px -48px;
}
.ui-icon-arrowthick-1-se {
    background-position: -48px -48px;
}
.ui-icon-arrowthick-1-s {
    background-position: -64px -48px;
}
.ui-icon-arrowthick-1-sw {
    background-position: -80px -48px;
}
.ui-icon-arrowthick-1-w {
    background-position: -96px -48px;
}
.ui-icon-arrowthick-1-nw {
    background-position: -112px -48px;
}
.ui-icon-arrowthick-2-n-s {
    background-position: -128px -48px;
}
.ui-icon-arrowthick-2-ne-sw {
    background-position: -144px -48px;
}
.ui-icon-arrowthick-2-e-w {
    background-position: -160px -48px;
}
.ui-icon-arrowthick-2-se-nw {
    background-position: -176px -48px;
}
.ui-icon-arrowthickstop-1-n {
    background-position: -192px -48px;
}
.ui-icon-arrowthickstop-1-e {
    background-position: -208px -48px;
}
.ui-icon-arrowthickstop-1-s {
    background-position: -224px -48px;
}
.ui-icon-arrowthickstop-1-w {
    background-position: -240px -48px;
}
.ui-icon-arrowreturnthick-1-w {
    background-position: 0 -64px;
}
.ui-icon-arrowreturnthick-1-n {
    background-position: -16px -64px;
}
.ui-icon-arrowreturnthick-1-e {
    background-position: -32px -64px;
}
.ui-icon-arrowreturnthick-1-s {
    background-position: -48px -64px;
}
.ui-icon-arrowreturn-1-w {
    background-position: -64px -64px;
}
.ui-icon-arrowreturn-1-n {
    background-position: -80px -64px;
}
.ui-icon-arrowreturn-1-e {
    background-position: -96px -64px;
}
.ui-icon-arrowreturn-1-s {
    background-position: -112px -64px;
}
.ui-icon-arrowrefresh-1-w {
    background-position: -128px -64px;
}
.ui-icon-arrowrefresh-1-n {
    background-position: -144px -64px;
}
.ui-icon-arrowrefresh-1-e {
    background-position: -160px -64px;
}
.ui-icon-arrowrefresh-1-s {
    background-position: -176px -64px;
}
.ui-icon-arrow-4 {
    background-position: 0 -80px;
}
.ui-icon-arrow-4-diag {
    background-position: -16px -80px;
}
.ui-icon-extlink {
    background-position: -32px -80px;
}
.ui-icon-newwin {
    background-position: -48px -80px;
}
.ui-icon-refresh {
    background-position: -64px -80px;
}
.ui-icon-shuffle {
    background-position: -80px -80px;
}
.ui-icon-transfer-e-w {
    background-position: -96px -80px;
}
.ui-icon-transferthick-e-w {
    background-position: -112px -80px;
}
.ui-icon-folder-collapsed {
    background-position: 0 -96px;
}
.ui-icon-folder-open {
    background-position: -16px -96px;
}
.ui-icon-document {
    background-position: -32px -96px;
}
.ui-icon-document-b {
    background-position: -48px -96px;
}
.ui-icon-note {
    background-position: -64px -96px;
}
.ui-icon-mail-closed {
    background-position: -80px -96px;
}
.ui-icon-mail-open {
    background-position: -96px -96px;
}
.ui-icon-suitcase {
    background-position: -112px -96px;
}
.ui-icon-comment {
    background-position: -128px -96px;
}
.ui-icon-person {
    background-position: -144px -96px;
}
.ui-icon-print {
    background-position: -160px -96px;
}
.ui-icon-trash {
    background-position: -176px -96px;
}
.ui-icon-locked {
    background-position: -192px -96px;
}
.ui-icon-unlocked {
    background-position: -208px -96px;
}
.ui-icon-bookmark {
    background-position: -224px -96px;
}
.ui-icon-tag {
    background-position: -240px -96px;
}
.ui-icon-home {
    background-position: 0 -112px;
}
.ui-icon-flag {
    background-position: -16px -112px;
}
.ui-icon-calendar {
    background-position: -32px -112px;
}
.ui-icon-cart {
    background-position: -48px -112px;
}
.ui-icon-pencil {
    background-position: -64px -112px;
}
.ui-icon-clock {
    background-position: -80px -112px;
}
.ui-icon-disk {
    background-position: -96px -112px;
}
.ui-icon-calculator {
    background-position: -112px -112px;
}
.ui-icon-zoomin {
    background-position: -128px -112px;
}
.ui-icon-zoomout {
    background-position: -144px -112px;
}
.ui-icon-search {
    background-position: -160px -112px;
}
.ui-icon-wrench {
    background-position: -176px -112px;
}
.ui-icon-gear {
    background-position: -192px -112px;
}
.ui-icon-heart {
    background-position: -208px -112px;
}
.ui-icon-star {
    background-position: -224px -112px;
}
.ui-icon-link {
    background-position: -240px -112px;
}
.ui-icon-cancel {
    background-position: 0 -128px;
}
.ui-icon-plus {
    background-position: -16px -128px;
}
.ui-icon-plusthick {
    background-position: -32px -128px;
}
.ui-icon-minus {
    background-position: -48px -128px;
}
.ui-icon-minusthick {
    background-position: -64px -128px;
}
.ui-icon-close {
    background-position: -80px -128px;
}
.ui-icon-closethick {
    background-position: -96px -128px;
}
.ui-icon-key {
    background-position: -112px -128px;
}
.ui-icon-lightbulb {
    background-position: -128px -128px;
}
.ui-icon-scissors {
    background-position: -144px -128px;
}
.ui-icon-clipboard {
    background-position: -160px -128px;
}
.ui-icon-copy {
    background-position: -176px -128px;
}
.ui-icon-contact {
    background-position: -192px -128px;
}
.ui-icon-image {
    background-position: -208px -128px;
}
.ui-icon-video {
    background-position: -224px -128px;
}
.ui-icon-script {
    background-position: -240px -128px;
}
.ui-icon-alert {
    background-position: 0 -144px;
}
.ui-icon-info {
    background-position: -16px -144px;
}
.ui-icon-notice {
    background-position: -32px -144px;
}
.ui-icon-help {
    background-position: -48px -144px;
}
.ui-icon-check {
    background-position: -64px -144px;
}
.ui-icon-bullet {
    background-position: -80px -144px;
}
.ui-icon-radio-on {
    background-position: -96px -144px;
}
.ui-icon-radio-off {
    background-position: -112px -144px;
}
.ui-icon-pin-w {
    background-position: -128px -144px;
}
.ui-icon-pin-s {
    background-position: -144px -144px;
}
.ui-icon-play {
    background-position: 0 -160px;
}
.ui-icon-pause {
    background-position: -16px -160px;
}
.ui-icon-seek-next {
    background-position: -32px -160px;
}
.ui-icon-seek-prev {
    background-position: -48px -160px;
}
.ui-icon-seek-end {
    background-position: -64px -160px;
}
.ui-icon-seek-start {
    background-position: -80px -160px;
}
.ui-icon-seek-first {
    background-position: -80px -160px;
}
.ui-icon-stop {
    background-position: -96px -160px;
}
.ui-icon-eject {
    background-position: -112px -160px;
}
.ui-icon-volume-off {
    background-position: -128px -160px;
}
.ui-icon-volume-on {
    background-position: -144px -160px;
}
.ui-icon-power {
    background-position: 0 -176px;
}
.ui-icon-signal-diag {
    background-position: -16px -176px;
}
.ui-icon-signal {
    background-position: -32px -176px;
}
.ui-icon-battery-0 {
    background-position: -48px -176px;
}
.ui-icon-battery-1 {
    background-position: -64px -176px;
}
.ui-icon-battery-2 {
    background-position: -80px -176px;
}
.ui-icon-battery-3 {
    background-position: -96px -176px;
}
.ui-icon-circle-plus {
    background-position: 0 -192px;
}
.ui-icon-circle-minus {
    background-position: -16px -192px;
}
.ui-icon-circle-close {
    background-position: -32px -192px;
}
.ui-icon-circle-triangle-e {
    background-position: -48px -192px;
}
.ui-icon-circle-triangle-s {
    background-position: -64px -192px;
}
.ui-icon-circle-triangle-w {
    background-position: -80px -192px;
}
.ui-icon-circle-triangle-n {
    background-position: -96px -192px;
}
.ui-icon-circle-arrow-e {
    background-position: -112px -192px;
}
.ui-icon-circle-arrow-s {
    background-position: -128px -192px;
}
.ui-icon-circle-arrow-w {
    background-position: -144px -192px;
}
.ui-icon-circle-arrow-n {
    background-position: -160px -192px;
}
.ui-icon-circle-zoomin {
    background-position: -176px -192px;
}
.ui-icon-circle-zoomout {
    background-position: -192px -192px;
}
.ui-icon-circle-check {
    background-position: -208px -192px;
}
.ui-icon-circlesmall-plus {
    background-position: 0 -208px;
}
.ui-icon-circlesmall-minus {
    background-position: -16px -208px;
}
.ui-icon-circlesmall-close {
    background-position: -32px -208px;
}
.ui-icon-squaresmall-plus {
    background-position: -48px -208px;
}
.ui-icon-squaresmall-minus {
    background-position: -64px -208px;
}
.ui-icon-squaresmall-close {
    background-position: -80px -208px;
}
.ui-icon-grip-dotted-vertical {
    background-position: 0 -224px;
}
.ui-icon-grip-dotted-horizontal {
    background-position: -16px -224px;
}
.ui-icon-grip-solid-vertical {
    background-position: -32px -224px;
}
.ui-icon-grip-solid-horizontal {
    background-position: -48px -224px;
}
.ui-icon-gripsmall-diagonal-se {
    background-position: -64px -224px;
}
.ui-icon-grip-diagonal-se {
    background-position: -80px -224px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 3px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 3px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 3px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 3px;
}
.ui-widget-overlay {
    background: #aaaaaa none repeat scroll 0 0;
    opacity: 0.3;
}
.ui-widget-shadow {
    box-shadow: 0 0 5px #666666;
}
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {
    display: block;
    position: absolute;
    left: 50%;
    margin-left: -8px;
    top: 50%;
    margin-top: -8px;
}
.demo select {
    width: 33%;
    float: left;
    padding: 7px 6px;
}
.demo {
    width: 100%;
    float: left;
}
</style>