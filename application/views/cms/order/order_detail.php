<?php
if (isset($parent)) {
	$action = site_url('admin/category?act=upd&parent=' . $parent . "&token=" . $infoLog->token);
} else {
	$action = $obj ? site_url('admin/category?act=upd&id=' . $obj->id . "&token=" . $infoLog->token) : site_url('admin/category?act=upd&token=' . $infoLog->token);
}

?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew <strong><?php if ($order) echo "/ " . $order->order_code ?> </strong>
				</h6>
				<h3 class="dashhead-title"><strong>Đơn Hàng : <?php if ($order) echo $order->order_code ?> </strong></h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					<strong>Đơn Hàng : <?php if ($order) echo $order->order_code ?> </strong></h3>
				</div>
			</div>
		</div>
		<!-- END: dashhead -->
	</header>
	<!-- END: .main-heading -->

	<!-- begin .main-content -->
	<div class="main-content bg-clouds">

		<!-- begin .container-fluid -->
		<div class="container-fluid p-t-15">
			<div class="box b-a">
				<div class="box-body">
					<?php if (isset($_SESSION['system_msg'])) {
						echo $_SESSION['system_msg'];
						unset($_SESSION['system_msg']);
					} ?>
					<div class="row">
						<h2 class=m-l-15 style="font-size:2rem"><b>Thông tin đơn hàng : </b></h2>

						<div class="col-lg-6 p-b-15">
							<p><b>Tên khách hàng : </b><span><?php echo $order->customer_name; ?></span></p>
							<?php $time=strtotime($order->order_at);?>
                    <p class="mb-1"><b>Đặt hàng lúc : </b><span class="text-dark" style="font-weight:500"> <?php echo date('H:i:s',$time); ?></span></p> <p class="mb-1"><b>Ngày : </b> <?php echo date('d',$time); ?> - <?php echo date('m',$time); ?> - <?php echo date('Y',$time); ?> </p>
							<p><b>Đại chỉ giao hàng : </b><span><?php echo $order->address; ?></span></p>
							<p><b>Số ĐT: </b><span><?php echo $order->phone; ?></span></p>
							<p><b>Email : </b><span><?php echo $order->email; ?></span></p>
							<p><b>Số lượng sản phẩm : </b><span><?php echo $order->total_quantity; ?> món</span></p>
							<p><b>Tổng Tiền : </b><span><?php echo number_format($order->total_price,0); ?> VNĐ</span></p>
							<?php if ($order->cancelled == 0) : ?>
								<a href="<?php echo site_url('admin/order?act=status-upd&id=' . $_GET['id'] . "&cancelled=1&token=" . $this->data['infoLog']->token); ?>" class="change-status-btn btn btn-danger">Huỷ Đơn hàng <span class="nav-icon">
								<i class="fas fa-ban"></i>
									</span></a>
							<?php elseif ($order->cancelled == 1) : ?>
								<p class="btn btn-danger">Đơn hàng đã bị huỷ</p>
								<a href="<?php echo site_url('admin/order?act=status-upd&id=' . $_GET['id'] . "&cancelled=0&token=" . $this->data['infoLog']->token); ?>" class="change-status-btn btn btn-primary">Mở lại đơn hàng<span class="nav-icon">
										<i class="fa fa-fw fa-edit "></i>
									</span></a>
							<?php endif; ?>
						</div>
						<div class="col-lg-6 m-b-25">
							<p><b>Trạng Thái: </b></p>
							<?php if ($order->paid == 0) : ?>
								<p>Chưa Thanh Toán</p>
								<a href="<?php echo site_url('admin/order?act=status-upd&id=' . $_GET['id'] . "&paid=1&token=" . $this->data['infoLog']->token); ?>" class="change-status-btn btn btn-primary">Đổi Trạng Thái <span class="nav-icon">
										<i class="fa fa-fw fa-edit "></i>
									</span></a>
							<?php elseif ($order->paid == 1) : ?>
								<p>Đã Thanh Toán</p>
								<a href="<?php echo site_url('admin/order?act=status-upd&id=' . $_GET['id'] . "&paid=0&token=" . $this->data['infoLog']->token); ?>" class="change-status-btn btn btn-primary">Đổi Trạng Thái <span class="nav-icon">
										<i class="fa fa-fw fa-edit "></i>
									</span></a>
							<?php endif; ?>
							<hr>
							<?php if ($order->delivered == 0) : ?>
								<p>Chưa Giao Hàng</p>
								<a href="<?php echo site_url('admin/order?act=status-upd&id=' . $_GET['id'] . "&delivered=1&token=" . $this->data['infoLog']->token); ?>" class="change-status-btn btn btn-primary">Đổi Trạng Thái <span class="nav-icon">
										<i class="fa fa-fw fa-edit "></i>
									</span></a>
							<?php elseif ($order->delivered == 1) : ?>
								<p>Đã Giao Hàng</p>
								<a href="<?php echo site_url('admin/order?act=status-upd&id=' . $_GET['id'] . "&delivered=0&token=" . $this->data['infoLog']->token); ?>" class="change-status-btn btn btn-primary">Đổi Trạng Thái <span class="nav-icon">
										<i class="fa fa-fw fa-edit "></i>
									</span></a>
							<?php endif; ?>

						</div>
						<!-- <div class="col-lg-12">
							<hr>
						</div> -->

						<div class="col-lg-12 bg-clouds">
							<div class="row m-b-5 m-t-20 p-b-25 bg-white" style="box-shadow:0px 0px 2px lightgrey">
							<h2 class="m-l-15 m-t-10"style="font-size:2rem"><b>Chi tiết đơn hàng : </b></h2>
								<div class="col-md-2">

								</div>
								<div class="col-md-6">
									<b>Sản Phẩm</b>
								</div>
								<div class="col-md-1">
								<b>Qty</b>
								</div>
								<div class="col-md-1">
								<b>Giá</b>
								</div>
								<div class="col-md-2">
								<b>Tổng</b>
								</div>
							</div>
							<?php if($products):?>
							<?php //print_r($order_details);?>
							<?php foreach($products as $product):?>
							<div class="row m-b-5 p-t-20 p-b-20 bg-white" style="box-shadow:0px 0px 3px lightgrey">
								<div class="col-md-2">
									<img src="<?php echo base_url("assets/public/avatar/").$product->img1;?>" class=img-fluid>
								</div>
								<div class="col-md-6">
									<?php echo $product->name;?>
								</div>
								<div class="col-md-1">
								<?php echo $product->order_details['quantity'];?>
								</div>
								<div class="col-md-1">
								<?php echo number_format($product->order_details['price'],0);?> VNĐ
								</div>
								<div class="col-md-2">
								<?php echo number_format($product->order_details['price']*$product->order_details['quantity'],0);?> VNĐ
								</div>
							</div>
							<?php endforeach;?>
							<?php endif;?>
						</div>
					</div>
					<a href="<?php echo site_url('admin/order'); ?>" class="change-status-btn btn btn-primary m-t-10">Quay Về<span class="nav-icon">
										<i class="fa fa-fw fa-arrow-left "></i>
									</span></a>
				</div>
			</div>

		</div>
		<!-- END: .container-fluid -->

	</div>
	<!-- END: .main-content -->


</div>
<!-- END: .app-main -->