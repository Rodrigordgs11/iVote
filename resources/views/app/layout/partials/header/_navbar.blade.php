<!--begin::Navbar-->
<div class="app-navbar flex-grow-1 justify-content-end" id="kt_app_header_navbar">
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-2 ms-lg-6">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-outline ki-notification-on fs-1"></i><span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger w-15px h-15px ms-n4 mt-3">{{count(Auth::user()->notifications->where('seen', false))}}</span>
        </div>
@include('app.partials.menus._notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-2 ms-lg-6" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-circle symbol-30px symbol-lg-45px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            @if(Auth::user()->photo)
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url(Auth::user()->photo) }}" alt="" width="100"> 
            @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&font-size=0.25&bold=true" alt="" width="100"> 
            @endif 
        </div>
@include('app.partials.menus._user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Action-->
    <div class="app-navbar-item ms-2 ms-lg-6 me-lg-6">
        <!--begin::Link-->
        <a  method="GET" href="{{ route('logout') }}" class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px">
            @csrf
            <i class="ki-outline ki-exit-right fs-1"></i>
        </a>

        <!--end::Link-->
    </div>
    <!--end::Action-->
</div>
<!--end::Navbar-->