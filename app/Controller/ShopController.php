<?php

App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

class ShopController extends AppController {



//////////////////////////////////////////////////



    public $components = array(

        'Cart',

        'Paypal',

        'AuthorizeNet'

    );

    

    public $distance = 7;



//////////////////////////////////////////////////



    public $uses = 'Product';



//////////////////////////////////////////////////



    public function beforeFilter() {

        parent::beforeFilter();

        $this->disableCache();

        

        $this->Auth->allow('api_displaycart','removeappcart','api_cartupdate','api_checkout');    

        //$this->Security->validatePost = false;

    }



//////////////////////////////////////////////////

 

    public function clear() {  

         $sesid = $this->Session->id();

	$uid=$this->Auth->user('id');

        $this->Cart->clear();

        $this->loadModel('Cart');  

        //$this->Session->delete('order_item_count'); 

        $this->Session->delete('cart_count');

	$this->Cart->deleteAll(array('Cart.uid'=>$uid,'Cart.sessionid'=>$sesid));

        $this->Session->setFlash('All item(s) removed from your shopping cart', 'flash_error');

        return $this->redirect('/');

    }



//////////////////////////////////////////////////

     public function index() {  
	 
	 Configure::write('debug', 2);

		$this->loadModel('User');
		
		$this->User->recursive = 2;
		$recommendations = $this->User->find('all', array('conditions' => array('User.recommended' => 1, 'User.active' => 1, 'User.subscription_status' => 'subscribed')));
		
		$this->set('recommendations', $recommendations);  
		
		
		$this->loadModel('Category');
		$categories = $this->Category->find('all', array('conditions' => array('Category.status' => 1)));
		
		$this->set('categories', $categories);         


    }




//////////////////////////////////////////////////



    public function update() {

        $this->Cart->update($this->request->data['Product']['id'], 1);

    }



//////////////////////////////////////////////////



    public function address() {

configure::write('debug', 2);

        $shop = $this->Session->read('Shop');

        if(!$shop['Booking_date']) {

            return $this->redirect('/');

        }



        if ($this->request->is('post')) {

            

            

            $this->request->data['Order']['salon_id'] = $this->Session->read('Shop.Salon');



			$price = str_replace(",", "", $this->Session->read('Shop.Price'));

			

			$this->request->data['Order']['total'] = $this->Session->read('Shop.Price');

			

            $this->request->data['Order']['paypal_price'] = number_format(5, 2);

            $this->request->data['Order']['pending_price'] = number_format(($price - $this->request->data['Order']['paypal_price']), 2);

            $this->request->data['Order']['ip_address'] = $_SERVER['REMOTE_ADDR'];

            $this->request->data['Order']['order_item_count'] = $this->Session->read('Shop.Count');

            

            

            echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;

            

            $this->loadModel('Order');

            $this->Order->set($this->request->data);

            if($this->Order->validates()) {

                $order = $this->request->data['Order'];

                //$order['order_type'] = 'creditcard';

                 //$order['order_type'] = 'paypal';

                

                //$this->Session->write('Shop.Order', $order + $shop['Order']);

                return $this->redirect(array('action' => 'review'));

                // return $this->redirect(array('action' => 'address?panel=2'));

                

            } else {

                $this->Session->setFlash('The form could not be saved. Please, try again.', 'flash_error');

            }

        }

        if(!empty($shop['Order'])) { 

            $this->request->data['Order'] = $shop['Order'];

        }

        

              $this->set(compact('shop')); 

        

    }



//////////////////////////////////////////////////



//////////////////////////////////////////////////



     

