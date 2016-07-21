<?php
if ( !defined('SITE_PATH') ) define('SITE_PATH', dirname(APP_PATH). DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', APP_PATH . 'controllers' . DIRECTORY_SEPARATOR);
define('CONFIG_PATH', APP_PATH . 'config' . DIRECTORY_SEPARATOR);
define('HELPER_PATH', APP_PATH . 'helper' . DIRECTORY_SEPARATOR);
define('LIB_PATH', APP_PATH . 'library' . DIRECTORY_SEPARATOR);

class framework
{
	static $instance;
	
	public $config;
	
	function __construct() {
		require_once(SYS_PATH.'request.php');
		require_once(SYS_PATH.'router.php');
		require_once(SYS_PATH.'baseController.php');
		require_once(SYS_PATH.'baseModel.php');
		require_once(SYS_PATH.'load.php');
		require_once(SYS_PATH.'registry.php');
		require_once(SYS_PATH.'common.php');
		require_once(CONTROLLER_PATH.'errorController.php');
		require_once(CONFIG_PATH.'config.php');
		$this->config = $config;
	}
	
	public function go() {
		try{
			Router::route(new Request);
		}catch(Exception $e){
			$controller = new errorController;
			$controller->error($e->getMessage());
		}
	}
	
	static public function run() {
		self::$instance = new framework();
		self::$instance->go();
	}
}