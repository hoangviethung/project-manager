<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
		$this->load->model('default/User_model','user');
        $this->data = array();
		$this->id = $this->checkId($_GET['id']);
		$this->group_id = $this->checkId($_GET['group_id']);
		$this->data['project_users'] = $this->user->get_users_by_project($this->id);
    }
    
    public function index()
	{
		switch ($this->act) {
			case "new_project_save":
				$this->new_project_save();
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
		if($this->group_id)
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
	
	public function add_member_view()
	{
		if($this->id)
        {
			$currentProject = $this->project->get_by_id($this->id);
			$groupUsers = $this->user->get_users_by_group($currentProject->group_id);
			$possibleUsers = $groupUsers;
			for($i=0;$i<count($possibleUsers);$i++)
			{
				foreach($this->data['project_users'] as $projectUser)
				{
					if($groupUsers[$i]->id==$projectUser->id)
					{
						unset($possibleUsers[$i]);
					}
				}
			}
			$this->data['possible_users'] = $possibleUsers;
			$this->data['title']	= "Trang Chủ";
            $this->data['subview'] = 'dashboard/project/V_add_member';
            $this->load->view('dashboard/_main_page',$this->data);
        }else{
            redirect(site_url("dashboard"));
        }
	}
	public function add_member()
	{
		if($this->id)
        {
			$memberId = $this->input->post('member_id');
			if($memberId)
			{
				foreach($memberId as $id)
				{
					$newMemberData = array(
						'project_id'	=>	$this->id,
						'user_id'	=>	$id,
						'is_lead'	=>	0,
						'date_added'=>	getCurrentMySqlDate()
					);
					$newMemberSave = $this->default_model->set_table('project_detail')->sets($newMemberData)->save();
				}
			}
			redirect(site_url("dashboard/project?id=".$this->id."&token=".$this->userInfo->token));
        }else{
            redirect(site_url("dashboard"));
        }
	}
}
