<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('default/User_model', 'user');
		$this->id = isset($_GET['id']) ? $_GET['id'] : '';
		$this->id = $this->checkId($this->id);
		if ($this->id) {
			$this->data['project'] = $this->project->get_by_id($this->id);
			$this->data['group'] = $this->group->get_by_id($this->data['project']->group_id);
		}
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
				case "delete_member":
					$this->delete_member();
					break;
			case "edit_save":
				$this->edit_save();
				break;
			default:
				$this->home();
				break;
		}
	}

	public function home()
	{
		$this->data['title']	= "My Projects";
		$this->data['subview'] = 'dashboard/project/V_project_detail';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function project_detail()
	{
		if ($this->id) {
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

	public function edit_save()
	{
		$projectData = $this->input->post();
		if ($projectData) {
			$projectData['last_update'] = getCurrentMySqlDate();
			$this->default_model->set_table('project')->sets($projectData)->setPrimary($this->id)->save();
			$project = $this->project->get_by_id($this->id);
			$this->default_model->set_table('group')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($project->group_id)->save();
			$result = array(
				"link" => site_url('dashboard/project?act=project_detail&id=' . $this->id . '&token=' . $this->data['infoLog']->token),
				'code' => 200
			);
		} else {
			$result = array("message" => "Error Saving");
		}
		echo json_encode($result);
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
			echo 'Input required field(*)';
		}
	}

	protected function delete_member()
	{
		if (!$this->id) {
			$result['message'] =  'Error Occured';
			echo json_encode($result);
			return false;
		}
		$result = array();
		$result['message'] = '';
		$projectDetailId = $this->input->post('project_detail_id');
		$memberId = $this->input->post('member_id');
		$check = $this->default_model->set_table('project_detail')->sets(array('is_active'=>0))->setPrimary($projectDetailId)->save();
		$taskAssignedTo = $this->default_model->set_table('task')->sets(array('project_id'=>$this->id,'assignee'=>$memberId,'is_active'=>1))->setPrimary(false)->gets();
		$taskReportTo = $this->default_model->set_table('task')->sets(array('project_id'=>$this->id,'report_to'=>$memberId,'is_active'=>1))->setPrimary(false)->gets();
		$taskAssign = $this->default_model->set_table('task')->sets(array('project_id'=>$this->id,'assigner'=>$memberId,'is_active'=>1))->setPrimary(false)->gets();
		if($taskAssignedTo){
			foreach($taskAssignedTo as $a){
				$this->default_model->set_table('task')->sets(array('assignee'=>0))->setPrimary($a->id)->save();
			}
		}
		if($taskReportTo){
			foreach($taskReportTo as $b){
				$this->default_model->set_table('task')->sets(array('report_to'=>$this->data['project']->leader))->setPrimary($b->id)->save();
			}
		}
		if($taskAssign){
			foreach($taskAssign as $c){
				$this->default_model->set_table('task')->sets(array('assigner'=>$this->data['project']->leader))->setPrimary($c->id)->save();
			}
		}
		if($projectDetailId == $check)
		{
			$result = array(
				"link" => site_url('dashboard/project?act=project_detail&id=' . $this->id . '&token=' . $this->data['infoLog']->token),
				'code' => 200
			);
			$result['message'] =  'Delete Member Successfully';
			echo json_encode($result);
			return false;
		}else{
			$result['message'] =  "There's something wrong, please check again";
			echo json_encode($result);
			return false;
		}
	}

	public function add_member()
	{
		if (!$this->id) {
			$result['message'] =  'Error Occured';
			echo json_encode($result);
			return false;
		}
		$emailList = $this->input->post('email');
		if (empty($emailList)) {
			$result = array(
				'message' => 'Please Enter an Email'
			);
			echo json_encode($result);
			return false;
		}
		$emailListArray = explode(',', $emailList);
		$notExistedEmail = '';
		$existedEmail = '';
		$notPermittedEmail = '';
		$wrongFormatEmail = '';
		$groupUsers = $this->user->get_users_by_group($this->data['project']->group_id);
		$groupUsersEmail = array();
		$result = array();
		$result['message'] = '';
		foreach($groupUsers as $user)
		{
			$groupUsersEmail[] = $user->email;
		}
		foreach ($emailListArray as $email) {
			if (trim($email) != '') {
				if (!filter_var(trim($email) , FILTER_VALIDATE_EMAIL)) {
					$wrongFormatEmail = $wrongFormatEmail . $email . '; ';
				}else{
					$userData = $this->user->get_user(array('email' => trim($email)));
					if (isset($userData) && $userData) {
						if (!in_array(trim($email), $groupUsersEmail)) {
							$notPermittedEmail = $notPermittedEmail . $email . '; ';
						} else {
							$check = $this->user->get_1_user_by_project($this->id, $userData->id);
							if ($check) {
								$existedEmail = $existedEmail . $email . '; ';
							} else {
								$newMemberData = array(
									'project_id'	=>	$this->id,
									'user_id'	=>	$userData->id,
									'is_lead'	=>	0,
									'date_added' =>	getCurrentMySqlDate()
								);
								$newMemberSave = $this->default_model->set_table('project_detail')->sets($newMemberData)->setPrimary(false)->save();
								$this->default_model->set_table('project')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
								$result['code'] = 200;
								$result['message'] = $result['message'].' Add user successfully : '.$email.';';
							}
						}
					} else {
						$notExistedEmail = $notExistedEmail . $email . '; ';
					}
				}	
			}
		}
		if ($notExistedEmail != "") {
			$result['message'] = $result['message'].' Email not existed: ' . $notExistedEmail;
		}
		if ($existedEmail != "") {
			$result['message'] = $result['message'].' Member already in project: ' . $existedEmail;
		}
		if ($notPermittedEmail != "") {
			$result['message'] = $result['message'].' Member are not group member: ' . $notPermittedEmail;
		}
		if ($wrongFormatEmail != "") {
			$result['message'] = $result['message'].' Wrong email format: ' . $wrongFormatEmail;
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
