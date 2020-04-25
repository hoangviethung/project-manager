<?php if (isset($_SESSION['system_msg'])) {
    echo $_SESSION['system_msg'];
}
unset($_SESSION['system_msg']);
?>
<div class="card__header">
    <div class="card__header-title">
        <h3><?php echo $task->name; ?> <br>(ID#: <?php echo $task->id; ?>)</h3>
    </div>
    <div class="card__header-actions"><a class="link" href="<?php echo site_url('dashboard/task'); ?>">See all my Task</a></div>
</div>
<nav>

    <!-- Nút pick uptask -->
    <?php if ($task->status == 0) : ?>
        <?php if ($task->assignee != $infoLog->id) : ?>
            <a class='btn btn-info float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=pick_up_task&task=new&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Pick Up</a>
        <?php endif; ?>
    <?php else : ?>
        <?php if ($task->assignee != $infoLog->id) : ?>
            <a class='btn btn-info float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=pick_up_task&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Pick Up</a>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Nút thao tác Task khác -->
    <?php if ($task->status == 1) : ?>
        <a class='btn btn-danger float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=change_task_done&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Done</a>
    <?php elseif ($task->status == 2 && $task->report_to != $infoLog->id) : ?>
        <a class='btn btn-success float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=confirm_task&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Confirm Task</a>
        <a class='btn btn-danger float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=change_task_not_done&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Not Done</a>
    <?php elseif ($task->status == 3) : ?>
        <a class='btn btn-info float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=reopen_task&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Reopen Task</a>
    <?php endif; ?>
    <span class='float-right'>    Action: </span>
    <div class="nav nav-tabs group-detail-tab-list" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active group-detail-tab-item">Overview</a>
    </div>
</nav>
<div class="card__body">
    <div class="row">
        <div class="col-sm-3">
            <div class="leader">
            <a data-fancybox class='link-item' data-src="#block-edit-task">Edit Info</a>
                <p class="mb-0"><b>Created at:</b></p>
                <p><small><?php echo $task->created_at; ?></small></p>
                <p class='mb-0'><b>Status: </b>
                    <?php switch ($task->status) {
                        case 0:
                            echo "<button class='btn btn-warning text-light status-button'>New</button>";
                            break;
                        case 1:
                            echo "<button class='btn btn-primary text-light status-button'>Working On</button>";
                            break;
                        case 2:
                            echo "<button class='btn btn-info text-light status-button'>Done</button>";
                            break;
                        case 3:
                            echo "<button class='btn btn-success text-light status-button'>Confirmed</button>";
                            break;
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="leader text-center">
                <p><b>Assignee : </b></p>
                <?php if ($task->assignee != 0) : ?>
                    <figure class="leader-avatar-figure m-auto"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>public/avatar/<?php echo !empty($assignee->avatar) ? $assignee->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                    <span><?php echo $assignee->display_name; ?></span>
                <?php else : ?>
                    No user assigned
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="leader text-center">
                <p><b>Assigner : </b></p>
                <?php if ($assigner) : ?>
                    <figure class="leader-avatar-figure m-auto"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>public/avatar/<?php echo !empty($assigner->avatar) ? $assigner->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                    <span><?php echo $assigner->display_name; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="leader text-center">
                <p><b>Report to : </b></p>
                <?php if ($task->report_to != 0) : ?>
                    <figure class="leader-avatar-figure m-auto"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>public/avatar/<?php echo !empty($report_to->avatar) ? $report_to->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                    <span><?php echo $report_to->display_name; ?></span>
                <?php else : ?>
                    No user assigned
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-12">
            <p><b>Description : </b><?php echo !empty($task->description) ? $task->description : '(trống)'; ?></p>
        </div>
    </div>
</div>
<div class="card__body">
    <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
    <div class="block-list-recent">
        <div class="title">Comments</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if (isset($task_comments) && $task_comments) : ?>
                <?php foreach ($task_comments as $comment) : ?>
                    <?php if ($comment->description == '' && !isset($comment->files)) : ?>
                    <?php else : ?>
                        <div class="item mt-4 mb-4">
                            <div class="text">
                                <div class="history float-right"><?php echo $comment->created_at; ?></div>
                                <div class="comment-user">
                                    <figure class="leader-avatar-figure"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>public/avatar/<?php echo !empty($comment->avatar) ? $comment->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                                    <span><?php echo $comment->display_name; ?></span>
                                </div>
                                <div class="comment-content"><?php echo $comment->description; ?>
                                <?php if (isset($comment->files)) : ?>
                                    <?php foreach ($comment->files as $commentFile) : ?>
                                        <div class='comment-file mt-4'>
                                            <?php if (!empty($commentFile->file) || $commentFile->file) : ?>
                                                <img src='<?php echo base_url('assets/public/comment/' . $commentFile->file); ?>'>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo base_url('assets/public/comment/' . $commentFile->file); ?>"><?php echo $commentFile->file; ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                No comment
            <?php endif; ?>
        </div>
        <?php echo form_open_multipart(site_url('dashboard/task?act=new_comment_save&id=' . $task->id . "&token=" . $infoLog->token), array('autocomplete' => "off", 'id' => "userform" . $task->id)); ?>
        <div class="form-group required">
            <label class="control-label">Comment</label>
            <textarea id="content" class="form-control" name="description" row=4></textarea>
        </div>
        <script>
            var editor = CKEDITOR.replace('description', {
                language: 'vi',
                filebrowserBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html" ?>',
                filebrowserImageBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html?type=Images" ?>',
                filebrowserFlashBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html?type=Flash" ?>',
                filebrowserUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files" ?>',
                filebrowserImageUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images" ?>',
                filebrowserFlashUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash" ?>',
            });
        </script>

        <div class="img_input">
            <img id="imgFile_01" class="imgFile img-fluid" alt="Avatar" src="<?php echo base_url('assets/public/avatar/no-avatar.png'); ?>" style="width:100px" />
            <input type="file" name="image[]" id="chooseImgFile" multiple="multiple" onchange="uploadMultiple(this.files)" style="height:100px;width:100px;">
        </div>
        <script>
            function uploadMultiple(files) {
                var i;
                for (i = 0; i < files.length; i++) {
                    var fileUrl = window.URL.createObjectURL(files[i]);
                    var file = '<img class="imgFile img-fluid" alt="' + files[i].name + '" src="' + fileUrl + '" style="max-width:100px;margin-right:10px; margin-bottom:10px"/>'
                    $('.img_input').append(file);
                }
            }
        </script>

        <button type="submit" id="formSubmit" class="btn btn-primary">Submit</button>

        <?php echo form_close(); ?>
    </div>
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
<div class="d-n">
    <div class="block-form-ajax" id="block-edit-task" data-max-width="900">
        <h2>Edit Info</h2>
        <div class="block-form">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="name" placeholder="" value="<?php echo $task->name;?>">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4"><?php echo $task->description;?></textarea>
                </div>
                <?php if($infoLog->id == $project->leader || $infoLog->id == $task->assigner || $infoLog->id == $task->report_to):?>
                <div class="form-group">
                    <label>Assignee</label>
                    <select name='assignee' class="form-control">
                        <optgroup>
                            <option value=0>Default</option>
                            <?php foreach ($projectUsers as $projectUser) : ?>
                                <option value='<?php echo $projectUser->id; ?>' <?php echo $projectUser->id == $task->assignee?'selected':'';?>><?php echo $projectUser->display_name; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>
                <?php endif;?>
                <div class="form-group">
                    <button class="btn btn-view-more w-100" data-url="<?php echo site_url('dashboard/task?act=edit_save&id=' . $task->id . '&token=' . $infoLog->token); ?>">Edit Task</button>
                </div>
        </div>
    </div>
</div>