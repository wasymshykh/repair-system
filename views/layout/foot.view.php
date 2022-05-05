
						</div>
						<!--end::Post-->
					</div>
					<!--end::Container-->

                    <!--layout-partial:layout/_footer.html-->				
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-center">
							<!--begin::Copyright-->
							<div class="text-dark text-center">
								<span class="text-muted fw-bold me-1">2022 ©</span>
								<a href="<?=URL?>" class="text-gray-800 text-hover-primary"><?=$Settings->fetch('site_name')?></a>
							</div>
							<!--end::Copyright-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->

				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		
    <!--begin::Javascript-->
    <script>var hostUrl = "<?=URL?>/assets/";</script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
</body>
</html>
