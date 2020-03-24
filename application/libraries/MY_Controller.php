<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    public $data = array();
	public function __construct() {
		parent::__construct();
		$this->load->helper('obisys');
        $this->load->model('M_myweb');
		$this->load->model('default/M_nguyenquan',"m_nguyenquan");
		$this->systemDefault();
		$exception_uris = array('dashboard/logout','dashboard/login','index','');
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if (check_logged_in() == FALSE) {
				redirect('dashboard/login');
			}else{
				if($this->data['cslug'] != ''){
					$token = isset($_GET['token'])?$_GET['token']:"";
					if($token != $this->data['infoLog']->token) return redirect(site_url('dashboard/logout'));
				}
			}
		}
	}
	private function systemDefault(){
		$this->act = isset($_GET['act'])?$_GET['act']:'';
		$this->controller = $this->uri->segment(2);
		$id = isset($_GET['id'])?$_GET['id']:0;
		$this->id = $this->checkId($id);
		$sys = new stdClass();
		$sys->token = '';
		$sys->avatar='';
		$_SESSION['system'] = isset($_SESSION['system'])?$_SESSION['system']:$sys;
		$this->data['infoLog'] = $_SESSION['system'];
		$this->data['systemName'] = $this->config->item('site_name');
		$this->data['copyRight'] = $this->config->item('copyright_dev');
		$this->data['avatar'] = $this->data['infoLog']->avatar==''?base_url('assets/public/avatar/no-avatar.png'):$this->data['infoLog']->avatar;
		$this->data['cslug'] = $this->act;
		$this->data['obj'] = false;
	}
	protected function checkId($id){
		if(empty($id) || $id == false || $id == 0 || $id==""){
			return false;
		}
		return (int) $id;
	}
}