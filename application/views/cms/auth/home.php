<!DOCTYPE html>
<html>

<head>
	<base href="<?php echo base_url()?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Login</title>

	<!-- Core stylesheet files. REQUIRED -->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="statics/directory/vendor/bootstrap/css/bootstrap.css">

	<!-- Font Awesome -->
	<!-- WARNING: Font Awesome doesn't work if you view the page via file:// -->
	<link rel="stylesheet" href="statics/directory/vendor/font-awesome/css/font-awesome.css">

	<!-- animate.css -->
	<link rel="stylesheet" href="statics/directory/vendor/animate.css/animate.css">
	<!-- END: core stylesheet files -->
	<!-- Theme main stlesheet files. REQUIRED -->
	<link rel="stylesheet" href="statics/directory/css/chl.css">
	<link rel="stylesheet" href="statics/directory/css/theme-peter-river.css">
	<!-- END: theme main stylesheet files -->

	<style media="screen">
		.app {
			/*background-image: url("statics/directory/img/bg.svg");*/
			background-repeat: no-repeat;
			background-size: cover;
		}

	</style>
</head>

<body class="bg-clouds">
	<div class="app">
		<div class="app-login">
			<div class="text-center box shadow-5 animated fadeInLeft b-r-4 p-a-20">
				<h1 class="f-4 m-a-0">Myweb</h1>
				<?php if(isset($_SESSION['system_msg'])){
					echo $_SESSION['system_msg'];unset($_SESSION['system_msg']);
				}else{?>
				<h4>Sign in to start your session</h4>
				<?php }?>
				<form class="text-left" role="form" action="<?php echo site_url('admin/login')?>" method="post">
					<div class="form-group has-feedback">
						<input class="form-control" placeholder="Username" type="text" required name="username">
						<span class="form-control-feedback">
							<i class="fa fa-fw fa-envelope"></i>
						</span>
					</div>
					<div class="form-group has-feedback">
						<input class="form-control" placeholder="Password" type="password" required name="password">
						<span class="form-control-feedback">
							<i class="fa fa-fw fa-key"></i>
						</span>
					</div>
					<button type="submit" class="btn btn-primary btn-block m-b-15">Login</button>
				</form>

			</div>
		</div>
	<!-- Core javascript files. REQUIRED -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="statics/directory/vendor/jquery/jquery.js"></script>

	<!-- Bootstrap -->
	<script src="statics/directory/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>
