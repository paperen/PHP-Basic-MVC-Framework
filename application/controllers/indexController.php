<?php
use Endroid\QrCode\QrCode;
class indexController extends baseController{
		
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data = array();
		set_pagetitle('home');
		$this->load->layout('index', $data);
	}
	
	public function test($a=NULL) {
		$test = $this->load->library('test');
		$test->a();
	}

}
