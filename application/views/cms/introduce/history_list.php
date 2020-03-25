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
				<h3 class="dashhead-title">Danh sách lịch sử hình thành</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					Lịch sử hình thành / danh sách lịch sử hình thành
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
					<div class="p-b-15"><a href="<?php echo site_url('admin/introduce?act=new_history&token='.$infoLog->token)?>" class="btn btn-primary pull-right"><span class="fa fa-fw fa-plus"></span> New history</a></div>
					<?php }?>
					<table data-plugin="datatables" class="table table-striped table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if($history):
							foreach($history  as $key=>$obj){
						?>
							<tr>
								<td><?php echo $key+1?></td>
								<td>
									<?php echo $obj->title?>
								</td>
								<td>
									<a href="<?php echo site_url('admin/introduce?act=upd_history&id='.$obj->id."&token=".$infoLog->token);?>" title="Edit">
										<span class="nav-icon">
											<i class="fa fa-fw fa-edit "></i>
										</span>
									</a>
									<a href="javascript:void(0);" title="Delete" id="btndelete" module="introduce" data-id="<?php echo $obj->id?>" data-toggle="modal" data-target="#deleteModal">
										<span class="nav-icon">
											<i class="fa fa-fw fa-trash "></i>
										</span>
									</a>
								</td>
							</tr>
						<?php } endif;?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
		<!-- END: .container-fluid -->
<!-- 
	</div> -->
	<!-- END: .main-content -->
	
	<?php if(checkaction($this->data['cslug'],'delete')){?>
	<div class="modal fade" id="deleteModal" tabindex="-2" role="dialog" aria-labelledby="deleteModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="deleteModalLabel">Xoá lịch sử</h4>
				</div>
				<div class="modal-body">
					<div class="md-content">
						Bạn muốn xoá lịch sử?
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="closeCPModal">Đóng</button>
					<a href="#" id="confirmDelete" class="btn btn-primary">Xác nhận</a>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>
	</div>
<!-- END: .app-main -->