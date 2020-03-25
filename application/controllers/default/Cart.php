<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('default/m_product');
	}

	public function index()
	{
		$products=array();
		if(isset($_SESSION['cart'])){
			foreach($_SESSION['cart'] as $item)
			{
				if(isset($item['id']))
				{
					$products[$item['id']]=$this->M_myweb->set_table('product')->sets(array('id'=>$item['id'],'deleted'=>0))->get();
					$products[$item['id']]->cart=$_SESSION['cart'][$item['id']];
				}

			}
		}
		if(!empty($products))
		{
			$this->data['products']=$products;
		}
		$this->data['title']	= "Giỏ Hàng";
		$this->data['subview'] 	= 'default/cart/V_index';
		$this->load->view('default/_main_page',$this->data);
	}

	public function add_to_cart()
	{
		if(isset($_POST['id']))
		{
			$data=$this->input->post();
			if($_POST['quantity']>0)
			{
				//echo $_POST['id'];
				
				if(isset($_SESSION['cart']))
				{
					if(array_key_exists($data['id'],$_SESSION['cart'])){
						$_SESSION['cart'][$data['id']]['quantity']=$_SESSION['cart'][$data['id']]['quantity']+$data['quantity'];
						$_SESSION['cart']['total_quantity']+=$data['quantity'];
						$_SESSION['cart']['total_price']+=($data['price']*$data['quantity']);
					}else{
						$_SESSION['cart'][$data['id']]=$data;
						$_SESSION['cart']['total_quantity']+=$data['quantity'];
						$_SESSION['cart']['total_price']+=($data['price']*$data['quantity']);
					}
				}else{
					$_SESSION['cart'][$data['id']]=$data;
					$_SESSION['cart']['total_quantity']+=$data['quantity'];
					$_SESSION['cart']['total_price']+=($data['price']*$data['quantity']);
				}
				$_SESSION['toastr']['success']="Thêm Giỏ Hàng Thành Công";
			}
			$_SESSION['toastr']['error']="Hãy nhập số lượng sản phẩm trước khi thêm vào giỏ hàng";
			redirect($data['url']);
		}else{
			redirect(site_url('cart'));
		}
	}
	public function remove_cart()
	{
		unset($_SESSION['cart']);
		$_SESSION['toastr']['warning']="Đã Xoá Giỏ Hàng";
		redirect($_POST['url']);
	}

	public function remove_cart_item($id=false)
	{
		if(isset($id))
		{
			unset($_SESSION['cart'][$id]);
			$_SESSION['cart']['total_quantity']=0;
			$_SESSION['cart']['total_price']=0;
			foreach($_SESSION['cart'] as $item)
			{
				if(isset($item['id'])){
					$_SESSION['cart']['total_quantity']+=$item['quantity'];
					$_SESSION['cart']['total_price']+=($item['price']*$item['quantity']);
				}
			}
		}
		redirect(site_url('cart'));
	}

	public function edit_cart()
	{
		if(isset($_POST['id']))
		{
			if($_POST['quantity']>0)
			{
				$_SESSION['cart'][$_POST['id']]['quantity']=$_POST['quantity'];
				redirect(site_url('cart'));
			}else{
				return $this->remove_cart_item();
			}
		}
	}
	public function update_cart(){
		$data=$this->input->post('cart');
		$data['total_quantity']=0;
		$data['total_price']=0;
		foreach($data as $key=>$item)
		{
				if(array_key_exists($item['id'],$_SESSION['cart'])){
					if($item['quantity']==0)
					{
						unset($data[$key]);
					}else{
						$data[$item['id']]['url']=$_SESSION['cart'][$item['id']]['url'];
					}
				}
				$data['total_quantity']+=$item['quantity'];
				$data['total_price']+=($item['price']*$item['quantity']);

		}
		$_SESSION['cart']=$data;
		$_SESSION['toastr']['success']="Cập nhật giỏ hàng thành công";
		redirect(site_url('cart'));
	}

	public function check_out()
	{
		echo "checkout";
	}
}