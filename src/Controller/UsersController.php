<?php

namespace App\Controller;

//require_once(ROOT . 'vendor' . DS  . 'autoload.php');



use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use \Statickidz\GoogleTranslate;
use Twilio\Rest\Client;
//require_once('C:\xampp\htdocs\cakephp\trip2\vendor' . DS  . 'paypal' . DS  . 'adaptivepayments-sdk-php' . DS  . 'samples' . DS  . 'PPBootStrap.php');
use \PayPal\Types\AP\PayRequest;
use \PayPal\Types\AP\Receiver;
use \PayPal\Types\AP\ReceiverList;
use \PayPal\Types\Common\RequestEnvelope;
use \PayPal\Service\AdaptivePaymentsService;

//use \PayPal\inc\Configuration;

/**



 * Users Controller



 *



 * @property \App\Model\Table\UsersTable $Users



 *



 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])



 */
class UsersController extends AppController {

    public function beforeFilter(Event $event) {



        parent::beforeFilter($event);







        $this->Auth->allow(['index', 'add', 'login', 'home', 'forgot', 'reset', 'contact', 'language', 'ajaxSignup', 'fblogin', 'gplogin', 'changeLanguage', 'sendOtp', 'ajaxedit', 'fbconnect', 'paypaladaptive']);



        $this->authcontent();
    }

    /**



     * Index method



     *



     * @return \Cake\Http\Response|void



     */
    public function index() {





        $users = $this->paginate($this->Users);







        $this->set(compact('users'));



        $this->set('_serialize', ['users']);
    }

    /**



     * View method



     *



     * @param string|null $id User id.



     * @return \Cake\Http\Response|void



     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.



     */
    public function view($id = null) {



        $user = $this->Users->get($id, [
            'contain' => []
        ]);







        $this->set('user', $user);



        $this->set('_serialize', ['user']);
    }

