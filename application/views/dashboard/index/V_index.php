<div class="card__header">
    <div class="card__header-title">
        <h3>Overview</h3>
    </div>
    <div class="card__header-actions"><a class="link" href="#">See all my tasks</a></div>
</div>
<div class="card__body">
    <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
    <div class="block-list-recent">
        <div class="title">Recent Tasks</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if($recentTasks):?>
                <?php foreach($recentTasks as $recentTask):?>
                    <div class="item">
                        <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div>
                        <div class="text">
                            <div class="name">Task 1</div>
                            <div class="history">Changed Recently</div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                No recent tasks
            <?php endif;?>
        </div>
    </div>
    <div class="block-list-favories">
        <div class="title">Your Group</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if($groups):?>
                <?php foreach($groups as $group):?>
            <div class="item">
                <div class="icon-projects" data-width="120" data-height="120" data-bg="#EA4E9D"></div>
                <div class="name">Group 1</div>
            </div>
                <?php endforeach;?>
            <?php else:?>
                No joined group
            <?php endif;?>
        </div>
        <div class="item" data-type="add-news-item">
            <div class="btn btn-add-new-project">New Group</div>
        </div>
    </div>
    <div class="block-list-recent">
        <div class="title">Recent Projects</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if($recentProjects):?>
                <?php foreach($recentProjects as $recentProject):?>
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
                    <?php if($recentProject->leader == $userInfo):?>
                    <div class="add-user" data-fancybox data-src="#block-invite">Invite +</div>
                    <?php endif;?>
                </div>
            </div>
                <?php endforeach;?>
                <?php else:?>
                    No recent project
                <?php endif;?>
        </div>
    </div>
</div>