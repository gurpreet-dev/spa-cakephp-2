<?php







App::uses('AppController', 'Controller');







class SalonController extends AppController {







    

public $components = array('Paginator');





	public $distance = "10";



    public function index(){







        







        Configure::write('debug', 2);







        







        $this->loadModel('User');







        







        $this->User->recursive = 2;







        $salons = $this->User->find('all', array('conditions' => array('User.active' => 1, 'User.role' => 'freelancer')));







        







        $this->set('salons', $salons);







        







    }







	public function admin_index(){

	

		Configure::write('debug', 2);

	

		$this->loadModel('User');

		

		

		if(isset($this->request->data['User']['search'])){

			$keyword = $this->request->data['User']['search'];

		}else{

			$keyword = '';

		}

		

		

		$this->Paginator->settings = array(

			'recursive' 	=> 	2,

			'conditions' 	=> 	array('User.role' => 'freelancer', 'User.active' => 1, 'User.store_name LIKE' => '%'.$keyword.'%'),

			'limit'			=>	10,

			'order'			=> array('User.id' => 'DESC')

		);

		

		$salons = $this->Paginator->paginate('User');

		

		$this->set('salons', $salons);

		$this->set('keyword', $keyword);

	}

    

	

	public function admin_view($id = null){

		

		$this->User->id = $id;

		

		$this->loadModel('User');

		

		if (!$this->User->exists()) {

			throw new NotFoundException('Invalid user');

		}

		

		$this->User->recursive = 2;

		$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

		

		$this->set('user', $user);

	}

	





