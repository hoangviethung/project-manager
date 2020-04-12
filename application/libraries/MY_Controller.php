<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    public $data = array();
	public function __construct() {
		parent::__construct();
		$this->load->model('M_myweb','default_model');
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
		$this->systemDefault();
		$exception_uris = array('dashboard/logout','dashboard/login','index','','confirm_group_invite');
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if (check_logged_in() == FALSE) {
				redirect(site_url());
			}else{
				if($this->data['cslug'] != ''){
					$token = isset($_GET['token'])?$_GET['token']:"";
					if($token != $this->data['infoLog']->token) return redirect(site_url('dashboard/logout'));
				}
			}
		}
		if(isset($this->data['infoLog']->id))
		{
			$this->data['groups'] = $this->group->get_groups_by_user($this->data['infoLog']->id);
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
	public function send_email($emailData)
	{
		if($emailData && !empty($emailData))
		{
			$message = $emailData['content'];
			$subject = $emailData['subject'];
			$receiver = $emailData['receiver'];
			$config = Array(
				
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => '465',
				'smtp_user' => '', // change email account it to yours
				'smtp_pass' => '', // change password it to yours
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'newline' => "\r\n",
				'wordwrap' => TRUE
			);
			
			// load email library
			$this->load->library('email',$config);

			// prepare email
			$this->email
				->from('', '') // Params: $senderEmail, $senderName
				->to("$receiver")
				->subject($subject)
				->message($message)
				->set_mailtype('html');
				// ->set_newline("\r\n");

        // send email
			if (!$this->email->send())
			{	
				$result['error_message'] = $this->email->print_debugger();
				$result['date_time'] = getCurrentMySqlDate();
				$result['receiver'] = $receiver;
				$this->M_myweb->set_table('email')->sets($result)->setPrimary(0)->save();//Save email error to db
				return false;
			}else{
				return true;
			}
		}
	}
}