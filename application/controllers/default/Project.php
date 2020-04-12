<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('default/User_model', 'user');
		$this->id = isset($_GET['id'])?$_GET['id']:'';
		$this->id = $this->checkId($this->id);
	}

	public function index()
	{
		switch ($this->act) {
			case "project_detail":
				$this->project_detail();
				break;
			case "new_task_save":
				$this->new_task_save();
				break;
			case "add_member":
				$this->add_member();
				break;
			default:
				$this->home();
				break;
		}
	}

	public function home()
	{
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/project/V_project_detail';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function project_detail()
	{
		if ($this->id) {
			$this->data['project'] = $this->project->get_by_id($this->id);
			$this->data['projectUsers'] = $this->user->get_users_by_project($this->id);
			$this->data['possibleUsers'] = $this->get_project_possible_users($this->data['project'], $this->data['projectUsers']);

			$this->data['recentTasks'] = $this->task->get_tasks(array('project_id' => $this->id));
			$recentTasks = $this->data['recentTasks'];
			$taskAssignedToMe = array();
			$taskMonitoredByMe = array();
			if ($recentTasks) {
				foreach ($this->data['recentTasks'] as $task) {
					$workingOn = getTaskStatusId('Working On');
					if ($task->status == $workingOn && $task->assignee == $this->data['infoLog']->id) {
						$taskAssignedToMe[] = $task;
					}
					$done = getTaskStatusId('done');
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
			$this->data['subview'] = 'dashboard/project/V_project_detail';
			$this->load->view('dashboard/_main_page', $this->data);
		} else {
			redirect(site_url("dashboard"));
		}
	}

	public function new_group_view()
	{
	}

	public function new_task_save()
	{
		if ($this->id) {
			$newTaskData = $this->input->post();
			$result = array();
			if ($newTaskData && $newTaskData['name'] != '') {
				$newTaskData['project_id'] = $this->id;
				$newTaskData['assigner'] = $this->data['infoLog']->id;
				if (!$newTaskData['report_to']) {
					$newTaskData['report_to'] = $this->data['infoLog']->id;
				}
				if ($newTaskData['assignee']) {
					$newTaskData['status'] = 1;
				} else {
					$newTaskData['status'] = 0;
				}
				$newTaskData['last_update'] = getCurrentMySqlDate();
				$newTaskId = $this->default_model->set_table('task')->sets($newTaskData)->setPrimary(false)->save();
				if ($newTaskId) {
					$this->default_model->set_table('project')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
					$result = array(
						'code' => '200',
						'message' => 'Creating Task (' . $newTaskData['name'] . ') successfully',
						'link' => site_url('dashboard/task?act=task_detail&id=' . $newTaskId . '&token=' . $this->data['infoLog']->token)
					);
				} else {
					$result['message'] =  'Error creating task';
				}
			} else {
				$result['message'] =  'Please Input Required Field (*)';
			}
		} else {
			$result['message'] =  'Error creating task';
		}
		echo json_encode($result);
	}

	public function edit_project_view()
	{
		$this->data['projectData'] = $this->project->get_by_id($this->id);
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/project/V_edit_project';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function edit_project_save()
	{
		$projectData = $this->input->post();
		if ($projectData) {
			$projectData['last_update'] = getCurrentMySqlDate();
			$savedProjectId = $this->default_model->set_table('project')->sets($projectData)->setPrimary($this->id)->save();
			if ($savedProjectId) {
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Save thành công, ');
				return redirect(site_url('dashboard/group?id=' . $savedProjectId . 'token=' . $this->data['infoLog']->token));
			} else {
				echo 'Có lỗi khi Save';
			}
		} else {
			echo 'Vui lòng nhập các trường cần thiết (*)';
		}
	}

	public function edit_project_category_view()
	{
		$this->data['projectCategories'] = $this->project->get_project_category($this->id);
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/project/V_edit_category_project';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function edit_project_category_save()
	{
		$error = false;
		$projectCategoriesData = $this->input->post();
		if ($projectCategoriesData) {
			$this->project->delete_old_category();
			foreach ($projectCategoriesData as $category) {
				$data = array(
					'category'		=>	$category,
					'project_id'	=>	$this->id
				);
				$insertIdList = $this->default_model->set_table('task_category_group')->sets($data)->setPrimary(false)->save();
				if (!$insertIdList) {
					$error = true;
				}
			}
			if ($error) {
				echo 'Có lỗi khi Save';
			} else {
				return "Đã save list category";
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
			foreach ($this->data['projectUsers'] as $projectUser) {
				if ($groupUsers[$i]->id == $projectUser->id) {
					unset($possibleUsers[$i]);
				}
			}
		}
		$this->data['possibleUsers'] = $possibleUsers;
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/project/V_add_member';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function add_member()
	{
		if ($this->id) {
			$emailList = $this->input->post('email');
			if (!empty($emailList)) {
				$emailListArray = explode(',', $emailList);
				$notExistedEmail = '';
				$existedEmail = '';
				foreach ($emailListArray as $email) {
					if (trim($email) != '') {
						$userData = $this->user->get_user(array('email' => trim($email)));
						$check = $this->user->get_1_user_by_project($this->id, $userData->id);
						if ($check) {
							$existedEmail = $existedEmail . $email . '; ';
						} else {
							if (isset($userData) && $userData) {
								$newMemberData = array(
									'project_id'	=>	$this->id,
									'user_id'	=>	$userData->id,
									'is_lead'	=>	0,
									'date_added' =>	getCurrentMySqlDate()
								);
								$newMemberSave = $this->default_model->set_table('project_detail')->sets($newMemberData)->setPrimary(false)->save();
								$this->default_model->set_table('project')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
							} else {
								$notExistedEmail = $notExistedEmail . $email . '; ';
							}
							$result = array(
								'code' => '200',
								'message' => 'Add user successfully'
							);
						}
						if ($notExistedEmail != "") {
							$result['message'] = ' Email sau không tồn tại: ' . $notExistedEmail;
						}
						if ($existedEmail != "") {
							$result['message'] = ' Email sau đã có trong project: ' . $existedEmail;
						}
					}
				}
			} else {
				$result = array(
					'message' => 'Please Enter an Email'
				);
			}
		} else {
			$result['message'] =  'Error creating task';
		}
		echo json_encode($result);
	}

	protected function get_project_possible_users($projectData, $projectUsers)
	{
		$groupUsers = $this->user->get_users_by_group($projectData->group_id);
		$possibleUsers = $groupUsers;
		if ($projectUsers) {
			foreach ($possibleUsers as $key => $value) {
				foreach ($projectUsers as $projectUser) {
					if (isset($possibleUsers[$key]) && $possibleUsers[$key]->id == $projectUser->id) {
						unset($possibleUsers[$key]);
					}
				}
			}
			if (count($possibleUsers) > 0) {
				return $possibleUsers;
			}
		}
		return false;
	}
}
