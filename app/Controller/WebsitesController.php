<?php
App::uses('AppController', 'Controller');

/**
 * Websites Controller
 *
 * @property Website $Website
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WebsitesController extends AppController
{

    public $uses = array("Website", "Check", "Customer", "Migration", "Hosting");
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');


    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('screenshots', 'display');
    }


    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = [];
        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        if ($role == 'client') {
            $user_data = $this->User->find('first', array('recursive' => '1', 'conditions' => array('User.id' => $this->Auth->user('id'))));
            $conditions[] = ['Website.customer_id' => $user_data['Customer']['id']];
        }

        if (isset($this->request->data['Website']['customer_name'])) {
            $this->Session->write('search.Website.customer_name', $this->request->data['Website']['customer_name']);
        } else {
            $this->request->data['Website']['customer_name'] = $this->Session->read('search.Website.customer_name');
        }

        if (!empty($this->request->data['Website']['customer_name'])) {
            $conditions[] = ['Customer.name LIKE' => '%' . $this->request->data['Website']['customer_name'] . '%'];
        }

        if (isset($this->request->data['Website']['website_name'])) {
            $this->Session->write('search.Website.website_name', $this->request->data['Website']['website_name']);
        } else {
            $this->request->data['Website']['website_name'] = $this->Session->read('search.Website.website_name');
        }

        if (!empty($this->request->data['Website']['website_name'])) {
            $conditions[] = ['Website.name LIKE' => '%' . $this->request->data['Website']['website_name'] . '%'];
        }

        // user_id
        if (isset($this->request->data['Website']['user_id'])) {
            $this->Session->write('search.Website.user_id', $this->request->data['Website']['user_id']);
        } else {
            $this->request->data['Website']['user_id'] = $this->Session->read('search.Website.user_id');
        }

        if (!empty($this->request->data['Website']['user_id'])) {
            $conditions[] = ['Customer.user_id' => $this->request->data['Website']['user_id']];
        }


        $this->Paginator->settings = array(
            'conditions' => $conditions,
            'limit' => 15,
            'recursive' => 2,
            'order' => array(
                'Customer.name' => 'asc',
                'Website.name' => 'asc'
            )
        );

        $this->set('websites', $this->Paginator->paginate());

        $this->Check->recursive = 0;
        $this->set('users', $this->User->find('list', ['conditions' => ['customer_id' => 2]]));
        $this->set('isadmin', ($role == "admin"));
    }

    /**
     * index method
     *
     * @return void
     */
    public function migratie()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        $this->Paginator->settings = array(
            'limit' => 250,
            'recursive' => 2,
            'order' => array(
                'Customer.name' => 'asc',
                'Website.name' => 'asc'
            )
        );

        if ($role == 'client') {
            $user_data = $this->User->find('first', array('recursive' => '1', 'conditions' => array('User.id' => $this->Auth->user('id'))));
            $conditions = array(
                'Website.customer_id' => $user_data['Customer']['id']
            );
            $this->Paginator->settings = array('conditions' => $conditions);
        }

        $this->Website->recursive = 0;
        $this->set('websites', $this->Paginator->paginate());

        $this->Check->recursive = 0;
        $this->set('checks', $this->Check->find('all'));
        $this->set('isadmin', ($role == "admin"));
    }


    /**
     * index method
     *
     * @return void
     */
    public function updates()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        $this->Paginator->settings = array(
            'limit' => 250,
            'recursive' => 2,
            'order' => array(
                'Customer.name' => 'asc',
                'Website.name' => 'asc'
            )
        );

        if ($role == 'client') {
            $user_data = $this->User->find('first', array('recursive' => '1', 'conditions' => array('User.id' => $this->Auth->user('id'))));

            $conditions = array(
                'Website.customer_id' => $user_data['Customer']['id']
            );
            $this->Paginator->settings = array('conditions' => $conditions);
        }

        $this->Website->recursive = 0;
        $this->set('websites', $this->Paginator->paginate());

        $this->Check->recursive = 0;
        $this->set('checks', $this->Check->find('all'));
        $this->set('isadmin', ($role == "admin"));
    }

    /**
     * index method
     *
     * @return void
     */
    public function socialshare()
    {
        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        $this->Paginator->settings = array(
            'limit' => 250,
            'recursive' => 2,
            'order' => array(
                'Customer.name' => 'asc',
                'Website.name' => 'asc'
            )
        );

        if ($role == 'client') {
            $user_data = $this->User->find('first', array('recursive' => '1', 'conditions' => array('User.id' => $this->Auth->user('id'))));

            $conditions = array(
                'Website.customer_id' => $user_data['Customer']['id']
            );
            $this->Paginator->settings = array('conditions' => $conditions);
        }

        $this->Website->recursive = 0;
        $this->set('websites', $this->Paginator->paginate());

        $this->Check->recursive = 0;
        $this->set('checks', $this->Check->find('all'));
        $this->set('isadmin', ($role == "admin"));
    }

    public function screenshots()
    {
        $this->Paginator->settings = array(
            'limit' => 250,
            'order' => array(
                'Customer.name' => 'asc',
                'Website.name' => 'asc'
            )
        );

        $this->Website->recursive = 0;
        $this->set('websites', $this->Paginator->paginate());

        $this->Check->recursive = 0;
        $this->set('checks', $this->Check->find('all'));
    }

    public function view($id = null)
    {
        if (!$this->Website->exists($id)) {
            throw new NotFoundException(__('Invalid website'));
        }
        $options = array(
            'conditions' => array('Website.' . $this->Website->primaryKey => $id),
            'order' => array('Customer.name', 'Website.name'),
            'recursive' => 2
        );
        $website = $this->Website->find('first', $options);

        App::import('Vendor', 'directadmin/httpsocket');

        $sock = new HTTPSocket;

        foreach ($website['Hosting'] as $h) {

            $sock->connect($h['hostname'], 2222);

            $sock->set_login($h["username"], $h["password"]);

            $sock->query('/CMD_API_SHOW_USER_USAGE', array(
                'user' => $h['username']
            ));
            $this->set("user_usage", $sock->fetch_parsed_body());

            $sock->query('/CMD_API_SHOW_USER_CONFIG', array(
                'user' => $h['username']
            ));

            $this->set("user_config", $sock->fetch_parsed_body());

        }

        $this->set('website', $website);
        $this->monitoring($id);

        if (!$this->Customer->exists($website['Customer']['id'])) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $website['Customer']['id']));
        $this->set('customer', $this->Customer->find('first', $options));


    }

    public function ftppass($id = null)
    {
        if (!$this->Website->exists($id)) {
            throw new NotFoundException(__('Invalid website'));
        }

        $website = $this->Website->find('first',
            array('conditions' =>
                array('Website.' . $this->Website->primaryKey => $id), 'recursive' => 2));

        $arr = array();

        foreach ($website['Hosting'] as $h) {
            $arr[$h['Server']['database_username_addfix']] = ['username' => $h['username'], 'password' => $h['password']];
        }

        $this->response->body(json_encode($arr));
        $this->response->type('json');
        $this->response->download('punt-ftppass');

        return $this->response;
    }

    function generate($id = null)
    {

        if (!$this->Website->exists($id)) {
            throw new NotFoundException(__('Invalid website'));
        }

        $options = array(
            'conditions' => array('Website.' . $this->Website->primaryKey => $id),
            'order' => array('Customer.name', 'Website.name')
        );

        $this->request->data = $this->Website->find('first', $options);


        App::import('Vendor', 'webthumbnail/webthumbnail');

        $thumb = new Webthumbnail($this->request->data['Website']['url']);

        $path = tempnam(TMP, 'webthumbnail-');
        $thumb->setWidth(1024)->setHeight(1024)->setScreen(1024)->captureToFile($path);
        $this->request->data['Website']['1024'] = $path;
        @chmod($path, 0644);
        $path = tempnam(TMP, 'webthumbnail-');
        $thumb->setWidth(1024)->setHeight(1024)->setScreen(1280)->captureToFile($path);
        $this->request->data['Website']['1280'] = $path;
        @chmod($path, 0644);
        $path = tempnam(TMP, 'webthumbnail-');
        $thumb->setWidth(1024)->setHeight(1024)->setScreen(1650)->captureToFile($path);
        $this->request->data['Website']['1650'] = $path;
        @chmod($path, 0644);
        $path = tempnam(TMP, 'webthumbnail-');
        $thumb->setWidth(1024)->setHeight(1024)->setScreen(1920)->captureToFile($path);
        $this->request->data['Website']['1920'] = $path;
        @chmod($path, 0644);


        if ($this->Website->save($this->request->data)) {
            $this->Session->setFlash(__('The website has been saved.'));
            return $this->redirect(array('action' => 'view/' . $id));
        } else {
            $this->Session->setFlash(__('The website could not be saved. Please, try again.'));
        }
    }

    function display($id = null, $size)
    {
        if (!$this->Website->exists($id)) {
            throw new NotFoundException(__('Invalid website'));
        }

        $options = array(
            'conditions' => array('Website.' . $this->Website->primaryKey => $id),
            'order' => array('Customer.name', 'Website.name')
        );

        $this->request->data = $this->Website->find('first', $options);
        $image = imagecreatefromstring(file_get_contents($this->request->data['Website'][$size]));
        if (is_resource($image) === true) {
// We are not saving the image show it in the user's browser
            header('Content-Type: image/png');
            imagejpeg($image, null, 100);
            imagedestroy($image);
        }
        die();

    }


    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Website->create();
            if ($this->Website->save($this->request->data)) {
                $this->Session->setFlash(__('The website has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The website could not be saved. Please, try again.'));
            }
        }

        $migrations = $this->Website->Migration->find('list');
        $customers = $this->Website->Customer->find('list');
        $this->set(compact('customers', 'migrations'));
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
        if (!$this->Website->exists($id)) {
            throw new NotFoundException(__('Invalid website'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Website->save($this->request->data)) {
                $this->Session->setFlash(__('The website has been saved.'));
                if (isset($this->request->data["Website"]['referer'])) {
                    return $this->redirect($this->request->data["Website"]['referer']);
                }
                return $this->redirect(array('action' => 'index#website' . $id));
            } else {
                $this->Session->setFlash(__('The website could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Website.' . $this->Website->primaryKey => $id));
            $this->request->data = $this->Website->find('first', $options);
        }

        $referer = $this->referer();
        $migrations = $this->Website->Migration->find('list', ['order' => array(
            'sorting' => 'asc')]);
        $customers = $this->Website->Customer->find('list');
        $this->set(compact('customers', 'migrations', 'referer'));
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
        $this->Website->id = $id;
        if (!$this->Website->exists()) {
            throw new NotFoundException(__('Invalid website'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Website->delete()) {
            $this->Session->setFlash(__('The website has been deleted.'));
        } else {
            $this->Session->setFlash(__('The website could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    function monitoring($id)
    {

        if ($this->request->is(array('post', 'put'))) {

            App::import('Vendor', 'uptimerobot/uptimerobot');

            $upRobot = new UptimeRobot();

            $upRobot::configure('u203474-a76ee7debb893cd7a1514992', 1);

            $upRobot->setFormat('json'); //Define the format of responses (json or xml)

            $options = array(
                'conditions' => array('Website.' . $this->Website->primaryKey => $id),
                'order' => array('Customer.name', 'Website.name')
            );

            $this->request->data = $this->Website->find('first', $options);

            if ($this->request->data["Website"]["uptimerobot_id"] == 0) {

                try {
                    $hoi = $upRobot->newMonitor(
                        $this->request->data["Website"]["name"],
                        $this->request->data["Website"]["url"],
                        1);

                    if ($hoi->stat == 'ok') {
                        $this->request->data["Website"]["uptimerobot_id"] = $hoi->monitor->id;
                    } else {
                        $hoi = $upRobot->deleteMonitor($this->request->data["Website"]["uptimerobot_id"]);
                        $this->request->data["Website"]["uptimerobot_id"] = 0;
                    }

                } catch (Exception $e) {
                    echo $e->getMessage();
                }

            } else {

                try {
                    $hoi = $upRobot->deleteMonitor($this->request->data["Website"]["uptimerobot_id"]);

                    if ($hoi->stat == 'ok') {
                        $this->request->data["Website"]["uptimerobot_id"] = 0;
                    } else {
                        $this->request->data["Website"]["uptimerobot_id"] = 0;
                    }

                } catch (Exception $e) {
                    echo $e->getMessage();
                }

            }

            if ($this->Website->save($this->request->data)) {
                if ($this->request->data["Website"]["uptimerobot_id"] <> 0) {
                    $this->Session->setFlash(__('Monitoring ingesteld'));
                } else {
                    $this->Session->setFlash(__('Monitoring verwijderd'));
                }
            } else {
                $this->Session->setFlash(__('The website could not be saved. Please, try again.'));
            }

        }

        $this->Website->id = $id;
        if (!$this->Website->exists()) {
            throw new NotFoundException(__('Invalid website'));
        }

        $options = array(
            'conditions' => array('Website.' . $this->Website->primaryKey => $id),
            'order' => array('Customer.name', 'Website.name')
        );

        $this->request->data = $this->Website->find('first', $options);

        $monitoring_inactive = empty($this->request->data["Website"]["uptimerobot_id"] > 1);

        $this->set('monitoring_inactive', $monitoring_inactive);


        if (!$monitoring_inactive) {
            App::import('Vendor', 'uptimerobot/uptimerobot');

            $upRobot = new UptimeRobot();

            $upRobot::configure('u203474-a76ee7debb893cd7a1514992', 1);

            $upRobot->setFormat('json'); //Define the format of responses (json or xml)

            /**
             * Get all monitors
             */

            $monitoring = '';
            try {
                $monitoring = $upRobot->getMonitors($this->request->data["Website"]["uptimerobot_id"]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $this->set("monitoring", $monitoring);
        }

    }

}
