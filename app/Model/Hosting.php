<?php
App::uses('AppModel', 'Model');
/**
 * Website Model
 *
 * @property Customer $Customer
 */
class Hosting extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'website_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'required' => true,
			),
		),
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty','isUnique'),
				'required' => true,
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'required' => true,
			),
		),
		'hostname' => array(
			'notEmpty' => array(
				'rule' => array('isUnique'),
				'required' => true,
			),
		),
		'server_id' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				'required' => true,
			),
		),
		'hostingpackage_id' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				'required' => true,
			),
		),
		'created_user_id' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				'required' => true,
				'on' => 'create',
			)
		),
		'modified_user_id' => array(
			'notEmpty' => array(
				'rule' => array('numeric'),
				'required' => true,
				'on' => 'update',
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Website' => array(
			'className' => 'Website',
			'foreignKey' => 'website_id',
			'order' => 'Website.name'
		),
		'Websitecategory' => array(
			'className' => 'Websitecategory',
			'foreignKey' => 'websitecategory_id',
		),
		'Hostingpackage' => array(
			'className' => 'Hostingpackage',
			'foreignKey' => 'hostingpackage_id',
		),
		'Server' => array(
			'className' => 'Server',
			'foreignKey' => 'server_id',
		)
	);
}
