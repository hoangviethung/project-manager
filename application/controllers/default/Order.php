<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('default/m_product');
	}

	public function index()
	{
		$products = array();
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $item) {
				if (isset($item['id'])) {
					$products[$item['id']] = $this->M_myweb->set_table('product')->sets(array('id' => $item['id'], 'deleted' => 0))->get();
					$products[$item['id']]->cart = $_SESSION['cart'][$item['id']];
				}
			}
			if (!empty($products)) {
				$this->data['products'] = $products;
			}
			
			$this->data['title']	= "Đơn Hàng";
			$this->data['subview'] 	= 'default/order/V_index';
			$this->load->view('default/_main_page', $this->data);
		} else {
			redirect(site_url('cart'));
		}
	}
	public function confirm_order()
	{
		if (isset($_POST['order'])) {
			$this->data['order'] = $this->input->post('order');
			$this->data['order_detail'] = $this->input->post('order_detail');
			$order_id = $this->M_myweb->set_table('order')->sets($this->data['order'])->save();
			if ($order_id) {
				$order_code = time() . "-" . $order_id;
				$this->data['order_code'] = $order_code;
				foreach ($this->data['order_detail'] as $item) {
					$item['order_id'] = $order_id;
					$this->M_myweb->set_table('order_detail')->sets($item)->save();
				}
				$this->M_myweb->set_table('order')->set('order_code', $order_code)->setPrimary($order_id)->save();
				$email_data['order'] = $this->data['order'];
				foreach($this->data['order_detail'] as $item)
				{
					$email_data['order_detail'][$item['product_id']]=$this->M_myweb->set_table('product')->set('id', $item['product_id'])->setPrimary(false)->get();
					$email_data['order_detail'][$item['product_id']]->quantity=$item['quantity'];
				}
				$email_data['order_code'] = $this->data['order_code'];
				$email_data['time'] = date("Y-m-d H:i:s");
				// print_r($email_data);
				$email_result['admin'] = $this->send_email($email_data, "admin");
				$email_result['customer'] = $this->send_email($email_data, "customer");
				$email_result['order_id'] = $order_id;
				$this->M_myweb->set_table('email')->sets($email_result)->setPrimary(0)->save();
				foreach ($_SESSION['cart'] as $item) {
					if (isset($item['id'])) {
						$products[$item['id']] = $this->M_myweb->set_table('product')->sets(array('id' => $item['id'], 'deleted' => 0))->get();
						$products[$item['id']]->cart = $_SESSION['cart'][$item['id']];
					}
				}
				if (!empty($products)) {
					$this->data['products'] = $products;
				}else{
					redirect(site_url('cart'));
				}
				unset($_SESSION['cart']);
				$this->data['title']	= "Đặt Hàng Thành Công";
				$this->data['subview'] 	= 'default/order/V_thank_you';
				$this->load->view('default/_main_page', $this->data);
			} else {
				redirect(site_url('check-out'));
			}
		} else {
			redirect(site_url('check-out'));
		}
	}

	public function send_email($data = false, $receiver)
	{
		if ($data) {
			if ($receiver == 'customer') {

				$receiver_email = $data['order']['email']; //email của khách
			} else {
				// $message = "<h3>Thông tin đơn hàng</h3>
				// <p>Họ tên: " . $data['order']['customer_name'] . "</p>
				// <p>Số ĐT: " . $data['order']['phone'] . "</p>
				// <p>Thời Gian Đặt: " . $data['time'] . "</p>
				// <p>Số lượng khách: " . $data['order']['total_quantity'] . "</p>
				// <p>Tổng Giá Đơn Hàng: " . $data['order']['total_price'] . "</p>".print_r($data);
				$receiver_email = 'trangsuclajew@gmail.com'; //email của admin
			}
			$message = '<div style="width:100%;max-width:754px;margin:0px auto;">
			<p style="text-transform:lowercase;font-size:10px;text-align:center">PLEASE DO NOT REPLY TO THIS MESSAGE, THIS IS
				SENT FROM A NO REPLY EMAIL ADDRESS. FOR ALL ORDER ENQUIRIES CONTACT <a href="mailto:trangsuclajew@gmail.com"
					target="_blank">trangsuclajew@gmail.com</a>.</p>
			<div>
				<img src="https://nhahanghondat.vn/lajew/statics/default/images/logo.png"
					usemap="#m_-1338447232011138994_m_1852941125532014307_map-1" style="width:100%">
			</div>
			<div style="text-align:center">
				<h2 style="color:#727272;text-transform:uppercase;font-size:20px">
					Hi '.$data['order']['customer_name'].'
				</h2>
			</div>
			<div style="text-align:center;color:#727272;text-transform:uppercase">
				<h4 style="font-size:12px">ĐẶT HÀNG THÀNH CÔNG</h4>
			</div>

			<div style="width:80%;margin:auto">
				<div style="text-align:center;color:#727272">
					<h4 style="font-size:14px">Mã Đơn Hàng: '.$data['order_code'].'</h4>
					<p style="color:#727272;font-size:12px">
					Địa Chỉ Giao Hàng: '.$data['order']['address'].'</p>
					<p style="color:#727272;font-size:12px">
					Email: '.$data['order']['email'].'</p>
					<p style="color:#727272;font-size:12px">
					Số ĐT: '.$data['order']['phone'].'</p>
					<p style="color:#727272;font-size:12px">
						Cảm ơn đã mua hàng tại Lajew. Khách hàng có thể xem lại thông tin đơn hàng trên website của chúng tôi sử dụng Mã Đơn Hàng được cung cấp trong email này và email hoặc số ĐT dùng để đặt hàng</p>

				</div>
			</div>
			<div style="width:75%;margin:30px auto">
				<div style="text-align:center">
					<h2 style="color:#727272;text-transform:uppercase;font-size:18px">
						Sản Phẩm
					</h2>
				</div>
				<div>';
				foreach($data['order_detail'] as $item)
				{
					$message=$message.'<div style="display:block;margin-top:30px">
						<div style="width:60%;display:inline-block;float:left;border-top:solid 2px #bcbcbc">
							<div style="margin:auto;text-transform:uppercase;text-align:center">
								<div style="font-size:12px;padding:5px 0px">
									<div>
										<a href="'.site_url('san-pham/') . $item->slug.'"><p style="font-size:12px;color:#727272">'.$item->quantity.' x '.$item->name.' </p></a>
										
									</div>
								</div>
								<h2 style="color:#727272;font-size:14px"><span>'.number_format($item->price,0).' VNĐ</span></h2>
							</div>
						</div>
						<div style="width:40%;display:inline-block">
							<div style="text-align:center">
								<img style="max-width:350px"
									src="'.base_url('assets/public/avatar/').$item->img1.'"
									 class="CToWUd a6T"
									tabindex="0">
							</div>
						</div>
					</div>';
				}

				$message=$message.'</div>
			</div>
			<div style="text-align:center;color:#727272;text-transform:uppercase"
			>
			<h4 style="font-size:16px">TỔNG CỘNG: '.number_format($data['order']['total_price'],0).' VNĐ</h4>
		</div>
		</div>';
		$subject="Trang Sức Lajew - Đơn hàng ".$data['order_code'];
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => '465',
				'smtp_user' => 'trangsuclajew@gmail.com', // change email account it to yours
				'smtp_pass' => 'Trangsuclajew@123.', // change password it to yours
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'newline' => "\r\n",
				'wordwrap' => TRUE
			);

			// load email library
			$this->load->library('email', $config);

			// prepare email
			$this->email
				->from('trangsuclajew@gmail.com', 'Trang Sức Lajew')
				->to($receiver_email)
				->subject($subject)
				->message($message)
				->set_mailtype('html');
			// ->set_newline("\r\n");

			// send email
			if (!$this->email->send()) {
				$error = $this->email->print_debugger();
				return $error;
			} else {
				return 1;
			}
		}
	}

	public function search_form()
	{ }
	public function search_order()
	{
		if (isset($_POST['order_code'])) {
			if (isset($_POST['email'])) {
				$order = $this->M_myweb->set_table('order')->sets(array('order_code' => $_POST['order_code'], 'email' => $_POST['email']))->get();
			} else if (isset($_POST['phone'])) {
				$order = $this->M_myweb->set_table('order')->sets(array('order_code' => $_POST['order_code'], 'phone' => $_POST['phone']))->get();
			}
			if (isset($order) && $order) {
				$order_details = $this->M_myweb->set_table('order_detail')->sets(array('order_id' => $order->id))->gets();
				foreach ($order_details as $item) {
					$this->data['products'][] = $this->M_myweb->set_table('product')->set('id', $item->product_id)->get();
					foreach ($this->data['products'] as $product) {
						if ($product->id == $item->product_id) {
							$item = (array) $item;
							$product->order_details = $item;
						}
					}
				}
				$this->data['search_order_result'] = $order;
				$this->data['title']	= "Kiếm Thông Tin Đơn Hàng";
				$this->data['subview'] 	= 'default/order/V_search_order';
				$this->load->view('default/_main_page', $this->data);
			} else {
				$this->data['message'] = "Không tìm thấy đơn hàng, vui lòng kiểm tra lại thông tin";
				$this->data['title']	= "Kiếm Thông Tin Đơn Hàng";
				$this->data['subview'] 	= 'default/order/V_search_order_form';
				$this->load->view('default/_main_page', $this->data);
			}
		} else {
			$this->data['title']	= "Kiếm Thông Tin Đơn Hàng";
			$this->data['subview'] 	= 'default/order/V_search_order_form';
			$this->load->view('default/_main_page', $this->data);
		}
	}
}
