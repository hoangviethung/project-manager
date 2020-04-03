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
		$this->project_id = $this->checkId($_GET['project_id']);
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
		if($this->project_id)
		{
			$newTaskData = $this->input->post();
			if($newTaskData)
			{
				$newTaskData['project_id'] = $this->project_id;
				$newTaskData['assigner'] = $this->userInfo->id;
				if(!$newTaskData['report_to'])
				{
					$newTaskData['report_to'] = $this->userInfo->id;
				}
				$newTaskData['last_update'] = getCurrentMySqlDate();
				$newTaskId = $this->default_model->set_table('task')->sets($newTaskData)->save();
				if($newTaskId){
					$_SESSION['system_msg'] = messageDialog('div', 'success', 'Đăng nhập thành công, '.$newTaskData['user_name']);
					return redirect(site_url('dashboard/task?id='.$newTaskId.'token='.$this->userInfo->token));
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
