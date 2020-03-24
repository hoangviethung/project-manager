<?php 
class M_news extends CI_model
{
    private $where;
    private $page;
    private $limit;
    private $offset;
    private $order_by;
    public function __construct() {
		parent::__construct();
        if (!isset($this->page)) 
            $this->page = 1;
        if (!isset($this->limit)) 
            $this->limit = 3;
        if (!isset($this->where )) 
            $this->where = array();
        if(!isset($order_by)){
            $this->order_by = array(
                'id'=>'DESC'
            );

        }
	}
	public function getNews()
	{
        if($this->page<=1){
            $this->offset=0;
        }else{
            $this->offset = ($this->page-1) * $this->limit;
        }
        $this->db->where('deleted',0);
        $this->db->where('active',1);
        if($this->where)
        {
            $this->db->where($this->where);
        }
        if($this->order_by)
        {
            foreach($this->order_by as $field => $order)
            {
                $this->db->order_by($field,$order);
            }
        }
        if(isset($this->where['id']))
        {
            $query = $this->db->get('tin_tuc');
            $data=$query->row();
        }else{
            $query = $this->db->get('tin_tuc',$this->limit,$this->offset);
            $data=$query->result();
        }
        return $data;
    }

    public function setPage($page)
	{
		$this->page = $page;
    }
    public function setLimit($limit)
	{
		$this->limit = $limit;
    }
    public function setOrderBy($field,$order="ASC")
	{
		$this->order_by[$field]=$order;
    }
    public function setWhere($where,$value)
	{
		$this->where[$where] = $value;
    }
    public function count()
    {
        $this->db->where('deleted',0);
        $this->db->where('active',1);
        if($this->where)
        {
            $this->db->where($this->where);
        }
        $this->db->from('tin_tuc');
        return $this->db->count_all_results();
    }
    public function totalPages()
    {
        $count=$this->count();
        $totalPages=ceil($count/$this->limit);
        return $totalPages;
    }
}
?>