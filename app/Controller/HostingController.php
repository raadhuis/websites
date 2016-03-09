<?php
App::uses('AppController', 'Controller');

/**
 * Websites Controller
 *
 * @property Website $Website
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class HostingController extends AppController
{

    public $uses = array("Website", "Hosting", "Hostingpackage", "Server", "Websitecategory");
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'Function');


    public function index()
    {
        App::import('Vendor', 'directadmin/httpsocket');

        $sock = new HTTPSocket;

        $results = array();
        $da_servers = $this->Server->find("all");
        foreach ($da_servers as $da_server) {

            if (Configure::read('da_ssl') == 'Y') {
                $sock->connect("ssl://" . $da_server['Server']['name'], '2222');
            } else {
                $sock->connect($da_server['Server']['name'], '2222');
            }
            $sock->set_login($da_server['Server']['username'], $da_server['Server']['password']);

            $sock->query('/CMD_API_SHOW_ALL_USERS');

            $results[$da_server['Server']['name']][] = $sock->fetch_parsed_body();

        }

        $this->set("results", $results);

    }

    public function user($host, $user)
    {
        App::import('Vendor', 'directadmin/httpsocket');

        $sock = new HTTPSocket;

        $da_server = $this->Hosting->find("first", array("conditions"=>array("Server.name"=>$host,"Hosting.username"=>$user)));

        $this->set("server", $da_server);

        $sock->connect($host, 2222);

        $sock->set_login($da_server["Hosting"]["username"],$da_server["Hosting"]["password"] );

        $sock->query('/CMD_API_SHOW_USER_USAGE', array(
            'user' => $user
        ));
        $this->set("user_usage", $sock->fetch_parsed_body());

        $sock->query('/CMD_API_SHOW_USER_CONFIG', array(
            'user' => $user
        ));

        $this->set("user_config", $sock->fetch_parsed_body());

    }


    public function add()
    {

        if (!empty($this->request->data)) {

            $da_servers = $this->Server->find("all");

            foreach ($da_servers as $da_server) {

                $website = $this->Website->find("first", array('conditions' => array("Website.id" => $this->request->data['Hosting']['website_id'])));
                $this->request->data['Hosting']['username'] = $this->Function->domainToUsername($website["Website"]['name']);
                $this->request->data['Hosting']['password'] = $this->Function->generatePassword();
                $this->request->data['Hosting']['hostname'] = $this->request->data['Hosting']['username'] . '.' . $da_server['Server']['domain_pointer'];

                // server_id
                $this->request->data['Hosting']['server_id'] = $da_server['Server']['id'];

                $this->request->data['Hosting']['database_name'] = $this->Function->domainToUsername($website["Website"]['name']);

                $this->request->data['Hosting']['database_host'] = $da_server['Server']['database_host'];

                $this->request->data['Hosting']['database_username'] = $this->Function->domainToUsername($website["Website"]['name']);
                $this->request->data['Hosting']['database_password'] = $this->Function->generatePassword();

                $this->request->data['Hosting']['created_user_id'] = $this->Auth->user('id');

                $this->Hosting->create();

                if ($this->Hosting->save($this->request->data)) {

                    $package = $this->Hostingpackage->find("first", array('conditions' => array("Hostingpackage.id" => $this->request->data['Hosting']['hostingpackage_id'])));

                    if ($this->Function->create_user(
                        $da_server['Server']['name'],
                        $da_server['Server']['username'],
                        $da_server['Server']['password'],
                        $this->request->data['Hosting']['username'],
                        $website["Website"]['name'],
                        "ict@raadhuis.com",
                        $this->request->data['Hosting']['password'],
                        $package["Hostingpackage"]["da_name"],
                        $da_server['Server']['ip'])
                    ) {

                        if ($this->Function->add_pointerdomain(
                            $da_server['Server']['name'],
                            $this->request->data['Hosting']['username'] . "." . $da_server['Server']['domain_pointer'],
                            $website["Website"]['name'],
                            $this->request->data['Hosting']['username'],
                            $this->request->data['Hosting']['password']
                        )
                        ) {
                            if ($this->Function->create_db(
                                $da_server['Server']['name'],
                                $this->request->data['Hosting']['username'],
                                $this->request->data['Hosting']['password'],
                                $da_server['Server']['database_username_addfix'],
                                $da_server['Server']['database_username_addfix'],
                                $this->request->data['Hosting']['database_password'])
                            ) {
                                $this->Session->setFlash(__('The hosting has been saved.'), 'success');

                            } else {
                                $this->Session->setFlash(__('Could not create db '.$this->request->data['Hosting']['database_name'].' on '.$da_server['Server']['name'], 'error'));
                                return $this->redirect(array('action' => 'index'));
                            }
                        } else {
                            $this->Session->setFlash(__('Could not create user on '.$da_server['Server']['name'], 'error'));
                            return $this->redirect(array('action' => 'index'));
                        }
                    } else {
                        $this->Session->setFlash(__('Could not create user '.$this->request->data['Hosting']['username'].' on '.$da_server['Server']['name'], 'error'));
                        return $this->redirect(array('action' => 'index'));
                    }
//                    add_pointerdomain($domain,$username,$pass);
//                    $mysqlpw = generatePassword();
//                    create_db($username,$pass,$mysqlpw,"main");

                    $this->Session->setFlash(__('The hosting has been saved.'), 'success');
                } else {
                    $this->Session->setFlash(__('The hosting could not be saved. Please, try again.', 'error'));
                    debug($this->Hosting->validationErrors);
                }
            }
            return $this->redirect(array('action' => 'index'));
        }

        $hosting_website_ids = $this->Hosting->find("all",
            array("fields" => array("Hosting.website_id"),
                "group" => array("Hosting.website_id")
            ));

        $hosting_website_id_temp = array();

        foreach ($hosting_website_ids as $a) {
            $hosting_website_id_temp[] = $a["Hosting"]["website_id"];
        }

        $this->set("websites", $this->Website->find('list', array("order" => "name", "conditions" => array("NOT" => array("Website.id" => array_values($hosting_website_id_temp))))));
        $this->set("hostingpackages", $this->Hostingpackage->find('list'));
        $this->set("websitecategories", $this->Websitecategory->find('list'));
    }
}