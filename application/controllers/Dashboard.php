<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
	}
	public function index()
	{
		$this->data['recentTasks'] = $this->task->get_recent_tasks_by_user($this->data['infoLog']->id);
		$this->data['groups'] = $this->group->get_groups_by_user($this->data['infoLog']->id);
		$this->data['recentProjects'] = $this->project->get_recent_projects_by_user($this->data['infoLog']->id);
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/index/V_index';
		$this->load->view('dashboard/_main_page',$this->data);
	}
}
