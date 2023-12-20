@extends('app.index')

@section('title', 'Profile')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
		<!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content-->
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Summary-->
                                <!--begin::User Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    @if($user->photo)
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($user->photo) }}" alt="" width="100"> 
                                    </div>
                                    @else
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&font-size=0.25&bold=true" alt="" width="100"> 
                                    </div>
                                    @endif
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="fs-3 text-gray-800 fw-bold mb-3">{{ $user->name }}</div>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge badge-lg badge-light-primary d-inline">{{ $user->user_type }}</div>
                                        <!--begin::Badge-->
                                    </div>
                                    <!--end::Position-->
                                </div>
                                <!--end::User Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details 
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-outline ki-down fs-3"></i>
                                    </span></div>
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit user details">
                                        <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">Edit</a>
                                    </span>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_user_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Account ID</div>
                                        <div class="text-gray-600">{{ $user->uuid }}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Name</div>
                                        <div class="text-gray-600">{{ $user->name }}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">
                                            <a href="#" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Phone Number</div>
                                        <div class="text-gray-600">{{ $user->phone_number }}</div>
                                        <!--begin::Details item-->
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Polls</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Votes</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9 p-7">
                                    <!--begin::Card body-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_polls">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Title</th>
                                                <th class="min-w-125px">Description</th>
                                                <th class="min-w-125px">Privacy</th>
                                                <th class="min-w-125px">Start Date</th>
                                                <th class="min-w-125px">End Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            @foreach ($polls as $poll)
                                                <tr>
                                                    <td><a href="{{route('polls.getId', ['poll' => $poll])}}">{{ $poll->title }}</a></td>                           
                                                    <td>{{ $poll->description }}</td>
                                                    <td>{{ $poll->poll_privacy }}</td>
                                                    <td>{{ $poll->start_date }}</td>
                                                    <td>{{ $poll->end_date }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9 p-5">
                                    <table class="table align-middle table-row-dashed fs-8 gy-5" id="kt_table_votes">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Poll Title</th>
                                                <th class="min-w-125px">Poll Privacy</th>
                                                <th class="min-w-125px">Poll Owner</th>
                                                <th class="min-w-125px">Poll Start Date</th>
                                                <th class="min-w-125px">Poll End Date</th>
                                                <th class="min-w-125px">Option</th>
                                                <th class="min-w-125px">Vote Time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            @foreach ($votes as $vote)
                                                <tr>
                                                    <td><a href="{{route('polls.getId', ['poll' => $vote->poll])}}">{{ $vote->poll->title }}</a></td>                           
                                                    <td>{{ $vote->poll->poll_privacy }}</td>
                                                    <td> {{ $vote->poll->user->name }} </td>
                                                    <td>{{ $vote->poll->start_date }}</td>
                                                    <td>{{ $vote->poll->end_date }}</td>
                                                    <td>{{ $vote->option->title }}</td>
                                                    <td>{{ $vote->created_at }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
                <!--begin::Modals-->
                <!--begin::Modal - Update user details-->
                <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user])}}" id="kt_modal_update_user_form">
                                @csrf
                                @method('PUT')
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_user_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Update User Details</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header" data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::User toggle-->
                                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_user_info" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_user_info">User Information 
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-outline ki-down fs-3"></i>
                                        </span></div>
                                        <!--end::User toggle-->
                                        <!--begin::User form-->
                                        <div id="kt_modal_update_user_user_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                                                <!--end::Label-->
                                                <!--begin::Image placeholder-->
                                                <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                                                <!--end::Image placeholder-->
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ \Illuminate\Support\Facades\Storage::disk('public')->url($user->photo) }});"></div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                        <i class="ki-outline ki-pencil fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg, .gif" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                        <i class="ki-outline ki-cross fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                        <i class="ki-outline ki-cross fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->
                                                <!--begin::Hint-->
                                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                                <!--end::Hint-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{ $user->name }}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span>Email</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Email address must be active">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{ $user->email }}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Password</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="password" class="form-control form-control-solid" placeholder="" name="password" value="{{ $user->password }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Phone Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="phone_number" value="{{ $user->phone_number }}"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::User form-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait... 
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - Update user details-->
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        <!--end::Content-->
        </div>
    </div>
</div>

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

@endsection

@section('scripts')

    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/view.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-schedule.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-task.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-email.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-password.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-role.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-auth-app.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-one-time-password.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/list/add.js')}}"></script>
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-schedule.js')}}"></script>

    <!-- Está a usar -->
    <script src="{{asset('app/assets/js/custom/apps/user-management/users/view/update-details.js')}}"></script>


@endsection