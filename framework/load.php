<?php
	class Load{
		
		public $request;
		public function view($name,array $vars = null){
			$file = APP_PATH.'views/'.$name.'.php';
			if(is_readable($file)){
				if(isset($vars)){
					extract($vars);
				}
				require($file);
				return true;
			}
			throw new Exception('View issues');
		}	
		public function model($name){
			$model = $name;
			$modelPath = APP_PATH.'models/'.$model.'.php';
			if(is_readable($modelPath)){
				require_once($modelPath);
				if(class_exists($model)) $this->$model = new $model();
				return;				
			}
			throw new Exception('Model issues.');	
		}
		
		/**
		 * 加载class
		 * @param string $class 类包名
		 */
		protected $_load_class = array();
		public function library($class) {
			if ( isset( $this->_load_class[$class] ) ) return $this->_load_class[$class];
			if ( file_exists( LIB_PATH . $class . '.php' ) ) include(LIB_PATH . "{$class}.php");
			if ( is_dir( LIB_PATH . $class ) && file_exists( LIB_PATH . $class . DIRECTORY_SEPARATOR . $class . '.php' ) ) include( LIB_PATH . $class . DIRECTORY_SEPARATOR . $class . '.php' );
			if ( class_exists($class) ) $this->_load_class[$class] = new $class();
			return isset($this->_load_class[$class]) ? $this->_load_class[$class] : NULL;
		}
		
		/**
		 * 加载其他函数库
		 * @param string $helper 函数库文件(不含后缀)
		 */
		public function helper($helper) {
			$helper_name = trim($helper, '.php');
			if ( file_exists( HELPER_PATH . "{$helper_name}.php" ) ) include(HELPER_PATH . "{$helper_name}.php");
		}
		
		private $_layout = 'default';
		public function set_layout($layout) {
			$this->_layout = $layout;
		}
		
		public function layout($view, array $vars = null) {
			ob_start();
			$this->view($view, $vars);
			$html = ob_get_contents();
			ob_end_clean();
			$this->view("layout/{$this->_layout}", ['html'=>$html]);
		}
	}
