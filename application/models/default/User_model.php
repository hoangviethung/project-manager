<?php 

class User_model extends CI_model
{
	public function __construct() {
	}
	public function get_all()
	{
		$this->db->where('is_active',1);
		$result= $this->db->get('user')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_by_id($id)
	{
		$this->db->where('is_active',1);
		$this->db->where('id',$id);
		$result= $this->db->get('user')->row();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_users_by_group($group_id)
	{
		$this->db->select('user.*,group_detail.group_id,group_detail.is_lead,group_detail.date_added,group_detail.is_confirmed,group_detail.date_confirmed');
		$this->db->join('user','group_detail.user_id = user.id');
		$this->db->where('group_detail.group_id',$group_id);
		$this->db->where('user.is_active',1);
		$this->db->where('user.is_confirmed',1);
		$result= $this->db->get('group_detail')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_users_by_project($project_id)
	{
		$this->db->select('user.*,project_detail.project_id,project_detail.is_lead,project_detail.date_added');
		$this->db->join('project_detail','project_detail.user_id = user.id');
		$this->db->where('project_detail.project_id',$project_id);
		$this->db->where('user.is_active',1);
		$result= $this->db->get('project_detail')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_user($where)
	{
		$this->db->where('is_active',1);
		if($where)
		{
			$this->where_condition($where);
		}
		$result= $this->db->get('user')->row();
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
}

?>