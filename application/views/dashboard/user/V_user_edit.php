<?php if (isset($_SESSION['system_msg'])) {
    echo $_SESSION['system_msg'];
}
unset($_SESSION['system_msg']);
?>
<div class="card__header">
    <div class="card__header-title">
        <h3><?php echo $infoLog->displayName; ?> <br>(ID#: <?php echo $infoLog->id; ?>)</h3>
    </div>
</div>
<nav>
    <div class="card__body">
        <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
        <div class="block-list-recent">
        <?php echo form_open_multipart(site_url('dashboard/user/edit_user_save'), array('autocomplete' => "off", 'id' => "userform" . $infoLog->id)); ?>
            <div class="img_input">
                <div>
                    <img id="imgFile_01" class="imgFile img-fluid" alt="Avatar" src="<?php echo base_url('assets/public/avatar/' . $infoLog->avatar); ?>" style="max-width:150px;margin-bottom:20px;" />
                    <input type="file" name="image" id="chooseImgFile" onchange="document.getElementById('imgFile_01').src = window.URL.createObjectURL(this.files[0])" style="height:150px;width:150px;">
                </div>
            </div>
            <div class="title">User Information</div>
            <div class="form-group required">
                <label class="control-label">Display Name</label>
                <input type='text' class="form-control" name="display_name" value="<?php echo $infoLog->displayName; ?>">
            </div>
            <div class="form-group required">
                <label class="control-label">Password (leave blank if no change)</label>
                <input type='password' class="form-control" name="password">
            </div>
            <!-- <script>
            var editor = CKEDITOR.replace('description', {
                language: 'vi',
                filebrowserBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html" ?>',
                filebrowserImageBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html?type=Images" ?>',
                filebrowserFlashBrowseUrl: '<?php echo base_url() . "filemanager/ckfinder/ckfinder.html?type=Flash" ?>',
                filebrowserUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files" ?>',
                filebrowserImageUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images" ?>',
                filebrowserFlashUploadUrl: '<?php echo base_url() . "filemanager/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash" ?>',
            });
        </script> -->


            <button type="submit" id="formSubmit" class="btn btn-primary">Submit</button>

            <?php echo form_close(); ?>
        </div>
    </div>