<?php

App::uses('AppController', 'Controller');

class ParentCategoriesController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow(array('api_catview'));
    }
    public function admin_index(){
         if ($this->request->is("post")) {

             // print_r($this->request->data);
            $filter = $this->request->data['ParentCategory']['filter'];
            $name = $this->request->data['ParentCategory']['name'];
            $categ = $this->ParentCategory->find('all', array('conditions'=>array('ParentCategory.' . $filter . ' LIKE' => '%' . $name . '%')));
       
       $this->set('paretcat',$categ);
          
    }else{
        /***************************************************************/
     
        $this->Paginator = $this->Components->load('Paginator');
        if($this->Auth->user('role')!='rest_admin'){
        $this->Paginator->settings = array(
            'ParentCategory' => array(
                'recursive' => 0,
            )
        );
        }else{
            $this->Paginator->settings = array(
            'ParentCategory' => array(
                'recursive' => 0,
                'conditions'=>array('ParentCategory.user_id'=>$this->Auth->user('id')),
            )
        );
        }
        $this->set('paretcat', $this->Paginator->paginate());
    }
    }
    public function admin_add() {
        configure::write('debug',0);
        if ($this->request->is('post')) {
            $this->ParentCategory->create();
            if ($this->ParentCategory->save($this->request->data)) {
                $this->Session->setFlash('The ParentCategory has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The ParentCategory could not be saved. Please, try again.');
            }
        }

        //$parents = $this->ParentCategory->generateTreeList(null, null, null, ' -- ');
        //$this->set(compact('parents'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->ParentCategory->exists($id)) {
            throw new NotFoundException('Invalid category');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ParentCategory->save($this->request->data)) {
                $this->Session->setFlash('The Parent Category has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The Parent Category could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->ParentCategory->find('first', array('conditions' => array('ParentCategory.id' => $id)));
        }

        //$parents = $this->Category->generateTreeList(null, null, null, ' -- ');
        //$this->set(compact('parents'));
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->ParentCategory->id = $id;
        if (!$this->ParentCategory->exists()) {
            throw new NotFoundException('Invalid category');
        }
        //$this->request->onlyAllow('post', 'delete');
        if ($this->ParentCategory->delete()) {
            $this->Session->setFlash('Parent Category deleted');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Parent Category was not deleted');
        return $this->redirect(array('action' => 'index'));
    }
    public function admin_view($id = null) {
        if (!$this->ParentCategory->exists($id)) {
            throw new NotFoundException('Invalid category');
        }
        $category = $this->ParentCategory->find('first', array(
           
            'conditions' => array(
                'ParentCategory.id' => $id
            )
        ));
        $this->set(compact('category'));
    }
    public function admin_reset(){
        
        $this->Session->delete('ParentCategory');
        return $this->redirect(array('action' => 'index'));
    }
}
