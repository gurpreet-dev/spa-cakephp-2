<?php







App::uses('AppController', 'Controller');



App::uses('CakeEmail', 'Network/Email');



App::import('Vendor', 'Facebook', array('file' => 'Facebook' . DS . 'facebook.php'));



App::import('Vendor', 'Twitter', array('file' => 'Twitter' . DS . 'twitteroauth.php'));



App::import('Vendor', 'Google', array('file' => 'Google' . DS . 'autoload.php'));







class UsersController extends AppController {







////////////////////////////////////////////////////////////







	public $components = array('Paginator');







    public function beforeFilter() {



        parent::beforeFilter();







        $this->Auth->allow('login', 'admin_add', 'admin_login', 'api_login', 'api_userlogin', 'api_registration', 'reset', 'api_useredit', 'add', 'showwishlist', 'api_showwishlist', 'api_verifyEmail', 'api_forgetpwd', 'api_resetpwd', 'user_ask_ques', 'api_changepassword', 'facebook_connect', 'fblogin', 'twitter_process', 'api_saveimage', 'google_login', 'track_order', 'api_orderHistory', 'api_fbloginapp', 'api_twitterlogin', 'api_googlelogin', 'cmb');



    }







////////////////////////////////////////////////////////////















    public function login() {



        // echo AuthComponent::password('admin');



        



        Configure::write('debug', 2);



        



        if($this->Auth->user('id')){



            $this->redirect(array('controller' => 'shop', 'action' => 'index'));



        }







        if ($this->request->is('post')) {



           



            //echo $this->request->data['User']['server'];exit;



            $sesid = $this->Session->id();



            if ($this->Auth->login()) {



				$uid =$this->Auth->user('id');







                $this->User->id = $this->Auth->user('id');



                $this->User->saveField('last_login', date('Y-m-d H:i:s'));



                $this->loadModel('Cart');



                $updatesess = $this->Session->id();



                $this->Cart->updateAll(array('Cart.sessionid' => "'$updatesess'",'Cart.uid' => "'$uid'"), array('Cart.sessionid' => $sesid));



                if ($this->Auth->user('role') == 'customer' || $this->Auth->user('role') == 'freelancer') {



                  return $this->redirect(array('controller' => 'shop', 'action' => 'index'));



                  } elseif ($this->Auth->user('role') == 'admin') {



                    $uploadURL = Router::url('/') . 'app/webroot/upload';



                    $_SESSION['KCFINDER'] = array(



                        'disabled' => false,



                        'uploadURL' => $uploadURL,



                        'uploadDir' => ''



                    );







                    return $this->redirect(array(



                                'controller' => 'dashboards',



                                'action' => 'dashboard',



                                'manager' => false,



                                'admin' => true



                    ));



                }else{



                     $this->Flash->set('Login is incorrect');



                // $this->Session->setFlash('Login is incorrect', 'flash_success');



                   // return $this->redirect('http://' . $this->request->data['User']['server']);



                }



            } else {



           $this->Flash->set('Login is incorrect');



                //$this->Session->setFlash('Login is incorrect', 'flash_success');



             //return $this->redirect('http://' . $this->request->data['User']['server']);



            }



        }



    }



    



    







////////////////////////////////////////////







//////////////////////////////////////////////



public function ajaxsignup(){



        Configure::write("debug", 2);

		

		$json = array();

		



        if ($this->request->is('post')) {



            

			

            //echo '</pre>'; print_r($this->request->data); echo '</pre>'; exit;







            $this->request->data['User']['email'] = $this->request->data['email'];







            $this->request->data['User']['username'] = $this->request->data['email'];



            



            $this->request->data['User']['first_name'] = $this->request->data['first_name'];



            



            $this->request->data['User']['last_name'] = $this->request->data['last_name'];



            



            $this->request->data['User']['role'] = $this->request->data['role'];

            



            $password = $this->request->data['pass'];



            



            $password_hash = AuthComponent::password($password);



            



            $this->request->data['User']['password'] = $this->request->data['pass'];







            // $this->request->data['User']['active'] = 1;







            



            if($this->request->data['role'] == 'customer'){



                $this->request->data['User']['active'] = 1;



            }



            



            $this->request->data['User']['name'] = ucwords($this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name']);



            



            



		$response=array();	



            if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {

			

				$json = array('response' => 'exist', 'error' => 1);



				echo json_encode($json);

				

				exit;



            }else{  



                $this->User->create();



                $fu = $this->request->data;



                if ($this->User->save($this->request->data)) {

				

					$last_id = $this->User->getLastInsertID();

					

					/*** START *********Email send to user****************/
					
					$url = '';

					$ms = '<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#f0f0f0; text-align:center;"><tr style="background:#f0f0f0; "><td style="text-align:center; padding-top:5px; padding-bottom:5px; background-color: #006500; "><img src="'.FULL_BASE_URL . $this->webroot . "images/spa/logon-01.png".'" alt="img" width="16%" /></td></tr><tr><td><h2 style="font-weight:500; margin-bottom:1px;">Thanks for Register with MTH</h2><p style="padding-top:40px; margin-bottom:0px !important;s">Issue on behalf of<br /><span style="color:#2d2e29; font-size:20px; line-height: 29px;">MTH</span></p></td></tr></table>';

					

					      $l = new CakeEmail();     



                            $l->emailFormat('html')->template('default','default')->subject('Reset Your Password')



                                     ->viewVars(array('link' => $url)) 



                                    ->viewVars(array('user' => $fu)) 

									->from(array('rahulsharma@avainfotech.com' => 'MTH'))



                                    ->to($this->request->data['User']['email'])->send($ms);

					

					/****END******************************************/		

					

					/*** START *********Email send to Admin****************/

					if($this->request->data['role'] == 'freelancer'){

					$fullname = $this->request->data['first_name'] . ' ' . $this->request->data['last_name'];

					$ms = '<table width="500" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#f0f0f0; text-align:center;"><tr style="background:#f0f0f0; "><td style="text-align:center; padding-top:5px; padding-bottom:5px; background-color: #006500; "><img src="'.FULL_BASE_URL . $this->webroot . "images/spa/logon-01.png".'" alt="img" width="16%" /></td></tr><tr><td><h2 style="font-weight:500; margin-bottom:1px;">A New <strong>Freelancer</strong> is Registered with us</h2><p style="color:#666;">Name:'.$fullname.'</p><p style="padding-top:40px; margin-bottom:0px !important;s">Issue on behalf of<br /><span style="color:#2d2e29; font-size:20px; line-height: 29px;">MTH</span></p></td></tr></table>';

					

						$l = new CakeEmail();     

						$l->emailFormat('html')->template('default','default')->subject('Reset Your Password')

							->viewVars(array('link' => $url)) 

							->viewVars(array('user' => $fu)) 

							->from(array('rahulsharma@avainfotech.com' => 'MTH'))

							->to('gurpreet@avainfotech.com')->send($ms);

					}				

					

					/****END******************************************/				

                    $json = array('response' => 'success', 'last_id' => $last_id, 'error' => 0);



					echo json_encode($json);

					

					exit;



                } else {



                     $json = array('response' => 'error', 'error' => 1);



					echo json_encode($json);

					

					exit;

                }

            }  

        }   

}





public function ajaxUploadImages(){



	$json = array();



	if(isset($_FILES['files'])){

		$actual_file = array();

		

		$files = $_FILES['files'];

		

		for($i=0; $i<count($files['name']);$i++){

			$fileName = $files['name'][$i];

			$fileName = date('His') . $fileName;

			$uploadPath = WWW_ROOT . '/files/spa/users/'.$fileName;

			$actual_file[] = $fileName;

			move_uploaded_file($files['tmp_name'][$i], $uploadPath);

		}    

		$actual_file = implode(',', $actual_file);

		

		$json = array('input' => $actual_file, 'error' => 0);

	

		echo json_encode($json);

		exit;



	}

	

	$json = array('input' => '', 'error' => 1);

		

	echo json_encode($json);

	exit;

}



public function updateDocuments(){

	$last_id = $this->request->data['id'];

	$actual_file = $this->request->data['input'];

		

	$update = $this->User->updateAll(array('User.attachments' => '"'.$actual_file.'"'), array('User.id' => $last_id));

	

	if($update){

		echo 'success';

		exit;

	}else{

		echo 'error';

		exit;

	}

	

}





public function ajaxlogin() {



        // echo AuthComponent::password('admin');



        if($this->Auth->user('id')){



            $this->redirect(array('controller' => 'shop', 'action' => 'index'));



        }







        if ($this->request->is('post')) {



            



            



            //print_r($this->request->data);exit;



            



            $this->request->data['User']['username'] = $this->request->data['email'];



            $this->request->data['User']['password'] = $this->request->data['password'];



           



            //echo $this->request->data['User']['server'];exit;



            if ($this->Auth->login()) {



                $uid =$this->Auth->user('id');



                $this->User->id = $this->Auth->user('id');



                $this->User->saveField('last_login', date('Y-m-d H:i:s'));

				

                if ($this->Auth->user('role') == 'customer' || $this->Auth->user('role') == 'freelancer') {



					$this->Session->delete('Shop.Guest');

					



					echo 'success';

					

					exit;



                } elseif ($this->Auth->user('role') == 'admin') {



                    $this->Auth->logout();



                    echo 'error';



                    exit;



                }else{



                     echo 'error';



                     exit;



                }



            } else {



                echo 'error';



                exit;



            }



        }



    }





	public function authRemember(){

		$cookie = array();

		

		$cookieTime = "12 months";

					

		$this->Cookie->write('rememberMe', $this->Auth->user(), true, $cookieTime);

		

	}





  //////////////////////////////////////////



	public function admin_profile(){



	



	}



  ///////////////////////////////////











    public function fblogin() {







        Configure::load('facebook');



        $appId = Configure::read('Facebook.appId');



        $app_secret = Configure::read('Facebook.secret');



       $facebook = new Facebook(array(



            'appId' => $appId,



            'secret' => $app_secret,



        ));







        $loginUrl = $facebook->getLoginUrl(array(



            'scope' => 'email,read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos',



            'redirect_uri' => 'http://netin.crystalbiltech.com/winegarden/users/facebook_connect',



            'display' => 'popup'



        ));



        



       



        $this->redirect($loginUrl);



    } 







////////////////////////////////////////////////////////////







    function facebook_connect() {



      configure::write('debug',2);



        Configure::load('facebook');



        $appId = Configure::read('Facebook.appId');



        $app_secret = Configure::read('Facebook.secret');







        $facebook = new Facebook(array(



            'appId' => $appId,



            'secret' => $app_secret,



        ));







        $user = $facebook->getUser();



        print_r($user); 



exit;



        if ($user){



            try {



                $user_profile = $facebook->api('/me?fields=id,email,name,picture');



                



               



            



                $options = array('conditions' => array('User.fboo_ids' => $user_profile['id']));



                $data = $this->User->find('first', $options ,array('User.email' => $user_profile['email']));



//                print_r($data);



//                exit;



                if ($data['User']['id']) {



                    $this->request->data['User']['username'] = $data['User']['username'];



                    $this->request->data['User']['password'] =$user_profile['id'] . 'admin';



                    



                      $this->Auth->login(); 



               



                     



                } else {



                    if ($user_profile['email'] == '') {



                        $user_profile['email'] = $user_profile['id'] . '@facebook.com';



                    }







//print_r($user_profile); 







                    $this->request->data['first_name'] = $user_profile['name'];



                    $this->request->data['username'] = $user_profile['email'];



                    $this->request->data['password'] = $user_profile['id'] . 'admin';



                    $this->request->data['email'] = $user_profile['email'];



                    $this->request->data['fboo_ids'] = $user_profile['id'];



                    $this->request->data['role'] = "customer";



                    $this->request->data['active'] = "1";



                    $this->request->data['image'] = $user_profile['picture']['data']['url'];



                    $this->User->create();



                    $this->User->save($this->request->data);



                    $user_id = $this->User->getLastInsertID();



                     



                    if ($user_id) {



                    $this->request->data['User']['username'] = $user_profile['email'];



                    $this->request->data['User']['password'] = $user_profile['id'] . 'admin';



                      $this->Auth->login();



           



                    



                }



                  



                }



                $params = array('next' => 'http://rupak.crystalbiltech.com/shop/users/facebook_logout');



                $logout = $facebook->getLogoutUrl($params);



                $this->Session->write('User', $user_profile);



                $this->Session->write('logout', $logout);



            } catch (FacebookApiException $e) {



                error_log($e);



                $user = NULL;



            }



        } else {



            $this->Flash->set('Sorry.Please try again');



            $this->redirect(array('controller'=>'shop','action' => 'index'));



        }



    }







//////////////////////////////////////////







    function facebook_logout() {







        $this->Session->delete('User');



        $this->Session->delete('logout');



        $this->Session->delete('Shop');



        $this->redirect(array('controller' => 'pages', 'action' => '/'));



    }







    ///////////////////////////////



    public function myaccount($id = null) {  



        Configure::write("debug", 2);



        $uid = $this->Auth->user('id');



        



        //$userId = $this->Session->read('User.id');







        //$usersid = $uid ? $uid : $userId;







        if (empty($uid)) {



            return $this->redirect(array('controller' => 'shop', 'action' => 'index'));



        }



        



        



        if($this->request->is(array('post', 'put'))){



            //echo "<pre>"; print_r($this->request->data); echo "</pre>";



             //exit;



             



            if($this->request->data['User']['type'] == 'personal'){



                $this->User->updateAll(array('User.first_name' => "\"".$this->request->data['User']['first_name']."\"", 'User.last_name' => "\"".$this->request->data['User']['last_name']."\"", 'User.email' => "\"".$this->request->data['User']['email']."\""), array('User.id' => $this->request->data['User']['id']));



            }elseif($this->request->data['User']['type'] == 'password'){



                //echo "<pre>"; print_r($this->request->data); echo "</pre>";



         



                $newpassword = $this->request->data['cpass'];



                $this->User->data['User']['password'] = $newpassword;



                $this->User->id = $this->request->data['User']['id'];



                if ($this->User->exists()) {



                    $pass['User']['password'] = $newpassword;



                    if ($this->User->save()) {



                        //$this->Session->setFlash('Password changed', 'flash_success');



                        $this->Flash->set('Password changed successfully');



                    }



                }                  



            }



            //exit;



                //$this->User->updateAll(array('User.balance' =>'User.balance + 1'), array('User.id' => $id));



        }     



        



        



        



//        if($this->request->is(array('post', 'put'))){



//            echo "<pre>"; print_r($this->request->data); echo "</pre>";



//             exit;



//           // print_r($this->request->data);exit;



//            $image = $this->request->data['User']['image'];



//            $uploadFolder = "profile_pic";



//            //full path to upload folder



//            $uploadPath = WWW_ROOT . '/files/' . $uploadFolder;



//            //check if there wasn't errors uploading file on serwer



//            if ($image['error'] == 0) {



//                //image file name



//                $imageName = $image['name'];



//                //check if file exists in upload folder



//                if (file_exists($uploadPath . DS . $imageName)) {



//                    //create full filename with timestamp



//                    $imageName = date('His') . $imageName;



//                }



//                //create full path with image



//                $full_image_path = $uploadPath . DS . $imageName;



//                move_uploaded_file($image['tmp_name'], $full_image_path);



//                $img =  $imageName;



//                



//                //$this->User->updateAll($this->request->data);



//                $this->User->updateAll(array('User.image' => "'$img'"), array('User.id' => $uid));



//                return $this->redirect(array('action' => 'myaccount'));



//                exit;



//            }



//        }



       



        if ($uid){



            $data = $this->User->find('first', array('conditions' => array('User.id' => $uid)));



            $this->request->data = $data;



            $this->set('data', $data);



        } else if ($usersid) {



            $data = $this->User->find('first', array('conditions' => array('User.fboo_ids' => $usersid)));



            $this->set('data', $data);



        }







//        @$resultzz = $_REQUEST['result'];



//        //echo 'ssssssssssssssssss';



//        if ($resultzz == 'SUCCESS') {



//            //echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';



//



//            $this->loadModel("Wallet");



//            $status = $this->Wallet->find('all', array('conditions' => array('Wallet.uid' => $uid), 'order' => 'Wallet.id DESC', 'limit' => 1));



//            //print_r($status);



//            $newwalletmoney = $status[0]['Wallet']['amount'];



//            $walletmoneyid = $status[0]['Wallet']['id'];



//



//            $userstatus = $this->User->find('all', array('conditions' => array('User.id' => $uid)));



//            //print_r($userstatus);



//            //echo '<br/>';



//            $oldwalletmoney = $userstatus[0]['User']['loyalty_points'];



//            @$totalwalletmoney = $newwalletmoney + $oldwalletmoney;



//            $this->User->updateAll(array('User.loyalty_points' => $totalwalletmoney), array('User.id' => $uid));



//            $this->Wallet->updateAll(array('Wallet.status' => 1), array('Wallet.uid' => $uid, 'Wallet.id' => $walletmoneyid));



//



/*         echo "<script>window.location='http://rupak.crystalbiltech.com/shop/users/myaccount'</script>";



             $val = $this->request->data['User']['money'];



              $this->request->data['User']['loyalty_points'] = $val;



              $save = $this->User->save($this->request->data); */



        //}



    }







///////////////////////////////////////////////////////////////////////







	public function viewdtime($id=null){



		configure::write("debug",2);



		/*$finish = strtotime(date("20:15:00"));



		$k =-15;



		for($i=1; $i<=96;$i++){



		$k+=15;



		$selectedTime = date("09:15:00");



		$endTime = strtotime("+".$k." minutes", strtotime($selectedTime));



		if($finish<$endTime){



		break;



		}



		echo date('h:i a', $endTime)."<br>";



		}*/



	}







/////////////////////////////////////











    public function edit() {



        configure::write('debug', 2);  



        $id = $this->Auth->user('id');



        $this->User->id = $this->Auth->user('id');



        if (!$this->User->exists($id)) {



            return $this->redirect(array('action' => 'myaccount'));



        }



        if ($this->request->is('post') || $this->request->is('put')) {



            //echo "<pre>"; print_r($this->request->data); echo "</pre>";exit;



            $role = $this->request->data['User']['role'];
			
			
			$zipcode = $this->request->data['User']["zip"];
			$zipcode = str_replace(' ', '+', $zipcode);
			$url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBQrWZPh0mrrL54_UKhBI2_y8cnegeex1o&address=".$zipcode."&sensor=true";
			$details=file_get_contents($url);
			$result = json_decode($details,true);
			$lat=$result['results'][0]['geometry']['location']['lat'];
			$long=$result['results'][0]['geometry']['location']['lng'];				
			
			$this->request->data['User']['latitude'] = $lat;
			$this->request->data['User']['longitude'] = $long;


            if($role=="freelancer"){



                

			if(isset($this->request->data['monday_timing'])){
                $this->request->data['User']['monday_timing_from']=$this->request->data['User']['monday_hour_from'].":".$this->request->data['User']['monday_minute_from']." ".$this->request->data['User']['monday_ampm_from'];
			}else{
				$this->request->data['User']['monday_timing_from'] = null;
			}	


			if(isset($this->request->data['monday_timing'])){
                $this->request->data['User']['monday_timing_to']=$this->request->data['User']['monday_hour_to'].":".$this->request->data['User']['monday_minute_to']." ".$this->request->data['User']['monday_ampm_to'];
			}else{
				$this->request->data['User']['monday_timing_to'] = null;
			}	


                


			if(isset($this->request->data['tuesday_timing'])){
                $this->request->data['User']['tuesday_timing_from']=$this->request->data['User']['tuesday_hour_from'].":".$this->request->data['User']['tuesday_minute_from']." ".$this->request->data['User']['tuesday_ampm_from'];
			}else{
				$this->request->data['User']['tuesday_timing_from'] = null;
			}	

			if(isset($this->request->data['tuesday_timing'])){
                $this->request->data['User']['tuesday_timing_to']=$this->request->data['User']['tuesday_hour_to'].":".$this->request->data['User']['tuesday_minute_to']." ".$this->request->data['User']['tuesday_ampm_to'];
			}else{
				$this->request->data['User']['tuesday_timing_to'] = null;
			}	


			if(isset($this->request->data['wednesday_timing'])){
                $this->request->data['User']['wednesday_timing_from']=$this->request->data['User']['wednesday_hour_from'].":".$this->request->data['User']['wednesday_minute_from']." ".$this->request->data['User']['wednesday_ampm_from'];
			}else{
				$this->request->data['User']['wednesday_timing_from'] = null;
			}	
			
			
			if(isset($this->request->data['wednesday_timing'])){
                $this->request->data['User']['wednesday_timing_to']=$this->request->data['User']['wednesday_hour_to'].":".$this->request->data['User']['wednesday_minute_to']." ".$this->request->data['User']['wednesday_ampm_to'];
			}else{
				$this->request->data['User']['wednesday_timing_to'] = null;
			}	


                


			if(isset($this->request->data['thursday_timing'])){
                $this->request->data['User']['thursday_timing_from']=$this->request->data['User']['thursday_hour_from'].":".$this->request->data['User']['thursday_minute_from']." ".$this->request->data['User']['thursday_ampm_from'];
                $this->request->data['User']['thursday_timing_to']=$this->request->data['User']['thursday_hour_to'].":".$this->request->data['User']['thursday_minute_to']." ".$this->request->data['User']['thursday_ampm_to'];
			}else{
				$this->request->data['User']['thursday_timing_from'] = null;
				$this->request->data['User']['thursday_timing_to'] = null;
			}	




                


			if(isset($this->request->data['friday_timing'])){
                $this->request->data['User']['friday_timing_from']=$this->request->data['User']['friday_hour_from'].":".$this->request->data['User']['friday_minute_from']." ".$this->request->data['User']['friday_ampm_from'];

                $this->request->data['User']['friday_timing_to']=$this->request->data['User']['friday_hour_to'].":".$this->request->data['User']['friday_minute_to']." ".$this->request->data['User']['friday_ampm_to'];
			}else{
				$this->request->data['User']['friday_timing_from'] = null;
				$this->request->data['User']['friday_timing_to'] = null;
			}			

                

			if(isset($this->request->data['saturday_timing'])){
                $this->request->data['User']['saturday_timing_from']=$this->request->data['User']['saturday_hour_from'].":".$this->request->data['User']['saturday_minute_from']." ".$this->request->data['User']['saturday_ampm_from'];
                $this->request->data['User']['saturday_timing_to']=$this->request->data['User']['saturday_hour_to'].":".$this->request->data['User']['saturday_minute_to']." ".$this->request->data['User']['saturday_ampm_to'];
			}else{
				$this->request->data['User']['saturday_timing_from'] = null;
				$this->request->data['User']['saturday_timing_to'] = null;
			}	


                


			if(isset($this->request->data['sunday_timing'])){
                $this->request->data['User']['sunday_timing_from']=$this->request->data['User']['sunday_hour_from'].":".$this->request->data['User']['sunday_minute_from']." ".$this->request->data['User']['sunday_ampm_from'];

                $this->request->data['User']['sunday_timing_to']=$this->request->data['User']['sunday_hour_to'].":".$this->request->data['User']['sunday_minute_to']." ".$this->request->data['User']['sunday_ampm_to'];
			}else{
				$this->request->data['User']['sunday_timing_from'] = null;
				$this->request->data['User']['sunday_timing_to'] = null;
			}	


                



                



                /*** Profile-img ***/



                if($this->request->data['User']['profileimg']['name'] != ''){



                    $image = $this->request->data['User']['profileimg'];



                    $imageName = $image['name'];



                    $imageName = date('His') . $imageName;



                    $uploadPath = WWW_ROOT . '/images/spa/users/'.$imageName;



                    $this->request->data['User']['image'] = $imageName;



                    move_uploaded_file($image['tmp_name'], $uploadPath);



                }



                /*** Profile-img (END) ***/



                



                /*** Banner ***/



                if($this->request->data['User']['banner']['name'] != ''){



                    $image = $this->request->data['User']['banner'];



                    $imageName = $image['name'];



                    $imageName = date('His') . $imageName;



                    $uploadPath = WWW_ROOT . '/images/spa/banner/'.$imageName;



                    $this->request->data['User']['banner_img'] = $imageName;



                    move_uploaded_file($image['tmp_name'], $uploadPath);



                }



                /*** Banner (END) ***/



                



                /*** Icon ***/



                if($this->request->data['User']['icon']['name'] != ''){



                    $image = $this->request->data['User']['icon'];



                    $imageName = $image['name'];



                    $imageName = date('His') . $imageName;



                    $uploadPath = WWW_ROOT . '/images/spa/icon/'.$imageName;



                    $this->request->data['User']['icon_img'] = $imageName;



                    move_uploaded_file($image['tmp_name'], $uploadPath);



                }



                /*** Icon (END) ***/



                



                /*** Gallery ***/



                if($this->request->data['User']['gallery'][0]['name'] != ''){



                    



                    $actual_image = array();



                    



                    foreach($this->request->data['User']['gallery'] as $gallery){



                    



                        $image = $gallery;



                        $imageName = $image['name'];



                        $imageName = date('His') . $imageName;



                        $uploadPath = WWW_ROOT . '/images/spa/gallery/'.$imageName;



                        



                        $actual_image[] = $imageName;



                        



                        move_uploaded_file($image['tmp_name'], $uploadPath);



                        



                    }    



                    



                    $actual_image = implode(',', $actual_image);



                    



                    $this->request->data['User']['gallery_img'] = $actual_image;



                }



                /*** Gallery (END) ***/



                



            if ($this->User->save($this->request->data)) {



                $this->Session->setFlash('Your profile has been updated.', 'default', array('class' => 'success-message'), 'success');



                return $this->redirect(array('action' => 'edit'));



            } else {



                $this->Session->setFlash('Error in profile updation.', 'default', array('class' => 'error-message'), 'error');



            }



        } elseif($role=="customer"){



            $this->request->data['User']['name'] = ucwords($this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name']);



            //echo "<pre>"; print_r($this->request->data); echo "</pre>";exit;



            



            /*** Profile-img ***/



            if($this->request->data['User']['profileimg']['name'] != ''){



                $image = $this->request->data['User']['profileimg'];



                $imageName = $image['name'];



                $imageName = date('His') . $imageName;



                $uploadPath = WWW_ROOT . '/images/spa/users/'.$imageName;



                $this->request->data['User']['image'] = $imageName;



                move_uploaded_file($image['tmp_name'], $uploadPath);



            }



            /*** Profile-img (END) ***/



            



            if ($this->User->save($this->request->data)) {



                $this->Session->setFlash('Your profile has been updated.', 'default', array('class' => 'success-message'), 'success');



                return $this->redirect(array('action' => 'edit'));



            } else {



                $this->Session->setFlash('Error in profile updation.', 'default', array('class' => 'error-message'), 'error');



            } }



            



        } else {



            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));



            $data = $this->request->data = $this->User->find('first', $options);



            $this->set('data', $data);



        }



    }



