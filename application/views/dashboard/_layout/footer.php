</div>
</div>
</main>
<!-- BLOCK FORMS LOGIN - CLICK SEND AJAX (res.Code = 200 -> True, != 200 -> False)-->
<div class="d-n">
	<div id="block-invite" data-max-width="580">
		<h2>Invite people to this Group</h2>
		<p>Your teammates will get an email that gives them access to your team.</p>
		<div class="block-form">
			<form action="#">
				<div class="form-group">
					<label id="email">Email Address</label>
					<textarea id="email" name="email" placeholder="name@company.com, name@company.com......"></textarea>
				</div>
				<div class="form-group">
					<label id="project">Choose a starting project</label>
					<input id="project" type="text" name="project" placeholder="Star typing to add a project">
				</div>
				<div class="form-group ta-r">
					<button class="btn btn-send-invite" data-url="link-ajax">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/popper.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url('statics/default/'); ?>js/core.min.js"></script>
<script src="<?php echo base_url('statics/default/'); ?>js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url('statics/default/'); ?>js/main.js"></script>
<?php $this->load->view('dashboard/_layout/scripts');?>
</body>

</html>