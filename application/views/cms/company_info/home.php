<!-- begin .app-main -->
<div class="app-main">

	<!-- begin .main-heading -->
	<header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
					Nguyên Quân / Thông Tin Công Tin
				</h6>
				<h3 class="dashhead-title">Thông Tin Công Tin</h3>
			</div>

			<div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
				Thông Tin Công Tin
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
					<?php if(checkaction($this->data['cslug'],'edit')){?>
					<div class=""><a href="<?php echo site_url('admin/companyInfo?act=upd&token='.$infoLog->token)?>" class="btn btn-primary pull-left m-b-15"><span class="fa fa-fw fa-edit"></span> Sửa Thông Tin</a></div>
					<?php }?>
					<table data-plugin="datatables" class="table table-striped table-bordered" width="100%" cellspacing="0" style="margin-top:10px">
						<thead>
							<tr>
								<th>#</th>
								<th>Thông Tin</th>
								<th>Giá Trị</th>
								<th>Lần Sửa Cuối</th>
								<th>Giá Trị Trước</th>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($infos)):
							foreach($infos as $key=>$obj){
						?>
							<tr>
								<td><?php echo $key+1?></td>
								<td>
									<?php echo ucwords($obj->info)?>
								</td>
								<td><?php echo $obj->value?></td>
								<td><?php echo $obj->last_updated?></td>
								<td><?php echo $obj->previous_value?></td>
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
	

</div>
	</div>
<!-- END: .app-main -->