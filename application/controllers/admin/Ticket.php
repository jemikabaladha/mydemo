<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->model('Users_Model');
        $this->load->model('Ticket_Model');
        $this->Common_Model->checkUserAuth(1);
        $this->template->set_template('AdminTemplate');
        $this->data['page'] = ['name'=>"Ticket",'url'=>base_url('admin/ticket'),'menu'=>'ticket','submenu'=>''];
    }

    public function index(){
        if ($this->input->is_ajax_request()) {
            $this->getList();
        }
        $this->data['pagename'] = 'Ticket List';
        $this->data['data'] = [];
    	$this->template->content->view('admin/ticket/manage', $this->data);
        $this->template->publish();
    }

    public function getList(){
        $result = array();
        $data = $this->input->post();
        $paggination['offset'] = isset($data['start'])?$data['start']:"0";
        if($data['length'] != '-1'){
            $paggination['limit'] =  isset($data['length']) ? $data['length'] : "10";
        }
        $query['search'] = (isset($data['search']['value']) ? $data['search']['value'] : "");
        $query['status'] = [0,1];
        $resultData =  $this->Ticket_Model->get(array_merge($paggination,$query));
        // echo "<pre>";print_r($resultData);die;
        // echo $this->db->last_query();die;
        $totalData =  $this->Ticket_Model->get($query, false, true);
        $result['data']=array();
        foreach ($resultData as $key => $value) {
            $result['data'][$key][] = isset($value->fullName) && !empty($value->fullName) ? $value->fullName : "-";
            $result['data'][$key][] = isset($value->email) && !empty($value->email) ? $value->email : "-";
            $result['data'][$key][] = isset($value->title) && !empty($value->title) ? $value->title : "-";
            $result['data'][$key][] = $value->status==0 ? "Closed" : "Open";
            $result['data'][$key][] = ' <a href="' . current_url() . "/set/" . $value->id . '" class="btn btn-round btn-primary btn-icon btn-sm"><i class="fas fa-eye"></i></a>
            <a href="' . current_url() . "/delete/" . $value->id . '" class="btn btn-round btn-icon btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash"></i></a>';            
        }
        $result["draw"] =  intval($this->input->post("draw"));
        $result["recordsTotal"] = !empty($totalData) ? $totalData : 0;
        $result["recordsFiltered"] = !empty($totalData) ? $totalData : 0;
        echo json_encode($result);
        exit();
    }

    public function set($id = null) {
        if(empty($id)){
            return redirect('admin/ticket');
        }
        $this->data['pagename'] = 'Set Ticket Reply'; 
        $this->data['data'] = $this->Ticket_Model->get(['id'=>$id], TRUE);
    	$this->data['userdata'] = $this->Users_Model->get(['id'=>$this->data['data']->userId], TRUE);
        $this->data['admindata'] = $this->Users_Model->get(['id'=>$this->session->userdata('adminId'),'status'=>'1'], TRUE);
        $this->data['id'] = $id;
        if (is_null(get_cookie('adminsessioncookie'))) {
            delete_cookie('adminsessioncookie');
            $this->session->sess_destroy();            
            redirect(base_url('admin'));
        }
        // echo $this->input->cookie('adminsessioncookie'); die;
        $this->template->content->view('admin/ticket/form', $this->data);
        $this->template->publish();
    }


    public function delete($id = 0){
        $data['status'] = "2";
        if (!empty($id) && $id != 0) {
            $response = $this->Ticket_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Ticket removed successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ticket');
    }

    public function addtickets_________($id){
		$post=$this->input->post();
		$data=array();
		if(isset($post['description']) && !empty($post['description'])){
			$data['description']=$post['description'];
		}
		$data['ticketId']=$id;
		$data['forReply']=1;
		
      	$result = $this->Ticket_Model->setTicketReplyData($data);
      	if(!empty($result)){
			//$this->Background_Model->advertiseTicketReplayMail($result);
		}
    }

    public function getFeed(){
        $post=$this->input->post();
        if(isset($post['id']) && $post['id']!=""){
            $ticket = $this->Ticket_Model->get(['id'=>$post['id']], TRUE);
            if(!empty($ticket)){
                $q = $this->db->select();
                $q->from('tbl_ticketReply');
                $q->where('ticketId = ', $post['id']);
                if(isset($post['last_id']) && $post['last_id']!=""){
                    $q->where('id > ', $post['last_id']);
                }
                $data = $q->get();
                $final_data = $data->result();
                $userdata = $this->Users_Model->get(['id'=>$ticket->userId], TRUE);
                $adminData = $this->Users_Model->get(['id'=>$this->session->userdata('adminId')], TRUE);
                if(!empty($final_data)){
                    $this->load->view('Ajax/getFeed', ['getTicketReply' => $final_data,'userdata'=>$userdata,'adminData'=>$adminData]);
                }
            }
        }
    }
    public function close($id = 0){
        $data['status'] = "0";
        if (!empty($id) && $id != 0) {
            $response = $this->Ticket_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Ticket Close successfully.');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ticket');
    }

    public function reopen($id = 0) {
        $data['status'] = "1";
        $data['reopenDate'] = time();
        if (!empty($id) && $id != 0) {
            $response = $this->Ticket_Model->setData($data, $id);
        }
        if ($response != "") {
            $this->session->set_flashdata('success', 'Ticket reopened');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ticket');
    }

}