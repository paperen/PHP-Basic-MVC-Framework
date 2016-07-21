<?php
use Endroid\QrCode\QrCode;
class indexController extends baseController{
		
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data = array();
		$this->load->model('posts');
		$this->load->view('index',$data);	
	}

}
