<?php
class posts extends baseModel{
	
	protected $_pk = 'id';
	protected $_fields = array(
		'title' => '标题',
		'urltitle' => 'url标题',
	);
	protected $_table_name = 'post';
}