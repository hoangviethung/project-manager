<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Project Manager</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="https://fonts.googleapis.com/css?family=Baloo+2:400,500,600,700,800&amp;display=swap&amp;subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/core.min.css">
    	<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/main.min.css">
    	<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/bootstrap/bootstrap.min.css">
    	<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/style.css">
	</head>
	<body data-layout="index">
		<div id="loading">
			<div class="logo-loader"><img src="<?php echo base_url('assets/');?>loading.gif"></div>
			<div class="progstat-wrapper">Loading:<span id="progstat">0</span>%</div>
			<div id="progress"></div>
		</div>
		<header data-layout="index">
			<div class="container">
				<div class="row no-gutters ai-c">
					<div class="logo"><a href="#"><img class="lazyload blur-up" data-src="<?php echo base_url('assets/');?>logo.svg" alt="" srcset=""></a></div>
					<div class="nav-list ml-at">
						<div class="nav-item"><a class="nav-link" href="#">WHY LOGO?</a></div>
						<div class="nav-item"><a class="nav-link" href="#">Contact Sales</a></div>
						<div class="nav-item"><a class="nav-link" data-fancybox data-src="#block-login">LOG IN</a></div>
						<div class="nav-item"><a class="btn btn-view-more" href="#">Try for free</a></div>
					</div>
				</div>
			</div>
		</header>
		<main>
			<!--BLOCK 1 TRANG CHỦ-->
			<section class="index-1" style="height:70vh;">
				<div class="container">
					<div class="content">
						<h1 class="wow fadeInDown" data-wow-delay=".2s">Group Invitation Confirmed</h1>
						<div class="ta-c mt-10px"><a class="btn btn-view-more" href="<?php echo site_url('dashboard');?>">Back to Dashboard</a></div>
					</div>
				</div>
			</section>
			<div class="index-page" id="js-page-verify" hidden></div>
		</main>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-2">
						<div class="logo"><a href="index.html"><img class="lazyload blur-up" data-src="<?php echo base_url('assets/');?>logo.svg" alt="" srcset=""></a></div>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-2">
						<div class="title-footer">About Us</div>
						<ul class="list-link-footer">
							<li class="link"><a class="lcl lcl-1" href="#">Link</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-2">
						<div class="title-footer">About Us</div>
						<ul class="list-link-footer">
							<li class="link"><a class="lcl lcl-1" href="#">Link</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-2">
						<div class="title-footer">About Us</div>
						<ul class="list-link-footer">
							<li class="link"><a class="lcl lcl-1" href="#">Link</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-2">
						<div class="title-footer">About Us</div>
						<ul class="list-link-footer">
							<li class="link"><a class="lcl lcl-1" href="#">Link</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-2">
						<div class="title-footer">About Us</div>
						<ul class="list-link-footer">
							<li class="link"><a class="lcl lcl-1" href="#">Link</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<section class="copy-right">
			<div class="container">
				<div class="row no-gutters ai-c">
					<div class="language"><a href="#">English</a></div>
					<div class="terms-privacy"><a href="#">Terms & Privacy</a></div>
					<div class="social-media">
						<ul>
							<li><a href="#"><img class="lazyload blur-up" data-src="<?php echo base_url('assets/');?>icons/twitter.svg" alt="" srcset=""></a></li>
							<li><a href="#"><img class="lazyload blur-up" data-src="<?php echo base_url('assets/');?>icons/facebook.svg" alt="" srcset=""></a></li>
						</ul>
					</div>
					<div class="list-download">
						<ul>
							<li><a href="#"><img class="lazyload blur-up" data-src="<?php echo base_url('assets/');?>icons/app-store.svg" alt="" srcset=""></a></li>
							<li><a href="#"><img class="lazyload blur-up" data-src="<?php echo base_url('assets/');?>icons/google-play.svg" alt="" srcset=""></a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- BLOCK FORMS LOGIN - CLICK SEND AJAX (res.Code = 200 -> True, != 200 -> False)-->
		<div class="d-n">
			<div id="block-login" data-max-width="900">
				<h2>Log in</h2><a class="btn btn-login-google d-b w-100 ta-c" href="#">Use Google Account</a>
				<div class="or ta-c">or</div>
				<div class="block-form">
					<form action="#">
						<div class="form-group">
							<label>Email Address</label>
							<input type="text" name="email" placeholder="name@company.com">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" placeholder="Password">
						</div>
						<div class="form-group">
							<button class="btn btn-view-more w-100" data-redirect="<?php echo site_url('dashboard');?>" data-url="<?php echo site_url('auth/login');?>">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url('statics/default/');?>js/core.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('statics/default/');?>js/main.js"></script>
	</body>
</html>