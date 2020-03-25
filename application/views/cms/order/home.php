<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Lajew / Danh sách Đơn Hàng <strong><?php if (isset($cat_parent)) echo $cat_parent->name ?> </strong>
				</h6>
				<h3 class="dashhead-title">Danh sách Đơn Hàng <strong><?php if (isset($cat_parent)) echo $cat_parent->name ?> </strong></h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Đơn Hàng / Danh sách Đơn Hàng <strong><?php if (isset($cat_parent)) echo $cat_parent->name ?> </strong>
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

					<table data-plugin="datatables" class="table  table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Mã Đơn</th>
								<th>Tên Khách Hàng</th>
								<th>Địa Chỉ</th>
								<th>Số ĐT</th>
								<th>Email</th>
								<th>Thanh Toán</th>
								<th>Giao Hàng</th>
								<th>Thời Gian Đặt Hàng</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($orders) :
								foreach ($orders as $key => $obj) {
									?>

									<tr>
										<td><?php echo $key + 1 ?></td>
										<td><?php echo !empty($obj->order_code)?$obj->order_code:"Đơn hàng lỗi" ?></td>
										<td>
											<a href="<?php echo site_url('admin/order?act=child_list&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Đơn Hàng Chi Tiết">
												<span><?php echo $obj->customer_name ?></span>
											</a>
										</td>
										<td>
											<?php echo $obj->address ?>
										</td>
										<td>
											<?php echo $obj->phone ?>
										</td>
										<td>
											<?php echo $obj->email ?>
										</td>
										<td>
											<?php if ($obj->paid == 1) : ?>
												Đã Thanh Toán
											<?php else : ?>
												Chưa Thanh Toán
											<?php endif; ?>
										</td>
										<td> <?php if ($obj->delivered == 1) : ?>
												Đã Giao
											<?php else : ?>
												Chưa Giao
											<?php endif; ?>
										</td>
										<td>
											<?php echo date('d-m-Y H:i:s',strtotime($obj->order_at)); ?>
										</td>
										<td>
										<?php if ($obj->cancelled == 1) : ?>
										<p class="btn btn-danger">Đơn hàng đã bị huỷ</p>
										<?php endif; ?>
										
											<a href="<?php echo site_url('admin/order?act=child_list&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Đơn Hàng Chi Tiết" class='btn btn-primary'>
											Chi Tiết
												<span><i class="fa fa-fw fa-edit m-l-5"></i></span>
											</a>
										</td>
									</tr>
							<?php }
							endif; ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
		<!-- END: .container-fluid -->
		<!-- 
	</div> -->
		<!-- END: .main-content -->

	</div>
</div>
<!-- END: .app-main -->