<!--begin::Navbar-->
<div class="app-navbar flex-grow-1 justify-content-end" id="kt_app_header_navbar">
    <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
    @include('app.layout.search._inline')
    </div>
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-2 ms-lg-6">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-outline ki-calendar fs-1"></i>
        </div>
@include('app.layout.menus._notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Quick links-->
    <div class="app-navbar-item ms-2 ms-lg-6">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-outline ki-abstract-26 fs-1"></i>
        </div>
@include('app.layout.menus._quick-links-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Quick links-->
    <!--begin::Chat-->
    <div class="app-navbar-item ms-2 ms-lg-6">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative" id="kt_drawer_chat_toggle">
            <i class="ki-outline ki-notification-on fs-1"></i>            <span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger w-15px h-15px ms-n4 mt-3">5</span>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-2 ms-lg-6" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-circle symbol-30px symbol-lg-45px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <img src="app/assets/media/avatars/300-2.jpg" alt="user"/>
        </div>
@include('app.layout.menus._user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Action-->
    <div class="app-navbar-item ms-2 ms-lg-6 me-lg-6">
        <!--begin::Link-->
        <a href="?page=authentication/layouts/corporate/sign-in" class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px">
            <i class="ki-outline ki-exit-right fs-1"></i>
        </a>
        <!--end::Link-->
    </div>
    <!--end::Action-->
    <!--begin::Header menu toggle-->
            <div class="app-navbar-item ms-2 ms-lg-6 ms-n2 me-3 d-flex d-lg-none">
            <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" id="kt_app_aside_mobile_toggle">
                <i class="ki-outline ki-burger-menu-2 fs-2"></i>            </div>
        </div>
        <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->