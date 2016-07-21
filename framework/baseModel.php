<?php
class baseModel{
	
	// primary key
	protected $_pk;
	// fileds
	protected $_fields = array( );
	// filed => value
	protected $_data = array( );
	// table name
	protected $_table_name;
	// rules
	protected $_rules;
	
	protected $db;

	function __construct() {
		$this->db = database();
	}

	public function get_by_sql( $sql ) {
		return $this->db->select($sql);
	}
	
	/**
	 * 获取表名
	 * @return string 表名
	 */
	public function _table_name() {
		return $this->_table_name;
	}

	/**
	 * 获得主键的名称
	 * @return string 主键
	 */
	public function _primary_key() {
		return $this->_pk;
	}

	/**
	 * 获得所有字段
	 * @return array 字段
	 */
	public function _fields() {
		return array_keys( $this->_fields );
	}

	/**
	 * 获取某个字段的描述
	 * @param string $key
	 * @return string
	 */
	public function get_field( $key = '' ) {
		return ( $key && isset( $this->_fields[$key] ) ) ? $this->_fields[$key] : $this->_fields;
	}

	/**
	 * 设置数据
	 * @param array $data 数据
	 */
	public function _set_data( $data ) {
		$this->_data = $data;
	}

	/**
	 * 根据字段过滤数据
	 * @param array $data 数据
	 * @param bool $is_pk 是否包含主键
	 * @return array 过滤后的数据
	 */
	public function _filter_data( $data, $is_pk = FALSE ) {
		$filter_data = array( );
		$fields = $this->_fields();
		foreach ( $data as $k => $v ) {
			if ( $is_pk && $this->_primary_key() == $k ) continue;
			if ( !in_array( $k, $fields ) ) continue;
			$filter_data[$k] = $v;
		}
		return $filter_data;
	}

	/**
	 * 获得数据
	 * @return array 数据
	 */
	public function _get_data() {
		return $this->_data;
	}

	/**
	 * 清空数据
	 */
	public function _clear_data() {
		$this->_data = array( );
	}

	/**
	 * 插入数据
	 * @param array $data 数据
	 * @return int 生成ID
	 */
	public function insert( $data ) {
		if ( empty( $data ) ) return FALSE;
		$this->_set_data( $this->_filter_data( $data ) );
		$this->db->insert( $this->_table_name(), $this->_get_data() );
		$this->_clear_data();
		return $this->db->insert_id();
	}

	/**
	 * 插入多行数据
	 * @param array $data
	 * @return int 影响行数
	 */
	public function insert_batch( $data ) {
		// @todo
	}

	/**
	 * 更新数据
	 * @param array $data 数据
	 * @return int 影响行数
	 */
	public function update( $data ) {

		$pk = $this->_primary_key();

		if ( !isset( $data[$pk] ) ) return FALSE;
		$pk_value = $data[$pk];

		$this->_set_data( $this->_filter_data( $data, TRUE ) );
		$this->db->update( $this->_table_name(), $this->_get_data(), "`{$pk}`='{$pk_value}'" );
		$this->_clear_data();
		return $this->db->affected_rows();
	}

	/**
	 * 通过主键删除数据
	 * @param int $pk 主键ID
	 * @return int 影响行数
	 */
	public function delete( $pk ) {
		$key = $this->_primary_key();
		$tablename = $this->_table_name();
		return $this->db->delete( $tablename, "`{$key}`='{$pk}'" );
	}

	/**
	 * 通过主键获得单个数据
	 * @param int $pk 主键ID
	 * @return array 数据
	 */
	public function get_by_pk( $pk ) {
		$tablename = $this->_table_name();
		$fields = implode( '`,`', $this->_fields() );
		$key = $this->_primary_key();
		$sql = "select `{$fields}` from {$tablename} where `{$key}`='{$pk}'";
		return $this->db->get_one($sql);
	}

	/**
	 * 获取所有数据
	 * @param int $limit 每页显示条数
	 * @param int $offset 游标
	 * @return array 数据
	 */
	public function all( $limit = 0, $offset = 0 ) {
		$tablename = $this->_table_name();
		print_r($this->_fields());
		$fields = implode( '`,`', $this->_fields() );
		$key = $this->_primary_key();
		$sql = "select `{$fields}` from {$tablename} order by {$key} desc";
		if ( $limit ) $sql .= " limit {$offset},{$limit}";
		return $this->db->select( $sql );
	}

	/**
	 * 获得总数
	 * @return int 总数
	 */
	public function total() {
		$tablename = $this->_table_name();
		$sql = "select count(*) from `{$tablename}`";
		$r = $this->db->get_one($sql);
		return $r['count(*)'];
	}
}
?>
