<?php
App::uses('Checkcategory', 'Model');

/**
 * Checkcategory Test Case
 *
 */
class CheckcategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.checkcategory',
		'app.check'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Checkcategory = ClassRegistry::init('Checkcategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Checkcategory);

		parent::tearDown();
	}

}
