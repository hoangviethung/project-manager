<?php 

class M_gallery extends CI_model

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

	public function getGalleryList()

	{

        $arr= array();

        $this->db->where('deleted',0);

        $this->db->where('active',1);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get('gallery');

        foreach($query->result() as $row)

		{   

            $row->images=$this->loadImagePage($row->id);

            $arr[$row->id]=$row;

		}

		return $arr;

    }





    function loadImagePage($gallery_id=false){

        $arr= array();

        if($this->page<=1){

            $this->offset=0;

        }else{

            $this->offset = ($this->page-1) * $this->limit;

        }

        $this->db->where('deleted',0);

        $this->db->where('active',1);

        if($gallery_id)

        {

            $this->db->where('gallery_id',$gallery_id);

        }

        $query = $this->db->get('gallery_detail',$this->limit,$this->offset);

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