<aside>
	<div class="block-logo">
		<div class="logo-src"><a href="<?php echo site_url('dashboard'); ?>"><img src="<?php echo base_url('assets/'); ?>logo.svg" alt="" srcset=""></a></div>
		<div class="button-close"><span class="line"></span></div>
	</div>
	<!-- ASIDE MENU FE ĐÃ VIẾT JS ĐỂ ADD CLASS -> TỐI ĐA ĐƯỢC 3 CẤP MENU -> (LIST LINK, LNIK, LIST LINK)-->
	<div class="aside-list">
		<div class="aside-item">
			<div class="name">
				<div class="icon"><img class="svg" src="<?php echo base_url('assets/'); ?>icons/menu.svg" alt="" srcset=""></div>
				<h5 class="lcl lcl-1">Menu</h5>
			</div>
			<ul class="list-link">
				<li class="link <?php echo uri_string() == 'dashboard' ? 'active' : ''; ?>"><a href="<?php echo site_url('dashboard'); ?>">Home</a></li>
				<li class="link <?php echo uri_string() == 'dashboard/task' ? 'active' : ''; ?>"><a href="<?php echo site_url('dashboard/task'); ?>">My Task</a></li>
				<li class="link"><a href="role-admin.html">Inbox</a></li>
				<li class="link"><a href="role-admin.html">Portfolios</a></li>
			</ul>
		</div>
		<div class="aside-item">
			<div class="name">
				<div class="icon"><img class="svg" src="<?php echo base_url('assets/'); ?>icons/favorites.svg" alt="" srcset=""></div>
				<h5 class="lcl lcl-1">Groups</h5>
			</div>

			<ul class="list-link list-link-favorites">
				<?php if ($groups) : ?>
					<?php for ($i = 0; $i < 4; $i++) : ?>
						<li class="link <?php echo uri_string() == 'dashboard/group' && isset($_GET['id'])&&$_GET['id'] == $groups[$i]->id ? 'active' : ''; ?>"><a data-bg-after-color="<?php echo $groups[$i]->leader == $infoLog->id ? 'green' : 'pink'; ?>" href="<?php echo site_url('dashboard/group?act=group_detail&id=' . $groups[$i]->id . '&token=' . $infoLog->token); ?>"><?php echo !empty($groups[$i]->name) ? $groups[$i]->name : "Không Tên"; ?></a></li>
					<?php endfor; ?>
				<?php else : ?>
					No Joined Groups
				<?php endif; ?>
			</ul>
		</div>
		<div class="aside-item">
			<div class="name active">
				<div class="icon"><img class="svg" src="<?php echo base_url('assets/'); ?>icons/group-user.svg" alt="" srcset=""></div>
				<h5 class="lcl lcl-1">Project Team</h5>
			</div>
			<div class="list-link list-user">
				<!-- USER CÓ ẢNH-->
				<div class="user">
					<div class="avatar ov-h"><img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt=""></div>
				</div>
				<!-- USER TRỐNG-->
				<div class="user">
					<div class="avatar ov-h"></div>
				</div>
				<!-- USER TRỐNG-->
				<div class="user">
					<div class="avatar ov-h"></div>
				</div>
				<div class="add-user" data-fancybox data-src="#block-invite">Invite +</div>
			</div>
		</div>
	</div>
</aside>