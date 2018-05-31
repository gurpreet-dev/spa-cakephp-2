<?php

App::uses('AppController', 'Controller');

class DashboardsController extends AppController {

       public function beforeFilter() {

        parent::beforeFilter();

       

    }

    public function admin_index(){

        Configure::write("debug", 0);

        $this->loadModel('User');

        $this->loadModel('Restaurantlike');

        $this->loadModel('Restaurant');

        $restID = $this->Restaurant->find('first',array('conditions'=>array('Restaurant.user_id'=>$this->Auth->user('id'))));

        //echo $restID['Restaurant']['id'];

        //print_r($restID);exit;

        $this->Restaurantlike->recursive=2;

        $likeUser = $this->Restaurantlike->find('all',array('conditions'=>array('Restaurantlike.restaurant_id'=>$restID['Restaurant']['id']),

            'group'=>'Restaurantlike.user_id'

        ));

        $this->set('likeuser',$likeUser);

        //print_r($likeUser);

    }

    public function admin_view($id=NULL){

        //echo $id;

        Configure::write("debug", 0);

        $this->loadModel('User');

        $this->loadModel('Restaurantlike');

        $this->loadModel('Restaurant');

        

        $this->Restaurantlike->recursive=2;

        $likeUser = $this->Restaurantlike->find('first',array('conditions'=>array('Restaurantlike.id'=>$id)));

        $this->set('likeuser',$likeUser);

        //print_r($likeUser);

    }



    public function admin_dashboard() {


    }

    public function admin_dashboardview($id=NULL) {

        Configure::write("debug", 0);

        $this->loadModel('Dashboard');

        $data=$this->Dashboard->find('all',array('conditions'=>array('Dashboard.id'=>$id)),array('limit'=>30, 'order' => array(

                'Dashboard.id' => 'desc'

            )));

        $this->set('data',$data);

    }

    public function admin_emailSend(){

        $sub = $_POST['subject'];

        $msg = $_POST['message'];

        $emailto = $_POST['emailto'];

        App::uses('CakeEmail', 'Network/Email');

        $email = new CakeEmail();

        

        $email->from('netin@avainfotech.com')

//->cc(Configure::read('Settings.ADMIN_EMAIL'))

//->cc('ajay@futureworktechnologies.com')

                ->to($emailto)

                ->subject($sub)

                //->template('activation')

                //->emailFormat('both')

                //->viewVars(array('ds' => $urlm))

                ->send($msg);

        return $this->redirect(array('controller' => 'dashboards', 'action' => 'dashboard'));

    }

}