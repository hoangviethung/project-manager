<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
        $this->data = array();
        $this->id = $this->checkId($_GET['id']);
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

    public function new_group_save()
    {
        $newGroupData = $this->input->post();
		if($newGroupData)
		{
            $newGroupData['leader'] = $this->userInfo->id;
			$newGroupId = $this->default_model->set_table('group')->sets($newGroupData)->save();
			if($newGroupId){
				$_SESSION['system_msg'] = messageDialog('div', 'success', 'Đăng nhập thành công, '.$newGroupData['user_name']);
				return redirect(site_url('dashboard/group?id='.$newGroupId.'token='.$this->userInfo->token));
			}else{
				echo 'Có lỗi khi tạo tài khoản';
			}
		}else{
			echo 'Vui lòng nhập các trường cần thiết (*)';
		}
    }
}
