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

	public function task()
	{
		$this->data['recentTasks'] = $this->task->get_recent_tasks_by_user($this->data['infoLog']->id);
		$recentTasks = $this->data['recentTasks'];
		$taskAssignedToMe = array();
		$taskMonitoredByMe = array();
		if($recentTasks)
		{
			foreach($this->data['recentTasks'] as $task)
			{
				if($task->status == getTaskStatusId('Working On') && $task->assignee == $this->userInfo->id)
				{
					$taskAssignedToMe[] = $task;
				}
				if($task->status == getTaskStatusId('Done') && $task->report_to == $this->userInfo->id)
				{
					$taskAssignedToMe[] = $task;
				}
				if($task->assigner == $this->userInfo->id)
				{
					$taskMonitoredByMe[] = $task;
				}
			}
		}else{
			$taskMonitoredByMe = false;
			$taskAssignedToMe = false;
		}

		$this->data['taskAssignedToMe'] = $taskAssignedToMe;
		$this->data['taskMonitoredByMe'] = $taskMonitoredByMe;
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] = 'dashboard/index/V_my_tasks';
		$this->load->view('dashboard/_main_page',$this->data);
	}
}
