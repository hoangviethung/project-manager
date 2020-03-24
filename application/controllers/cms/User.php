<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CMS_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->M_user = $this->M_myweb->set_table('user');
	}
	public function index()
	{
		switch ($this->act) {
			case "upd":
				if ($this->input->post())
					$this->save();
				$this->edit();
				break;
			case "uinfo":
				$this->ajax_userInfo();
				break;
			case "setpass":
				$this->setpass();
				break;
			case "lock":
				$this->locked();
				break;
			case 'profile':
				$this->profile();
				break;
			case "upro":
				$this->upro();
				break;
			case 'del':
				$this->delete();
				break;
			default:
				$this->home();
				break;
		}
	}
	private function home()
	{
		$this->data['user'] = $this->M_user->set('deleted', 0)->gets();
		$this->data['subview'] = 'cms/user/home';
		$this->load->view('cms/_main_page', $this->data);
	}
	private function edit()
	{
		//var_dump($this->id);
		if ($this->id) {
			//$this->data['obj'] = $this->M_myweb->set('id',$this->id)->set_table('user')->get();
			$this->data['obj'] = $this->M_user->set('id', $this->id)->get();
		}
		$this->data['subview'] = 'cms/user/edit';
		$this->load->view('cms/_main_page', $this->data);
	}
	private function save()
	{
		$data = $this->input->post();
		if ($this->id) {
			//unset($data['image'],$data['email']);
			//$this->M_myweb->sets($data)->setPrimary($this->id)->set_table('user')->save();
			$this->M_user->sets($data)->setPrimary($this->id)->save();
			$_SESSION['system_msg'] = messageDialog("div", "success", "Cập nhật tài khoản thành công");
		} else {
			$data['password'] = hashpass($data['cfpassword']);
			unset($data['cfpassword']);
			//$this->M_myweb->sets($data)->set_table('user')->save();
			//var_dump($data);
			$this->M_user->sets($data)->save();
			$_SESSION['system_msg'] = messageDialog("div", "success", "Thêm tài khoản thành công");
		}
		return redirect(site_url('admin/user'));
	}
	private function delete()
	{
		if ($this->id) {
			$getUser = $this->M_user->set('id', $this->id)->get();
			if ($getUser) {
				$this->M_user->sets(array('deleted' => 1))->setPrimary($this->id)->save();
				$_SESSION['system_msg'] = messageDialog("div", "success", "Xoá tài khoản thành công");
			} else {
				$_SESSION['system_msg'] = messageDialog("div", "error", "Xoá thất bại");
			}
		}
		return redirect(site_url('admin/user?token=' . $this->data['infoLog']->token));
	}
	private function ajax_userInfo()
	{
		//$user = $this->M_myweb->set('id',$this->id)->set_table('user')->get();
		$user = $this->M_user->set('id', $this->id)->get();
		echo json_encode(array('user' => $user));
		return;
	}
	private function setpass()
	{
		if ($this->id) {
			//$getUser = $this->M_myweb->set('id',$this->id)->set_table('user')->get();
			$getUser = $this->M_user->set('id', $this->id)->get();
			if ($getUser) {
				$_SESSION['system_msg'] = messageDialog("div", "success", "Cập nhật mật khẩu thành công");
				$password = hashpass($this->input->post('password'));
				//$this->M_myweb->sets(array('password'=>$password,'updated_info'=>json_encode($updated_info)),$this->id)->setPrimary($this->id)->set_table('user')->save();
				$this->M_user->sets(array('password' => $password), $this->id)->setPrimary($this->id)->save();
			} else {
				$_SESSION['system_msg'] = messageDialog("div", "error", "Không thể cập nhật mật khẩu");
			}
		}
		return redirect(site_url('admin/user?token=' . $this->data['infoLog']->token));
	}
	private function locked()
	{
		if ($this->token != $this->data['infoLog']->token) redirect(site_url('admin/logout'));
		if ($this->id) {
			$getUser = $this->M_user->set('id', $this->id)->get();
			if ($getUser) {
				$updated_info = array();
				$changeInfo = array(
					'date'	=>	date('Y-m-d H:i:s'),
					'userid' =>	$this->data['infoLog']->id,
				);
				if ($getUser->published == 0) {
					$changeInfo['content']	=	'Unlock user';
					if (!empty($getUser->updated_info)) {
						$updated_info = json_decode($getUser->updated_info);
					}
					array_push($updated_info, $changeInfo);
					$_SESSION['system_msg'] = messageDialog("div", "success", "Mở khoá tài khoản thành công");
					$update = array('published' => 1, 'updated_info' => json_encode($updated_info));
				}
				if ($getUser->published == 1) {
					$changeInfo['content']	=	'Lock user';
					if (!empty($getUser->updated_info)) {
						$updated_info = json_decode($getUser->updated_info);
					}
					array_push($updated_info, $changeInfo);
					$_SESSION['system_msg'] = messageDialog("div", "warning", "Khoá tài khoản thành công");
					$update = array('published' => 0, 'updated_info' => json_encode($updated_info));
				}
				$this->M_user->setPrimary($this->id)->save();
				return redirect(site_url('admin/user?token=' . $this->data['infoLog']->token));
			}
		}
	}
	private function profile()
	{
		if ($this->id) {
			$getUser = $this->M_user->set('id', $this->id)->get();
			if ($getUser) {
				$this->data['obj'] = $getUser;
				$this->data['subview'] = "cms/user/profile";
				return $this->load->view('cms/_main_page', $this->data);
			} else {
				$_SESSION['system_msg'] = messageDialog("div", "error", "Tài khoản không tồn tại");
				return redirect(site_url('admin/user'));
			}
		} else {
			$_SESSION['system_msg'] = messageDialog("div", "error", "Tài khoản không tồn tại");
			return redirect(site_url('admin/user?token=' . $this->data['infoLog']->token));
		}
	}
	private function upro()
	{
		$type = $this->input->post('typeUpd');
		switch ($type) {
			case "I":
				$this->InfoUpd();
				break;
			case "P":
				$this->PassUpd();
				break;
			case "A":
				$this->AvatarUpd();
				break;
			default:
				return redirect(site_url('admin/user?act=profile&id=' . $this->id . '&token=' . $this->data['infoLog']->token));
				break;
		}
	}
	private function InfoUpd()
	{
		$data = $this->input->post();
		unset($data['typeUpd']);
		$this->M_user->sets($data)->setPrimary($this->data['infoLog']->logid)->save();
		$_SESSION['system_msg'] = messageDialog("div", "success", "Update infomation success");
		return redirect(site_url('admin/user?act=profile&id=' . $this->id . '&token=' . $this->data['infoLog']->token));
	}
	private function PassUpd()
	{
		$oldpass = $this->input->post('oldpass');
		$newpass = $this->input->post('newpass');
		$getpass = trim($this->M_user->getUserInfo($this->data['infoLog']->id)->password);
		if ($getpass == hashpass($oldpass)) {
			$password = hashpass($newpass);
			$this->M_user->sets(array('password' => $password))->setPrimary($this->data['infoLog']->logid)->save();
			echo json_encode(array("msg" => messageDialog("div", "success", "Thay đổi mật khẩu thành công"), "rs" => 1));
		} else {
			echo json_encode(array("msg" => "<span class='text-danger'>Mật khẩu không chính xác</span>", "rs" => 0));
		}
		return;
	}
}
