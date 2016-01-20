<?php
App::uses('AppController', 'Controller');

class DashboardController extends AppController
{

    public $uses = array(
        'User'
    );


    public function index()
    {
        $user = $this->Auth->user();
        $this->redirect($this->User->getRoleNameById($user['id']));
    }

    public function tc()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));
        if ($role <> 'tc') {
            $this->Session->setFlash(__('TC Function only..'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
        $user = $this->Auth->user();
        $this->set('name', $user['name']);
    }

    public function oc()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));
        if ($role <> 'oc') {
            $this->Session->setFlash(__('OC Function only..'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
        $user = $this->Auth->user();
        $this->set('name', $user['name']);
    }

    public function hod()
    {

        $role = $this->User->getRoleNameById($this->Auth->user('id'));
        if ($role <> 'hod') {
            $this->Session->setFlash(__('Manager Function only'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }

        $user = $this->Auth->user();
        $this->set('name', $user['name']);
    }

    public function icgvisitor()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));
        if ($role <> 'icgvisitor') {
            $this->Session->setFlash(__('Manager Function only'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }

        $user = $this->Auth->user();
        $this->set('name', $user['name']);
    }

    public function admin()
    {
        $this->manager();
        $this->render('manager');
    }

    public function manager()
    {

        $role = $this->User->getRoleNameById($this->Auth->user('id'));
        if ($role <> 'manager' && $role <> 'admin') {
            $this->Session->setFlash(__('Manager Function only'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }


        $this->set('usercount', $this->User->find('count'));
    }
}

?>