<?php
App::uses('AppController', 'Controller');
class CartsController extends AppController {

////////////////////////////////////////////////////////////

    public $scaffold = 'admin';
///////////////////////////////////////////////////////////

    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow('api_addtocart', 'api_getcartdata');
    } 
    
    
    
    
////////////////////////////////////////////////////////////
public function admin_view($id=null){
     Configure::write("debug", 0);
      
        if (!$this->Cart->exists($id)) {
            throw new NotFoundException(__('Invalid restaurant'));
        }
        $options = array('conditions' => array('Cart.' . $this->Cart->primaryKey => $id));
        $this->loadModel('Product');
        $this->loadModel('Restaurant');
        $this->loadModel('User');
        $this->Cart->recursive = 2;
        $data = $this->Cart->find('first', $options);
        //print_r($data);exit;
        $this->set('cart', $data);
}

public function admin_delete($id = null) {

        $this->Cart->id = $id;
     

        if (!$this->Cart->exists()) {

            throw new NotFoundException(__('Invalid restaurant'));

        }

       // $this->request->allowMethod('post', 'delete');

        if ($this->Cart->delete()){

            $this->Session->setFlash(__('The cart product has been deleted.'));

            return $this->redirect(array('controller'=>'dashboards','action' => 'dashboard'));

        } else {

            $this->Session->setFlash(__('The cart product could not be deleted. Please, try again.'));

            return $this->redirect(array('controller'=>'dashboards','action' => 'dashboard'));

        }

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
    
    
     public function cartcount($uid) {
        $cartcount = ClassRegistry::init('Cart')->find('all', array(
            'conditions' => array(
               'Cart.uid' => $uid
       )));
        $quantity=0;
        if(!empty($cartcount)){
            for($i=0; $i<count($cartcount); $i++){
                $quantity = $quantity+$cartcount[$i]['Cart']['quantity'];
            }
        }
        return $quantity;
    }
    
    
    
    
    
    public function api_addtocart(){
       
      $postdata = file_get_contents("php://input");
        $redata = json_decode($postdata);

        ob_start();

        $c = ob_get_clean();

        $fc = fopen('files' . DS . 'detail.txt', 'w');

        fwrite($fc, $c);

        fclose($fc);
    
        $userid = $redata->userid;
        $product_id = $redata->product_id;
        $quantity = $redata->quantity;
//        
//        $userid = 43;
//        $product_id = 68;
//        $quantity =1;
//        
        $this->loadModel('Product');
        
        $check = $this->Cart->find('all', array('conditions' => array('Cart.product_id' => $product_id, 'Cart.uid' => $userid)));
        
        $product = $this->Product->find('first', array('conditions' => array('Product.id' => $product_id)));
        
        $cartdata['Cart']['quantity'] = $quantity;
        $cartdata['Cart']['uid'] = $userid;
        $cartdata['Cart']['store_id'] = $product['Product']['res_id'];
        $cartdata['Cart']['product_id'] = $product['Product']['id'];
        $cartdata['Cart']['image'] = $product['Product']['image'];
        $cartdata['Cart']['name'] = $product['Product']['name'];
        $cartdata['Cart']['weight'] = $product['Product']['weight'];
        $cartdata['Cart']['weight_total'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
        $cartdata['Cart']['price'] = $product['Product']['price'];
        $cartdata['Cart']['subtotal'] = sprintf('%01.2f', $product['Product']['price'] * $quantity);
        $response=array();
        if($check){
            $this->Cart->updateAll(array('Cart.quantity' => $quantity,'Cart.weight' =>  $cartdata['Cart']['weight'], 'Cart.weight_total' => $cartdata['Cart']['weight_total'], 'Cart.price' => $cartdata['Cart']['price'], 'Cart.subtotal' => $cartdata['Cart']['subtotal']), array('Cart.product_id' => $cartdata['Cart']['product_id'], 'Cart.uid' => $userid));
            $response['msg']="item updated";
            $response['cartcount']= $this->cartcount($userid);
            }else{
            $this->Cart->save($cartdata, false);
             $response['msg']="item added to cart";
             $response['cartcount']= $this->cartcount($userid);
        }
        //echo "<pre>"; print_r($response); echo "</pre>"; exit;
        echo json_encode($response);
        exit;
    }
    
   public function api_getcartdata(){
        $postdata = file_get_contents("php://input");
        $redata = json_decode($postdata);

        ob_start();

        $c = ob_get_clean();

        $fc = fopen('files' . DS . 'detail.txt', 'w');

        fwrite($fc, $c);

        fclose($fc);
    
        $userid = $redata->userid;
       // $userid = 43;
        $this->Cart->recursive=1;
         $alldata = $this->Cart->find('all', array('conditions' => array('Cart.uid' => $userid)));
         if(!empty($alldata)){
             $totalamount=0;
             for($i=0; $i<count($alldata); $i++){
                 $totalamount=$totalamount+$alldata[$i]['Cart']['subtotal'];
                 $alldata[$i]['Product']['image']=FULL_BASE_URL . $this->webroot . 'images/large/'.$alldata[$i]['Product']['image'];
             }
             $response['cartdata']=$alldata;
             $response['carttotal']=$totalamount;
         }else{
             $response['cartdata']=[];
             $response['carttotal']="";
         }
      // echo "<pre>"; print_r($response); echo "</pre>"; exit;
        echo json_encode($response);
        exit;
       
       
   } 
   
   
  public function api_fileupload(){
//      $postdata = file_get_contents("php://input");
//        $redata = json_decode($postdata);
        
        echo json_encode(array($this->request->data));
        exit;
  } 
  
   
}