	//////////////////////////
	
	
	public function view(){
	
		if(!$this->Auth->user('id')){
			$this->redirect('/');
		}
	
		$id = $this->Auth->user('id');
		
		$user = $this->User->findById($id);
		
		$this->set('user', $user);
		
	}
	



    ////////////////////////////











    public function api_saveimage() {















        configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);







        $one = $redata->User->img;



        $img = base64_decode($one);



        $im = imagecreatefromstring($img);







        if ($im !== false) {







            $image = "1" . time() . ".png";



            imagepng($im, WWW_ROOT . "files" . DS . "profile_pic" . DS . $image);



            imagedestroy($im);



            $response['msg'] = "image is uploaded";



        } else {



            $response['isSucess'] = 'true';



            $response['msg'] = 'Image did not create';



        }











        $this->User->recursive = 2;



        $this->layout = "ajax";



        if (!empty($redata)) {



            $img = Router::url('/', true) . 'files/profile_pic/' . $image;



            $id = $redata->User->id;



            $name = $redata->User->name;



            $data = $this->User->updateAll(array('User.image' => "'$img'"), array('User.id' => $id));



            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));







            if ($data) {



                $response['user'] = $user;



                //$response['data'] = $data;  



                $response['error'] = 0;



            }



        }



        echo json_encode($response);



        exit;



    }







    //////////////////////////







    public function api_useredit() {







        configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        $this->User->recursive = 2;



        $this->layout = "ajax";



        if (!empty($redata)) {



            $id = $redata->user->id;



            $name = $redata->user->name;



            $phone = $redata->user->phone;



            $zip = $redata->user->zip;



            $country = $redata->user->country;



            $state = $redata->user->state;



			$gender = $redata->user->gender;



            $birth = $redata->user->birth;



            $address = $redata->user->address;



            $city = $redata->user->city;



            $data = $this->User->updateAll(array('User.phone' => "'$phone'", 'User.name' => "'$name'",



                'User.zip' => "'$zip'", 'User.country' => "'$country'",



                'User.state' => "'$state'", 'User.address' => "'$address'", 'User.city' => "'$city'", 'User.gender' => "'$gender'", 'User.birth' => "'$birth'"), array('User.id' => $id));



            if ($data) {



				 $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));



				



                $response['msg'] = 'update successful';



                $response['data'] = $user;



                $response['uid'] = $id;



                $response['error'] = 0;



            }



        }



        echo json_encode($response);



        exit;



    }







    public function logout() {



       // $this->Session->setFlash('Good-Bye', 'flash_success');



        $_SESSION['KCEDITOR']['disabled'] = true;



        unset($_SESSION['KCEDITOR']);



        $this->Session->delete('Shop');



        return $this->redirect($this->Auth->logout());



    }







   public function admin_logout() {



        //$this->Session->setFlash('Good-Bye', 'flash_success');



        $_SESSION['KCEDITOR']['disabled'] = true;



        unset($_SESSION['KCEDITOR']);



        



        return $this->redirect($this->Auth->logout());



    }







    







   /*public function add() {







        Configure::write("debug", 0);



        if ($this->request->is('post')) {







            $this->request->data['User']['email'] = $this->request->data['User']['email'];







            $this->request->data['User']['username'] = $this->request->data['User']['email'];







            // $this->request->data['User']['active'] = 1;







            



            $this->request->data['User']['role'] = 'customer';  



			



            if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



                $this->Flash->set('Email already exist!!!');



               // echo "<script>alert('Email already exist!!!')</script>";



                //echo "<script>window.location.assign('http://rupak.crystalbiltech.com/shop/')</script>";



                return $this->redirect('http://' . $this->request->data['server']);  



            }



            



            $this->User->create();



            $fu = $this->request->data;











            if ($this->User->save($this->request->data)) {







              



              



                 $this->Flash->set('Register has been successfully done check email for account activation!');



                    $this->__sendActivationEmail($this->User->getLastInsertID());



                    print_r($this->request->data['server']);



                    exit;   



                   return $this->redirect('http://' . $this->request->data['server']); 



            



            } else {  



                $this->Flash->set('The user could not be saved. Please, try again.');



                return $this->redirect('http://' . $this->request->data['server']); 



               



            }



        }



    }*/







    



    



    



    public function add() {



        



        Configure::write("debug", 0);



        



        if ($this->request->is('post')) {



            //echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;



            $this->request->data['User']['email'] = $this->request->data['User']['email'];







            $this->request->data['User']['username'] = $this->request->data['User']['email'];







            // $this->request->data['User']['active'] = 1;   



            



            $this->request->data['User']['role'] = $this->request->data['User']['role'];



            



            $role = $this->request->data['User']['role'];



            



            if($role == 'customer'){



                $this->request->data['User']['active'] = 1;



            }



            



            $this->request->data['User']['name'] = ucwords($this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name']);



            



            



            if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



               // $this->Session->setFlash(__('Email already exist!!!', 'flash_success'));



               $this->Flash->set('Email already exist!!!');



                /*echo "<script>window.location.assign('http://rupak.crystalbiltech.com/shop/')</script>";*/



             return $this->redirect('http://' . $this->request->data['server']); 



            }



            if($this->request->data['User']['password'] == $this->request->data['User']['confirmpassword']){



                $this->User->create();



                $fu = $this->request->data;



                $save = $this->User->save($this->request->data);



            }else{



                $this->Flash->set('Password do not match!!!');



                return $this->redirect(array('controller' => 'users', 'action' => 'add'));



            }



            if ($save) {



                $to = $this->request->data['User']['email'];



                $subject = "Welcome To register to our store";



                $txt = "Thanks for registration with us";



                $headers = "From: gurpreet@avainfotech.com";







                $mymail = mail($to, $subject, $txt, $headers);



                if ($mymail) {



                    



                    



                    if($role == 'customer'){



                        $this->request->data['User']['active'] == 1;



                        $this->Flash->set("You have successfully registered");



                    }elseif($role == 'freelancer'){



                        $this->Flash->set("You have successfully registered ,But you can login after admin's approval");



                    }



                    



                    



                  



                    //$this->__sendActivationEmail($this->User->getLastInsertID());



                    return $this->redirect('http://' . $this->request->data['server']); 



                     



                }



            } else {



                //$this->Session->setFlash('The user could not be saved. Please, try again.'); 



                  $this->Flash->set('The user could not be saved. Please, try again.');



              



                 return $this->redirect('http://' . $this->request->data['server']); 



            }



        }



    }



