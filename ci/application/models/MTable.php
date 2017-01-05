<?php

class MTable extends CI_Model{
	
	private $tb_coll = 't_zhihu_collection';

    public function __construct()
    {
        parent::__construct();
        $this->default_db=$this->load_database('default');
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
	
	public function insert($r){
		return $ret = $this->default_db->insert($this->tb_coll, $r);
	}
		
	public function query($field='*'){
		
        $query = $this->default_db
            ->select($field)
            ->from($this->tb_coll)
            ->get();

        $row = $query->result_array();
        $query->free_result();

        return empty($row) ? array() : $row;
	}
} 