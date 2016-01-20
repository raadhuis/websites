<?php
App::uses('AppController', 'Controller');

/**
 * Checks Controller
 *
 * @property Check $Check
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReportsController extends AppController
{


    public $uses = array('Check', 'Website', 'User', 'Report');


    public $statuscodes = array(
        301 => 'Moved Permanently',
        404 => 'Not Found'
    );
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('publicview');
    }


    /**
     * index method
     *
     * @return void
     */
    public function publicview()
    {
        $this->Check->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 250,
            'order' => array(
                'Checkcategory.name' => 'asc',
                'Check.name' => 'asc'
            )
        );

        $this->set('checks', $this->Paginator->paginate());
        $this->layout = 'blanko';
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($website_id, $check_id)
    {
        $options = array('conditions' => array('Report.website_id' => $website_id, 'Report.check_id' => $check_id));
        $this->set('report', $this->Report->find('first', $options));

        $this->layout = 'ajax';
    }

    /**
     * add method
     *
     * @return void
     */
    public function addedit($website_id, $check_id)
    {
        if ($this->User->getRoleNameById($this->Auth->user('id')) <> 'admin') {
            die();
        }


        $report_id = 0;

        $options = array('conditions' => array('Report.website_id' => $website_id, 'Report.check_id' => $check_id));

        $tempReport = $this->Report->find('first', $options);

        if (isset($tempReport['Report']['id'])) {
            $report_id = $tempReport['Report']['id'];
        }

        if ($this->request->is(array('post', 'put'))) {
            if (!$this->Report->exists($report_id)) {
                $this->Report->create();
                if ($this->Report->save($this->request->data)) {
                    echo 'ok';
                    die();
                }
            } else {
                if ($this->Report->save($this->request->data)) {
                    echo 'ok';
                    die();
                }
            }
        }

        $this->request->data = $this->Report->find('first', $options);
        $reportcategories = $this->Report->Reportcategory->find('list');
        $this->set('user_id', $this->Auth->user('id'));
     //   $this->set('show', 'show');
        $this->set(compact('reportcategories', 'check_id', 'website_id'));
        $this->layout = 'ajax';
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
        $this->Check->id = $id;
        if (!$this->Check->exists()) {
            throw new NotFoundException(__('Invalid check'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Check->delete()) {
            $this->Session->setFlash(__('The check has been deleted.'));
        } else {
            $this->Session->setFlash(__('The check could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
