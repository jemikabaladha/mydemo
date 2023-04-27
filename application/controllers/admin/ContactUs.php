<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Users_Model');
        $this->load->model('Common_Model');        
        $this->load->model('ContactUs_Model');
        $this->Common_Model->checkUserAuth(1);
        $this->template->set_template('AdminTemplate');
        $this->data['page'] = ['name'=>"Contact Us",'url'=>base_url('admin/ContactUs'),'menu'=>'ContactUs','submenu'=>''];
    }

    public function index(){
        if ($this->input->is_ajax_request()) {
            $this->getList();
        }
        $this->data['pagename'] = 'Contact Us';
        $this->data['data'] = [];
    	$this->template->content->view('admin/contact_us/manage', $this->data);
        $this->template->publish();
    }

    public function set($id = null)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();

            if (isset($data['id']) && !empty($data['id'])) {
                $this->ContactUs_Model->setData($data, $data['id']);
            } else {
                $this->ContactUs_Model->setData($data);
            }
            $this->session->set_flashdata('success', 'Data Saved');
            return redirect('admin/ContactUs');
        }

        if (!empty($id) && $id != 0) {
            $this->data['data'] = $this->ContactUs_Model->get(['id' => $id], true);
        }      
        $this->data['pagename'] = 'Contact Us'; 
        $this->template->content->view('admin/contact_us/form', $this->data);
        $this->template->publish();
    }

    public function getList()
    {
        $result = array();
        $data = $this->input->post();
        $paggination['offset'] = isset($data['start'])?$data['start']:"0";
        if($data['length'] != '-1'){
            $paggination['limit'] =  isset($data['length']) ? $data['length'] : "10";
        }
        $query['search'] = (isset($data['search']['value']) ? $data['search']['value'] : "");
        $query['status'] = [0,1,3,4];
        $resultData =  $this->ContactUs_Model->get(array_merge($paggination,$query));
        $totalData =  $this->ContactUs_Model->get($query, false, true);
        $result['data']=array();
        foreach ($resultData as $key => $value) {
            $status = "";
            if($value->status == "1"){
                $status = '<a href="' . current_url() . "/block/" . $value->id . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-round btn-warning btn-icon btn-sm"><i class="fas fa-lock-open"></i></a>';
            }else{
                $status = '<a href="' . current_url() . "/unblock/" . $value->id . '" class="btn btn-round btn-warning btn-icon btn-sm"><i class="fas fa-lock"></i></a>';
            }
            $userStatus = "";
            if($value->status==0){$userStatus = "Inactive";}else if($value->status==1){$userStatus = "Active";}elseif($value->status==2){$userStatus = "Admin Blocked";}elseif($value->status==3){$userStatus = "Contacting ";}elseif($value->status==4){$userStatus = "Closed";}
            $result['data'][$key][] = isset($value->firstName) && !empty($value->firstName) ? $value->firstName : "-";
            $result['data'][$key][] = isset($value->lastName) && !empty($value->lastName) ? $value->lastName : "-";
            $result['data'][$key][] = isset($value->email) && !empty($value->email) ? $value->email : "-";
            $result['data'][$key][] = isset($value->phone) && !empty($value->phone) ? $value->phone : "-";
            $result['data'][$key][] = isset($value->subject) && !empty($value->subject) ? $value->subject : "-";
            $result['data'][$key][] = $userStatus;
            $result['data'][$key][] = $value->createdDate;
            $result['data'][$key][] = $status.' 
            <a href="' . current_url() . "/view/" . $value->id . '" class="btn btn-round btn-primary btn-icon btn-sm"><i class="fas fa-eye"></i></a>
            <a href="' . current_url() . "/contacting/" . $value->id . '" class="btn btn-round btn-icon btn-sm successBtn"><i class="fa fa-compress"></i></a>
            <a href="' . current_url() . "/closed/" . $value->id . '" class="btn btn-round btn-primary btn-icon btn-sm btn-danger"><i class="fa fa-times"></i></a>
            <a href="' . current_url() . "/delete/" . $value->id . '" class="btn btn-round btn-icon btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash"></i></a>';            
        }
        $result["draw"] =  intval($this->input->post("draw"));
        $result["recordsTotal"] = !empty($totalData) ? $totalData : 0;
        $result["recordsFiltered"] = !empty($totalData) ? $totalData : 0;
        echo json_encode($result);
        exit();
    }


    public function view($id = 0) {        
        $data['status'] = [0,1,3,4];
        $data['id'] = $this->data['id'] = $id;
        $this->data['data'] =  $this->ContactUs_Model->get($data,TRUE);

        if(empty($this->data['data']))
        {
            $this->session->set_flashdata('error', 'Contact does not exists');
            return redirect('admin/ContactUs');
        }

        $this->data['pagename'] = 'Contact Us';
        // echo "<pre>";print_r($this->data);die;
        $this->template->content->view('admin/contact_us/view', $this->data);
        $this->template->publish();
    }

    public function delete($id = 0){
        $data['status'] = "2";
        if (!empty($id) && $id != 0) {
            $response = $this->ContactUs_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data removed');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ContactUs');
    }

    public function block($id = 0){
        $data['status'] = "0";
        if (!empty($id) && $id != 0) {
            $response = $this->ContactUs_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data blocked');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ContactUs');
    }

    public function unblock($id = 0){
        $data['status'] = "1";
        if (!empty($id) && $id != 0) {
            $response = $this->ContactUs_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data unblocked');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ContactUs');
    }

    public function contacting($id = 0){
        $data['status'] = "3";
        if (!empty($id) && $id != 0) {
            $response = $this->ContactUs_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data contacting');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ContactUs');
    }

    public function closed($id = 0){
        $data['status'] = "4";
        if (!empty($id) && $id != 0) {
            $response = $this->ContactUs_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data closed');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/ContactUs');
    }
    

}

?>
