@extends('app.index')

@section('title', 'Votes')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
		<!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch pb-5">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Votes Management For Option "{{$option->title}}" on Poll "{{$option->poll->title}}"</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-vote-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Vote" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_votes">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">User</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Phone Number</th>
                                    <th class="min-w-125px">Vote Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($votes as $vote)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="{{route('users.getId', ['user' => $vote->user])}}">
                                                    @if($vote->user->photo)
                                                    <div class="symbol-label">
                                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($vote->user->photo) }}" alt="" width="100"> 
                                                    </div>
                                                    @else
                                                    <div class="symbol-label">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($vote->user->name) }}&background=random&font-size=0.25&bold=true" alt="" width="100"> 
                                                    </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="{{route('users.getId', ['user' => $vote->user])}}" class="text-gray-800 text-hover-primary mb-1">{{ $vote->user->name }}</a>
                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <td>{{$vote->user->email}}</td>
                                        <td>{{$vote->user->phone_number}}</td>
                                        <td>{{$vote->created_at}}</td>
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
    </div>
</div>
@endsection
