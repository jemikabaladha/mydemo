<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->model('Users_Model');
        // $this->load->model('Notification_Model');
        $this->Common_Model->checkUserAuth(1);
        $this->template->set_template('AdminTemplate');
        $this->data['page'] = ['name'=>"Dashboard",'url'=>base_url('admin/dashboard')];
    }

    public function index(){
        // echo "<pre>";print_r($this->session->userdata('adminName'));die;
        //$this->template->javascript->add('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js');
        //$this->template->stylesheet->add(base_url('assets/plugin/intlTelInput/intlTelInput.css'));
        $this->data['pageTitle'] = ['title' => 'Dashboard', 'icon' => ''];
        $this->data['countuser'] = $this->Users_Model->get(['role'=>2,'status'=>1],false,true);
        $this->template->content->view('admin/dashboard', $this->data);
        $this->template->publish();
    }

    // public function getTotalUnreadNotification() {
    //     $res = array();
    //     $res = $this->Notification_Model->get(['send_to'=>$this->session->userdata('adminId'),'status'=>1],false,true);
    //     echo $res;
    //     return false;
    // }

    // public function getNotificationList() {
    //     $page_number = $this->input->post('page') != '' ? $this->input->post('page') : 1;
    //     $limit = $this->input->post('limit') != '' ? $this->input->post('limit') : 10;
    //     if ($this->input->post('page') == 1) {
    //         $offset = 0;
    //     } else {
    //         if ($this->input->post('page') != '1') {
    //             $offset = ((int)$page_number * $limit) - $limit;
    //         } else {
    //             $offset = 0;
    //         }
    //     }

    //     $notiData = $this->Notification_Model->get(['userData'=>TRUE,'send_to'=>$this->session->userdata('adminId'),'status'=>[0,1],'limit'=> $limit,'offset'=>$offset]);
    //     $totalData = $this->Notification_Model->get(['userData'=>TRUE,'send_to'=>$this->session->userdata('adminId'),'status'=>[0,1]],false,true);
    //     $responseData = $res = array();
    //     if(!empty($notiData)){
    //         foreach($notiData as $value){
    //             if($value->status == 1){
    //                 $this->Notification_Model->setData(['status'=>0],$value->id);
    //             }
    //             $value->time = $this->Common_Model->get_time_ago($value->createdDate);
    //             $responseData[] = $value;
    //         }
    //     }
    //     if(!empty($responseData)){
    //         $res['status'] = "1";
    //         $res['totalPages'] = ceil($totalData/$limit)."";
    //         $res['data'] = $responseData;
    //     }else{
    //         $res['status'] = "6";
    //         $res['totalPages'] = ceil($totalData/$limit)."";
    //     }
    //     echo json_encode($res);
    //     return false;
    // }
}