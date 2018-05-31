<?php

App::uses('AppController', 'Controller');

/**
 * Times Controller
 *
 * @property Time $Time
 * @property PaginatorComponent $Paginator
 */
class ReviewsController extends AppController {

    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function admin_index() {
		$this->Review->recursive = 1;
        $Review = $this->Review->find('all', array('order' => array('Review.id DESC')));
        $this->set('reviews', $this->Paginator->paginate('Review'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
         $this->Review->recursive = 1;
        if (!$this->Review->exists($id)) {
            throw new NotFoundException(__('Invalid time'));
        }
        $options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
        $this->set('time', $this->Review->find('first', $options));
        $res = $this->Review->Product->find('list');
        $this->set(compact('res'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Review->exists($id)) {
            throw new NotFoundException(__('Invalid ID'));
        }
		
		$this->Review->id = $id;
        
		if ($this->request->is(array('post', 'put'))) {
		
            if ($this->Review->save($this->request->data)) {
                $this->Session->setFlash('The Review has been saved.', 'default', array('class' => 'success-message'), 'review');
                return $this->redirect(array('action' => 'index'));
            } else {
				$this->Session->setFlash('The Review could not be saved. Please, try again.', 'default', array('class' => 'error-message'), 'review');
				return $this->redirect(array('action' => 'index'));
            }
        } 
        
        $rating = $this->Review->find('first', array('conditions' => array('Review.id' => $id)));
        $this->set('rating', $rating);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid review'));
        }
        if ($this->Review->delete()) {
            $this->Session->setFlash('The Review has been deleted successfully.', 'default', array('class' => 'success-message'), 'review');
        } else {
            $this->Session->setFlash('The Review has not been saved. Pleas try again later', 'default', array('class' => 'error-message'), 'review');
        }
        return $this->redirect(array('action' => 'index'));
    }
	
	
	/**********************************************/
	/********  SPA date starts from here  *********/
	/**********************************************/
	
	
	
	public function addReview(){
	
		$this->loadModel('Review');
	
		if($this->request->is('post')){
		
			$this->request->data['Review']['user_id']	=	$this->Auth->user('id');
			$this->request->data['Review']['rating']	=	$this->request->data['rating'];
			$this->request->data['Review']['salon_id']	=	$this->request->data['salon_id'];
			$this->request->data['Review']['order_id']	=	$this->request->data['order_id'];
			
			$this->Review->create();
			
			if($this->Review->save($this->request->data)){
			
			
				$this->loadModel('User');
				
				$reviews = $this->Review->find('all', array('conditions' => array('Review.salon_id' => $this->request->data['salon_id'])));
				
				$review_total = 0;
				
				if(!empty($reviews)){
					foreach($reviews as $review){
						$review_total = $review_total + $review['Review']['rating'];
					}
				}
				
				$avg_rating = $review_total/ count($reviews);
				
				$this->User->updateAll(array('User.avg_rating' => $avg_rating), array('User.id' => $this->request->data['salon_id']));
			
				echo 'success';
				exit;
			}else{
				echo 'error';
				exit;
			}
		}
	}
}
