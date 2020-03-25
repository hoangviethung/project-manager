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
		$this->db->where('user.is_active',1);
		$this->db->join('group_detail','group_detail.user_id = user.id');
		$this->db->where('group_detail.group_id',$group_id);
		$result= $this->db->get('user')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}

	public function get_users_by_project($project_id)
	{
		$this->db->where('user.is_active',1);
		$this->db->join('project_detail','project_detail.user_id = user.id');
		$this->db->where('project_detail.project_id',$project_id);
		$result= $this->db->get('user')->result();
		if($result)
		{
			return $result;
		}
		return false;
	}
}

?>