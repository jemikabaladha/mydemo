<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->model('Users_Model');
        $this->load->model('Faq_Model');
        $this->Common_Model->checkUserAuth(1);
        $this->template->set_template('AdminTemplate');
        $this->data['page'] = ['name'=>"Notification",'url'=>base_url('admin/notification'),'menu'=>'notification','submenu'=>''];
    }

    public function index(){
        $this->data['pagename'] = 'Notification List';
        $this->data['data'] = [];
    	$this->template->content->view('admin/notification/view', $this->data);
        $this->template->publish();
    }
}