<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    @include('app.layout._header')
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        @include('app.layout._sidebar')
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
@include('app.layout._content')
                                    </div>
                <!--end::Content wrapper-->
@include('app.layout._footer')
                            </div>
            <!--end:::Main-->
@include('app.layout._aside')
                    </div>
        <!--end::Wrapper-->
            </div>
    <!--end::Page-->
</div>
<!--end::App-->