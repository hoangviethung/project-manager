<?php 
class M_nguyenquan extends CI_model
{
    public $searchQuery;
    public function __construct() {
		parent::__construct();
    }

    public function getSearchData($search)
    {
        $arr=array();
        $query="SELECT 'product' as table_name, id, 
                        MATCH(name,description) AGAINST('\"".$search."\"' IN BOOLEAN MODE) AS data FROM product WHERE deleted = 0 AND 
                            MATCH(name,description) AGAINST('\"".$search."\"' IN BOOLEAN MODE) 
                UNION SELECT 'category' AS table_name, id, 
                        MATCH(name,description) AGAINST('\"".$search."\"' IN BOOLEAN MODE) AS data FROM category WHERE active= 1 AND deleted = 0 AND 
                            MATCH(name,description) AGAINST('\"".$search."\"' IN BOOLEAN MODE)";
        if($this->db->query($query)->num_rows()>0)
        {
            $data=$this->db->query($query)->result();
            foreach($data as $item)
            {
                $arr[$item->table_name][]=$this->getSearchTable($item->table_name,$item->id);
            }
            return $arr;
        }else{
            return false;
        }
    }

    public function getSearchTable($table_name,$id)
    {
        $this->db->where(array('id'=>$id));
        $this->db->from($table_name);
        return $this->db->get()->row();
    }
}

?>