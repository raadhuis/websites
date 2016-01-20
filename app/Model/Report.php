<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 * @property User $User
 * @property Website $Website
 */
class Report extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'status';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Reportcategory' => array(
			'className' => 'Reportcategory',
			'foreignKey' => 'reportcategory_id',
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
		),
		'Website' => array(
			'className' => 'Website',
			'foreignKey' => 'website_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Website.name'
		),
		'Check' => array(
			'className' => 'Check',
			'foreignKey' => 'check_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)

	);
}
