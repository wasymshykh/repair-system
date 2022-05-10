
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?=$page_title?></title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

	<?php if (isset($custom_head_css) && !empty($custom_head_css)): ?>
		<?php foreach ($custom_head_css as $css): ?>
			<link href="<?=$css?>" rel="stylesheet" type="text/css" />
		<?php endforeach; ?>
	<?php endif; ?>

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <?=css_link('assets/plugins/global/plugins.bundle', true)?>
    <?=css_link('assets/css/style.bundle', true)?>
    <!--end::Global Stylesheets Bundle-->

</head>
<body class="page-loading-enabled page-loading header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

    <!--begin::loader-->
    <div class="page-loader">
        <span class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </span>
    </div>
    <!--end::Loader-->


		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                    <!--layout-partial:layout/header/_base.html-->
					<!--begin::Header-->
					<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						<!--begin::Container-->
						<div class="container-xxl d-flex flex-grow-1 flex-stack">
							<!--begin::Header Logo-->
							<div class="d-flex align-items-center me-5">
								<!--begin::Heaeder menu toggle-->
								<div class="d-lg-none btn btn-icon btn-active-color-primary w-30px h-30px ms-n2 me-3" id="kt_header_menu_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
								<!--end::Heaeder menu toggle-->
								<!--begin::Logo-->
								<a href="<?=href('index')?>">
									<img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-25px h-lg-30px" />
								</a>
								<!--end::Logo-->
								
							</div>
							<!--end::Header Logo-->

                            <!--layout-partial:layout/header/__topbar.html-->
							
							<!--begin::Toolbar wrapper-->
							<div class="topbar d-flex align-items-stretch flex-shrink-0" id="kt_topbar">
								
								<!--begin::User-->
								<div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
									<!--begin::Menu wrapper-->
									<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<img src="assets/media/avatars/300-1.jpg" alt="user" />
									</div>

                                    <!--layout-partial:partials/menus/_user-account-menu.html-->						
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="assets/media/avatars/300-1.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bolder d-flex align-items-center fs-5"><?=$logged_user['user_name']?>
													<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"><?=$logged_user['role_name']?></span></div>
													<a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?=$logged_user['user_email']?></a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?=href('user_settings')?>" class="menu-link px-5">Account Settings</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?=href('user_settings')?>" class="menu-link px-5">Account Logs</a>
										</div>
										<!--end::Menu item-->

										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?=href('logout')?>" class="menu-link px-5">Sign Out</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->

									<!--end::Menu wrapper-->
								</div>
								<!--end::User -->
								<!--begin::Heaeder menu toggle-->
								<!--end::Heaeder menu toggle-->
							</div>
							<!--end::Toolbar wrapper-->
							
						</div>
						<!--end::Container-->
						<!--begin::Container-->
						<div class="header-menu-container d-flex align-items-stretch flex-stack h-lg-75px w-100" id="kt_header_nav">

                            <!--layout-partial:layout/header/__menu.html-->
							<!--begin::Menu wrapper-->
							<div class="header-menu container-xxl flex-column align-items-stretch flex-lg-row" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
								<!--begin::Menu-->
								<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch flex-grow-1" id="#kt_header_menu" data-kt-menu="true">
									<a href="<?=href('index')?>" class="menu-item <?=isset($page_type) && $page_type=="dashboard"?'here':''?> me-lg-1">
										<span class="menu-link py-3">
											Dashboards
										</span>
                                    </a>
									
									<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
										<span class="menu-link py-3">
											<span class="menu-title">Users</span>
											<span class="menu-arrow"></span>
										</span>
										<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
											
											<div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<span class="menu-link py-3">
													<span class="menu-icon">
														<!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
														<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
																<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<span class="menu-title">Users Management</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px">
													<div class="menu-item">
														<a class="menu-link py-3" href="<?=href('user_create')?>">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
															<span class="menu-title">Create User</span>
														</a>
													</div>
													<div class="menu-item">
														<a class="menu-link py-3" href="<?=href('users')?>">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
															<span class="menu-title">Users List</span>
														</a>
													</div>
												</div>
											</div>
											
											<div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">
												<span class="menu-link py-3">
													<span class="menu-icon">
														<!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
														<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor" />
																<path d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
													<span class="menu-title">Roles Management</span>
													<span class="menu-arrow"></span>
												</span>
												<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg py-lg-4 w-lg-225px">
													<div class="menu-item">
														<a class="menu-link py-3" href="<?=href('role_create')?>">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
															<span class="menu-title">Create Role</span>
														</a>
													</div>
													<div class="menu-item">
														<a class="menu-link py-3" href="<?=href('roles')?>">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
															<span class="menu-title">Roles List</span>
														</a>
													</div>
												</div>
											</div>
											
										</div>
									</div>

									<a href="<?=href('types')?>" class="menu-item <?=isset($page_type) && $page_type=="types"?'here':''?> me-lg-1">
										<span class="menu-link py-3">Types</span>
                                    </a>
								</div>
								<!--end::Menu-->

								<div class="d-flex align-items-stretch flex-shrink-0 p-4 p-lg-0 me-lg-2">
									<div class="d-flex align-items-center">
										<a href="<?=href('create_job')?>" class="btn btn-sm btn-primary">Create Job <i class="bi bi-arrow-right"></i></a>
									</div>
								</div>

                                
							</div>
							<!--end::Menu wrapper-->
							
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					
                    <!--layout-partial:layout/_toolbar.html-->
					<!--begin::Toolbar-->
					<div class="toolbar py-5 py-lg-7" id="kt_toolbar">
						<!--begin::Container-->
						<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">

                            <!--layout-partial:layout/_page-title.html-->			
							<!--begin::Page title-->
							<div class="page-title d-flex flex-column me-3">
								<!--begin::Title-->
								<h1 class="d-flex text-dark fw-bolder my-1 fs-3"><?=$page_title??''?>
								<?php if (!empty($page_description)): ?>
								<!--begin::Separator-->
								<span class="h-20px border-gray-400 border-start mx-3"></span>
								<!--end::Separator-->
								<!--begin::Description-->
								<small class="text-gray-500 fs-7 fw-bold my-1"><?=$page_description??''?></small>
								<?php endif; ?>
								<!--end::Description--></h1>
								<!--end::Title-->
							</div>
							<!--end::Page title-->
							
						</div>
						<!--end::Container-->
					</div>
					<!--end::Toolbar-->

					<!--begin::Container-->
					<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
						<!--begin::Post-->
						<div class="content flex-row-fluid" id="kt_content">
