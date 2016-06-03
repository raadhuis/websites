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


    public function simplicate(){

        $login = 'jaxRmx8ybG2aUh0L7j4zXpnWAN66dxSn';
        $password = 'yf4KD28Fz0Fk8vV5FQut5IgwmcsqAbDY';


        $url = 'https://raadhuis.simplicate.nl/api/v2/crm/organization.json';
        $url = 'https://raadhuis.simplicate.nl/api/v2/hrm/employee.json';
        $url = 'https://raadhuis.simplicate.nl/api/v2/hrm/employee.json/employee:e7d903c563b8e571';
//        $url = 'https://raadhuis.simplicate.nl/api/v2/hrm/employee.json/person:66c8feff6524cbdd';


        $url = 'https://raadhuis.simplicate.nl/api/v2/services/service.json/service:74b0abdbb3b34a9fbf0d1878087571b9';

        $url = 'https://raadhuis.simplicate.nl/api/v2/projects/project.json';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
        $result = curl_exec($ch);
        curl_close($ch);

        echo "<pre>";

        print_r(json_decode($result));
        die();
        echo($result);

        //api key jaxRmx8ybG2aUh0L7j4zXpnWAN66dxSn
        //api secret yf4KD28Fz0Fk8vV5FQut5IgwmcsqAbDY
//        echo file_get_contents('https://raadhuis.simplicate.nl/api/v2/crm/organization.json');

        // GET /hrm/employee.{format}

        die('test');
    }

    public function websites()
    {
        if (isset($this->request->data['token']) && $this->request->data['token'] == 'V13V5MDJoBVYlHxv5mehw8Si' && $this->request->data['team_id'] == 'T03H73N8M') {
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
