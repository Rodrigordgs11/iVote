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
                    <div class="flex-lg-row-fluid ms-lg-10">
                        <!--begin::Card-->
                        <div class="card card-flush mb-6 mb-xl-9 justify-content-around">
                            <!--begin::Card header-->
                            <div class="card-header pt-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <div>
                                        <h2 class="d-flex align-items-center mb-2">Vote Here On: {{ $poll->title }}</h2>
                                        <div class="text-gray-600 fs-6 ms-1">Choose an option</div>
                                    </div>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1" data-kt-option-vote-table-toolbar="base">
                                        <i class="ki-outline ki-magnifier fs-1 position-absolute ms-6"></i>
                                        <input type="text" data-kt-option-vote-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Options" />
                                    </div>
                                    <!--end::Search-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-option-vote-table-toolbar="selected">
                                        <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-option-vote-table-select="selected_count"></span>Selected</div>
                                        <button type="button" class="btn btn-success" data-kt-option-vote-table-select="option_seleted">Vote</button>
                                    </div>
                                    <form id="voteForm" action="{{ route('votes', ['poll' => $poll]) }}" method="POST" style="display: none;">
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
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_vote_options_view_table">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="hidden" data-kt-check="true" data-kt-check-target="#kt_vote_options_view_table .form-check-input" value="1" />
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
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_add_options_vote" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_options_vote_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Option</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-option-vote-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_option_vote_form" class="form"  method="POST" action="{{ route('polls.addOption', ['poll' => $poll]) }}">
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
                        <button type="reset" class="btn btn-light me-3" data-kt-option-vote-modal-action="cancel">Discard</button>
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

@section('scripts')
    <script src="{{asset('app/assets/js/custom/apps/user-management/polls/vote.js')}}"></script>
@endsection