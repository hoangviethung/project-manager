<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Banner extends CMS_Controller {



	public function __construct(){

		parent::__construct();


		$this->Model = $this->M_myweb->set_table('home_banner');

	}

	

	public function index()

	{

		switch($this->act){

			case "upd":

				if($this->input->post())

					$this->save();

				$this->edit();

				break;

			case "del":

				$this->delete();

				break;

				case "status-upd":

				$this->status_update();

				break;
			default:

				$this->home();

				break;

		}

	}



	private function home(){

		$this->M_myweb->set('deleted',0);

		$this->data['banners'] = $this->M_myweb->gets();

		$this->data['subview'] = 'cms/banner/home';

		$this->load->view('cms/_main_page',$this->data);

	}



	private function edit(){

		if(isset($_GET['id'])){

			$this->data['id'] = $_GET['id'];

			$this->data['obj'] = $this->Model->set('id',$this->data['id'])->get();

			$this->data['obj']->image_01 = "";

		}

		$this->data['subview'] = 'cms/banner/edit';

		$this->load->view('cms/_main_page',$this->data);

	}



	private function save(){

		$data = $this->input->post();

		$image_01 = "";

		if($_FILES['image_01']['name']!=""){

			$image_01 = do_upload('avatar','image_01');	

			$data['img'] = $image_01;				

		}

		if($this->id){

			$this->Model->sets($data)->setPrimary($this->id)->save();

			$_SESSION['system_msg'] = messageDialog("div","success","Cập nhật Banner thành công");

		}else{

			$this->Model->sets($data)->save();

			$_SESSION['system_msg'] = messageDialog("div","success","Cập nhật Banner thành công");

		}

		return redirect(site_url('admin/banner'));

	}

	private function status_update()
	{
		if (isset($_GET['id'])) {
			if(isset($_GET['active']))
			{
				$data['active'] = $_GET['active'];
			}
			$this->M_myweb->set_table('home_banner')->sets($data)->setPrimary($_GET['id'])->save();
		}
		redirect(site_url('admin/banner'));
	}

	private function delete(){

		if($this->id){

			$getPro = $this->Model->set('id',$this->id)->get();

			if($getPro){

				$this->Model->sets(array('deleted'=>1))->setPrimary($this->id)->save();

				$_SESSION['system_msg'] = messageDialog("div","success","Xoá Banner thành công");

			}else{

				$_SESSION['system_msg'] = messageDialog("div","error","Không thể xoá Banner");

			}

		}

		redirect(site_url('admin/banner'));

	}

}