<?php
class CartComponent extends Component {

//////////////////////////////////////////////////

    public $components = array('Session');

//////////////////////////////////////////////////

    public $controller;

//////////////////////////////////////////////////

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array)$settings));
    }

//////////////////////////////////////////////////

    public function startup(Controller $controller) {
        //$this->controller = $controller;
    }

//////////////////////////////////////////////////

    public $maxQuantity = 99;

//////////////////////////////////////////////////

    /*public function add($id, $quantity = 1, $productmodId = null,$storeid ,$userid) {
 
        if($productmodId) {
            $productmod = ClassRegistry::init('Productmod')->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'Productmod.id' => $productmodId,
                    'Productmod.product_id' => $id,
                )
            ));
        }

        if(!is_numeric($quantity)) {
            $quantity = 1;
        }

        $quantity = abs($quantity);

        if($quantity > $this->maxQuantity) {
            $quantity = $this->maxQuantity;
        }

        if($quantity == 0) {
            $this->remove($id);
            return;
        }

        $product = $this->controller->Product->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        if(empty($product)) {
            return false;
        }

        if($this->Session->check('Shop.OrderItem.' . $id . '.Product.productmod_name')) {
            $productmod['Productmod']['id'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.productmod_id');
            $productmod['Productmod']['name'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.productmod_name');
            $productmod['Productmod']['price'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.price');

        }

        if(isset($productmod)) {
            $product['Product']['productmod_id'] = $productmod['Productmod']['id'];
            $product['Product']['productmod_name'] = $productmod['Productmod']['name'];
            $product['Product']['price'] = $productmod['Productmod']['price'];
            $productmodId = $productmod['Productmod']['id'];
            $data['productmod_id'] = $product['Product']['productmod_id'];
            $data['productmod_name'] = $product['Product']['productmod_name'];
        } else {
            $product['Product']['productmod_id'] = '';
            $product['Product']['productmod_name'] = '';
            $productmodId = 0;
            $data['productmod_id'] = '';
            $data['productmod_name'] = '';
        }

        $data['product_id'] = $product['Product']['id'];
        $data['name'] = $product['Product']['name'];
        $data['weight'] = $product['Product']['weight'];
        $data['price'] = $product['Product']['price'];
        $data['quantity'] = $quantity;
        $data['store_id'] = $storeid;
        $data['subtotal'] = sprintf('%01.2f', $product['Product']['price'] * $quantity);
        $data['totalweight'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
        $data['Product'] = $product['Product'];
        $this->Session->write('Shop.OrderItem.' . $id . '_' . $productmodId, $data);
        $this->Session->write('Shop.Order.shop', 1);

        $this->Cart = ClassRegistry::init('Cart');

        $cartdata['Cart']['sessionid'] = $this->Session->id();
        $cartdata['Cart']['quantity'] = $quantity;
        $cartdata['Cart']['uid'] = $userid;
        $cartdata['Cart']['store_id'] = $storeid;
        $cartdata['Cart']['product_id'] = $product['Product']['id'];
        $cartdata['Cart']['name'] = $product['Product']['name'];
        $cartdata['Cart']['weight'] = $product['Product']['weight'];
        $cartdata['Cart']['weight_total'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
        $cartdata['Cart']['price'] = $product['Product']['price'];
        $cartdata['Cart']['subtotal'] = sprintf('%01.2f', $product['Product']['price'] * $quantity);

        $existing = $this->Cart->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Cart.sessionid' => $this->Session->id(),
                'Cart.product_id' => $product['Product']['id'],
            )
        ));
        if($existing) {
            $cartdata['Cart']['id'] = $existing['Cart']['id'];
        } else {
            $this->Cart->create();
        }
   
        $this->Cart->save($cartdata, false);
        $this->cart(); 

        return $product;
    }*/
    
    
    public function add($service_id, $data = array()) {
        
        
        $alldata = array(
            'service_id'   =>  $data['service_id'],
            'category'     =>  $data['category'],
            'service'     =>  $data['service'],
            'time'     =>  $data['time'],
            'price'     =>  $data['price']
        );
        
        $this->Session->write('Shop.OrderItem.'.$service_id, $alldata);
        
        $items = $this->Session->read('Shop.OrderItem');
        
        $time = 0;
        $price = 0;
        
        if(!empty($items)){
            foreach($items as $item){
                $time = $time + $item['time'];
            }

            foreach($items as $item){
                $price = $price + $item['price'];
            }
        }
        
        $this->Session->write('Shop.Count', count($items));
        $this->Session->write('Shop.Time', $time);
        $this->Session->write('Shop.Price', number_format($price,2)); 
        $this->Session->write('Shop.Salon', $data['user_id']); 
        $this->Session->write('Shop.Booking_date', ''); 
        $this->Session->write('Shop.Start_time', ''); 
        $this->Session->write('Shop.End_time', ''); 
        
    }
    
    public function remove($id) {
        if($this->Session->check('Shop.OrderItem.' . $id)) {
            $this->Session->delete('Shop.OrderItem.' . $id);
            
            $items = $this->Session->read('Shop.OrderItem');
        
            $time = 0;
            $price = 0;

            if(!empty($items)){
                foreach($items as $item){
                    $time = $time + $item['time'];
                }

                foreach($items as $item){
                    $price = $price + $item['price'];
                }
            }

            $this->Session->write('Shop.Count', count($items));
            $this->Session->write('Shop.Time', $time);
            $this->Session->write('Shop.Price', number_format($price,2));
            
            $count = $this->Session->read('Shop.Count');
            
            if($count == '0'){
                $this->Session->delete('Shop');
            }
        }
    }    
    
    
    public function adddatetime($data){
        $this->Session->write('Shop.Booking_date', $data['date']);
        $this->Session->write('Shop.Start_time', $data['start_time']);
        $this->Session->write('Shop.End_time', $data['end_time']);
    }
    
    public function removedatetime($data){
        $this->Session->write('Shop.Booking_date', '');
        $this->Session->write('Shop.Start_time', '');
        $this->Session->write('Shop.End_time', '');
    }

   //////////////////////////////////////////////////
    public function checkcrt($sid, $pid) {
        $shop = ClassRegistry::init('Cart')->find('all', array( 
            'conditions' => array(
                'AND' => array( 
                    'Cart.sessionid' => $sid, 
                    'Cart.product_id' => $pid
        ))));
        return $shop;
    } 
    
    public function checkCartStore($uid) {
        $shop = ClassRegistry::init('Cart')->find('first', array(
            'conditions' => array(
                'AND' => array( 
                    'Cart.uid' => $uid
        ))));
        return $shop;
    } 
    
    /////////////////////////////////////
    
        public function appcart($uid, $sid) {
        $shop = ClassRegistry::init('Cart')->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'Cart.uid' => $uid,
                    'Cart.sessionid' => $sid
        ))));
        $quantity = 0;
        $weight = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;

        $cnt = count($shop);
        for ($i = 0; $i < $cnt; $i++) {

            $shop[$i]['Cart']['image'] = FULL_BASE_URL . "/shop/images/large/" . $shop[$i]['Cart']['image'];   
        }


        if (count($shop) > 0) {
            foreach ($shop as $item) {
                $quantity += $item['Cart']['quantity'];
                $weight += $item['Cart']['weight'];
                $subtotal += $item['Cart']['subtotal'];
                $total += $item['Cart']['subtotal'];
                $order_item_count++;
            }
            $d['order_item_count'] = $order_item_count;
            $d['quantity'] = $quantity;
            $d['weight'] = sprintf('%01.2f', $weight);
            $d['subtotal'] = sprintf('%01.2f', $subtotal);
            $d['total'] = sprintf('%01.2f', $total);
            return array($d, $shop);
        } else {
            $d['quantity'] = 0;
            $d['weight'] = 0;
            $d['subtotal'] = 0;
            $d['total'] = 0;
            return array($d, $shop);
        }
    } 
    
