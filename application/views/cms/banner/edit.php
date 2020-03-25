<?php
$action = $obj?site_url('admin/banner?act=upd&id='.$obj->id."&token=".$infoLog->token):site_url('admin/banner?act=upd&token='.$infoLog->token);
$image_01 = $obj&&$obj->image_01!=""?base_url('assets/public/avatar/'.$obj->image_01):base_url('assets/public/avatar/no-avatar.png');

?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					La Jew / Banner Quảng Cáo
					<h3 class="dashhead-title">Sửa Banner Quảng Cáo</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Banner Quảng Cáo
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
						<input type="hidden" id="id" name="id" value="<?php echo $obj?$id:" " ?>">
						<div class="col-md-4">
							<div class="form-group required">
								<label class="control-label">Tên Banner</label>
								<input type="text" class="form-control" name="name" id="name" required value="<?php echo $obj?$obj->name:" ";?>"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group required">
								<label class="control-label">Link dẫn ra ngoài</label>
								<input type="text" class="form-control" name="link" id="link" value="<?php echo $obj?$obj->link:" ";?>"/>
							</div>
						</div>

						<div class="col-md-8">
							<div class="form-group required">
								<label class="control-label">Mô Tả Banner</label>
								<textarea type="text" class="form-control" rows=5 name="description" id="description"><?php echo $obj?$obj->description:"";?></textarea>
							</div>
							<script>
								var editor = CKEDITOR.replace('description',{
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
						<div class="col-md-4">
							<div class="form-group">
								<label>Hình 1 (tỷ lệ khuyên dùng : 21/9, chiều cao tối đa : 816px)</label>
								<div>
									<img id="imgFile_01" class="imgFile" alt="Avatar" src="<?php echo $obj?site_url('assets/public/avatar/'.$obj->img):"";?>" />
									<input type="file" name="image_01" id="chooseImgFile" onchange="document.getElementById('imgFile_01').src = window.URL.createObjectURL(this.files[0])">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Trạng Thái</label>
								<select name="active" class="form-control">
									<option value="1" <?php echo $obj&&$obj->active==1?"selected":""?> >Active</option>
									<option value="0" <?php echo $obj&&$obj->active==0?"selected":""?> >Inactive</option>
								</select>
							</div>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-3">
							<a class="btn btn-default" href="<?php echo site_url('admin/banner');?>">Back</a>
							<button type="reset" class="btn btn-warning">Reset</button>
							<button type="submit" id="formSubmit" class="btn btn-primary">Submit</button>
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