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