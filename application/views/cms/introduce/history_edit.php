<?php
if(isset($id)){
	$action = site_url('admin/introduce?act=upd_history&id='.$id.'&token='.$infoLog->token);
}else{
	$action = site_url('admin/introduce?act=new_history&token='.$infoLog->token);
}
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
					Nguyên Quân / Lịch sử hình thành
				</h6>
				<h3 class="dashhead-title">Lịch sử hình thành</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Lịch sử hình thành
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
                            <div class="col-md-12">
								<div class="form-group">
									<label>Hình ảnh (hiển thị đẹp nhất với kích thước: ngang 260px x 170px)</label>
									<div>
										<input type="hidden" name="History[img]" value="<?php echo $image_01?>"/>
										<img id="imgFile_01" class="imgFile" alt="Avatar" src="<?php if(isset($image_01)) echo $image_01;?>" />
										<input type="file" name="image_01" id="chooseImgFile" onchange="document.getElementById('imgFile_01').src = window.URL.createObjectURL(this.files[0])">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Title</label>
									<input type="text" class="form-control" name="History[title]" id="title" required value="<?php if(isset($obj->title)) echo $obj->title;?>"/>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Mô tả chung</label>
									<textarea id="content" class="form-control" name="History[des]" required id="des" ><?php if(isset($obj->des)) echo $obj->des;?></textarea>
								</div>
								<script>
									var editor = CKEDITOR.replace('History[des]',{
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
									<label class="control-label">Thời gian</label>
									<textarea id="content" class="form-control" name="History[time]" required id="time" ><?php if(isset($obj->time)) echo $obj->time;?></textarea>
								</div>
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