<?php 

class Group_model extends CI_model
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
	public function get_groups($where = false)
	{
		$this->db->select("group.*,user.user_name,user.email,user.display_name,user.avatar");
		$this->db->where('group.is_active',1);
		$this->db->join('user','user.id = group.leader');
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('group')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_by_id($id)
	{
		$this->db->select("group.*,user.user_name,user.email,user.display_name,user.avatar");
		$this->db->where('group.is_active',1);
		$this->db->where('group.id',$id);
		$this->db->join('user','user.id = group.leader');
		$result= $this->db->get('group')->row();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_groups_by_user($userId,$where = false)
	{
		$this->db->select('group.*,group_detail.is_lead,group_detail.date_added,group_detail.is_confirmed');
		$this->db->where('group.is_active',1);
		$this->db->join('group_detail','group_detail.group_id = group.id');
		$this->db->where('group_detail.user_id',$userId);
		$this->db->order_by("group.last_update","desc");
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('group')->result();
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