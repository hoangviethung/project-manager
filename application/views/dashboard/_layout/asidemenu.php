<aside>
			<div class="block-logo">
				<div class="logo-src"><a href="index.html"><img src="<?php echo base_url('assets/');?>logo.svg" alt="" srcset=""></a></div>
				<div class="button-close"><span class="line"></span></div>
			</div>
			<!-- ASIDE MENU FE ĐÃ VIẾT JS ĐỂ ADD CLASS -> TỐI ĐA ĐƯỢC 3 CẤP MENU -> (LIST LINK, LNIK, LIST LINK)-->
			<div class="aside-list">
				<div class="aside-item">
					<div class="name">
						<div class="icon"><img class="svg" src="<?php echo base_url('assets/');?>icons/menu.svg" alt="" srcset=""></div>
						<h5 class="lcl lcl-1">Menu</h5>
					</div>
					<ul class="list-link">
						<li class="link"><a href="user-admin.html">Home</a></li>
						<li class="link"><a href="role-admin.html">My Task</a></li>
						<li class="link"><a href="role-admin.html">Inbox</a></li>
						<li class="link"><a href="role-admin.html">Portfolios</a></li>
					</ul>
				</div>
				<div class="aside-item">
					<div class="name">
						<div class="icon"><img class="svg" src="<?php echo base_url('assets/');?>icons/favorites.svg" alt="" srcset=""></div>
						<h5 class="lcl lcl-1">Favorites</h5>
					</div>
					<!--DANH DÁCH CÁC DỰ ÁN YÊU THÍCH -> MÀU DẤM CHẤM TỪNG DỰ ÁN ĐƯỢC SET VÀO ATTR => DATA BG AFTER COLOR-->
					<ul class="list-link list-link-favorites">
						<li class="link"><a data-bg-after-color="green" href="role-admin.html">Project 1</a></li>
						<li class="link"><a data-bg-after-color="red" href="role-admin.html">Project 2</a></li>
						<li class="link"><a data-bg-after-color="yellow" href="role-admin.html">Project 3</a></li>
						<li class="link"><a data-bg-after-color="pink" href="role-admin.html">Project 4</a></li>
					</ul>
				</div>
				<div class="aside-item">
					<div class="name active">
						<div class="icon"><img class="svg" src="<?php echo base_url('assets/');?>icons/group-user.svg" alt="" srcset=""></div>
						<h5 class="lcl lcl-1">Project Team</h5>
					</div>
					<div class="list-link list-user">
						<!-- USER CÓ ẢNH-->
						<div class="user">
							<div class="avatar ov-h"><img class="ofcv" src="<?php echo base_url('assets/');?>images/admin/user-default.png" alt=""></div>
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