<div class="card__header">
    <div class="card__header-title">
        <h3>My Groups</h3>
    </div>
</div>
<div class="card__body">
    
    <div class="block-list-favories">
        <div class="">
            <div class="title">Leader :</div>
            <div class="list-item">
                <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                <?php if ($groups) : ?>
                    <?php $count = 0; ?>
                    <?php foreach ($groups as $group) : ?>
                        <?php if ($group->leader == $infoLog->id) : ?>
                            <div class="item">
                                <a href="<?php echo site_url('dashboard/group?act=group_detail&id=' . $group->id . '&token=' . $infoLog->token); ?>">
                                    <div class="name"><?php echo !empty($group->name) ? $group->name : "(Không Tên)"; ?></div>
                                    <div class="icon-projects" data-width="110" data-height="110" data-bg="#ffc98b"></div>
                                    <!-- <small>Thời gian tạo</small><br>
                                    <small><?php echo date('d-m-Y', strtotime($group->last_update)); ?></small></br>
                                    <small><?php echo date('h:i:s', strtotime($group->last_update)); ?></small> -->
                                </a>
                            </div>
                        <?php endif; ?>
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
                            
                            <div class="item">
                                <a href="<?php echo site_url('dashboard/group?act=group_detail&id=' . $group->id . '&token=' . $infoLog->token); ?>">
                                    <div class="name"><?php echo !empty($group->name) ? $group->name : "(Không Tên)"; ?></div>
                                    <div class="icon-projects" data-width="90" data-height="90" data-bg="#EA4E9D"></div>
                                </a>
                            </div>
                        <?php endif; ?>
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