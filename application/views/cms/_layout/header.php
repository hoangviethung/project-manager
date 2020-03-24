<!doctype html>
<html lang="en">

<head>
	<base href="<?php echo base_url()?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Trang Sức La Jew</title>

	<!-- Vendor stylesheet files. REQUIRED -->
	<!-- BEGIN: Vendor  -->
	<link rel="stylesheet" href="statics/directory/css/vendor.css">

	<!-- END: core stylesheet files -->
	<link rel="stylesheet" type="text/css" href="node_modules\datatables.net-dt\css\jquery.dataTables.css"/>
	<!-- Plugin stylesheet files. OPTIONAL -->

	<link rel="stylesheet" href="statics/directory/vendor/jqvmap/jqvmap.css">

	<link rel="stylesheet" href="statics/directory/vendor/dragula/dragula.css">

	<link rel="stylesheet" href="statics/directory/vendor/perfect-scrollbar/perfect-scrollbar.css">

	<link rel="stylesheet" href="statics/directory/vendor/fontawesome/css/all.css">
	<!-- END: plugin stylesheet files -->

	<!-- Theme main stlesheet files. REQUIRED -->
	<link rel="stylesheet" href="statics/directory/css/chl.css">
	<link id="theme-list" rel="stylesheet" href="statics/directory/css/theme-peter-river.css">
	<!-- END: theme main stylesheet files -->

	<!-- begin pace.js  -->
	<link rel="stylesheet" href="statics/directory/vendor/pace/themes/blue/pace-theme-minimal.css">
	<script src="<?php echo base_url('filemanager')?>/ckeditor/ckeditor.js"></script>
	<script src="statics/directory/vendor/pace/pace.js"></script>
	<!-- END: pace.js  -->
	<script type="text/javascript">
		var base_url = '<?php echo base_url();?>';
		var token = '<?php echo $infoLog->token?>';
	</script>
	
</head>

<body>
	<!-- begin .app -->
	<div class="app">
		<!-- begin .app-wrap -->
		<div class="app-wrap">
			<!-- begin .app-heading -->
			<header class="app-heading">
				<header class="canvas is-fixed is-top bg-white p-v-15 shadow-4dp" id="top-search">

					<div class="container-fluid">
						<div class="input-group input-group-lg icon-before-input">
							<input type="text" class="form-control input-lg b-0" placeholder="Search for...">
							<div class="icon z-3">
								<i class="fa fa-fw fa-lg fa-search"></i>
							</div>
							<span class="input-group-btn">
								<button data-target="#top-search" data-toggle="canvas" class="btn btn-danger btn-line b-0">
									<i class="fa fa-fw fa-lg fa-times"></i>
								</button>
							</span>
						</div>
						<!-- /input-group -->
					</div>
				</header>
				<!-- begin .navbar -->
				<nav class="navbar navbar-default navbar-static-top shadow-2dp">
					<!-- begin .navbar-header -->
					<div class="navbar-header">
						<!-- begin .navbar-header-left with image -->
						<div class="navbar-header-left b-r">
							<!--begin logo-->
							<a class="logo" href="<?php echo site_url();?>">
								<span class="logo-xs visible-xs">
									<img src="statics/directory/img/logo_xs.svg" alt="logo-xs">
								</span>
								<span class="logo-lg hidden-xs">
									<img src="statics/directory/img/logo_lg.svg" alt="logo-lg">
								</span>
							</a>
							<!--end logo-->
						</div>
						<!-- END: .navbar-header-left with image -->
						<nav class="nav navbar-header-nav">

							<a class="visible-xs b-r" href="#" data-side=collapse>
								<i class="fa fa-fw fa-bars"></i>
							</a>

							<a class="hidden-xs b-r" href="#" data-side=mini>
								<i class="fa fa-fw fa-bars"></i>
							</a>

							<form class="navbar-form hidden-xs b-r">
								<div class="icon-after-input">
									<input type="text" class="form-control" placeholder="Search">
									<div class="icon">
										<a href="#">
											<i class="fa fa-fw fa-search"></i>
										</a>
									</div>
								</div>
							</form>

						</nav>

						<ul class="nav navbar-header-nav m-l-a">
							<li class="dropdown b-l">
								<a class="dropdown-toggle profile-pic" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<img class="img-circle" src="<?php echo $avatar?>" alt="<?php echo $infoLog->userName?>">
									<b class="hidden-xs hidden-sm"><?php echo $infoLog->userName?></b>
								</a>
								<ul class="dropdown-menu animated flipInY pull-right">
									<li>
										<a href="<?php echo site_url('admin/user?act=profile&id='.$infoLog->logid."&token=".$infoLog->token)?>">Profile</a>
									</li>
									<li role="separator" class="divider"></li>
									<li>
										<a href="<?php echo site_url('admin/logout')?>">
											<i class="fa fa-fw fa-sign-out"></i>
											Logout
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- END: .navbar-header -->
				</nav>
				<!-- END: .navbar -->
			</header>
			<!-- END:  .app-heading -->

			<!-- begin .app-container -->
			<div class="app-container">
				<?php $this->load->view('cms/_layout/leftmenu')?>