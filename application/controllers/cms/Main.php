<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Main extends CMS_Controller {

	public function __construct(){
		parent::__construct();
		$this->data['orders'] = $this->M_myweb->set_table('order')->gets();
		$this->load->model('cms/m_product');
    }
	public function index(){
		$this->data['chart_data']['last_7_days']=array_fill(0,7,0);
		$this->data['chart_data']['last_30_days']=array_fill(0,30,0);
		$this->data['chart_data']['last_year']=array_fill(0,12,0);
		if($this->data['orders'])
		{
			foreach($this->data['orders'] as $key=>$item)
			{
				for($i=0;$i<7;$i++)
				{
					if(date("Y-m-d",strtotime($item->order_at))==date("Y-m-d",strtotime("-".$i." day"))){
						$this->data['chart_data']['last_7_days'][6-$i]++;
					}
				}
			}
	
			foreach($this->data['orders'] as $key=>$item)
			{
				for($i=0;$i<30;$i++)
				{
					if(date("Y-m-d",strtotime($item->order_at))==date("Y-m-d",strtotime("-".$i." day"))){
						$this->data['chart_data']['last_30_days'][29-$i]++;
					}
				}
			}
	
			foreach($this->data['orders'] as $key=>$item)
			{
				for($i=0;$i<12;$i++)
				{
					if(date("m",strtotime($item->order_at))==date("m",strtotime("-".$i." month"))&&date("Y",strtotime($item->order_at))==date("Y",strtotime("-".$i." month"))){
						$this->data['chart_data']['last_year'][11-$i]++;
					}
				}
			}
		}

		$this->data['products'] = $this->M_myweb->set_table('product')->set('deleted',0)->gets();
		$this->data['new_products'] = $this->M_myweb->set_table('product')->sets(array('deleted'=>0,'new'=>1))->gets();
		$this->data['sale_products'] = $this->M_myweb->set_table('product')->sets(array('deleted'=>0,'sale'=>1))->gets();
		$this->data['subview'] = 'cms/main/home';
		$this->load->view('cms/_main_page',$this->data);
	}
}