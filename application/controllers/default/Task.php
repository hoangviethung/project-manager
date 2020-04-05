<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->search = isset($_GET['search']) ? $_GET['search'] : FALSE;
		$this->load->model('default/Group_model', 'group');
		$this->load->model('default/Project_model', 'project');
		$this->load->model('default/Task_model', 'task');
		$this->data = array();
		$this->id = $this->checkId($_GET['id']);
		$this->project_id = $this->checkId($_GET['project_id']);
	}

	public function index()
	{
		switch ($this->act) {
			case "new_comment_save":
				$this->new_comment_save();
				break;
			case "change_task_done":
				$this->change_task_done();
				break;
			case "change_task_not_done":
				$this->change_task_not_done();
				break;
			case "confirm_task":
				$this->confirm_task();
				break;
			case "pick_up_task":
				$this->pick_up_task();
				break;
			default:
				$this->home();
				break;
		}
	}

	public function home()
	{
		if ($this->id) {
			$this->data['title']	= "Trang Chủ";
			$this->data['subview'] = 'dashboard/group/V_index';
			$this->load->view('dashboard/_main_page', $this->data);
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function new_group_view()
	{
	}


	public function change_task_done()
	{
		if ($this->id) {
			$taskData['status'] = 2;
			$taskData['last_update'] = getCurrentMySqlDate();
			$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
			if ($taskId) {
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
				return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
			} else {
				echo 'Có lỗi khi Save';
			}
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function change_task_not_done()
	{
		if ($this->id) {
			$taskData['status'] = 1;
			$taskData['last_update'] = getCurrentMySqlDate();
			$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
			if ($taskId) {
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
				return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
			} else {
				echo 'Có lỗi khi Save';
			}
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function confirm_task()
	{
		if ($this->id) {
			$taskData['status'] = 3;
			$taskData['last_update'] = getCurrentMySqlDate();
			$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
			if ($taskId) {
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
				return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
			} else {
				echo 'Có lỗi khi Save';
			}
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function pick_up_task()
	{
		if ($this->id) {
			$taskData['assignee'] = $this->userInfo->id;
			$taskData['last_update'] = getCurrentMySqlDate();
			$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
			if ($taskId) {
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
				return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
			} else {
				echo 'Có lỗi khi Save';
			}
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function new_comment_save()
	{
		if (isset($_FILES['image']['tmp_name'])) {
			$this->save_comment_file($_FILES['image']);
		}
	}

	public function save_comment_file($imageFiles)
	{
		$image = "";
	
			foreach ($imageFiles['tmp_name'] as $key => $item) {
				$_FILES['file']['name'] = $imageFiles['name'][$key];
				$_FILES['file']['type'] = $imageFiles['type'][$key];
				$_FILES['file']['tmp_name'] = $imageFiles['tmp_name'][$key];
				$_FILES['file']['error'] = $imageFiles['error'][$key];
				$_FILES['file']['size'] = $imageFiles['size'][$key];
				$image['image_file'] = do_upload('avatar', 'file');
				$image['product_id'] = $_GET['product_id'];
				$imageSaved[] = $this->M_myweb->set_table('product_image_detail')->sets($image)->save();
			}
			if(count($imageSaved) == count($_FILES['image']['tmp_name']))
			{
				return 1;
			}
		return 0;
	}
}
