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
		$get = $this->M_myweb->set('email',$data['email'])->set('password',$data['password'])->set_table('user')->get();
		if($get){
			$session = array(
				'id'			=> $get->id,
				'logged_in'		=>	true,
				'userName'		=>	$get->user_name,
				'displayName'	=>	$get->display_name,
				'email'			=>	$get->email,
				'avatar'		=>	$get->avatar,
				'token'			=>	randomString(30)
			);
			$_SESSION['system'] = (object)$session;
			echo "200";
		}else{
			echo "Sai Email Hoặc Password";
		}
	}
}