    public function search(){
        
        Configure::write('debug', 2);
		$this->loadModel('Service');
		//echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;
		$this->loadModel('User');
		$this->loadModel('Unavailability');
		$date = strtolower($this->request->data['date']);
		$services = array();
		$service_array = array();
		if (isset($this->request->data["category"])) {
			if (is_array($this->request->data["category"]) && !empty($this->request->data["category"])) {
				$service_array = $this->request->data["category"];
				$sql = 'SELECT * FROM services WHERE status = 1 AND (';
				for ($i = 0; $i < count($service_array); $i++) {
					if ($i != 0) {
						$sql.= ' OR';
					}

					$sql.= ' name LIKE "%' . $service_array[$i] . '%"';
				}

				$sql.= ')';
				$servicees = $this->Service->query($sql);
				$services = array();
				for ($j = 0; $j < count($servicees); $j++) {
					$services[$j]['Service'] = $servicees[$j]['services'];
				}

				// echo $sql;
				// $services = $this->Service->find('all', array('conditions' => array('Service.id' => $service_array, 'Service.status' => 1)));

			}
			else {
				$services = $this->Service->find('all', array(
					'conditions' => array(
						'Service.name LIKE ' => '%' . $this->request->data["category"] . '%',
						'Service.status' => 1
					)
				));
				$service_array = array(
					$this->request->data["category"]
				);
			}
		}
		else {
			$this->redirect('/');
		}

		if (isset($this->params['url']['category'])) {
			$services = $this->Service->find('all', array(
				'conditions' => array(
					'Service.name LIKE ' => '%' . $this->params['url']['category'] . '%',
					'Service.status' => 1
				)
			));
		}

		$salons = array();
		$users = array();
		if (isset($this->request->data['sortby'])) {
			if ($this->request->data['sortby'] == 'name') {
				$order = 'User.store_name ASC';
			}
			elseif ($this->request->data['sortby'] == 'rating') {
				$order = 'User.avg_rating DESC';
			}
		}
		else {
			$order = '';
		}

		$service_users = array();
		if (!empty($services)) {
			for ($i = 0; $i < count($services); $i++) {
				$service_users[] = $services[$i]['Service']['user_id'];
			}

			foreach($services as $service) {
				if (isset($this->request->data["location"])) {
					/******************/
					$zipcode = $this->request->data["location"];
					$zipcode = str_replace(' ', '+', $zipcode);
					$url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBQrWZPh0mrrL54_UKhBI2_y8cnegeex1o&address=" . $zipcode . "&sensor=true";
					$details = file_get_contents($url);
					$result = json_decode($details, true);

					// echo "<pre>"; print_r($result); echo "</pre>";

					if (!empty($result['results'])) {
						$lat = $result['results'][0]['geometry']['location']['lat'];
						$long = $result['results'][0]['geometry']['location']['lng'];
						$this->User->recursive = 2;
						$this->User->virtualFields['distance'] = "get_distance_in_miles_between_geo_locations($lat,$long,User.latitude,User.longitude)";
						$user = $this->User->find('all', array(
							"fields" => array(
								"get_distance_in_miles_between_geo_locations($lat,$long,User.latitude,User.longitude) as distance",
								"User.*"
							) ,
							"conditions" => array(
								"OR" => array(
									"User.distance <=" => 2.5,
									"User.distance" => null
								) ,
								'User.active' => 1,
								'User.subscription_status' => 'subscribed'
							) ,

							// "conditions" => array("User.distance <=" => 10, 'User.active' => 1, 'User.subscription_status' => 'subscribed'),

							'order' => $order
						));
					}
					else {
						$user = array();
					}

					// echo "<pre>"; print_r($user); echo "</pre>";

					/************************/

					// $user = $this->User->find('first', array('conditions' => array('User.id' => $service['Service']['user_id'], 'User.location' => $this->request->data["location"], 'User.active' => 1, 'User.subscription_status' => 'subscribed'), 'order' => $order));

				}
				else {
					$this->User->recursive = 2;
					$user = $this->User->find('first', array(
						'conditions' => array(
							'User.id' => $service['Service']['user_id'],
							'User.active' => 1,
							'User.subscription_status' => 'subscribed'
						) ,
						'order' => $order
					));
				}

				if (isset($this->request->data["location"])) {
					foreach($user as $use) {
						if (in_array($use['User']['id'], $service_users)) {
							$unavalaibility = array();
							$availability = $this->Unavailability->find('all', array(
								'conditions' => array(
									'Unavailability.userid' => $use['User']['id']
								)
							));
							// if (!empty($availability)) {
							// 	foreach($availability as $datas) {
							// 		$unavalaibility[] = $datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourfrom'];
							// 	}
							// }

							// if (!in_array($use['User']['id'], $users) && !empty($user)) {
							// 	if (!in_array($date, $unavalaibility)) {
							// 		$users[] = $use['User']['id'];
							// 		$salons[] = $use;
							// 	}
							// }

							if (!empty($availability)) {

								$day = strtolower(date('l', strtotime($date)));

								$search_time = strtotime(date('h:i a', strtotime($date)));

								foreach($availability as $datas) {
									if (!in_array($service['Service']['user_id'], $users) && !empty($user)) {
										//if (!in_array($date, $unavalaibility)) {

										// echo $datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourfrom'].'<br>';

										// echo $datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourto'].'<br>';
										// echo '=========<br>';

										$from = strtotime($datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourfrom']);
										$to = strtotime($datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourto']);

										if(strtotime($date) < $from || strtotime($date) > $to){	
											if($use['User'][$day.'_timing_from'] != ''){
												if($search_time > strtotime($use['User'][$day.'_timing_from']) || $search_time < strtotime($use['User'][$day.'_timing_to'])){
													$users[] = $use['User']['id'];
													$salons[] = $use;
												}else{
													$users[] = $use['User']['id'];
												}
											}
											else{
												$users[] = $use['User']['id'];
											}
										}else{
											$users[] = $use['User']['id'];
										}
									}
								}
							}
						}
					}

				}
				else {
					$unavalaibility = array();
					$availability = $this->Unavailability->find('all', array(
						'conditions' => array(
							'Unavailability.userid' => $service['Service']['user_id']
						)
					));
					// if (!empty($availability)) {
					// 	foreach($availability as $datas) {
					// 		$unavalaibility[] = $datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourfrom'];
					// 	}
					// }

					// if (!in_array($service['Service']['user_id'], $users) && !empty($user)) {
					// 	if (!in_array($date, $unavalaibility)) {
					// 		$users[] = $user['User']['id'];
					// 		$salons[] = $user;
					// 	}
					// }


					if (!empty($availability)) {

						$day = strtolower(date('l', strtotime($date)));

						$search_time = strtotime(date('h:i a', strtotime($date)));

						foreach($availability as $datas) {
							if (!in_array($service['Service']['user_id'], $users) && !empty($user)) {
								//if (!in_array($date, $unavalaibility)) {

								// echo $datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourfrom'].'<br>';

								// echo $datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourto'].'<br>';
								// echo '=========<br>';

								$from = strtotime($datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourfrom']);
								$to = strtotime($datas['Unavailability']['date'] . ' ' . $datas['Unavailability']['hourto']);

								if(strtotime($date) < $from || strtotime($date) > $to){	
									if($use['User'][$day.'_timing_from'] != ''){
										echo 'if1';
										if($search_time > strtotime($use['User'][$day.'_timing_from']) || $search_time < strtotime($use['User'][$day.'_timing_to'])){
											$users[] = $use['User']['id'];
											$salons[] = $use;
										}else{
											$users[] = $use['User']['id'];
										}
									}
									else{
										$users[] = $use['User']['id'];
									}
								}else{
									$users[] = $use['User']['id'];
								}
							}
						}
					}


				}
			}
		}

		// echo "<pre>"; print_r($salons); echo "</pre>";

		$this->set('service_array', $service_array);
		$this->set('selected_location', $this->request->data['location']);
		if (isset($this->request->data['category'])) {
			$this->set('selected_category', $this->request->data['category']);
		}
		elseif (isset($this->params['url']['category'])) {
			$this->set('selected_category', $this->params['url']['category']);
		}

		if (isset($this->request->data['sortby'])) {
			$sortby = $this->request->data['sortby'];
		}
		else {
			$sortby = '';
		}

		$this->set('sortby', $sortby);
		$this->set('salons', $salons);
		$this->set('count', count($salons));
		$this->loadModel('Service');
		$services = $this->Service->find('all', array(
			'conditions' => array(
				'Service.status' => 1
			) ,
			'group' => 'Service.name',
		));
		$this->set('services', $services);
		$locations = $this->User->find('all', array(
			'conditions' => array(
				'User.active' => 1,
				'User.role' => 'freelancer'
			) ,
			'fields' => array(
				'DISTINCT User.location'
			)
		));
		$this->set('locations', $locations);


    }







    







    public function ajaxgetCategories(){







        $this->loadModel('Category');







        $categories = $this->Category->find('all', array('conditions'=>array('Category.name LIKE'=>'%'.$this->request->data["value"].'%')));







        







        echo json_encode($categories);







        exit;







    }

	

	

	public function ajaxgetServices(){







        $this->loadModel('Service');







        $services = $this->Service->find('all', array('conditions'=>array('Service.name LIKE'=>'%'.$this->request->data["value"].'%')));



		$new_services = array();
		
		$repeated = array();
		

		foreach($services as $service){
			
			if(!in_array(trim($service['Service']['name']), $repeated)){
				$new_services[]['Service']['name'] = $service['Service']['name'];
				$repeated[] = trim($service['Service']['name']);
			}
			
		}
		
        echo json_encode($new_services);
        exit;


    }




    public function ajaxgetLocations(){







        $this->loadModel('User');







        $locations = $this->User->find('all', array('conditions'=>array('User.location LIKE'=>'%'.$this->request->data["value"].'%', 'User.role' => 'freelancer'), 'fields' => array('DISTINCT User.location')));







        







        echo json_encode($locations);







        exit;







    }







 







    public function storeinformation($id){







        Configure::write("debug", 0);



        



        //$this->Session->delete('Shop');



        



        $this->loadModel("User");







        $this->loadModel("Category");







        $decodeid = base64_decode($id);







        $id = substr($decodeid,4);





        $data = $this->User->find("first", array("conditions" => array("User.id" => $id)));



		



        $gallery = explode(",", $data['User']['gallery_img']);







         //echo '<pre>'; print_r($gallery); echo '</pre>'; die;







        $this->set('gallery', $gallery);



        $this->set('data', $data);



        $this->set('gallerycount', count($gallery));



        $this->Category->recursive = 2;



        $categories = $this->Category->find("all");



        $this->set('categories', $categories);



        $this->set('user_id', $id);



        



        $cart = array();



        



        if($this->Session->check('Shop.OrderItem')){



            



            $cart_data = $this->Session->read('Shop.OrderItem');



            



            foreach($cart_data as $data){



                $cart[] = $data['service_id'];



            }



        }



        $this->set('cart', $cart);

		

		

		

		$this->loadModel('Review');

		

		

		$this->Review->recursive = 2;

		$reviews = $this->Review->find('all', array('conditions' => array('Review.salon_id' => $id)));

		

		

		$this->set('reviews', $reviews);

		



	//echo '<pre>'; print_r($categories); echo '</pre>'; die;



		$this->set('salon_id', $id);
    
	}







    /*public function ajaxavailable(){



        Configure::write("debug", 2);



        //$date = "19-05-2017";



        //$userid = "151";



        



        //echo '<pre>'; print_r($this->request->data); echo '</pre>'; exit;



        



        $date = $this->request->data['date'];



        $userid = $this->request->data['user_id'];



        $day = $this->request->data['day'];



        $day = strtolower($day);



        



        



        $this->loadModel("Unavailability");



        $this->loadModel("User");



        



        $orignal = array();



        



        $datematch = $this->User->find("first", array("conditions" => array( "User.id" => $userid)));



        



//        if($day == 'Monday' || $day == 'Tuesday' || $day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday'){



//            $from = $datematch['User']['working_hourfrom'];



//            $to = $datematch['User']['working_hour'];



//        }elseif($day == 'Saturday' || $day == 'Sunday'){



//            $from = $datematch['User']['working_hour2from'];



//            $to = $datematch['User']['working_hour2'];



//        }



        



        $from = $datematch['User'][$day.'_timing_from'];



        $to = $datematch['User'][$day.'_timing_to'];



        



        $html = '';



        



        if($from != '' && $to != ''){



        



            $time1 = strtotime($from);



            $time2 = strtotime($to);



            if($time2 < $time1) {



                    $time2 += 24 * 60 * 60;



            }



            $time =  ($time2 - $time1) / 60; 



            $hours = $time/60;



            /////////////////////////////////////////////////







            $from_new = explode(':', $from);



            $from_new_new = explode(' ', $from_new[1]);



            $from_ampm = explode(' ', $from);











            $to_new = explode(':', $to);



            $to_new_new = explode(' ', $to_new[1]);



            $to_ampm = explode(' ', $to);







            $original = array();







            $print = $from_new[0];



            for($i = 0; $i <= $hours; $i++){



                for($j = $from_new_new[0]; $j <= 45; $j+=15){



                    if($print == 13){



                            $print = 1;



                    }



                    $f = $j;



                    $new_print = $print;



echo $new_print.'<br>';



                    if($new_print < '10'){



                        if (strpos($new_print, '0') === false) {



                            $new_print = '0'.$new_print;



                        }



                    }







                    if($j == '0'){



                    $j = '00';



                    }







                    if($i > 0){



                        if($new_print == '12' && $f >= '00'){



                            if($from_new_new[1] == 'am'){



                                    $from_ampm[1] = 'pm';



                            }else{



                                    $from_ampm[1] = 'am';



                            }	



                        }



                    }	











                    $orignal[] = $new_print.':'.$j.' '.$from_ampm[1];







                    if($j == 45){



                        $from_new_new[0] = 00;



                    }







                    if($to_new[0] == $new_print && $f == $to_new_new[0]){



                        break;



                    }



                }



                $print++;







            }



            $dateunavailable = $this->Unavailability->find("all", array("conditions" => array('AND' => array("Unavailability.date" => $date, "Unavailability.userid" => $userid))));







            foreach($orignal as $dateuna){



                    $html .= '<li>'.$dateuna.'</li>';



            }



        }    



        



	echo $html;



        exit;



    }*/  



		public function ajaxavailable(){

			

			$date = $this->request->data['date'];



			$userid = $this->request->data['user_id'];

	

			$day = $this->request->data['day'];

	

			$day = strtolower($day);

	

			

	

			

	

			$this->loadModel("Unavailability");

	

			$this->loadModel("User");

	

			

	

			$orignal = array();

			

			$html = '';

			

			$free_time = array();

			$unavailable_time = array();



			$datematch = $this->User->find("first", array("conditions" => array( "User.id" => $userid)));

			

			

			$from = $datematch['User'][$day.'_timing_from'];



        	$to = $datematch['User'][$day.'_timing_to'];

			

			$finish_time  = DATE("H:i:s", strtotime($to));

			

			$start_time  = DATE("H:i:s", strtotime($from));

			

			$finish = strtotime(date($finish_time));

			$k =-15;

			for($i=1; $i<=96;$i++){

			 $k+=15;

			 $selectedTime = date($start_time);

			 $endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

			 if($finish<$endTime){

			  break;

			 }

			 $html .= date('h:i a', $endTime);

			 $times = '';

			 $free_time[] = date('h:i a', $endTime);

			}

			

			$dateunavailable = $this->Unavailability->find("all", array("conditions" => array('AND' => array("Unavailability.date" => $date, "Unavailability.userid" => $userid))));

			

			

			for($x=0; $x<count($dateunavailable); $x++){

			

				$unfrom = $dateunavailable[$x]['Unavailability']['hourfrom'];

				

				$unto = $dateunavailable[$x]['Unavailability']['hourto'];

				

				$finish_time  = DATE("H:i:s", strtotime($unto));

				

				$start_time  = DATE("H:i:s", strtotime($unfrom));

				

				$finish = strtotime(date($finish_time));

				

				$k =-15;

				

				for($i=1; $i<=96;$i++){

				

					$k+=15;

					$selectedTime = date($start_time);

					$endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

					if($finish<$endTime){

						break;

					}

					

					$unavailable_time[] = date('h:i a', $endTime);

				

				}

			}

			

			$this->loadModel('Order');

			

			$orders = $this->Order->find('all', array('conditions' => array('Order.booking_date' => $date, 'Order.salon_id' => $userid, 'Order.service_status' => 'pending', 'Order.status' => '1')));

				//print_r($orders); exit;

			for($j=0; $j<count($orders); $j++){

			

				$ofrom = $orders[$j]['Order']['start_time'];

				

				$oto = $orders[$j]['Order']['end_time'];

				

				$ofinish_time  = DATE("H:i:s", strtotime($oto));

				

				$ostart_time  = DATE("H:i:s", strtotime($ofrom));

				

				$ofinish = strtotime(date($ofinish_time));

				

				$k =-15;

				

				for($i=1; $i<=96;$i++){

				

					$k+=15;

					$oselectedTime = date($ostart_time);

					$oendTime = strtotime("+".$k." minutes", strtotime($oselectedTime));

					if($ofinish<$oendTime){

						break;

					}

					

					$unavailable_time[] = date('h:i a', $oendTime);

				

				}

			}

			$ctime = date("H:i:s");
    		$limit_time = date("h:i a", floor(strtotime($ctime) / 15 / 60) * 15 * 60);

			$gp_time = count($free_time);
			$done = 0;

			if(in_array($limit_time, $free_time)){
				$done = 0;
			}else{
				$done = 1;
			}

			if($gp_time > '1'){
				for($i = 0; $i<count($free_time); $i++){
	
					if(!in_array($free_time[$i], $unavailable_time)){
						
						if($done == 1){	

							$class = ' class="free_time"';

						}

						if($done == 0){

							if($limit_time == $free_time[$i]){
								$done = 1;
							}

							$class = ' style="background: rgb(128, 128, 128);"';

						}

					}else{
	
						$class = ' style="background: rgb(128, 128, 128);"';
	
					}
	
					
	
					$times .= '<li'.$class.'>'.$free_time[$i].'</li>';
	
					
	
				}
			}	else{
				$times .= '<div class="alert alert-danger"><strong>Not Working</strong></div>';
			}

			

			echo $times;

			exit;			

		}



        



       public function ajaxunavailable(){



           



           //echo '<pre>'; print_r($this->request->data); echo '</pre>'; exit;



           



        $date = $this->request->data['date'];



        $userid = $this->request->data['user_id'];



        $day = $this->request->data['day'];



        



        $this->loadModel("Unavailability");



        $this->loadModel("User");



        



           $dateunavailable = $this->Unavailability->find("all", array("conditions" => array('AND' => array("Unavailability.date" => $date, "Unavailability.userid" => $userid))));



           



           if($dateunavailable){



                echo json_encode($dateunavailable);



           }else{



               echo json_encode('nodata');



           }



           exit;



       }    



	   



	   /*public function ajaxgetbooking(){



	   		$date = $this->request->data['date'];



        	$userid = $this->request->data['user_id'];



			



			$this->loadModel("User");



			$this->loadModel("Order");



			



			$bookings = $this->Order->find("all", array("conditions" => array('AND' => array("Order.booking_date" => $date, "Order.salon_id" => $userid))));



			

			echo "<pre>"; print_r($bookings); echo "</pre>";

			exit;



	   }*/

		

		

		public function datetime(){

			$finish = strtotime(date("22:00:00"));

			$k =-15;

			for($i=1; $i<=96;$i++){

			 $k+=15;

			 $selectedTime = date("08:00:00");

			 $endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

			 if($finish<$endTime){

			  break;

			 }

			 echo date('h:i a', $endTime)."<br>";

			}

			

			echo date("H:i:s", strtotime("04:25 PM"));

			

		}

		

		public function bussinesslist(){

		

		

		}

		

		public function admin_recommendations(){

			$this->loadModel('User');

			

			$salons = $this->User->find('all', array('conditions' => array('User.recommended' => 1)));

			

			$this->set('salons', $salons);

		}

		

}







?>

