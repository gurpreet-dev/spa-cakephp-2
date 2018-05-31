<?php

App::uses('AppModel', 'Model');

class Service extends AppModel {

     public $belongsTo = array(

        'Category' => array(

            'className' => 'Category', 

            'foreignKey' => 'category_id',

            'conditions' => '',

            'fields' => '',

            'order' => ''

        ),
		'User' => array(

            'className' => 'User', 

            'foreignKey' => 'user_id',

            'conditions' => '',

            'fields' => '',

            'order' => ''

        )

    );     

}

?>