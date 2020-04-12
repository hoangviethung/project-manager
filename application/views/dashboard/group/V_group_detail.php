<div class="card__header">
    <div class="card__header-title">
        <h3><?php echo $group->name; ?> <br>(ID#: <?php echo $group->id;?>)</h3>
    </div>
    <div class="card__header-actions"><a class="link" href="<?php echo site_url('dashboard/group'); ?>">See all my Groups</a></div>
</div>
<nav>
    <div class="nav nav-tabs group-detail-tab-list" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active group-detail-tab-item" id="nav-detail-overview-tab" data-toggle="tab" href="#nav-detail-overview" role="tab" aria-controls="nav-detail-overview" aria-selected="true">Overview</a>
        <a class="nav-item nav-link group-detail-tab-item" id="nav-detail-projects-tab" data-toggle="tab" href="#nav-detail-projects" role="tab" aria-controls="nav-detail-projects" aria-selected="false">Projects</a>
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
                        <figure class="leader-avatar-figure"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo !empty($group->avatar) ? $group->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                        <span><?php echo $group->display_name; ?></span>
                    </div>
                    <br>
                    <p><b>Description : </b><?php echo !empty($group->description) ? $group->description : '(trống)'; ?></p>
                </div>
                <div class="col-lg-12">
                    <div class="group-member">
                        <div class="name">
                            <h5 class="lcl lcl-1">Group Member</h5>
                        </div>
                        <div class="list-link list-user">
                            <?php foreach ($users as $user) : ?>
                                <div class="user">
                                    <div class="group-member-avatar ov-h">
                                        <?php if (empty($user->avatar)) : ?>
                                            <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt="">
                                        <?php else : ?>
                                            <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo $user->avatar; ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <p><?php echo $user->display_name; ?></p>
                                </div>
                            <?php endforeach; ?>
                            <div class="add-user" data-fancybox data-src="#block-invite-group">Invite +</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-list-recent mt-10px">
                <div class="title">Announcement</div>
                <div class="list-item">
                    <?php if ($announcements) : ?>
                        <?php foreach ($announcements as $announcement) : ?>
                            <p class='float-right'><small><?php echo $announcement->created_at;?></small></p>
                            <div class="name">
                            <h5 class="lcl lcl-1"><?php echo $announcement->title;?></h5>
                            </div>
                            <?php echo $announcement->description;?>
                            <hr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Không có thông báo</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($infoLog->id == $group->leader) : ?>
                <div id="block-announcement">
                    <div class="block-form anouncement-form">
                        <form action="#">
                            <div class="form-group">
                            <label id="description">New Announcement</label>
                                <input name="title" placeholder="Anouncement's title"></input>
                            </div>
                            <div class="form-group">
                                
                                <textarea name="description" placeholder="Content"></textarea>
                            </div>
                            <div class="form-group ta-r">
                                <button class="btn btn-send-invite" data-url="<?php echo site_url('dashboard/group?act=new_announcement_save&id='.$group->id.'&token='.$infoLog->token);?>">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="d-n">
            <div id="block-invite-group" data-max-width="580">
                <h2>Invite people to this Project</h2>
                <p>Your teammates will get an email that gives them access to your team.</p>
                <div class="block-form">
                    <form action="#">
                        <div class="form-group">
                            <label id="email">Email Address</label>
                            <input id="email" name="email" placeholder="name@company.com"></input>
                        </div>
                        <div class="form-group ta-r">
                            <button class="btn btn-send-invite" data-url="<?php echo site_url('dashboard/group?act=invite_member&id=' . $this->id . '&token=' . $infoLog->token); ?>">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php //print_r($group);
        ?>
    </div>
    <div class="tab-pane fade" id="nav-detail-projects" role="tabpanel" aria-labelledby="nav-detail-projects-tab">
        <div class="card__body">
            <div class="block-list-recent">
                <div class="title">Projects</div>
                <div class="list-item">
                    <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                    <?php if ($projects) : ?>
                        <?php foreach ($projects as $project) : ?>
                            <div class="item">
                                <div class="icon-projects" data-width="40" data-height="40" data-bg="#EA4E9D"></div>
                                <div class="text">
                                    <div class="name"><a href="<?php echo site_url('dashboard/project?act=project_detail&id='.$project->id.'&token='.$infoLog->token);?>"><?php echo !empty($project->name) ? $project->name : "Không Tên"; ?> (ID#: <?php echo $project->id;?>)</a></div>
                                    <div class="history">Last Updated : <?php echo $project->last_update; ?></div>
                                </div>
                                <div class="list-user list-user-project ml-at">
                                <span><?php echo $project->display_name;?></span>
                                    <!-- USER CÓ ẢNH-->
                                    <div class="user">
                                        <?php if (empty($project->avatar)) : ?>
                                            <div class="avatar ov-h"><img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt=""></div>
                                        <?php else : ?>
                                            <div class="avatar ov-h"><img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo $project->avatar; ?>" alt=""></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php 
                                    if($project->projectUsers)
                                    {
                                        $hasPermission = false;
                                        foreach($project->projectUsers as $projectUser){
                                            if($projectUser->id == $infoLog->id)
                                            {
                                                $hasPermission = true;
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if ($project->leader == $infoLog->id || $hasPermission) : ?>
                                        <div class="add-user" data-fancybox data-src="#block-invite-project-<?php echo $project->id; ?>">Invite +</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="d-n">
                                <div class='block-invite-project' id="block-invite-project-<?php echo $project->id; ?>" data-max-width="900">
                                    <h2>Invite people to this Project</h2>
                                    <p>Your teammates will be added to your team.</p>
                                    <div class="block-form">
                                        <form action="#">
                                            <div class="form-group form-group-email">
                                                <label id="email">Email Address</label>
                                                <textarea id="email" name="email" placeholder="name@company.com, name@company.com......"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <?php if ($project->possibleUsers) : ?>
                                                    <div class="project-possible-users-list">
                                                        <?php foreach ($project->possibleUsers as $possibleUser) : ?>
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
                                                <button class="btn btn-send-invite" redirect-url="<?php echo $_SERVER['QUERY_STRING']? site_url($this->uri->uri_string()).'?'.$_SERVER['QUERY_STRING'] : $url;?>" data-url="<?php echo site_url('dashboard/project?act=add_member&id=' . $project->id . '&token=' . $infoLog->token); ?>">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        No project
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="item" data-type="add-news-item">
            <div class="btn btn-add-new-project" data-fancybox data-src="#block-new-project"><a class="">New Project</a></div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-detail-tasks" role="tabpanel" aria-labelledby="nav-detail-tasks-tab">
        <div class="card__body">
            <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
            <div class="block-list-recent">
                <div class="title">Recent Tasks</div>
                <div class="list-item">
                    <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
                    <?php if (isset($tasks)&&$tasks) : ?>
                        <?php foreach ($tasks as $task) : ?>
                            <div class="item">
                                <!-- <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div> -->
                                <div class="text">
                                    <div class="name"><?php echo $task->name;?> (ID#: <?php echo $task->id;?>)</div>
                                    <div class="history">Changed Recently: <?php echo $task->last_update;?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        No recent tasks
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-n">
    <div id="block-new-project" data-max-width="900">
        <h2>New Project</h2>
        <p>Create new Project for this Group.</p>
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
                    <button class="btn btn-view-more w-100" data-url="<?php echo site_url('dashboard/group?act=new_project_save&id=' . $group->id . '&token=' . $infoLog->token); ?>">New Project</button>
                </div>
            </form>
        </div>
    </div>
</div>