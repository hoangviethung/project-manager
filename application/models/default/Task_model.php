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
		$this->db->select('task.*');
		$this->db->where('task.is_active',1);
		$this->db->order_by('task.last_update','desc');
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
		$this->db->select('task.*');
		$this->db->where('task.is_active',1);
		$this->db->where('task.id',$task_id);
		$this->db->order_by('task.last_update','desc');
		$result= $this->db->get('task')->row();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_tasks_by_user($userId,$where = false)
	{
		$this->db->select('task.*');
		$this->db->where('task.is_active',1);
		$this->db->group_start();
		$this->db->or_where('task.assignee',$userId);
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

	public function get_recent_tasks_by_user($userId)
	{
		$this->db->select('task.*');
		$this->db->where('task.is_active',1);
		$this->db->where('(task.assignee ='.$userId.' or task.assigner ='.$userId.' or task.report_to ='.$userId.')');
		$this->db->order_by('task.last_update','desc');
		$result= $this->db->get('task')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_recent_tasks_by_assignee($userId)
	{
		$this->db->select('task.*');
		$this->db->where('task.is_active',1);
		$this->db->where('task.assignee',$userId);
		$this->db->order_by('task.last_update','desc');
		$result= $this->db->get('task')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_recent_tasks_by_report_to($userId)
	{
		$this->db->select('task.*');
		$this->db->where('task.is_active',1);
		$this->db->or_where('task.report_to',$userId);
		$this->db->order_by('task.last_update','desc');
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