<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->search = isset($_GET['search']) ? $_GET['search'] : FALSE;
		$this->load->model('default/Group_model', 'group');
		$this->load->model('default/Project_model', 'project');
		$this->load->model('default/Task_model', 'task');
		$this->load->model('default/User_model', 'user');
		$this->data = array();
	}
	public function index()
	{
		$this->data['title']	= "Trang Chủ";
		$this->load->view('default/index/V_index');
	}

	public function registerSave()
	{
		$memberEmail = $this->input->post('email');
		if (!filter_var($memberEmail , FILTER_VALIDATE_EMAIL)) {
			$result = array(
				'message' => 'Please Input Email Format'
			);
			echo json_encode($result);
			return false;
		}
		if ($memberEmail) {
			$get = $this->default_model->set_table('user')->sets(array('email' => $memberEmail))->get();
			if (!$get) {
					$password = randomString(10);
					$newMember = array(
						'email' 		=> 	$memberEmail,
						'password'		=>	hashPass($password),
						'display_name'  => 	$memberEmail,
						'is_active'		=>	0,
						'avatar'		=>	'no-avatar.png'
					);
					$newMemberSave = $this->default_model->set_table('user')->sets($newMember)->setPrimary(false)->save();
					if ($newMemberSave) {
						$emailData = array();
						$emailData['receiver'] = $memberEmail;
						$emailData['subject'] = 'Gazeboo New Member';
						$emailData['content'] = 'Welcome to GAZEBOO<br>This is your password:<br><b>'.$password.'</b><br> please use registered email and this password to log in and change your information in the dashboard.';
						$this->send_email($emailData);
					}
					$result = array(
						'message' => 'Invitational Email Sent'
					);
			} else {
				$result = array(
					'message' => 'Member Invited. If forget password, please click forgot password to recover account.'
				);
			}
		} else {
			$result = array(
				'message' => 'Please enter an email'
			);
		}
		echo json_encode($result);
	}

	public function forgetPassword(){
		$memberEmail = $this->input->post('email');
		if (!filter_var($memberEmail , FILTER_VALIDATE_EMAIL)) {
			$result = array(
				'message' => 'Please Input Email Format'
			);
			echo json_encode($result);
			return false;
		}
		if ($memberEmail) {
			$get = $this->user->get_user(array('email' => $memberEmail));
			if ($get) {
					$password = randomString(10);
					$newMemberSave = $this->default_model->set_table('user')->sets(array('password'=>hashPass($password)))->setPrimary($get->id)->save();
					if ($newMemberSave) {
						$emailData = array();
						$emailData['receiver'] = $memberEmail;
						$emailData['subject'] = 'Gazeboo Password';
						$emailData['content'] = 'Your account has been recovered<br>This is your new password:<br><b>'.$password.'</b>';
						$this->send_email($emailData);
					}
					$result = array(
						'message' => 'Email Sent'
					);
			} else {
				$result = array(
					'message' => 'Member not existed.'
				);
			}
		} else {
			$result = array(
				'message' => 'Please enter an email'
			);
		}
		echo json_encode($result);
	}

	public function confirm_group_invite()
	{
		$data = $this->input->get();
		$confirmData = $this->default_model->set('user_id', $data['uid'])->set('token', $data['token'])->set_table('group_detail')->get();
		if ($confirmData) {
			$newMemberData = array(
				'date_confirmed' =>	getCurrentMySqlDate(),
				'is_confirmed'	=>	1
			);
			$confirmed = $this->default_model->set_table('group_detail')->sets($newMemberData)->setPrimary($confirmData->id)->save();
			if ($confirmed) {
				$this->data['title']	= "Trang Chủ";
				$this->load->view('dashboard/index/V_group_confirm');
			}
		}
	}
}
