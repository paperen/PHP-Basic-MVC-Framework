<?php

	class posts extends baseModel{
		
		public function getEntries(){
			$return = array();
			$return[0] = array('title'=>'hello world');
			$return[1] = array('title'=>'hello universe');

			return $return;
		}
	}
?>
