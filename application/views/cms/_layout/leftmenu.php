<!-- begin .app-side -->
<aside class="app-side">
	<!-- begin .side-content -->
	<div class="side-content">
		<!-- begin user-panel -->
		<div class="user-panel">
			<div class="user-image">
				<a href="#">
					<img class="img-circle" src="<?php echo $avatar;?>" alt="<?php echo $infoLog->userName?>">
				</a>
			</div>
			<div class="user-info">
				<h5><?php echo $infoLog->userName?></h5>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="text-turquoise small dropdown-toggle bg-transparent" data-toggle="dropdown">
							<i class="fa fa-fw fa-circle">
							</i> Online
						</a>
						<ul class="dropdown-menu animated flipInY pull-right">
							<li>
								<a href="<?php echo site_url('admin/user?act=profile&id='.$infoLog->logid."&token=".$infoLog->token)?>">Profile</a>
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
			<?php if(checkcontroller("main")){?>
				<li>
					<a href="<?php echo site_url('admin/main')?>" <?php echo $this->controller=="main"||$this->uri->segment(2)==""?'class="active"':''?> >
						<span class="nav-icon">
						<i class="fas fa-chart-line"></i>
						</span>
						<span class="nav-title">Thống Kê</span>
					</a>
				</li>
				<?php } ?>
				<!-- END: product -->
				<li class="nav-divider"></li>
								<!-- BEGIN: product -->
								<?php if(checkcontroller("product")){?>
				<li>
					<a href="<?php echo site_url('admin/product')?>" <?php echo $this->controller=="product"?'class="active"':''?> >
						<span class="nav-icon">
							<i class="fa fa-shopping-cart"></i>
						</span>
						<span class="nav-title">Sản Phẩm</span>
					</a>
				</li>
				<?php } ?>
				<!-- END: product -->
				<!-- BEGIN: Media -->
				<?php if(checkcontroller("category")){?>
				<li>
					<a href="<?php echo site_url('admin/category')?>" <?php echo $this->controller=="category"?'class="active"':''?> >
						<span class="nav-icon">
							<i class="fa fa-fw fa-cubes"></i>
						</span>
						<span class="nav-title">Danh Mục Sản Phẩm</span>
					</a>
				</li>
				<?php } ?>
				<!-- END: Media -->

				<!-- BEGIN: user -->
				<?php if(checkcontroller("banner")){?>
				<li>
					<a href="<?php echo site_url('admin/banner')?>" <?php echo $this->controller=="banner"?'class="active"':''?> >
						<span class="nav-icon">
							<i class="fa fa-fw fa-image"></i>
						</span>
						<span class="nav-title">Banner Trang Chủ</span>
					</a>
				</li>
				<?php } ?> 
				<?php if(checkcontroller("order")){?>
				<li>
					<a href="<?php echo site_url('admin/order')?>" <?php echo $this->controller=="order"?'class="active"':''?> >
						<span class="nav-icon">
						<i class="fa fa-file-invoice"></i>
						</span>
						<span class="nav-title">Đơn Hàng</span>
					</a>
				</li>
				<?php } ?> 
				<!-- END: user -->

			</ul>
			<!-- END: nav-content -->
		</nav>
		<!-- END: .side-nav -->
	</div>
	<!-- END: .side-content -->
</aside>
<!-- END: .app-side -->