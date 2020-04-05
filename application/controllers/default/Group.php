<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
		$this->load->model('default/User_model','user');
        $this->data = array();
		$this->id = $this->checkId($_GET['id']);
		if($this->id)
		{
			$this->data['users'] = $this->user->get_users_by_group($this->id);
			$this->data['projects'] = $this->project->get_projects(array('group_id'=>$this->id));
			foreach($this->data['projects'] as $project)
			{
				$tasks = $this->task->get_tasks(array('project_id'=>$project->id));
				if($tasks)
				{
					foreach($tasks as $task)
					{
						$this->data['tasks'][] = $task;
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
			default:
				$this->home();
				break;
		}
    }
    
	public function home()
	{
        if($this->id)
        {
            $this->data['tasks'] = $this->task->get_by_id($this->id);
            $this->data['projects'] = $this->project->get_by_id($this->id);
            $this->data['title']	= "Trang Chủ";
            $this->data['subview'] = 'dashboard/group/V_index';
            $this->load->view('dashboard/_main_page',$this->data);
        }else{
            redirect(site_url("dashboard"));
        }
    }
    
    public function new_group_view()
    {

	}
	
	public function new_project_save()
    {
		if($this->id)
		{
			$newProjectData = $this->input->post();
			if($newProjectData)
			{
				$newProjectData['group_id'] = $this->group_id;
				$newProjectData['created_by'] = $this->userInfo->id;
				if(!$newProjectData['leader'])
				{
					$newProjectData['leader'] = $this->userInfo->id;
				}
				$newProjectData['last_update'] = getCurrentMySqlDate();
				$newProjectId = $this->default_model->set_table('project')->sets($newProjectData)->save();
				if($newProjectId){
					$newProjectUserData = array(
						'project_id'	=>	$newProjectId,
						'user_id'	=>	$this->userInfo->id,
						'is_lead'	=>	1,
						'date_added'=>	getCurrentMySqlDate()
					);
					$newProjectUserId = $this->default_model->set_table('project_detail')->sets($newProjectUserData)->save();
					$_SESSION['system_msg'] = messageDialog('div', 'success', 'Đăng nhập thành công, '.$newProjectData['user_name']);
					return redirect(site_url('dashboard/group?id='.$newProjectId.'token='.$this->userInfo->token));
				}else{
					echo 'Có lỗi khi tạo nhóm';
				}
			}else{
				echo 'Vui lòng nhập các trường cần thiết (*)';
			}
		}else{
			echo 'Có lỗi khi tạo nhóm';
		}
	}

    public function new_group_save()
    {
        $newGroupData = $this->input->post();
		if($newGroupData)
		{
			$newGroupData['leader'] = $this->userInfo->id;
			$newGroupId = $this->default_model->set_table('group')->sets($newGroupData)->save();
			if($newGroupId)
			{
				$newGroupUserData = array(
					'group_id'	=>	$newGroupId,
					'user_id'	=>	$this->userInfo->id,
					'is_lead'	=>	1,
					'date_added'=>	getCurrentMySqlDate(),
					'is_confirmed'=>	1,
					'token'	=>	0,
					'date_confirmed'	=>getCurrentMySqlDate()
				);
				$newGroupUserId = $this->default_model->set_table('group_detail')->sets($newGroupUserData)->save();
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Đăng nhập thành công, '.$newGroupData['user_name']);
				return redirect(site_url('dashboard/group?id='.$newGroupId.'&token='.$this->userInfo->token));
			}else{
				echo 'Có lỗi khi tạo nhóm';
			}
		}else{
			echo 'Vui lòng nhập các trường cần thiết (*)';
		}
	}
	
	public function invite_member()
	{
		if($this->id)
		{
			$memberEmail = $this->input->post('email');
			if($memberEmail)
			{
				$get = $this->user->get_user(array('email'=>$memberEmail));
				if($get)
				{
					$newMember = array(
						'group_id' 		=> 	$this->id,
						'user_id'  		=> 	$get->id,
						'date_added'	=>	getCurrentMySqlDate(),
						'token'			=>	randomString(30)
					);
					$newMemberSave = $this->default_model->set_table('group_detail')->sets($newMember)->save();
					if($newMemberSave)
					{
						$emailData = array();
						$emailData['content'] = 'Vui lòng xác nhận lời mời bằng link bên dưới: '.site_url('confirm_group_invite?uid='.$get->id.'&token='.$newMember['token']);
						$this->send_email($emailData);
					}
				}
			}else{
				echo 'Vui lòng nhập email';
			}
		}
	}
}