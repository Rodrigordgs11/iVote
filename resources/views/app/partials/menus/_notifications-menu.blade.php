<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
	<!--begin::Heading-->
    <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{asset('app/assets/media/misc/menu-header-bg.jpg')}}')">
        <!--begin::Title-->
        <h3 class="text-white fw-semibold px-9 mt-10 mb-6">
            Notifications <span class="fs-8 opacity-75 ps-3">{{count(Auth::user()->notifications->where('seen', false))}} notifications</span>
        </h3>
        <!--end::Title-->
        <!--begin::Tabs-->
        <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_1"></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_2">Updates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_3">Logs</a>
            </li> -->
        </ul>
        <!--end::Tabs-->
    </div>
	<!--end::Heading-->
    <!--begin::Tab content-->
    <div class="tab-content">
        <!--begin::Tab panel-->
        <div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
            <!--begin::Items-->
            <div class="scroll-y mh-325px my-5 px-8">
                <!--begin::Item-->
                @if(count(Auth::user()->notifications->where('seen', false)) == 0)
                <div class="d-flex py-4 justify-content-center">
                    <span>There are no notifications at the moment.</span>
                </div>
                @endif
                @foreach(Auth::user()->notifications->where('seen', false) as $notification)
                <div class="d-flex flex-stack py-4">
                    <!--begin::Section-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <!--end::Symbol-->
                            <!--begin::Title-->
                            <div class="mb-0 me-2">
                                <form action="{{ route('notifications.seen', ['notification' => $notification]) }}" method="POST">
                                    @csrf
                                    @method('PUT') 
                                    <a href="#"
                                    class="fs-6 text-gray-800 text-hover-primary fw-bold"
                                    onclick="this.closest('form').submit(); return false;">
                                    Poll Shared
                                    </a>
                                </form>
                                <div class="text-gray-500 fs-7">You were shared the poll {{$notification->poll->title}}</div>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Section-->
                    <!--begin::Label-->
                    <span class="badge badge-light fs-8">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                    <!--end::Label-->
                </div>
                @endforeach
                <!--end::Item-->
            </div>
            <!--end::Items-->
            <!--begin::View more-->
			<!--end::View more-->
        </div>
        <!--end::Tab panel-->
    </div>
    <!--end::Tab content-->
</div>
<!--end::Menu-->