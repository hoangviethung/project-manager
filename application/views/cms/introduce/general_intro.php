<?php
$action = site_url('admin/introduce?act=upd&token='.$infoLog->token);
$image_01 = $obj&&$obj->img!=""?base_url('assets/public/avatar/'.$obj->img):base_url('assets/public/avatar/no-avatar.png');
?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Nguyên Quân / Giới thiệu
				</h6>
				<h3 class="dashhead-title">Quản lý thông tin chung</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Giới thiệu / Quản lý thông tin chung
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
					<?php if(isset($_SESSION['system_msg'])){ echo $_SESSION['system_msg'];unset($_SESSION['system_msg']); }?>
					<div class="row">
						<?php echo form_open_multipart($action,array('autocomplete'=>"off",'id'=>"userform"));?>
						<a href="<?php echo site_url('admin/introduce?act=history&token='.$infoLog->token)?>" type="button" class="btn btn-primary" style="float:right; margin-right:10px;">Lịch sử công ty</a>

                            <div class="col-md-12">
								<div class="form-group">
									<label>Ảnh đại diện (Hình ảnh hiển thị đẹp nhất với kích thước: ngang 1440px x cao 500px)</label>
									<div>
										<input type="hidden" name="img" value="<?php echo $obj?$obj->img:"";?>"/>
										<img id="imgFile_01" style="width:600px; height:200px" class="imgFile" alt="Avatar" src="<?php echo $image_01;?>" />
										<input type="file" name="image_01" id="chooseImgFile" onchange="document.getElementById('imgFile_01').src = window.URL.createObjectURL(this.files[0])">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Slug</label>
									<input type="text" class="form-control" name="slug" id="slug" required value="<?php echo $obj?$obj->slug:"";?>"/>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Slogan</label>
									<input type="text" class="form-control" name="slogan" id="slogan" required value="<?php if(isset($obj->slogan)) echo $obj->slogan;?>"/>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Mô tả chung</label>
									<textarea id="content" class="form-control" name="short_des" id="short_des" ><?php if(isset($obj->short_des)) echo $obj->short_des;?></textarea>
								</div>
								<script>
									var editor = CKEDITOR.replace('short_des',{
										language:'vi',
										filebrowserBrowseUrl :'<?php echo base_url()."filemanager/ckfinder/ckfinder.html"?>',

										filebrowserImageBrowseUrl : '<?php echo base_url()."filemanager/ckfinder/ckfinder.html?type=Images"?>',
										
										filebrowserFlashBrowseUrl : '<?php echo base_url()."filemanager/ckfinder/ckfinder.html?type=Flash"?>',
										
										filebrowserUploadUrl : '<?php echo base_url()."filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
										
										filebrowserImageUploadUrl : '<?php echo base_url()."filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"?>',
										
										filebrowserFlashUploadUrl : '<?php echo base_url()."filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"?>',

									});
                        		</script>
							</div>
							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Mô giới thiệu công ty</label>
									<textarea id="content" class="form-control" name="detail_des" id="detail_des" ><?php if(isset($obj->detail_des)) echo $obj->detail_des;?></textarea>
								</div>
								<script>
									var editor = CKEDITOR.replace('detail_des',{
										language:'vi',
										filebrowserBrowseUrl :'<?php echo base_url()."filemanager/ckfinder/ckfinder.html"?>',

										filebrowserImageBrowseUrl : '<?php echo base_url()."filemanager/ckfinder/ckfinder.html?type=Images"?>',
										
										filebrowserFlashBrowseUrl : '<?php echo base_url()."filemanager/ckfinder/ckfinder.html?type=Flash"?>',
										
										filebrowserUploadUrl : '<?php echo base_url()."filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
										
										filebrowserImageUploadUrl : '<?php echo base_url()."filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"?>',
										
										filebrowserFlashUploadUrl : '<?php echo base_url()."filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"?>',

									});
                        		</script>
							</div>
							
							
							<div class="clearfix"></div>
							<div class="col-md-3">
								<a class="btn btn-default" href="<?php echo site_url('admin/introduce');?>">Quay lại</a>
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