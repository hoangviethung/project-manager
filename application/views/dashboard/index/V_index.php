
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
                <a href="<?php echo site_url('dashboard/task?act=task_detail&id='.$recentTask->id.'&token='.$infoLog->token);?>">
                <div class="item">
                        <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div>
                        <div class="text">
                        <div class="name"><?php echo $recentTask->name .' (ID#: '.$recentTask->id.')';?></div>
                            <div class="history">Changed Recently: <?php echo $recentTask->last_update;?></div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else : ?>
                No recent tasks
            <?php endif; ?>
        </div>
    </div>
    <div class="block-list-favories">

        <h4 class="">Your Group</h4>
        <div class="item" style="text-align:right;color: #4eabff;font-size: 13px;">
            <a class="nav-link" href="<?php echo site_url('dashboard/group'); ?>">All Groups</a>
        </div>
        <div class="">
            <div class="title">Leader :</div>
            <div class="list-item">
                <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                <?php if ($groups) : ?>
                    <?php $count = 0; ?>
                    <?php foreach ($groups as $group) : ?>
                        <?php if ($group->leader == $infoLog->id) : ?>
                            <?php $count++; ?>
                            <div class="item">
                                <a href="<?php echo site_url('dashboard/group?act=group_detail&id=' . $group->id . '&token=' . $infoLog->token); ?>">
                                    <div class="name"><?php echo !empty($group->name) ? $group->name : "(Không Tên)"; ?></div>
                                    <div class="icon-projects" data-width="140" data-height="140" data-bg="#ffc98b"></div>
                                    <!-- <small>Thời gian tạo</small><br>
                                    <small><?php echo date('d-m-Y', strtotime($group->last_update)); ?></small></br>
                                    <small><?php echo date('h:i:s', strtotime($group->last_update)); ?></small> -->
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($count == 8) {
                            break;
                        } ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    No joined group
                <?php endif; ?>
            </div>
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <div class="title">member :</div>
            <div class="list-item">
                <?php if ($groups) : ?>
                    <?php $count = 0; ?>
                    <?php foreach ($groups as $group) : ?>
                        <?php if ($group->leader != $infoLog->id) : ?>
                            <?php $count++; ?>
                            <div class="item">
                                <a href="<?php echo site_url('dashboard/group?act=group_detail&id=' . $group->id . '&token=' . $infoLog->token); ?>">
                                    <div class="name"><?php echo !empty($group->name) ? $group->name : "(Không Tên)"; ?></div>
                                    <div class="icon-projects" data-width="110" data-height="110" data-bg="#EA4E9D"></div>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($count == 5) {
                            break;
                        } ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    No joined group
                <?php endif; ?>
            </div>
        </div>
        <div class="item" data-type="add-news-item">
            <div class="btn btn-add-new-project" data-fancybox data-src="#block-new-group"><a class="">New Group</a></div>
        </div>

    </div>
    <div class="block-list-recent">
        <div class="title">Recent Projects</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if ($recentProjects) : ?>
                <?php foreach ($recentProjects as $recentProject) : ?>
                    <div class="item">
                                <div class="icon-projects" data-width="40" data-height="40" data-bg="#00FFFF"></div>
                                <div class="text">
                                    <div class="name"><a href="<?php echo site_url('dashboard/project?act=project_detail&id='.$recentProject->id.'&token='.$infoLog->token);?>"><?php echo !empty($recentProject->name) ? $recentProject->name : "Không Tên"; ?> (ID#: <?php echo $recentProject->id;?>)</a></div>
                                    <div class="history">Last Updated : <?php echo $recentProject->last_update; ?></div>
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
                    <button class="btn btn-view-more w-100" data-url="<?php echo site_url('dashboard/group?act=new_group_save&token=' . $infoLog->token); ?>">Tạo Nhóm Mới</button>
                </div>
            </form>
        </div>
    </div>
</div>