<?php
if(isset($parent)){
	$action = site_url('admin/category?act=upd&parent='.$parent."&token=".$infoLog->token);
}else{
	$action = $obj?site_url('admin/category?act=upd&id='.$obj->id."&token=".$infoLog->token):site_url('admin/category?act=upd&token='.$infoLog->token);
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
					La Jew <strong><?php if($parent_1 != 0) echo "/ ".$parent_1_data->name ?> </strong> <strong><?php if($parent_2!=0) echo "/ ".$parent_2_data->name ?> </strong>
				</h6>
				<h3 class="dashhead-title"><strong><?php if($parent_1 != 0) echo $parent_1_data->name ?> </strong> <strong><?php if($parent_2!=0) echo "/ ".$parent_2_data->name ?> </strong></h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					<strong><?php if($parent_1 != 0) echo $parent_1_data->name ?> </strong> <strong><?php if($parent_2!=0) echo "/ ".$parent_2_data->name ?> </strong>
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
							<input type="hidden" id="id" name="id" value="<?php echo $obj?$id:"" ?>">
							<input type="hidden" id="level" name="level" value="<?php echo $obj?$obj->level:$level ?>">
							<input type="hidden" id="parent_1" name="parent_1" value="<?php echo $obj?$obj->parent_1:$parent_1 ?>">
							<input type="hidden" id="parent_2" name="parent_2" value="<?php echo $obj?$obj->parent_2:$parent_2 ?>">
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Tên danh mục</label>
									<input type="text" class="form-control" name="name" id="name" required value="<?php echo $obj?$obj->name:"";?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Slug</label>
									<input type="text" class="form-control" name="slug" id="slug" disabled value="<?php echo $obj?$obj->slug:"";?>"/>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group required">
									<label class="control-label">Mô tả ngắn</label>
									<textarea id="content" class="form-control" name="description" required id="description" ><?php echo $obj?$obj->description:"";?></textarea>
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
							<div class="clearfix"></div>
							<div class="col-md-3">
								<a class="btn btn-default" href="<?php echo site_url('admin/category');?>">Quay lại</a>
								<button type="reset" class="btn btn-warning">Huỷ</button>
								<button type="submit" id="formSubmit" class="btn btn-primary">Lưu</button>
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