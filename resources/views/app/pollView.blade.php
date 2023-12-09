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
                        <!--begin::Card-->
                        <div class="card card-flush">
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
                                    <span class="bullet bg-primary me-3"></span>Poll Privacy: {{ $poll->poll_privacy }}</div>
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
                            <!--begin::Card footer-->
                            <div class="card-footer pt-0">
                                <button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_poll">Edit Role</button>
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                        <div class="card card-flush mt-10">
                            <!--begin::Card footer-->
                            <div class="card-footer pt-0 mt-6">
                                @if($attachments->count() > 0)    
                                    @foreach($attachments as $attachment)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($attachment->attachment) }}" alt="" width="100" class="mb-6"> 
                                    @endforeach
                                    @else
                                        <h3 class="mb-0">This poll hasn't images</h>
                                    @endif
                                <button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_attachment">Add attachment</button>
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--begin::Modal-->
                        <!--begin::Modal - Update role-->
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
                                                                    <div class="text-gray-600">Best for business owners and company user.</div>
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
                                                                    <div class="text-gray-600">Best for business owners and company user.</div>
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
                        <!--end::Modal - Update role-->
                        <!--begin::Modal - Update role-->
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
                        <!--end::Modal - Update role-->
                        <!--end::Modal-->
                    </div>
                    <!--end::Sidebar-->
                    
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-10">
                        <!--begin::Card-->
                        <div class="card card-flush mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header pt-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="d-flex align-items-center">Users Assigned
                                    <span class="text-gray-600 fs-6 ms-1">(14)</span></h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1" data-kt-view-roles-table-toolbar="base">
                                        <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                                        <input type="text" data-kt-roles-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Users" />
                                    </div>
                                    <!--end::Search-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
                                        <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selected</div>
                                        <button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">Delete Selected</button>
                                    </div>
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
                                            <th class="w-10px pe-2">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_roles_view_table .form-check-input" value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-50px">ID</th>
                                            <th class="min-w-150px">User</th>
                                            <th class="min-w-125px">Joined Date</th>
                                            <th class="text-end min-w-100px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID7243</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-6.jpg" alt="Emma Smith" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
                                                    <span>smith@kpmg.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>20 Jun 2023, 2:40 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID7831</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label fs-3 bg-light-danger text-danger">M</div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Melody Macy</a>
                                                    <span>melody@altbox.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>10 Mar 2023, 5:30 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID2812</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-1.jpg" alt="Max Smith" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Max Smith</a>
                                                    <span>max@kt.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>25 Jul 2023, 10:10 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID5398</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Sean Bean</a>
                                                    <span>sean@dellito.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>20 Dec 2023, 6:43 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID9048</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-25.jpg" alt="Brian Cox" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Brian Cox</a>
                                                    <span>brian@exchange.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>10 Nov 2023, 6:43 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID7378</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label fs-3 bg-light-warning text-warning">C</div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Mikaela Collins</a>
                                                    <span>mik@pex.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>10 Nov 2023, 2:40 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID1534</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-9.jpg" alt="Francis Mitcham" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Francis Mitcham</a>
                                                    <span>f.mit@kpmg.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>20 Jun 2023, 6:43 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID8013</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label fs-3 bg-light-danger text-danger">O</div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Olivia Wild</a>
                                                    <span>olivia@corpmail.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>25 Oct 2023, 11:05 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID3207</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label fs-3 bg-light-primary text-primary">N</div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Neil Owen</a>
                                                    <span>owen.neil@gmail.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>22 Sep 2023, 8:43 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID3623</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-23.jpg" alt="Dan Wilson" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Dan Wilson</a>
                                                    <span>dam@consilting.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>20 Dec 2023, 10:30 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID5530</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label fs-3 bg-light-danger text-danger">E</div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Bold</a>
                                                    <span>emma@intenso.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>25 Oct 2023, 8:43 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID9398</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Ana Crown</a>
                                                    <span>ana.cf@limtel.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>20 Jun 2023, 5:30 pm</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID7069</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label fs-3 bg-light-info text-info">A</div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">Robert Doe</a>
                                                    <span>robert@benko.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>25 Oct 2023, 11:30 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>ID1500</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="apps/user-management/users/view.html">
                                                        <div class="symbol-label">
                                                            <img src="assets/media/avatars/300-13.jpg" alt="John Miller" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">John Miller</a>
                                                    <span>miller@mapple.com</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>10 Mar 2023, 11:30 am</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                                <i class="ki-outline ki-down fs-5 m-0"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/user-management/users/view.html" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                    
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
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

@endsection