<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController
{
    public $helpers = array('Gravatar');
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'forgotpassword', 'activate', 'activatepassword', 'signup', 'signedup');
    }

    public function forgotpassword()
    {
        if ($this->request->isPost()) {
            $this->User->set($this->data);
            if ($this->User->LoginValidate()) {
                $email = $this->data['User']['email'];
                $user = $this->User->findByEmail($email);
                if (empty($user)) {
                    $this->Session->setFlash('Incorrect Email Address', 'alert', array('class' => 'alert-danger'));
                    return;
                }

                // check for inactive account
                if ($user['User']['id'] != 1 and $user['Userstatus']['id'] == 2) {
                    $this->Session->setFlash('Your registration has not been confirmed yet please verify your email before reset password', 'alert', array('class' => 'alert-danger'));
                    return;
                }
                $this->User->forgotPassword($user);
                $this->Session->setFlash('Please check your email to reset your password', 'alert', array('class' => 'alert-success'));
                $this->redirect('/users/login');
            }
        }
    }

    /**
     * Used to change the password by user
     *
     * @access public
     * @return void
     */
    public function changepassword()
    {
        if ($this->request->isPost()) {
            $this->User->set($this->data);
            if ($this->User->RegisterValidate()) {
                $this->User->id = $this->Auth->user('id');
                $this->request->data['User']['password'] = $this->request->data['User']['password'];
                $this->User->save($this->request->data, false);
                $this->Session->setFlash(__('Password changed successfully'), 'default', array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'dashboard'));
            }
        }
    }

    /**
     *  Used to reset password when user comes on the by clicking the password reset link from their email.
     *
     * @access public
     * @return void
     */
    public function activate()
    {
        $this->Auth->logout();
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data['User']['ident']) && !empty($this->request->data['User']['activate'])) {
                $this->set('ident', $this->request->data['User']['ident']);
                $this->set('activate', $this->request->data['User']['activate']);
                $email = $this->request->data["User"]["email"];
                $oldemail = $this->request->data["User"]["oldemail"];

                if ($this->request->data["User"]["email"] == $this->request->data["User"]["oldemail"]) {
                    unset($this->request->data["User"]["email"]);
                    unset($this->request->data["User"]["oldemail"]);
                }
                $this->User->set($this->request->data);

                if ($this->User->RegisterValidate()) {
                    $this->User->id = $this->request->data['User']['ident'];
                    $activateKey = $this->request->data['User']['activate'];
                    $user = $this->User->read();
                    if (!empty($user)) {
                        if ($this->User->getActivationKey($user['User']['id'] . $user['User']['password']) == $activateKey) {
                            $user['User']['password'] = $this->request->data['User']['password'];
                            $user['User']['cpassword'] = $this->request->data['User']['cpassword'];
                            if (isset($this->request->data["User"]["email"])) {
                                $user['User']['email'] = $this->request->data['User']['email'];
                            }
                            if (isset($this->request->data['User']['title_id'])) {
                                $user['User']['title_id'] = $this->request->data['User']['title_id'];
                                $user['User']['first_name'] = $this->request->data['User']['first_name'];
                                $user['User']['middle_name'] = $this->request->data['User']['middle_name'];
                                $user['User']['last_name'] = $this->request->data['User']['last_name'];
                            }
                            $user['User']['userstatus_id'] = 5; // todo get active from database instead of hard id here
                            if ($this->User->save($user)) {
                                $this->Session->setFlash('Uw account is geactiveerd. Log in om verder te gaan', 'default', array('class' => 'alert alert-success'));
                                $this->redirect('/users/login/');
                            } else {
                                $this->Session->setFlash('User cloud not be saved!', 'default', array('class' => 'alert alert-danger'));
                            }
                        } else {
                            $this->Session->setFlash('It looks like your activation key is not valid, maybe your account is already activated? Otherwise please try to click again on the link in email.', 'default', array('class' => 'alert alert-danger'));
                            $this->redirect('/users/login/');
                        }
                    } else {
                        $this->Session->setFlash('Something went wrong, please click again on the link in email', 'default', array('class' => 'alert alert-danger'));
                    }
                }
                $this->request->data['User']['oldemail'] = $oldemail;
                $this->request->data['User']['email'] = $email;
            } else {
                $this->Session->setFlash('Something went wrong, please click again on the link in email', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            if (isset($_GET['ident']) && isset($_GET['activate'])) {
                $this->set('ident', h($_GET['ident']));
                $this->set('activate', h($_GET['activate']));
                $options = array('conditions' => array('User.' . $this->User->primaryKey => h($_GET['ident'])));

                $this->request->data = $this->User->find('first', $options);
                $this->request->data['User']['oldemail'] = $this->request->data['User']['email'];

            }
        }

        $this->set('role', $this->User->getRoleNameById($_GET['ident']));
        $this->set('titles', $this->User->Title->find('list'));
    }

    public function activatepassword()
    {
        if ($this->request->isPost()) {
            if (!empty($this->data['User']['ident']) && !empty($this->data['User']['activate'])) {
                $this->set('ident', $this->data['User']['ident']);
                $this->set('activate', $this->data['User']['activate']);
                $this->User->set($this->data);
                if ($this->User->RegisterValidate()) {
                    $userId = $this->data['User']['ident'];
                    $activateKey = $this->data['User']['activate'];
                    $user = $this->User->read(null, $userId);
                    if (!empty($user)) {
                        $password = $user['User']['password'];
                        $thekey = $this->User->getActivationKey($userId . $password);
                        if ($thekey == $activateKey) {
                            $user['User']['password'] = $this->data['User']['password'];
                            //$user['User']['userstatus_id'] = 1; // active
                            $this->User->save($user, false);
                            $this->Session->setFlash('Your password has been placed successfully', 'default', array('class' => 'alert alert-success'));
                            $this->redirect('/users/login');
                        } else {
                            $this->Session->setFlash('Something went wrong, please send password reset link again', 'default', array('class' => 'alert alert-danger'));
                        }
                    } else {
                        $this->Session->setFlash('Something went wrong, please click again on the link in email', 'default', array('class' => 'alert alert-danger'));
                    }
                }
            } else {
                $this->Session->setFlash('Something went wrong, please click again on the link in email', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            if (isset($_GET['ident']) && isset($_GET['activate'])) {
                $this->set('ident', $_GET['ident']);
                $this->set('activate', $_GET['activate']);
            }
        }
    }

    public function signup()
    {

        if ($this->request->is('post')) {

            $this->User->create();
            $this->request->data['User']['userstatus_id'] = 4; //invited
            $this->request->data['User']['role_id'] = $this->User->getRoleIdByName('icgvisitor');

            if ($this->User->save($this->request->data)) {
                if ($this->User->invite($this->User->findById($this->User->id)) == true) {
                    $this->Session->setFlash(__('Activation email send to ' . $this->request->data['User']['email']), 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'signedup'));
                } else {
                    $this->Session->setFlash(__('The applicant is created in the backend but could not be invited. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
                }
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default', array('class' => 'alert alert-danger'));
            }

        }
        $this->set('titles', $this->User->Title->find('list'));

    }

    public function signedup()
    {

    }

    public function login()
    {
        if ($this->Auth->loggedIn()) {
            $this->redirect('/dashboard/');
        }
        if ($this->request->is('post')) {
            if ($this->User->LoginValidate()) {
                if ($this->Auth->login()) {
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Session->setFlash('The password and email address combination you entered is incorrect. Please try again (make sure your caps lock is off).', 'default', array('class' => 'alert alert-danger'));
                }
            } else {
                $this->Session->setFlash('Something went wrong, please try agina', 'default', array('class' => 'alert alert-danger'));
            }
        }
    }

    /**
     * logout method
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['Auth']['Admin']['id']);
        return $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        $user_data = $this->User->find('first', array('recursive' => '2', 'conditions' => array('User.id' => $this->Auth->user('id'))));
        $this->set('customer', $user_data['Customer']['name']);
        if ($role <> 'manager' && $role <> 'admin') {
            $conditions = array(
                    'User.customer_id' => $user_data['Customer']['id']
            );
            $this->Paginator->settings = array('conditions' => $conditions);
        }

        $this->set('notadmin', ($role <> 'manager' && $role <> 'admin'));

        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
        $this->set('user_data', $user_data);
        $this->set('userId', $this->Auth->user('id'));
    }

    public function add()
    {

        $isadmin = ($this->User->getRoleNameById($this->Auth->user('id')) == 'admin');
        $this->set('isadmin', $isadmin);

        if ($this->request->is('post')) {

            if(!$isadmin) {
                $user_data = $this->User->find('first', array('recursive' => '1', 'conditions' => array('User.id' => $this->Auth->user('id'))));
                $clientRole = $this->User->getRoleByName('client');

                $this->request->data['User']['customer_id'] = $user_data['Customer']['id'];
                $this->request->data['User']['role_id'] = $clientRole['id'];

            }

            $this->User->create();
            if ($this->User->save($this->request->data)) {

//                if ($this->User->invite($this->User->findById($this->User->id)) == true) {
                    $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
    //            } else {
  //                  $this->Session->setFlash(__('The user is created in the backend but could not be invited. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
    //            }
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default', array('class' => 'alert alert-danger'));
            }
        }

        $userstatuses = $this->User->Userstatus->find('list');
        $roles = $this->User->Role->find('list');
        $titles = $this->User->Title->find('list');
        $customers = $this->User->Customer->find('list');
        $this->set(compact('userstatuses', 'roles', 'titles', 'customers'));
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
        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        if ($role =='client') {
            $id = $this->Auth->user('id');
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }


        $role = $this->User->getRoleNameById($this->Auth->user('id'));
        $userstatuses = $this->User->Userstatus->find('list');
        $roles = $this->User->Role->find('list');
        $titles = $this->User->Title->find('list');
        $customers = $this->User->Customer->find('list');

        $this->set(compact('userstatuses', 'roles', 'titles', 'role','customers'));
    }

    function loginasuser($user_id = null)
    {

        if (!$user_id) {
            $this->Session->setFlash(__('Invalid User.', true));
            $this->redirect(array('action' => 'index'));
        }

        $data = $this->Auth->user();

        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        if ($role == 'manager' || $_SESSION['Auth']['Admin']['id'] == $user_id) {

            $user_data = $this->User->find('first', array('recursive' => '1', 'conditions' => array('User.id' => $user_id)));

//                if ($role == 'manager' && $user_data['User']['id'] <> $_SESSION['Auth']['Admin']['id']) {
//                    $this->Session->setFlash(__('You can only log in as user', true));
//                    $this->redirect($this->Auth->redirect('/users'));
//                }
            $_SESSION['Auth']['User'] = $user_data['User'];
            $_SESSION['Auth']['User']['Role'] = $user_data['Role'];
            $_SESSION['Auth']['Admin']['id'] = $data['id'];
            $this->redirect('/');
        } else {
            $this->Session->setFlash(__('Only admins are alowed to do so!', true));
            $this->redirect(array('action' => 'index'));
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash('The user has been deleted.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('The user could not be deleted. Please, try again.', 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}