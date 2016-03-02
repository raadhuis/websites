<?php
App::uses('AppController', 'Controller');

/**
 * Migrations Controller
 *
 * @property Migration $Migration
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MigrationsController extends AppController
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

        $this->Paginator->settings = array(
            'order' => array(
                'sorting' => 'asc'
            )
        );

        $this->Migration->recursive = 0;
        $this->set('migrations', $this->Paginator->paginate());
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Migration->create();
            if ($this->Migration->save($this->request->data)) {
                $this->Session->setFlash(__('The Migration has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Migration could not be saved. Please, try again.'));
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
        if (!$this->Migration->exists($id)) {
            throw new NotFoundException(__('Invalid Migration'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Migration->save($this->request->data)) {
                $this->Session->setFlash(__('The Migration has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Migration could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Migration.' . $this->Migration->primaryKey => $id));
            $this->request->data = $this->Migration->find('first', $options);
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
        $this->Migration->id = $id;
        if (!$this->Migration->exists()) {
            throw new NotFoundException(__('Invalid Migration'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Migration->delete()) {
            $this->Session->setFlash(__('The Migration has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Migration could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
