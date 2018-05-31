<?php
App::uses('AppModel', 'Model');
/**
 * Dish Model
 *
 * @property Cat $Cat
 * @property n $n
 */
class Review extends AppModel {

/**
 * Display field
 *
 * @var string
 */
  public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Salon' => array(
			'className' => 'User',
			'foreignKey' => 'salon_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/*public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/


}
