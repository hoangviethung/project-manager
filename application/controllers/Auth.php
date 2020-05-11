<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('obisys');
		$this->load->model('M_myweb');
	}

	public function index()
	{
		if($this->input->post()){
			$this->login();
		}
		$this->load->view('cms/auth/home');
	}

	public function logout(){
		unset($_SESSION['system']);
		return redirect(site_url(""));
	}

	public function login(){
		$data = $this->input->post();
		if (!filter_var($data['email'] , FILTER_VALIDATE_EMAIL)) {
			$result = array(
				'message' => 'Please Input Email Format'
			);
			echo json_encode($result);
			return false;
		}
		$get = $this->M_myweb->set('email',$data['email'])->set('password',hashPass($data['password']))->set_table('user')->get();
		if(!$get)
		{
			$get = $this->M_myweb->set('email',$data['email'])->set('password',$data['password'])->set_table('user')->get();
		}
		
		if($get){
			if($get->is_active == 0)
			{
				$this->M_myweb->sets(array('is_active'=>1))->set_table('user')->setPrimary($get->id)->save();
			}
			$session = array(
				'id'			=> $get->id,
				'logged_in'		=>	true,
				'displayName'	=>	$get->display_name,
				'email'			=>	$get->email,
				'avatar'		=>	$get->avatar,
				'token'			=>	randomString(30)
			);
			$_SESSION['system'] = (object)$session;
			$result = array("code"=>"200","link"=>site_url('dashboard'));
			if($get->is_active == 0)
			{
				$result['link'] = site_url('dashboard/user');
			}
			if($get->is_admin == 1)
			{
				$result['link'] = site_url('admin');
			}
		}else{
			$result = array("message" => "Please check Email or Password");
		}
		echo json_encode($result);
	}
}