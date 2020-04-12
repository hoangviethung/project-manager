<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->search = isset($_GET['search']) ? $_GET['search'] : FALSE;
		$this->load->model('default/User_model', 'user');
		$this->load->model('default/Task_comment_model', 'task_comment');
		$this->id = isset($_GET['id']) ? $_GET['id'] : '';
		$this->id = $this->checkId($this->id);
		$this->data['taskStatus'] = getTaskStatusList();
	}

	public function index()
	{
		switch ($this->act) {
			case "task_detail":
				$this->task_detail();
				break;
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
				case "reopen_task":
					$this->reopen_task();
					break;
			default:
				$this->home();
				break;
		}
	}

	protected function home()
	{
		$this->data['recentTasks'] = $this->task->get_recent_tasks_by_user($this->data['infoLog']->id);
		$recentTasks = $this->data['recentTasks'];
		$taskAssignedToMe = array();
		$taskMonitoredByMe = array();
		if ($recentTasks) {
			foreach ($this->data['recentTasks'] as $task) {
				if ($task->status == getTaskStatusId('Working On') && $task->assignee == $this->data['infoLog']->id) {
					$taskAssignedToMe[] = $task;
				}
				if ($task->status == getTaskStatusId('Done') && $task->report_to == $this->data['infoLog']->id) {
					$taskAssignedToMe[] = $task;
				}
				if ($task->assigner == $this->data['infoLog']->id) {
					$taskMonitoredByMe[] = $task;
				}
			}
		} else {
			$taskMonitoredByMe = false;
			$taskAssignedToMe = false;
		}

		$this->data['taskAssignedToMe'] = $taskAssignedToMe;
		$this->data['taskMonitoredByMe'] = $taskMonitoredByMe;
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/task/V_my_tasks';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	protected function task_detail(){
		if($this->id)
		{
			$this->data['task'] = $this->task->get_by_id($this->id);
			$this->data['assigner'] = $this->user->get_by_id($this->data['task']->assigner);
			$this->data['assignee'] = $this->user->get_by_id($this->data['task']->assignee);
			$this->data['report_to'] = $this->user->get_by_id($this->data['task']->report_to);
			$this->data['task_comments'] = $this->task_comment->get_by_task($this->id);
			$this->data['title']	= "Trang Chủ";
			$this->data['subview'] = 'dashboard/task/V_task_detail';
			$this->load->view('dashboard/_main_page', $this->data);
		} else {
			redirect(site_url("dashboard"));
		}
	}

	protected function change_task_done()
	{
		$taskData['status'] = getTaskStatusId('Done');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Saved task id#: ' . $taskId);
			return redirect(site_url('dashboard/task?act=task_detail&id=' . $taskId . '&token=' . $this->data['infoLog']->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	protected function change_task_not_done()
	{
		$taskData['status'] = getTaskStatusId('Working On');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Saved task id#: ' . $taskId);
			return redirect(site_url('dashboard/task?act=task_detail&id=' . $taskId . '&token=' . $this->data['infoLog']->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	protected function confirm_task()
	{
		$taskData['status'] = getTaskStatusId('Confirmed');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Saved task id#: ' . $taskId);
			return redirect(site_url('dashboard/task?act=task_detail&id=' . $taskId . '&token=' . $this->data['infoLog']->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	protected function pick_up_task()
	{
		if($_GET['task'] == 'new'){
			$taskData['status'] = 1;
		}
		$taskData['assignee'] = $this->data['infoLog']->id;
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Saved task id#: ' . $taskId);
			return redirect(site_url('dashboard/task?act=task_detail&id=' . $taskId . '&token=' . $this->data['infoLog']->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	protected function reopen_task()
	{
		$taskData['status'] = getTaskStatusId('Working On');
		$taskData['last_update'] = getCurrentMySqlDate();
		$taskId = $this->default_model->set_table('task')->sets($taskData)->setPrimary($this->id)->save();
		if ($taskId) {
			$_SESSION['system_msg'] = messageDialog('div', 'success', 'Saved task id#: ' . $taskId);
			return redirect(site_url('dashboard/task?act=task_detail&id=' . $taskId . '&token=' . $this->data['infoLog']->token));
		} else {
			echo 'Có lỗi khi Save';
		}
	}

	protected function new_comment_save()
	{
		$commentData = $this->input->post();
		if ($commentData) {
			$commentData['created_by'] = $this->data['infoLog']->id;
			$commentData['created_at'] = getCurrentMySqlDate();
			$newCommentId = $this->default_model->set_table('task_comment')->sets($commentData)->setPrimary(false)->save();
			if ($newCommentId) {
				$this->default_model->set_table('task')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
			}
			if (isset($_FILES['image']['tmp_name']) && $newCommentId) {
				$result = $this->save_comment_file($_FILES['image'], $newCommentId);
			} else {
				$result = false;
			}
			if ($result) {
				$this->default_model->set_table('task')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Saved task id#: ' . $this->id);
				return redirect(site_url('dashboard/task?act=task_detail&id=' . $this->id . '&token=' . $this->data['infoLog']->token));
			} else {
				echo 'Có lỗi khi Save';
			}
		}
	}

	protected function save_comment_file($imageFiles, $newCommentId)
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