////////////////////////////////////////////////////////////



    /* function to send activation email */



    public function __sendActivationEmail($user_id) {



        //echo $user_id;echo "fgfgfgfdgfdgfdgdf</br>";



        //$user = $this->User->find(array('User.id' => $user_id), array('User.email', 'User.username','User.id'));



        $user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));



        //echo '<pre>';print_r($user);die();



        $usr = $user[0]['User']['email'];



        //print_r($usr);die();



        $urlm = 'http://netin.crystalbiltech.com/winegarden/users/activate/' . $user_id . '/' . $this->User->getActivationHash();







        $this->set('username', $this->data['User']['username']);



        //$user['User']['email'];



        //print_r($abcd123);die();



        App::uses('CakeEmail', 'Network/Email');



        $email = new CakeEmail();







        $email->from($usr)



//->cc(Configure::read('Settings.ADMIN_EMAIL'))



//->cc('ajay@futureworktechnologies.com')



                ->to($usr)



                ->subject('User Activation')



                ->template('activation')



                ->emailFormat('both')



                ->viewVars(array('ds' => $urlm))



                ->send();



      //  return $this->redirect(array('controller' => 'shop', 'action' => 'index'));



    }







    public function activate($user_id = null, $in_hash = null) {







        $this->User->id = $user_id;



        //echo $this->User->id;die();



        /* $this->Event->id = $id;



          $this->Event->saveField('is_featured', true); */







        if ($this->User->exists() && ($in_hash == $this->User->getActivationHash())) {



            if (empty($this->data)) {







                $this->data = $this->User->read(null, $user_id);



                // Update the active flag in the database



                $this->User->set('active', 1);



                $this->User->saveField('active', true);







                $this->Session->setFlash('Your account has been activated, please log in below.', 'flash_success');



                return $this->redirect(array('controller' => 'shop', 'action' => 'index'));



            }



        }



exit;



        // Activation failed, render '/views/user/activate.ctp' which should tell the user.



    }







    ////////////////////////////////////







    public function customer_dashboard() {



        



    }







////////////////////////////////////////////////////////////







    public function admin_dashboard() {



        



    }

	

	

	public function admin_login(){

		  Configure::write("debug", 0);

		  $this->layout = "admin";

		  if ($this->request->is('post')) { 

			if ($this->Auth->login()) {

				$this->User->id = $this->Auth->user('id');

				if ($this->Auth->user('role') == 'admin') {

	//echo 'here';

				 return $this->redirect( '/admin/dashboards/dashboard' );

				} else {

					$this->Auth->logout();

					$this->Session->setFlash('Login is incorrect', 'default', array('class' => 'alert alert-danger'), 'admin_only_login');

				}

			} else {

				$this->Session->setFlash('Login is incorrect', 'default', array('class' => 'alert alert-danger'), 'admin_only_login');

			}  

		  }

  

 }

	







////////////////////////////////////////////////////////////







    public function admin_index($id = null) {



        



        Configure::write('debug', 2);



        



        if($id){



            $this->User->updateAll(array('User.active' => 1), array('User.id' => $id));



            



            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));



            



            $ms = '';



            if($user){



                if($user['User']['active'] == 1){



                    $ms = 'Your application has been approved. Please login';



                }else{



                    $ms = 'Your application has been disapproved.';



                }



            }



            



            $Email = new CakeEmail();



			$Email->emailFormat('html')->template('resetpass');



            $Email->from(array('info@rakesh.crystalbiltech.com' => 'Spa'));



            $Email->to($user['User']['email']);



            $Email->subject('Approval');



			$Email->viewVars(array('user' => $user));



			$Email->viewVars(array('link' => $this->webroot));



            $Email->send($ms);



            



        }



        



        



        



        



        



        configure::write('debug',0);



            if(isset($this->request->data)){



                $keyword = $this->request->data['User']['search'];



            }else{



                $keyword='';



            }



            



            $this->Paginator = $this->Components->load('Paginator');



            $this->Paginator->settings = array(



                'User' => array(



                    'recursive' => -1,



                    'contain' => array(



                    ),



                    'conditions' => array(



                        'OR'=>array('User.username LIKE' => '%' . $keyword . '%','User.email LIKE' => '%' . $keyword . '%','User.role LIKE' => '%' . $keyword . '%')



                    ),



                    'order' => array(



                        'User.id' => 'DESC'



                    ),



                    'limit' => 10,



                    'paramType' => 'querystring',



                )



            );



            //$users = $this->Paginator->paginate();



            



        



        $users = $this->Paginator->paginate();



        $this->set(compact('users'));

		

		$this->set('keyword', $keyword);



    }







////////////////////////////////////////////////////////////







    public function admin_view($id = null) {



	Configure::write('debug', 0);



        $this->User->id = $id;



        if (!$this->User->exists()) {



            throw new NotFoundException('Invalid user');



        }



        $this->set('user', $this->User->read(null, $id));







    }







////////////////////////////////////////////////////////////







    public function admin_add() {



        if ($this->request->is('post')) {



            $this->request->data['User']['email'] = $this->request->data['User']['username'];



            



            $this->User->create();



            if ($this->User->save($this->request->data)) {



                $this->Session->setFlash('The user has been saved', 'flash_success');



                return $this->redirect(array('action' => 'index'));



            } else {



                $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_success');



            }



        }



    }



    



////////////////////////////////////////////////////////////



    



    public function admin_approve() {



        if ($this->request->is('post')) {



            $this->request->data['User']['email'] = $this->request->data['User']['username'];



            



            $this->User->create();



            if ($this->User->save($this->request->data)) {



                $this->Session->setFlash('The user has been saved', 'flash_success');



                return $this->redirect(array('action' => 'index'));



            } else {



                $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_success');



            }



        }



    }







//////////////////Save User by Admin///////////////////////////////







public function admin_edit($id = null) {



        configure::write('debug', 2);  



        $id = $id;



        $this->User->id = $id;



        if (!$this->User->exists($id)) {



            return $this->redirect(array('action' => 'myaccount'));



        }



        if ($this->request->is('post') || $this->request->is('put')) {



           //echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;



            $role = $this->request->data['User']['role'];



            if($role=="freelancer"){



                



                $this->request->data['User']['monday_timing_from']=$this->request->data['User']['monday_hour_from'].":".$this->request->data['User']['monday_minute_from']." ".$this->request->data['User']['monday_ampm_from'];



                $this->request->data['User']['monday_timing_to']=$this->request->data['User']['monday_hour_to'].":".$this->request->data['User']['monday_minute_to']." ".$this->request->data['User']['monday_ampm_to'];



                



                $this->request->data['User']['tuesday_timing_from']=$this->request->data['User']['tuesday_hour_from'].":".$this->request->data['User']['tuesday_minute_from']." ".$this->request->data['User']['tuesday_ampm_from'];



                $this->request->data['User']['tuesday_timing_to']=$this->request->data['User']['tuesday_hour_to'].":".$this->request->data['User']['tuesday_minute_to']." ".$this->request->data['User']['tuesday_ampm_to'];



                



                $this->request->data['User']['wednesday_timing_from']=$this->request->data['User']['wednesday_hour_from'].":".$this->request->data['User']['wednesday_minute_from']." ".$this->request->data['User']['wednesday_ampm_from'];



                $this->request->data['User']['wednesday_timing_to']=$this->request->data['User']['wednesday_hour_to'].":".$this->request->data['User']['wednesday_minute_to']." ".$this->request->data['User']['wednesday_ampm_to'];



                



                $this->request->data['User']['thursday_timing_from']=$this->request->data['User']['thursday_hour_from'].":".$this->request->data['User']['thursday_minute_from']." ".$this->request->data['User']['thursday_ampm_from'];



                $this->request->data['User']['thursday_timing_to']=$this->request->data['User']['thursday_hour_to'].":".$this->request->data['User']['thursday_minute_to']." ".$this->request->data['User']['thursday_ampm_to'];



                



                $this->request->data['User']['friday_timing_from']=$this->request->data['User']['friday_hour_from'].":".$this->request->data['User']['friday_minute_from']." ".$this->request->data['User']['friday_ampm_from'];



                $this->request->data['User']['friday_timing_to']=$this->request->data['User']['friday_hour_to'].":".$this->request->data['User']['friday_minute_to']." ".$this->request->data['User']['friday_ampm_to'];



                



                $this->request->data['User']['saturday_timing_from']=$this->request->data['User']['saturday_hour_from'].":".$this->request->data['User']['saturday_minute_from']." ".$this->request->data['User']['saturday_ampm_from'];



                $this->request->data['User']['saturday_timing_to']=$this->request->data['User']['saturday_hour_to'].":".$this->request->data['User']['saturday_minute_to']." ".$this->request->data['User']['saturday_ampm_to'];



                



                $this->request->data['User']['sunday_timing_from']=$this->request->data['User']['sunday_hour_from'].":".$this->request->data['User']['sunday_minute_from']." ".$this->request->data['User']['sunday_ampm_from'];



                $this->request->data['User']['sunday_timing_to']=$this->request->data['User']['sunday_hour_to'].":".$this->request->data['User']['sunday_minute_to']." ".$this->request->data['User']['sunday_ampm_to'];





				//echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;



                /*** Banner ***/

                if($this->request->data['User']['banner']['name'] != ''){

                    $image = $this->request->data['User']['banner_img'];

                    $imageName = $image['name'];

                    $imageName = date('His') . $imageName;

                    $uploadPath = WWW_ROOT . '/images/spa/banner/'.$imageName;

                    $this->request->data['User']['banner_img'] = $imageName;

                    move_uploaded_file($image['tmp_name'], $uploadPath);

                }

                /*** Banner (END) ***/



                



                /*** Icon ***/

                if($this->request->data['User']['icon']['name'] != ''){

                    $image = $this->request->data['User']['icon_img'];

                    $imageName = $image['name'];

                    $imageName = date('His') . $imageName;

                    $uploadPath = WWW_ROOT . '/images/spa/icon/'.$imageName;

                    $this->request->data['User']['icon_img'] = $imageName;

                    move_uploaded_file($image['tmp_name'], $uploadPath);

                }

                /*** Icon (END) ***/



                 /*** Gallery ***/



                if($this->request->data['User']['gallery'][0]['name'] != ''){

                    $actual_image = array();

                    foreach($this->request->data['User']['gallery'] as $gallery){

                        $image = $gallery;

                        $imageName = $image['name'];

                        $imageName = date('His') . $imageName;

                        $uploadPath = WWW_ROOT . '/images/spa/gallery/'.$imageName;

                        $actual_image[] = $imageName;

                        move_uploaded_file($image['tmp_name'], $uploadPath);

                    }    



                    $actual_image = implode(',', $actual_image);

                    $this->request->data['User']['gallery_img'] = $actual_image;

                }



                /*** Gallery (END) ***/

				

				

				/*** Profile-img ***/

				if($this->request->data['User']['image']['name'] != ''){

					$image = $this->request->data['User']['image'];

					$imageName = $image['name'];

					$imageName = date('His') . $imageName;

					$uploadPath = WWW_ROOT . '/images/spa/users/'.$imageName;

					$this->request->data['User']['image'] = $imageName;

					move_uploaded_file($image['tmp_name'], $uploadPath);

				} else {

					unset($this->request->data['User']['image']);

				}

				/*** Profile-img (END) ***/





                



            if ($this->User->save($this->request->data)) {



             

				$this->Session->setFlash(



                                'The user has been saved',



                                'default',



                                array('class' => 'alert alert-success'),



                                'admin_pass'    



                            );

                return $this->redirect(array('action' => 'index'));



            } else {

							$this->Session->setFlash(



                                'The user could not be saved. Please, try again.',



                                'default',



                                array('class' => 'alert alert-danger'),



                                'admin_pass'    



                            );

                



            }



        } elseif($role=="customer" || $role=="admin"){



            //$this->request->data['User']['name'] = ucwords($this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name']);



            //echo "<pre>"; print_r($this->request->data); echo "</pre>";exit;



            



            /*** Profile-img ***/



            if($this->request->data['User']['image']['name'] != ''){



                $image = $this->request->data['User']['image'];



                $imageName = $image['name'];



                $imageName = date('His') . $imageName;



                $uploadPath = WWW_ROOT . '/images/spa/users/'.$imageName;



                $this->request->data['User']['image'] = $imageName;



                move_uploaded_file($image['tmp_name'], $uploadPath);



            } else {



                unset($this->request->data['User']['image']);



            }







            /*** Profile-img (END) ***/



            



            if ($this->User->save($this->request->data)) {





							$this->Session->setFlash(



                                'The user has been saved',



                                'default',



                                array('class' => 'alert alert-success'),



                                'admin_pass'    



                            );

                return $this->redirect(array('action' => 'index'));



            } else {

				

				$this->Session->setFlash(



					'The user could not be saved. Please, try again.',



					'default',



					array('class' => 'alert alert-danger'),



					'admin_pass'    



				);

				



            } }



            



        } else {



             $this->request->data = $this->User->read(null, $id);



             $user = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));



             $this->set('user',$user);



        }



    }







