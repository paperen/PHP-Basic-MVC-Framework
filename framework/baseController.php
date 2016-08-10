<?php
	abstract class baseController{
		
		protected $_registry;

		public $load;

		public function __construct(){
			$this->load = new Load;
		}
		abstract public function index();
		
		function __get($name) {
			if ( isset( $this->load->$name ) ) return $this->load->$name;
		}
	}
?>
