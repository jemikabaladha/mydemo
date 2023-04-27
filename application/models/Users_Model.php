<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = "tbl_users";
    }

    public function get($data = [], $single = false, $num_rows = false) {
        $this->db->flush_cache();
        if ($num_rows) {
            $this->db->select('COUNT(' . $this->table . '.id) as totalRecord');
        } else {
            if(isset($data['apiResponse'])){
                $this->db->select($this->table . '.id');
                $this->db->select($this->table . '.firstName');
                $this->db->select($this->table . '.lastName');
                $this->db->select($this->table . '.fullName');
                $this->db->select($this->table . '.email');
                $this->db->select($this->table . '.phoneCode');
                $this->db->select($this->table . '.phone');
                $this->db->select($this->table . '.profileImage');
                $this->db->select($this->table . '.timeZone');
            }else{
                $this->db->select($this->table . '.*');
                $this->db->select($this->table . '.createdDate as createdDatetimestamp');
                $this->db->select('FROM_UNIXTIME(' . $this->table . '.updatedDate, "%m/%d/%Y") as updatedDate');
                $this->db->select('FROM_UNIXTIME(' . $this->table . '.createdDate, "%m/%d/%Y") as createdDate');
            } 
            $this->db->select("CONCAT('" . base_url(getenv('UPLOAD_URL')) . "', " . $this->table . ".profileImage) as profileImage", FALSE);            
            $this->db->select("CONCAT('" . base_url(getenv('THUMBURL')) . "', ".$this->table.".profileImage) as thumbProfileImage", FALSE);
        }

        $this->db->from($this->table);

        if (isset($data['id']) && !empty($data['id'])) {
            if(isset($data['notInclude'])) {
                $this->db->where($this->table . '.id !=', $data['id']);
            } else {
                if (is_array($data['id'])) {
                    $this->db->where_in($this->table . '.id', $data['id']);
                } else {
                    $this->db->where($this->table . '.id', $data['id']);
                }
            }
        }

        if (isset($data['search']) && !empty($data['search'])) {
            $search = trim($data['search']);
            $this->db->group_start();
                $this->db->like($this->table . '.firstName', $search);
                $this->db->or_like($this->table . '.lastName', $search);
                $this->db->or_like($this->table . '.fullName', $search);
                $this->db->or_like($this->table . '.email', $search);
                $this->db->or_like($this->table . '.phone', $search);
            $this->db->group_end();
        }

        if (isset($data['like']) && isset($data['value'])) {
            $this->db->like($this->table . '.' . $data['like'], $data['value']);
        }

        if (isset($data['firstName'])) {
            $this->db->where($this->table . '.firstName', $data['firstName']);
        } 

        if (isset($data['lastName'])) {
            $this->db->where($this->table . '.lastName', $data['lastName']);
        } 

        if (isset($data['fullName'])) {
            $this->db->where($this->table . '.fullName', $data['fullName']);
        }  

        if (isset($data['email']) && !empty($data['email'])) {
            $this->db->where($this->table . '.email', $data['email']);
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $this->db->where($this->table . '.password', $data['password']);
        }

        if (isset($data['phoneCode']) && !empty($data['phoneCode'])) {
            $this->db->where($this->table . '.phoneCode', $data['phoneCode']);
        }

        if (isset($data['phone']) && !empty($data['phone'])) {
            $this->db->where($this->table . '.phone', $data['phone']);
        }

        if (isset($data['role']) && !empty($data['role'])) {
            if (is_array($data['role'])) {
                $this->db->where_in($this->table . '.role', $data['role']);
            } else {
                $this->db->where($this->table . '.role', $data['role']);
            }
        }

        if (isset($data['profileImage']) && !empty($data['profileImage'])) {
            $this->db->where($this->table . '.profileImage', $data['profileImage']);
        }

        if (isset($data['verificationCode']) && !empty($data['verificationCode'])) {
            $this->db->where($this->table . '.verificationCode', $data['verificationCode']);
        }

        if (isset($data['forgotCode']) && !empty($data['forgotCode'])) {
            $this->db->where($this->table . '.forgotCode', $data['forgotCode']);
        }

        if (isset($data['timeZone']) && !empty($data['timeZone'])) {
            $this->db->where($this->table . '.timeZone', $data['timeZone']);
        }
        if (isset($data['customerId']) && !empty($data['customerId'])) {
            $this->db->where($this->table . '.customerId', $data['customerId']);
        }
        if (isset($data['isReceiveNotification']) && !empty($data['isReceiveNotification'])) {
            $this->db->where($this->table . '.isReceiveNotification', $data['isReceiveNotification']);
        }
        if (isset($data['isOnline'])) {
            $this->db->where($this->table . '.isOnline', $data['isOnline']);
        }  
        if (isset($data['profileStep'])) {
            $this->db->where($this->table . '.profileStep', $data['profileStep']);
        }

        if (isset($data['createdDate'])) {
            $this->db->where($this->table . '.createdDate', $data['createdDate']);
        }

        if (isset($data['updatedDate'])) {
            $this->db->where($this->table . '.updatedDate', $data['updatedDate']);
        }

        if (isset($data['status'])) {
            if (is_array($data['status'])) {
                $this->db->where_in($this->table . '.status', $data['status']);
            } else {
                $this->db->where($this->table . '.status', $data['status']);
            }
        }

        if (!$num_rows) {
            if (isset($data['limit']) && isset($data['offset'])) {
                $this->db->limit($data['limit'], $data['offset']);
            } elseif (isset($data['limit']) && !empty($data['limit'])) {
                $this->db->limit($data['limit']);
            } else {
                //$this->db->limit(10);
            }
        }

        if (isset($data['orderby']) && !empty($data['orderby'])) {
            $this->db->order_by($this->table.'.'.$data['orderby'], (isset($data['orderstate']) && !empty($data['orderstate']) ? $data['orderstate'] : 'DESC'));
        }

        $query = $this->db->get();
        //echo "<pre>";echo $this->db->last_query(); die;
        if ($num_rows) {
            $row = $query->row();
            return isset($row->totalRecord) && !empty($row->totalRecord) ? $row->totalRecord : "0";
        }

        if ($single) {
            return $query->row();
        } elseif (isset($data['id']) && !empty($data['id']) && !is_array($data['id'])) {
            return $query->row();
        }

        return $query->result();
    }

    public function setData($data, $id = 0) {
        if (empty($data)) {
            return false;
        }
        $modelData = array();
        
        if (isset($data['firstName']) && !empty($data['firstName'])) {
            $modelData['firstName'] = ucwords($data['firstName']);
            $modelData['fullName'] = isset($data['firstName']) ? ucwords($data['firstName']) . (isset($data['lastName']) && !empty($data['lastName']) ? " " . ucwords($data['lastName']) : "") : "";
        }

        if (isset($data['lastName'])) {
            $modelData['lastName'] = ucwords($data['lastName']);
        }

        if (isset($data['email'])) {
            $modelData['email'] = $data['email'];
        }

        if (isset($data['password'])) {
            $modelData['password'] = $data['password'];
        }

        if (isset($data['phoneCode'])) {
            $modelData['phoneCode'] = $data['phoneCode'];
        }

        if (isset($data['phone'])) {
            $modelData['phone'] = $data['phone'];
        }

        if (isset($data['role'])) {
            $modelData['role'] = $data['role'];
        }

        if (isset($data['profileImage']) && !empty($data['profileImage'])) {
            $modelData['profileImage'] = $data['profileImage'];
        }

        if (isset($data['verificationCode'])) {
            $modelData['verificationCode'] = $data['verificationCode'];
        }
    
        if (isset($data['forgotCode'])) {
            $modelData['forgotCode'] = $data['forgotCode'];
        }

        if (isset($data['timeZone'])) {
            $modelData['timeZone'] = $data['timeZone'];
        }

        if (isset($data['profileStep'])) {
            $modelData['profileStep'] = $data['profileStep'];
        }

        if (isset($data['customerId'])) {
            $modelData['customerId'] = $data['customerId'];
        }
        if (isset($data['isReceiveNotification'])) {
            $modelData['isReceiveNotification'] = $data['isReceiveNotification'];
        }
        if (isset($data['isOnline'])) {
            $modelData['isOnline'] = $data['isOnline'];
        }

        if (isset($data['status'])) {
            $modelData['status'] = $data['status'];
        }

        if (isset($data['updatedDate'])) {
            $modelData['updatedDate'] = $data['updatedDate'];
        } elseif (!empty($id)) {
            $modelData['updatedDate'] = time();
        }

        if (empty($modelData)) {
            return false;
        }
        if (empty($id)) {
            $modelData['createdDate'] = !empty($data['createdDate']) ? $data['createdDate'] : time();
        }
        $this->db->flush_cache();
        $this->db->trans_begin();

        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update($this->table, $modelData);
        } else {
            $this->db->insert($this->table, $modelData);
            $id = $this->db->insert_id();
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return $id;
    }

    public function userData($id, $secure = FALSE, $authId = "") {      
        if (empty($id)) {
            return false;
        }
        $user = $this->get(['id' => $id,'getStripeConnectedAccountData'=>TRUE]);

        if (empty($user)) {
            return false;
        }

        if (empty($user->password)) {
            $user->fillpassword = "0";
        } else {
            $user->fillpassword = "1";
        }

        if (empty($user)) {
            return false;
        }

        if ($secure == FALSE) {
            $user->token = "";
        }

        $user->password = "";
        $user->forgotCode = "";
        $user->verificationCode = "";
        $user->token = "";
        if(!empty($authId)) {
            $this->load->model('Auth_Model');
            $getAuthData = $this->Auth_Model->get(['id'=>$authId],TRUE);
            if(!empty($getAuthData)){
                $user->token = $getAuthData->token;
            }
        }
        return $user;
    }

}
