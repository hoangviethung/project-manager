<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyInfo extends CMS_Controller {

	public function __construct(){
		parent::__construct();
		$this->Model = $this->M_myweb->set_table('company_info');
	}
	
	public function index()
	{
		
		switch($this->act){
			case "upd":
				if($this->input->post())
					$this->save();
				$this->edit();
				break;
			default:
				$this->home();
				break;
		}
	}

	private function home(){
		$this->data['infos'] = $this->Model->gets();
		$this->data['subview'] = 'cms/company_info/home';
		$this->load->view('cms/_main_page',$this->data);
	  }
	  
  	private function edit(){
		$this->data['infos'] = $this->Model->gets();
		$this->data['subview'] = 'cms/company_info/edit';
		$this->load->view('cms/_main_page',$this->data);
	}

  	private function save(){
		$data = $this->input->post();
		$this->Model->set('address',$data['address'])->setPrimary(1)->save();
		$this->Model->set('phone',$data['phone'])->setPrimary(2)->save();
		$this->Model->set('facebook',$data['facebook'])->setPrimary(3)->save();
		$_SESSION['system_msg'] = messageDialog("div","success","Cập nhật thành công");
		return redirect(site_url('admin/companyinfo'));
	}
}