    /**



     * Add method



     *



     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.



     */
    public function add() {




        return $this->redirect(['action' => 'home']);


        if ($this->Auth->user()) {



            return $this->redirect(['action' => 'home']);
        }







        $user = $this->Users->newEntity();







        if ($this->request->is('post')) {







            $post = $this->request->getData();



            //echo "<pre>"; print_r($post); echo "</pre>"; exit;



            $post['status'] = '1';



            $post['name'] = $post['first_name'] . ' ' . $post['last_name'];





            $user = $this->Users->patchEntity($user, $post);



            $new_user = $this->Users->save($user);



            if ($new_user) {



                if (isset($post['supplement'])) {

                    if ($post['supplement'] == 'yes' || $post['supplement'] == 'Contact me with more info') {



                        $ms = 'A new User has been registered recently with email ID <strong>' . $post['email'] . '</strong>';



                        $ms .= '<br>';



                        $ms .= '<table border="0"><tr><th scope="row" align="left">Name</th><td>' . $post['name'] . '</td></tr><tr><th scope="row" align="left">Email</th><td>' . $post['email'] . '</td></tr></table>';



                        $email = new Email('default');

                        $email->from(['gurpreet@avainfotech.com' => 'Trip'])
                                ->emailFormat('html')
                                ->template('default', 'default')
                                ->to('gurpreet@avainfotech.com')
                                ->subject('New User Registration')
                                ->send($ms);
                    }
                }





                $this->Flash->success(__('Registered Successfully.'));





                /*                 * ********************************* */

                /* 				 Login				 */

                /*                 * ********************************* */



                if (!filter_var($this->request->data['email'], FILTER_VALIDATE_EMAIL) === false) {



                    $this->Auth->config('authenticate', [
                        'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                    ]);



                    $this->Auth->constructAuthenticate();



                    $this->request->data['email'] = $this->request->data['email'];



                    //unset($this->request->data['username']);
                }



                $user = $this->Auth->identify();



                if ($user) {

                    $this->Auth->setUser($user);



                    return $this->redirect(['action' => 'edit', $new_user->id]);
                }



                /*                 * ********************************* */

                /* 			Login (END)				 */

                /*                 * ********************************* */





                //return $this->redirect(['action' => 'add']);
            } else {



                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }







        $this->set(compact('user'));



        $this->set('_serialize', ['user']);



        $this->loadModel('Countries');



        $countries = $this->Countries->find()->toArray();



        $this->set(compact('countries'));



        $this->set('_serialize', ['countries']);
    }

    /**



     * Edit method



     *



     * @param string|null $id User id.



     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.



     * @throws \Cake\Network\Exception\NotFoundException When record not found.



     */
    public function edit($id = null) {


        //print_r($this->request->session()->read('Auth.User'));
        // $current_user = $this->Users->find('all', ['conditions' => ['Users.id' => $this->Auth->user('id')]]);
        //    $current_user = $current_user->first()->toArray();
        //    print_r($current_user);


        $user = $this->Users->get($id, [
            'contain' => []
        ]);







        if ($this->request->is(['patch', 'post', 'put'])) {



            //echo "<pre>"; print_r($this->request->data); echo "</pre>"; exit;



            $post = $this->request->data;



            if ($this->request->data['image']['name'] != '') {



                if ($user->image != '') {

                    unlink(WWW_ROOT . 'images/users/' . $user->image);
                }



                $image = $this->request->data['image'];

                $name = time() . $image['name'];

                $tmp_name = $image['tmp_name'];

                $upload_path = WWW_ROOT . 'images/users/' . $name;

                move_uploaded_file($tmp_name, $upload_path);



                $post['image'] = $name;
            } else {

                unset($this->request->data['image']);

                $post = $this->request->data;
            }





            $post['name'] = $post['first_name'] . ' ' . $post['last_name'];

            if (!empty($post['languages'])) {
                $post['languages'] = implode(',', $post['languages']);
            } else {
                $post['languages'] = '';
            }


            $user = $this->Users->patchEntity($user, $post);



            if ($this->Users->save($user)) {

                $current_user = $this->Users->get($id, [
                    'contain' => []
                ]);

                $session = $this->request->session();

                $session->write('Auth.User.image', $current_user->image);


                $this->Flash->success(__('The user has been saved.'));
            } else {



                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }





        // $this->loadModel('Countries');
        // $countries = $this->Countries->find('all');
        // $countries = $countries->all();
        // $this->set(compact('countries'));



        $this->set(compact('user'));



        $this->set('_serialize', ['user']);

        $this->loadModel('Countries');



        $countries = $this->Countries->find()->toArray();



        $this->set(compact('countries'));



        $this->set('_serialize', ['countries']);
    }

    /**



     * Delete method



     *



     * @param string|null $id User id.



     * @return \Cake\Http\Response|null Redirects to index.



     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.



     */
    public function delete($id = null) {



        $this->request->allowMethod(['post', 'delete']);



        $user = $this->Users->get($id);



        if ($this->Users->delete($user)) {



            $this->Flash->success(__('The user has been deleted.'));
        } else {



            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }







        return $this->redirect(['action' => 'index']);
    }

    public function login() {



        if ($this->request->is('post')) {




            if ($this->request->data['username'] == '') {



                $response['isSucess'] = "false";



                $response['msg'] = "error_username";
            } else if ($this->request->data['password'] == '') {



                $response['isSucess'] = "false";



                $response['msg'] = "error_password!";
            } else {











                if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {



                    $this->Auth->config('authenticate', [
                        'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                    ]);



                    $this->Auth->constructAuthenticate();



                    $this->request->data['email'] = $this->request->data['username'];



                    unset($this->request->data['username']);
                }







                $user = $this->Auth->identify();



                if ($user) {



                    if ($user['status'] == 0) {



                        $this->Auth->logout();



                        $response['data'] = "no data";



                        // $response['user'] = $user['email_status'];



                        $response['isSucess'] = "false";



                        $response['msg'] = "You are not active yet";
                    } else {



                        $this->Auth->setUser($user);







                        if ($this->Auth->user('role') == 'admin') {



                            $this->Auth->logout();



                            $response['data'] = "no data";



                            $response['isSucess'] = "false";



                            $response['msg'] = "error_login_credentials";
                        } else {



                            $response['data'] = $this->Auth->user();



                            $response['isSucess'] = "true";



                            $response['msg'] = "success_login";
                        }
                    }
                } else {



                    $response['data'] = "no data";



                    $response['isSucess'] = "false";



                    $response['msg'] = "error_login_credentials";
                }
            }
        } else {



            return $this->redirect(['controller' => 'users', 'action' => 'add']);
        }



        $response['msg'] = $this->getLanguage($response['msg']);



        $this->set(compact('response'));



        $this->set('_serialize', ['response']);
    }

    public function logout() {



        if ($this->Auth->logout()) {



            return $this->redirect(['action' => 'home']);
        }
    }

    public function home() {
        
        $this->loadModel('Trips');
        
        $trips = $this->Trips->find('all', [
            'contain'       => ['Tripprices', 'Tripgallery', 'Transportations', 'Locations'],      
            'conditions'    => ['Trips.status' => 1] 
        ])->all()->toArray();
        
        $this->set(compact('trips'));
        $this->set('_serialize', ['trips']);
        
    }

    public function forgot() {



        if ($this->Auth->user()) {

            $this->redirect('/');
        }





        if ($this->request->is('post')) {



            $email = $this->request->data['email'];







            $user = $this->Users->find('all', ['conditions' => ['Users.email' => $email]]);



            $user = $user->first();



            $burl = Router::fullbaseUrl();



            if (empty($user)) {



                $this->Flash->error(__('Please Enter valid Email Address'));
            } else {



                if ($user->email) {



                    $hash = md5(time() . rand(111999999999999999999999999, 99999999999999999999999999999999999999999));



                    $url = Router::url(['controller' => 'Users', 'action' => 'reset' . '/' . $hash]);







                    $this->Users->updateAll(array('tokenhash' => $hash), array('id' => $user->id));



                    $ms = "Trainer<br/>";



                    $ms .= '<a href=' . $burl . $url . '>Click here to reset your password</a><br/>';



                    $email = new Email('default');



                    $email->from(['ayache10@hotmail.com' => 'Patrainer'])
                            ->emailFormat('html')
                            ->template('default', 'default')
                            ->to($user->email)
                            ->subject('Reset Your Password')
                            ->send($ms);







                    $this->Flash->success(__('Check your email to reset your password'));
                } else {



                    $this->Flash->error(__('Email is Invalid'));
                }
            }
        }
    }

    public function reset($token) {



        if ($this->Auth->user()) {

            $this->redirect('/');
        }



        $query = $this->Users->find('all', ['conditions' => ['Users.tokenhash' => $token]]);

        $data = $query->first();

        if ($data) {

            if ($this->request->is(['patch', 'post', 'put'])) {

                if ($this->request->data['password1'] != $this->request->data['password']) {

                    $this->Flash->success(__('New password & confirm password does not match!'));

                    return;

                    //$this->redirect(['action' => 'reset/' . $token]);
                }

                $this->request->data['tokenhash'] = md5(time() . rand(111999999999999999999999999999, 999999999999999999999999999999999));

                $user = $this->Users->get($data->id, [
                    'contain' => []
                ]);

                $user = $this->Users->patchEntity($user, $this->request->getData());



                if ($this->Users->save($user)) {

                    $this->Flash->success(__('Your password has been changed'));

                    return;

                    //$this->redirect(['action' => 'reset/' . $token]);
                } else {

                    $this->Flash->success(__('Invalid Password, try again'));

                    return;

                    //$this->redirect(['action' => 'reset/' . $token]);
                }
            }
        } else {

            $this->Flash->success(__('Invalid Token, try again'));

            return;
        }

        $this->set(compact('response'));

        $this->set('_serialize', ['response']);
    }

    public function ajaxedit() {

        $id = $this->Auth->user('id');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            switch ($_GET['action']) {
                case "email":

                    $post = array();

                    if ($user->email == $this->request->data['email']) {
                        $post['email'] = $this->request->data['email'];
                    } else {
                        $post['email'] = $this->request->data['email'];
                        $post['email_verified'] = 0;
                    }

                    $user = $this->Users->patchEntity($user, $post);

                    if ($this->Users->save($user)) {
                        $json['isSuccess'] = 'true';
                        $json['msg'] = 'text_email_updated';
                    } else {
                        $json['isSuccess'] = 'false';
                        $json['msg'] = 'text_email_exists';
                    }

                    break;


                case "change_password":

                    if ((new DefaultPasswordHasher)->check($this->request->data['opassword'], $user['password'])) {
                        $user = $this->Users->patchEntity($user, $this->request->data);
                        if ($this->Users->save($user)) {
                            $json['isSuccess'] = 'true';
                            $json['msg'] = 'text_password_changed';
                        } else {
                            $json['isSuccess'] = 'false';
                            $json['msg'] = 'text_invalid_password';
                        }
                    } else {
                        $json['isSuccess'] = 'false';
                        $json['msg'] = 'error_old_password';
                    }

                    break;

                case "email_notification":



                    $user = $this->Users->patchEntity($user, $this->request->data);

                    if ($this->Users->save($user)) {
                        $json['isSuccess'] = 'true';
                        $json['msg'] = 'text_email_updated';
                    } else {
                        $json['isSuccess'] = 'false';
                        $json['msg'] = 'text_email_exists';
                    }
                    break;

                case "set_password":

                    $user = $this->Users->patchEntity($user, $this->request->data);
                    if ($this->Users->save($user)) {
                        $json['isSuccess'] = 'true';
                        $json['msg'] = 'text_password_changed';
                    } else {
                        $json['isSuccess'] = 'false';
                        $json['msg'] = 'text_invalid_password';
                    }

                    break;
            }

            $json['msg'] = $this->getLanguage($json['msg']);

            echo json_encode($json);
            exit;
        }
    }

    public function changepassword() {

        $id = $this->Auth->user('id');



        $user = $this->Users->get($id, [
            'contain' => []
        ]);



        if ($this->request->is(['patch', 'post', 'put'])) {

            if (isset($this->request->data['password1'])) {

                if ($this->request->data['password'] != $this->request->data['password1']) {

                    $this->Flash->error(__('New And Confirm Password Does Not Match'));

                    return;
                }
            }

            if ((new DefaultPasswordHasher)->check($this->request->data['opassword'], $user['password'])) {

                $user = $this->Users->patchEntity($user, $this->request->data);

                if ($this->Users->save($user)) {

                    $this->Flash->error(__('Password Changed Successfully'));



                    if (isset($_GET['route'])) {

                        return $this->redirect(['action' => 'edit', $id]);
                    } else {

                        return $this->redirect(['action' => 'changepassword']);
                    }
                } else {

                    $this->Flash->success(__('Invalid Password, try again'));

                    if (isset($_GET['route'])) {

                        return $this->redirect(['action' => 'edit', $id]);
                    } else {

                        return $this->redirect(['action' => 'changepassword']);
                    }
                }
            } else {

                $this->Flash->success(__('Old password did not match'));

                if (isset($_GET['route'])) {

                    return $this->redirect(['action' => 'edit', $id]);
                } else {

                    return $this->redirect(['action' => 'changepassword']);
                }
            }
        }
    }

    public function trainer() {



        if ($this->Auth->user('role') != 'trainer') {

            $this->redirect('/');
        }



        $id = $this->Auth->user('id');



        $user = $this->Users->get($id, [
            'contains' => []
        ]);



        $this->set('user', $user);

        $this->set('_serialize', ['user']);



        $this->loadModel('Galleries');



        $gallery = $this->Galleries->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ]);



        $gallery = $gallery->all();



        $this->set('galleries', $gallery);

        $this->set('_serialize', ['galleries']);
    }

    public function traineredit() {



        if ($this->Auth->user('role') != 'trainer') {

            $this->redirect('/');
        }



        $id = $this->Auth->user('id');



        $user = $this->Users->get($id, [
            'contains' => []
        ]);



        $column = $this->request->query('view');



        if ($this->request->is(['patch', 'put', 'post'])) {



            $post[$column] = json_encode($this->request->data['content']);



            $user = $this->Users->patchEntity($user, $post);



            if ($this->Users->save($user)) {

                $this->Flash->success(__('Your Info has been Updated Successfully'));

                return $this->redirect(['action' => 'trainer']);
            } else {

                $this->Flash->error(__('Error in info Updation'));

                return $this->redirect(['action' => 'trainer']);
            }
        }





        $this->loadModel('Galleries');



        $gallery = $this->Galleries->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ]);



        $gallery = $gallery->all();



        $this->set('galleries', $gallery);

        $this->set('_serialize', ['galleries']);



        $this->set('content', $user[$column]);

        $this->set('_serialize', ['content']);
    }

    public function addGallery() {



        $this->loadModel('Galleries');



        $gallery = $this->Galleries->newEntity();



        if ($this->request->is(['patch', 'put', 'post'])) {



            $file = $this->request->data['file'];

            $name = time() . $file['name'];

            $tmp_name = $file['tmp_name'];

            $upload_path = WWW_ROOT . 'images/gallery/' . $name;

            move_uploaded_file($tmp_name, $upload_path);



            $this->request->data['file'] = $name;

            $this->request->data['format'] = $file['type'];

            $this->request->data['user_id'] = $this->Auth->user('id');



            $gallery = $this->Galleries->patchEntity($gallery, $this->request->data);



            if ($this->Galleries->save($gallery)) {

                $this->Flash->success(__('You file has been uploaded successfully'));

                return $this->redirect(["controller" => "users", "action" => "trainer"]);
            } else {

                $this->Flash->success(__('Error in file upload. Please try again later'));

                return $this->redirect(["controller" => "users", "action" => "trainer"]);
            }
        }
    }

    public function removeGallery($id) {



        $id = base64_decode($id);



        $this->loadModel('Galleries');



        $gallery = $this->Galleries->get($id, [
            'contains' => []
        ]);



        unlink(WWW_ROOT . 'images/gallery/' . $gallery->file);



        $result = $this->Galleries->delete($gallery);



        if ($result) {

            $this->Flash->success(__('You file has been deleted successfully'));

            return $this->redirect(["controller" => "users", "action" => "trainer"]);
        } else {

            $this->Flash->success(__('Error in file deletion. Please try again later'));

            return $this->redirect(["controller" => "users", "action" => "trainer"]);
        }
    }

    public function contact() {





        $this->loadModel('Contacts');



        $contact = $this->Contacts->newEntity();

        if ($this->request->is('post')) {





            $contact = $this->Contacts->patchEntity($contact, $this->request->data);

            if ($this->Contacts->save($contact)) {



                $ms = '<table width="200" border="1"><tr><th scope="row">Name</th><td>' . $this->request->data['name'] . '</td></tr><tr><th scope="row">Email</th><td>' . $this->request->data['email'] . '</td></tr><tr><th scope="row">Subject</th><td>' . $this->request->data['subject'] . '</td></tr><th scope="row">Message</th><td>' . $this->request->data['message'] . '</td></tr></table>';





                $email = new Email('default');



                $email->from(['contact@patrainer.com' => 'Trainer'])
                        ->emailFormat('html')
                        ->template('default', 'default')
                        ->to('contact@patrainer.com')
                        ->subject('Contact Us Enquiry')
                        ->send($ms);





                $this->Flash->success(__('Your Enquiry has been sent successfully.'));
            } else {

                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('contact'));

        $this->set('_serialize', ['contact']);
    }

    /*     * ********* Trip Functions ************* */

    public function language() {

        $source = 'en';

        $target = 'ar';

        $text = 'Simple PHP library for talking to Googles Translate API for free.';



        $trans = new GoogleTranslate();

        $result = $trans->translate($source, $target, $text);



        echo $result;
    }

    public function ajaxSignup() {



        $response = array();



        $user = $this->Users->newEntity();



        if ($this->request->is('post')) {



            if ($this->request->data['first_name'] == '' || $this->request->data['last_name'] == '' || $this->request->data['email'] == '' || $this->request->data['password1'] == '' || $this->request->data['password'] == '') {

                $response['isSucess'] = "false";

                $response['msg'] = "<div class='alert alert-danger'><strong>Please fill all the fields</strong></div>";
            } else if ($this->request->data['password1'] != $this->request->data['password']) {

                $response['isSucess'] = "false";

                $response['msg'] = "<div class='alert alert-danger'><strong>Password and Confirm Password does not match.</strong></div>";
            } else {



                $user_check = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);

                $user_check = $user_check->first();

                if (!empty($user_check)) {

                    $response['isSucess'] = "false";

                    $response['msg'] = "<div class='alert alert-danger'><strong>Email Address already exists. Please try with another email ID..</strong></div>";
                } else {



                    $post = $this->request->data;



                    $post['status'] = '1';

                    $post['role'] = 'user';

                    $post['name'] = $post['first_name'] . ' ' . $post['last_name'];



                    $user = $this->Users->patchEntity($user, $post);

                    $new_user = $this->Users->save($user);



                    if ($new_user) {

                        $ms = 'A new User has been registered recently with email ID <strong>' . $post['email'] . '</strong>';



                        $ms .= '<br>';



                        $ms .= '<table border="0"><tr><th scope="row" align="left">Name</th><td>' . $post['name'] . '</td></tr><tr><th scope="row" align="left">Email</th><td>' . $post['email'] . '</td></tr></table>';



                        // $email = new Email('default');
                        // $email->from(['gurpreet@avainfotech.com' => 'Trip'])
                        // 	->emailFormat('html')
                        // 	->template('default', 'default')
                        // 	->to('gurpreet@avainfotech.com')
                        // 	->subject('New User Registration')
                        // 	->send($ms);

                        $this->request->data['username'] = $post['email'];

                        $this->request->data['password'] = $this->request->data['password'];



                        if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                            $this->Auth->config('authenticate', [
                                'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                            ]);



                            $this->Auth->constructAuthenticate();



                            $this->request->data['email'] = $this->request->data['username'];



                            unset($this->request->data['username']);
                        }



                        $user1 = $this->Auth->identify();



                        if ($user1) {



                            $this->Auth->setUser($user1);


                            $response['isSucess'] = "true";

                            $response['msg'] = "<div class='alert alert-success'><strong>Registered Successfully.</strong></div>";
                        } else {
                            $response['isSucess'] = "false";

                            $response['msg'] = "<div class='alert alert-success'><strong>Registered Successfully. But unable to login</strong></div>";
                        }
                    }
                }
            }
        }



        echo json_encode($response);

        exit;
    }

    public function fbconnect() {

        $response = array();

        if (isset($this->request->data['action']) && $this->request->data['action'] == "fblogin") {



            $user = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['myid']['email']]]);

            $user = $user->first();


            if (!empty($user)) {

                $post = array();

                $post['fb_id'] = $this->request->data['myid']['id'];

                $post['email_verified'] = '1';


                $user = $this->Users->patchEntity($user, $post);

                $new_user = $this->Users->save($user);



                if ($new_user) {

                    $response['isSuccess'] = 'true';

                    $response['msg'] = 'Connected Successfully';
                } else {

                    $response['isSuccess'] = 'false';

                    $response['msg'] = 'Error in Connecting. Please Try Again.';
                }
            } else {

                $response['isSuccess'] = 'false';

                $response['msg'] = 'Error in Connecting. Please Try Again.';
            }
        }



