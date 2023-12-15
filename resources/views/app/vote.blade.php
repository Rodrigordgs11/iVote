@extends('app.index')

@section('title', 'Poll view')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
		<!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                        <!--end::Card-->
                        <div class="card card-flush ">
                            <!--begin::Card footer-->
                            <div class="card-footer pt-0 mt-6">
                                @if($attachments->count() > 0)    
                                    @foreach($attachments as $attachment)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($attachment->attachment) }}" alt="" width="100"> 
                                    @endforeach
                                @else
                                    <h3 class="mb-0">This poll doesn't have images</h>
                                @endif
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--begin::Card-->
                        <div class="card card-flush mt-10">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="mb-0">{{ $poll->title }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Permissions-->
                                <div class="d-flex flex-column text-gray-600">
                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>Description: {{ $poll->description }}</div>
                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>Start Date: {{ $poll->start_date }}</div>
                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>End Date: {{ $poll->end_date }}</div>
                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>Owner: {{ $poll->user->name }}</div>
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="flex-lg-row-fluid ms-lg-10">
                            <!--begin::Card-->
                            <div class="card card-flush mb-6 mb-xl-9 justify-content-around">
                                <!--begin::Card header-->
                                <div class="card-header pt-5">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="d-flex align-items-center">Options
                                        <span class="text-gray-600 fs-6 ms-1">({{ count($options) }})</span></h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Search-->
                                        <div class="d-flex align-items-center position-relative my-1" data-kt-option-table-toolbar="base">
                                            <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                                            <input type="text" data-kt-option-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Options" />
                                        </div>
                                        <!--end::Search-->
                                        <!--begin::Group actions-->
                                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-option-table-toolbar="selected">
                                            <div class="fw-bold me-5">
                                            <span class="me-2" data-kt-option-table-select="selected_count"></span>Selected</div>
                                            <button type="button" class="btn btn-success" data-kt-option-table-select="option_seleted">Vote</button>
                                        </div>
                                        <form id="deleteOptionForm" action="{{ route('votes', ['poll' => $poll]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="selected_options" id="selectedOptions">
                                        </form>
                                        <!--end::Group actions-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_options_view_table">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_options_view_table .form-check-input" value="1" />
                                                    </div>
                                                </th>
                                                <th class="min-w-125px">Title</th>
                                                <th class="min-w-125px">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach($options as $option )
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="{{$option->uuid}}" />
                                                    </div>
                                                </td>
                                                <td>{{ $option->title }}</td>
                                                <td>{{ $option->description }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Sidebar-->
                        @if($poll->poll_privacy == 'private')
                        <!--begin::Content-->
                            <div class="flex-lg-row-fluid ms-lg-10">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9 justify-content-around">
                                    <!--begin::Card header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2 class="d-flex align-items-center">Users Shared
                                            <span class="text-gray-600 fs-6 ms-1">({{ count($poll->users) }})</span></h2>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1" data-kt-view-roles-table-toolbar="base">
                                                <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                                                <input type="text" data-kt-usersPoll-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Users" />
                                            </div>
                                            <div  >
                                                <!--begin::Add user-->
                                                <button type="button" class="btn btn-primary ms-10 me-10" data-bs-toggle="modal" data-bs-target="#kt_modal_add_users">
                                                <i class="ki-outline ki-plus fs-2"></i>Add User</button>
                                                <!--end::Add user-->
                                            </div>
                                            <!--end::Search-->
                                            <!--begin::Group actions-->
                                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
                                                <div class="fw-bold me-5">
                                                <span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selected</div>
                                                <button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">Delete Selected</button>
                                            </div>
                                            <form id="deleteForm" action="{{ route('polls.deleteSelected', ['poll' => $poll]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="selected_users" id="selectedUsers">
                                            </form>
                                            <!--end::Group actions-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                                            <thead>
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th></th>
                                                    <th class="min-w-125px">Name</th>
                                                    <th class="min-w-125px">Role</th>
                                                    <th class="min-w-125px">Phone number</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach($poll->users as $user)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="{{$user->uuid}}" />
                                                        </div>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="{{route('users.getId', ['user' => $user])}}">
                                                                <div class="symbol-label">
                                                                    <img src="{{asset('app/assets/media/avatars/300-6.jpg')}}" alt="Emma Smith" class="w-100" />
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{route('users.getId', ['user' => $user])}}" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                                            <span>{{ $user->email }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->user_type }}</td>
                                                    <td>{{ $user->phone_number }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                        @endif
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_add_users" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_users_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add User</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-usersPoll-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form"  method="POST" action="{{ route('polls.addSelectedUsers', ['poll' => $poll]) }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <button type="button" class="btn btn-primary" id="addUserOption">Add User</button>

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row" id="userList">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold mb-2">
                                <span>Users</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Users">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->

                            <select name="users[]" aria-label="Select a user" data-control="select2" data-placeholder="Select a User..." class="form-select form-select-solid" data-dropdown-parent="#kt_modal_add_users">
                                <option value="">Select a User...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->uuid }}">{{ $user->name }}</option>
                                @endforeach    
                            </select>

                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-kt-usersPoll-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-usersPoll-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

<div class="modal fade" id="kt_modal_add_options" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_options_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Option</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-option-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_option_form" class="form"  method="POST" action="{{ route('polls.addOption', ['poll' => $poll]) }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_option_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="fs-6 fw-semibold mb-2">
                                <span>Title</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Title">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>

                            <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value=""/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="fs-6 fw-semibold mb-2">
                                <span>Description</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Description">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>

                            <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Description" value=""/>
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-kt-option-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-option-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

<div class="modal fade" id="kt_modal_update_poll" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Poll</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_poll_form" class="form" method="POST" action="{{ route('polls.update', ['poll' => $poll])}}">
                    @csrf
                    @method('PUT')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Title</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a title" name="title" value="{{ $poll->title }}" />
                            <!--end::Input-->
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
                                <input class="form-control form-control-solid" placeholder="Pick date & time" name="start_date" id="kt_modal_datepicker_start" value="{{ $poll->start_date }}"/>
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
                                <input class="form-control form-control-solid" placeholder="Pick date & time" name="end_date" id="kt_modal_datepicker_end" value="{{ $poll->end_date }}"/>
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Description" value="{{ $poll->description }}"/>
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
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
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

<div class="modal fade" id="kt_modal_add_attachment" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add attachment</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_poll_form" enctype="multipart/form-data" class="form" method="POST" action="{{ route('attachments', ['poll' => $poll])}}">
                    @csrf
                    @method('POST')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
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
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
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

@if($errors->any())
    <script>
        setTimeout(function() {
            var errorMessage = '';

            @foreach($errors->all() as $error)
                errorMessage += '{!! addslashes($error) !!}';
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

<script>
    document.getElementById('addUserOption').addEventListener('click', function () {
        // Create a new line or input field
        var newUserLine = document.createElement('div');
        newUserLine.innerHTML = `
        <label class="fs-6 fw-semibold mb-2">
            <span>Users</span>
            <span class="ms-1" data-bs-toggle="tooltip" title="Users">
                <i class="ki-outline ki-information fs-7"></i>
            </span>
        </label>

        <select name="users[]" aria-label="Select a user" data-control="select2" data-placeholder="Select a User..." class="form-select form-select-solid" data-dropdown-parent="#kt_modal_add_users">
            <option value="">Select a User...</option>
            @foreach ($users as $user)
                <option value="{{ $user->uuid }}">{{ $user->name }}</option>
            @endforeach    
        </select>
        `;

        // Append the new line to the user list
        document.getElementById('userList').appendChild(newUserLine);
    });
</script>

@endsection