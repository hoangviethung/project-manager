<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew / Banner Quảng Cáo
				</h6>
				<h3 class="dashhead-title">Danh Sách Banner</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Banner Quảng Cáo / Danh Sách Banner
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
					<?php if (checkaction($this->data['cslug'], 'add')) { ?>
						<div class=""><a href="<?php echo site_url('admin/banner?act=upd&token=' . $infoLog->token) ?>" class="btn btn-primary pull-right m-b-15"><span class="fa fa-fw fa-plus"></span> New Banner</a></div>
					<?php } ?>
					<table data-plugin="datatables" class="table  table-hover" width="100%" cellspacing="0" style="margin-top:10px">
						<thead>
							<tr>
								<th>#</th>
								<th>Tên Banner</th>
								<th>Hình Ảnh</th>
								<th>Link dẫn ra ngoài</th>
								<th>Mô Tả</th>
								<th class='text-center'>Active / Inactive</th>

								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($banners) :
								foreach ($banners as $key => $obj) {
									?>
									<tr>
										<td width=2%><?php echo $key + 1 ?></td>
										<td width=15%>
											<?php echo $obj->name ?>
										</td>
										<td width="450px"><img class="img-fluid" src="<?php echo site_url("assets/public/avatar/") . $obj->img ?>" style="max-width:500px"></td>
										<td><?php echo $obj->link ?></td>
										<td><?php echo $obj->description ?></td>
										<td width=9% class='text-center'>

											<?php if ($obj->active == 0) : ?>
												<a href="<?php echo site_url('admin/banner?act=status-upd&id=' . $obj->id . "&active=1&token=" . $infoLog->token); ?>" class="" style="font-weight:600"> <span class="nav-icon text-danger" style="font-size:2.5rem">
														<i class="fas fa-toggle-off"></i>

													</span></a>
											<?php elseif ($obj->active == 1) : ?>
												<a href="<?php echo site_url('admin/banner?act=status-upd&id=' . $obj->id . "&active=0&token=" . $infoLog->token); ?>" class="" style="font-weight:600"> <span class="nav-icon text-primary" style="font-size:2.5rem">
														<i class="fas fa-toggle-on"></i>
													</span></a>
											<?php endif; ?>
										</td>

										<td width="180px" class='text-center'>
											<a href="<?php echo site_url('admin/banner?act=upd&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Edit" class="btn btn-primary">
												<span class="nav-icon">
													Sửa
													<i class="fa fa-fw fa-edit "></i>
												</span>
											</a>
											<a href="javascript:void(0);" title="Delete" id="btndelete" module="banner" data-id="<?php echo $obj->id ?>" data-toggle="modal" data-target="#deleteModal" class='btn btn-danger'>
												<span class="nav-icon">
													Xoá
													<i class="fa fa-fw fa-trash "></i>
												</span>
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

		<?php if (checkaction($this->data['cslug'], 'delete')) { ?>
			<div class="modal fade" id="deleteModal" tabindex="-2" role="dialog" aria-labelledby="deleteModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="deleteModalLabel">Xoá Banner</h4>
						</div>
						<div class="modal-body">
							<div class="md-content">
								Bạn có muốn xoá banner này?
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
							<a href="<?php echo site_url('admin/banner?act=del&id=' . $obj->id . "&token=" . $infoLog->token); ?>" id="confirmDelete" class="btn btn-primary">Xác nhận</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- END: .app-main -->