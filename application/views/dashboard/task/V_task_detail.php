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
    <?php elseif ($task->status == 2) : ?>
        <a class='btn btn-success float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=confirm_task&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Confirm Task</a>
        <a class='btn btn-danger float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=change_task_not_done&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Not Done</a>
    <?php elseif ($task->status == 3) : ?>
        <a class='btn btn-info float-right text-light font-weight-bold status-button' href='<?php echo site_url('dashboard/task?act=reopen_task&id=' . $task->id . '&token=' . $infoLog->token); ?>'>Reopen Task</a>
    <?php endif; ?>
    <div class="nav nav-tabs group-detail-tab-list" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active group-detail-tab-item">Overview</a>
    </div>
</nav>
<div class="card__body">
    <div class="row">
        <div class="col-sm-3">
            <div class="leader">
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
                    <figure class="leader-avatar-figure m-auto"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo !empty($assigner->avatar) ? $assigner->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                    <span><?php echo $assigner->display_name; ?></span>
                <?php else : ?>
                    No user assigned
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="leader text-center">
                <p><b>Assigner : </b></p>
                <?php if ($assigner) : ?>
                    <figure class="leader-avatar-figure m-auto"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo !empty($assigner->avatar) ? $assigner->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
                    <span><?php echo $assigner->display_name; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="leader text-center">
                <p><b>Report to : </b></p>
                <?php if ($task->report_to != 0) : ?>
                    <figure class="leader-avatar-figure m-auto"><img class="leader-avatar" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo !empty($report_to->avatar) ? $report_to->avatar : "user-default.png"; ?>" alt="" srcset=""></figure>
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
                    <div class="item">
                        <!-- <div class="icon-projects" data-width="20" data-height="20" data-bg="#EA4E9D"></div> -->
                        <div class="text">
                            <div class="name"><?php echo $comment->created_at; ?></div>
                            <div class="history"><?php echo $comment->description; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                No comment
            <?php endif; ?>
        </div>
        <?php echo form_open_multipart(site_url('admin/product?act=save_img&product_id=' . $task->id . "&token=" . $infoLog->token), array('autocomplete' => "off", 'id' => "userform" . $task->id)); ?>
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
                    var file = '<img class="imgFile img-fluid" alt="'+files[i].name+'" src="' + fileUrl + '" style="max-width:100px;margin-right:10px; margin-bottom:10px"/>'
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