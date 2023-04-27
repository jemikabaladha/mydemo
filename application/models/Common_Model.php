<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('Users_Model', 'User');
    }

    // Get Unique No
    public function get_Unique_No() {
        return uniqid();
    }

    // Get Random Number
    public function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
            //$key .= '1';
        }
        return $key;
    }

    //for get file extantion
    public function getFileExtension($file_name) {
        return '.' . substr(strrchr($file_name, '.'), 1);
    }

    public function random_alphnum_string($length) {
        $key = '';
        $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

    public function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 1)
            return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    //for get date format
    public function getDateFormat($date, $time = false, $humanReadable = false) {
        $result = "";
        if ($date != '0000-00-00 00:00:00') {
            if ($humanReadable) {
                $result = date("d M Y", strtotime($date));
            } else {
                if ($time) {
                    $result = date("m-d-Y H:i:s", strtotime($date));
                } else {
                    $result = date("m-d-Y", strtotime($date));
                }
            }
        }
        return $result;
    }

    //for generate token
    public function getToken($length, $config = []) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= isset($config['notSmall']) && $config['notSmall'] ? '' : "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
        }
        return $token;
    }

    // Convert string(password) into hash
    public function convert_to_hash($password) {
        return hash_hmac('SHA512', $password, 1);
    }

    //Start of getNotification function
    public function GetNotification($key, $lang = '1') {
        $colName = "value_en";
        if ($lang == '1') {
            $colName = "value_en";
        }
        $this->db->select('*');
        $this->db->from('tbl_apiresponse');
        $this->db->where("key", $key);
        $this->db->where("status", "1");
        $result = $this->db->get()->row_array();
        if (empty($result)) {
            // return "Message not found";
            return $key;
        }
        return $result[$colName];
    }

    /* for check user login or not in Admin side or Front-end side */

    public function checkUserAuth($type = '2', $isredirect = true) {
        if (empty($this->session->userdata('role')) || empty($this->session->userdata('adminId'))) {
            return redirect(base_url('admin'));
        }

        if ($type == '1') {
            if (($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2) && !empty($this->session->userdata('adminId'))) {
                return true;
            } else {
                if (!$isredirect) {
                    return false;
                } else {
                    $this->session->set_flashdata('error', 'Your session is expire');
                    redirect(base_url('admin'));
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Your session is expire');
            redirect(base_url('admin'));
        }
    }
    //for send email
    public function mailsend($recipient, $subject, $body, $from = NULL, $file = NULL, $bcc = NULL,$replyTo = NULL,$replyToName = NULL) {
        try {
            $this->load->library('email');
            $mail['charset'] = "utf-8";
            $mail['newline']  = '\r\n';
            $mail['wordwrap']  = TRUE;
            $mail['mailtype'] = 'html';
            $mail['protocol'] = "mail"; //smtp
            $mail['smtp_host'] = getenv('SMTP_HOST');
            $mail['smtp_port'] = getenv('SMTP_PORT');
            $mail['smtp_user'] = getenv('SMTP_USER');
            $mail['smtp_pass'] = getenv('SMTP_PASSWORD');
            $mail['SMTPAuth']   = TRUE;
            $mail['SMTPSecure'] = "SSL";
            $this->email->initialize($mail);
            $from = empty($from) ? getenv('FROM_EMAIL') : $from;
            $this->email->from($from, getenv('WEBSITE_NAME'));
            $this->email->subject($subject);
            $this->email->message($body);

            if (!empty($recipient) && is_array($recipient)) {
                foreach ($recipient as $key => $value) {
                    $this->email->to($value);
                }
            } elseif (!empty($recipient)) {
                $this->email->to($recipient);
            }            
            if (!empty($file) && is_array($file)) {
                foreach ($file as $key => $value) {
                    $this->email->attach($value);
                }
            } elseif (!empty($file)) {
                $this->email->attach($file);
            }

            $systemBCC = getenv('EMAIL_BCC');
            if (!empty($systemBCC) && is_array($systemBCC)) {
                foreach ($systemBCC as $key => $value) {
                    $this->email->bcc($value);
                }
            } elseif (!empty($systemBCC)) {
                $this->email->bcc($systemBCC);
            }

            if (!empty($bcc) && is_array($bcc)) {
                foreach ($bcc as $key => $value) {
                    $this->email->bcc($value);
                }
            } elseif (!empty($bcc)) {
                $this->email->bcc($bcc);
            }
            if(!empty($replyTo)){
                //$this->email->ClearReplyTos();
                $this->email->reply_to($replyTo, $replyToName);
            }
            return $this->email->send();
            //var_dump($this->email->print_debugger ( array ('headers','subject') ));
        } catch (Stripe\Error\Card $e) {
            return $e->getJsonBody();
        }
    }

    public function distance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return round($miles, 1) . "";
    }

    public function is_jsonDecode($json) {
        if (empty($json)) {
            return $json;
        }

        $ob = json_decode($json);
        if ($ob === null) {
            return $json;
        } else {
            return $ob;
        }
    }

    public function get_time_ago($time) {
        $time_difference = time() - $time;
        if ($time_difference < 1) {
            return '1 second ago';
        }
        $condition = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;
            if ($d >= 1) {
                $t = round($d);
                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

    //Function definition

    public function timeAgo($time_ago) {
        $time_ago = strtotime($time_ago);
        $cur_time = time();
        $time_elapsed = $cur_time - $time_ago;
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);

        //Hours
        if ($hours <= 24) {
            return "Today";
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years == 1) {
                return "a year ago";
            } else {
                return "$years years ago";
            }
        }
    }

    public function backroundCall($function, $data) {

        /*if (class_exists('GearmanClient')) {
            $this->load->library('lib_gearman');
            $this->lib_gearman->gearman_client();
            $this->lib_gearman->do_job_background('dc_' . $function, serialize($data));
        } else {
            $this->Background_Model->$function($data);
        }*/
        $this->Background_Model->$function($data);
    }

    public function check_cc($cc) {
        $cards = array(
            "visa" => "(4\d{12}(?:\d{3})?)",
            "amex" => "(3[47]\d{13})",
            "jcb" => "(35[2-8][89]\d\d\d{10})",
            "mastercard" => "(5[1-5]\d{14})",
        );
        $names = array("visa.png", "amex.png", "jcb.png", "mastercard.png");
        $matches = array();
        $pattern = "#^(?:" . implode("|", $cards) . ")$#";
        $result = preg_match($pattern, str_replace(" ", "", str_replace("-", "", $cc)), $matches);
        return ($result > 0) ? $names[sizeof($matches) - 2] : false;
    }

    public function validateCreditcard_number($card_number) {
        // Get the first digit
        $firstnumber = substr($card_number, 0, 1);
        // Make sure it is the correct amount of digits. Account for dashes being present.
        switch ($firstnumber) {
            case 3:
                if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $card_number)) {
                    //return 'This is not a valid American Express card number';
                    return false;
                }
                break;
            case 4:
                if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $card_number)) {
                    //return 'This is not a valid Visa card number';
                    return false;
                }
                break;
            case 5:
                if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $card_number)) {
                    //return 'This is not a valid MasterCard card number';
                    return false;
                }
                break;
            case 6:
                if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $card_number)) {
                    //return 'This is not a valid Discover card number';
                    return false;
                }
                break;
            default:
                //return 'This is not a valid credit card number';
                return false;
        }
        //return 'This is a valid credit card number';
        return true;
    }

    // Start From Hear

    /**
     * Get users connection status
     * 0 -> Not friend,
     * 1 -> Friend,
     * 2 -> Accept Request Pending,
     * 3 -> Cancel Sending Request,
     * 4 -> Blocked user
     */
    public function getUserConnectionStatus($friend_id = "0", $user_id = "0") {
        if (empty($friend_id) || empty($user_id)) {
            return false;
        }
        //is_friend = 0->Not friend, 1-> Friend, 2->Accept Request Pending, 3->Cancel Sending Request, 4->Blocked user, 5->This is My Event
        $status = "0"; // Not Friend 
        $checkFriend = $this->Connection_Model->get(['checkFriend' => ['friendId' => $friend_id, 'myId' => $user_id]], true);
        if (!empty($checkFriend)) {
            if ($checkFriend->status == 1) {
                $status = "1"; // Already Friend
            } elseif ($checkFriend->status == 0) {
                if ($checkFriend->myId == $user_id) {
                    $status = "3"; //Send Request
                } elseif ($checkFriend->myId == $friend_id) {
                    $status = "2"; //Receive Request
                }
            } elseif ($checkFriend->status == 3) {
                $status = "4"; //Blocked user
            }
        }
        return $status;
    }

    function object_to_array($data) {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        
        return $data;
    }

    function validateDate($date, $format = 'Y-m-d H:i:s') {        
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function timezonewiseConvertDate($fromTimezone, $toTimezone, $date) {
        $dateObject = new DateTime($date, new DateTimeZone($fromTimezone));
        $dateObject->setTimezone(new DateTimeZone($toTimezone));
        return $dateObject->format('Y/m/d');
    }
        
        
    public function timezonewiseConvertUnixDate($fromTimezone, $toTimezone, $date) {    
        $dateObject = new DateTime($date, new DateTimeZone($fromTimezone));
        $dateObject->setTimezone(new DateTimeZone($toTimezone));
        return $dateObject->format('U');
    }
}
