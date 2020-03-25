<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/group_model');
		$this->data = array();
	}
	public function index()
	{
		$this->data['title']	= "Trang Chủ";
		$this->load->view('default/index/V_index');
	}

	public function dashBoard()
	{
		// $this->data['projects'] = $this->M_myweb->set_table('project')->sets(array('is_active'=>1))->set_orderby('created_at','desc')->gets();
		// $this->data['new_products']=$this->M_myweb->set_table('product')->sets(array('deleted'=>0,'new'=>1))->gets();
		// if($this->data['new_products'])
		// {
		// 	foreach($this->data['new_products'] as $key => $item)
		// 	{
		// 		$category=$this->M_myweb->set_table('category')->sets(array('deleted'=>0,'active'=>1,'id'=>$item->category))->get();
		// 		if(!$category){
		// 			unset($this->data['new_products'][$key]);
		// 		}
		// 		else if(!$this->M_myweb->set_table('category')->sets(array('deleted'=>0,'active'=>1,'id'=>$category->parent_1))->get()){
		// 			unset($this->data['new_products'][$key]);
		// 		}
		// 	}
		// }
		$this->data['projects'] = $this->M_myweb->set_table('project')->sets(array('is_active'=>1))->set_orderby('created_at','desc')->gets();
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] 	= 'default/index/V_index';
		$this->load->view('default/_main_page',$this->data);
	}
	public function search()
	{
		if($this->search)
		{
			$search=explode(" ",$this->search);
			if(count($search)<2){
				$this->data['title']="Tìm Kiếm";
				$this->data['error']="Vui lòng nhập nhiều hơn 1 từ";
				$this->data['subview'] 	= 'default/search/V_search';
				$this->load->view('default/_main_page',$this->data);
			}
			else{
				$this->data['title']="Tìm Kiếm";
				$this->data['search']=$this->m_nguyenquan->getSearchData($this->search);
				$this->data['subview'] 	= 'default/search/V_search';
				$this->load->view('default/_main_page',$this->data);
			}

		}
		else
		{
			redirect(site_url());
		}
	}

	
}
