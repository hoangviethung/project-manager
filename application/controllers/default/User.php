<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->search = isset($_GET['search']) ? $_GET['search'] : FALSE;
		$this->load->model('default/User_model', 'user');
	}

	public function index()
	{
		switch ($this->act) {
			default:
				$this->home();
				break;
		}
	}

	public function home()
	{
		$this->data['title']	= "My Info";
		$this->data['subview'] = 'dashboard/user/V_user_edit';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function edit_user_save()
	{
		$userData = $this->input->post();
		if ($userData) {
			if(isset($_FILES['image']) && $_FILES['image']['name']!="" ){
				$image = do_upload('avatar','image');	
				$userData['avatar'] = $image;
			}else{
				$userData['avatar'] = $this->data['infoLog']->avatar;
			}
			$this->default_model->set_table('user')->sets($userData)->setPrimary($this->data['infoLog']->id)->save();
			$session = array(
				'id'			=> $this->data['infoLog']->id,
				'logged_in'		=>	true,
				'userName'		=>	$userData['user_name'],
				'displayName'	=>	$userData['display_name'],
				'email'			=>	$userData['email'],
				'avatar'		=>	$userData['avatar'],
				'token'			=>	$this->data['infoLog']->token
			);
			$_SESSION['system'] = (object)$session;
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Info Saved');
			return redirect(site_url('dashboard/user'));
		} else {
			$_SESSION['system_msg'] = messageDialog('div', 'error', 'Error Saving');
		}
		$_SESSION['system_msg'] = messageDialog('div', 'error', 'Error Saving');
	}
}
