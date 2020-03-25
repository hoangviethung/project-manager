<?php 

class Project_model extends CI_model
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
	public function get_projects($where = false)
	{
		$this->db->select("project.*,user.user_name,user.email,user.display_name,user.avatar");
		$this->db->where('project.is_active',1);
		$this->db->join('user','user.id = project.leader');
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('project')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_by_id($id)
	{
		$this->db->select("project.*,user.user_name,user.email,user.display_name,user.avatar");
		$this->db->where('project.is_active',1);
		$this->db->where('project.id',$id);
		$this->db->join('user','user.id = project.leader');
		$result= $this->db->get('project')->row();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_projects_by_user($userId,$where = false)
	{
		$this->db->where('project.is_active',1);
		$this->db->join('project_detail','project_detail.project_id = project.id');
		$this->db->where('project_detail.user_id',$userId);
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('project')->result();
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