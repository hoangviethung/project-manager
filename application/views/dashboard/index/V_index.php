<div class="card__header">
    <div class="card__header-title">
        <h3>Overview</h3>
    </div>
    <div class="card__header-actions"><a class="link" href="<?php echo site_url('dashboard/task'); ?>">See all my tasks</a></div>
</div>
<div class="card__body">
    <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
    <div class="block-list-recent">
        <div class="title">Recent Tasks</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if ($recentTasks) : ?>
                <?php foreach ($recentTasks as $recentTask) : ?>
                    <div class="item">
                        <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div>
                        <div class="text">
                            <div class="name">Task 1</div>
                            <div class="history">Changed Recently</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                No recent tasks
            <?php endif; ?>
        </div>
    </div>
    <div class="block-list-favories">
        <div class="title">Your Group</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if ($groups) : ?>
                <?php foreach ($groups as $group) : ?>
                    <div class="item">
                        <a href="<?php echo site_url('dashboard/group?id='.$group->id.'&token='.$this->data['infoLog']->token);?>">
                        <div class="name"><?php echo !empty($group->name)?$group->name:"(Không Tên)";?></div>
                            <div class="icon-projects" data-width="80" data-height="80" data-bg="#EA4E9D"></div>
                            <small>Thời gian tạo</small><br>
                            <small><?php echo date('d-m-Y',strtotime($group->last_update));?></small></br>
                            <small><?php echo date('h:i:s',strtotime($group->last_update));?></small>
                            
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                No joined group
            <?php endif; ?>
        </div>
        <div class="item" data-type="add-news-item">
            <div class="btn btn-add-new-project" data-fancybox data-src="#block-new-group"><a class="nav-link" >New Group</a></div>
        </div>
    </div>
    <div class="block-list-recent">
        <div class="title">Recent Projects</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if ($recentProjects) : ?>
                <?php foreach ($recentProjects as $recentProject) : ?>
                    <div class="item">
                        <div class="icon-projects" data-width="40" data-height="40" data-bg="#EA4E9D"></div>
                        <div class="text">
                            <div class="name">Project 1</div>
                            <div class="history">Visited Today</div>
                        </div>
                        <div class="list-user ml-at">
                            <!-- USER CÓ ẢNH-->
                            <div class="user">
                                <div class="avatar ov-h"><img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt=""></div>
                            </div>
                            <?php if ($recentProject->leader == $userInfo) : ?>
                                <div class="add-user" data-fancybox data-src="#block-invite">Invite +</div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                No recent project
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="d-n">
    <div id="block-new-group" data-max-width="900">
        <div class="block-form">
            <form action="#">
            <div class="form-group">
							<label>Tên Nhóm</label>
							<input type="text" name="name" placeholder="">
						</div>
						<div class="form-group">
							<label>Mô Tả</label>
							<textarea name="description" rows="4"></textarea>
						</div>
                <div class="form-group">
                    <button class="btn btn-view-more w-100" data-url="<?php echo site_url('dashboard/group?act=new_group_save&token='.$infoLog->token); ?>">Tạo Nhóm Mới</button>
                </div>
            </form>
        </div>
    </div>
</div>