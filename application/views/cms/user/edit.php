<?php
$action = $obj?site_url('admin/user?act=upd&id='.$obj->id."&token=".$infoLog->token):site_url('admin/user?act=upd&token='.$infoLog->token);
// $avatar = $obj&&$obj->avatar!=""?base_url('assets/public/avatar/'.$obj->avatar):base_url('assets/public/avatar/no-avatar.png');
?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Nguyên Quân / Tài khoản
				</h6>
				<h3 class="dashhead-title">Tài khoản</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Tài khoản
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
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Tên đăng nhập </label>
									<input type="text" class="form-control" name="username" id="username" required value="<?php echo $obj?$obj->username:"";?>" <?php echo $obj?"readonly":""?> />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Email </label>
									<input type="text" class="form-control" name="email" id="email" required value="<?php echo $obj?$obj->email:"";?>"/>
								</div>
							</div>
						<?php if(!$obj):?>
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Mật Khẩu </label> <span id="pass-msg" class="text-danger hide">Mật khẩu ít nhất là 6 ký tự</span>
									<input type="password" class="form-control" name="password" id="password" required minlength="6" onchange="checkPassword()" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Nhập lại mật khẩu </label> <span id="cfpass-msg" class="text-danger hide">Password not match</span>
									<input type="password" class="form-control" name="cfpassword" id="cfpassword" required minlength="6" onchange="checkCfPass()" />
								</div>
							</div>
						<?php endif?>
							<div class="col-md-6">
								<div class="form-group required">
									<label class="control-label">Họ và tên </label>
									<input type="text" class="form-control" name="full_name" id="full_name" required value="<?php echo $obj?$obj->full_name:"";?>" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone </label>
									<input type="text" class="cleave-phone form-control" name="phone" value="<?php echo $obj?$obj->phone:""?>">
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-3">
								<a class="btn btn-default" href="<?php echo site_url('admin/user');?>">Quay lại</a>
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