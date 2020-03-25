<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew / Danh sách danh mục
				</h6>
				<h3 class="dashhead-title">Danh sách danh mục</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Danh mục / Danh sách danh mục
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
						<?php if (isset($id)) : ?>
							<div class="p-b-15"><a href="<?php echo site_url('admin/category?act=upd&parent=' . $id . '&token=' . $infoLog->token) ?>" class="btn btn-primary pull-right m-b-10"><span class="fa fa-fw fa-plus"></span>Thêm mới danh mục</a></div>
						<?php else : ?>
							<div class="p-b-15"><a href="<?php echo site_url('admin/category?act=upd&token=' . $infoLog->token) ?>" class="btn btn-primary pull-right m-b-10"><span class="fa fa-fw fa-plus"></span>Thêm mới danh mục</a></div>
						<?php endif; ?>

					<?php } ?>
					<table data-plugin="datatables" class="table table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
								<!-- <th>#</th> -->
								<th>Danh Mục</th>
								<th class='text-center'>Active / Inactive</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($category) :
								foreach ($category as $key => $obj) {
									?>
									<tr>
										<?php if ($obj->level == 0) { ?>
											<!-- <td><?php echo $key + 1 ?></td> -->
											<td class='p-t-20'>
												<div class="category-item-wrap"style="padding:0 0px 0px 15px">
													<div class='text-right'><span class='pull-left' style="line-height:34px;font-weight:700"><?php echo $obj->name ?></span>
													<a href="<?php echo site_url('admin/category?act=upd&parent_1=' . $obj->id . "&level=1&token=" . $infoLog->token); ?>" title="New" class='btn btn-success pull-left m-l-15'>
													<span class="nav-icon">
																		<i class="fa fa-fw fa-plus "></i>
																		<!-- <i class="fas fa-arrow-down"> </i>  -->
																	 </span>
															Danh Mục Con Cấp 2
														</a>
														<a href="<?php echo site_url('admin/category?act=upd&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Edit" class="btn btn-primary" style="margin-left:auto">
															Sửa
															<span class="nav-icon">
																<i class="fa fa-fw fa-edit "></i>
															</span>
														</a>

														<a href="javascript:void(0);" title="Delete" id="btndelete" module="category" data-id="<?php echo $obj->id ?>" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
														Xoá
													<span class="nav-icon">
														<i class="fa fa-fw fa-trash "></i>
													</span>
												</a>
													</div>
												</div>
												<ul style="list-style:none;margin:20px 0px 20px 20px;">
													<?php foreach ($category as $key => $child_1) { ?>
														<?php if ($child_1->parent_1 == $obj->id && $child_1->level == 1) { ?>
															<li class="text-right">
																<div class="category-item-wrap" style="padding:0 0px 0px 15px">
																<span class='pull-left text-dark' style="line-height:34px;font-weight:600">
																- <?php echo $child_1->name; ?>
															</span>
																<a href="<?php echo site_url('admin/category?act=upd&parent_1=' . $obj->id . "&parent_2=" . $child_1->id . "&level=2&token=" . $infoLog->token); ?>" title="New" class="btn btn-success pull-left m-l-15">
																<span class="nav-icon">
																		<i class="fa fa-fw fa-plus "></i>
																		<!-- <i class="fas fa-arrow-down"> </i>  -->
																	 </span>
																	 Danh Mục Con Cấp 3

																</a>
																<a href="<?php echo site_url('admin/category?act=upd&id=' . $child_1->id . "&token=" . $infoLog->token); ?>" title="Edit" class="btn btn-primary">
																	Sửa
																	<span class="nav-icon">
																		<i class="fa fa-fw fa-edit "></i>
																	</span>
																</a>

																<a href="javascript:void(0);" title="Delete" id="btndelete" module="category" data-id="<?php echo $child_1->id ?>" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
																	Xoá
																	<span class="nav-icon">
																		<i class="fa fa-fw fa-trash "></i>
																	</span>
																</a>
														</div>
																<ul style="list-style:none;margin:20px 0px 20px 20px;">

																	<?php foreach ($category as $key => $child_2) { ?>
																		<?php if ($child_2->parent_2 == $child_1->id) { ?>
																			<li class='m-t-15 category-item-wrap' style="padding:0 0px 0px 15px">
																			<span class='pull-left text-dark' style="line-height:34px;font-weight:500"> - - <?php echo $child_2->name; ?></span>
																				<a href="<?php echo site_url('admin/category?act=upd&id=' . $child_2->id . "&token=" . $infoLog->token); ?>" title="Edit" class='btn btn-primary'>
																					Sửa
																					<span class="nav-icon">
																						<i class="fa fa-fw fa-edit "></i>
																					</span>
																				</a>
																				<a href="javascript:void(0);" title="Delete" id="btndelete" module="category" data-id="<?php echo $child_2->id ?>" data-toggle="modal" data-target="#deleteModal" class='btn btn-danger'>
																					Xoá
																					<span class="nav-icon">
																						<i class="fa fa-fw fa-trash "></i>
																					</span>
																				</a></li>
																		<?php } ?>
																	<?php } ?>
																</ul>

															</li>
														<?php } ?>
													<?php } ?>
												</ul>

											</td>
											<td class='p-t-20 text-center' width=10%>

												<?php if ($obj->active == 1) : ?>
													<a href="<?php echo site_url('admin/category?act=lock&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Lock" class="text-primary">
													
														<span class="nav-icon" style="font-size:2.5rem">
														<i class="fas fa-toggle-on"></i>
														</span>
													</a>
												<?php else : ?>
													<a href="<?php echo site_url('admin/category?act=unlock&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Unlock" class='text-danger'>
													
														<span class="nav-icon" style="font-size:2.5rem">
														<i class="fas fa-toggle-off"></i>

														</span>
													</a>
												<?php endif; ?>
												<!-- <a href="javascript:void(0);" title="Delete" id="btndelete" module="category" data-id="<?php echo $obj->id ?>" data-toggle="modal" data-target="#deleteModal">
													<span class="nav-icon">
														<i class="fa fa-fw fa-trash "></i>
													</span>
												</a> -->

											</td>
										<?php } ?>
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
							<h4 class="modal-title" id="deleteModalLabel">Xoá danh mục</h4>
						</div>
						<div class="modal-body">
							<div class="md-content">
								Bạn muốn xoá danh mục?
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
							<a href="#" id="confirmDelete" class="btn btn-primary">Xác nhận</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- END: .app-main -->