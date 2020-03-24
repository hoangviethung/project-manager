<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew / Danh sách sản phẩm <?php echo $obj?$obj->name:"";?>
				</h6>
				<h3 class="dashhead-title">Danh sách hình ảnh sản phẩm <?php echo $obj?$obj->name:"";?></h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Sản phẩm / Danh sách hình ảnh sản phẩm <?php echo $obj?$obj->name:"";?>
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
								<th>Hình Ảnh</th>
								<th></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if ($images) :
								foreach ($images as $key => $obj) {
									?>
									<?php if($obj->main==1):?>
									<tr>
										
										<td style="max-width:400px">
											<img class="img-fluid" src="<?php echo base_url('assets/public/avatar/') . $obj->image_file ?>" style="max-width:600px">
										</td>
										<td><p class="btn btn-primary">Hình Đại Diện Cho Sản Phẩm</p></td>
										<td>
											<a href="javascript:void(0);" title="Delete" id="btndelete" module="product"  data-toggle="modal" data-target="#deleteModal<?php echo $obj->id;?>" class='btn btn-danger'>
												<span class="nav-icon">
													Xoá
													<i class="fa fa-fw fa-trash"></i>
												</span>
											</a>
											<div class="modal fade" id="deleteModal<?php echo $obj->id;?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h4 class="modal-title" id="deleteModalLabel">Xoá Hình Ảnh</h4>
														</div>
														<div class="modal-body">
															<div class="md-content">
																Bạn muốn xoá hình ảnh?
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
															<a href="<?php echo site_url('admin/product?act=delete_img&id=' . $obj->id . "&deleted=1&product_id=".$_GET['id']."&token=" . $infoLog->token); ?>" class="btn btn-primary">Xác nhận</a>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
								<?php endif;?>
							<?php }
							endif; ?>

							<?php if ($images) :
								foreach ($images as $key => $obj) {
									?>
									<?php if($obj->main==0):?>
									<tr>
										
										<td style="max-width:400px">
											<img class="img-fluid" src="<?php echo base_url('assets/public/avatar/') . $obj->image_file ?>" style="max-width:600px">
										</td>
										<td></td>
										<td>
											<a href="javascript:void(0);" title="Delete" id="btndelete" module="product"  data-toggle="modal" data-target="#deleteModal<?php echo $obj->id;?>" class='btn btn-danger'>
												<span class="nav-icon">
													Xoá
													<i class="fa fa-fw fa-trash"></i>
												</span>
											</a>
											<div class="modal fade" id="deleteModal<?php echo $obj->id;?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h4 class="modal-title" id="deleteModalLabel">Xoá Hình Ảnh</h4>
														</div>
														<div class="modal-body">
															<div class="md-content">
																Bạn muốn xoá hình ảnh?
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
															<a href="<?php echo site_url('admin/product?act=delete_img&id=' . $obj->id . "&deleted=1&product_id=".$_GET['id']."&token=" . $infoLog->token); ?>" class="btn btn-primary">Xác nhận</a>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
								<?php endif;?>
							<?php }
							endif; ?>

						</tbody>

					</table>
					<?php echo isset($links) ? $links : "" ?>
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