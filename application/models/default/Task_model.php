<?php 

class Task_model extends CI_model
{
	private $where;
    private $order;
    private $by;
	private $limit;
	private $offset;
	private $page;
	public function __construct() {
		parent::__construct();
		if (!isset($this->where )) 
		   $this->where = array();
		if(!isset($order_by)){
			$this->order_by=array();
		}
		if (!isset($this->page)){
		$this->page = 1;}
		if (!isset($this->limit)){
		$this->limit = 1;}
		$this->order=false;
		$this->by=false;
		$this->whereIn=false;
	}
	public function get_tasks($where = false)
	{
		$this->db->select('task.*,task_category.name as category_name,task_status.name as status_name');
		$this->db->where('task.is_active',1);
		$this->db->join('task_category','task_category.id = task.category_id');
		$this->db->join('task_status','task_status.id = task.category_id');
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('task')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_by_id($task_id)
	{
		$this->db->select('task.*,task_category.name as category_name,task_status.name as status_name');
		$this->db->where('task.is_active',1);
		$this->db->join('task_category','task_category.id = task.category_id');
		$this->db->join('task_status','task_status.id = task.category_id');
		$this->db->where('task.id',$task_id);
		$result= $this->db->get('task')->row();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_tasks_by_user($userId,$where = false)
	{
		$this->db->select('task.*,task_category.name as category_name,task_status.name as status_name');
		$this->db->where('task.is_active',1);
		$this->db->join('task_category','task_category.id = task.category_id');
		$this->db->join('task_status','task_status.id = task.category_id');
		$this->db->group_start();
		$this->db->where('task.assignee',$userId);
		$this->db->or_where('task.assigner',$userId);
		$this->db->or_where('task.report_to',$userId);
		$this->db->group_end();
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('task')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	protected function where_condition($condition)
	{
		foreach($condition as $key=>$value)
		{
			$this->db->where($key,$value);
		}
	}

	public function setPage($page)
	{
		$this->page = $page;
	}

	public function setLimit($limit)
	{
		$this->limit = $limit;
	}

}

?>