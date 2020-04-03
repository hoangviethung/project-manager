<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
        $this->data = array();
		$this->id = $this->checkId($_GET['id']);
		$this->group_id = $this->checkId($_GET['group_id']);
    }
    
    public function index()
	{
		switch ($this->act) {
			case "new_task_save":
				$this->new_task_save();
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
            $this->data['users'] = $this->task->get_by_id($this->id);
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

    public function new_task_save()
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
}
