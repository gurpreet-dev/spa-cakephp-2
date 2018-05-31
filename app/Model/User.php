<?php
App::uses('AppModel', 'Model');
class User extends AppModel {

////////////////////////////////////////////////////////////

       public $validate = array(
//     'confirmpassword' => array(
//        'compare'    => array(
//        'rule'      => array('validate_passwords'),
//        'message' => 'The passwords you entered do not match.',
//    )
//),
//  'first_name' => array(
//      'rule' => 'alphaNumeric',
//      'required' => true,
//       'message' => 'Required'
//    ),
//  'last_name' => array(
//      'rule' => 'alphaNumeric',
//      'required' => true,
//      'allowEmpty' => false,
//       'message' => 'Required'
//    ),
//  'email' => array(
//      'rule' => 'email',
//      'required' => true,
//      'allowEmpty' => false,
//       'message' => 'Required'
//    ),
//  'password' => array(
//      'rule' => 'alphaNumeric',
//      'required' => true,
//      'allowEmpty' => false,
//       'message' => 'Required'
//    )    

    ); 
       
    
    
    public $hasMany = array(
        'Bookings' => array(
            'className' => 'Order',
            'foreignKey' => 'salon_id',
            'dependent' => false, 
            'conditions' => array('service_status' => 'completed'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),'Ratings' => array(
            'className' => 'Reviews',
            'foreignKey' => 'salon_id',
            'dependent' => false, 
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),'Services' => array(
            'className' => 'Service',
            'foreignKey' => 'user_id',
            'dependent' => false, 
            'conditions' => array('status' => '1'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
		
		);
		
       
////////////////////////////////////////////////////////////

    public function beforeSave($options = array()) {
       
        if(isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
   public function validate_passwords() {
    return $this->data[$this->alias]['password'] === $this->data[$this->alias]['confirmpassword'];
}
////////////////////////////////////////////////////////////

    function getActivationHash()
        {
                if (!isset($this->id)) {
                        return false;
                }
                return substr(Security::hash(Configure::read('Security.salt') . $this->field('created') . date('Ymd')), 0, 8);
        }

////////////////////////////////////////////////////////////
    
}
