<?php 

class M_category extends CI_model

{

    private $page;

    private $limit;

    private $offset;

    private $order;

    private $by;



    public function __construct() {
		parent::__construct();
        if (!isset($this->page)) 
            $this->page = 1;
        if (!isset($this->limit)) 
            $this->limit = 6;
        
        $this->order=false;
        $this->by=false;

	}

	//lay danh sach tat ca product

	public function getProductList()
	{
        $arr= array();
        $this->db->where('active',1);

        $this->db->where('deleted',0);

        $query = $this->db->get('category');

        foreach($query->result() as $row)

		{   

            $row->product=$this->loadProduct($row->id);

            $arr[$row->id]=$row;

		}

		return $arr;

    }



    function loadProduct($id){

        $arr= array();

        $this->db->where('active',1);

        $this->db->where('deleted',0);

        $this->db->where('category_id',$id);

        $query = $this->db->get('product');



        foreach($query->result() as $row)

        {

            $arr[]=$row;

        }

        return $arr;

    }



    function loadProductPage($category_id=false){
        $arr= array();
        if($this->page<=1){
            $this->offset=0;
        }else{
            $this->offset = ($this->page-1) * $this->limit;
        }
        $query="SELECT * from (SELECT  product.*,
                        category.id as category_a_id,
                        category.name as category_name,
                        category.description as category_description,
                        category.img as category_img,
                        category.parent as category_parent,
                        category.slug as category_slug,
                        category.active as category_active,
                        category.deleted as category_deleted,
                        category.level as category_level,
                        category.img_large as category_img_large 
                        FROM product JOIN category 
                        WHERE   product.active = 1 
                                AND product.deleted = 0 
                                AND category_id = category.id) as a"; 
        if($category_id)
        {
            $query="SELECT * from ((SELECT  
                        product.*,
                        category.id as category_a_id,
                        category.name as category_name,
                        category.description as category_description,
                        category.img as category_img,
                        category.parent as category_parent,
                        category.slug as category_slug,
                        category.active as category_active,
                        category.deleted as category_deleted,
                        category.level as category_level,
                        category.img_large as category_img_large 
                        FROM product JOIN category 
                        WHERE   product.active = 1 
                                AND product.deleted = 0 
                                AND category_id = category.id
                                AND category.id = ".$category_id.")";
            $this->db->where('active',1);
            $this->db->where('deleted',0);
            $query2=$this->db->get_where('category',array('level'=>0,'id'=>$category_id));
            $result2=$query2->result();
            if(!empty($result2))
            {
                foreach($result2 as $row)
                {
                    $level1 = $this->getCategoryWhere(array('parent'=>$row->id,'level'=>1));
                    if(!empty($level1)){
                        $query=$query."
                            UNION 
                                (SELECT  
                                    product.*,
                                    category.id as category_a_id,
                                    category.name as category_name,
                                    category.description as category_description,
                                    category.img as category_img,
                                    category.parent as category_parent,
                                    category.slug as category_slug,
                                    category.active as category_active,
                                    category.deleted as category_deleted,
                                    category.level as category_level,
                                    category.img_large as category_img_large 
                                    FROM product JOIN category
                                    WHERE   product.active=1 
                                            AND product.deleted = 0 
                                            AND category_id=category.id 
                                            AND category.parent = ".$row->id.")";
                        foreach($level1 as $row2)
                        {
                            $level2 = $this->getCategoryWhere(array('parent'=>$row2->id,'level'=>2));
                            if(!empty($level2)){
                                $query=$query."
                                    UNION 
                                        (SELECT  
                                            product.*,
                                            category.id as category_a_id,
                                            category.name as category_name,
                                            category.description as category_description,
                                            category.img as category_img,
                                            category.parent as category_parent,
                                            category.slug as category_slug,
                                            category.active as category_active,
                                            category.deleted as category_deleted,
                                            category.level as category_level,
                                            category.img_large as category_img_large 
                                            FROM product JOIN category
                                            WHERE   product.active=1 
                                                    AND product.deleted = 0 
                                                    AND category_id=category.id 
                                                    AND category.parent = ".$row2->id.")";
                            }
                        }
                    }
                }
            }else{

                $query3=$this->db->get_where('category',array('level'=>1,'id'=>$category_id));

                foreach($query3->result() as $row1){

                    $level2 = $this->getCategoryWhere(array('parent'=>$row1->id,'level'=>2));

                    if(!empty($level2)){

                        $query=$query."

                            UNION 

                                (SELECT  

                                    product.*,

                                    category.id as category_a_id,

                                    category.name as category_name,

                                    category.description as category_description,

                                    category.img as category_img,

                                    category.parent as category_parent,

                                    category.slug as category_slug,

                                    category.active as category_active,

                                    category.deleted as category_deleted,

                                    category.level as category_level,

                                    category.img_large as category_img_large 

                                    FROM product JOIN category

                                    WHERE   product.active=1 

                                            AND product.deleted = 0 

                                            AND category_id=category.id 

                                            AND category.parent = ".$row1->id.")";

                        

                    }

                }

            }

            $query=$query." ) as a ";

        }

        if($this->order){

            $query=$query." ORDER BY a.".$this->order." ".$this->by;

        }

        $query=$query." LIMIT ".$this->limit." OFFSET ".$this->offset;

        foreach($this->db->query($query)->result() as $row)

        {

            $arr[]=$row;

        }

        return $arr;

    }



    public function getCategory($category_id=false){

        if($category_id==false)

        {

            $category_data=$this->getCategoryWhere(array('level'=>0));

        }else{

            $category_data=$this->getCategoryWhere(array('id'=>$category_id,'level'=>0));

        }

        if(empty($category_data))

        {

            $category_data=$this->getCategoryWhere(array('id'=>$category_id));

            do{

                $category_data=$this->getCategoryWhere(array('id'=>$category_data[0]->parent));

            }while($category_data[0]->level!=0);

        }

        $data=$this->getSubCategory($category_data);

        return $data;

    }

    public function getSubCategory($data)

    {

        $arr= array();

        foreach($data as $row)

        {

            $level1 = $this->getCategoryWhere(array('parent'=>$row->id,'level'=>1));

            if(!empty($level1)){

                $arr_temp = array();

                foreach($level1 as $row2)

                {

                    $level2 = $this->getCategoryWhere(array('parent'=>$row2->id,'level'=>2));

                    if(!empty($level2)){

                        $row2->level2=$level2;

                    }

                    $arr_temp[] = $row2;

                }

                $row->level1=$arr_temp;

                $arr[]=$row;

            }else{

                $arr[]=$row;

            }

            

        }

        return $arr;

    }



    public function getCategoryWhere($where)

    {

        $arr= array();

        $this->db->where('active',1);

        $this->db->where('deleted',0);

        $this->db->where($where);

        $query=$this->db->get('category');

        foreach($query->result() as $row)

        {

            $arr[]=$row;

        }

        if(!empty($arr)){

            return $arr;

        }

        return NULL;

    }

    public function setPage($page)

	{

		$this->page     =   $page;

    }

    public function setLimit($limit)

	{

		$this->limit    =   $limit;

    }

    public function setOrderBy($order,$by)

	{

        $this->order    =   $order;

        $this->by       =   $by;

    }



}

?>