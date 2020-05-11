<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->data['users'] = $this->M_myweb->set_table('user')->gets();
		$this->load->model('cms/m_product');
    }
	public function index(){
		$this->data['chart_data']['last_7_days']=array_fill(0,7,0);
		$this->data['chart_data']['last_30_days']=array_fill(0,30,0);
		$this->data['chart_data']['last_year']=array_fill(0,12,0);
		if($this->data['users'])
		{
			foreach($this->data['users'] as $key=>$item)
			{
				for($i=0;$i<7;$i++)
				{
					if(date("Y-m-d",strtotime($item->created_at))==date("Y-m-d",strtotime("-".$i." day"))){
						$this->data['chart_data']['last_7_days'][6-$i]++;
					}
				}
			}
	
			foreach($this->data['users'] as $key=>$item)
			{
				for($i=0;$i<30;$i++)
				{
					if(date("Y-m-d",strtotime($item->created_at))==date("Y-m-d",strtotime("-".$i." day"))){
						$this->data['chart_data']['last_30_days'][29-$i]++;
					}
				}
			}
	
			foreach($this->data['users'] as $key=>$item)
			{
				for($i=0;$i<12;$i++)
				{
					if(date("m",strtotime($item->created_at))==date("m",strtotime("-".$i." month"))&&date("Y",strtotime($item->created_at))==date("Y",strtotime("-".$i." month"))){
						$this->data['chart_data']['last_year'][11-$i]++;
					}
				}
			}
		}

		$this->data['inActiveMembers'] = $this->M_myweb->set_table('user')->sets(array('is_active'=>0))->gets();
		$this->data['totalMembers'] = $this->M_myweb->set_table('user')->gets();
		$this->data['activeGroups'] = $this->M_myweb->set_table('group')->set('is_active',1)->gets();
		$this->data['activeMembers'] = $this->M_myweb->set_table('user')->sets(array('is_active'=>1))->gets();

		$this->data['subview'] = 'cms/main/home';
		$this->load->view('cms/_main_page',$this->data);
	}
}