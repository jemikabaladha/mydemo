<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->model('Users_Model');
        // $this->load->model('Background_Model');
        $this->Common_Model->checkUserAuth(1);
        $this->template->set_template('AdminTemplate');
        $this->data['page'] = ['name'=>"User",'url'=>base_url('admin/user'),'menu'=>'user','submenu'=>''];
    }

    public function index(){
        if ($this->input->is_ajax_request()) {
            $this->getList();
        }
        $this->data['pagename'] = 'User List';
        $this->data['data'] = [];
    	$this->template->content->view('admin/user/manage', $this->data);
        $this->template->publish();
    }

    public function set($id = null)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post();
            // echo "<pre>";print_r($data);die;

            if (isset($data['id']) && !empty($data['id'])) {
                //image upload
                $upload_path = getenv('UPLOADPATH');
                //$allowed_types = array(".jpg", ".png", ".jpeg",".webp");          
                $allowed_types = array(".jpg",".JPG",".jpeg",".JPEG",".png",".PNG",".webp");          
                if (isset($_FILES['image']["name"]) && !empty($_FILES['image']["name"])) {
                    $fileExt = strtolower($this->Common_Model->getFileExtension($_FILES['image']["name"]));
                    if (in_array($fileExt, $allowed_types)) {
                        $fileName = date('ymdhis') . $this->Common_Model->random_string(6) . $fileExt;
                        $upload_dir = $upload_path . "/" . $fileName;
                        if (move_uploaded_file($_FILES['image']["tmp_name"], $upload_dir)) {
                            $data['profileImage'] = $fileName;
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Allowed only image file.');
                        return redirect('admin/user' . $data['id']);
                    }
                }
                //image upload

                if (isset($data['password']) && !empty($data['password'])) {
                    $data['password'] = $this->Common_Model->convert_to_hash($data['password']);
                }else{
                    unset($data['password']);
                }
                $this->Users_Model->setData($data, $data['id']);
                $this->session->set_flashdata('success', 'Data Saved');
                return redirect('admin/user');
            } else {
                $this->session->set_flashdata('error', 'Invalid request');
                return redirect('admin/user');
            }
        }


        if (!empty($id) && $id != 0) {
            $this->data['data'] = $this->Users_Model->get(['id' => $id], true);
        }else {
            $this->session->set_flashdata('error', 'Invalid request');
            return redirect('admin/user');
        }  
        // echo "<pre>";print_r($this->data['data']);die; 
        $this->data['id']=$id;   
        $this->data['pagename'] = 'Set Users'; 
        $this->template->content->view('admin/user/form', $this->data);
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
        $query['status'] = [0,1,2];
        $query['role'] = [2];
        $resultData =  $this->Users_Model->get(array_merge($paggination,$query));
        $totalData =  $this->Users_Model->get($query, false, true);
        $result['data']=array();
        foreach ($resultData as $key => $value) {
            $status = "";
            if($value->status == "1"){
                $status = '<a href="' . current_url() . "/block/" . $value->id . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-round btn-warning btn-icon btn-sm"><i class="fas fa-lock-open"></i></a>';
            }else{
                $status = '<a href="' . current_url() . "/unblock/" . $value->id . '" class="btn btn-round btn-warning btn-icon btn-sm"><i class="fas fa-lock"></i></a>';
            }
            $userStatus = "";
            if($value->status==0){$userStatus = "Need to Verify";}elseif($value->status==1){$userStatus = "Active";}elseif($value->status==2){$userStatus = "Admin Blocked";}
            $onerror=base_url('assets/uploads/default_user.jpg');
            $result['data'][$key][] = "<div class='profiletable'><img src='".$value->thumbProfileImage."' alt='". $value->fullName."' onerror=\"this.onerror=null;this.src='".$onerror."';\"><span>".$value->fullName."</span></div>";
            // $result['data'][$key][] = "<div class='profiletable'><img src=".$value->thumbProfileImage." alt=". $value->fullName." onerror=\"this.onerror=null;this.src='".$onerror."';\"></div>"; 
            // $result['data'][$key][] = isset($value->firstName) && !empty($value->firstName) ? $value->firstName : "-";
            // $result['data'][$key][] = isset($value->lastName) && !empty($value->lastName) ? $value->lastName : "-";
            $result['data'][$key][] = isset($value->email) && !empty($value->email) ? $value->email : "-";
            $result['data'][$key][] = isset($value->phone) && !empty($value->phone) ? (isset($value->phoneCode) && !empty($value->phoneCode) ? "+".$value->phoneCode . " " . $value->phone : $value->phone) : "-";
            $result['data'][$key][] = $userStatus;
            $result['data'][$key][] = $value->createdDate;
            $result['data'][$key][] = $status.' <a href="' . current_url() . "/set/" . $value->id . '" class="btn btn-round btn-info btn-icon btn-sm"><i class="fas fa-pencil-alt"></i></a>
            <a href="' . current_url() . "/view/" . $value->id . '" class="btn btn-round btn-primary btn-icon btn-sm"><i class="fas fa-eye"></i></a>
            <a href="' . current_url() . "/delete/" . $value->id . '" class="btn btn-round btn-icon btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash"></i></a>';            
        }
        $result["draw"] =  intval($this->input->post("draw"));
        $result["recordsTotal"] = !empty($totalData) ? $totalData : 0;
        $result["recordsFiltered"] = !empty($totalData) ? $totalData : 0;
        echo json_encode($result);
        exit();
    }


    public function view($id = 0) {     
        $data['status'] = [0,1,2];
        $data['id'] = $this->data['id'] = $id;
        $this->data['data'] =  $this->Users_Model->get($data,TRUE);
        
        if(empty($this->data['data']))
        {
            $this->session->set_flashdata('error', 'User does not exists');
            return redirect('admin/user');
        }
        
        $this->data['pagename'] = 'User Detail';

        $this->template->content->view('admin/user/view', $this->data);
        $this->template->publish();
    }
    
    public function delete($id = 0){
        $data['status'] = "3";
        if (!empty($id) && $id != 0) {
            $response = $this->Users_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data removed');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/user');
    }

    public function block($id = 0){
        $data['status'] = "2";
        if (!empty($id) && $id != 0) {
            $response = $this->Users_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data blocked');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/user');
    }

    public function unblock($id = 0){
        $data['status'] = "1";
        if (!empty($id) && $id != 0) {
            $response = $this->Users_Model->setData($data, $id);
        } 
        if ($response != "") {
            $this->session->set_flashdata('success', 'Data unblocked');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        return redirect('admin/user');
    }

    public function checkPhoneExist($id=0) {
        $data = $this->input->post();
        $exist = $this->Users_Model->get(['phone'=>$data['phone'],'role'=>$data['role'],'id'=>$id,'notInclude'=>TRUE], true);
        if ($exist) {
            echo "0";
        } else {
            echo "true";
        }
        // return false;
    }

    public function actionExport() {
        $this->load->library("PhpSpreadsheet");
        $object = $this->phpspreadsheet->phpExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array(
            "Name",         
            "Email",
            "Phone",
            "Status",
            "Created date"
        );

		$column = 1;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

        // start query
        $query['status'] = [0,1,2];
		$query['role'] = [2];
        $user_data =  $this->Users_Model->get($query);

        $excel_row = '2';
        foreach($user_data as $row)
        {
            $userStatus = "";
            if($row->status==0){$userStatus = "Need to Verify";}elseif($row->status==1){$userStatus = "Active";}elseif($row->status==2){$userStatus = "Admin Blocked";}
            $email = isset($row->email) && !empty($row->email) ? $row->email : "-";
            $phone = isset($row->phone) && !empty($row->phone) ? (isset($row->phoneCode) && !empty($row->phoneCode) ? "+".$row->phoneCode . " " . $row->phone : $row->phone) : "-";
            
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->fullName);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $email);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $phone);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $userStatus);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->createdDate);
            $charecter = 'A';
            for($i = 1; $i <= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($object->getActiveSheet()->getHighestColumn()); $i++) {
                $object->getActiveSheet()->getColumnDimension($charecter)->setAutoSize(TRUE);
                $charecter++;
            }
            
            $excel_row++;
        } 
        
        $object_writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($object);  
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="BeautysuppliedUser_'.date('Y-m-d').'.xlsx"');
        $object_writer->save('php://output');//Download File
        
    }

}
