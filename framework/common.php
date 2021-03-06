<?php

/**
 * 获取framework实例
 * @retrun object
 */
function get_instance() {
	return framework::$instance;
}

/**
 * 获取配置项
 * @param string $k 配置键值
 * @return mixed
 */
function config_item($k = NULL) {
	$fr = get_instance();
	if ( empty($k) ) return $fr->config;
	return isset( $fr->config[$k] ) ? $fr->config[$k] : NULL;
}

/**
 * 获取输入
 * @param string $k 键值
 * @return string
 */
function get($k) {
	return isset( $_REQUEST[$k] ) ? $_REQUEST[$k] : NULL;
}
/**
 * 初始化数据库
 */
function database() {
	static $_db;
	if ( $_db ) return $_db;
	$db_config = config_item('db');
	$db_type = $db_config['dbtype'];
	if ( !@include(SYS_PATH.DIRECTORY_SEPARATOR."db/{$db_type}.php") ) exit("{$db_type} db driver misssing");
	$_db = new $db_type();
	$_db->connect($db_config['dbhost'], $db_config['dbuser'], $db_config['dbpwd'], $db_config['dbname'], $db_config['pconnect'], $db_config['charset']);
	return $_db;
}
/**
 * 重定向
 * @param string $url
 */
function redirect($url) {
	header("location:{$url}");
	exit;
}
/**
 * 组合站点链接
 * @param string $uri
 * @return string
 */
function base_url($uri = NULL) {
	return config_item('site_url') . $uri;
}

/**
 * 设置页面标题
 * @param string $title 标题
 */
function set_pagetitle($title = '') {
	$f = get_instance();
	$f->pagetitle = $title;
}

/**
 * 获取页面标题
 * @return string
 */
function get_pagetitle() {
	$f = get_instance();
	return $f->pagetitle;
}