<?php 
class M_product extends CI_model
{
	//lay danh sach tat ca product
	// public function get_current_page_records($limit, $start)
	// {
	// 	$arr=array();
	// 	$this->db->where('p.deleted',0);
	// 	// $this->db->where('p.active',1);
	// 	$this->db->select('p.id,p.name as name,c.name as category, p.hot, p.active as lock');
	// 	$this->db->from('product p');
	// 	$this->db->join('category c', 'p.category_id = c.id');
	// 	$this->db->order_by("p.name", "asc");
	// 	$this->db->limit($limit, $start);
	// 	$query = $this->db->get();
	// 	foreach($query->result() as $row)
	// 	{
	// 		$arr[]=$row;
	// 	}
	// 	return $arr;
	// }

	public function get_current_page_records()
	{
		$arr=array();
		$this->db->where('p.deleted',0);
		$this->db->select('p.*,c.name as category_name,c.deleted as category_deleted');
		$this->db->from('product p');
		$this->db->join('category c', 'p.category = c.id');
		$this->db->order_by("p.id", "asc");
		
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			$arr[]=$row;
		}
		return $arr;
	}

	public function get_total() 
    {
		$this->db->where('deleted',0);
        return $this->db->count_all_results("product");
	}
	public function deleteRow($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
		if($this->db->affected_rows()<1)
		{
			return false;
		}else{
			return true;
		}

	}
}
?>