<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
		$this->data = array();
	}
	public function index()
	{
		$this->data['title']	= "Trang Chủ";
		$this->load->view('default/index/V_index');
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
			$userId = $this->default_model->set_table('user')->sets($registerData)->save();
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

	public function confirm_group_invite()
	{
		$data = $this->input->get();
		$confirmData = $this->default_model->set('user_id',$data['uid'])->set('token',$data['token'])->set_table('group_detail')->get();
		if($confirmData)
		{
			$newMemberData = array(
				'date_confirmed' =>	getCurrentMySqlDate(),
				'is_confirmed'	=>	1
			);
			$confirmed = $this->default_model->set_table('group_detail')->sets($newMemberData)->setPrimary($confirmData->id)->save();
			if($confirmed)
			{
				$this->data['title']	= "Trang Chủ";
				$this->load->view('default/index/V_group_confirm');
			}
		}
	}
}
