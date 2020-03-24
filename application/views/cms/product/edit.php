<?php
$action = $obj ? site_url('admin/product?act=upd&id=' . $obj->id . "&token=" . $infoLog->token) : site_url('admin/product?act=upd&token=' . $infoLog->token);
$image_01 = $obj && $obj->img1 != "" ? base_url('assets/public/avatar/' . $obj->img1) : base_url('assets/public/avatar/no-avatar.png');
$image_02 = $obj && $obj->img2 != "" ? base_url('assets/public/avatar/' . $obj->img2) : base_url('assets/public/avatar/no-avatar.png');
$image_03 = $obj && $obj->img3 != "" ? base_url('assets/public/avatar/' . $obj->img3) : base_url('assets/public/avatar/no-avatar.png');
$image_04 = $obj && $obj->img4 != "" ? base_url('assets/public/avatar/' . $obj->img4) : base_url('assets/public/avatar/no-avatar.png');
$image_05 = $obj && $obj->img4 != "" ? base_url('assets/public/avatar/' . $obj->img5) : base_url('assets/public/avatar/no-avatar.png');
?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew / Sản phẩm
				</h6>
				<h3 class="dashhead-title">Danh sách sản phẩm</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Sản phẩm
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
						<?php echo form_open_multipart($action, array('autocomplete' => "off", 'id' => "userform")); ?>
						<input type="hidden" id="id" name="id" value="<?php echo $obj ? $id : "" ?>">
						<div class="col-md-5">
							<div class="form-group required">
								<label class="control-label">Tên Sản Phẩm</label>
								<input type="text" class="form-control" name="name" id="name" required value="<?php echo $obj ? $obj->name : ""; ?>" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Danh Mục SP</label>
								<select name="category" class="form-control">
								<option selected disabled>Danh Mục</option>
									<?php foreach ($cates as $parent_1) : ?>
										<?php if ($parent_1->level == 0) : ?>
										<option value='<?php echo $parent_1->id ?>' label="<?php echo $parent_1->name;?>" <?php echo $obj&&$obj->category==$parent_1->id?"selected":"";?> style="font-weight:600"><?php echo $parent_1->name ?></option>
											<?php foreach ($cates as $parent_2) : ?>
												<?php if ($parent_2->level == 1 && $parent_1->id == $parent_2->parent_1) : ?>
												<option value='<?php echo $parent_2->id ?>' label="<?php echo $parent_2->name;?>" <?php echo $obj&&$obj->category==$parent_2->id?"selected":"";?> style="font-weight:600">+ <?php echo $parent_2->name ?></option>
													<?php foreach ($cates as $cate) : ?>
														<?php if ($cate->level == 2 && $parent_2->id == $cate->parent_2) : ?>
															<option value='<?php echo $cate->id ?>' <?php echo $obj&&$obj->category==$cate->id?"selected":"";?> label="<?php echo $cate->name;?>">-- <?php echo $cate->name ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group required">
								<label class="control-label">Slug</label>
								<input type="text" class="form-control" name="slug" id="slug" disabled value="<?php echo $obj ? $obj->slug : ""; ?>" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group required">
								<label class="control-label">Giá</label>
								<input type="number" class="form-control" name="price" id="price" value="<?php echo $obj ? $obj->price : ""; ?>" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group required">
								<label class="control-label">Hàng Giảm Giá</label>
								<select name=sale class=form-control>
									<option value=0 <?php echo $obj&&$obj->sale==0 ? "selected" : ""; ?>>Không</option>
									<option value=1 <?php echo $obj&&$obj->sale==1 ? "selected" : ""; ?>>Có</option>
								</select>

							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group required">
								<label class="control-label">Giá đã giảm</label>
								<input type="number" class="form-control" name="discount_price" id="discount_price" value="<?php echo $obj ? $obj->discount_price : ""; ?>" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group required">
								<label class="control-label">Hàng Mới</label>
								<select name=new class=form-control>
									<option value=0 <?php echo $obj&&$obj->new==0 ? "selected" : ""; ?>>Không</option>
									<option value=1 <?php echo $obj&&$obj->new==1 ? "selected" : ""; ?>>Có</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group required">
								<label class="control-label">Trạng Thái</label>
								<select name=remained class=form-control>
									<option value=0 <?php echo $obj&&$obj->remained==0 ? "selected" : ""; ?>>Hết Hàng</option>
									<option value=1 <?php echo $obj&&$obj->remained==1 ? "selected" : ""; ?>>Còn Hàng</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group required">
								<label class="control-label">Mô Tả Chi Tiết Sản Phẩm</label>
								<textarea id="content" class="form-control" name="description" id="short_des"><?php echo $obj ? $obj->description : ""; ?></textarea>
							</div>
							<script>
								var editor = CKEDITOR.replace('description', {
									language: 'vi',
									filebrowserBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html" ?>',

									filebrowserImageBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html?type=Images" ?>',

									filebrowserFlashBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html?type=Flash" ?>',

									filebrowserUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files" ?>',

									filebrowserImageUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images" ?>',

									filebrowserFlashUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash" ?>',

								});
							</script>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Hình Đại Diện</label>
								<div>
									<img id="imgFile_01" class="imgFile" alt="Avatar" src="<?php echo $image_01 ?>" />
									<input type="file" name="image_01" id="chooseImgFile" onchange="document.getElementById('imgFile_01').src = window.URL.createObjectURL(this.files[0])" style="width:300px;height:300px;">
								</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						<div class="col-md-3">
							<a class="btn btn-default" href="<?php echo site_url('admin/product'); ?>">Quay lại</a>
							<button type="reset" class="btn btn-warning">Reset</button>
							<button type="submit" id="formSubmit" class="btn btn-primary">Gửi</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>

		</div>
		<!-- END: .container-fluid -->

	</div>
	<!-- END: .main-content -->


</div>
<!-- END: .app-main -->