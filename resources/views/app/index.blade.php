<!DOCTYPE html>

<html lang="en" >
    <!--begin::Head-->
    <head><base href=""/>
        <title>iVote - @yield('title')</title>
        <meta charset="utf-8"/>
        <meta name="description" content="
            The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        "/>
        <meta name="keywords" content="
            metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        "/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template - Metronic by KeenThemes" />
        <meta property="og:url" content="https://keenthemes.com/metronic"/>
        <meta property="og:site_name" content="Metronic by Keenthemes" />
        <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
        <link rel="shortcut icon" href="{{asset('app/assets/media/logos/favicon.ico')}}"/>
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>        <!--end::Fonts-->
<!--begin::Vendor Stylesheets(used for this page only)-->
<link rel="stylesheet" href="{{asset('app/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}">
<link rel="stylesheet" href="{{asset('app/assets/plugins/custom/datatables/datatables.bundle.css')}}">
<!--end::Vendor Stylesheets-->

<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
<link rel="stylesheet" href="{{asset('app/assets/css/style.bundle.css')}}">
<link rel="stylesheet" href="{{asset('app/assets/plugins/global/plugins.bundle.css')}}">
                <!--end::Global Stylesheets Bundle-->
        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    
    <body  id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true"  class="app-default" >
        @include('app.partials.theme-mode._init')
        @include('app.layout._default')
        @include('app.partials._scrolltop')
            <!--begin::Modals-->
        @include('app.partials.modals._upgrade-plan')
        @include('app.partials.modals._view-users')
        @include('app.partials.modals.users-search._main')
        @include('app.partials.modals._invite-friends')
            <!--end::Modals-->
        <!--begin::Javascript-->

        
      <script>  
            var hostUrl = "assets/";        </script>
                    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
                            <script src="{{asset('app/assets/js/scripts.bundle.js')}}"></script>
                            <script src="{{asset('app/assets/plugins/global/plugins.bundle.js')}}"></script>
                        <!--end::Global Javascript Bundle-->
                    <!--begin::Vendors Javascript(used for this page only)-->
                            <script src="{{asset('app/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
                            <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
                            <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
                            <script src="{{asset('app/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
                        <!--end::Vendors Javascript-->
                    <!-- begin::Custom Javascript(used for this page only) -->
                        <script src="{{asset('app/assets/js/widgets.bundle.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/widgets.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/chat/chat.js')}}"></script>

                        <script src="{{asset('app/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/utilities/modals/users-search.js')}}"></script>

                        <script src="{{asset('app/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/utilities/modals/users-search.js')}}"></script>

                        <!-- <script src="{{asset('app/assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/list/add.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-schedule.js')}}"></script>

                        <script src="{{asset('app/assets/js/custom/apps/user-management/polls/add.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/polls/update-details.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/polls/table.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/polls/view-options.js')}}"></script>
                        
                        <script src="{{asset('app/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/utilities/modals/users-search.js')}}"></script>
                        
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/view.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-details.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-schedule.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-task.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-email.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-password.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-role.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-auth-app.js')}}"></script>
                        <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-one-time-password.js')}}"></script>

                        <script src="{{asset('app/assets/js/custom/apps/user-management/roles/view/view.js')}}"></script>

                        <script src="{{asset('app/assets/js/custom/apps/user-management/votes/table.js')}}"></script>

                        <script src="{{asset('app/assets/js/custom/apps/user-management/polls/vote.js')}}"></script> -->

                        <!--end::Custom Javascript-->
                <!--end::Javascript-->
    
    @yield('scripts')

            </body>
    <!--end::Body-->
</html>