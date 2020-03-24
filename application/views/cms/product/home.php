<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew / Danh sách sản phẩm
				</h6>
				<h3 class="dashhead-title">Danh sách sản phẩm</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Sản phẩm / Danh sách sản phẩm
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
						<div class="p-b-15"><a href="<?php echo site_url('admin/product?act=upd&token=' . $infoLog->token) ?>" class="btn btn-primary pull-right m-b-10"><span class="fa fa-fw fa-plus"></span> Thêm mới sản phẩm</a></div>
					<?php } ?>
					<table data-plugin="datatables" class="table table-hover display" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Tên Sản Phẩm</th>
								<th>Danh Mục</th>
								<th>Loại Sản Phẩm</th>
								<th>Giá</th>
								<th>Hình Ảnh</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($product) :
								foreach ($product as $key => $obj) {
									?>
									<tr>
										<td><?php echo $key + 1 ?>
										<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal<?php echo $obj->id;?>">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Upload List Hình Ảnh</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														
														<?php echo form_open_multipart(site_url('admin/product?act=save_img&product_id=' . $obj->id . "&token=" . $infoLog->token), array('autocomplete' => "off", 'id' => "userform".$obj->id)); ?>
														
														<img id="imgFile_01" class="imgFile img-fluid" alt="Avatar" src="<?php echo base_url('assets/public/avatar/no-avatar.png');?>" style="width:100px"/>
														<div class="img_input">
														</div>
														<input type="file" name="image[]" id="chooseImgFile" multiple="multiple"  onchange="uploadMultiple(this.files)" style="height:100px;width:100px;">
														<script>
															function uploadMultiple(files) {
																var i;
																for (i = 0; i < files.length; i++) {
																	var fileUrl = window.URL.createObjectURL(files[i]);
																	var file = '<img class="imgFile img-fluid" alt="Avatar" src="' + fileUrl + '" style="max-width:100px;margin-right:10px;border:1px solid black;"/>'
																	$('.img_input').append(file);
																}
															}
														</script>
														<button type="submit" id="formSubmit" class="btn btn-primary m-t-10">Submit</button>
													</div>
													
													<?php echo form_close(); ?>
												</div>
											</div>
										</div>
										</td>
										<td>
											<?php echo $obj->name ?>
										</td>
										<td><?php echo $obj->category_name ?>
											<?php echo $obj->category_deleted==1?'<p class="bg-danger" style="padding:5px;text-align:center">Danh Mục Đã Bị Xoá</p>':'';?>
										</td>

										<td>
											<p class=><span style="line-height:47px">Mới</span>
												<?php if ($obj->new == 0) : ?>
													<a href="<?php echo site_url('admin/product?act=status-upd&id=' . $obj->id . "&new=1&token=" . $infoLog->token); ?>" class="btn text-primary" style="font-size:2rem"><i class="fas fa-toggle-off"></i></a>
												<?php elseif ($obj->new == 1) : ?>
													<a href="<?php echo site_url('admin/product?act=status-upd&id=' . $obj->id . "&new=0&token=" . $infoLog->token); ?>" class="btn text-primary" style="font-size:2rem"><i class="fas fa-toggle-on"></i></a>
												<?php endif; ?>
											</p>

											<p><span style="line-height:47px">Sale</span>
												<?php if ($obj->sale == 0) : ?>
													<a href="<?php echo site_url('admin/product?act=status-upd&id=' . $obj->id . "&sale=1&token=" . $infoLog->token); ?>" class="btn text-danger" style="font-size:2rem"><i class="fas fa-toggle-off"></i></a>
												<?php elseif ($obj->sale == 1) : ?>
													<a href="<?php echo site_url('admin/product?act=status-upd&id=' . $obj->id . "&sale=0&token=" . $infoLog->token); ?>" class="btn text-danger" style="font-size:2rem"><i class="fas fa-toggle-on"></i></a>
												<?php endif; ?>
											</p>

											<p><span style="line-height:47px">Còn Hàng</span>
												<?php if ($obj->remained == 0) : ?>
													<a href="<?php echo site_url('admin/product?act=status-upd&id=' . $obj->id . "&remained=1&token=" . $infoLog->token); ?>" class="btn text-danger" style="font-size:2rem"><i class="fas fa-toggle-off"></i></a>
												<?php elseif ($obj->remained == 1) : ?>
													<a href="<?php echo site_url('admin/product?act=status-upd&id=' . $obj->id . "&remained=0&token=" . $infoLog->token); ?>" class="btn text-danger" style="font-size:2rem"><i class="fas fa-toggle-on"></i></a>
												<?php endif; ?>
											</p>
										</td>
										<td>
											<p>Giá Nguyên : <?php echo number_format($obj->price, 0) ?> VNĐ</p>
											<p class=text-danger>Giá Giảm : <?php echo number_format($obj->discount_price, 0) ?> VNĐ</p>
										</td>
										
										<td style="width:450px">
											<img class="img-fluid" src="<?php echo base_url('assets/public/avatar/') . $obj->img1 ?>">
										</td>
										<td>
											<a href="<?php echo site_url('admin/product?act=upd&id=' . $obj->id . "&token=" . $infoLog->token); ?>" title="Edit" class='btn btn-primary'>
												<span class="nav-icon">
													Sửa
													<i class="fa fa-fw fa-edit "></i>
												</span>
											</a>
											<a href="javascript:void(0);" title="Delete" id="btndelete" module="product" data-id="<?php echo $obj->id ?>" data-toggle="modal" data-target="#deleteModal" class='btn btn-danger'>
												<span class="nav-icon">
													Xoá
													<i class="fa fa-fw fa-trash"></i>
												</span>
											</a>

											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $obj->id;?>">
												Up Nhiều Hình
												</button>
												<a href="<?php echo site_url('admin/product?act=show_img&id=' . $obj->id . "&token=" . $infoLog->token);?>" class="btn btn-primary">List Hình Ảnh</a>
										</td>
									</tr>
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

		<?php if (checkaction($this->data['cslug'], 'delete')) { ?>
			<div class="modal fade" id="deleteModal" tabindex="-2" role="dialog" aria-labelledby="deleteModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="deleteModalLabel">Xoá sản phẩm</h4>
						</div>
						<div class="modal-body">
							<div class="md-content">
								Bạn muốn xoá sản phảm?
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
							<a href="<?php echo site_url('admin/product?act=del&id=' . $obj->id . "&token=" . $infoLog->token); ?>" id="confirmDelete" class="btn btn-primary">Xác nhận</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- END: .app-main -->