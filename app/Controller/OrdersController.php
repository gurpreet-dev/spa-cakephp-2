<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class OrdersController extends AppController {

	public $components = array('Paginator');

////////////////////////////////////////////////////////////
  
    public function admin_index() {
	
	
		Configure::write('debug', 2);
		
		$this->loadModel('User');
	
		if(isset($this->request->data['Order']['search']) && isset($this->request->data['Order']['type'])){
			$type = $this->request->data['Order']['type'];
			$keyword = $this->request->data['Order']['search'];
			
			if($type == 'id'){
				$conditions = array('Order.id LIKE' => '%'.$keyword.'%', 'Order.status' => '1');
			}else{
				$conditions = array('Order.'.$type.' LIKE' => '%'.$keyword.'%', 'Order.status' => '1');
			}
			
			$end_date = ''; $start_date = '';
			
		}elseif(isset($this->request->data['Order']['start_date']) && isset($this->request->data['Order']['end_date'])){
			$start_date = date('Y-m-d H:i:s', strtotime($this->request->data['Order']['start_date']));
			$end_date = date('Y-m-d H:i:s', strtotime($this->request->data['Order']['end_date']));
			$store = isset($this->request->data['Order']['store']) ? $this->request->data['Order']['store'] : '';
			
			$conditions = array('date(Order.created) BETWEEN ? AND ?' => array($start_date, $end_date), 'Order.salon_id' => $store, 'Order.status' => '1');
			$keyword = '';
			
			$start_date = $this->request->data['Order']['start_date'];
			$end_date = $this->request->data['Order']['end_date'];
			$store = $this->request->data['Order']['store'];
			
			
		}else{
			$type = '';
			$end_date = '';
			$start_date = '';
			$store = '';
			$keyword = '';
			$conditions = array('Order.status' => '1');
		}
		
	 	$this->Paginator->settings = array(
			'recursive'	=>	2,
			'limit'		=>	10,
			'conditions' => $conditions,
			'order'		=>	array('Order.id' => 'DESC')
		);
		
		$orders = $this->Paginator->paginate('Order');
		$this->set('orders', $orders);
		$this->set('keyword', $keyword);
		$this->set('start_date', $start_date);
		$this->set('end_date', $end_date);
		$this->set('store', $store);
		
		$stores = $this->User->find('all', array('conditions' => array('User.active' => 1, 'User.role' => 'freelancer')));
		
		$this->set('stores', $stores);
		
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
	
		Configure::write('debug', 2);
	
        $order = $this->Order->find('first', array(
            'recursive' => 2,
            'conditions' => array(
                'Order.id' => $id
            )
        ));
        if (empty($order)) {
            return $this->redirect(array('action'=>'index'));
        }
        $this->set(compact('order'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException('Invalid order');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash('The order has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The order could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Order->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException('Invalid order');
        }
        if ($this->Order->delete()) {
            $this->Session->setFlash('Order deleted');
            return $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash('Order was not deleted');
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////
    
    public function admin_servicestatus($id = null){
        
        $this->Order->updateAll(array('Order.refund_status' => '"completed"'), array('Order.id' => $id));
        $this->Session->setFlash('Refund status updated successfully');
        return $this->redirect(array('action' => 'index'));
        
    }


////////////////////////////////////////////////////////////    
    
     public function orderlist(){ 
          configure::write('debug', 0);
        $uid = $this->Auth->user('id');
        if($uid==NULL){
            return $this->redirect('/');
        }
        if ($this->request->is('post')) {   
           $orderid = $this->request->data['orderid'];
           
           $this->Order->recursive= 1;
        $fdata = $this->Order->find('all',array('conditions'=>array('Order.id'=>$orderid,'Order.uid'=>$uid)));  
        $this->set('fdata', $fdata);  
            
        }
         
               $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = array(
            'Order' => array(
                'recursive' => 1,
                'limit' => 5,
                'conditions' => array(
                    'Order.uid' => $uid, 
                ),
                'order' => array(
                    'Order.id' => 'DESC'
                ),
            )
        );
        $data = $this->Paginator->paginate(); 
        $this->set(compact('data'));
        
        
    }
    
    
    ///////////////////////////////////////////////
    
        public function orderhistry($id= null){
          configure::write('debug', 0);    
        $uid = $this->Auth->user('id');
        $this->Order->recursive= 1;
        $data = $this->Order->find('first',array('conditions'=>array('Order.id'=>$id))); 
        $this->set('datahistory', $data); 
    }
    
    /////////////////////////////////// 

}
