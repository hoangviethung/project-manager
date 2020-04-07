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
		$this->data['taskStatus'] = getTaskStatusList();
	}

	public function index()
	{
		if ($this->id) {
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
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function home()
	{
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/group/V_index';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function change_task_done()
	{
		$taskData['status'] = getTaskStatusId('Done');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
			return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	public function change_task_not_done()
	{
		$taskData['status'] = getTaskStatusId('Working On');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
			return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	public function confirm_task()
	{
		$taskData['status'] = getTaskStatusId('Confirmed');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
			return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	public function pick_up_task()
	{
		$taskData['assignee'] = $this->userInfo->id;
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
			return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	public function reopen_task()
	{
		$taskData['status'] = getTaskStatusId('Working On');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $taskId);
			return redirect(site_url('dashboard/task?id=' . $taskId . 'token=' . $this->userInfo->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}
	
	public function new_comment_save()
	{
		$commentData = $this->input->post();
		if($commentData)
		{
			$commentData['created_by'] = $this->userInfo->id;
			$commentData['created_at'] = getCurrentMySqlDate();
			$newCommentId = $this->default_model->set_table('task_comment')->sets($commentData)->setPrimary(false)->save();
			if($newCommentId)
			{
				$this->default_model->set_table('task')->sets(array('last_update'=>getCurrentMySqlDate()))->setPrimary($this->id)->save();
			}
			if (isset($_FILES['image']['tmp_name']) && $newCommentId) {
				$result = $this->save_comment_file($_FILES['image'],$newCommentId);
			}else{
				$result = false;
			}
			if($result)
			{
				$this->default_model->set_table('task')->sets(array('last_update'=>getCurrentMySqlDate()))->setPrimary($this->id)->save();
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công task số ' . $this->id);
				return redirect(site_url('dashboard/task?id=' . $this->id . 'token=' . $this->userInfo->token));
			}else{
				echo 'Có lỗi khi Save';
			}
		}
	}

	public function save_comment_file($imageFiles,$newCommentId)
	{
		$image = "";
		foreach ($imageFiles['tmp_name'] as $key => $item) {
			$_FILES['file']['name'] = $imageFiles['name'][$key];
			$_FILES['file']['type'] = $imageFiles['type'][$key];
			$_FILES['file']['tmp_name'] = $imageFiles['tmp_name'][$key];
			$_FILES['file']['error'] = $imageFiles['error'][$key];
			$_FILES['file']['size'] = $imageFiles['size'][$key];
			$image['file'] = do_upload('avatar', 'file');
			$image['comment_id'] = $newCommentId;
			$imageSaved[] = $this->M_myweb->set_table('task_comment_file')->sets($image)->setPrimary(false)->save();
		}
		if (count($imageSaved) == count($_FILES['image']['tmp_name'])) {
			return 1;
		}
		return 0;
	}
}
