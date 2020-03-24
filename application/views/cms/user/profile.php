<?php
	$avatar = $obj&&$obj->avatar!=""?base_url('assets/public/avatar/'.$obj->avatar):base_url('assets/public/avatar/no-avatar.png');
?>
<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Tài khoản / Thông tin tài khoản
				</h6>
				<h3 class="dashhead-title"><?php echo $obj->fullname;?></h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Tài khoản / <?php echo $obj->fullname;?>
			</div>
		</div>
		<!-- END: dashhead -->
	</header>
	<!-- END: .main-heading -->

	<!-- begin .main-content -->
	<div class="main-content bg-clouds">

		<!-- begin .container-fluid -->
		<div class="container-fluid p-t-15">
			<div class="row">
				<div class="col-md-5">
					<form method="post" id="updateInfoProfile" class="box shadow-2dp b-r-2" action="<?php echo site_url('admin/user?act=upro&id='.$obj->id.'&token='.$infoLog->token);?>">
						<input type="hidden" name="typeUpd" value="I">
						<header class="b-b">
							<h4>Infomation</h4>
						</header>
						<div class="box-body">
							<?php if(isset($_SESSION['system_msg'])){ echo $_SESSION['system_msg'];unset($_SESSION['system_msg']); }?>
							<ul class="members">
								<li class="member">
									<div class="member-info">
										<div class="member-skills">Email</div>
										<h4 class="member-name" id="member-email"><?php echo $obj->email?></h4>
									</div>
								</li>
								<li class="member">
									<div class="member-info">
										<div class="member-skills">Username</div>
										<h4 class="member-name"><?php echo $obj->username?></h4>
										<input type="text" name="username" value="<?php echo $obj->username?>" class="form-control hide" />
									</div>
								</li>
								<li class="member">
									<div class="member-info">
										<div class="member-skills">Fullname</div>
										<h4 class="member-name"><?php echo $obj->fullname?></h4>
										<input type="text" name="fullname" value="<?php echo $obj->fullname?>" class="form-control hide" />
									</div>
								</li>
								<li class="member">
									<div class="member-info">
										<div class="member-skills">Birthday</div>
										<h4 class="member-name"><?php echo date('m/d/Y',strtotime($obj->birthday))?></h4>
										<!-- <input type="text" class="cleave-date1 form-control hide" name="birthday" placeholder="2016/08/20" value="<?php echo $obj->birthday?>" /> -->
										<input class="form-control flatpickr-input hide" type="text" placeholder="Select Date.." readonly="readonly" data-date-format="m/d/Y" name="birthday" value="<?php echo date('m/d/Y',strtotime($obj->birthday))?>">
									</div>
								</li>
								<li class="member">
									<div class="member-info">
										<div class="member-skills">Phone</div>
										<h4 class="member-name"><?php echo $obj->phone?></h4>
										<input type="text" class="cleave-phone form-control hide" name="phone" value="<?php echo $obj->phone?>" />
									</div>
								</li>
								<!-- <li class="member">
									<div class="member-info">
										<div class="member-skills">Address</div>
										<h4 class="member-name"><?php echo $obj->address?></h4>
										<div class="form-group">
											<input type="text" class="form-control hide" name="address" value="<?php echo $obj->address?>" />
										</div>
									</div>
								</li> -->
							</ul>
							<div class="form-group" id="btn-change">
								<a class="btn btn-line btn-warning u-posRelative">
									<span class="nav-title">Update info</span>
									<span class="waves"></span>
								</a>
							</div>
							<div class="form-group btn-groups">
								<span class="btn btn-line btn-default form-cancel" data-id="updateInfoProfile">Cancel</span>
								<button type="submit" class="btn btn-line btn-warning">Save</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-md-3">
					<form action="<?php echo site_url('admin/user?act=upro&id='.$obj->id.'&token='.$infoLog->token);?>" method="post" id="changePassProfile" class="box shadow-2dp b-r-2">
						<header class="b-b">Password</header>
						<div class="box-body">
							<div id="ProfileMsgView"></div>
							<div class="form-group">
								<div class="member-skills">Password old</div>
								<input type="password" name="oldpassword" placeholder="******" class="form-control" readonly minlength="6" required />
								<input type="hidden" name="typeUpd" value="P">
							</div>
							<div class="form-group">
								<div class="member-skills">Password new</div>
								<input type="password" name="newpassword" placeholder="******" class="form-control" readonly minlength="6" required />
							</div>
							<div class="form-group">
								<div class="member-skills">Confirm password</div>
								<input type="password" name="cfmpassword" placeholder="******" class="form-control" readonly minlength="6" required />
							</div>
							<div class="form-group" id="btn-change">
								<a class="btn btn-line btn-warning u-posRelative" href="javascript:void(0)">
									<span class="nav-title">Change Password</span>
									<span class="waves"></span>
								</a>
							</div>
							<div class="form-group btn-groups">
								<span class="btn btn-line btn-default form-cancel" data-id="changePassProfile">Cancel</span>
								<button type="submit" class="btn btn-line btn-warning">Save</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form action="<?php echo site_url('admin/user?act=upro&id='.$obj->id.'&token='.$infoLog->token);?>" method="post" id="changeAvatarProfile" enctype="multipart/form-data" class="box shadow-2dp b-r-2">
						<header class="b-b">Avatar</header>
						<div class="box-body">
							<?php if(isset($_SESSION['system_msg_avatar'])){ echo $_SESSION['system_msg_avatar'];unset($_SESSION['system_msg_avatar']); }?>
							<div class="form-group">
								<div>
									<input type="hidden" name="typeUpd" value="A">
									<input type="file" class="changeImg hide" name="image" onchange="document.getElementById('vimg').src = window.URL.createObjectURL(this.files[0])">
									<img class="imgFile" id="vimg" alt="Avatar" src="<?php echo $avatar;?>" />
								</div>
							</div>
							<div class="form-group" id="btn-change">
								<a class="btn btn-line btn-warning u-posRelative" onclick="changeAvatarProfile()">
									<span class="nav-title">Change avatar</span>
									<span class="waves"></span>
								</a>
							</div>
							<div class="form-group btn-groups">
								<span class="btn btn-line btn-default form-cancel" data-id="changeAvatarProfile">Cancel</span>
								<button type="submit" class="btn btn-line btn-warning">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
		<!-- END: .container-fluid -->

	</div>
	<!-- END: .main-content -->
	
</div>
<!-- END: .app-main -->