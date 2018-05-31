<?php

/**

* Application level Controller

*

* This file is application-wide controller file. You can put all

* application-wide controller-related methods here.

*

* PHP 5

*

* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)

* Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)

*

* Licensed under The MIT License

* Redistributions of files must retain the above copyright notice.

*

* @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)

* @link          http://cakephp.org CakePHP(tm) Project

* @package       app.Controller

* @since         CakePHP(tm) v 0.2.9

* @license       MIT License (http://www.opensource.org/licenses/mit-license.php)

*/

ini_set('memory_limit', '-1'); 

App::uses('Controller', 'Controller');

App::import('Vendor', 'Google', array('file' => 'Google' . DS . 'autoload.php'));



/**

* Application Controller

*

* Add your application-wide methods in the class below, your controllers

* will inherit them.

*

* @package       app.Controller

* @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller

*/

ob_start();

class AppController extends Controller {



////////////////////////////////////////////////////////////



    public $components = array(

        'Session',

        'Auth',

        'DebugKit.Toolbar',

        'Flash',

        'Ctrl'

        //'Security',

    );



////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////

    public function beforeFilter() {
	
		
		if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
			 $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => true);
		}else{
			$this->Auth->logoutRedirect = array('controller' => 'shop', 'action' => 'index', 'admin' => false);
		}

        $this->Auth->loginRedirect = array('controller' => 'dashboards', 'action' => 'dashboard', 'admin' => true);

		if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
			$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login', 'admin' => true);
		}else{
			$this->Auth->logoutRedirect = array('controller' => 'shop', 'action' => 'index', 'admin' => false);
		}

        $this->Auth->authorize = array('Controller');

		

        $this->Auth->authenticate = array(

            'Form' => array(

                'userModel' => 'User',

                'fields' => array(

                    'username' => 'username',

                    'password' => 'password'

                ),

                'scope' => array(

                    'User.active' => 1,

                )

            )

        );



        if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {

            if($this->Session->check('Auth.User')) {

                $this->set('authUser', $this->Auth->user());

                $loggedin = $this->Session->read('Auth.User');

                $this->set(compact('loggedin'));

                $this->layout = 'dashboard';

            }

        } elseif(isset($this->request->params['customer']) && ($this->request->params['prefix'] == 'customer')) {

            if($this->Session->check('Auth.User')) {

                $this->set('authUser', $this->Auth->user());

                $loggedin = $this->Session->read('Auth.User');

                $this->set(compact('loggedin'));

                $this->layout = 'customer'; 

            }

        } else {

            $this->Auth->allow();

        }

		

		

		

	$user_id = $this->Auth->user('id');

        $this->set("loggeduser", $user_id);

        $this->set("loggedusername", $this->Auth->user('name'));

        $user_role = $this->Auth->user('role');



        $this->set("loggedUserRole", $user_role);

		

        $this->set("loggedname", $this->Auth->user('first_name'));

        

        $this->loadModel('User');

        

        $user_data = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

        

        $this->set('user_data', $user_data);

		////////////google login/////////////////////

				

			     $client_id = '323825392115-9na4km0k8v5ephvkmcspb51hjf10ks8r.apps.googleusercontent.com';

        $client_secret = 'ZeKh2Vo1XzZcA1czA8LcZqlc';

        $redirect_uri = 'http://rupak.crystalbiltech.com/shop/users/google_login/';



//        $client = new Google_Client();

//        $client->setClientId($client_id);

//        $client->setClientSecret($client_secret);

//        $client->setRedirectUri($redirect_uri);

//        $client->addScope("email");

//        $client->addScope("profile");

//

//        $service = new Google_Service_Oauth2($client);

//

//        $authUrl = $client->createAuthUrl();

//        // $this->Session->write('googlelogin', $authUrl);

//        $this->set(compact('authUrl'));

                        

        

        $this->loadModel('Link');

        

        $this->Link->find('all');

        

        $all_links = $this->Link->find('all');

        

        $this->set('all_links', $all_links);

        

        

        /*******************************************************/

        

        $this->loadModel('Category');

        $cat = $this->Category->find('all', array('conditions' => array('Category.status' => '1')));

        //print_r($cat);

        $this->set('cat',$cat);

       

        /*********************************************************/

        

        $shop = $this->Session->read('Shop');

        $this->set('shop',$shop);
        

        /*********************************************************/

        

        $item_count = $this->Session->read('Shop.Count');

        $this->set('item_count',$item_count);

        

        /********************************************************/

		

		$cart_salon_id = $this->Session->read('Shop.Salon');

		$this->set('cart_salon_id',$cart_salon_id);
		
		$cart_salon_date = $this->User->find('first', array('conditions' => array('User.id' => $cart_salon_id)));

		$this->set('cart_salon_date',$cart_salon_date);
		
		if(!empty($cart_salon_date)){
			$sub_date = date("m-d-Y", strtotime($cart_salon_date["User"]["subscribe_date"]));
			$exp_date = date("m-d-Y", strtotime($cart_salon_date["User"]["expire_date"]));
		}else{
			$sub_date = '';
			$exp_date = '';
		}
		
		$this->set('sub_date',$sub_date);
		$this->set('exp_date',$exp_date);
		
		/********************************************************/

		

		$this->Session->write('current_controller', $this->name);

		$this->Session->write('current_action', $this->action);
		
		
		/*******************************************************/
		
		
		$this->loadModel('Staticpage');

        $pages = $this->Staticpage->find('all', array('conditions' => array('Staticpage.status' => 1)));

        $this->set('pages',$pages);
		
		
		
		/*******************************************************/
		
		
		$this->loadModel('Order');

        $apporders = $this->Order->find('count', array('conditions' => array('Order.status' => 1)));

        $this->set('apporders',$apporders);
		
		
		/*******************************************************/


        $freelancers_count = $this->User->find('count', array('conditions' => array('User.role' => 'freelancer', 'User.active' => 1)));

        $this->set('freelancers_count',$freelancers_count);
		
		$freelancers = $this->User->find('all', array('conditions' => array('User.role' => 'freelancer', 'User.active' => 1), 'limit' => 5));

        $this->set('freelancers',$freelancers);
		
		
		/*******************************************************/


        $customers_count = $this->User->find('count', array('conditions' => array('User.role' => 'customer', 'User.active' => 1)));

        $this->set('customers_count',$customers_count);
		
		$customers = $this->User->find('all', array('conditions' => array('User.role' => 'customer', 'User.active' => 1), 'order' => array('User.id DESC'), 'limit' => 8));

        $this->set('customers',$customers);
		
		/*******************************************************/

		$this->loadModel('Service');

        $services_count = $this->Service->find('count');

        $this->set('services_count',$services_count);
		
		/*******************************************************/
		
		$this->set('base_url', Router::fullbaseUrl() . '/spa');
		
    }

    
	public function baseurl() {
        return Router::fullbaseUrl() . '/dhdeals2';
    }
	

