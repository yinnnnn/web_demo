<?php

class MTable extends CI_Model{
	
	private $tb_coll = 't_zhihu_collection';

    public function __construct()
    {
        parent::__construct();
        $this->default_db=$this->load_database('default');
		$this->default_db->query('set names utf8');
    }
	
	/**
	 * 载入一个 DB 链接对象
	 *
	 * @param string $name
	 *        	db配置名称
	 */
	public function load_database($name = self::DB_DEFAULT) {
		$CI = &get_instance ();
		
		if (empty ( $CI->mydb )) {
			$CI->mydb = array ();
		}
		
		if (empty ( $CI->mydb [$name] )) {
			$CI->mydb [$name] = $this->load->database ( $name, TRUE );
		}
		return $CI->mydb [$name];
	}
	
	public function insert($table,$r){
		return $this->default_db->insert($table, $r);
//		echo $ret = $this->default_db->last_query();
	}
		
	public function query($table,$field='*'){
		
        $query = $this->default_db
            ->select($field)
            ->from($table)
            ->get();

        $row = $query->result_array();
        $query->free_result();

        return empty($row) ? array() : $row;
	}
} 