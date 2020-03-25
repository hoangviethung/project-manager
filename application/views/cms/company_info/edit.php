<?php
$action = $obj?site_url('admin/companyInfo?act=upd&token='.$infoLog->token):site_url('admin/companyInfo?act=upd&token='.$infoLog->token);

?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Nguyên Quân / Thông tin công ty
					<h3 class="dashhead-title">Sửa Thông tin công ty</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Thông tin công ty
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
						<?php foreach($infos as $obj):?>
						<div class="col-md-4">
							<div class="form-group required">
								<label class="control-label"><?php echo $obj?$obj->info:'';?></label>
								<input type="text" class="form-control" name="<?php echo $obj?$obj->info:'';?>" id="<?php echo $obj?$obj->info:'';?>" required value="<?php echo $obj?$obj->value:" ";?>"/>
							</div>
						</div>
						<?php endforeach;?>
						<div class="clearfix"></div>
						<div class="col-md-3">
							<a class="btn btn-default" href="<?php echo site_url('admin/companyInfo');?>">Back</a>
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