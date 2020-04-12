<div class="card__header">
    <div class="card__header-title">
        <h3><?php echo $project->name; ?> <br>(ID#: <?php echo $project->id; ?>)</h3>
    </div>
    <div class="card__header-actions"><a class="link" href="<?php echo site_url('dashboard/group'); ?>">See all my Projects</a></div>
</div>
<nav>

    <div class="nav nav-tabs group-detail-tab-list" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active group-detail-tab-item" id="nav-detail-overview-tab" data-toggle="tab" href="#nav-detail-overview" role="tab" aria-controls="nav-detail-overview" aria-selected="true">Overview</a>
        <a class="nav-item nav-link group-detail-tab-item" id="nav-detail-tasks-tab" data-toggle="tab" href="#nav-detail-tasks" role="tab" aria-controls="nav-detail-tasks" aria-selected="false">Tasks</a>
    </div>
</nav>
<div class="tab-content mt-10px" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-detail-overview" role="tabpanel" aria-labelledby="nav-detail-overview-tab">

        <div class="card__body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-projects group-detail-icon-projects" data-width="150" data-height="150" data-bg="#ffc98b"></div>
                </div>
                <div class="col-lg-9">
                    <div class="leader">
                        <p><b>Leader : </b></p>
                        <figure class="leader-avatar-figure"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo !empty($project->avatar) ? $project->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                        <span><?php echo $project->display_name; ?></span>
                    </div>
                    <br>
                    <p><b>Description : </b><?php echo !empty($project->description) ? $project->description : '(trống)'; ?></p>
                </div>
                <div class="col-lg-12">
                    <div class="group-member">
                        <div class="name">
                            <h5 class="lcl lcl-1">Group Member</h5>
                        </div>
                        <div class="list-link list-user">
                            <?php foreach ($projectUsers as $user) : ?>
                                <div class="user">
                                    <div class="group-member-avatar ov-h">
                                        <?php if (empty($user->avatar)) : ?>
                                            <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt="">
                                        <?php else : ?>
                                            <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo $user->avatar; ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <small><?php echo $user->display_name; ?></small>
                                </div>
                            <?php endforeach; ?>
                            <?php
                            if ($projectUsers) {
                                $hasPermission = false;
                                foreach ($projectUsers as $projectUser) {
                                    if ($projectUser->id == $infoLog->id) {
                                        $hasPermission = true;
                                    }
                                }
                            }
                            ?>
                            <?php if ($project->leader == $infoLog->id || $hasPermission) : ?>
                                <div class="add-user" data-fancybox data-src="#block-invite-project">Invite +</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-n">
            <div class='block-invite-project' id="block-invite-project" data-max-width="900">
                <h2>Invite people to this Project</h2>
                <p>Your teammates will be added to your teamtest.</p>
                <div class="block-form">
                    <form action="#">
                        <div class="form-group form-group-email">
                            <label id="email">Email Address</label>
                            <textarea id="email" name="email" placeholder="name@company.com, name@company.com......"></textarea>
                        </div>
                        <div class="form-group">
                            <?php if ($possibleUsers) : ?>
                                <div class="project-possible-users-list">
                                    <?php foreach ($possibleUsers as $possibleUser) : ?>
                                        <div class="project-possible-user">
                                            <?php if (empty($possibleUser->avatar)) : ?>
                                                <figure>
                                                    <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt="">
                                                </figure>
                                            <?php else : ?>
                                                <figure>
                                                    <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo $possibleUser->avatar; ?>" alt="">
                                                </figure>
                                            <?php endif; ?>
                                            <span>
                                                <?php echo $possibleUser->display_name; ?> - <?php echo $possibleUser->email; ?></span>
                                            <input type="hidden" class="project-possible-user-email" value="<?php echo $possibleUser->email; ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                No Users
                            <?php endif; ?>
                        </div>
                        <div class="form-group ta-r">
                            <button class="btn btn-send-invite" redirect-url="<?php echo $_SERVER['QUERY_STRING'] ? site_url($this->uri->uri_string()) . '?' . $_SERVER['QUERY_STRING'] : $url; ?>" data-url="<?php echo site_url('dashboard/project?act=add_member&id=' . $project->id . '&token=' . $infoLog->token); ?>">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php //print_r($project);
        ?>
        <div class="card__header">
            <div class="card__header-title">
                <h3>Tasks</h3>
            </div>
        </div>
        <div class="card__body">
            <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
            <div class="block-list-recent">
                <div class="title">Assigned to me</div>
                <div class="list-item">
                    <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                    <?php if ($taskAssignedToMe) : ?>
                        <?php foreach ($taskAssignedToMe as $task) : ?>
                            <a href="<?php echo site_url('dashboard/task?act=task_detail&id=' . $task->id . '&token=' . $infoLog->token); ?>">
                                <div class="item">
                                    <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div>
                                    <div class="text">
                                        <div class="name"><?php echo $task->name . ' (ID#: ' . $task->id . ')'; ?></div>
                                        <div class="history">Changed Recently: <?php echo $task->last_update; ?></div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        No Task Found
                    <?php endif; ?>
                </div>
            </div>
            <div class="block-list-recent">
                <div class="title">Monitor Task</div>
                <div class="list-item">
                    <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                    <?php if ($taskMonitoredByMe) : ?>
                        <?php foreach ($taskMonitoredByMe as $task) : ?>
                            <a href="<?php echo site_url('dashboard/task?act=task_detail&id=' . $task->id . '&token=' . $infoLog->token); ?>">
                                <div class="item">
                                    <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div>
                                    <div class="text">
                                        <div class="name"><?php echo $task->name . ' (ID#: ' . $task->id . ')'; ?></div>
                                        <div class="history">Changed Recently: <?php echo $task->last_update; ?></div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        No Task Found
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    <div class="tab-pane fade" id="nav-detail-tasks" role="tabpanel" aria-labelledby="nav-detail-tasks-tab">
        <div class="card__body">
            <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
            <div class="block-list-recent">
                <div class="title">All Recently Modified Task</div>
                <div class="list-item">
                    <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                    <?php if ($recentTasks) : ?>
                        <?php foreach ($recentTasks as $recentTask) : ?>
                            <div class="item">
                                <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div>
                                <div class="text">
                                    <div class="name"><?php echo $recentTask->name . '(ID#: ' . $recentTask->id . ')'; ?></div>
                                    <div class="history">Changed Recently: <?php echo $recentTask->last_update; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        No recent tasks
                    <?php endif; ?>
                </div>
                <div class="item" data-type="add-news-item">
                    <div class="btn btn-add-new-project" data-fancybox data-src="#block-new-task"><a class="">New Task</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-n">
    <div id="block-new-task" data-max-width="900">
        <h2>New Task</h2>
        <p>Create new Task for Project (<?php echo $project->name; ?>).</p>
        <div class="block-form">
            <form action="#">
                <div class="form-group">
                    <label>Project Title</label>
                    <input type="text" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Assignee</label>
                    <select name='assignee' class="form-control">
                        <optgroup>
                            <option value=0>Default</option>
                            <?php foreach ($projectUsers as $projectUser) : ?>
                                <option value='<?php echo $projectUser->id; ?>'><?php echo $projectUser->display_name; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Report to</label>
                    <select name='report_to' class="form-control">
                        <option value=0>Default</option>
                        <?php foreach ($projectUsers as $projectUser) : ?>
                            <option value='<?php echo $projectUser->id; ?>'><?php echo $projectUser->display_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-view-more w-100" data-url="<?php echo site_url('dashboard/project?act=new_task_save&id=' . $project->id . '&token=' . $infoLog->token); ?>">New Tasks</button>
                </div>
            </form>
        </div>
    </div>
</div>