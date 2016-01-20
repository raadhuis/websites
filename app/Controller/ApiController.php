<?php
App::uses('AppController', 'Controller');

/**
 * Websites Controller
 *
 * @property Website $Website
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ApiController extends AppController
{

    public $uses = array("Website", "Check");
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');


    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('websites','website','whois');
    }


    public function websites()
    {
        if (isset($this->request->data['token']) && $this->request->data['token'] == 'smIpukLouAEJ513Y6Y9T26mV' && $this->request->data['team_id'] == 'T03H73N8M') {
            $this->Paginator->settings = array(
                'limit' => 250,
                'recursive' => 2,
                'order' => array(
                    'Customer.name' => 'asc',
                    'Website.name' => 'asc'
                )
            );

            $websites = $this->Paginator->paginate();
            echo "Websites found:\n";
            foreach ($websites as $w) {
                echo $w['Website']['name'] . "\n";
            }
            echo "\nListed all *".count($websites)."* RAADHUIS websites.";
            die();
        } else {
            die('Access denied, contact ict@raadhuis.com');
        }
    }

    public function website()
    {
        if (isset($this->request->data['token']) && $this->request->data['token'] == 'IRALv62Apdeh9NvSFpx5XoQS' && $this->request->data['team_id'] == 'T03H73N8M') {

            if(!isset($this->request->data['text'])) {
                die('Please specify a website name or use `/websites` command for the list of available websites');
            } else {
                $options = array(
                    'conditions' => array('Website.name' => $this->request->data['text']),
                    'order' => array('Customer.name', 'Website.name')
                );

                $website = $this->Website->find('first', $options);

                if(count($website)>0) {
                    echo "\n*Name:* ".$website['Website']['name']."\n";
                    echo "*Note:* ".$website['Website']['note']."\n";
                    echo "*URL:* <".$website['Website']['url'].">\n";
                    echo "*MODX Version:* ".$website['Website']['modxversion']."\n";
                    echo "*Responsive:* ".$website['Website']['responsive']."\n";
                    echo "\n\n";
                    echo "*Customer Name :* ".$website['Customer']['name']."\n";
                    die();
                } else {
                    die('Website *'.$this->request->data['text'].'* not found, use `/websites` for the list of available websites');
                }
            }
        } else {
            die('access denied, contact ict@raadhuis.com');
        }
    }


    public function whois()
    {
        if (isset($this->request->data['token']) && $this->request->data['token'] == 'horWSyWtgay3X1jrF2dEMi6y' && $this->request->data['team_id'] == 'T03H73N8M') {
            if(!isset($this->request->data['text'])) {
                die('Please specify a host name like *raadhuis.com*');
            } else {
                die(shell_exec('whois '.$this->request->data['text']));
            }
        } else {
            die('access denied, contact ict@raadhuis.com');
        }
    }
}
