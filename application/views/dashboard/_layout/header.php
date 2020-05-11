<!DOCTYPE html>
<html lang="en">

<head>
	<title>Project Manager</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Baloo+2:400,500,600,700,800&amp;display=swap&amp;subset=devanagari,latin-ext,vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('statics/default/'); ?>css/core.min.css">
	<link rel="stylesheet" href="<?php echo base_url('statics/default/'); ?>css/main.css">
	<link rel="stylesheet" href="<?php echo base_url('statics/default/'); ?>css/bootstrap/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url('statics/default/'); ?>css/style.css">
	<link rel="stylesheet" href="<?php echo base_url('statics/default/'); ?>css/dropzone.css">
	<script src="<?php echo base_url('filemanager') ?>/ckeditor/ckeditor.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/'); ?>favicon.ico">
</head>

<body data-layout="admin">
	<div id="loading">
		<div class="logo-loader"><img src="<?php echo base_url('assets/'); ?>loading.gif"></div>
		<div class="progstat-wrapper">Loading:<span id="progstat">0</span>%</div>
		<div id="progress"></div>
	</div>
	<header data-layout="admin">
		<div class="header-breadcrumb">
			<?php if ($cslug == '') : ?>
				<?php echo $title; ?>
			<?php else : ?>
				<?php
				if (isset($group)) {
					$groupLink = site_url('dashboard/group?act=group_detail&id=' . $group->id . '&token=' . $infoLog->token);
				}
				if (isset($project)) {
					$projectLink = site_url('dashboard/project?act=project_detail&id=' . $project->id . '&token=' . $infoLog->token);
				}
				if (isset($task)) {
					$taskLink = site_url('dashboard/task?act=task_detail&id=' . $task->id . '&token=' . $infoLog->token);
				}

				?>
				<?php if (isset($group)) {
					if ($this->uri->segment(2) == 'group') {
						echo "<a href='" . $groupLink . "' class='breadcrumb-item active'> " . $group->name . "</a> ";
					} else {
						echo "<a href='" . $groupLink . "' class='breadcrumb-item'> " . $group->name . "</a> ";
					}
				} else {
					echo '';
				} ?>
				<?php if (isset($project)) {
					if ($this->uri->segment(2) == 'project') {
						echo "<a href='" . $projectLink . "' class='breadcrumb-item active'> " . $project->name . "</a> ";
					} else {
						echo "<a href='" . $projectLink . "' class='breadcrumb-item'> " . $project->name . "</a> ";
					}
				} else {
					echo '';
				} ?>
				<?php if (isset($task)) {
					if ($this->uri->segment(2) == 'task') {
						echo "<a href='" . $taskLink . "' class='breadcrumb-item active'> " . $task->name . "</a> ";
					} else {
						echo "<a href='" . $taskLink . "' class='breadcrumb-item'> " . $task->name . "</a> ";
					}
				} else {
					echo '';
				} ?>
			<?php endif; ?>
		</div>
		<div class="header-right">
			<div class="accounts">
				<div class="avatar-header item-click-dropdown">
					<figure class="ov-h"><img class="ofcv" src="<?php echo base_url('assets/'); ?>public/avatar/<?php echo !empty($infoLog->avatar) ? $infoLog->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
				</div>
				<div class="basic-info-accounts">
					<div class="name"><?php echo $infoLog->displayName; ?></div>
					<div class="position">Member</div>
				</div>
				<div class="detail-info-accounts content-dropdown">
					<div class="header-image">
						<div class="avatar-header">
							<figure class="ov-h"><img class="ofcv" src="<?php echo base_url('assets/'); ?>public/avatar/<?php echo !empty($infoLog->avatar) ? $infoLog->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
						</div>
						<div class="basic-info-accounts">
							<div class="name"><?php echo $infoLog->displayName; ?></div>
							<div class="position">Member</div>
						</div>
						<div class="logout"><a class="btn btn-logout" href="<?php echo site_url('dashboard/logout'); ?>">Logout</a></div>
					</div>
					<div class="list-link">
						<div class="name-list">Account</div>
						<div class="link"><a href="<?php echo site_url('dashboard/user'); ?>">Account Information</a></div>
						<!-- <div class="link"><a href="#">Sửa thông tin tài khoản</a></div>
							<div class="link"><a href="#">Cài đặt</a></div>
							<div class="name-list">THIẾT LẬP</div>
							<div class="link"><a href="#">Cài đặt chung</a></div>
							<div class="link"><a href="#">Giao diện</a></div> -->
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php $this->load->view('dashboard/_layout/asidemenu') ?>
	<main>
		<div class="main__inner">
			<div class="card" data-max-width="850">