<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('User');

    public $helpers = array('Form' => array('className' => 'Bs3Helpers.Bs3Form'),"MinifyHtml.MinifyHtml");

    public $components = array(
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'websites',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'checks',
                'action' => 'publicview'
            ),
            'authenticate' => array(
                'Blowfish' => array(
                    'fields' => array('username'=>'email')
                )
            )
        ),
        'Session',
        'Email',
        'Cookie',
//        'Security'
    );

    public function beforeFilter() {

        $this->response->disableCache();

        if (isset($this->request->data['_wysihtml5_mode'])) unset($this->request->data['_wysihtml5_mode']);

        if ($this->Auth->loggedIn()) {
            $this->set('my_displayname', $this->User->getNameById($this->Auth->user('id')));
            $this->set('my_user_id', $this->Auth->user('id'));
        }
    }

    public function hasRights($user, $rights=null) {

        if(is_array($rights)) {
            foreach($rights as $r){
                if (isset($user['Role']['name']) && $user['Role']['name'] === $r) {
                    return true;
                }
            }
        } else {
            if (isset($user['Role']['name']) && $user['Role']['name'] === $rights) {
                return true;
            }
        }
        // Default deny
        return false;
    }
}