      public function ipn() { 

        $fc = fopen('files/ipn.txt', 'wb');

        ob_start();

        print_r($this->request);

        $req = 'cmd=' . urlencode('_notify-validate');

        foreach ($_POST as $key => $value) {

            $value = urlencode(stripslashes($value));

            $req .= "&$key=$value";

        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.sandbox.paypal.com/cgi-bin/webscr');

        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.developer.paypal.com'));

        $res = curl_exec($ch);

        curl_close($ch);

        if (strcmp($res, "VERIFIED") == 0) {

            $custom_field = $_POST['custom'];

            $payer_email = $_POST['payer_email'];

            $trn_id = $_POST['txn_id'];

			$payment_status = $_POST['payment_status'];

            $this->loadModel('Order');

            $this->Order->query("UPDATE `orders` SET `status` = 1, `paypal_status` = '$res',`paypal_transaction_id`='$trn_id', `payment_status` = '$payment_status' WHERE `id` ='$custom_field';");

            $l = new CakeEmail('smtp');

            $l->emailFormat('html')->template('default', 'default')->subject('Payment')->to($payer_email)->send('Payment Done Successfully');

            $this->set('smtp_errors', "none");

        } else if (strcmp($res, "INVALID") == 0) {

            

        }

        $xt = ob_get_clean();

        fwrite($fc, $xt);

        fclose($fc);

        $this->render('payment_confirm', 'ajax');

    }

    

    

    //////////////////////////////////////////



    public function success() {

	Configure::write('debug', 2);

        $shop = $this->Session->read('Shop');

		

        $this->Cart->clear();

		

		$order_id = $_GET['order_id'];

		$this->loadModel('Order');
		
		$this->Order->recursive = 2;
		$orderdata_email = $this->Order->find("first", array("conditions" => array("Order.id" => $order_id)));
		//echo "<pre>"; print_r($orderdata_email); echo "</pre>"; exit;
		$user_id = $orderdata_email['Order']['uid'];
		
		$customer_type = '';
		
		if($user_id != '0'){
			$previous_orders = $this->Order->find("all", array("conditions" => array("Order.uid" => $user_id, "Order.service_status" => "completed")));
			if(!empty($previous_orders)){
				$customer_type = 'Existing User';
			}else{
				$customer_type = 'First Appointment';
			}
		}else{
			$customer_type = 'Guest User';
		}
		
		$orderdata_email['customer_type'] = $customer_type;
          
		
		$l = new CakeEmail();   
		$l->emailFormat('html')->template('default','userorder')->subject('MTH Booking')
			->viewVars(array('orderdata_email' => $orderdata_email)) 
			//->viewVars(array('user' => $fu)) 
			->from(array('rahulsharma@avainfotech.com' => 'MTH'))
			->to($orderdata_email['Order']['email'])->send();
			
		$e = new CakeEmail();   
		$e->emailFormat('html')->template('default','adminorder')->subject('MTH Booking')
			->viewVars(array('orderdata_email' => $orderdata_email)) 
			//->viewVars(array('user' => $fu)) 
			->from(array('rahulsharma@avainfotech.com' => 'MTH'))
			->to($orderdata_email['Salon']['email'])->send();	
                
                $f = new CakeEmail();   
		$f->emailFormat('html')->template('default','superadminorder')->subject('MTH Booking (Admin)')
			->viewVars(array('orderdata_email' => $orderdata_email)) 
			//->viewVars(array('user' => $fu)) 
			->from(array('rahulsharma@avainfotech.com' => 'MTH'))
			->to('gurpreet@avainfotech.com')->send();	
							
		if($order_id != '0'){

			$this->Order->updateAll(array('Order.status' => '1'), array('Order.id' => $order_id));

		}

		

        /*if(empty($shop)) { 

            return $this->redirect('/');

        }*/

  

    }

    

    /*************************************************/

    /*********      Saloon site data    **************/

    /*************************************************/

    

    

    public function ajaxaddtocart(){

        //print_r($this->request->data);exit;

     

        $service_id = $this->request->data['service_id'];



        if($this->Session->check('Shop')){

            

            $salon = $this->Session->read('Shop.Salon');

            

            if($salon == $this->request->data['user_id']){

                $this->Cart->add($service_id, $this->request->data);

                echo 'added';

                exit;

            }else{

                echo 'notadded';

                exit;

            }

        }else{

            $this->Cart->add($service_id, $this->request->data);

            echo 'added';

            exit;

        }

    } 

    

    public function ajaxremovefromcart(){

        //print_r($this->request->data);exit;

     

        $service_id = $this->request->data['service_id'];



        $this->Cart->remove($service_id);

        

        echo 'removed';

        

        exit;

    }

    

    public function getCartitems(){

        

        $cart_data = array();

        

        if($this->Session->check('Shop.OrderItem')){

            $cart_data = $this->Session->read('Shop');

        }

        

        echo json_encode($cart_data);

        exit;

    }

    

    public function getCartCount(){

        

        $cart_count = 0;

        

        

        if($this->Session->check('Shop.OrderItem')){

            $cart_count = $this->Session->read('Shop.Count');

        }

        

        echo $cart_count;

        exit;

    }

    

    public function deleteCartData(){

        

        $this->Session->delete('Shop');

        exit;

    }

    

    public function selectCartDate(){

        //print_r($this->request->data); exit;

        

        $from = $this->request->data['from_time'];

        $minutes = $this->request->data['minutes'];

        

        $endtime = date('h:i a', strtotime("+".$minutes." minutes", strtotime($from)));  



        $time = strtotime($endtime);

        $round = 15*60;

        $rounded = round($time / $round) * $round;

        

        $end = date("h:i a", $rounded);

        

        $newminutes = ceil($minutes/15);

        

        $endtime = $from;

        

        $data[] = $endtime;

        

        for($i = 1; $i <= $newminutes; $i++){

            

           

            $endtime = date('h:i a', strtotime("+15 minutes", strtotime($endtime)));

            

             $data[] = $endtime;

            

        }

        

        echo json_encode($data);

        

        exit;

    }

    

    public function addDateTimeInCart(){

        

        $this->Cart->adddatetime($this->request->data);

        

        echo 'success';

        exit;

    }

	

	public function getCartSalonId(){

		$salon_id = $this->Session->read('Shop.Salon');

		

		echo $salon_id;

		exit;

	}

	

	public function checkout(){

		$shop = $this->Session->read('Shop');

        if(!$shop['Booking_date']) {

            return $this->redirect('/');

        }

		

		$this->loadModel('User');

		$salon = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Shop.Salon'))));

		

		$this->set('salon', $salon);

		

	}

	

	public function addCartUser(){

		if($this->request->is('post')){

			$this->Session->write('Shop.Guest.first_name', $this->request->data['first_name']);

			$this->Session->write('Shop.Guest.last_name', $this->request->data['last_name']);

			$this->Session->write('Shop.Guest.email', $this->request->data['email']);

			$this->Session->write('Shop.Guest.phone', $this->request->data['phone']);

			

			echo 'success';

			exit;

			

		}

	}
	
	public function ajaxGetOrderBookings(){
	
		$data = '';
	
		if($this->request->is('post')){
		
			$date = $this->request->data['date'];
			$salon_id = $this->request->data['salon_id'];
		
			$this->loadModel('Order');
			
			$orders = $this->Order->find('all', array('conditions' => array('Order.booking_date' => $date, 'Order.salon_id' => $salon_id, 'Order.service_status' => 'pending', 'Order.status' => '1')));
			
			if(!empty($orders)){
				$data = json_encode($orders);			
			}else{
				$data = '';
			}
			
		}
		echo $data;
		exit;	
	}

	

	public function payment(){

	

		configure::write('debug', 2);

	

		$shop = $this->Session->read('Shop');

        if(!$shop['Booking_date']) {

            return $this->redirect('/');

        }

		

		if(isset($shop['Guest'])){

			if(!$shop['Guest']['first_name'] && !$this->Auth->loggedIn()) {

				return $this->redirect('/');

			}	

		}		

		

		if($this->Auth->loggedIn()){

		

			$user_data = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

			

			$this->request->data['Order']['uid'] = $user_data['User']['id'];

			$this->request->data['Order']['first_name'] = $user_data['User']['first_name'];

			$this->request->data['Order']['last_name'] = $user_data['User']['last_name'];

			$this->request->data['Order']['email'] = $user_data['User']['email'];

			$this->request->data['Order']['phone'] = $user_data['User']['phone'];

			

		}

		

		if(isset($shop['Guest'])){

			if($shop['Guest']['first_name']){

				

				$this->request->data['Order']['first_name'] = $shop['Guest']['first_name'];

				$this->request->data['Order']['last_name'] = $shop['Guest']['last_name'];

				$this->request->data['Order']['email'] = $shop['Guest']['email'];

				$this->request->data['Order']['phone'] = $shop['Guest']['phone'];

				

			}

		}	

		

		

		$this->request->data['Order']['salon_id'] = $this->Session->read('Shop.Salon');



		$price = str_replace(",", "", $this->Session->read('Shop.Price'));

		

		$this->request->data['Order']['total'] = $price;

		

		$paypal_price = str_replace(",", "", number_format(5 * $this->Session->read('Shop.Count'), 2));

		

		$this->request->data['Order']['paypal_price'] = $paypal_price;

		$this->request->data['Order']['pending_price'] = number_format(($price - $this->request->data['Order']['paypal_price']), 2);

		$this->request->data['Order']['ip_address'] = $_SERVER['REMOTE_ADDR'];

		$this->request->data['Order']['order_item_count'] = $this->Session->read('Shop.Count');

		

		$this->request->data['Order']['booking_date'] = $this->Session->read('Shop.Booking_date');

		$this->request->data['Order']['start_time'] = $this->Session->read('Shop.Start_time');

		$this->request->data['Order']['end_time'] = $this->Session->read('Shop.End_time');

		

		$this->request->data['Order']['service_status'] = 'pending';

		

		//echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;

		

		$this->loadModel('Order');

		$this->loadModel('OrderItem');

		

		$orderitem = array();

		$this->Order->create();
		

		if($this->Order->save($this->request->data)){

			

			$last_id = $this->Order->getLastInsertId();

			

			$items = $this->Session->read('Shop.OrderItem');

			

			foreach($items as $item){

				

				$orderitem['OrderItem']['order_id'] = $last_id;

				$orderitem['OrderItem']['salon_id'] = $this->Session->read('Shop.Salon');

				$orderitem['OrderItem']['service_id'] = $item['service_id'];
				
				$orderitem['OrderItem']['category'] = $item['category'];

				$orderitem['OrderItem']['name'] = $item['service'];

				$orderitem['OrderItem']['time'] = $item['time'];

				$orderitem['OrderItem']['price'] = $item['price'];

				

				$this->OrderItem->create();

				$this->OrderItem->save($orderitem);

			}

			$price = $this->request->data['Order']['email'];
			
			
			$this->loadModel('User');
			
			$user = $this->User->find('first', array('conditions' => array('User.id' => $this->Session->read('Shop.Salon'))));
			

			///////////////////////////////////////////////payment////////////////////////////////////////////////

			echo ".<form name=\"_xclick\" action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">

			<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">

			<input type=\"hidden\" name=\"email\" value=\"$price\">

			<input type=\"hidden\" name=\"business\" value=\"rupak1-facilitator@avainfotech.com\">

			<input type=\"hidden\" name=\"currency_code\" value=\"GBP\">

			<input type=\"hidden\" name=\"custom\" value=\"$last_id\">

			<input type=\"hidden\" name=\"amount\" value=\"$paypal_price\">

			<input type=\"hidden\" name=\"return\" value=\"https://gurpreet.gangtask.com/cpanel/shop/success?order_id=$last_id\"> 

			<input type=\"hidden\" name=\"notify_url\" value=\"https://gurpreet.gangtask.com/cpanel/shop/ipn\"> 

			</form>";

			//                    exit;

			echo "<script>document._xclick.submit();</script>";

			////////////////////////////////////////////////////////////////////////////////////////////////////////

		}
	}
	
	public function newsletter_email(){
	
		$l = new CakeEmail();   
		$l->emailFormat('html')->template('default','newsletteremail')->subject('MTH')
			->from(array('rahulsharma@avainfotech.com' => 'MTH'))
			->to($this->request->data['email'])->send();
			
		echo 'Email Sent Successfully';
		exit;
	}
	
	public function testpage(){
		
	}
}

