<?php 

class Task_comment_model extends CI_model
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
	public function get_task_comments($where = false)
	{
		$this->db->select('	task_comment.*,
							user.user_name,
							user.display_name,
							user.email');
		$this->db->where('task_comment.is_active',1);
		$this->db->join('user','user.id = task_comment.created_by');
		$this->db->order_by('created_at', 'asc');
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

	public function get_task_comment_file($taskId)
	{
		$this->db->select('	
			task_comment_file.id as file_id,
			task_comment_file.file,
			task_comment_file.comment_id');
		$this->db->where('comment_id',$taskId);
		$result= $this->db->get('task_comment_file')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}
	public function get_by_id($task_id)
	{
		$this->db->select('	task_comment.*,
							user.user_name,
							user.display_name,
							user.email,
							user.avatar');
		$this->db->where('task_comment.is_active',1);
		$this->db->join('user','user.id = task_comment.created_by');
		$this->db->order_by('created_at', 'asc');
		$this->db->where('task_comment.id',$task_id);
		$result= $this->db->get('task_comment')->row();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_by_task($task_id)
	{
		$this->db->select('	task_comment.*,
							user.user_name,
							user.display_name,
							user.email,
							user.avatar');
		$this->db->where('task_comment.is_active',1);
		$this->db->join('user','user.id = task_comment.created_by');
		$this->db->order_by('created_at', 'asc');
		$this->db->where('task_comment.task_id',$task_id);
		$result= $this->db->get('task_comment')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_task_comment_by_user($userId,$where = false)
	{
		$this->db->select('	task_comment.*,
							user.user_name,
							user.display_name,
							user.email,
							user.avatar');
		$this->db->where('task_comment.is_active',1);
		$this->db->join('user','user.id = task_comment.created_by');
		$this->db->order_by('created_at', 'asc');
		$this->db->where('task_comment.created_by',$userId);
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('task_comment')->result();
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