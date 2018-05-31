<?php

App::uses('AppController', 'Controller');

class FaqsController extends AppController {

	public $components = array('Paginator');

	public function admin_index(){
			Configure::write('debug', 2);
	
		if(isset($this->request->data['Faq']['search'])){
			$keyword = $this->request->data['Faq']['search'];

			$conditions = array('Faq.title LIKE' => '%'.$keyword.'%');

		}else{
			$keyword = '';
			$conditions = array();
		}
	
     
	 	$this->Paginator->settings = array(
			'recursive'	=>	2,
			'limit'		=>	10,
			'conditions' => $conditions,
			'order'		=>	array('Faq.id' => 'DESC')
		);
		
		$faqs = $this->Paginator->paginate('Faq');
		$this->set('faqs', $faqs);
		$this->set('keyword', $keyword);
	}
	
	public function admin_add(){
		if($this->request->is('post')){
			$this->Faq->create();
			
			if($this->Faq->save($this->request->data)){
				$this->Session->setFlash('Faq has been added successfully', 'default', array('class' => 'success-message'), 'faq');
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('Error in Faq addition', 'default', array('class' => 'error-message'), 'faq');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function admin_view($id = null) {
		if (!$this->Faq->exists($id)) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
		$this->set('faq', $this->Faq->find('first', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Faq->exists($id)) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash('The faq has been saved.', 'default', array('class' => 'success-message'), 'faq');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The faq could not be saved. Please, try again.', 'default', array('class' => 'error-message'), 'faq');
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
			$this->request->data = $this->Faq->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Faq->delete()) {
			$this->Session->setFlash('The faq has been deleted.', 'default', array('class' => 'success-message'), 'faq');
			
		} else {
			$this->Session->setFlash('The faq could not be deleted. Please, try again.', 'default', array('class' => 'error-message'), 'faq');
		}
		return $this->redirect(array('action' => 'index'));
	}

}

?>