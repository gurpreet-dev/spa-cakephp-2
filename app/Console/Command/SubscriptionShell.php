<?php
App::uses('Shell', 'Console');

App::uses('CakeEmail', 'Network/Email');

class SubscriptionShell extends AppShell{

	 public function baseurl() {
        return  CUSTOM_BASE_URL;
    }
	
    public function email() {
		$this->loadModel('User');
		$users = $this->User->find('all', array('conditions' => array('User.role' => 'freelancer', 'User.active' => 1, 'User.subscription !=' => 0)));
		
		foreach($users as $user){ 
			$date1=date_create($user['User']['expire_date']);
			$date2=date_create(date('d-m-Y'));
			$diff=date_diff($date1,$date2);
			if (strpos($diff->format("%R%a"), '-') !== false) {
				$actual_diff = str_replace('-', '', $diff->format("%R%a"));
				if($actual_diff == '1' || $actual_diff == '5'){
					$ms = '<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#f0f0f0; text-align:center;"><tr style="background:#f0f0f0; "><td style="text-align:center; padding-top:5px; padding-bottom:5px; background-color: #006500; "><img src="'.$this->baseurl(). '/images/spa/logon-01.png" alt="img" width="16%" /></td></tr><tr><td><h2 style="font-weight:500; margin-bottom:1px;">Your Subscription with MTH will expire in '.$actual_diff.' Days.</h2><p style="padding-top:40px; margin-bottom:0px !important;s">Issue on behalf of<br /><span style="color:#2d2e29; font-size:20px; line-height: 29px;">MTH</span></p></td></tr></table>';
					
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->from(array('rahulsharma@avainfotech.com' => 'MTH'));
					$Email->to($user['User']['email']);
					//$Email->to('gurpreet@avainfotech.com');
					$Email->subject('Subscription Alert');
					$Email->send($ms);
				}
			}
		}
	}
	
	public function update_subscription(){
	
		$this->loadModel('User');
		$users = $this->User->find('all', array('conditions' => array('User.role' => 'freelancer', 'User.active' => 1, 'User.subscription !=' => 0)));
		foreach($users as $user){ 
			//$expire_date = $users[$i]['User']['expire_date'];			
			$expiry_date = strtotime($user['User']['expire_date']);
			$subscribe_date = strtotime($user['User']['subscribe_date']);
			$current_date = time();
			
			if ($subscribe_date < $current_date && $expiry_date > $current_date ) {
				$this->User->updateAll(array('User.subscription_status' => '"subscribed"', 'User.subscription' => '1'), array('User.id' => $user['User']['id']));
			}
			
			
			if ($expiry_date < $current_date) {
				$this->User->updateAll(array('User.subscription_status' => '"expired"', 'User.subscription' => '0'), array('User.id' => $user['User']['id']));
					
				$ms = '<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#f0f0f0; text-align:center;"><tr style="background:#f0f0f0; "><td style="text-align:center; padding-top:5px; padding-bottom:5px; background-color: #006500; "><img src="'.$this->baseurl(). '/images/spa/logon-01.png" alt="img" width="16%" /></td></tr><tr><td><h2 style="font-weight:500; margin-bottom:1px;">Your Subscription has been expired.</h2><p style="padding-top:40px; margin-bottom:0px !important;s">Issue on behalf of<br /><span style="color:#2d2e29; font-size:20px; line-height: 29px;">MTH</span></p></td></tr></table>';	
					
				$Email = new CakeEmail();
				$Email->from(array('rahulsharma@avainfotech.com' => 'MTH'));
				$Email->to($user['User']['email']);
				$Email->subject('Subscription Expiration');
				$Email->send($ms);
				
				
				$ms2 = '<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#f0f0f0; text-align:center;"><tr style="background:#f0f0f0; "><td style="text-align:center; padding-top:5px; padding-bottom:5px; background-color: #006500; "><img src="'.$this->baseurl(). '/images/spa/logon-01.png" alt="img" width="16%" /></td></tr><tr><td><h2 style="font-weight:500; margin-bottom:1px;">Subscription for '.$user['User']['id'].' has been expired.</h2><p style="padding-top:40px; margin-bottom:0px !important;s">Issue on behalf of<br /><span style="color:#2d2e29; font-size:20px; line-height: 29px;">MTH</span></p></td></tr></table>';	
					
				$Email2 = new CakeEmail();
				$Email2->from(array('rahulsharma@avainfotech.com' => 'MTH'));
				$Email2->to('gurpreet@avainfotech.com');
				$Email2->subject('Subscription Expiration');
				$Email2->send($ms);
				
				
			}
			
			if ($subscribe_date == $current_date) {
				$this->User->updateAll(array('User.subscription_status' => '"subscribed"'), array('User.id' => $user['User']['id']));
			}
		}
	}
}		