//////////////////////////////////////////////////
    
        public function appadd($id, $quantity = 1, $productmodId = null, $uid = NULL, $sid = NULL) { 

        if ($productmodId) {
            $productmod = ClassRegistry::init('Productmod')->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'Productmod.id' => $productmodId,
                    'Productmod.product_id' => $id,
                )
            ));
        }

        if (!is_numeric($quantity)) {
            $quantity = 1;
        }

        $quantity = abs($quantity);

        if ($quantity > $this->maxQuantity) {
            $quantity = $this->maxQuantity;
        }

        if ($quantity == 0) {
            $this->remove($id);
            return;
        }

        $product = $this->controller->Product->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        if (empty($product)) {
            return false;
        }

        if ($this->Session->check('Shop.OrderItem.' . $id . '.Product.productmod_name')) {
            $productmod['Productmod']['id'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.productmod_id');
            $productmod['Productmod']['name'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.productmod_name');
            $productmod['Productmod']['price'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.price');
        }

        if (isset($productmod)) {
            $product['Product']['productmod_id'] = $productmod['Productmod']['id'];
            $product['Product']['productmod_name'] = $productmod['Productmod']['name'];
            $product['Product']['price'] = $productmod['Productmod']['price'];
            $productmodId = $productmod['Productmod']['id'];
            $data['productmod_id'] = $product['Product']['productmod_id'];
            $data['res_id'] = $product['Product']['res_id'];
            $data['productmod_name'] = $product['Product']['productmod_name'];
        } else {
            $product['Product']['productmod_id'] = '';
            $product['Product']['productmod_name'] = '';
            $productmodId = 0;
            $data['productmod_id'] = '';
            $data['productmod_name'] = '';
        }

        $data['product_id'] = $product['Product']['id'];
        $data['name'] = $product['Product']['name'];
        $data['weight'] = $product['Product']['weight'];
        $data['price'] = $product['Product']['price'];
        $data['quantity'] = $quantity;
        $data['subtotal'] = sprintf('%01.2f', ($product['Product']['price'] * $quantity)+$product['Product']['box']);
        $data['totalweight'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
        $data['Product'] = $product['Product'];
        $data['res_id'] = $product['Product']['res_id'];
        $this->Session->write('Shop.OrderItem.' . $id . '_' . $productmodId, $data);
        $this->Session->write('Shop.Order.shop', 1);

        $this->Cart = ClassRegistry::init('Cart');

        $cartdata['Cart']['sessionid'] = $sid;
        $cartdata['Cart']['quantity'] = $quantity;
        $cartdata['Cart']['product_id'] = $product['Product']['id'];
        $cartdata['Cart']['name'] = $product['Product']['name'];
        $cartdata['Cart']['weight'] = $product['Product']['weight'];
        $cartdata['Cart']['weight_total'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
        $cartdata['Cart']['price'] = $product['Product']['price'];
        $cartdata['Cart']['resid'] = $product['Product']['res_id'];
        $cartdata['Cart']['subtotal'] = sprintf('%01.2f', ($product['Product']['price'] * $quantity)+$product['Product']['box']);
        $cartdata['Cart']['uid'] = $uid;
        $cartdata['Cart']['image'] = $product['Product']['image'];

        $existing = $this->Cart->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Cart.sessionid' => $this->Session->id(),
                'Cart.product_id' => $product['Product']['id'],
            )
        ));
        if ($existing) {
            $cartdata['Cart']['id'] = $existing['Cart']['id'];
        } else {
            $this->Cart->create();
        }
        $this->Cart->save($cartdata, false);

        $this->cart();

        return $product;
    }
    
    /////////////////////////////////////////////

//    public function remove($id) {
//        if($this->Session->check('Shop.OrderItem.' . $id)) {
//            $product = $this->Session->read('Shop.OrderItem.' . $id);
//            $this->Session->delete('Shop.OrderItem.' . $id);
//
//            ClassRegistry::init('Cart')->deleteAll(
//                array(
//                    'Cart.sessionid' => $this->Session->id(),
//                    'Cart.product_id' => $id,
//                ),
//                false
//            );
//
//            $this->cart();
//            return $product;
//        }
//        return false;
//    }

//////////////////////////////////////////////////

    public function cart() {
        $shop = $this->Session->read('Shop');
        $quantity = 0;
        $weight = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;

        if (count($shop['OrderItem']) > 0) {
            foreach ($shop['OrderItem'] as $item) {
                $quantity += $item['quantity'];
                $weight += $item['totalweight'];
                $subtotal += $item['subtotal'];
                $total += $item['subtotal'];
                $order_item_count++;
            }
            $d['order_item_count'] = $order_item_count;
            $d['quantity'] = $quantity;
            $d['weight'] = sprintf('%01.2f', $weight);
            $d['subtotal'] = sprintf('%01.2f', $subtotal);
            $d['total'] = sprintf('%01.2f', $total);
            $this->Session->write('Shop.Order', $d + $shop['Order']);
            return true;
        }
        else {
            $d['quantity'] = 0;
            $d['weight'] = 0;
            $d['subtotal'] = 0;
            $d['total'] = 0;
            $this->Session->write('Shop.Order', $d + $shop['Order']);
            return false;
        }
    }

//////////////////////////////////////////////////

    public function clear() {
        //ClassRegistry::init('Cart')->deleteAll(array('Cart.sessionid' => $this->Session->id()), false);
        $this->Session->delete('Shop');
    }

//////////////////////////////////////////////////
    
    public function cartcount($uid) {
        $cartcount = ClassRegistry::init('Cart')->find('all', array(
            'conditions' => array(
               'Cart.uid' => $uid
       )));
        $quantity=0;
        
        return $cartcount;
    }
/////////////////////////////////////////////////    

}