////////////////////////////////////////////////////////////





	public function admin_stores(){

	

		if(isset($this->request->data['User']['search']) && isset($this->request->data['User']['type'])){

			$type = $this->request->data['User']['type'];

			$keyword = $this->request->data['User']['search'];

			

			$conditions = array('User.'.$type.' LIKE' => '%'.$keyword.'%');

			

		}else{

			$type = '';

			$keyword = '';

			$conditions = array();

		}

	

		$this->Paginator = $this->Components->load('Paginator');

            $this->Paginator->settings = array(

                'User' => array(

                    'recursive' => -1,

                    'contain' => array(

                    ),

                   // 'conditions' => array('User.role' => 'freelancer', 'OR'=>array('User.username LIKE' => '%' . $keyword . '%','User.email LIKE' => '%' . $keyword . '%','User.role LIKE' => '%' . $keyword . '%')

                    'conditions' => $conditions,

                    'order' => array(

                        'User.id' => 'DESC'

                    ),

                    'limit' => 10,

                    'paramType' => 'querystring',

                )

            );



        $users = $this->Paginator->paginate();



        $this->set(compact('users'));

		$this->set('keyword', $keyword);

	}

	

////////////////////////////////////////////////////////////	





	public function admin_subview($id = null){

	

	Configure::write('debug', 2);

	

		$subscriptions = array();

		

		if($id){

			

			$this->loadModel('Subscription');

			

			$this->Paginator->settings = array(

				'limit'	=>	10,

				'conditions' => array('Subscription.user_id' => $id),

				'order'	=>	array('Subscription.id' => 'DESC')

			);

			

			$subscriptions = $this->Paginator->paginate('Subscription');

			

		}

		

		$this->set('subscriptions', $subscriptions);

		

	}



////////////////////////////////////////////////////////////





	public function admin_subadd(){

	

		Configure::write('debug', 2);

	



		$this->loadModel('Subscription');	

		

		if($this->request->is('post')){

		

			$id = $this->request->data['Subscription']['id'];

		

			$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

			

			//echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;

			

			if($user){

				$subscription = $user['User']['subscription'] + 1;

				

				$subscribe_date = date($this->request->data['Subscription']['subscribe_date']);

				

				

				$subscription_count = $this->Subscription->find('count', array('conditions' => array('Subscription.user_id' => $id)));

				

				

				if($subscription_count == 0){

					$expire_date = date('d-m-Y', strtotime("+2 months", strtotime($subscribe_date)));

				}else{

					$expire_date = date('d-m-Y', strtotime("+1 months", strtotime($subscribe_date)));

				}

				//echo "<pre>"; print_r($expire_date); echo "</pre>";

				

				//echo $expire_date; exit;

				$subscribe_amount = 20;

				

				$expire_datetime = strtotime($expire_date);

				$subscribe_datetime = strtotime($subscribe_date);

				$current_datetime = time();

				

				if($expire_datetime < $current_datetime){

					$subscribed = 'expired';

				}elseif($subscribe_datetime > $current_datetime){

					$subscribed = 'pending';

				}else{

					$subscribed = 'subscribed';

				}

				

				

				$update = array('User.subscription' => $subscription, 'User.subscribe_date' => "'".$subscribe_date."'", 'User.expire_date' => "'".$expire_date."'", 'User.subscribe_amount' => $subscribe_amount, 'User.subscription_status' => '"'. $subscribed .'"');

					

				$this->request->data['Subscription']['user_id'] = $id;

				$this->request->data['Subscription']['expire_date'] = $expire_date;

				

				$this->Subscription->create();

				

				$this->Subscription->save($this->request->data);

									

				$this->User->updateAll($update, array('User.id' => $id));

			}

			

			$this->Session->setFlash(



					'Subscription has been added Successfully',



					'default',



					array('class' => 'alert alert-success'),



					'success'    



				);

			return $this->redirect(array('action' => 'subscriptions'));

		}		

		

		$users = $this->User->find('all', array('conditions' => array('User.active' => 1, 'User.role' => 'freelancer', 'User.subscription_status' => 'expired', 'User.store_name !=' => '')));

		$this->set('users', $users);

			

	}

	

	public function admin_block($id = null){

		if($id){

			$user = $this->User->findById($id);

			

			if($user['User']['active'] == 1){

				$value = 0;

				$success_msg = 'Freelancer Blocked successfully';

			}else{

				$value = 1;

				$success_msg = 'Freelancer Unblocked successfully';

			}

			

			$update = $this->User->updateAll(array('User.active' => $value), array('User.id' => $id));

			

			if($update){

			

				$this->Session->setFlash(



					$success_msg,



					'default',



					array('class' => 'alert alert-success'),



					'stores'    



				);

			

				$this->redirect(array('action' => 'stores'));

			}else{

				$this->Session->setFlash(



					'Error in status updation',



					'default',



					array('class' => 'alert alert-error'),



					'stores'    



				);

			

				$this->redirect(array('action' => 'stores'));

			}		

		}

	}

	

	

	public function admin_recommended($id = null){

		

		Configure::write('debug', 2);

	

		

		if($id){

			$user = $this->User->findById($id);

			

			if($user['User']['recommended'] == 0){

				$update = $this->User->updateAll(array('User.recommended' => 1),array('User.id' => $id));

			}else{

				$update = $this->User->updateAll(array('User.recommended' => 0),array('User.id' => $id));

			}	

				

			if($update){

			

				$this->Session->setFlash(



					'Freelancer recommendations has been updated successfully.',



					'default',



					array('class' => 'alert alert-success'),



					'stores'    



				);

			

				$this->redirect(array('action' => 'stores'));

			}else{

				$this->Session->setFlash(



					'Freelancer recommendations updation has been failed.',



					'default',



					array('class' => 'alert alert-error'),



					'stores'    



				);

			

				$this->redirect(array('action' => 'stores'));

			}			

		}		

	}

	

	

	public function admin_subscriptions(){

	

		Configure::write('debug', 0);

	

		if(isset($this->request->data)){

			$keyword = $this->request->data['User']['search'];

		}else{

			$keyword='';

		}

	

		$this->Paginator = $this->Components->load('Paginator');

            $this->Paginator->settings = array(

                'User' => array(

                    'recursive' => -1,

                    'contain' => array(

                    ),

                    'conditions' => array('User.active' => 1, 'User.role' => 'freelancer', 'User.subscription_status !=' => 'expired', 'OR'=>array('User.username LIKE' => '%' . $keyword . '%','User.email LIKE' => '%' . $keyword . '%','User.role LIKE' => '%' . $keyword . '%')

                    ),

                    'order' => array(

                        'User.id' => 'DESC'

                    ),

                    'limit' => 20,

                    'paramType' => 'querystring',

                )

            );



        $users = $this->Paginator->paginate();



        $this->set(compact('users'));

		$this->set('keyword', $keyword);

	}



	public function admin_subedit($id=null){

		

		$this->loadModel('Subscription');

		

		if($this->request->is('post')){

			

			$this->Subscription->id = $this->request->data['Subscription']['id'];

			

			if($this->Subscription->save($this->request->data)){

			

				$start_date = $this->request->data['Subscription']['subscribe_date'];

				$expire_date = $this->request->data['Subscription']['expire_date'];

				$amount = $this->request->data['Subscription']['subscribe_amount'];

				

				$expire_datetime = strtotime($expire_date);

				$subscribe_datetime = strtotime($start_date);

				$current_datetime = time();

				

				if($expire_datetime < $current_datetime){

					$subscribed = 'expired';

				}elseif($subscribe_datetime > $current_datetime){

					$subscribed = 'pending';

				}else{

					$subscribed = 'subscribed';

				}

				

			

				$this->User->updateAll(array('User.subscribe_date' => '"'.$start_date.'"', 'User.expire_date' => '"'.$expire_date.'"', 'User.subscribe_amount' => '"'.$amount.'"', 'User.subscription_status' => '"'.$subscribed.'"' ), array('User.id' => $id));

			

				$this->Session->setFlash('Subscription has been updated.', 'default', array('class' => 'success-message'), 'success');



                return $this->redirect(array('action' => 'subscriptions'));

				

			}

			

		}else{

			$subscriptions = $this->Subscription->find('first', array('order' => array('Subscription.id DESC'), 'conditions' => array('Subscription.user_id' => $id)));

		

		$this->set('data', $subscriptions);

		}

	}

	

	public function admin_dateAfterMonth(){

	

		$this->loadModel('Subscription');

	

		if($this->request->is('post')){

		

			$subscribe_date = date($this->request->data['date']);

						

			$subscription_count = $this->Subscription->find('count', array('conditions' => array('Subscription.user_id' => $this->request->data['user_id'])));

			

			

			$user = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['user_id'])));

			



			if($subscription_count == 0 || $user['User']['subscription'] == 1){

				$expire_date = date('d-m-Y', strtotime("+2 months", strtotime($subscribe_date)));

			}else{

				$expire_date = date('d-m-Y', strtotime("+1 months", strtotime($subscribe_date)));

			}

			

			echo $expire_date;

			exit;

		}

	}



    // public function admin_edit($id = null) {



    //     $this->User->id = $id;



    //     if (!$this->User->exists()) {



    //         throw new NotFoundException('Invalid user');



    //     }



    //     if ($this->request->is('post') || $this->request->is('put')) {



            



    //        // print_r($this->request->data);



    //         $user = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));







    //          $image = $this->request->data['User']['image'];



    //         $uploadFolder = "profile_pic";



    //         //full path to upload folder



    //         $uploadPath = WWW_ROOT . '/files/' . $uploadFolder;



    //         //check if there wasn't errors uploading file on serwer



    //         if ($image['error'] == 0) {



    //             //image file name



    //             $imageName = $image['name'];



    //             //check if file exists in upload folder



    //             if(file_exists($uploadPath . DS . $imageName)) {



    //                 //create full filename with timestamp



    //                 $imageName = date('His') . $imageName;



    //             }



    //             //create full path with image



    //             $full_image_path = $uploadPath . DS . $imageName;



    //             $this->request->data['User']['image'] = $imageName;



    //             move_uploaded_file($image['tmp_name'], $full_image_path);



    //             $this->User->id = $id;



    //         } else {







    //             $admin_edit = $this->User->find('first', array('conditions' => array('User.id' => $id)));



    //            // print_r($admin_edit);die;



    //             if($admin_edit['User']['image']){



    //                 $this->request->data['User']['image'] = $admin_edit['User']['image'];



    //             }else{



    //                 $this->request->data['User']['image'] = "";



    //             }



    //             //$this->request->data['User']['image'] = !empty($admin_edit['User']['image']) ? $admin_edit['User']['image'] : ' ';



    //         }



            



    //         if ($this->User->save($this->request->data)) {



    //             $this->Session->setFlash('The user has been saved', 'flash_success');



    //             return $this->redirect(array('action' => 'index'));



    //         } else {



    //             $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_success');



    //         }



    //     } else {



    //         $this->request->data = $this->User->read(null, $id);



    //         $user = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));



    //         $this->set('user',$user);



    //         //print_r($user);



    //     }



    // }







////////////////////////////////////////////////////////////







    public function admin_password($id = null) {



        $this->User->id = $id;



        if (!$this->User->exists()) {



            throw new NotFoundException('Invalid user');



        }



        if ($this->request->is('post') || $this->request->is('put')) {



            if ($this->User->save($this->request->data)) {



                $this->Session->setFlash(



                    'Password changed Successfully.',



                    'default',



                    array('class' => 'alert alert-success'),



                    'admin_pass'    



                );



                $this->redirect(array('action' => 'index'));



            } else {

				

				$this->Session->setFlash(



                    'The user could not be saved. Please, try again.',



                    'default',



                    array('class' => 'alert alert-danger'),



                    'admin_pass'    



                );



            }



        } else {



            $this->request->data = $this->User->read(null, $id);



        }



    }







////////////////////////////////////////////////////////////







    public function admin_delete($id = null) {



        if (!$this->request->is('post')) {



            throw new MethodNotAllowedException();



        }



        $this->User->id = $id;



        if (!$this->User->exists()) {



            throw new NotFoundException('Invalid user');



        }



        if ($this->User->delete()) {



            $this->Session->setFlash(



				'User deleted successfully.',



				'default',



				array('class' => 'alert alert-success'),



				'user_delete'    



			);



            return $this->redirect(array('action' => 'index'));



        }



        $this->Session->setFlash(



			'Error in deletion',



			'default',



			array('class' => 'alert alert-danger'),



			'user_delete'    



		);



        return $this->redirect(array('action' => 'index'));



    }

	

	

	public function admin_userblock($id = null) {



        if (!$this->request->is('post')) {



            throw new MethodNotAllowedException();



        }



        $this->User->id = $id;



        if (!$this->User->exists()) {



            throw new NotFoundException('Invalid user');



        }



		$user = $this->User->findById($id);



		if($user['User']['active'] == '0'){

			$active = 1;

			$msg = 'User unblocked successfully.';

		}else{

			$active = 0;

			$msg = 'User blocked successfully.';

		}



		$update = $this->User->updateAll(array('User.active' => $active), array('User.id' => $id));

		



        if ($update) {



            $this->Session->setFlash(



				$msg,



				'default',



				array('class' => 'alert alert-success'),



				'user_delete'    



			);



            return $this->redirect(array('action' => 'index'));



        }



        $this->Session->setFlash(



			'Error in block/unblock',



			'default',



			array('class' => 'alert alert-danger'),



			'user_delete'    



		);



        return $this->redirect(array('action' => 'index'));



    }







    /*  public function api_registration() {







      $this->layout = 'ajax';



      $postdata = file_get_contents("php://input");



      $redata = json_decode($postdata);



      ob_start();



      print_r($redata);



      $c = ob_get_clean();



      $fc = fopen('files' . DS . 'detail.txt', 'w');



      fwrite($fc, $c);



      fclose($fc);



      //  exit;







      $this->request->data['User']['name'] = $redata->first_name . " " . $redata->last_name;



      $this->request->data['User']['username'] = $redata->email ;



      $this->request->data['User']['email'] = $redata->email;



      $this->request->data['User']['password'] = $redata->password;



      $this->request->data['User']['phone'] = $redata->phone;



      // $this->request->data['User']['active'] = 1;



      $this->request->data['User']['role'] = 'customer';











      if ($this->request->is('post')) {







      if ($this->User->hasAny(array('User.email' => $this->request->data['User']['email']))) {







      $response['msg'] = 'Email_id already exist';



      } elseif ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {







      $response['msg'] = 'username already exist';



      } else {



      $this->User->create();



      $save=$this->User->save($this->request->data);



      if($save){



      $response['status'] = true;



      $response['msg'] = 'Registration has been successful';



      // $this->__sendActivationEmail($this->User->getLastInsertID());



      }else {



      $response['status'] = true;



      $response['msg'] = '';



      }



      }



      } else {







      $response['msg'] = 'Sorry please try again';



      }



      echo json_encode($response);



      exit;



      } */







    public function api_registration() {



		configure::write('debug', 0);



        $this->layout = 'ajax';



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'ipn.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



     



        $this->request->data['User']['name'] = $redata->first_name . " " . $redata->last_name;



        $this->request->data['User']['username'] = $redata->email;



        $this->request->data['User']['email'] = $redata->email;



        $this->request->data['User']['password'] = $redata->password;



        $this->request->data['User']['phone'] = $redata->phone;



		



		$this->request->data['User']['gender'] = $redata->gender;



        $this->request->data['User']['birth'] = $redata->birth;



		



        $this->request->data['User']['active'] = 0;



        $this->request->data['User']['role'] = 'customer';



        $verification_code = rand(11111, 99999);



        $this->request->data['User']['verification_code'] = $verification_code;







        if ($this->request->is('post')) {







            if ($this->User->hasAny(array('User.username' => $this->request->data['User']['username']))) {



			 $user = $this->User->find('first', array('conditions' => array('User.username' => $redata->email)));



			if($user['User']['active']== 0){



				



			 $response['msg'] = 'Email_id already exist please verify your account for active';



			 $response['user_id'] = $user['User']['id'];



             $response['email'] = $user['User']['email'];	



			}else{



			$response['msg'] = 'Email_id already exist';	



			}		



				



            } else {



                $this->User->create();



                $savedata = $this->User->save($this->request->data);



                if ($savedata) {







                    $ms = "Welcome to Shop 



                             <b>Verfication Code is: " . $verification_code . " "



                            . "</b><br/>";



                    $l = new CakeEmail('smtp');



                    $l->emailFormat('html')->template('default', 'default')->subject('Registration Successful!!!')->



                            to($this->request->data['User']['email'])->send($ms);







                    $response['isSuccess'] = true;



                    $response['msg'] = 'Verification code has been sent on Email. Please use that to activate your account';



                    $response['user_id'] = $this->User->getLastInsertID();



                    $response['email'] = $this->request->data['User']['email'];











                    $response['status'] = true;



                    //print_r($this->request->data);



                    $response['msg'] = 'Registration successful please check your email for account verification';











                    $response['status'] = true;



                    //print_r($this->request->data);



                    $response['msg'] = 'Registration has been successful';



                }



            }



        } else {







            $response['msg'] = 'Sorry please try again';



        }



        echo json_encode($response);



        exit;



    }







    //////////////////////////////////











    public function api_verifyEmail() {



       configure::write('debug', 0);



        $this->layout = 'ajax';



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        //  exit;











        if ($this->request->is('post')) {



            $exist = $this->User->find("first", array('conditions' => array(



                    "AND" => array(



                        'User.id' => $redata->user_id,



                        'User.verification_code' => $redata->verification_code,



                        'User.active' => 0



                    )



            )));



            if ($exist) {



                $img = Router::url('/', true) . 'images/default-user.png';



                $updated = $this->User->updateAll(array('User.active' => 1, 'User.verification_code' => NULL,



                    'User.image' => "'$img'"



                        ), array('User.id' => $redata->user_id,



                    'User.verification_code' => $redata->verification_code, 'User.active' => 0)



                );



                if ($updated) {



                    $user = $this->User->find('all', array('conditions' => array('User.id' => $redata->user_id)));











                    $response['isSuccess'] = true;



                    $response['msg'] = "Verified Successfully";







                    $response['data'] = $user;



                } else {



                    $response['isSuccess'] = false;



                    $response['msg'] = "Please verify account with valid verification code. Unable to verify";



                }



            } else {



                $response['isSuccess'] = false;



                $response['msg'] = "Please verify account with valid verification code.";



            }



        } else {



            $response['isSuccess'] = false;



            $response['msg'] = "Only Post Method is allowed";



        }



        echo json_encode($response);



        exit;



    }







