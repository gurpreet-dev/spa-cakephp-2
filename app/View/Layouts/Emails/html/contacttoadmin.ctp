<style>h2{font-weight:500;margin-bottom:1px;}p{color:#666;}.reset{background:#cb202d;padding:15px 20px;text-transform:uppercase;display:inline-block;color:#fff;	border-radius: 4px;	text-decoration:none;font-weight:500;}.brdr_btmm { border-bottom: 1px solid #ccc; padding: 10px 5px; color: #2d2e29;}.brdr_btmm1 {border-bottom: 1px solid #ccc;padding: 10px 5px;color: #2d2e29;	border-top: 1px solid #ccc;}.brdr_btm1 {border-bottom: 1px solid #ccc;color: #2d2e29}.brdr_btm {border-bottom: 1px solid #ccc; color: #2d2e29;border-top: 1px solid #ccc;}.brdr_btm2 {width: auto;padding: 6px 0px 5px 97% !important;float: left;}.pay_sum{color: #2d2e29;}.order_id{color: #7c7d77;font-size: 13px;padding-top: 0px;padding-bottom: 0px;}.order_id1{color: #7c7d77;font-size: 13px;padding-top: 0px;padding-bottom: 14px;}</style>


		<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#f0f0f0; text-align:center;">
  <tr style="background:#006500; ">
    <td style="text-align:center; padding-top:5px; padding-bottom:5px; ">
    	<img src="<?php echo FULL_BASE_URL . $this->webroot  ?>images/spa/logon-01.png" alt="img" width="16%"/>
    </td>
  </tr>
  <tr>
    <td>
    	<h2>Contact Us</h2>
        <p></p>
       <table width="100%" border="0" cellpadding="10" bgcolor="#f2f2f2" style="background-color:#e2e2e2; margin:20px 0px;">
       <thead>
       <tr>
        <td class="pay_sum" align="left" style="text-align:left;"><strong>Name:</strong> <?php echo $contact_data['Contact']['name']; ?></td>
        <!--<td>Hello</td>-->
       </tr>
       <tr>
         <td class="pay_sum" align="left" style="text-align:left;"><strong>Email:</strong> <?php echo $contact_data['Contact']['email']; ?></td>
         <!--<td>Hello</td>-->
       </tr>
       <tr>
          <td class="pay_sum" align="left" style="text-align:left;"><strong>Phone:</strong> <?php echo $contact_data['Contact']['phone']; ?></td>
          <!--<td>Hello</td>-->
       </tr>
	    <tr>
          <td class="pay_sum" align="left" style="text-align:left;"><strong>Feedback:</strong> <?php echo $contact_data['Contact']['feedback']; ?></td>
          <!--<td>Hello</td>-->
       </tr>
       </thead>
			
            
</table>
        <p>Issued on behalf of<br /><span style="color:#2d2e29; font-size:20px; line-height: 29px;">MTH</span>.</p>

    </td>
  </tr>

</table>