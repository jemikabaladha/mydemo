<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('Test_Model');
	}

	public function test()
	{
        $n = "test";
        $a = "26";
		// $this->Test_Model->saverecords($n, $a);

	}
}
