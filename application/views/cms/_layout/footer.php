			</div>
			<!-- END: .app-container -->
			
			<!-- begin .app-footer -->
			<footer class="app-footer p-t-10 text-white">
				<!-- <div class="container-fluid">
					<p class="text-center small">
						&copy; 
					</p>
				</div> -->
			</footer>
			<!-- END: .app-footer -->

		</div>
		<!-- END: .app-wrap -->
	</div>
	<!-- END: .app -->

	<span class="fa fa-angle-up" id="totop" data-plugin="totop"></span>

	<!-- Vendor javascript files. REQUIRED -->
	<script src="statics/directory/js/vendor.js"></script>
	<script src="statics/directory/vendor/waypoints/jquery.waypoints.js"></script>
	<script src="statics/directory/vendor/counterup/jquery.counterup.js"></script>
	<!-- END: End javascript files -->
	<script src="<?php echo base_url();?>node_modules\datatables.net\js\jquery.dataTables.js"></script>
	<script src="node_modules/chart.js/dist/Chart.js"></script>
	<script src="node_modules/moment/moment.js"></script>
	<?php $this->load->view('cms/_layout/scripts');?>

	<script src="statics/directory/js/chl.js"></script>
	<script src="statics/directory/js/chl-demo.js"></script>

	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 3000);
	</script>
	
</body>

</html>
