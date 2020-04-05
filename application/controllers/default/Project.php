<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends MY_Controller
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
		$this->id = $this->checkId($_GET['id']);
		$this->group_id = $this->checkId($_GET['group_id']);
		$this->data['project_users'] = $this->user->get_users_by_project($this->id);
	}

	public function index()
	{
		if ($this->id) {
			switch ($this->act) {
				case "new_task_save":
					$this->new_task_save();
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

	public function new_group_view()
	{
	}

	public function new_task_save()
	{
		$newTaskData = $this->input->post();
		if ($newTaskData) {
			$newTaskData['project_id'] = $this->id;
			$newTaskData['assigner'] = $this->userInfo->id;
			if (!$newTaskData['report_to']) {
				$newTaskData['report_to'] = $this->userInfo->id;
			}
			if ($newTaskData['assignee']) {
				$newTaskData['status'] = 1;
			} else {
				$newTaskData['status'] = 0;
			}
			$newTaskData['last_update'] = getCurrentMySqlDate();
			$newTaskId = $this->default_model->set_table('task')->sets($newTaskData)->save();
			if ($newTaskId) {
				$this->default_model->set_table('project')->sets(array('last_update'=>getCurrentMySqlDate()))->setPrimary($this->id)->save();
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Tạo thành công, ' . $newTaskData['user_name']);
				return redirect(site_url('dashboard/task?id=' . $newTaskId . 'token=' . $this->userInfo->token));
			} else {
				echo 'Có lỗi khi tạo nhóm';
			}
		} else {
			echo 'Vui lòng nhập các trường cần thiết (*)';
		}
	}

	public function add_member_view()
	{

		$currentProject = $this->project->get_by_id($this->id);
		$groupUsers = $this->user->get_users_by_group($currentProject->group_id);
		$possibleUsers = $groupUsers;
		for ($i = 0; $i < count($possibleUsers); $i++) {
			foreach ($this->data['project_users'] as $projectUser) {
				if ($groupUsers[$i]->id == $projectUser->id) {
					unset($possibleUsers[$i]);
				}
			}
		}
		$this->data['possible_users'] = $possibleUsers;
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/project/V_add_member';
		$this->load->view('dashboard/_main_page', $this->data);
	}
	
	public function add_member()
	{
		$memberId = $this->input->post('member_id');
		if ($memberId) {
			foreach ($memberId as $id) {
				$newMemberData = array(
					'project_id'	=>	$this->id,
					'user_id'	=>	$id,
					'is_lead'	=>	0,
					'date_added' =>	getCurrentMySqlDate()
				);
				$newMemberSave = $this->default_model->set_table('project_detail')->sets($newMemberData)->save();
			}
			$this->default_model->set_table('project')->sets(array('last_update'=>getCurrentMySqlDate()))->setPrimary($this->id)->save();
		}
		redirect(site_url("dashboard/project?id=" . $this->id . "&token=" . $this->userInfo->token));
	}
}
