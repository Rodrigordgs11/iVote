@php
use App\Models\User;
@endphp
<div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
            <!--begin::Sidebar toggle-->
        <div
            id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-sm btn-icon bg-body btn-color-gray-500 btn-active-color-primary w-30px h-30px ms-n2 me-4 d-none d-lg-flex "
            data-kt-toggle="true"
            data-kt-toggle-state="active"
            data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize"
            >
            <i class="ki-outline ki-abstract-14 fs-3 mt-1"></i>        
        </div>
        <!--end::Sidebar toggle-->
    <!--begin::Sidebar mobile toggle-->
    <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
		<i class="ki-outline ki-abstract-14 fs-2"></i>	
    </div>
    <!--end::Sidebar mobile toggle-->
    <!--begin::Logo-->
    @if(auth()->user()->user_type == 'admin')
        <a href="/" class="app-sidebar-logo">
            <img alt="Logo" src="{{asset('app/assets/media/logos/Logo.png')}}" class="h-25px theme-light-show"/>
        </a>
    @else
        <a href="/app/home" class="app-sidebar-logo">
            <img alt="Logo" src="{{asset('app/assets/media/logos/Logo.png')}}" class="h-25px theme-light-show"/>
        </a>
    @endif    
    <!--end::Logo-->
</div>