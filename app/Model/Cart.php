<?php
App::uses('AppModel', 'Model');
class Cart extends AppModel {

////////////////////////////////////////////////////////////

  public $belongsTo = array(
      'Product' => array(
          'className' => 'Product',
          'foreignKey' => 'product_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),'User' => array(
          'className' => 'User',
          'foreignKey' => 'uid',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      )
  );

////////////////////////////////////////////////////////////

}
