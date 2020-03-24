<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CMS_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$this->home();
	}

	private function home(){
		$this->data['subview'] = 'cms/dashboard/home';
		$this->load->view('cms/_main_page',$this->data);
	}
}