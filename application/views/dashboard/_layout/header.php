<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Project Manager</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="https://fonts.googleapis.com/css?family=Baloo+2:400,500,600,700,800&amp;display=swap&amp;subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/core.min.css">
		<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/main.css">
		<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/style.css">
		<link rel="stylesheet" href="<?php echo base_url('statics/default/');?>css/dropzone.css">
		<script src="<?php echo base_url('filemanager')?>/ckeditor/ckeditor.js"></script>
		
	</head>
	<body data-layout="admin">
		<div id="loading">
			<div class="logo-loader"><img src="<?php echo base_url('assets/');?>loading.gif"></div>
			<div class="progstat-wrapper">Loading:<span id="progstat">0</span>%</div>
			<div id="progress"></div>
		</div>
		<header data-layout="admin">
			<div class="header-right">
				<div class="accounts">
					<div class="avatar-header item-click-dropdown">
						<figure class="ov-h"><img class="ofcv" src="<?php echo base_url('assets/');?>images/admin/<?php echo !empty($infoLog->avatar)?$infoLog->data:"user-default.png";?>" alt="" srcset=""></figure>
					</div>
					<div class="basic-info-accounts">
						<div class="name"><?php echo $infoLog->userName;?></div>
						<div class="position">Quản trị viên</div>
					</div>
					<div class="detail-info-accounts content-dropdown">
						<div class="header-image">
							<div class="avatar-header">
								<figure class="ov-h"><img class="ofcv" src="<?php echo base_url('assets/');?>images/admin/<?php echo !empty($infoLog->avatar)?$infoLog->data:"user-default.png";?>" alt="" srcset=""></figure>
							</div>	
							<div class="basic-info-accounts">
								<div class="name"><?php echo $infoLog->userName;?></div>
								<div class="position">Quản trị viên</div>
							</div>
							<div class="logout"><a class="btn btn-logout" href="<?php echo site_url('dashboard/logout');?>">Logout</a></div>
						</div>
						<div class="list-link">
							<div class="name-list">TÀI KHOẢN</div>
							<div class="link"><a href="#">Thông tin tài khoản</a></div>
							<div class="link"><a href="#">Sửa thông tin tài khoản</a></div>
							<div class="link"><a href="#">Cài đặt</a></div>
							<div class="name-list">THIẾT LẬP</div>
							<div class="link"><a href="#">Cài đặt chung</a></div>
							<div class="link"><a href="#">Giao diện</a></div>
						</div>
					</div>
				</div>
			</div>
        </header>
        <?php $this->load->view('dashboard/_layout/asidemenu')?>
        <main>
		<div class="main__inner">
				<div class="card" data-max-width="850">