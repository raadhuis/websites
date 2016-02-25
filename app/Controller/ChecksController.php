<?php
App::uses('AppController', 'Controller');

/**
 * Checks Controller
 *
 * @property Check $Check
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ChecksController extends AppController
{


    public $uses = array('Check', 'Website');


    public $statuscodes = array(
        301=>'Moved Permanently',
        404=>'Not Found'
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
    public function index()
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
        if (!$this->Check->exists($id)) {
            throw new NotFoundException(__('Invalid check'));
        }
        $options = array('conditions' => array('Check.' . $this->Check->primaryKey => $id));
        $this->set('check', $this->Check->find('first', $options));
    }

    public function sitemap($website_id = null)
    {
        if (!$this->Website->exists($website_id)) {
            throw new NotFoundException(__('Invalid check'));
        }

        $options = array('conditions' => array('Website.' . $this->Website->primaryKey => $website_id));
        $website = $this->Website->find('first', $options);
        $this->set('website', $website);
        $sitemap = array();

        $xml = simplexml_load_file($website['Website']['url'] . '/sitemap.xml');

        if(isset($xml)) {
            if(isset($xml->sitemap)) {
                foreach($xml->sitemap as $d) {
                    $newxml = simplexml_load_file($d->loc);
                    foreach ($newxml->url as $val) {
                        $sitemap[] = $val->loc;
                    }
                }

            } else {
                foreach ($xml->url as $val) {
                    $sitemap[] = $val->loc;
                }
            }

        } else {
            throw new NotFoundException(__('No XML found'));
        }

        $this->set('sitemap', $sitemap);

        $this->Check->recursive = 0;
        $this->set('checks', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function report($website_id = null)
    {

        $role = $this->User->getRoleNameById($this->Auth->user('id'));

        $this->Paginator->settings = array(
            'limit' => 250,
            'order' => array(
                'Checkcategory.name' => 'asc',
                'Check.name' => 'asc'
            )
        );

        if (!$this->Website->exists($website_id)) {
            throw new NotFoundException(__('Invalid check'));
        }

        $options = array('conditions' => array('Website.' . $this->Website->primaryKey => $website_id));

        $this->set('isadmin', ($role=='admin'));
        $this->set('website', $this->Website->find('first', $options));

        $this->Check->recursive = 0;
        $this->set('checks', $this->Paginator->paginate());
    }


    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Check->create();
            if ($this->Check->save($this->request->data)) {
                $this->Session->setFlash(__('The check has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The check could not be saved. Please, try again.'));
            }
        }
        $checkcategories = $this->Check->Checkcategory->find('list');
        $priorities = $this->Check->Priority->find('list');
        $this->set(compact('checkcategories', 'priorities'));
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
        if (!$this->Check->exists($id)) {
            throw new NotFoundException(__('Invalid check'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Check->save($this->request->data)) {
                $this->Session->setFlash(__('The check has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The check could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Check.' . $this->Check->primaryKey => $id));
            $this->request->data = $this->Check->find('first', $options);
        }
        $checkcategories = $this->Check->Checkcategory->find('list');
        $priorities = $this->Check->Priority->find('list');
        $this->set(compact('checkcategories', 'priorities'));
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

    private function callRemote($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $retcode;
    }

//	private function checkRemoteFileW3cExists($url){
//
//		//http://validator.localhost/check?uri=
//
//		$retcode = $this->callRemote($url);
//		pr($retcode);
//		return ($retcode == '200');
//	}

    private function checkRemoteFileExists($url)
    {
        return $this->callRemote($url);
    }

    private function getUrl($website_id)
    {
        if (!$this->Website->exists($website_id)) {
            throw new NotFoundException(__('Invalid check'));
        }
        $options = array('conditions' => array('Website.' . $this->Website->primaryKey => $website_id));
        $website = $this->Website->find('first', $options);
        return $website['Website']['url'];
    }

    public function checkSitemap($website_id)
    {
        $this->layout = 'ajax';
        $website = $this->getUrl($website_id);
        if (200 == ($result = $this->checkRemoteFileExists($website . "/sitemap.xml"))) {
            echo '<a href="' . $website . '/sitemap.xml">view sitemap</a>';
        } else {
            echo $this->statuscodes[$result];
        }
        die();
    }

    public function checkGooglepagespeed($website_id)
    {
        return // error Warning (2): curl_setopt(): CURLOPT_FOLLOWLOCATION cannot be activated when an open_basedir is set [APP/Vendor/google/pagespeed.php, line 91]
        $this->layout = 'ajax';
        $website = $this->getUrl($website_id);

        App::import('Vendor', 'google/pagespeed');

        $pageSpeed = new GooglePageSpeed('AIzaSyC2YWA4P-splf1djp37Khxla7VdT9Pk8Ak');
        $pageResult = $pageSpeed->checkUrl($website);
        $pageReport = '';
        if ((!empty($pageResult->responseCode) && ($pageResult->responseCode == '200'))) {
//
//			$pageReport = file_get_contents('views/page_report.phtml');
            echo $pageResult->score;
//			$pageReport = str_replace('{page_score}', $pageResult->score, $pageReport);
//			$pageReport = str_replace('{total_resources}', $pageResult->pageStats->numberResources, $pageReport);
//			$pageReport = str_replace('{total_hosts}', $pageResult->pageStats->numberHosts, $pageReport);		;
//			$pageReport = str_replace('{html_bytes}', $pageSpeed->readableBytes($pageResult->pageStats->htmlResponseBytes), $pageReport);
//			$pageReport = str_replace('{css_bytes}', $pageSpeed->readableBytes($pageResult->pageStats->cssResponseBytes), $pageReport);
//			$pageReport = str_replace('{js_bytes}', $pageSpeed->readableBytes($pageResult->pageStats->javascriptResponseBytes), $pageReport);
//			$pageReport = str_replace('{image_bytes}', $pageSpeed->readableBytes($pageResult->pageStats->imageResponseBytes), $pageReport);
            echo $pageReport;
        } else {
            echo '<span class="error_msg">The URL provided was unable to be retrieved.</span>';
        }
        die();
    }


    public function checkW3c($website_id)
    {
        $this->layout = 'ajax';
        $website = $this->getUrl($website_id);

        App::import('Vendor', 'w3c/w3c');

        $validate = new W3CValidator($website);

        if ($validate->isValid()) {
            echo "<i class='fa fa-check ok'></i>";
        } else {
            if ($validate->getErrorsCount() > 0) {
                echo "<i class='fa fa-times error'></i> (" . $validate->getErrorsCount() . ")<br />";
            }
            if ($validate->getWarningsCount() > 0) {
                echo "<i class='fa fa-warning warning'></i> (" . $validate->getErrorsCount() . ")";
            }
        }
        die();
    }

    public function checkRobotstxt($website_id)
    {
        $this->layout = 'ajax';
        $website = $this->getUrl($website_id);

        $result = $this->checkRemoteFileExists($website . "/robots.txt");

        if ($result == 200) {
            echo '<a href="' . $website . '/robots.txt">view robots.txt</a>';
        } else {

            echo $this->statuscodes[$result];
        }
        die();
    }

    public function checkFavicon($website_id)
    {
        $this->layout = 'ajax';
        $website = $this->getUrl($website_id);
        if (200 == ($result = $this->checkRemoteFileExists($website . "/favicon.ico"))) {
            echo '<img src="' . $website . '/favicon.ico">';
        } else {
            echo $this->statuscodes[$result];
        }
        die();
    }
}
