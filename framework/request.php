<?php
	class Request{
		
		private $_controller;

		private $_method;

		private $_args;

		public function __construct(){
			
			// url_mode
			$url_mode = config_item('url_mode');
			if ( empty( $url_mode ) ) $url_mode = 1;
			$c = 'index';
			$m = 'index';
			$args = array();
			if ( $url_mode == 1 ) {
				// basic mode
				$query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : NULL;
				if ( $query ) {
					parse_str($query, $temp);
					if ( isset($temp['c']) ) $c = $temp['c'];
					if ( isset($temp['m']) ) $m = $temp['m'];
					unset($temp['c']);
					unset($temp['m']);
					foreach( $temp as $v ) $args[] = $v;
				}
			} else if( $url_mode == 2 ) {
				$request_url = $_SERVER['REQUEST_URI'];
				$temp = parse_url(config_item('site_url'));
				if ( $request_url ) {
					$request_url = str_replace($temp['path'], '', $request_url);
					$temp = explode('/', trim($request_url, '/'));
					$c = array_shift($temp);
					$m = array_shift($temp);
					$args = $temp;
				}
			} else {
				// @todo
			}
			if ( empty($c) ) $c = 'index';
			$this->_controller = $c;
			$this->_method = $m;
			$this->_args = $args;
		}

		public function getController(){
			return $this->_controller;
		}
		public function getMethod(){
			return $this->_method;
		}
		public function getArgs(){
			return $this->_args;
		}
	}
