<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Order extends CMS_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		switch ($this->act) {
			case "upd":
				if ($this->input->post())
					$this->save();
				$this->edit();
				break;
			case "del":
				$this->delete();
				break;
			case "child_list":
				$this->child_list();
				break;
			case "status-upd":
				$this->lock();
				break;
			// case "unlock":
			// 	$this->unLock();
			// 	break;
			default:
				$this->home();
				break;
		}
	}
	private function home()
	{
		$this->data['orders'] = $this->M_myweb->set_table('order')->set_orderby('id')->gets();
		$this->data['subview'] = 'cms/order/home';
		$this->load->view('cms/_main_page', $this->data);
	}

	private function child_list()
	{
		$this->id = $_GET['id'];
		$this->data['order'] = $this->M_myweb->set_table('order')->set('id', $this->id)->set_orderby('id')->get();
		$this->data['order_details'] = $this->M_myweb->set_table('order_detail')->set('order_id', $this->id)->set_orderby('product_id')->gets();
		foreach($this->data['order_details'] as $item)
		{
			$this->data['products'][]=$this->M_myweb->set_table('product')->set('id', $item->product_id)->get();

			foreach($this->data['products'] as $product)
			{
				if($product->id==$item->product_id)
				{
					$item=(array)$item;
					$product->order_details=$item;
				}
			}
		}

		$this->data['id'] = $this->id;
		$this->data['subview'] = 'cms/order/order_detail';
		$this->load->view('cms/_main_page', $this->data);
	}

	private function lock()
	{
		if (isset($_GET['id'])) {
			if(isset($_GET['delivered']))
			{
				$data['delivered'] = $_GET['delivered'];
			}else if(isset($_GET['paid'])){
				$data['paid'] = $_GET['paid'];
			}else if(isset($_GET['cancelled']))
			{
				$data['cancelled'] = $_GET['cancelled'];
			}
			$this->M_myweb->set_table('order')->sets($data)->setPrimary($_GET['id'])->save();
		}
		redirect(site_url('admin/order?act=child_list&id='.$_GET['id']."&token=" . $this->data['infoLog']->token));
	}
	
	// private function unLock()
	// {
	// 	if (isset($_GET['id'])) {

	// 		$data['active'] = 1;
	// 		$this->M_myweb->set_table('order')->sets($data)->setPrimary($_GET['id'])->save();
	// 	}
	// 	return redirect(site_url('admin/category'));
	// }
}
