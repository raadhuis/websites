<?php
App::uses('AppController', 'Controller');
/**
 * Priorities Controller
 *
 * @property Priority $Priority
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PrioritiesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Priority->recursive = 0;
		$this->set('priorities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Priority->exists($id)) {
			throw new NotFoundException(__('Invalid priority'));
		}
		$options = array('conditions' => array('Priority.' . $this->Priority->primaryKey => $id));
		$this->set('priority', $this->Priority->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Priority->create();
			if ($this->Priority->save($this->request->data)) {
				$this->Session->setFlash(__('The priority has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The priority could not be saved. Please, try again.'));
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
		if (!$this->Priority->exists($id)) {
			throw new NotFoundException(__('Invalid priority'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Priority->save($this->request->data)) {
				$this->Session->setFlash(__('The priority has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The priority could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Priority.' . $this->Priority->primaryKey => $id));
			$this->request->data = $this->Priority->find('first', $options);
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
		$this->Priority->id = $id;
		if (!$this->Priority->exists()) {
			throw new NotFoundException(__('Invalid priority'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Priority->delete()) {
			$this->Session->setFlash(__('The priority has been deleted.'));
		} else {
			$this->Session->setFlash(__('The priority could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
