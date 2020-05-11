<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->search = isset($_GET['search']) ? $_GET['search'] : FALSE;
		$this->load->model('default/User_model', 'user');
		$this->id = isset($_GET['id'])?$_GET['id']:'';
		$this->id = $this->checkId($this->id);
		if ($this->id) {
			$this->data['group'] = $this->group->get_by_id($this->id);
			$this->data['users'] = $this->user->get_users_by_group($this->id);
			$this->data['projects'] = $this->project->get_projects(array('group_id' => $this->id));
			if ($this->data['projects']) {
				foreach ($this->data['projects'] as $project) {
					$tasks = $this->task->get_tasks(array('project_id' => $project->id));
					if ($tasks) {
						foreach ($tasks as $task) {
							$this->data['tasks'][] = $task;
						}
					}
				}
			}
		}
	}

	public function index()
	{
		switch ($this->act) {
			case "new_group_save":
				$this->new_group_save();
				break;
			case "new_project_save":
				$this->new_project_save();
				break;
			case "group_detail":
				$this->group_detail();
				break;
			case "invite_member":
				$this->invite_member();
				break;
			case "new_announcement_save":
				$this->new_announcement_save();
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

		$this->data['title']	= "My Groups";
		$this->data['subview'] = 'dashboard/group/V_group_index';
		$this->load->view('dashboard/_main_page', $this->data);
	}

	public function group_detail()
	{
		if ($this->id) {
			$this->data['projects'] = $this->project->get_projects(array('project.group_id' => $this->id));
			$this->data['announcements'] = $this->default_model->set_table('group_announcement')->sets(array('is_active' => 1, 'group_id' => $this->id))->gets();
			if($this->data['projects'])
			{
				foreach($this->data['projects'] as $key=>$project){
					$projectUsers = $this->user->get_users_by_project($project->id);
					$this->data['projects'][$key]->projectUsers = $projectUsers;
					$projectPossibleUsers = $this->get_project_possible_users($projectUsers);
					$this->data['projects'][$key]->possibleUsers = $projectPossibleUsers;
				}
			}
			$this->data['title']	= "Group Detail";
			$this->data['subview'] = 'dashboard/group/V_group_detail';
			$this->load->view('dashboard/_main_page', $this->data);
		} else {
			redirect(site_url('dashboard'));
		}
	}


	public function new_project_save()
	{
		if ($this->id) {
			$newProjectData = $this->input->post();
			if ($newProjectData['name'] != "") {
				$newProjectData['group_id'] = $this->id;
				$newProjectData['created_by'] = $this->data['infoLog']->id;
				if (!isset($newProjectData['leader'])) {
					$newProjectData['leader'] = $this->data['infoLog']->id;
				}
				$newProjectData['last_update'] = getCurrentMySqlDate();
				$newProjectId = $this->default_model->set_table('project')->sets($newProjectData)->save();
				if ($newProjectId) {
					$newProjectUserData = array(
						'project_id'	=>	$newProjectId,
						'user_id'	=>	$this->data['infoLog']->id,
						'is_lead'	=>	1,
						'date_added' =>	getCurrentMySqlDate()
					);
					$newProjectUserId = $this->default_model->set_table('project_detail')->sets($newProjectUserData)->save();
					$this->default_model->set_table('group')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
					$result = array(
						'link' => site_url('dashboard/project?act=project_detail&id=' . $newProjectId . '&token=' . $this->data['infoLog']->token),
						'projectName' => $newProjectData['name'],
						'code' => '200'
					);
				} else {
					$result = array(
						'message' => "Error creating new Project (can't save user)"
					);
				}
			} else {
				$result = array(
					'message' => 'Enter required field (*)'
				);
			}
		} else {
			$result = array(
				'message' => 'Error creating new Project'
			);
		}
		echo json_encode($result);
	}

	public function new_group_save()
	{
		$newGroupData = $this->input->post();
		if ($newGroupData['name'] != "") {
			$existedGroup = $this->M_myweb->sets(array('name' => $newGroupData['name']))->set_table('group')->get();
			if ($existedGroup) {
				$result = array("message" => "Group name taken");
			} else {
				$newGroupData['leader'] = $this->data['infoLog']->id;
				$newGroupData['last_update'] = getCurrentMySqlDate();
				$newGroupId = $this->default_model->set_table('group')->sets($newGroupData)->save();
				if ($newGroupId) {
					$newGroupUserData = array(
						'group_id'	=>	$newGroupId,
						'user_id'	=>	$this->data['infoLog']->id,
						'is_lead'	=>	1,
						'date_added' =>	getCurrentMySqlDate(),
						'is_confirmed' =>	1,
						'token'	=>	0,
						'date_confirmed'	=> getCurrentMySqlDate()
					);
					$newGroupUserId = $this->default_model->set_table('group_detail')->sets($newGroupUserData)->save();
					$result = array(
						"link" => site_url('dashboard/group?id=' . $newGroupId . '&token=' . $this->data['infoLog']->token),
						'code' => 200,
						'groupName' =>	$newGroupData['name']
					);
				} else {
					$result = array("message" => "Error Saving");
				}
			}
		} else {
			$result = array("message" => "Please Enter A Name");
		}
		echo json_encode($result);
	}

	public function edit_save()
	{
		$groupData = $this->input->post();
		if ($groupData) {
			$groupData['last_update'] = getCurrentMySqlDate();
			$this->default_model->set_table('group')->sets($groupData)->setPrimary($this->id)->save();
			$result = array(
				"link" => site_url('dashboard/group?act=group_detail&id=' . $this->id . '&token=' . $this->data['infoLog']->token),
				'code' => 200
			);
		} else {
			$result = array("message" => "Error Saving");
		}
		echo json_encode($result);
	}

	public function invite_member()
	{
		if ($this->id) {
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
					$check = $this->user->get_1_user_by_group($this->id,$get->id);
					if($check)
					{
						$result = array(
							'message' => 'Member Invited, please check again'
						);
					}else{
						$newMember = array(
							'group_id' 		=> 	$this->id,
							'user_id'  		=> 	$get->id,
							'date_added'	=>	getCurrentMySqlDate(),
							'is_confirmed'	=>	0,
							'token'			=>	randomString(30)
						);
						$newMemberSave = $this->default_model->set_table('group_detail')->sets($newMember)->setPrimary(false)->save();
						$groupInfo = $this->default_model->set_table('group')->sets(array('id'=>$this->id))->get();
						if ($newMemberSave) {
							$this->default_model->set_table('group')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
							$emailData = array();
							$emailData['receiver'] = $memberEmail;
							$emailData['subject'] = 'Gazeboo Group Invite';
							$emailData['content'] = 'You have been invited to group "'.$groupInfo->name.'". Please click the link to accept or ignore if deny: ' . site_url('confirm_group_invite?uid=' . $get->id . '&token=' . $newMember['token']);
							$this->send_email($emailData);
						}
						$result = array(
							'message' => 'Invitational Email Sent'
						);
					}
				} else {
					$result = array(
						'message' => 'Member not existed'
					);
				}
			} else {
				$result = array(
					'message' => 'Please enter an email'
				);
			}
		}
		echo json_encode($result);
	}

	public function new_announcement_save()
	{
		if ($this->id) {
			$result = array();
			$announcementData = $this->input->post();
			if ($announcementData['description'] != '') {
				$announcementData['created_by'] = $this->data['infoLog']->id;
				$announcementData['group_id'] = $this->id;
				$announcementData['created_at'] = getCurrentMySqlDate();
				$newAnnouncementId = $this->default_model->set_table('group_announcement')->sets($announcementData)->setPrimary(false)->save();
				if ($newAnnouncementId) {
					$this->default_model->set_table('group')->sets(array('last_update' => getCurrentMySqlDate()))->setPrimary($this->id)->save();
					$result = array (	
						'code'	=>	'200',
						'link' => site_url('dashboard/group?act=group_detail&id=' . $this->id . '&token=' . $this->data['infoLog']->token)
					);
				} else {
					$result['message'] = 'Error Saving';
				}
			} else {
				$result['message'] = 'Enter Required Field (*)';
			}
		} else {
			$result['message'] = 'Error Saving';
		}
		echo json_encode($result);
	}

	protected function get_project_possible_users($projectUsers)
	{
		$groupUsers = $this->data['users'];
		$possibleUsers = $groupUsers;
		if($projectUsers)
		{
			foreach ($possibleUsers as $key=>$value) {
				foreach ($projectUsers as $projectUser) {
					if (isset($possibleUsers[$key])&&$possibleUsers[$key]->id == $projectUser->id) {
						unset($possibleUsers[$key]);
					}
				}
			}
			if(count($possibleUsers) > 0)
			{
				return $possibleUsers;
			}
		}
		return false;
	}

	protected function delete_member()
	{
		if (!$this->id) {
			$result['message'] =  'Error Occured';
			echo json_encode($result);
			return false;
		}
		$groupDetailId = $this->input->post('group_detail_id');
		$memberId = $this->input->post('member_id');
		$check = $this->default_model->set_table('group_detail')->sets(array('is_active'=>1,'group_id'=>$this->id,'user_id'=>$memberId))->get();
		if($check)
		{
			$this->default_model->set_table('group_detail')->sets(array('is_active'=>0))->setPrimary($check->id)->save();
			$projects = $this->default_model->set_table('project')->sets(array('is_active'=>1,'group_id'=>$this->id))->gets();
			foreach($projects as $project)
			{
				$projectDetail = $this->default_model->set_table('project_detail')->sets(array('project_id'=>$project->id,'user_id'=>$memberId,'is_active'=>1))->gets();
				if($projectDetail->is_lead == 1)
				{
					$result['message'] =  "Can't delete member, member is leader of a project";
					echo json_encode($result);
					return false;
				}
				$checkProjectDetail = $this->default_model->set_table('project_detail')->sets(array('is_active'=>0))->setPrimary($projectDetail->id)->save();
				if($checkProjectDetail && $projectDetail->id == $checkProjectDetail)
				{
					$taskAssignedTo = $this->default_model->set_table('task')->sets(array('project_id'=>$project->id,'assignee'=>$memberId,'is_active'=>1))->gets();
					$taskReportTo = $this->default_model->set_table('task')->sets(array('project_id'=>$project->id,'report_to'=>$memberId,'is_active'=>1))->gets();
					$taskAssign = $this->default_model->set_table('task')->sets(array('project_id'=>$project->id,'assigner'=>$memberId,'is_active'=>1))->gets();
					foreach($taskAssignedTo as $a){
						$this->default_model->set_table('task')->sets(array('assignee'=>0))->setPrimary($a->id)->save();
					}
					foreach($taskReportTo as $b){
						$this->default_model->set_table('task')->sets(array('report_to'=>$this->data['project']->leader))->setPrimary($b->id)->save();
					}
					foreach($taskAssign as $c){
						$this->default_model->set_table('task')->sets(array('assigner'=>$this->data['project']->leader))->setPrimary($c->id)->save();
					}
				}
			}
			$result = array(
				"link" => site_url('dashboard/project?act=group_detail&id=' . $this->id . '&token=' . $this->data['infoLog']->token),
				'code' => 200
			);
			$result['message'] =  'Delete Member Successfully';
			echo json_encode($result);
			return false;
		}
		$result['message'] =  "There's something wrong, please check again";
		echo json_encode($result);
		return false;
	}
}
