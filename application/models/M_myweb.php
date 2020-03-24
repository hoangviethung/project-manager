<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class M_myweb extends CI_model{
	private $table;
	private $_data;
	private $_data_like;
	private $primary_key='id';
	private $primary=0;
	private $pageof=20;
	public function __construct() {
		parent::__construct();
		//$this->table = 'member';
		if (!isset($this->_data )) 
		   $this->_data = new stdClass();
		if (!isset($this->_data_like )) 
		   $this->_data_like = new stdClass();
		$this->primary = false;
	}
	public function primary_key($key){
		$this->primary_key = $key;
		return $this;
	}
	public function set_table($_table){
		$this->table = $_table;
		return $this;
	}
	public function select($select){
		$this->db->select($select);
		return $this;
	}
	function setPrimary($val){
		$this->primary=$val;
		return $this;
	}
	public function set($tag,$value){
		$this->_data->$tag = $value;
		return $this;
	}
	public function sets($array) {
		foreach ($array as $k => $v) {
			if(isset($this->_data->$k)) {
				$this->_data->$k = $v;
			}
			else{
				$this->_data->$k =  $v;
			}
		}
		return $this;
	}
	public function sets_like($array) {
		foreach ($array as $k => $v) {
			if(isset($this->_data_like->$k)) {
				$this->_data_like->$k = $v;
			}
			else{
				$this->_data_like->$k =  $v;
			}
		}
		return $this;
	}
	public function save() {
		if($this->primary){
			$this->db->where($this->primary_key,  $this->primary)->update($this->table,  $this->_data);
			$this->_data = new stdClass();
		}else{
			$this->db->insert($this->table,  $this->_data);
			$this->_data = new stdClass();
			return $this->db->insert_id();
		}
		return $this->primary;
	}
	public function page($index=1){
		if($index){
			$this->db->limit( $this->pageof, ($index-1) * $this->pageof );
		}
		return $this;
	}
	public function set_pageof($num=20){
		$this->pageof = (int)$num;
		return  $this;
	}
	public function set_orderby($name,$sort='asc')
	{
		$this->db->order_by($name,$sort);
		return  $this;
	}
	public function counts(){
		if($this->_data){
			$this->db->where((array)$this->_data);
			$this->_data = new stdClass();
		}
		if($this->_data_like){
			$this->db->or_like((array)$this->_data_like);
			$this->_data_like = new stdClass();
		}
		$this->db->from($this->table);
		return $this->db->count_all_results();
		/*$get = $this->db->get($this->table);
		return $get->num_rows();	*/	
	}
	public function get() {
		if($this->_data_like){
			$this->db->or_like((array)$this->_data_like);
			$this->_data_like = new stdClass();
		}
		if($this->_data){
			$get = $this->db->where((array)$this->_data)->get($this->table);
			$this->_data = new stdClass();
		}
		else{
			$get = $this->db->get($this->table);
			$this->_data = new stdClass();
		}
		if($get->num_rows() == 0) {
			return FALSE;
		}
		return $get->row();
	}
	public function gets(){
		if($this->_data_like){
			$this->db->or_like((array)$this->_data_like);
			$this->_data_like = new stdClass();
		}
		if($this->_data){
			$this->db->where((array)$this->_data);
			$this->_data = new stdClass();
		}
		$get = $this->db->get($this->table);
		if($get->num_rows() == 0) {
			return FALSE;
		}		
		return $get->result();
	}
}