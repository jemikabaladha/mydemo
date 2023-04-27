<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test_Model extends CI_Model {

    function saverecords($name,$age)
	{
        $query="insert into test values('','$name','$age',1)";
        $this->db->query($query);
	}

}
