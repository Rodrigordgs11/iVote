@extends('app.index')

@section('title', 'Home')

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
                                <div class="position-relative w-md-400px me-md-2 me-6">
                                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"></i>
                                    <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Search for Poll Title" />
                                </div>
                                <!-- Filtros de Popularidade e Data -->
                                <div class="d-flex align-items-center flex-wrap me-md-2">
                                    <!-- Filtro de Data -->
                                    <div class="me-3">
                                        <input class="form-control form-control-solid" placeholder="Pick date range" name="date_filter" id="kt_daterangepicker_3"/>
                                    </div>
                                    <!-- Filtro de Popularidade -->
                                    <div class="me-md-2 mt-2 position-relative align-center"> <!-- Adjusted class for vertical alignment -->
                                        <select name="popularity" id="popularity-filter" data-control="select2" data-hide-search="true" data-placeholder="Popularity" class="form-select form-select-sm form-select-solid w-100"> <!-- Added h-100 for full height -->
                                            <option value="">Popularity</option>
                                            <option value="1">Most Popular</option>
                                            <option value="2">Least Popular</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Botão de Pesquisa -->
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary me-5">Search</button>
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
                    <h3 class="fw-bold me-5 my-1">{{ $polls->where('poll_privacy', 'public')->where('owner_uuid', '!=', Auth::user()->uuid)->count() }} Polls Found </h3>
                        <span class="text-gray-500 fs-6">Hover over the titles to vote!</span></h3>
                    </div>
                    <!--end::Title-->
                    <!--begin::Controls-->
                    <div class="d-flex flex-wrap my-1">
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
                            @foreach($polls->sortBy('title') as $poll)
                                @if($poll->poll_privacy == 'public' && $poll->owner_uuid != Auth::user()->uuid)
                                <div class="col-md-6 col-xxl-4">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-65px symbol-circle mb-5">
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
                                                <img src="{{asset('app/assets/media/polls/pollImage.png')}}" alt="image" />
                                            @endif
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            @if($poll->poll_privacy == 'public' && $poll->start_date <= now() && $poll->end_date >= now())
                                                <a href="{{ route('polls.getId', ['poll' => $poll]) }}" class="fs-4 text-hover-primary fw-bold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Click here to vote!">{{ $poll->title }}</a>
                                            @else
                                                <span class="fs-4 text-gray-800 fw-bold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="This poll is not available for voting!">{{ $poll->title }}</span>
                                            @endif
                                            <!--end::Name-->
                                            <!--begin::Position-->
                                            <div class="fw-semibold text-gray-500">{{$poll->description}}</div>
                                            <div class="fw-semibold text-gray-500 mb-6">{{$poll->user->name}}</div>
                                            <!--end::Position-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-center flex-wrap">
                                                <!--begin::Stats-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">Start date</div>
                                                    <div class="fw-semibold text-gray-500">{{$poll->start_date}}</div>
                                                </div>
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">End date</div>
                                                    <div class="fw-semibold text-gray-500">{{$poll->end_date}}</div>
                                                </div>
                                                <!--end::Stats-->
                                                <!--begin::Stats-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3 text-center">
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
                                @endif
                            @endforeach
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Tab pane -->
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
                                                <th></th>
                                                <th class="min-w-150px">Title</th>
                                                <th class="min-w-150px">Description</th>
                                                <th class="min-w-150px">Owner</th>
                                                <th class="min-w-90px">Start Date</th>
                                                <th class="min-w-90px">End Date</th>
                                                <th class="min-w-90px text-center">Votes</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6">
                                            @foreach($polls as $poll)
                                                @if($poll->poll_privacy == 'public' && $poll->owner_uuid != Auth::user()->uuid)
                                                    <tr>
                                                        <td>
                                                            <!--begin::User-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-5 position-relative">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-50px symbol-circle">
                                                                    @php
                                                                        $attachmentsForPoll = $attachments->filter(function ($attachment) use ($poll) {
                                                                            return $attachment->poll_uuid == $poll->uuid;
                                                                        });
                                                                    @endphp

                                                                    @if($attachmentsForPoll->count() > 0)    
                                                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($attachmentsForPoll->first()->attachment) }}" alt="" width="100"> 
                                                                    @else
                                                                        <img src="{{asset('app/assets/media/polls/pollImage.png')}}" alt="image" />
                                                                    @endif
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    @if($poll->poll_privacy == 'public' && $poll->start_date <= now() && $poll->end_date >= now())
                                                                        <a href="{{ route('polls.getId', ['poll' => $poll]) }}" class="fs-4  text-hover-primary fw-bold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Click here to vote!">{{ $poll->title }}</a>
                                                                    @else
                                                                        <span class="fs-4 text-gray-800 fw-bold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="This poll is not available for voting!">{{ $poll->title }}</span>
                                                                    @endif                                                            
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::User-->
                                                        </td>
                                                        <td>{{ $poll->description }}</td>
                                                        <td>{{ $poll->user->name }}</td>
                                                        <td>{{ $poll->start_date }}</td>
                                                        <td>{{ $poll->end_date }}</td>
                                                        <td class="text-center">{{ count($poll->votes) }}</td>
                                                    </tr>
                                                @endif
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

@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
    <script src="{{asset('app/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#kt_daterangepicker_3").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#kt_project_users_table').DataTable({
                "paging": true, // ativar paginação
                "lengthMenu": [5, 10, 25, 50], // escolher o número de itens por página
                "pageLength": 20, // itens por página padrão
                "ordering": true, // permitir ordenação nas colunas
                "info": true, // mostrar informações sobre a paginação
                "searching": true // ativar a pesquisa
            });
        });
    </script>

@endsection