//	function afterFilter() {

//    if ($this->response->statusCode() == '404')

//    {

//        $this->redirect(array(

//            'controller' => 'errors',

//            'action' => 'error404', 404),404

//        );

//    }

//}

////////////////////////////////////////





////////////////////////////////////////////////////////////



   public function isAuthorized($user) {

        if (($this->params['prefix'] === 'admin') && ($user['role'] != 'admin') && ($user['role'] != 'rest_admin')) {

            echo '<a href="' . $this->webroot . '/users/logout">Logout</a><br />';

            die('Invalid request for ' . $user['role'] . ' user.');

        }

        if (($this->params['prefix'] === 'customer') && ($user['role'] != 'customer')) {

            echo '<a href="' . $this->webroot . '/users/logout">Logout</a><br />';

            die('Invalid request for ' . $user['role'] . ' user.');

        }



        if ($this->Auth->user('role') == 'rest_admin') {

            $authorized_pages = $this->Ctrl->getList();

            // print_r($authorized_pages);

            $resadmin_access_controller = array('restaurants','addrestaurants','order_items','categories', 'orders','products','dashboards' ,'picodes', 'dish_categories', 'dish_subcats','times','reviews');

            foreach ($authorized_pages as $ct) {

                $contrl[] = strtolower(str_replace(' ', '_', $ct['displayName']));

            }

            $contrl_a = array_diff($contrl, $resadmin_access_controller);

            $this->set("authocss", $contrl_a);

            if (in_array($this->params['controller'], $contrl_a)) {

                $unAuthorized = "Unauthorized Access";

                $this->set(compact('unAuthorized'));

                $this->set("authorized_pages", $authorized_pages);

                $this->render('/Pages/unauthorized');

            }

        }



        if ($this->Auth->user('role') == 'admin') {

            $this->loadModel('Userpermission');

            $AuthPermission = $this->Userpermission->find('first', array('conditions' => array('Userpermission.user_id' => $this->Auth->user('id'))));

            //print_r($AuthPermission);

            if ($AuthPermission) {

                $authorized_pages = unserialize($AuthPermission['Userpermission']['view_pages']);

                // map array values to lower case as controller name is in lower case

                $authorized_pages = array_map('strtolower', $authorized_pages);     

                $this->set("loggedUserRole", $this->Auth->user('role'));

                $this->set("authocss", $authorized_pages);

//                if (!in_array($this->params['controller'], $authorized_pages)) {

//                    $unAuthorized = "Unauthorized Access";

//                    $this->set(compact('unAuthorized'));

//                    $this->render('/Pages/unauthorized');

//                }

            }

        }



        return true;

    }



////////////////////////////////////////////////////////////



    public function admin_switch($field = null, $id = null) {

        $this->autoRender = false;

        $model = $this->modelClass;

        if ($this->$model && $field && $id) {

            $field = $this->$model->escapeField($field);

            return $this->$model->updateAll(array($field => '1 -' . $field), array($this->$model->escapeField() => $id));

        }

        if(!$this->RequestHandler->isAjax()) {

            return $this->redirect($this->referer());

        }

    }



////////////////////////////////////////////////////////////



    public function admin_editable() {



        $model = $this->modelClass;



        $id = trim($this->request->data['pk']);

        $field = trim($this->request->data['name']);

        $value = trim($this->request->data['value']);



        $data[$model]['id'] = $id;

        $data[$model][$field] = $value;

        $this->$model->save($data, false);



        $this->autoRender = false;



    }



////////////////////////////////////////////////////////////



    public function admin_tagschanger() {



        $value = '';



        asort($this->request->data['value']);



        foreach ($this->request->data['value'] as $k => $v) {

            $value .= $v . ', ';

        }



        $value = trim($value);

        $value = rtrim($value, ',');





        $this->Product->id = $this->request->data['pk'];

        $s = $this->Product->saveField('tags', $value, false);



        $this->autoRender = false;



    }

    





////////////////////////////////////////////////////////////



}

