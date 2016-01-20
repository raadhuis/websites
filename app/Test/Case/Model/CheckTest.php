<?php
App::uses('Check', 'Model');

/**
 * Check Test Case
 *
 */
class CheckTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.check',
		'app.checkcategory',
		'app.website',
		'app.checks_website'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Check = ClassRegistry::init('Check');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Check);

		parent::tearDown();
	}

}
