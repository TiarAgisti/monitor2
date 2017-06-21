		<?php if(info_page()['title'] != 'login'): ?>
				</div>
			</div>
			<!-- start: FOOTER -->
			<footer>
				<div class="footer-inner">
					<div class="pull-left">
						<?php copyright(); ?>
					</div>
					<div class="pull-right">
						<span class="go-top"><i class="ti-angle-up"></i></span>
					</div>
				</div>
			</footer>
			<!-- end: FOOTER -->
			<?php //is_offsidebar(); ?>
		</div>
		<!-- Large Modal -->
		<div class="modal fade bs-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-dialog modal-lg">
				<div class="modal-content bg-white">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">
						Modal Content
					</div>
					<div class="modal-footer">
						Modal Footer
					</div>
				</div>
			</div>
		</div>
		<!-- /Large Modal -->
		<!-- Small Modal -->
		<div class="modal fade bs-modal-sm"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog modal-sm">
				<div class="modal-content bg-white">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">
						Modal Content
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary">
							Save changes
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /Small Modal -->
		<?php endif; ?>

		<!-- start: MAIN JAVASCRIPTS -->
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/modernizr/modernizr.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/toastr/toastr.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/DataTables/jquery.dataTables.min.js"></script>
		<!-- <script src="<?php echo SERVER_PUBLIC; ?>vendor/DataTables/jquery-1.12.4.js"></script> <!-- add by tiar --> -->
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/sweetalert/sweet-alert.min.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/format-currency/jquery.formatCurrency-1.4.0.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="<?php echo SERVER_PUBLIC; ?>assets/js/config.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>assets/js/main.js"></script>
		<script src="<?php echo SERVER_PUBLIC; ?>vendor/Chart.js/Chart.min.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<?php if(info_page()['title'] == 'login'): ?>
		<script src="<?php echo SERVER_PUBLIC; ?>assets/js/login.js"></script>
		<?php else: ?>
			<script src="<?php echo SERVER_PUBLIC; ?>assets/js/table-data.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>assets/js/report-data.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>assets/js/form-elements.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>assets/function/button.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>assets/function/others.js"></script>
			<!-- add by tiar -->
			<script src="<?php echo SERVER_PUBLIC; ?>assets/js/sum().js"></script>
			<!-- end add -->

			<!-- add by tiar -->
			<script src="<?php echo SERVER_PUBLIC; ?>assets/js/jquery.maskMoney.min.js"></script>
			<!-- end add -->

		<?php endif; ?>
			<script src="<?php echo SERVER_PUBLIC; ?>vendor/selectFx/classie.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>vendor/selectFx/selectFx.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>vendor/autosize/autosize.min.js"></script>
			<script src="<?php echo SERVER_PUBLIC; ?>vendor/select2/select2.min.js"></script>
		
		<script>
			jQuery(document).ready(function() {
				Config.init();
				Main.init();
				<?php if(info_page()['title'] == 'login'): ?>
				Login.init();
				<?php else: ?>
				TableData.init();
				ReportData.init();
				FormElements.init();
				Button.init();
				Others.init();
				<?php endif; ?>
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>