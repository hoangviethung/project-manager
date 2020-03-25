<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends CMS_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->Model = $this->M_myweb->set_table('category');
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
			case "lock":
				$this->lock();
				break;
			case "unlock":
				$this->unLock();
				break;
			default:
				$this->home();
				break;
		}
	}
	private function home()
	{
		$this->data['category'] = $this->Model->set('deleted', 0)->set_orderby('name')->gets();
		$this->data['subview'] = 'cms/category/home';
		$this->load->view('cms/_main_page', $this->data);
	}

	private function child_list()
	{
		$this->id = $_GET['id'];
		$this->data['cat_parent'] = $this->Model->set('id', $this->id)->set('deleted', 0)->set_orderby('name')->get();
		$this->data['category'] = $this->Model->set('parent', $this->id)->set('deleted', 0)->set_orderby('name')->gets();
		$this->data['id'] = $this->id;
		$this->data['subview'] = 'cms/category/home';
		$this->load->view('cms/_main_page', $this->data);
	}

	private function edit()
	{
		if (isset($_GET['id'])) {
			$this->data['id'] = $_GET['id'];
			$this->data['obj'] = $this->Model->set('id', $this->data['id'])->get();
		}
		if (isset($_GET['parent_1'])) {
			$this->data['parent_1'] = $_GET['parent_1'];
			$this->data['parent_1_data'] = $this->Model->set('id', $_GET['parent_1'])->set('deleted', 0)->set_orderby('name')->get();
		} else {
			$this->data['parent_1'] = 0;
		}
		if (isset($_GET['parent_2'])) {
			$this->data['parent_2'] = $_GET['parent_2'];
			$this->data['parent_2_data'] = $this->Model->set('id', $_GET['parent_2'])->set('deleted', 0)->set_orderby('name')->get();
		} else {
			$this->data['parent_2'] = 0;
		}
		$this->data['level'] = isset($_GET['level'])?$_GET['level']:0;
		$this->data['subview'] = 'cms/category/edit';
		$this->load->view('cms/_main_page', $this->data);
	}

	private function save()
	{
		$data = $this->input->post();
		if ($_GET['id']) {
			$data['slug'] = str_replace(" ", "-", stripUnicode($data['name']))."-".$_GET['id'];
			$this->Model->sets($data)->setPrimary($this->id)->save();
			$_SESSION['system_msg'] = messageDialog("div", "success", "Cập nhật category thành công");
		} else {
			$data['slug'] = str_replace(" ", "-", stripUnicode($data['name']));
			if($data['level']!=2){
				$this->data['check'] = $this->Model->set('slug', $data['slug'])->set('deleted', 0)->get();
			}else{
				$this->data['check'] = false;
			}
			if($this->data['check']){
				$_SESSION['system_msg'] = messageDialog("div", "warning", "Category đã tồn tại");
			}else{
				$id=$this->Model->sets($data)->save();
				$slug=$data['slug']."-".$id;
				$this->Model->set('slug',$slug)->setPrimary($id)->save();
				$_SESSION['system_msg'] = messageDialog("div", "success", "Thêm category thành công");
			}
		}
		return redirect(site_url('admin/category'));
	}

	private function delete()
	{

		if ($this->id) {
			$getPro = $this->Model->set('id', $this->id)->get();
			if ($getPro) {
				$this->Model->sets(array('deleted' => 1))->setPrimary($this->id)->save();
				$this->M_myweb->set_table('category')->sets(array('deleted' => 1))->primary_key('parent_1')->setPrimary($this->id)->save();
				$this->M_myweb->set_table('category')->sets(array('deleted' => 1))->primary_key('parent_2')->setPrimary($this->id)->save();
				$this->M_myweb->set_table('category')->primary_key('id');
				$_SESSION['system_msg'] = messageDialog("div", "success", "Xoá category thành công");
			} else {
				$_SESSION['system_msg'] = messageDialog("div", "error", "Không thể xoá category");
			}
		}

		redirect(site_url('admin/category'));
	}

	private function lock()
	{

		if (isset($_GET['id'])) {

			$this->data['id'] = $_GET['id'];

			$data['active'] = 0;

			$this->Model->sets($data)->setPrimary($this->id)->save();
		}

		$this->data['subview'] = 'cms/category/home';

		return redirect(site_url('admin/category'));
	}

	private function unLock()
	{

		if (isset($_GET['id'])) {

			$this->data['id'] = $_GET['id'];

			$data['active'] = 1;

			$this->Model->sets($data)->setPrimary($this->id)->save();
		}

		$this->data['subview'] = 'cms/category/home';

		return redirect(site_url('admin/category'));
	}
}
