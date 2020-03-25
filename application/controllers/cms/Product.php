<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CMS_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['product'] = false;
		$this->data['cates'] = $this->M_myweb->set_table('category')->set('deleted',0)->gets();
		$this->Model = $this->M_myweb->set_table('product');
		$this->load->model('cms/m_product');
		$this->load->library('pagination');
	}
	public function index()
	{
		switch($this->act){
			case "upd":
				if($this->input->post())
					$this->save();
				$this->edit();
				break;
			case "hot":
				$this->hot();
				break;
			case "show_img":
				$this->show_img();
				break;
			case "save_img":
				$this->save_img();
				break;
			case "delete_img":
				$this->delete_img();
				break;
			case "unhot":
				$this->unHot();
				break;
			case "lock":
				$this->lock();
				break;
			case "unlock":
				$this->unLock();
				break;
			case "status-upd":
				$this->status_update();
				break;
			case "del":
				$this->delete();
				break;
			default:
				$this->home();
				break;
		}
	}
	private function home(){
		// $this->data["results"]="";
		// // init params
		// $this->_limit = 1;
        // $start= (isset($_GET['paging'])) ? $_GET['paging'] : 0;
		// $this->_total = $this->m_product->get_total(); 
        // if ($this->_total > 0) 
        // {            
		// 	$this->data["product"] = $this->m_product->get_current_page_records($this->_limit, $start);
        //     $config['base_url'] = site_url('admin/product');
        //     $this->data["links"] = $this->createLinks($start);
		// }
		$this->data["product"] = $this->m_product->get_current_page_records();
		$this->data['subview'] = 'cms/product/home';
		$this->load->view('cms/_main_page',$this->data);
	}
	private function show_img(){
		if(isset($_GET['id'])){
			$this->data['id'] = $_GET['id'];
			$this->data['obj'] = $this->Model->set('id',$this->data['id'])->get();
			$this->data["images"] = $this->M_myweb->set_table('product_image_detail')->sets(array('product_id'=>$this->data['id'],'deleted'=>0))->gets();
		}
		$this->data['subview'] = 'cms/product/show_img';
		$this->load->view('cms/_main_page',$this->data);
	}
	private function createLinks($start) {
		$page_curent = ceil( $start / $this->_limit )+1;
		$page = $this->_total/$this->_limit;
		$last = ceil( $this->_total / $this->_limit );	
		$html = '<ul>';
		if($page_curent < $page-1){
			$html .= '<li style="list-style:none; float:left"><a class="btn btn-info" style="text-decoration: none;" href="'.site_url('admin/product?paging='.($page_curent)*$this->_limit).'">Sau</a></li>'; 
		}
		for($i=1; $i<$page; $i++){
			if($page_curent == $i){
				$html .= '<li class="btn" style="color:red;list-style:none; float:left; font-weight: bold;">'.$i.'</li>'; 
			}else{
				$html .= '<li style="list-style:none; float:left"><a class="btn" style="text-decoration: none; font-weight: bold;" href="'.site_url('admin/product?paging='.($i-1)*$this->_limit).'">'.$i.'</a></li>'; 
			}
		}
		if($page_curent != 1){
			$html .= '<li style="list-style:none; float:left"><a class="btn btn-info" style="text-decoration: none;" href="'.site_url('admin/product?paging='.($page_curent-2)*$this->_limit).'">Trước</a></li>'; 
		}
		$html .= '</ul>'; 
		return $html;
	}
	private function edit(){
		if(isset($_GET['id'])){
			$this->data['id'] = $_GET['id'];
			$this->data['obj'] = $this->Model->set('id',$this->data['id'])->get();
			$this->data['obj']->image_01 = "";
			$this->data['obj']->image_02 = "";
			$this->data['obj']->image_03 = "";
			$this->data['obj']->image_04 = "";
			$this->data['obj']->image_05 = "";
		}
		$this->data['subview'] = 'cms/product/edit';
		$this->load->view('cms/_main_page',$this->data);
	}
	private function hot(){
		if(isset($_GET['id'])){
			$this->data['id'] = $_GET['id'];
			$data['hot'] = 1;
			$this->Model->sets($data)->setPrimary($this->id)->save();
		}
		$this->data['subview'] = 'cms/product/home';
		return redirect(site_url('admin/product'));
	}
	private function unHot(){
		if(isset($_GET['id'])){
			$this->data['id'] = $_GET['id'];
			$data['hot'] = 0;
			$this->Model->sets($data)->setPrimary($this->id)->save();
		}
		$this->data['subview'] = 'cms/product/home';
		return redirect(site_url('admin/product'));
	}
	private function lock(){
		if(isset($_GET['id'])){
			$this->data['id'] = $_GET['id'];
			$data['active'] = 1;
			$this->Model->sets($data)->setPrimary($this->id)->save();
		}
		$this->data['subview'] = 'cms/product/home';
		return redirect(site_url('admin/product'));
	}
	private function unLock(){
		if(isset($_GET['id'])){
			$this->data['id'] = $_GET['id'];
			$data['active'] = 0;
			$this->Model->sets($data)->setPrimary($this->id)->save();
		}
		$this->data['subview'] = 'cms/product/home';
		return redirect(site_url('admin/product'));
	}
	private function status_update()
	{
		if (isset($_GET['id'])) {
			if(isset($_GET['new']))
			{
				$data['new'] = $_GET['new'];
			}else if(isset($_GET['sale'])){
				$data['sale'] = $_GET['sale'];
			}else if(isset($_GET['remained']))
			{
				$data['remained'] = $_GET['remained'];
			}
			$this->M_myweb->set_table('product')->sets($data)->setPrimary($_GET['id'])->save();
		}
		redirect(site_url('admin/product'));
	}
	private function save(){
		$data = $this->input->post();
		$image_01 = "";
		if($_FILES['image_01']['name']!=""){
			$image_01 = do_upload('avatar','image_01');	
			$data['img1'] = $image_01;				
		}
		if($this->id){
			$data['slug'] = str_replace(" ", "_", stripUnicode($data['name']));
			$this->Model->sets($data)->setPrimary($this->id)->save();
			if(isset($data['img1'] ))
			{
				$this->M_myweb->set_table('product_image_detail')->sets(array('main'=>0))->primary_key('product_id')->setPrimary($this->id)->save();
				$this->M_myweb->set_table('product_image_detail')->sets(array('product_id'=>$this->id,'image_file'=>$data['img1'],'main'=>1))->primary_key('id')->setPrimary(false)->save();
			}
			$_SESSION['system_msg'] = messageDialog("div","success","Cập nhật sản phẩm thành công");
		}else{
			$data['slug'] = str_replace(" ", "_", stripUnicode($data['name']));
			$id=$this->Model->sets($data)->save();
			if(isset($data['img1'] ))
			{
				$this->M_myweb->set_table('product_image_detail')->sets(array('product_id'=>$id,'image_file'=>$data['img1']))->setPrimary(false)->save();
			}
			$_SESSION['system_msg'] = messageDialog("div","success","Thêm sản phẩm thành công");
		}
		return redirect(site_url('admin/product'));
	}
	private function save_img(){
		$image = "";
		if(isset($_FILES['image']['tmp_name'])){
			foreach($_FILES['image']['tmp_name'] as $key=>$item)
			{
				$_FILES['file']['name']= $_FILES['image']['name'][$key];
				$_FILES['file']['type']= $_FILES['image']['type'][$key];
				$_FILES['file']['tmp_name']= $_FILES['image']['tmp_name'][$key];
				$_FILES['file']['error']= $_FILES['image']['error'][$key];
				$_FILES['file']['size']= $_FILES['image']['size'][$key];
				$image['image_file'] = do_upload('avatar','file');
				$image['product_id'] = $_GET['product_id'];
				$this->M_myweb->set_table('product_image_detail')->sets($image)->save();
			}
		}
		return redirect(site_url('admin/product'));
	}
	private function delete_img()
	{
		if (isset($_GET['id'])) {
			if(isset($_GET['deleted']))
			{
				$data['deleted'] = $_GET['deleted'];
			}
			$this->M_myweb->set_table('product_image_detail')->sets($data)->setPrimary($_GET['id'])->save();
			$_SESSION['system_msg'] = messageDialog("div","success","Xoá hình ảnh thành công");
		}
		redirect(site_url('admin/product?act=show_img&id=' . $_GET['product_id'] . "&token=" . $this->data['infoLog']->token));
	}
	private function delete(){
		if($this->id){
			$getPro = $this->Model->set('id',$this->id)->get();
			if($getPro){
				$this->Model->sets(array('deleted'=>1))->setPrimary($this->id)->save();
				$_SESSION['system_msg'] = messageDialog("div","success","Xoá sản phẩm thành công");
			}else{
				$_SESSION['system_msg'] = messageDialog("div","error","Không thể xoá sản phẩm");
			}
		}
		redirect(site_url('admin/product'));
	}
}