////////////////////////////////////////////////////////////



    public function api_login() {



		configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);







        $this->layout = "ajax";



        $username = $redata->User->username;



        $password = $redata->User->password;



        $this->request->data['User']['username'] = $username;



        //$this->request->data['email'];        



        $this->request->data['password'] = $password;



        if ($redata) {



			



			     $password_hash = AuthComponent::password($password);



            $check = $this->User->find('first', array('conditions' => array(



                "AND"=>array(



                    "User.username" => $this->request->data['User']['username'],



                    "User.password"=>$password_hash,



                    "User.active"=>1



                )



                ), 'recursive' => '-1'));



            if($check){



                $response['status'] = true;



                $response['msg'] = 'You have successfully logged in';



                $response['name'] = $check;



            }else{



                $response['status'] = false;



                $response['msg'] = 'User is not valid';



            }



			



        }



        echo json_encode($response);



        exit;



    }



//////////////////////////////







    public function api_userlogin(){



       



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        



        $email=$redata->email;



        $password=$redata->password;



//        $email='gurpreet@futureworktechnologies.com';



//        $password='123456';



   $password_hash = AuthComponent::password($password);



   $response=array();



    if($redata){



            $userdata=$this->User->find('first', array('conditions'=>array('User.email'=>$email, 'User.password'=>$password_hash)));



           if(!empty($userdata)){



               if($userdata['User']['role'] =='customer'){



                    $response['userdata']=$userdata;



                   $response['success']=1;



                   $response['msg']="Valid User";



             }else{



                   $response['userdata']="";



                   $response['success']=0;



                   $response['msg']="Invalid User";



                }



            }else{



                $response['userdata']="";



                   $response['success']=0;



                   $response['msg']="NO User found";



            }



           



 }



       // echo "<pre>"; print_r($userdata['User']['role']); echo "</pre>"; exit;



        



          echo json_encode($response);



        exit;



        



        



        



    }























    /////////////////////



    public function changepassword() {



		

		/*$users = $this->User->find('all', array('conditions' => array('User.role' => 'freelancer', 'User.active' => 1, 'User.subscription !=' => 0)));

		

		//echo "<pre>"; print_r($users); echo "</pre>";

		

		$users = array('17-06-2017', '19-06-2017', '15-06-2017', '14-06-2017');

		echo date('d-m-Y').'<br>';

		for($i=0; $i<count($users); $i++){

			$expire_date = $users[$i]['User']['expire_date'];			

			$date1=date_create($users[$i]);

			$date2=date_create(date('d-m-Y'));

			$diff=date_diff($date1,$date2);

			

			$actual_diff = str_replace('+', '', $diff->format("%R%a"));



			if($actual_diff > '1' && $actual_diff < '6'){

				$this->User->updateAll(array('User.subscription' => 7), array('User.id' => 166));

			}

		}*/

		

	



        if ($this->request->is('post')) {



            



            //print_r($this->data); exit;



            



            $password = AuthComponent::password($this->data['User']['old_password']);



            $em = $this->Auth->user('username');



            $pass = $this->User->find('first', array('conditions' => array('AND' => array('User.password' => $password, 'User.username' => $em))));



			//echo '<pre>'; print_r($pass); echo '</pre>'; die;



            if ($pass) {



                if ($this->data['User']['new_password'] != $this->data['User']['cpassword']) {



                    $this->Session->setFlash('New password and Confirm password field do not match', 'default', array(), 'pwdmatch');



                  



                } else {



                    $this->User->data['User']['password'] = $this->data['User']['new_password'];



                    $this->User->id = $pass['User']['id'];



                    if ($this->User->exists()) {



                        $pass['User']['password'] = $this->data['User']['new_password'];



                        if ($this->User->save()) {



                            $this->Session->setFlash(



                                'Password updated successfully',



                                'default',



                                array('class' => 'success-message'),



                                'changepass'    



                            );



                            $this->redirect(array('controller' => 'Users', 'action' => 'myaccount'));



                        }



                    }



                }



            } else {



                $this->Session->setFlash(



                    'The password you entered is incorrect.',



                    'default',



                    array('class' => 'error-message'),



                    'changepass'    



                );



            }



        }



    }







    ///////////////////







    public function reset($token = null) {



        configure::write('debug', 0);



        $this->User->recursive = -1;



        if (!empty($token)) {



            



            



            



            



            $u = $this->User->findBytokenhash($token);



            if ($u) {



                $this->User->id = $u['User']['id'];



                if (!empty($this->data)) {//echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;



				if($this->data['User']['password'] == '' || $this->data['User']['password_confirm'] == ''){



                        $this->Session->setFlash(



                            'Both fields are required',



                            'default',



                            array('class' => 'error-message'),



                            'reset'    



                        );



                        return;



                    }



                    elseif ($this->data['User']['password'] != $this->data['User']['password_confirm']) {



                        $this->Session->setFlash(



                            'Both Passwords must match',



                            'default',



                            array('class' => 'error-message'),



                            'reset'    



                        );



                        return;



                    }



                    $this->User->data = $this->data;



                    $this->User->data['User']['email'] = $u['User']['email'];



                   // print_r($this->User->data['User']['email']);exit;



                    $new_hash = sha1($u['User']['email'] . rand(0, 100)); //created token



                    $this->User->data['User']['tokenhash'] = $new_hash;



                    if ($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {



                        if ($this->User->save($this->User->data)) {



                            $this->Session->setFlash(



                                'Password has been updated successfully! Please Login to continue',



                                'default',



                                array('class' => 'success-message'),



                                'reset'    



                            );



                            //$this->redirect(array('controller' => 'shop', 'action' => 'index'));



                        }



                    } else {



                        $this->set('errors', $this->User->invalidFields());



                    }



                }



            } else {



                $this->Session->setFlash(



                    'Token Corrupted.Please retry the reset link 



                        <a style="cursor: pointer; color: rgb(0, 102, 0); text-decoration: none;



                        background: url("http://files.adbrite.com/mb/images/green-double-underline-006600.gif") 



                        repeat-x scroll center bottom transparent; margin-bottom: -2px; padding-bottom: 2px;"



                        name="AdBriteInlineAd_work" id="AdBriteInlineAd_work" target="_top">works</a> only for once.',



                    'default',



                    array('class' => 'error-message'),



                    'reset'    



                );



            }



        } else {



            $this->Session->setFlash('Pls try again...');



            $this->Session->setFlash(



                'Pls try again...',



                'default',



                array('class' => 'error-message'),



                'reset'    



            );



            $this->redirect(array('controller' => 'pages', 'action' => 'login'));



        }



    }







    //////////////////////////////







   public function forgetpwd() { 



        Configure::write("debug", 2); 







        $this->User->recursive = -1;



        if (!empty($this->request->data)) {



            if (empty($this->data['User']['username'])) {



                $this->Session->setFlash(



                    'Please enter Email address',



                    'default',



                    array('class' => 'error-message'),



                    'forget'    



                );







            } else {



                $username = $this->data['User']['username'];



                $fu = $this->User->find('first', array('conditions' => array('User.username' => $username)));







                if ($fu) { 



                    if ($fu['User']['active'] == "1") {



                        $key = Security::hash(CakeText::uuid(), 'sha512', true);



                        $hash = sha1($fu['User']['email'] . rand(0, 100));



                        $url = Router::url(array('controller' => 'Users', 'action' => 'reset'), true) . '/' . $key . '#' . $hash;



                        $ms = '<p>Click the Link below to reset your password.</p><br /><a href="'.$url.'">'



                                . '<button type="button" style="background:none; border:none; height:35px; padding:0px; display:inline-block; padding:0px 15px; background-color:#CC0000; color:#fff;" border-radius:4px;>Reset Password</button></a>';



                        $fu['User']['tokenhash'] = $key;  



                        $this->User->id = $fu['User']['id'];



                        if ($this->User->saveField('tokenhash', $fu['User']['tokenhash'])) {



                            



     



                            



                            $l = new CakeEmail();     



                            $l->emailFormat('html')->template('default','default')->subject('Reset Your Password')



                                     ->viewVars(array('link' => $url)) 



                                    ->viewVars(array('user' => $fu)) 

									->from(array('rahulsharma@avainfotech.com' => 'MTH'))



                                    ->to($fu['User']['email'])->send($ms);



                            



         



                            



                            //$this->set('smtp_errors', "none");



                            



                            $this->Session->setFlash(



                                'Check Your Email to reset your password.',



                                'default',



                                array('class' => 'success-message'),



                                'forget'    



                            );







                        } else {



                            $this->Session->setFlash(



                                'Error Generating Reset link.',



                                'default',



                                array('class' => 'error-message'),



                                'forget'



                            );



                        }



                    } else {



                        $this->Session->setFlash(



                            'This Account is not Active yet. Check Your mail to activate it.',



                            'default',



                            array('class' => 'error-message'),



                            'forget'    



                        );



                    }



                } else { 



                    $this->Session->setFlash(



                        'Email Address does not Exist.',



                        'default',



                        array('class' => 'error-message'),



                        'forget'    



                    );



                }



            }



        }



    }







    public function showwishlist() {







        $uid = $this->Auth->user('id');



        if (empty($uid)) {



            return $this->redirect(array('controller' => 'shop', 'action' => 'index'));



        }







        $this->loadModel("Wishlist");



        $this->Wishlist->recursive = 1;



        $data = $this->Wishlist->find('all', array('conditions' => array('Wishlist.user_id' => $uid)));







        foreach ($data as $val) {



            if ($val['Wishlist']['get_alert'] == 1 && $val['Product']['on_sale'] == 1 && $val['Wishlist']['user_id'] == $uid)



                ; {







                $salecount = count($val['Wishlist']['get_alert'] == 1 && $val['Product']['on_sale'] == 1 && $val['Wishlist']['user_id'] == $uid);



            }



        }



        $this->Session->write('salecount');



        $val = $this->Session->read('salecount');







        $this->set('datalist', $data);



    }







    public function api_showwishlist() {



        $this->layout = 'ajax';



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        //exit;



        // $uid = $this->Auth->user('id');



        $this->loadModel("Wishlist");







        if ($this->request->is('post')) {



            $this->Wishlist->recursive = 1;



            $data = $this->Wishlist->find('all', array('conditions' => array('Wishlist.user_id' => $redata->User->uid)));







            if ($data) {



				



				



					$cnt = count($data);



		



		  for ($i = 0; $i < $cnt; $i++) { 



                if ($data[$i]['Product']['image']) {



                    $data[$i]['Product']['image'] = Router::url('/', true). 'images/large/'. $data[$i]['Product']['image'];



                } else {



                    $data[$i]['Product']['image'] = Router::url('/', true). 'img/no-image.jpg';



                }



            }



			



				



				



                $response['wishlistdata'] = $data;



                $response['isSucess'] = "true";



            } else {



                $response['isSucess'] = 'true';



                $response['msg'] = 'Your wishlist empty!';



            }



        }



        echo json_encode($response);



        exit;



    }







    public function api_forgetpwd() {



        Configure::write('debug', 0);



        $this->layout = 'ajax';



        $this->layout = "ajax";



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        $username = $redata->User->username;



        $this->User->recursive = -1;



        if (empty($redata)) {



            $response['isSucess'] = 'false';



            $response['msg'] = 'Please Provide Your Username that You used to register with us';



        } else {



            $fu = $this->User->find('first', array('conditions' => array('User.username' => $username)));



            if ($fu['User']['email']) {



                if ($fu['User']['active'] == "1") {



                    $key = Security::hash(CakeText::uuid(), 'sha512', true);



                    $hash = sha1($fu['User']['email'] . rand(0, 100));



                    $url = Router::url(array('controller' => 'users', 'action' => 'api_resetpwd'), true) . '/' . $key . '#' . $hash;



                    $ms = "Welcome to Mobile



      <b><a href='" . $url . "' style='text-decoration:none'>Click here to reset your password.</a></b><br/>";



                    $fu['User']['tokenhash'] = $key;



                    $this->User->id = $fu['User']['id'];



                    if ($this->User->saveField('tokenhash', $fu['User']['tokenhash'])) {



                        $l = new CakeEmail('smtp');



                        $l->emailFormat('html')->template('default', 'default')->subject('Reset Your Password')



                                ->to($fu['User']['email'])->send($ms);



                        $response['isSucess'] = 'true';



                        $response['msg'] = 'Check Your Email ID to reset your password';



                    } else {



                        $response['isSucess'] = 'false';



                        $response['msg'] = 'Error Generating Reset link';



                    }



                } else {



                    $response['isSucess'] = 'false';



                    $response['msg'] = 'This Account is still not Active .Check Your Email ID to activate it';



                }



            } else {



                $response['isSucess'] = 'false';



                $response['msg'] = 'Email ID does Not Exist';



            }



        }



        echo json_encode($response);



        exit;



    }







    /////////////////////////////////////////







    public function api_resetpwd($token = null) {







        configure::write('debug', 0);



        $this->User->recursive = -1;



        if (!empty($token)) {



            $u = $this->User->findBytokenhash($token);



            if ($u) {







                $this->User->id = $u['User']['id'];



                if (!empty($this->data)) {







                    if ($this->data['User']['password'] != $this->data['User']['password_confirm']) {



                        $this->Session->setFlash("Both the passwords are not matching...");



                        return;



                    }



                    $this->User->data = $this->data;



                    $this->User->data['User']['email'] = $u['User']['email'];



                    $new_hash = sha1($u['User']['email'] . rand(0, 100)); //created token



                    $this->User->data['User']['tokenhash'] = $new_hash;



                    if ($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {



                        if ($this->User->save($this->User->data)) {



                            $this->Session->setFlash('Password Has been Updated');



                            $this->redirect(array('controller' => 'shop', 'action' => 'index'));



                        }



                    } else {



                        $this->set('errors', $this->User->invalidFields());



                    }



                }



            } else {







                $this->Session->setFlash('Token Corrupted, Please Retry.the reset link 



                        <a style="cursor: pointer; color: rgb(0, 102, 0); text-decoration: none;



                        background: url("http://files.adbrite.com/mb/images/green-double-underline-006600.gif") 



                        repeat-x scroll center bottom transparent; margin-bottom: -2px; padding-bottom: 2px;"



                        name="AdBriteInlineAd_work" id="AdBriteInlineAd_work" target="_top">work</a> only for once.');



            }



        } else {



            $this->Session->setFlash('Pls try again...');



            $this->redirect(array('controller' => 'pages', 'action' => 'login'));



        }



    }







    public function user_ask_ques() {







        $this->loadModel('Admin_contact');







        if ($this->request->is('post')) {



            $product_id = $this->request->data['Admin_contact']['product_id'];



            $name = $this->request->data['Admin_contact']['name'];



            $msg = $this->request->data['Admin_contact']['msg'];



            $email = $this->request->data['Admin_contact']['email'];







            $this->request->data['Admin_contact']['product_id'] = $product_id;



            $this->request->data['Admin_contact']['name'] = $name;



            $this->request->data['Admin_contact']['msg'] = $msg;



            $this->request->data['Admin_contact']['email'] = $email;







            $save = $this->Admin_contact->save($this->request->data);



            if ($save) {











                $Email = new CakeEmail();



				



			







                $Email->from(array($email => 'Shop Contact'))



                        ->to('wearorganicclothing@gmail.com')



                        ->subject('Wooden Feedback')



                        ->send($msg);



                $this->Session->setFlash('Thanks for Contact', 'flash_success');



                return $this->redirect('http://' . $_POST['server']);



            } else {



                $this->Session->setFlash('Try again', 'flash_success');



                return $this->redirect('http://' . $_POST['server']);



            }



        }



    }







    public function api_changepassword() {



        configure::write('debug', 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        $this->layout = "ajax";



        if ($this->request->is('post')) {



            $password = AuthComponent::password($redata->old_password);



            $id = $redata->uid;



            $pass = $this->User->find('first', array('conditions' => array('AND' => array('User.password' => $password, 'User.id' => $id))));



            if ($pass) {







                $this->User->data['User']['password'] = $redata->new_password;



                $this->User->id = $redata->uid;



                if ($this->User->exists()) {



                    $pass['User']['password'] = $redata->new_password;



                    if ($this->User->save()) {







                        $response['isSucess'] = 'true';



                        $response['msg'] = "your password has been updated";



                    }



                }



            } else {



                $response['isSucess'] = 'false';



                $response['msg'] = "Your old password did not match";



            }



        }







        echo json_encode($response);



        exit;



    }







    /////////////////////////////twitter user check///////////////////////////////







    public function checkUser($oauth_provider, $email, $oauth_uid, $username, $fname, $lname, $locale, $oauth_token, $oauth_secret, $profile_image_url) {







        $exist = $this->User->find("first", array('conditions' => array(



                "AND" => array(



                    'User.oauth_provider' => $oauth_provider,



                    'User.oauth_uid' => $oauth_uid



                )



        )));



		



        if ($exist['User']['id']) {



                 $this->request->data['User']['username'] = $username;



                    $this->request->data['User']['password'] = $username;



                    



                      $this->Auth->login();	



				//return $this->redirect('/users/myaccount/'); 



            $updated = $this->User->updateAll(



                    array('User.oauth_token' => "'$oauth_token'",



                        'User.oauth_secret' => "'$oauth_secret'",



                        'User.oauth_provider' => "'$oauth_provider'",



                        'User.oauth_uid' => "'$oauth_uid'",



                        'User.active' => 1



                    )



            );



        } else {







            $this->request->data['User']['oauth_token'] = $oauth_token;



            $this->request->data['User']['oauth_secret'] = $oauth_secret;



            $this->request->data['User']['oauth_provider'] = $oauth_provider;



            $this->request->data['User']['oauth_uid'] = $oauth_uid;



            $this->request->data['User']['first_name'] = $fname;



            $this->request->data['User']['image'] = $profile_image_url;



            $this->request->data['User']['locale'] = $locale;



            $this->request->data['User']['last_name'] = $lname;



            $this->request->data['User']['username'] = $username;



            $this->request->data['User']['password'] = $username;



            $this->request->data['User']['role'] = 'customer';



            $this->request->data['User']['email'] = $email;



            $this->request->data['User']['active'] = 1;



            $this->User->save($this->request->data);



					$user_id = $this->User->getLastInsertID();



                     



                    if ($user_id) {



                    $this->request->data['User']['username'] = $username;



                    $this->request->data['User']['password'] = $username;



                      $this->Auth->login();



           



                    



                }



			



        }



        $userdata = $this->User->find("first", array('conditions' => array(



                "AND" => array(



                    'User.oauth_provider' => 'twitter',



                    'User.oauth_uid' => $oauth_uid



                )



        )));



        return $userdata;



    }







    //////////////



    public function twitter_process() {



 Configure::write("debug", 0);



        Configure::load('twitter');



        $customer_key = Configure::read('Twitter.CONSUMER_KEY');



        $customer_secret = Configure::read('Twitter.CONSUMER_SECRET');



        $callback = Configure::read('Twitter.OAUTH_CALLBACK');











        if (isset($_REQUEST['oauth_token']) && $this->Session->read('token') !== $_REQUEST['oauth_token']) {







            //If token is old, distroy session and redirect user to index.php



            $this->Session->delete('token');



            return $this->redirect('http://rupak.crystalbiltech.com/shop/');



        } elseif (isset($_REQUEST['oauth_token']) && $this->Session->read('token') == $_REQUEST['oauth_token']) {







            //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name



            $connection = new TwitterOAuth($customer_key, $customer_secret, $_SESSION['token'], $_SESSION['token_secret']);



            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);



            if ($connection->http_code == '200') {



                //Redirect user to twitter



                $this->Session->write('status', 'verified');



                $this->Session->write('request_vars', $access_token);







                //Insert user into the database



                $params = array('include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true');







                $user_info = $connection->get('account/verify_credentials', $params);







                //$user_info = $connection->get('account/verify_credentials'); 



                $name = explode(" ", $user_info->name);



                $fname = isset($name[0]) ? $name[0] : '';



                $lname = isset($name[1]) ? $name[1] : '';



                //$db_user = new Users();



                $this->checkUser('twitter', $user_info->email, $user_info->id, $user_info->screen_name, $fname, $lname, $user_info->lang, $access_token['oauth_token'], $access_token['oauth_token_secret'], $user_info->profile_image_url);







                //Unset no longer needed request tokens



                $this->Session->delete('token');



                $this->Session->delete('token_secret');







                return $this->redirect('/users/myaccount');



                //header('Location: index.php');



            } else {







                $this->Session->setFlash('error, try again later!', 'flash_success');







                return $this->redirect('/shop');



                //die;



            }



        } else {







            if (isset($_GET["denied"])) {



                return $this->redirect('/shop');



                //die();



            }







            //Fresh authentication



            $connection = new TwitterOAuth($customer_key, $customer_secret);



            $request_token = $connection->getRequestToken($callback);







            //Received token info from twitter



            $this->Session->write('token', $request_token['oauth_token']);



            $this->Session->write('token_secret', $request_token['oauth_token_secret']);



            //$_SESSION['token'] 	        = $request_token['oauth_token'];



            //$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];



            //Any value other than 200 is failure, so continue only if http code is 200



            if ($connection->http_code == '200') {



                //redirect user to twitter



                $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);



                header('Location: ' . $twitter_url);



            } else {



                $this->Session->setFlash('error connecting to twitter! try again later!', 'flash_success');







                return $this->redirect('/shop');



            }



        }



    }







    public function twitter_profile() {



        



    }







    public function twitter_logout() {



        $this->Session->delete('status');



        $this->Session->delete('userdata');



        return $this->redirect('/shop');



    }







    public function google_login() {



       Configure::write("debug", 0);



	   



	   	



			     $client_id = '323825392115-9na4km0k8v5ephvkmcspb51hjf10ks8r.apps.googleusercontent.com';



        $client_secret = 'ZeKh2Vo1XzZcA1czA8LcZqlc';



        $redirect_uri = 'http://rupak.crystalbiltech.com/shop/users/google_login/';







        $client = new Google_Client();



        $client->setClientId($client_id);



        $client->setClientSecret($client_secret);



        $client->setRedirectUri($redirect_uri);



        $client->addScope("email");



        $client->addScope("profile");







        $service = new Google_Service_Oauth2($client);



		



		 if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {



            $client->setAccessToken($_SESSION['access_token']);



			



			



			



			



			



			 $user = $service->userinfo->get();







            if ($user) {



                $this->request->data['User']['name'] = $user->name;



                $this->request->data['User']['email'] = $user->email;



                $this->request->data['User']['username'] = $user->email;



                $this->request->data['User']['password'] = $user->name;



                if ($user->link == NULL) {



                    $this->request->data['User']['link'] = 'no link';



                } else {



                    $this->request->data['User']['link'] = $user->link;



                }







                $name = explode(" ", $user->name);



                $fname = isset($name[0]) ? $name[0] : '';



                $lname = isset($name[1]) ? $name[1] : '';







                // $this->request->data['User']['link'] = $user->link;



                $this->request->data['User']['first_name'] = $fname;



                $this->request->data['User']['last_name'] = $lname;



                $this->request->data['User']['image'] = $user->picture;



                $this->request->data['User']['role'] = 'customer';



                $this->request->data['User']['active'] = 1;



                $this->request->data['User']['google_id'] = $user->id;



                $this->request->data['User']['oauth_provider'] = 'google';







                $exist = $this->User->find("first", array('conditions' => array(



                        "AND" => array(



                            'User.oauth_provider' => 'google',



                            'User.google_id' => $user->id



                        )



                )));



				



				



                if ($exist['User']['id']) {



                   // $this->set(compact('exist'));



                    $this->request->data['User']['username'] = $exist['User']['username'];



                    $this->request->data['User']['password'] = $user->name;



                    



                      $this->Auth->login();	



				return $this->redirect('/users/myaccount/');	



                } else {



					



                    $this->User->save($this->request->data);



					



					$user_id = $this->User->getLastInsertID();



                     



                    if ($user_id) {



                    $this->request->data['User']['username'] = $user->email;



                    $this->request->data['User']['password'] = $user->name;



                      $this->Auth->login();



           



                    



                }



                    return $this->redirect('/users/myaccount/');



                }



            }



			



			



			



			



			



			



			



        } else {



            $authUrl = $client->createAuthUrl();



          	$this->set(compact('authUrl'));



        }







           



        



    }







    ///////////////////////////











    public function track_order() {



        $uid = $this->Auth->user('id'); 



     



        if ($uid) {



            $sql = 'SELECT orders.*, order_items.*, products.* FROM (order_items INNER JOIN orders



            ON order_items.order_id= orders.id)



           INNER JOIN products ON(order_items.product_id= products.id)



            WHERE orders.uid =' . $uid;



            $orderdataa = $this->User->query($sql);



        }







        $this->set(compact('orderdataa'));



    }







    public function api_orderHistory() {



        Configure::write("debug", 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        //  exit;



        $id = $redata->User->uid;







        if (!empty($redata)) {



            $sql = 'SELECT orders.*, order_items.*, products.* FROM (order_items INNER JOIN orders



            ON order_items.order_id= orders.id)



           INNER JOIN products ON(order_items.product_id= products.id)  



            WHERE orders.uid =' . $id;



            $orderdataa = $this->User->query($sql);



			if($orderdataa){



            $response['error'] = "0";



            $response['data'] = $orderdataa;



			}else{



				$response['error'] = "1";



            $response['msg'] ='empty order';



			}



        } else {



            $response['error'] = "1";



            $response['data'] = "error";



        }



        echo json_encode($response);



        exit;



    }







    ///////////////////////////////







    /**



     * facebook login



     */



   public function api_fbloginapp() {



        Configure::write("debug", 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'ipn.txt', 'w');



        fwrite($fc, $c);



        fclose($fc); 







		    if ($this->request->is('post')) {



		



		



		        $this->request->data['username'] = $redata->user->email;



                $this->request->data['name'] = $redata->user->name;



                $this->request->data['email'] = $redata->user->email;



                $this->request->data['fboo_ids'] = $redata->user->facebook_id;



                $this->request->data['session_id'] = $redata->user->session_id;



                $this->request->data['image'] = $redata->user->picture;



  



		 if (!$this->User->hasAny(array(



                        'OR' => array('User.username' =>$redata->user->email, 'User.email' => $redata->user->email)



                    ))) {



                $this->User->create();



                $this->request->data['role'] = "customer";



                $this->request->data['active'] = "1";



                if ($this->User->save($this->request->data)) {



                    $user = $this->User->find('first', array('conditions' => array('email' => $redata->user->email)));



					



                    $this->User->id = $this->User->getLastInsertID();







                    $this->loadModel('Cart');



                    $this->Cart->updateAll(



                        array('Cart.uid'=>$user['User']['id']),



                        array('Cart.sessionid'=>$redata->user->session_id,



                           // 'Cart.uid'=>0



                            )



                        );



                    $this->Cart->updateAll(



                        array('Cart.sessionid'=>$redata->user->session_id),



                        array('Cart.uid'=>$user['User']['id'])



                        );



                    $response['isSucess'] = 'true';



                    $response['data'] = $user;



                } else {



                    $response['isSucess'] = 'false';



                    $response['msg'] = 'Sorry please try again';



                }



            } else {



				



			 $user = $this->User->find('first', array('conditions' => array('email' => $redata->user->email)));



                



                if($user['User']['fboo_ids']!=''){



                    $this->loadModel('Cart');



                    $this->Cart->updateAll(



                        array('Cart.uid'=>$user['User']['id']),



                        array('Cart.sessionid'=>$redata->user->session_id,



                           // 'Cart.uid'=>0



                            )



                        );



                    $this->Cart->updateAll(



                        array('Cart.sessionid'=>$redata->user->session_id),



                        array('Cart.uid'=>$user['User']['id'])



                        );



                    $response['isSucess'] = 'true';



                    $response['data'] = $user;



                }else{



                    $response['isSucess']='false';



                    $response['msg']='This email is already registered.';



                }



                //$this->User->id = $user['User']['id'];



                // $this->User->saveField('image', $this->request->data['User']['image']);



                //$response['isSucess'] = 'true';



                //$response['data'] = $user;



				



				



			}



		



			}







        echo json_encode($response);



        exit;



    }



	



	



    ////////////////////////



    public function api_twitterlogin() {



        Configure::write("debug", 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);











        //  $options = array('conditions' => array('User.oauth_uid' => $redata->user->twitter_id));



        // $data = $this->request->data = $this->User->find('first', $options);   







        $exist = $this->User->find("first", array('conditions' => array(



                "AND" => array(



                    'User.oauth_uid' => $redata->user->twitter_id,



                    'User.oauth_provider' => 'twitter'



                )



        )));











        if (!empty($exist)) {







            $this->User->id = $exist['User']['id'];



            // $this->User->saveField('image', $this->request->data['User']['image']);



            $response['isSucess'] = 'true';



            $response['data'] = $exist;



        } else {











            // $this->request->data['User']['username'] = $redata->user->screen_name;   



            $this->request->data['User']['name'] = $redata->user->screen_name;



            $this->request->data['User']['oauth_provider'] = 'twitter';



            $this->request->data['User']['oauth_uid'] = $redata->user->twitter_id;



            $this->request->data['User']['session_id'] = $redata->user->session_id;



            $this->request->data['User']['role'] = "customer";



            $this->request->data['User']['active'] = "1";



            $this->request->data['User']['image'] = Router::url('/', true) . 'images/default-user.png';



            $this->User->create();



            $user = $this->User->save($this->request->data);



            $ids = $this->User->getLastInsertId();



            $response['isSucess'] = 'true';



            array_push($user['user_id'] = $ids);



            $response['data'] = $user;



        }



        echo json_encode($response);



        exit;



    }







    ////////////////////////



    public function api_googlelogin() {



        Configure::write("debug", 0);



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



        print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        



			 $img = Router::url('/', true) . 'images/default-user.png';



            



			if($redata->user->image == ''){



				



				$image = $img;



			}else{



				



				$image = $redata->user->image;



			}



			



		   $this->request->data['User']['username'] = $redata->user->email;



            $this->request->data['User']['email'] = $redata->user->email;



            $this->request->data['User']['name'] = $redata->user->name;



            $this->request->data['User']['oauth_provider'] = 'google';



            $this->request->data['User']['google_id'] = $redata->user->google_id;



            $this->request->data['User']['session_id'] = $redata->user->session_id;



            $this->request->data['User']['image'] = $image;



  



			   if (!$this->User->hasAny(array('User.username' => $redata->user->email)



                    )) {



                $this->User->create();



                $this->request->data['User']['role'] = 'customer';



                $this->request->data['User']['status'] = 1;



                if ($this->User->save($this->request->data)) {



                    $user = $this->User->find('first', array('conditions' => array('email' => $redata->user->email)));



               



                    $this->User->id = $this->User->getLastInsertID();



                    $this->loadModel('Cart');



                    $this->Cart->updateAll(



                        array('Cart.uid'=>$user['User']['id']),



                        array('Cart.sessionid'=>$redata->user->session_id,



                          //  'Cart.uid'=>0



                            )



                        );



                    $this->Cart->updateAll(



                        array('Cart.sessionid'=>$redata->user->session_id),



                        array('Cart.uid'=>$user['User']['id'])



                        );



                    $response['isSuccess'] = true;



                    $response['data'] = $user;



                } else {



                    $response['isSuccess'] = false;



                    $response['msg'] = 'Sorry please try again';



                }



            } else {







				  $user = $this->User->find('first', array('conditions' => array('email' => $redata->user->email)));



            



                



                if($user['User']['google_id']!=''){



                    $this->loadModel('Cart');



                    $this->Cart->updateAll(



                        array('Cart.uid'=>$user['User']['id']),



                        array('Cart.sessionid'=>$redata->user->session_id,



                           // 'Cart.uid'=>0



                            )



                        );



                    $this->Cart->updateAll(



                        array('Cart.sessionid'=>$redata->user->session_id),



                        array('Cart.uid'=>$user['User']['id'])



                        );



                    $response['isSuccess'] = true;



                    $response['data'] = $user;



                }else{



                    $response['isSuccess']=false;



                    $response['msg']='This email is already registered.';



                }



				



			}		







        echo json_encode($response);



        exit;



    }







    public function order_details(){}



    



    public function api_restlogin(){



       



        $postdata = file_get_contents("php://input");



        $redata = json_decode($postdata);



        ob_start();



       // print_r($redata);



        $c = ob_get_clean();



        $fc = fopen('files' . DS . 'detail.txt', 'w');



        fwrite($fc, $c);



        fclose($fc);



        $this->layout = "ajax";



        $username = $redata->username;



        $password = $redata->password;



        $this->request->data['User']['username'] = $username;



        //$this->request->data['email'];        



        $this->request->data['password'] = $password;



        if ($redata) {



			



			     $password_hash = AuthComponent::password($password);



            $check = $this->User->find('first', array('conditions' => array(



                "AND"=>array(



                    "User.username" => $this->request->data['User']['username'],



                    "User.password"=>$password_hash,



                    "User.role"     => "rest_admin",



                    "User.active"=>1



                )



                ), 'recursive' => '-1'));



            



            



            if($check){



                $response['status'] = true;



                $response['msg'] = 'You have successfully logged in';



                $response['name'] = $check;



                



                $this->loadModel('Restaurant');



                $restaurant = $this->Restaurant->find('first', array('conditions' => array('Restaurant.user_id' => $check['User']['id'])));



                



                $response['store'] = $restaurant;



                



            }else{



                $response['status'] = false;



                $response['msg'] = 'User is not valid';



            }



			



        }



        echo json_encode($response);



        exit;



    }



    



public function editservice($id=null){



        



        Configure::write('debug', 0);



        if(!$this->Auth->user('id')){



            return $this->redirect('/shop');



        }



        $this->loadModel('Category');



        $this->loadModel('Service');



        if ($this->request->is('post') || $this->request->is('put')) {



            



            $this->request->data['Service']['user_id'] = $this->Auth->user('id');



        



            $this->Service->id=$id;



            



            $this->request->data['Service']['id']= $id;



           



            if($this->Service->save($this->request->data)){



                $this->Session->setFlash(



                    'Service Updated Successfully.',



                    'default',



                    array('class' => 'success-message'),



                    'editservice'    



                );



                



                $this->redirect(array('action' => 'services'));



            }



        }



        $this->Service->recursive = 1;



        $categories = $this->Category->find('all', array('conditions' => array('Category.status' => 1)));



        $services = $this->Service->find('first', array('conditions' => array('Service.id' => $id, 'Service.user_id' => $this->Auth->user('id'))));



        $this->set('categories', $categories);



        $this->set('services', $services);



        



    }



    



    public function services(){



        



        Configure::write('debug', 0);



        if(!$this->Auth->user('id')){



            return $this->redirect('/');



        }



        



        if($this->Auth->user('role') != 'freelancer'){



            return $this->redirect('/');



        }



        



        $this->loadModel('Service');



        $this->Service->recursive = 1;



        $services = $this->Service->find('all', array('conditions' => array('Service.user_id' => $this->Auth->user('id'))));



        



        $this->set('services', $services);



        



    }



    



    public function addservice(){



        



        Configure::write('debug', 2);



        if(!$this->Auth->user('id')){



            return $this->redirect('/');



        }



        



        if($this->Auth->user('role') != 'freelancer'){



            return $this->redirect('/');



        }



        



        $this->loadModel('Category');



        $this->loadModel('Service');



        



        $categories = $this->Category->find('all', array('conditions' => array('Category.status' => 1)));



        



        if ($this->request->is('post') || $this->request->is('put')) {



            



            $this->request->data['Service']['user_id'] = $this->Auth->user('id');



            



            $this->Service->create();



            



            if($this->Service->save($this->request->data)){



                $this->Session->setFlash(



                    'Service added successfully.',



                    'default',



                    array('class' => 'success-message'),



                    'addservice'    



                );



                $this->redirect(array('action' => 'services'));



            }



        }



        $this->set('categories', $categories);



    }



	



	public function addunavailability(){



		Configure::write('debug', 2);



		



		if(!$this->Auth->user('id')){



            return $this->redirect('/');



        }



        



        if($this->Auth->user('role') != 'freelancer'){



            return $this->redirect('/');



        }



		



		$this->loadModel('Unavailability');



		



		if ($this->request->is('post')){



			



			$this->request->data['Unavailability']['userid'] = $this->Auth->user('id');



			



			$this->request->data['Unavailability']['hourfrom'] = $this->request->data['Unavailability']['hourfrom'] . ':' . $this->request->data['Unavailability']['minutefrom'] . ' ' . $this->request->data['Unavailability']['ampmfrom'];



			



			$this->request->data['Unavailability']['hourto'] = $this->request->data['Unavailability']['hourto'] . ':' . $this->request->data['Unavailability']['minuteto'] . ' ' . $this->request->data['Unavailability']['ampmto'];



		//echo '<pre>'; print_r($this->request->data); echo '</pre>'; die;



			$this->Unavailability->create();



			if($this->Unavailability->save($this->request->data)){



				$this->Session->setFlash(



					'Unavilability created successfully',



					'default',



					array('class' => 'success-message'),



					'addunavailability'



				); 



				return $this->redirect(array('action' => 'unavailability'));   			



			}



		}







	}



	



	public function unavailability(){



	



		Configure::write('debug', 2);



		if(!$this->Auth->user('id')){



			return $this->redirect('/');



		}



                



                if($this->Auth->user('role') != 'freelancer'){



                    return $this->redirect('/');



                }



		



		$this->loadModel('Unavailability');



		



		$unavilabilities = $this->Unavailability->find('all', array('conditions' => array('Unavailability.userid' => $this->Auth->user('id'))));



		//echo '<pre>'; print_r($unavilabilities); echo '</pre>'; die;



		$this->set('unavilabilities', $unavilabilities);



	



	}







	public function deleteunavilability($id){



		Configure::write("debug", 0);



		$this->loadModel('Unavailability');



		$deleteunavilability = $this->Unavailability->deleteAll(array('Unavailability.id'=>$id));



		if($deleteunavilability){



			$this->Session->setFlash(



				'Record delete successfully',



				'default',



				array('class' => 'success-message'),



					'addunavailability'



			); 



			return $this->redirect(array('action' => 'unavailability'));  



		}



	}



	



	public function bookings(){



	



		if(!$this->Auth->user('id')){



			return $this->redirect('/');



		}



	



		$this->loadModel('Order');



		

		if($this->Auth->user('role') == 'freelancer'){		

			$condition = array( 'Order.status' => '1', 'OR' => array('Order.salon_id' => $this->Auth->user('id'),'Order.uid' => $this->Auth->user('id')));

		}elseif($this->Auth->user('role') == 'customer'){		

			$condition = array('Order.uid' => $this->Auth->user('id'), 'Order.status' => '1');

		}

		

		//$condition = array('Order.salon_id' => $this->Auth->user('id'), 'Order.status' => '1');

		 



		$this->Paginator->settings = array(



			'recursive' => 2,



			//'conditions' => array('Order.salon_id' => $this->Auth->user('id'), 'Order.payment_status' => 'Completed'),



			'conditions' => $condition,



			'limit' => 10,

			

			'order' => array('Order.id' => 'DESC')



		);



		



		$data = $this->Paginator->paginate('Order');



		 



		$this->set('orders', $data);



	}



	



	public function booking($id = null){



		



		/*if(!$id){



			return $this->redirect('/users/bookings');



		}*/



		



		$this->loadModel('Order');



		



		$this->Order->recursive = 2;



		$order = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));



		

		

		/*if($this->Auth->user('role') == 'freelancer'){

			if($this->Auth->user('id') != $order['Order']['salon_id']){

	

				return $this->redirect('/');

	

			}

		}	*/



		

		/*if(!$this->Auth->user('id')){

	

			return $this->redirect('/');



		}*/

		



		$this->set('order', $order);

		

		

		$this->loadModel('Review');

		

		$reviews = $this->Review->find('first', array('conditions' => array('Review.order_id' => $id)));

		

		$this->set('reviews', $reviews);	



	}



	



	public function updateServiceStatus(){



		
            //Configure:write('debug', 2);


		$this->loadModel('Order');



		



		if($this->request->is('post')){



			if($this->request->data['order_id']){
                                
                                $id = $this->request->data['order_id'];
                                
                                $this->Order->recursive = 2;
                                
                                $order = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));

                                $user = $this->User->find('first', array('conditions' => array('User.id' => $order['Order']['uid'])));

                                $therapist = $this->User->find('first', array('conditions' => array('User.id' => $order['Order']['salon_id'])));

                                $admin_info = $this->User->find('first', array('conditions' => array('User.id' => 1)));

                                if($this->request->data['value'] == 'cancelled'){
                                
                                    $this->Order->updateAll(array('Order.service_status' => '"'.$this->request->data['value'].'"', 'Order.cancelled_by' => '"therapist"'), array('Order.id' => $this->request->data['order_id']));

                                    $order['Order']['cancelled_by_name'] = $therapist['User']['first_name'].' '.$therapist['User']['last_name'];

                                    /*** User Email ****/

                                    $Email = new CakeEmail();                                
                                    $Email->emailFormat('html')->template('default','usercancel')->subject('Booking Cancelled')
                                        ->viewVars(array('orderdata_email' => $order)) 
                                        //->viewVars(array('user' => $fu)) 
                                        ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                                        ->to($user['User']['email'])->send();	

                                    /*** User Email (END) ****/

                                    /*** Therapist Email ****/


                                    $Email = new CakeEmail();                                
                                    $Email->emailFormat('html')->template('default','therapistcancel')->subject('Booking Cancelled')
                                        ->viewVars(array('orderdata_email' => $order)) 
                                        //->viewVars(array('user' => $fu)) 
                                        ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                                        ->to($therapist['User']['email'])->send();	

                                    /*** Therapist Email (END) ****/

                                    /*** Admin Email ****/	



                                    $e = new CakeEmail();                                
                                    $e->emailFormat('html')->template('default','admincancel')->subject('Booking Cancelled')
                                        ->viewVars(array('orderdata_email' => $order)) 
                                        //->viewVars(array('user' => $fu)) 
                                        ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                                        //->to($admin_info['User']['email'])->send();
                                        ->to('gurpreet@avainfotech.com')->send();

                                    /*** Admin Email (END) ****/
                                }else{
                                    $this->Order->updateAll(array('Order.service_status' => '"'.$this->request->data['value'].'"', 'Order.cancelled_by' => null), array('Order.id' => $this->request->data['order_id']));
                                }

                                echo 'success';



				exit;



				



			}



		}



	}

	

	public function cancelOrder($id = null){



	Configure::write('debug', 2);



		if($id){

			$this->loadModel('Order');

			$this->loadModel('OrderItem');

                        $this->Order->recursive = 2;
                        
			$cancel = $this->Order->updateAll(array('Order.service_status' => '"cancelled"', 'Order.cancelled_by' => '"customer"'),array('Order.id' => $id));

			$order = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));

			

			$user = $this->User->find('first', array('conditions' => array('User.id' => $order['Order']['uid'])));
                        
                        $therapist = $this->User->find('first', array('conditions' => array('User.id' => $order['Order']['salon_id'])));
                        
                        $admin_info = $this->User->find('first', array('conditions' => array('User.id' => 1)));

					
                        $order['Order']['cancelled_by_name'] = $user['User']['first_name'].' '.$user['User']['last_name'];

                        if($order['Order']['uid'] != 0){
                            $order['Order']['cancelled_by_name'] = $user['User']['first_name'] . ' ' . $user['User']['last_name'];
                            $user_email = $user['User']['email'];
                        }else{
                            $order['Order']['cancelled_by_name'] = $order['Order']['first_name'] . ' ' . $order['Order']['last_name'];
                            $user_email = $order['Order']['email'];
                        }
                        
			if ($cancel) {

                                /*** User Email ****/

                                $Email = new CakeEmail();                                
                                $Email->emailFormat('html')->template('default','usercancel')->subject('Booking Cancelled')
                                    ->viewVars(array('orderdata_email' => $order)) 
                                    //->viewVars(array('user' => $fu)) 
                                    ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                                    ->to($user_email)->send();	

                                /*** User Email (END) ****/

                                /*** Therapist Email ****/


                                $Email = new CakeEmail();                                
                                $Email->emailFormat('html')->template('default','therapistcancel')->subject('Booking Cancelled')
                                    ->viewVars(array('orderdata_email' => $order)) 
                                    //->viewVars(array('user' => $fu)) 
                                    ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                                    ->to($therapist['User']['email'])->send();	

                                /*** Therapist Email (END) ****/

                                /*** Admin Email ****/	

                                $e = new CakeEmail();                                
                                $e->emailFormat('html')->template('default','admincancel')->subject('Booking Cancelled')
                                    ->viewVars(array('orderdata_email' => $order)) 
                                    //->viewVars(array('user' => $fu)) 
                                    ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                                    //->to($admin_info['User']['email'])->send();
                                    ->to('gurpreet@avainfotech.com')->send();

                                /*** Admin Email (END) ****/
                                
                                
	

				$this->Session->setFlash(

	

					'Booking cancelled successfully.',

	

					'default',

	

					array('class' => 'success-message'),

	

					'bookings'    

	

				);

	

				return $this->redirect(array('action' => 'bookings'));

	

			}

	

			$this->Session->setFlash(

	

				'Error in cancellation',

	

				'default',

	

				array('class' => 'error-message'),

	

				'bookings'    

	

			);

	

			return $this->redirect(array('action' => 'bookings'));

		

		}

	}

	

	

	public function admin_updatesubscription($id = null){

		if($id){

            

            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

			

			//echo "<pre>"; print_r($user); echo "</pre>"; exit;

			

			if($user['User']['subscription'] ==  0){

				$subscription = 1;

				

				$subscribe_date = date("d-m-Y");

				

				if($user['User']['subscription'] == 0){

					$expire_date = date('d-m-Y', strtotime("+2 months", strtotime($subscribe_date)));

				}else{

					$expire_date = date('d-m-Y', strtotime("+1 months", strtotime($subscribe_date)));

				}

				

				$subscription_times = $user['User']['subscription_times'] + 1;

				

				$update = array('User.subscription' => $subsription, 'User.subscribe_date' => $subscribe_date, 'User.expire_date' => $expire_date, 'User.subscribe_amount' => 20, 'User.subscription_times' => $subscription_times );

				

			}else{

				$subscription = 0;

			}

			

			$this->User->updateAll(array('User.subscription' => $subscription), array('User.id' => $id));

			

			return $this->redirect(array('action' => 'stores'));

	

		}

	}	

	

	public function weekly(){

	

		if(!$this->Auth->user('id')){

			$this->redirect('/');

		}

	

	

		$times = array();

	

		$from = '12:00 am';



		$to = '11:45 pm';

		

		

		$finish_time = date("H:i:s", strtotime($to));

		$start_time = date("H:i:s", strtotime($from));

		

		$finish = strtotime(date($finish_time));

		$k =-15;

		for($i=1; $i<=96;$i++){

		$k+=15;

		$selectedTime = date($start_time);

		$endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

		if($finish<$endTime){

		break;

		}

		$times[] = date('h:i a', $endTime);

		}

		

		$this->set('times', $times);

		

	}

	

	public function datesBetweenTwoDates(){

	

		$dates = array();

		

		// Specify the start date. This date can be any English textual format  

		$date_from = $this->request->data['start_date'];   

		$date_from = strtotime($date_from); // Convert date to a UNIX timestamp  

		

		// Specify the end date. This date can be any English textual format  

		$date_to = $this->request->data['end_date'];  

		$date_to = strtotime($date_to); // Convert date to a UNIX timestamp  

		

		// Loop from the start date to end date and output all dates inbetween  

		for ($i=$date_from; $i<=$date_to; $i+=86400) {  

			

			$date = date("d-m-Y", $i);

			$timestamp = strtotime($date);

			$day = date('l', $timestamp);

			

			$day = strtolower($day);

			

			$timings = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

			

			$from = $timings['User'][$day.'_timing_from'];



        	$to = $timings['User'][$day.'_timing_to'];

			

			$dates[] = array(

				'date'			=>	$date,

				'day'			=>	$day,

				'timing_from'	=>	$from,

				'timing_to'		=>	$to

			);

				

		} 

		

		echo json_encode($dates);

		

		exit; 

		

	}

	

	public function ajaxWeeklyUnavailable(){

		

		$this->loadModel('Unavailability');

		

		$date_from = $this->request->data['start_date'];   

		$date_from = strtotime($date_from);

		

		$date_to = $this->request->data['end_date'];  

		$date_to = strtotime($date_to); 

		

		$una = array();

		

		for ($i=$date_from; $i<=$date_to; $i+=86400) {

			

			$date = date("d-m-Y", $i);

			

			$unavailability = $this->Unavailability->find('all', array('conditions' => array('Unavailability.date' => $date, 'Unavailability.userid' => $this->Auth->user('id')))); 	

			

			$una[$date] = $unavailability;

			

		}

		

		echo json_encode($una);

		exit;

		

	}

	

	public function ajaxWeeklyBookings(){

	

		$this->loadModel('Order');

		

		$date_from = $this->request->data['start_date'];   

		$date_from = strtotime($date_from);

		

		$date_to = $this->request->data['end_date'];  

		$date_to = strtotime($date_to); 

		

		$order = array();

		

		for ($i=$date_from; $i<=$date_to; $i+=86400) {

			

			$date = date("d-m-Y", $i);

			

			$orders = $this->Order->find('all', array('conditions' => array('Order.booking_date' => $date, 'Order.salon_id' => $this->Auth->user('id'), 'Order.service_status' => 'pending', 'Order.status' => '1'))); 	

			

			$order[$date] = $orders;

			

		}

		

		echo json_encode($order);

		exit;

		

	}

	

	public function ajaxGetTimeAfterTime(){

		

		$date = $this->request->data['date'];

		

		$timestamp = strtotime($date);

		$day = strtolower(date('l', $timestamp));

		

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

		

		$from = $this->request->data['time'];



		$to = $user['User'][$day.'_timing_to'];



		$finish_time = date("H:i:s", strtotime($to));

		$start_time = date("H:i:s", strtotime($from));

		

		$times = array();

		

		$finish = strtotime(date($finish_time));

		$k =-15;

		for($i=1; $i<=96;$i++){

			$k+=15;

			$selectedTime = date($start_time);

			$endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

			/*echo $endTime.'<br>';
			echo $finish.'<br>';
			echo "================<br>";*/

			/*if($finish == $endTime){

				break;

			}*/

			

			$times[] = date('h:i a', $endTime);
			
			if($to == date('h:i a', $endTime)){
				break;
			}

		}

		

		//unset($times[0]);

		echo json_encode($times);

		exit;

	}

	

	public function ajaxAddUnvailability(){



		$this->request->data['Unavailability']['userid'] = $this->Auth->user('id');

		$this->request->data['Unavailability']['date'] = $this->request->data['date'];

		$this->request->data['Unavailability']['hourfrom'] = $this->request->data['start'];

		$this->request->data['Unavailability']['hourto'] = $this->request->data['end'];

		$this->request->data['Unavailability']['note'] = $this->request->data['note'];

		

		$this->loadModel('Unavailability');

		

		$this->Unavailability->create();

		

		if($this->Unavailability->save($this->request->data)){

			echo 'success';

			exit;

		}else{

			echo 'error';

			exit;

		}

		exit;

	}

	

	public function ajaxGetUnavailabilityById(){

	

		$data = array();

	

		if($this->request->is('post')){

			

			$id = $this->request->data['id'];

			

			$this->loadModel('Unavailability');

			

			$data = $this->Unavailability->find('first', array('conditions' => array('Unavailability.id' => $id)));

			

			

			$timestamp = strtotime($data['Unavailability']['date']);

			$day = strtolower(date('l', $timestamp));

			

			$user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

			

			$from = $data['Unavailability']['hourfrom'];

	

			$to = $user['User'][$day.'_timing_to'];

	

			$finish_time = date("H:i:s", strtotime($to));

			$start_time = date("H:i:s", strtotime($from));

			

			$times = array();

			

			$finish = strtotime(date($finish_time));

			$k =-15;

			for($i=1; $i<=96;$i++){

				$k+=15;

				$selectedTime = date($start_time);

				$endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

				

				if($finish<$endTime){

					break;

				}

				

				$times[] = date('h:i a', $endTime);

				

				

			}

			

			$data['times'] = $times;

			

		}	

		

		echo json_encode($data);

		exit;

	}

	

	public function ajaxEditWeeklyUnavailability(){

	

		$this->loadModel('Unavailability');

	

		if($this->request->is('post')){

			

			$this->Unavailability->id = $this->request->data['id']; 

			

			$this->request->data['Unavailability']['date'] = $this->request->data['date'];

			$this->request->data['Unavailability']['hourfrom'] = $this->request->data['from'];

			$this->request->data['Unavailability']['hourto'] = $this->request->data['to'];

			$this->request->data['Unavailability']['note'] = $this->request->data['note'];

			

			if($this->Unavailability->save($this->request->data)){

				echo 'success';

				exit;

			}else{

				echo 'error';

				exit;

			}

		}

	}

	

	public function ajaxDeleteWeeklyUnavailability(){

	

		$this->loadModel('Unavailability');

	

		if($this->request->is('post')){

		

			$id = $this->request->data['id']; 

		

			$delete = $this->Unavailability->deleteAll(array('Unavailability.id' => $id));

			

			if($delete){

				echo 'success';

				exit;

			}else{

				echo 'error';

				exit;

			}

		}

	}

	

	public function subscription(){

		if($this->Auth->user('role') != 'freelancer'){

			$this->redirect('/');

		}

		

		$user = $this->User->findById($this->Auth->user('id'));

		

		$this->loadModel('Subscription');

		

		$subscriptions = $this->Subscription->find('all', array('conditions' => array('Subscription.user_id' => $this->Auth->user('id'))));



		$this->set('user', $user);

		$this->set('subscriptions', $subscriptions);

		

	}

	

	public function getSalonSubscribeDate(){

	

		$json = array();

	

		$cart_salon_id = $this->Session->read('Shop.Salon');



		$this->set('cart_salon_id',$cart_salon_id);

		

		$cart_salon_date = $this->User->find('first', array('conditions' => array('User.id' => $cart_salon_id)));



		$this->set('cart_salon_date',$cart_salon_date);

		

		if(!empty($cart_salon_date)){

			$json['sub_date'] = date("m-d-Y", strtotime('-1 months', strtotime($cart_salon_date["User"]["subscribe_date"])));

			$json['exp_date'] = date("m-d-Y", strtotime('-1 months', strtotime($cart_salon_date["User"]["expire_date"])));

		}

		

		echo json_encode($json);

		exit;

	}
	
	public function getStoreSubscribeDate(){

	

		$json = array();

	

		$cart_salon_id = $this->request->data('salon_id');



		$this->set('cart_salon_id',$cart_salon_id);

		

		$cart_salon_date = $this->User->find('first', array('conditions' => array('User.id' => $cart_salon_id)));



		$this->set('cart_salon_date',$cart_salon_date);

		

		if(!empty($cart_salon_date)){

			$json['sub_date'] = date("m-d-Y", strtotime('-1 months', strtotime($cart_salon_date["User"]["subscribe_date"])));
			//$json['sub_date'] = date("Y,m,d", strtotime($cart_salon_date["User"]["subscribe_date"]));

			$json['exp_date'] = date("m-d-Y", strtotime('-1 months', strtotime($cart_salon_date["User"]["expire_date"])));
			//$json['exp_date'] = date("Y,m,d", strtotime($cart_salon_date["User"]["expire_date"]));

		}

		

		echo json_encode($json);

		exit;

	}

	

	public function ajaxgetLatLong(){

		$zipcode = $this->request->data['value'];

		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false";

		$details=file_get_contents($url);

		$result = json_decode($details,true);

	

		$lat=$result['results'][0]['geometry']['location']['lat'];

	

		$lng=$result['results'][0]['geometry']['location']['lng'];

	

		$json['lat'] = $lat;

		$json['lng'] = $lng;

		

		echo json_encode($json);

		exit;

	}
        
        public function cmb($id = null){
            $id = substr(base64_decode($id), 11);
            
            if($this->request->is('post')){
                
                $this->loadModel('Order');

                $this->Order->recursive = 2;

                $order = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));

                $current_date = time();

                $booking_date = date('Y-m-d', strtotime($order['Order']['booking_date']));
                $booking_time = date('H:i:s', strtotime($order['Order']['start_time']));

                $final_booking_time = date(strtotime($order['Order']['booking_date'].' '.$order['Order']['start_time']));

                //round(abs($current_date - $final_booking_time) / 60,2). " minute"; echo '<br>';

                $minutes = round(abs($current_date - $final_booking_time) / 60,2);

                $hours = ($minutes) / 60; //echo ' Hours Left<br>';

                if($hours > 24){
                    $cancel = $this->Order->updateAll(array('Order.service_status' => '"cancelled"', 'Order.cancelled_by' => '"customer"', 'Order.paypal_email' => "'".$this->request->data['paypal_email']."'"), array('Order.id' => $id));

                    $order = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));

                    $user = $this->User->find('first', array('conditions' => array('User.id' => $order['Order']['uid'])));

                    $therapist = $this->User->find('first', array('conditions' => array('User.id' => $order['Order']['salon_id'])));

                    $admin_info = $this->User->find('first', array('conditions' => array('User.id' => 1)));

                    if($order['Order']['uid'] != 0){
                        $order['Order']['cancelled_by_name'] = $user['User']['first_name'] . ' ' . $user['User']['last_name'];
                        $user_email = $user['User']['email'];
                    }else{
                        $order['Order']['cancelled_by_name'] = $order['Order']['first_name'] . ' ' . $order['Order']['last_name'];
                        $user_email = $order['Order']['email'];
                    }

                    if ($cancel) {

                        /*** User Email ****/

                        $Email = new CakeEmail();                                
                        $Email->emailFormat('html')->template('default','usercancel')->subject('Booking Cancelled')
                            ->viewVars(array('orderdata_email' => $order)) 
                            //->viewVars(array('user' => $fu)) 
                            ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                            ->to($user_email)->send();	

                        /*** User Email (END) ****/

                        /*** Therapist Email ****/


                        $Email = new CakeEmail();                                
                        $Email->emailFormat('html')->template('default','therapistcancel')->subject('Booking Cancelled')
                            ->viewVars(array('orderdata_email' => $order)) 
                            //->viewVars(array('user' => $fu)) 
                            ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                            ->to($therapist['User']['email'])->send();	

                        /*** Therapist Email (END) ****/

                        /*** Admin Email ****/	

                        $e = new CakeEmail();                                
                        $e->emailFormat('html')->template('default','admincancel')->subject('Booking Cancelled')
                            ->viewVars(array('orderdata_email' => $order)) 
                            //->viewVars(array('user' => $fu)) 
                            ->from(array('rahulsharma@avainfotech.com' => 'MTH'))
                            //->to($admin_info['User']['email'])->send();
                            ->to('gurpreet@avainfotech.com')->send();

                        /*** Admin Email (END) ****/

                        $this->Session->setFlash(
                            'Booking cancelled successfully. Your refund will be initiated soon and money will be refunded within 7-8 working days.',
                            'default',
                            array('class' => 'success-message'),
                            'cancelorder'    
                        );
                    }else{
                        $this->Session->setFlash(
                            'Booking cancellation is unsuccessful.',
                            'default',
                            array('class' => 'error-message'),
                            'cancelorder'    
                        );
                    }  
                }else{
                    $this->Session->setFlash(
                        'Booking cancellation is unsuccessful. You can cancel your booking only before 24 hours to your appointment.',
                        'default',
                        array('class' => 'error-message'),
                        'cancelorder'    
                    );
                }
            }    
        }

	

}



