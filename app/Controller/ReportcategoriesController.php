<?php
App::uses('AppController', 'Controller');
/**
 * Reportcategories Controller
 *
 * @property Reportcategory $Reportcategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReportcategoriesController extends AppController {

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
		$this->Reportcategory->recursive = 0;
		$this->set('reportcategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reportcategory->exists($id)) {
			throw new NotFoundException(__('Invalid Reportcategory'));
		}
		$options = array('conditions' => array('Reportcategory.' . $this->Reportcategory->primaryKey => $id));
		$this->set('reportcategory', $this->Reportcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reportcategory->create();
			if ($this->Reportcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Reportcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Reportcategory could not be saved. Please, try again.'));
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
		if (!$this->Reportcategory->exists($id)) {
			throw new NotFoundException(__('Invalid Reportcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reportcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Reportcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Reportcategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reportcategory.' . $this->Reportcategory->primaryKey => $id));
			$this->request->data = $this->Reportcategory->find('first', $options);
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
		$this->Reportcategory->id = $id;
		if (!$this->Reportcategory->exists()) {
			throw new NotFoundException(__('Invalid Reportcategory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Reportcategory->delete()) {
			$this->Session->setFlash(__('The Reportcategory has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Reportcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
