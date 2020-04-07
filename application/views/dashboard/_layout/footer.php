</div>
</div>
</main>
<!-- BLOCK FORMS LOGIN - CLICK SEND AJAX (res.Code = 200 -> True, != 200 -> False)-->
<div class="d-n">
	<div id="block-invite" data-max-width="580">
		<h2>Invite people to this Project</h2>
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
<script type="text/javascript" src="<?php echo base_url('statics/default/'); ?>js/core.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('statics/default/'); ?>js/main.min.js"></script>
<?php $this->load->view('dashboard/_layout/scripts');?>
</body>

</html>