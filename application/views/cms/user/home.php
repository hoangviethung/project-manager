<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Nguyên Quân / Danh sách người dùng
				</h6>
				<h3 class="dashhead-title">Danh sách tài khoản</h3>
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
					<?php if(checkaction($this->data['cslug'],'add')){?>
					<div class="p-b-15"><a href="<?php echo site_url('admin/user?act=upd&token='.$infoLog->token)?>" class="btn btn-primary pull-right"><span class="fa fa-fw fa-plus"></span>Thêm tài khoản</a></div>
					<?php }?>
					<table data-plugin="datatables" class="table table-striped table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>username</th>
								<th>Email</th>
								<th>Fullname</th>
								<th>Phone</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if($user):
							foreach($user as $key=>$obj){
						?>
							<tr <?php echo $obj->deleted==1?'class="alert-danger"':""?>>
								<td><?php echo $key+1?></td>
								<td>
									<?php echo $obj->username?>
									<?php if($obj->deleted==1):?>
									<span class="fa fa-fw fa-lock pull-right text-danger"></span>
									<?php endif?>
								</td>
								<td><?php echo $obj->email?></td>
								<td><?php echo $obj->full_name?></td>
								<td><?php echo $obj->phone?></td>
								<td>
									<?php if($infoLog->role == 0){?>
									<a href="javascript:void(0);" title="Set password" id="user-setpass" data-id="<?php echo $obj->id?>" data-toggle="modal" data-target="#changePassModal">
										<span class="nav-icon">
											<i class="fa fa-fw fa-keyboard-o"></i>
										</span>
									</a>
									<?php }?>
									<?php if(checkaction($this->data['cslug'],'upd') || $infoLog->id == $obj->id){?>
									<a href="<?php echo site_url('admin/user?act=upd&id='.$obj->id."&token=".$infoLog->token);?>" title="Edit">
										<span class="nav-icon">
											<i class="fa fa-fw fa-edit "></i>
										</span>
									</a>
									<?php }?>
									<?php if($infoLog->logid != $obj->id)://start check delete?>
									<?php if(checkaction($this->data['cslug'],'delete')){?>
									<a href="javascript:void(0);" title="Delete" id="btndelete" module="user" data-id="<?php echo $obj->id?>" data-toggle="modal" data-target="#deleteModal">
										<span class="nav-icon">
											<i class="fa fa-fw fa-trash "></i>
										</span>
									</a>
									<?php }?>

									<?php endif;//end check delete?>
								</td>
							</tr>
						<?php } endif;?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
		<!-- END: .container-fluid -->

	</div>
	<!-- END: .main-content -->
	<?php if($infoLog->role == 0 ){?>
	<!-- Modal -->
	<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="cpassModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="cpassModalLabel">Đổi mật khẩu</h4>
				</div>
				<form id="formInputPass" method="post" action="<?php echo site_url('admin/user?act=setpass&id='.$obj->id."&token=".$infoLog->token);?>">
					<div class="modal-body">
						<h5 id="Uinfo" class="text-info"></h5>
						<div class="md-content">
							<div class="form-group">
								<label>Mật khẩu mới</label>
								<input type="password" name="password" class="form-control" required maxlength="24" />
							</div>
							<div id="view-msg" class="text-danger"></div>
							<div class="form-group">
								<label>Nhập lại mật khẩu</label>
								<input type="password" name="cfpassword" class="form-control" required />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
						<button type="submit" id="change-pass" class="btn btn-primary" >Lưu</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if(checkaction($this->data['cslug'],'delete')){?>
	<div class="modal fade" id="deleteModal" tabindex="-2" role="dialog" aria-labelledby="deleteModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="deleteModalLabel">Xoá tài khoản</h4>
				</div>
				<div class="modal-body">
					<div class="md-content">
						Bạn muốn xoá tài khoản?      
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
					<a href="<?php echo site_url('admin/user?act=del&id='.$obj->id."&token=".$infoLog->token);?>" <?php echo $obj->deleted==1?'title="Lock"':'title="Unlock"'?>" id="confirmDelete" class="btn btn-primary">Xác nhận</a>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>
<!-- END: .app-main -->