        $response['msg'] = $this->getLanguage($response['msg']);



        echo json_encode($response);

        exit;
    }

    public function fblogin() {

        $response = array();



        //print_r($this->request->data); exit;



        if (isset($this->request->data['action']) && $this->request->data['action'] == "fblogin") {



            $results = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['myid']['email']]]);

            $results = $results->first();


            if (!empty($results)) {

                if ($results->fb_id != '') {
                    $this->Auth->setUser($results);

                    $response['isSuccess'] = 'true';

                    $response['msg'] = 'Logged in successfully';
                } else {
                    $response['isSuccess'] = 'false';

                    $response['msg'] = 'Please Logged in using your credentials.';
                }
            } else {

                $post = array();

                $post['fb_id'] = $this->request->data['myid']['id'];

                $post['first_name'] = $this->request->data['myid']['first_name'];

                $post['last_name'] = $this->request->data['myid']['last_name'];

                $post['email'] = $this->request->data['myid']['email'];

                $post['email_verified'] = '1';

                $post['name'] = $this->request->data['myid']['name'];

                $post['password'] = 'zxswedcxswz';

                $post['status'] = '1';

                $post['role'] = 'user';





                $user = $this->Users->newEntity();



                $user = $this->Users->patchEntity($user, $post);

                $new_user = $this->Users->save($user);



                if ($new_user) {

                    $this->request->data['username'] = $this->request->data['myid']['email'];

                    $this->request->data['password'] = 'zxswedcxswz';



                    if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                        $this->Auth->config('authenticate', [
                            'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                        ]);



                        $this->Auth->constructAuthenticate();



                        $this->request->data['email'] = $this->request->data['username'];



                        unset($this->request->data['username']);
                    }



                    $user2 = $this->Auth->identify();



                    if ($user2) {



                        $this->Auth->setUser($user2);



                        $response['isSuccess'] = 'true';

                        $response['msg'] = 'success_login';
                    } else {

                        $response['isSuccess'] = 'false';

                        $response['msg'] = 'Error in Signing in. Please Try Again.';
                    }
                }
            }
        }



        $response['msg'] = $this->getLanguage($response['msg']);



        echo json_encode($response);

        exit;
    }

    public function gplogin() {

        $response = array();



        //print_r($this->request->data); exit;



        if (isset($this->request->data['action']) && $this->request->data['action'] == "gplogin") {



            $results = $this->Users->find('all', ['conditions' => ['Users.google_id' => $this->request->data['id']]]);

            $results = $results->first();


            $email_check = $this->Users->find('all', ['conditions' => ['Users.email' => $this->request->data['email']]]);

            $email_check = $email_check->first();


            if (!empty($results)) {



                $this->request->data['username'] = $results['email'];

                $this->request->data['password'] = 'zxswedcxswz';



                if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                    $this->Auth->config('authenticate', [
                        'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                    ]);



                    $this->Auth->constructAuthenticate();



                    $this->request->data['email'] = $this->request->data['username'];



                    unset($this->request->data['username']);
                }



                $user1 = $this->Auth->identify();



                if ($user1) {



                    $this->Auth->setUser($user1);



                    $response['isSuccess'] = 'true';

                    $response['msg'] = 'Logged in successfully';
                } else {

                    $response['isSuccess'] = 'false';

                    $response['msg'] = 'Error in Signing in. Please Try Again.';
                }
            } elseif (!empty($email_check)) {
                $response['isSuccess'] = 'false';

                $response['msg'] = 'You are already a user with email ID ' . $this->request->data['email'] . '. please login using your credentials.';
            } else {



                $post = array();



                $post['google_id'] = $this->request->data['id'];

                $post['first_name'] = $this->request->data['first_name'];

                $post['last_name'] = $this->request->data['last_name'];

                $post['email'] = $this->request->data['email'];

                $post['name'] = $this->request->data['name'];

                $post['password'] = 'zxswedcxswz';

                $post['status'] = '1';

                $post['role'] = 'user';





                $user2 = $this->Users->newEntity();



                $user2 = $this->Users->patchEntity($user2, $post);

                $new_user = $this->Users->save($user2);



                if ($new_user) {

                    $this->request->data['username'] = $this->request->data['email'];

                    $this->request->data['password'] = 'zxswedcxswz';



                    if (!filter_var($this->request->data['username'], FILTER_VALIDATE_EMAIL) === false) {

                        $this->Auth->config('authenticate', [
                            'Form' => ['fields' => ['username' => 'email', 'password' => 'password']]
                        ]);



                        $this->Auth->constructAuthenticate();



                        $this->request->data['email'] = $this->request->data['username'];



                        unset($this->request->data['username']);
                    }



                    $user2 = $this->Auth->identify();



                    if ($user2) {



                        $this->Auth->setUser($user2);



                        $response['isSuccess'] = 'true';

                        $response['msg'] = 'Logged in successfully';
                    } else {

                        $response['isSuccess'] = 'false';

                        $response['msg'] = 'Error in Signing in. Please Try Again.';
                    }
                } else {

                    $response['isSuccess'] = 'false';

                    $response['msg'] = 'Error in Signing in. Please Try Again.';
                }
            }
        }



        echo json_encode($response);

        exit;
    }

    public function changeLanguage() {

        if ($this->request->is('post')) {

            $language = $this->request->data['language'];



            $session = $this->request->session();

            $session->write('Config.language', $language);



            echo $language;
        }



        exit;
    }

    public function verifications($id = null) {



        $json = array();

        $u_info = $this->Auth->user();


        if ($this->request->is(['patch', 'post', 'put'])) {



            $user = $this->Users->get($u_info['id'], [
                'contains' => []
            ]);



            if ($_GET['action'] == 'id_card') {



                $post = $this->request->data;



                if ($this->request->data['id_image']['name'] != '') {

                    if ($user->id_image != '' || $user->id_image != null) {

                        unlink(WWW_ROOT . 'images/users/id_card/' . $user->id_image);
                    }



                    $image = $this->request->data['id_image'];

                    $name = time() . $image['name'];

                    $tmp_name = $image['tmp_name'];

                    $upload_path = WWW_ROOT . 'images/users/id_card/' . $name;

                    move_uploaded_file($tmp_name, $upload_path);



                    $post['id_image'] = $name;

                    $post['id_number'] = $this->request->data['id_number'];
                } else {

                    $post['id_number'] = $this->request->data['id_number'];
                }



                $user = $this->Users->patchEntity($user, $post);



                if ($this->Users->save($user)) {

                    $json['isSuccess'] = 'true';

                    $json['msg'] = 'text_id_updated';
                } else {

                    $json['isSuccess'] = 'false';

                    $json['msg'] = 'text_id_not_updated';
                }
            }



            if ($_GET['action'] == 'bank') {



                $post = $this->request->data;



                if ($this->request->data['bank_image']['name'] != '') {

                    if ($user->account_image != '' || $user->account_image != null) {

                        unlink(WWW_ROOT . 'images/users/bank/' . $user->account_image);
                    }



                    $image = $this->request->data['bank_image'];

                    $name = time() . $image['name'];

                    $tmp_name = $image['tmp_name'];

                    $upload_path = WWW_ROOT . 'images/users/bank/' . $name;

                    move_uploaded_file($tmp_name, $upload_path);



                    $post['account_image'] = $name;

                    $post['account_bank'] = $this->request->data['bank_name'];

                    $post['account_number'] = $this->request->data['bank_number'];
                } else {

                    $post['account_bank'] = $this->request->data['bank_name'];

                    $post['account_number'] = $this->request->data['bank_number'];
                }



                $user = $this->Users->patchEntity($user, $post);



                if ($this->Users->save($user)) {

                    $json['isSuccess'] = 'true';

                    $json['msg'] = 'text_bank_updated';
                } else {

                    $json['isSuccess'] = 'false';

                    $json['msg'] = 'text_bank_not_updated';
                }
            }


            if ($_GET['action'] == 'send_mail') {
                $email = $u_info['email'];

                $random_number = rand(100000, 999999);

                $this->Users->updateAll(array('email_verification_code' => $random_number), array('id' => $u_info['id']));

                $ms = "Trip<br/>";
                $ms .= 'Your Email verification code.';
                $ms .= '<h1>' . $random_number . '</h1>';

                $email = new Email('default');

                $email->from(['gurpreet@avainfotech.com' => 'Trip'])
                        ->emailFormat('html')
                        ->template('default', 'default')
                        ->to($email)
                        ->subject('Email Verification code')
                        ->send($ms);

                $json['msg'] = 'text_verfication_email_sent';
            }

            if ($_GET['action'] == 'verify_mail') {
                $email = $u_info['email'];

                $code = $this->request->data['code'];

                if ($user->email_verification_code == $code) {
                    $this->Users->updateAll(array('email_verified' => '1', 'email_verification_code' => null), array('id' => $u_info['id']));

                    $ms = "Trip<br/>";
                    $ms .= 'Your Email has been verified successfully.';

                    $email = new Email('default');

                    $email->from(['gurpreet@avainfotech.com' => 'Trip'])
                            ->emailFormat('html')
                            ->template('default', 'default')
                            ->to($email)
                            ->subject('Email verified successfully')
                            ->send($ms);

                    $json['isSuccess'] = 'true';
                    $json['msg'] = 'text_verified';
                } else {
                    $json['isSuccess'] = 'false';
                    $json['msg'] = 'alert_verfication_incorrect';
                }
            }



            $json['msg'] = $this->getLanguage($json['msg']);



            echo json_encode($json);

            exit;
        }
    }

    public function sendOtp() {

        $sid = 'AC7773cf20375834f3411cb950d7fc3c3f';

        $token = 'a531c90806f52534de96f331307e972b';

        $client = new Client($sid, $token);



        $random_number = rand(1000, 9999);



        $client->messages->create(
                '+91' . $this->request->data['mobile_number'], array(
            'from' => '+17816912753',
            'body' => 'Your OTP is :' . $random_number
                )
        );



        $session = $this->request->session();

        $session->write('Phone.otp', $random_number);
        $session->write('Phone.phone', $this->request->data['mobile_number']);



        $json = array();



        $json['isSuccess'] = 'true';

        $json['msg'] = 'OTP sent successfully';



        echo json_encode($json);

        exit;
    }

    public function verifyOtp() {

        $json = array();



        if ($this->request->is('post')) {



            $entered_otp = $this->request->data['otp'];



            $session = $this->request->session();



            $real_otp = $session->read('Phone.otp');



            if ($entered_otp == $real_otp) {



                $session->delete('Phone.otp');



                $u = $this->Auth->user();



                $user = $this->Users->get($u['id'], [
                    'contains' => []
                ]);


                $post['phone'] = $session->read('Phone.phone');
                $post['phone_verified'] = '1';


                $session->delete('Phone.phone');

                $user = $this->Users->patchEntity($user, $post);



                if ($this->Users->save($user)) {

                    $session->write('Auth.User.phone_verified', '1');

                    $json['isSuccess'] = 'true';

                    $json['msg'] = 'alert_otp_correct';
                } else {

                    $json['isSuccess'] = 'false';

                    $json['msg'] = 'alert_otp_incorrect';
                }
            } else {

                $json['isSuccess'] = 'false';

                $json['msg'] = 'alert_otp_incorrect';
            }
        }



        $json['msg'] = $this->getLanguage($json['msg']);



        echo json_encode($json);

        exit;
    }

    public function triplisting() {
        
    }

    public function paypaladaptive() {

        include(ROOT . '/vendor/paypal/adaptivepayments-sdk-php/samples/Configuration.php');

        //print_r($configuration);
        //exit;

        define('PAYPAL_REDIRECT_URL', 'https://www.sandbox.paypal.com/webscr&cmd=');
        define('DEVELOPER_PORTAL', 'https://developer.paypal.com');

        if ($this->request->is('post')) {

            $returnUrl = Router::url('/', true) . "/users/paypalsuccess";
            $cancelUrl = Router::url('/', true) . "/users/paypalindex";
            $ipnNotificationUrl = Router::url('/', true) . "/users/paypalipn";
            $memo = "Adaptive Payment - chained Payment";
            $actionType = "PAY";
            $currencyCode = "USD";


            $_POST['id'] = base64_encode(1);

            if ($_POST['id'] == base64_encode(1)) {
                $receiverEmail = array("vikrant-facilitator@avainfotech.com", "vkrtteee@gmail.com");
                $receiverAmount = array("5", "3");
                $primaryReceiver = array("true", "false");
            }

            if (isset($receiverEmail)) {
                $receiver = array();
                /*
                 * A receiver's email address 
                 */
                for ($i = 0; $i < count($receiverEmail); $i++) {
                    $receiver[$i] = new Receiver();
                    $receiver[$i]->email = $receiverEmail[$i];
                    /*
                     *  	Amount to be credited to the receiver's account 
                     */
                    $receiver[$i]->amount = $receiverAmount[$i];
                    /*
                     * Set to true to indicate a chained payment; only one receiver can be a primary receiver. Omit this field, or set it to false for simple and parallel payments. 
                     */
                    $receiver[$i]->primary = $primaryReceiver[$i];
                }
                $receiverList = new ReceiverList($receiver);
            }

            /*
             * The action for this request. Possible values are:

              PAY - Use this option if you are not using the Pay request in combination with ExecutePayment.
              CREATE - Use this option to set up the payment instructions with SetPaymentOptions and then execute the payment at a later time with the ExecutePayment.
              PAY_PRIMARY - For chained payments only, specify this value to delay payments to the secondary receivers; only the payment to the primary receiver is processed.

             */
            /*
             * The code for the currency in which the payment is made; you can specify only one currency, regardless of the number of receivers 
             */
            /*
             * URL to redirect the sender's browser to after canceling the approval for a payment; it is always required but only used for payments that require approval (explicit payments) 
             */
            /*
             * URL to redirect the sender's browser to after the sender has logged into PayPal and approved a payment; it is always required but only used if a payment requires explicit approval 
             */
            $payRequest = new PayRequest(new RequestEnvelope("en_US"), $actionType, $cancelUrl, $currencyCode, $receiverList, $returnUrl, $ipnNotificationUrl);
            // Add optional params

            if ($memo != "") {
                $payRequest->memo = $memo;
            }


            /*
             * 	 ## Creating service wrapper object
              Creating service wrapper object to make API call and loading
              Configuration::getAcctAndConfig() returns array that contains credential and config parameters
             */
            $service = new AdaptivePaymentsService($configuration->getAcctAndConfig());
            print_r($configuration->getAcctAndConfig());
            exit;
            // try {
            /* wrap API method calls on the service object with a try catch */
            $response = $service->Pay($payRequest);
            exit;
            $ack = strtoupper($response->responseEnvelope->ack);
            if ($ack == "SUCCESS") {
                $payKey = $response->payKey;
                $_SESSION['pay_key'] = $payKey;
                $payPalURL = PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $payKey . '&expType=light';

                return $this->redirect($payPalURL);

                //header('Location', $payPalURL);
            }
            // } catch (Exception $ex) {
            // 	require_once '../Common/Error.php';
            // 	exit;
            // }
        }
    }

    public function paypalipn() {
        $myfile = fopen("ipn_data.txt", "a+") or die("Unable to open file!");
        fwrite($myfile, print_r($_POST, true));
        fclose($myfile);
    }

    public function paypalsuccess() {
        
    }
    
    public function availabilities(){
        $this->loadModel('Availabilities');
        
        if(!$this->Auth->user('id')){
            $this->redirect('/');
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->Availabilities->deleteAll(['Availabilities.user_id' => $this->Auth->user('id')]);
            
            $dates = explode(",", $this->request->data['dates']);

            $post = array();
            
            foreach($dates as $date){
                if($date != ''){
                
                    $post['user_id']    =   $this->Auth->user('id');
                    $post['date']       =   $date;

                    $ava = $this->Availabilities->newEntity();
                    $ava = $this->Availabilities->patchEntity($ava, $post);

                    $this->Availabilities->save($ava);
                }
                
            }
            
            $this->Flash->success(__('Your Availablity dates has been updated successfully.'));
            
        }
        
        $availabilities = $this->Availabilities->find('all',[
            'conditions' => ['Availabilities.user_id' => $this->Auth->user('id')]
        ])->all()->toArray();
        
        $this->set(compact('availabilities'));
        $this->set('_serialize', ['availabilities']);
        
    }
    
    public function dashboard(){
                
    }

    /**************** Trip Functions(END) ***************** */
}
