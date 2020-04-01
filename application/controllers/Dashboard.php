<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->search=isset($_GET['search'])?$_GET['search']:FALSE;
		$this->load->model('default/Group_model','group');
		$this->load->model('default/Project_model','project');
		$this->load->model('default/Task_model','task');
		$this->data = array();
	}
	public function index()
	{
		// $this->data['groups'] = $this->group->get_groups_by_user($_SESSION['system']->id);
		// $this->data['projects'] = $this->project->get_projects_by_user($_SESSION['system']->id);
		// $this->data['tasks'] = $this->task->get_tasks_by_user($_SESSION['system']->id);
		$this->data['title']	= "Trang Chủ";
		$this->data['subview'] 	= 'dashboard/index/V_index';
		$this->load->view('dashboard/_main_page',$this->data);
	}
}
