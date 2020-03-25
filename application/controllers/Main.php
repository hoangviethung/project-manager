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
	
	public function registerView()
	{
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] 	= 'default/register/V_index';
		$this->load->view('default/_main_page',$this->data);
	}

	public function registerSave()
	{
		$registerData = $this->input->post();
		if($registerData)
		{
			$registerData['email'] = encodeEmail($registerData['email']);
			$registerData['password'] = hashPass($registerData['password']);
			$userId = $this->default_model->sets($registerData)->save();
			if($userId){
				$session = array(
					'id'			=>	$userId,
					'logged_in'		=>	true,
					'userName'		=>	$registerData['user_name'],
					'displayName'	=>	$registerData['display_name'],
					'email'			=>	$registerData['email'],
					'avatar'		=>	'no-avatar.png',
					'token'			=>	randomString(30)
				);
				$_SESSION['system'] = (object)$session;
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Đăng nhập thành công, '.$registerData['user_name']);
				return redirect(site_url('dashboard'));
			}else{
				$_SESSION['system_msg'] = messageDialog('div', 'error', 'Có lỗi khi tạo tài khoản');
				return redirect(site_url("register"));
			}
		}else{
			$_SESSION['system_msg'] = messageDialog('div', 'error', 'Vui lòng nhập các trường cần thiết (*)');
			return redirect(site_url("register"));
		}
	}
}
