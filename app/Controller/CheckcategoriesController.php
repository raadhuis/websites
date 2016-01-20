<?php
App::uses('AppController', 'Controller');

/**
 * Checkcategories Controller
 *
 * @property Checkcategory $Checkcategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CheckcategoriesController extends AppController
{

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
    public function index()
    {
        $this->Checkcategory->recursive = 0;
        $this->set('checkcategories', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Checkcategory->exists($id)) {
            throw new NotFoundException(__('Invalid checkcategory'));
        }
        $options = array('conditions' => array('Checkcategory.' . $this->Checkcategory->primaryKey => $id));
        $this->set('checkcategory', $this->Checkcategory->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Checkcategory->create();
            if ($this->Checkcategory->save($this->request->data)) {
                $this->Session->setFlash(__('The checkcategory has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The checkcategory could not be saved. Please, try again.'));
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
    public function edit($id = null)
    {
        if (!$this->Checkcategory->exists($id)) {
            throw new NotFoundException(__('Invalid checkcategory'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Checkcategory->save($this->request->data)) {
                $this->Session->setFlash(__('The checkcategory has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The checkcategory could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Checkcategory.' . $this->Checkcategory->primaryKey => $id));
            $this->request->data = $this->Checkcategory->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Checkcategory->id = $id;
        if (!$this->Checkcategory->exists()) {
            throw new NotFoundException(__('Invalid checkcategory'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Checkcategory->delete()) {
            $this->Session->setFlash(__('The checkcategory has been deleted.'));
        } else {
            $this->Session->setFlash(__('The checkcategory could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
