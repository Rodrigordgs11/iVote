
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic 
Product Version: 8.2.1
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="" />
		<title>Metronic - The World's #1 Selling Bootstrap Admin Template - Metronic by KeenThemes</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template - Metronic by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="/app/assets/media/logos/favicon.ico" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link rel="stylesheet" href="{{asset('/app/assets/css/style.bundle.css')}}">
		<link rel="stylesheet" href="{{asset('/app/assets/plugins/global/plugins.bundle.css')}}">
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Logo-->
				<a href="/" class="d-block d-lg-none mx-auto py-20">
					<img alt="Logo" src="/app/assets/media/logos/default.svg" class="theme-light-show h-25px" />
					<img alt="Logo" src="/app/assets/media/logos/default-dark.svg" class="theme-dark-show h-25px" />
				</a>
				<!--end::Logo-->
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
					<!--begin::Wrapper-->
					<div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
						<!--begin::Header-->
						<div class="d-flex flex-stack py-2">
							<!--begin::Back link-->
							<div class="me-2"></div>
							<!--end::Back link-->
							<!--begin::Sign Up link-->
							<div class="m-0">
								<span class="text-gray-500 fw-bold fs-5 me-2" data-kt-translate="sign-in-head-desc">Not a Member yet?</span>
								<a href="/app/register" class="link-primary fw-bold fs-5" data-kt-translate="sign-in-head-link">Sign Up</a>
							</div>
							<!--end::Sign Up link=-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->

						<div class="py-20">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
								@csrf
								<!--begin::Body-->
								<div class="card-body">
									<!--begin::Heading-->
									<div class="text-start mb-10">
										<!--begin::Title-->
										<h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="sign-in-title">Sign In</h1>
										<!--end::Title-->
										<!--begin::Text-->
										<div class="text-gray-500 fw-semibold fs-6" data-kt-translate="general-desc">Get unlimited access & earn money</div>
										<!--end::Link-->
									</div>
									<!--begin::Heading-->
									<!--begin::Input group=-->
									<div class="fv-row mb-8">
										<!--begin::Email-->
										<input type="text" placeholder="Email" name="email" autocomplete="off" data-kt-translate="sign-in-input-email" class="form-control form-control-solid" />
										<!--end::Email-->
									</div>
									<!--end::Input group=-->
									<div class="fv-row mb-7">
										<!--begin::Password-->
										<input type="password" placeholder="Password" name="password" autocomplete="off" data-kt-translate="sign-in-input-password" class="form-control form-control-solid" />
										<!--end::Password-->
									</div>
									<!--end::Input group=-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
										<div></div>
										<!--begin::Link-->
										<a href="forgot-password" class="link-primary" data-kt-translate="sign-in-forgot-password">Forgot Password ?</a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Actions-->
									<div class="d-flex flex-stack">
										<!--begin::Submit-->
										<button id="kt_sign_in_submit" class="btn btn-primary me-2 flex-shrink-0">
											<!--begin::Indicator label-->
											<span class="indicator-label" data-kt-translate="sign-in-submit">Sign In</span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress">
												<span data-kt-translate="general-progress">Please wait...</span>
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
											</span>
											<!--end::Indicator progress-->
										</button>
										<!--end::Submit-->
										<!--begin::Social-->
										<div class="d-flex align-items-center">
											<div class="text-gray-500 fw-semibold fs-6 me-3 me-md-6" data-kt-translate="general-or">Or</div>
											<!--begin::Symbol-->
											<a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
												<img alt="Logo" src="/app/assets/media/svg/brand-logos/google-icon.svg" class="p-4" />
											</a>
											<!--end::Symbol-->
											<!--begin::Symbol-->
											<a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
												<img alt="Logo" src="/app/assets/media/svg/brand-logos/facebook-3.svg" class="p-4" />
											</a>
											<!--end::Symbol-->
											<!--begin::Symbol-->
											<a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light">
												<img alt="Logo" src="/app/assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show p-4" />
												<img alt="Logo" src="/app/assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show p-4" />
											</a>
											<!--end::Symbol-->
										</div>
										<!--end::Social-->
									</div>
									<!--end::Actions-->
								</div>
								<!--begin::Body-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Body-->
						<!--begin::Footer-->
						<div class="m-0">
							<!--begin::Toggle-->
							<button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
								<img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3" src="/app/assets/media/flags/united-states.svg" alt="" />
								<span data-kt-element="current-lang-name" class="me-2">English</span>
								<i class="ki-outline ki-down fs-2 text-muted rotate-180 m-0"></i>
							</button>
							<!--end::Toggle-->
							<!--begin::Menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4" data-kt-menu="true" id="kt_auth_lang_menu">
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="/app/assets/media/flags/united-states.svg" alt="" />
										</span>
										<span data-kt-element="lang-name">English</span>
									</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="/app/assets/media/flags/spain.svg" alt="" />
										</span>
										<span data-kt-element="lang-name">Spanish</span>
									</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="/app/assets/media/flags/germany.svg" alt="" />
										</span>
										<span data-kt-element="lang-name">German</span>
									</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="/app/assets/media/flags/japan.svg" alt="" />
										</span>
										<span data-kt-element="lang-name">Japanese</span>
									</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
										<span class="symbol symbol-20px me-4">
											<img data-kt-element="lang-flag" class="rounded-1" src="/app/assets/media/flags/france.svg" alt="" />
										</span>
										<span data-kt-element="lang-name">French</span>
									</a>
								</div>
								<!--end::Menu item-->
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat" style="background-image: url(/app/assets/media/auth/bg11.png)"></div>
				<!--begin::Body-->
			</div>
			<!--end::Authentication - Sign-in-->

			@if($errors->any())
				<script>
					setTimeout(function() {
						var errorMessage = '';

						@foreach($errors->all() as $error)
							errorMessage += '{!! addslashes($error) !!}\n';
						@endforeach

						Swal.fire({
							text: errorMessage,
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-primary"
							}
						});
					}, 300);
				</script>
			@endif
			@if (session()->has('success'))
    <script>
        setTimeout(function() {
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }, 300);
    </script>
@endif
</div>

		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{asset('/app/assets/js/scripts.bundle.js')}}"></script>
		<script src="{{asset('/app/assets/plugins/global/plugins.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{asset('/app/assets/js/custom/authentication/sign-in/i18n.js')}}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>