<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Category extends MY_Controller {



	public function __construct(){
		parent::__construct();
		$this->data['style']=isset($_GET['style'])?$_GET['style']:false;
		$this->data['by']=isset($_GET['by'])?$_GET['by']:false;
		$this->data['order']=isset($_GET['order'])?$_GET['order']:false;
		$this->data['from']=isset($_GET['from'])?$_GET['from']:false;
		$this->data['to']=isset($_GET['to'])?$_GET['to']:false;
		$this->data['page']=isset($_GET['page'])?$_GET['page']:1;

		$this->load->model('default/m_category');
		$this->load->model('default/m_product');
		$this->limit=8;
	}

	

	public function index()
	{
		$this->m_product->setLimit($this->limit);
		$this->data['categories'] = $this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0))->gets();
		if($this->data['from'])
		{
			$this->m_product->setWhere('price >=',$this->data['from']);
		}
		if($this->data['to']){
			$this->m_product->setWhere('price <=',$this->data['to']);
		}
		$this->data['total']=$this->m_product->getTotalProduct();
		$this->data['total_pages']=ceil($this->m_product->getTotalProduct()/$this->limit);
		$this->m_product->setPage($this->data['page']);
		if($this->data['by'])
		{
			$this->m_product->setOrderBy($this->data['order'],$this->data['by']);
		}

		$this->data['products']=$this->m_product->getProducts();
		$this->data['new_products']=$this->M_myweb->set_table('product')->sets(array('deleted'=>0,'new'=>1))->gets();
		foreach($this->data['new_products'] as $key => $item)
		{
			$category=$this->M_myweb->set_table('category')->sets(array('deleted'=>0,'active'=>1,'id'=>$item->category))->get();
			if($category)
			{
				if(!$this->M_myweb->set_table('category')->sets(array('deleted'=>0,'active'=>1,'id'=>$category->parent_1))->get()){
					unset($this->data['new_products'][$key]);
				}
			}

		}
		$this->data['title']	= "Sản Phẩm";
		$this->data['subview'] 	= 'default/category/V_category';
		$this->load->view('default/_main_page',$this->data);
	}
	public function sale()
	{
		$this->m_product->setLimit($this->limit);
		$this->data['categories'] = $this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0))->gets();
		if($this->data['from'])
		{
			$this->m_product->setWhere('price >=',$this->data['from']);
		}
		if($this->data['to']){
			$this->m_product->setWhere('price <=',$this->data['to']);
		}
		$this->m_product->setWhere('sale',1);
		$this->data['total']=$this->m_product->getTotalProduct();
		$this->data['total_pages']=ceil($this->m_product->getTotalProduct()/$this->limit);
		$this->m_product->setPage($this->data['page']);
		if($this->data['by'])
		{
			$this->m_product->setOrderBy($this->data['order'],$this->data['by']);
		}

		$this->data['products']=$this->m_product->getProducts();
		$this->data['new_products']=$this->M_myweb->set_table('product')->sets(array('deleted'=>0,'new'=>1))->gets();
		$this->data['title']	= "Sản Phẩm";
		$this->data['subview'] 	= 'default/category/V_category';
		$this->load->view('default/_main_page',$this->data);
	}
	public function categoryItem($category)
	{
		$this->data['cate']=$category;
		$this->m_product->setLimit($this->limit);
		$this->m_product->setPage($this->data['page']);
		if($this->data['by'])
		{
			$this->m_product->setOrderBy($this->data['order'],$this->data['by']);
		}

		$this->data['category'] = $this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'slug'=>$category))->get();
		if($this->data['category'])
		{
			if($this->data['from'])
			{
				$this->m_product->setWhere('price >=',$this->data['from']);
			}
			if($this->data['to']){
				$this->m_product->setWhere('price <=',$this->data['to']);
			}
			$this->m_product->setWhereIn('category',$this->data['category']->id);
			if($this->data['category']->level==1)
			{
				$this->data['parent_2']=false;
				$category_child=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'parent_2'=>$this->data['category']->id))->gets();
				$this->data['parent_1']=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'id'=>$this->data['category']->parent_1))->get();
				$this->data['sub_categories']=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'parent_1'=>$this->data['parent_1']->id))->gets();
				if(!empty($category_child)){
					foreach($category_child as $item)
					{
						$this->m_product->setWhereIn('category',$item->id);
					}
				}

			}else if($this->data['category']->level==0)
			{
				$category_child=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'parent_1'=>$this->data['category']->id))->gets();
				$this->data['category_parent']=$this->data['category'];
				if($category_child)
				{
					$this->data['sub_categories']=$category_child;
					foreach($category_child as $item)
					{
						$this->m_product->setWhereIn('category',$item->id);
					}
				}

			}else{
				$this->data['parent_1']=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'id'=>$this->data['category']->parent_1))->get();
				$this->data['parent_2']=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'id'=>$this->data['category']->parent_2))->get();
				$this->data['sub_categories']=$this->M_myweb->set_table('category')->sets(array('active'=>1,'deleted'=>0,'parent_1'=>$this->data['parent_1']->id))->gets();
			}
			$this->data['total']=$this->m_product->getTotalProduct();
			$this->data['total_pages']=ceil($this->m_product->getTotalProduct()/$this->limit);
			$this->data['products']=$this->m_product->getProducts();
			$this->data['new_products']=$this->M_myweb->set_table('product')->sets(array('deleted'=>0,'new'=>1))->gets();
			$this->data['title']	= "Sản Phẩm";
			$this->data['subview'] 	= 'default/category/V_category';
			$this->load->view('default/_main_page',$this->data);
		}else{
			redirect(site_url('/danh-muc'));
		}

	}
}