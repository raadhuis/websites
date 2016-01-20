<?php
App::uses('AppController', 'Controller');

/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MailboxController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Session');

    function index($page = 0, $state = 'open')
    {
        App::import('Vendor', 'groovehq/groove');

        $groove = new groove('d708a323379d45c4b7534c6302243eb87eca789dd9ac40e3de8dbaa8ba7b7e06'); // your api key here

        $isclient = ($this->User->getRoleNameById($this->Auth->user('id')) == 'client');

        if ($isclient) {

            $data = $this->Auth->user();

            $customer = $groove->getCustomer($data['email']);

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
            $this->request->data = $this->User->find('first', $options);

            if (empty($this->request->data['User']['groovehq_id'])) {
                if (empty($this->request->data['User']['twitter_username']) && !empty($customer->customer->twitter_username)) {
                    $this->request->data['User']['twitter_username'] = $customer->customer->twitter_username;
                }

                if (empty($this->request->data['User']['title']) && !empty($customer->customer->title)) {
                    $this->request->data['User']['title'] = $customer->customer->title;
                }

                if (empty($this->request->data['User']['phone_number']) && !empty($customer->customer->phone_number)) {
                    $this->request->data['User']['phone_number'] = $customer->customer->phone_number;
                }

                if (empty($this->request->data['User']['location']) && !empty($customer->customer->location)) {
                    $this->request->data['User']['location'] = $customer->customer->location;
                }

                if (empty($this->request->data['User']['website_url']) && !empty($customer->customer->website_url)) {
                    $this->request->data['User']['website_url'] = $customer->customer->website_url;
                }

                if (empty($this->request->data['User']['groovehq_id']) && !empty($customer->customer->id)) {
                    $this->request->data['User']['groovehq_id'] = $customer->customer->id;
                }

                $this->User->save($this->request->data);

            }

            $tickets = $groove->getTickets(array('customer' => $data['email'],'page' => $page));

        } else {
            $tickets = $groove->getTickets();
        }

        $ticket_arr = array();

        foreach ($tickets as $key => $t) {
            foreach ($t as $key2 => $a) {
                if (isset($a->number)) {
                    $ticket_arr[$key2]['number'] = $a->number;
                    $ticket_arr[$key2]['created_at'] = $a->created_at;
                    $ticket_arr[$key2]['priority'] = $a->priority;
                    $ticket_arr[$key2]['resolution_time'] = $a->resolution_time;
                    $ticket_arr[$key2]['state'] = $a->state;
                    $ticket_arr[$key2]['title'] = $a->title;
                    $ticket_arr[$key2]['updated_at'] = $a->updated_at;
                    $ticket_arr[$key2]['assigned_group'] = $a->assigned_group;
                    $ticket_arr[$key2]['closed_by'] = $a->closed_by;
                    $ticket_arr[$key2]['message_count'] = $a->message_count;
                    $ticket_arr[$key2]['summary'] = $a->summary;
                }
            }
        }


        $this->set('tickets', $ticket_arr);
        $this->set('current_page', $tickets->meta->pagination->current_page);
        $this->set('total_pages', $tickets->meta->pagination->total_pages);
        $this->set('total_count', $tickets->meta->pagination->total_count);

    }


}
