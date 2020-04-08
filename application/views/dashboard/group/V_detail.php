<div class="card__header">
    <div class="card__header-title">
        <h3><?php echo $group->name; ?></h3>
    </div>
    <div class="card__header-actions"><a class="link" href="<?php echo site_url('dashboard/group'); ?>">See all my Groups</a></div>
</div>
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
                            <?php if(empty($user->avatar)):?>
                                <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/user-default.png" alt="">
                            <?php else:?>
                                <img class="ofcv" src="<?php echo base_url('assets/'); ?>images/admin/<?php echo $user->avatar;?>" alt="">
                            <?php endif;?>
                        </div>
                        <p><?php echo $user->display_name;?></p>
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
            <?php if($announcements):?>
                <?php foreach($announcements as $announcement):?>
                    
                <?php endforeach;?>
            <?php else:?>
                <p>Không có thông báo</p>
            <?php endif;?>
        </div>
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
					<button class="btn btn-send-invite" data-url="<?php echo site_url('dashboard/group?act=invite_member&id='.$this->id.'&token='.$infoLog->token);?>">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php //print_r($group);
?>