<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->id = $this->input->get('id');
		$this->load->model('default/m_product');
	}
	function _remap($slug) {
        $this->index($slug);
    }
	public function index($slug)
	{
		// $this->m_product->setWhere("product.id",$this->id);
		$this->m_product->setWhere("product.slug",$slug);
		$this->data['product'] = $this->m_product->getProducts();
		// print_r($this->data['product']);
		if($this->data['product'])
		{
			$this->data['product_category']  = $this->M_myweb->set_table('category')->sets(array('id'=>$this->data['product']->category,'deleted'=>0))->get();
			if($this->data['product_category']->level==1)
			{
				$this->data['product_category_0']  = $this->M_myweb->set_table('category')->sets(array('id'=>$this->data['product_category']->parent_1,'deleted'=>0))->get();
			}else if($this->data['product_category']->level==2)
			{
				$this->data['product_category_0']  = $this->M_myweb->set_table('category')->sets(array('id'=>$this->data['product_category']->parent_1,'deleted'=>0))->get();
				$this->data['product_category_1']  = $this->M_myweb->set_table('category')->sets(array('id'=>$this->data['product_category']->parent_2,'deleted'=>0))->get();
			}
			$_SESSION['recent_products'][$this->data['product']->id]=$this->data['product'];
			$this->data["images"] = $this->M_myweb->set_table('product_image_detail')->sets(array('product_id'=>$this->data['product']->id,'deleted'=>0))->gets();
			$this->data['relate_products']  = $this->M_myweb->set_table('product')->sets(array('category'=>$this->data['product']->category,'deleted'=>0))->gets();
			$this->data['title']	= "Sản Phẩm";
			$this->data['subview'] 	= 'default/product/V_productDetail';
			$this->load->view('default/_main_page',$this->data);
		}else{
			$this->data['title']	= "Sản Phẩm";
			$this->data['subview'] 	= 'default/product/V_noProduct';
			$this->load->view('default/_main_page',$this->data);
		}
	}
}