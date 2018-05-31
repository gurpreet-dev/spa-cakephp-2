<?php

App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

class ContactsController extends AppController {

	public $components = array('Paginator');


	public function index(){

		configure::write('debug', 2);
		
	
		if($this->request->is('post')){

			$this->Contact->create();
			if($this->Contact->save($this->request->data)){
			
				$l = new CakeEmail();   
				$l->emailFormat('html')->template('default','contacttoadmin')->subject('MTH Booking')
					->viewVars(array('contact_data' => $this->request->data)) 
					//->viewVars(array('user' => $fu)) 
					->from(array('info@mytreatmenthub.com' => 'MTH'))
					->to('info@mytreatmenthub.com')->send();
			
				$this->Session->setFlash(
                    'Information sent successfully',
                    'default',
                    array('class' => 'success-message'),
                    'contactus'    
                );
			}
		}
		
	}
	
	public function admin_index(){
	
	configure::write('debug', 2);
	
		if(isset($this->request->data['Contact']['search'])){
			$keyword = $this->request->data['Contact']['search'];
		}else{
			$keyword = '';
		}
	
		$this->Paginator->settings = array(
			'limit'		=>	10,
			'conditions' => array('Contact.name LIKE' => '%'. $keyword .'%'),
			'order'		=>	array('Contact.id' => 'DESC')
		);
		
		$contacts = $this->Paginator->paginate('Contact');
		
		$this->set('contacts', $contacts);
		$this->set('keyword', $keyword);
		
	}
	
	public function admin_edit($id = null){
	configure::write('debug', 2);
		if(!$id){
			throw new NotFoundException('Invalid ID');	
		}
		
		$this->Contact->id = $id;
		
		$contact = $this->Contact->findById($id);
		if($this->request->is('post') || $this->request->is('put')){

			$this->request->data['Contact']['answered'] = 1;
		
			if($this->Contact->save($this->request->data)){
			
			
				$msg = '<strong>Your Question:</strong> '.$contact['Contact']['feedback'].'<br><strong>Answer:</strong> '.$this->request->data['Contact']['reply'];
			
			
				$Email = new CakeEmail();
				$Email->from(array('rahulsharma@avainfotech.com' => 'Spa'));
				$Email->to($this->request->data['Contact']['email']);
				$Email->emailFormat('html');
				$Email->subject('Spa reply');
				$Email->send($msg);
				
				
				$this->Session->setFlash(

					'Success',

					'default',

					array('class' => 'success-message'),

					'contact'    

				);
				
				return $this->redirect(array('action' => 'index'));
				
			
			}else{
				$this->Session->setFlash(

					'Error',

					'default',

					array('class' => 'error-message'),

					'contact'    

				);
				
				return $this->redirect(array('action' => 'index'));
			}
		}else{
			$this->request->data = $this->Contact->read(null, $id);
		}
	}
	
	
	
}