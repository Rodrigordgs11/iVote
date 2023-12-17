@extends('app.index')

@section('title', 'userPolls')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
		<!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Form-->
                <form action="{{ route('search.polls') }}" method="GET">
                    <!--begin::Card-->
                    <div class="card mb-7">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Compact form-->
                            <div class="d-flex align-items-center">
                                <!--begin::Input group-->
                                <div class="position-relative w-md-400px me-md-2">
                                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"></i>
                                    <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Search" />
                                </div>
                                <!--end::Input group-->
                                <!--begin:Action-->
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary me-5">Search</button>
                                    <button type="button" class="btn btn-primary position-absolute end-0 me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_poll">
                                        <i class="ki-outline ki-plus fs-2"></i>Add Poll
                                    </button>
                                </div>
                                <!--end:Action-->
                            </div>
                            <!--end::Compact form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </form>
                <!--end::Form-->
                <!--begin::Toolbar-->
                <div class="d-flex flex-wrap flex-stack pb-7">
                    <!--begin::Title-->
                    <div class="d-flex flex-wrap align-items-center my-1">
                        <h3 class="fw-bold me-5 my-1">{{count($polls)}} Items Found 
                        <span class="text-gray-500 fs-6">by Recent Updates ↓</span></h3>
                    </div>
                    <!--end::Title-->
                    <!--begin::Controls-->
                    <div class="d-flex flex-wrap my-1">
                    <button id="togglePollsButton" class="btn btn-primary me-5">Show {{ Request::route()->getName() == 'my.polls' ? 'Shared Polls' : 'My Polls' }}</button>

                        <!--begin::Tab nav-->
                        <ul class="nav nav-pills me-6 mb-2 mb-sm-0">
                            <li class="nav-item m-0">
                                <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 active" data-bs-toggle="tab" href="#kt_project_users_card_pane">
                                    <i class="ki-outline ki-element-plus fs-2"></i>
                                </a>
                            </li>
                            <li class="nav-item m-0">
                                <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary" data-bs-toggle="tab" href="#kt_project_users_table_pane">
                                    <i class="ki-outline ki-row-horizontal fs-2"></i>
                                </a>
                            </li>
                        </ul>
                        <!--end::Tab nav-->
                        <!--begin::Actions-->
                        <div class="d-flex my-0">
                            <!--begin::Select-->
                            <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Filter" class="form-select form-select-sm form-select-solid w-150px me-5">
                                <option value="1">Recently Updated</option>
                                <option value="2">Last Month</option>
                                <option value="3">Last Quarter</option>
                                <option value="4">Last Year</option>
                            </select>
                            <!--end::Select-->
                            <!--begin::Select-->
                            <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Export" class="form-select form-select-sm form-select-solid w-100px">
                                <option value="1">Excel</option>
                                <option value="1">PDF</option>
                                <option value="2">Print</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Controls-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                        <!--begin::Row-->
                        <div class="row g-6 g-xl-9">
                            <!--begin::Col-->
                            @foreach($polls as $poll)
                                <div class="col-md-6 col-xxl-4">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-65px symbol-circle mb-5">
                                                <img src="{{asset('app/assets/media/avatars/300-2.jpg')}}" alt="image" />
                                                <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            <a href="{{ route('polls.getId', ['poll' => $poll]) }}" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to view details">{{ $poll->title }}</a>
                                            <!--end::Name-->
                                            <!--begin::Position-->
                                            <div class="fw-semibold text-gray-500 mb-6">{{$poll->description}}</div>
                                            <!--end::Position-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-center flex-wrap">
                                                <!--begin::Stats-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">End date</div>
                                                    <div class="fw-semibold text-gray-500">{{$poll->end_date}}</div>
                                                </div>
                                                <!--end::Stats-->
                                                <!--begin::Stats-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">Votes</div>
                                                    <div class="fw-semibold text-gray-500">{{count($poll->votes)}}</div>
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                            @endforeach
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div id="kt_project_users_table_pane" class="tab-pane fade">
                        <!--begin::Card-->
                        <div class="card card-flush">
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_project_users_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                        <thead class="fs-7 text-gray-500 text-uppercase">
                                            <tr>
                                                <th class="min-w-250px">Title</th>
                                                <th class="min-w-90px">Description</th>
                                                <th class="min-w-150px">Start Date</th>
                                                <th class="min-w-90px">End Date</th>
                                                <th class="min-w-50px text-end">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6">
                                            @foreach($polls as $poll)
                                                <tr>
                                                    <td>
                                                        <!--begin::User-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Wrapper-->
                                                            <div class="me-5 position-relative">
                                                                <!--begin::Avatar-->
                                                                <div class="symbol symbol-35px symbol-circle">
                                                                @php
                                                                    $attachmentsForPoll = $attachments->filter(function ($attachment) use ($poll) {
                                                                        return $attachment->poll_uuid == $poll->uuid;
                                                                    });
                                                                @endphp

                                                                @if($attachmentsForPoll->count() > 0)    
                                                                    @foreach($attachmentsForPoll as $attachment)
                                                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($attachment->attachment) }}" alt="" width="100"> 
                                                                    @endforeach
                                                                @else
                                                                    <h3>Sem imagem</h3>
                                                                @endif
                                                                </div>
                                                                <!--end::Avatar-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <a href="{{route('vote', ['poll' => $poll])}}" class="mb-1 text-gray-800 text-hover-primary">{{ $poll->title }}</a>
                                                            </div>
                                                            <!--end::Info-->
                                                        </div>
                                                        <!--end::User-->
                                                    </td>
                                                    <td>{{ $poll->description }}</td>
                                                    <td>{{ $poll->start_date }}</td>
                                                    <td>{{ $poll->end_date }}</td>
                                                    <td class="text-end">
                                                        <a href="{{route('votes', ['poll' => $poll])}}" class="btn btn-light btn-sm">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab Content-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_add_poll" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_poll_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Poll</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-polls-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_poll_form" class="form" enctype="multipart/form-data" method="POST" action="{{ route('userPolls') }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_poll_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_poll_header" data-kt-scroll-wrappers="#kt_modal_add_poll_scroll" data-kt-scroll-offset="300px">
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
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg);"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="ki-outline ki-pencil fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
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
                            <label class="required fw-semibold fs-6 mb-2">Title</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="poll_title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Start date</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Select a date & time.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Pick date & time" name="event_datetime_start" id="kt_modal_datepicker_start" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">End date</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Select a date & time.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Pick date & time" name="event_datetime_end" id="kt_modal_datepicker_end" />
                            <!--end::Input-->
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="poll_description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Description"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-5">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Poll Privacy</label>
                            <!--end::Label-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="poll_privacy" type="radio" value="private" id="kt_modal_update_role_option_0" checked='checked' />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800">Private</div>
                                        <div class="text-gray-600">The poll will be avilable only for those who you share with.</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>

                            <div class='separator separator-dashed my-5'></div>

                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="poll_privacy" type="radio" value="public" id="kt_modal_update_role_option_0" checked='checked' />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800">Public</div>
                                        <div class="text-gray-600">The poll will available to everyone.</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Roles-->
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                        <input type="hidden" name="user" value="{{ auth()->user()->uuid }}" />
                        </div>
                        <!--end::Input group-->
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-kt-polls-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-polls-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait... 
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<script>
    document.getElementById('togglePollsButton').addEventListener('click', function () {
        // Redirect to the toggle route on click
        window.location.href = "{{ route('toggle.polls', ['currentRoute' => Request::route()->getName()]) }}";
    });
</script>

@endsection

@section('scripts')

    <script src="{{asset('app/assets/js/custom/apps/user-management/polls/add.js')}}"></script>

@endsection