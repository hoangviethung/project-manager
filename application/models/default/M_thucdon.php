<?php 
class M_thucdon extends CI_model
{
    private $page;
    private $limit;
    private $offset;
    public function __construct() {
		parent::__construct();
		//$this->table = 'member';
        if (!isset($this->page)) 
            $this->page = 1;
        if (!isset($this->limit)) 
            $this->limit = 8;
		
	}
	//lay danh sach tat ca product
	public function getDanhMuc()
	{
        $arr= array();
        $this->db->where('deleted',0);
        $query = $this->db->get('danh_muc_mon_an');
        foreach($query->result() as $row)
		{   
            $row->mon_an=$this->loadMonAn($row->id);
            $arr[$row->id]=$row;
		}
		return $arr;
    }


    function loadMonAn($danhmuc_id=false){
        $arr= array();
        if($this->page<=1){
            $this->offset=0;
        }else{
            $this->offset = ($this->page-1) * $this->limit;
        }
        if($danhmuc_id)
        {
            $this->db->where('danh_muc_id',$danhmuc_id);
        }
        $this->db->where('deleted',0);
        $query = $this->db->get('mon_an',$this->limit,$this->offset);
        foreach($query->result() as $row)
        {
            $arr[]=$row;
        }
        return $arr;
        

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