<?php
App::uses('AppController', 'Controller');
/**
 * Userstatuses Controller
 *
 * @property Userstatus $Userstatus
 * @property PaginatorComponent $Paginator
 */
class UserstatusesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Userstatus->recursive = 0;
		$this->set('userstatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userstatus->exists($id)) {
			throw new NotFoundException(__('Invalid userstatus'));
		}
		$options = array('conditions' => array('Userstatus.' . $this->Userstatus->primaryKey => $id));
		$this->set('userstatus', $this->Userstatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userstatus->create();
			if ($this->Userstatus->save($this->request->data)) {
				$this->Session->setFlash(__('The userstatus has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userstatus could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Userstatus->exists($id)) {
			throw new NotFoundException(__('Invalid userstatus'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userstatus->save($this->request->data)) {
				$this->Session->setFlash(__('The userstatus has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userstatus could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Userstatus.' . $this->Userstatus->primaryKey => $id));
			$this->request->data = $this->Userstatus->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userstatus->id = $id;
		if (!$this->Userstatus->exists()) {
			throw new NotFoundException(__('Invalid userstatus'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Userstatus->delete()) {
			$this->Session->setFlash(__('The userstatus has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The userstatus could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
