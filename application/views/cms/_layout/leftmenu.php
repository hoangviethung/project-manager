<!-- begin .app-side -->
<aside class="app-side">
	<!-- begin .side-content -->
	<div class="side-content">
		<!-- begin user-panel -->
		<div class="user-panel">
			<div class="user-image">
				<a href="#">
					<img class="img-circle" src="<?php echo base_url('assets/public/avatar/').$infoLog->avatar;?>" alt="<?php echo $infoLog->displayName?>">
				</a>
			</div>
			<div class="user-info">
				<h5><?php echo $infoLog->displayName?></h5>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="text-turquoise small dropdown-toggle bg-transparent" data-toggle="dropdown">
							<i class="fa fa-fw fa-circle">
							</i> Online
						</a>
						<ul class="dropdown-menu animated flipInY pull-right">
							<li>
								<a href="<?php echo site_url('admin/user?act=profile&id='.$infoLog->id."&token=".$infoLog->token)?>">Profile</a>
							</li>
							<li role="separator" class="divider"></li>
							<li>
								<a href="<?php echo site_url('admin/logout')?>">
									<i class="fa fa-fw fa-sign-out"></i> Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<!-- END: user-panel -->
		<!-- begin .side-nav -->
		<nav class="side-nav">
			<!-- BEGIN: nav-content -->
			<ul class="metismenu nav nav-inverse nav-bordered nav-stacked" data-plugin="metismenu">
			<!-- BEGIN: report -->
			</ul>
			<!-- END: nav-content -->
		</nav>
		<!-- END: .side-nav -->
	</div>
	<!-- END: .side-content -->
</aside>
<!-- END: .app-side -->