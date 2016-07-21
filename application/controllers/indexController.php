<?php
use Endroid\QrCode\QrCode;
class indexController extends baseController{
		
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->model('posts');
		$vars['title'] = 'Dynamic title';
		$vars['posts'] = $this->posts->getEntries();
		$this->load->view('index',$vars);	
	}
	
	public function test( $id, $o ) {
		$this->load->library('QrCode');
		$qrCode = new QrCode();
		$qrCode->setText('http://paperen.com')
			->setSize(300)
			->setPadding(10)
			->setErrorCorrection('high')
			->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
			->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
			->setLabelFontSize(16)
			->setImageType(QrCode::IMAGE_TYPE_PNG);

		header('Content-Type: '.$qrCode->getContentType());
		$qrCode->render();
	}

}
