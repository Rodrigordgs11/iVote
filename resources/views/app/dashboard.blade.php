@extends('app.index')

@section('title', 'Dashboard')

@section('content')
	<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
		<!--begin::Content wrapper-->
		<div class="d-flex flex-column flex-column-fluid">
			<div id="kt_app_content" class="app-content flex-column-fluid">
				<!--begin::Content container-->
				<div id="kt_app_content_container" class="app-container container-fluid">
					<!--begin::Row-->
					<div class="row gx-5 gx-xl-10">
						<!--begin::Col-->
						<div class="col-xl-3 col-lg-6 col-md-3 col-sm-6 col-xs-6 mb-5">
							<!--begin: Statistics Widget 6-->
							<div class="card bg-body card-xl-stretch mb-xl-8">
								<!--begin::Body-->
								<div class="card-body my-3">
									<a href="/users" class="card-title fw-bold text-info fs-5 mb-3 d-block">Users</a>
									<div class="py-1">
										<span class="text-gray-900 fs-1 fw-bold me-2">{{ $progressBarUser }}%</span>
										<span class="fw-semibold text-muted fs-7">20k Goal</span>
									</div>
									<div class="progress h-7px bg-info bg-opacity-50 mt-7">
										<div class="progress-bar bg-info" role="progressbar" style="width: {{ $progressBarUser }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<!--end:: Body-->
							</div>
							<!--end: Statistics Widget 6-->
						</div>
						<div class="col-xl-3 col-lg-6 col-md-3 col-sm-6 col-xs-6 mb-5">
							<!--begin: Statistics Widget 6-->
							<div class="card bg-body card-xl-stretch mb-xl-8">
								<!--begin::Body-->
								<div class="card-body my-3">
									<a href="#" class="card-title fw-bold text-primary fs-5 mb-3 d-block">Total Votes</a>
									<div class="py-1">
										<span class="text-gray-900 fs-1 fw-bold me-2">{{ $progressBarVote }}%</span>
										<span class="fw-semibold text-muted fs-7">15k Goal</span>
									</div>
									<div class="progress h-7px bg-primary bg-opacity-50 mt-7">
										<div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progressBarVote }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<!--end:: Body-->
							</div>
							<!--end: Statistics Widget 6-->
						</div>
						<div class="col-xl-3 col-lg-6 col-md-3 col-sm-6 col-xs-6 mb-5">
							<!--begin: Statistics Widget 6-->
							<div class="card bg-body card-xl-stretch mb-xl-8">
								<!--begin::Body-->
								<div class="card-body my-3">
									<a href="#" class="card-title fw-bold text-warning fs-5 mb-3 d-block">Visits to client area</a>
									<div class="py-1">
										<span class="text-gray-900 fs-1 fw-bold me-2">{{ $progressBarVisit }}%</span>
										<span class="fw-semibold text-muted fs-7">100 Goal</span>
									</div>
									<div class="progress h-7px bg-warning bg-opacity-50 mt-7">
										<div class="progress-bar bg-warning" role="progressbar" style="width: {{ $progressBarVisit }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<!--end:: Body-->
							</div>
							<!--end: Statistics Widget 6-->
						</div>
						<div class="col-xl-3 col-lg-6 col-md-3 col-sm-6 col-xs-6 mb-5">
							<!--begin: Statistics Widget 6-->
							<div class="card bg-body card-xl-stretch mb-xl-8">
								<!--begin::Body-->
								<div class="card-body my-3">
									<a href="#" class="card-title fw-bold text-success fs-5 mb-3 d-block">Active Polls</a>
									<div class="py-1">
										<span class="text-gray-900 fs-1 fw-bold me-2">{{ $progressBarPoll }}%</span>
										<span class="fw-semibold text-muted fs-7">500 Goal</span>
									</div>
									<div class="progress h-7px bg-success bg-opacity-50 mt-7">
										<div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressBarPoll }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<!--end:: Body-->
							</div>
							<!--end: Statistics Widget 6-->
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
					<!--begin::Row-->
					<div class="row gx-5 gx-xl-10">
						<!--begin::Col-->
						<div class="col-xl-6 mb-5 mb-xl-10">
							<div class="tab-content" id="myTabContent">
								<!--begin:::Tab pane-->
								<div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
									<!--begin::Card-->
									<div class="card card-flush mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header mt-6">
											<!--begin::Card title-->
											<div class="card-title flex-column">
												<h2 class="mb-1">New Polls Of The Next 7 Days</h2>
											</div>
											<!--end::Card title-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body p-9 pt-4">
											<!--begin::Dates-->
											<ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2" id="scheduleDates">
												<!-- Loop through each day and create a tab for it -->
												@foreach($pollsByDay as $day => $polls)
													@php
														// Get the day number for the current day
														$dayNumber = Carbon\Carbon::parse($day)->format('d');
													@endphp
													<li class="nav-item me-1">
														<a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_{{ $loop->index }}">
															<span class="opacity-50 fs-7 fw-semibold">{{ $day }}</span>
															<span class="fs-6 fw-bolder">{{ $dayNumber }}</span>
														</a>
													</li>
												@endforeach
											</ul>
											<!--end::Dates-->
											<!-- Message to prompt user to choose a day -->
											<div class="text-center mt-4" id="chooseDayMessage">
												<p>Please choose a day to view polls.</p>
											</div>
											<!--begin::Tab Content-->
											<div class="tab-content">
												<!-- Loop through each day's polls and create content for each tab -->
												@foreach($pollsByDay as $day => $polls)
													<div id="kt_schedule_day_{{ $loop->index }}" class="tab-pane fade show">
														@if(count($polls) > 0)
															@foreach($polls as $poll)
																<!--begin::Time-->
																<div class="d-flex flex-stack position-relative mt-6 show">
																	<!--begin::Bar-->
																	<div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
																	<!--end::Bar-->
																	<!--begin::Info-->
																	<div class="fw-semibold ms-5">
																		<!--begin::Time-->
																		<div class="fs-7 mb-1">Starts at: {{ $poll->start_date->format('H:i') }}
																			<span class="fs-7 text-muted text-uppercase">{{ $poll->start_date->format('a') }}</span>
																		</div>
																		<!--end::Time-->
																		<!--begin::Title-->
																		<label class="fs-4 fw-bold text-gray-900">{{ $poll->title }}</label>
																		<!--end::Title-->
																		<!--begin::User-->
																		<div class="fs-7 text-muted">{{ $poll->description }}</a></div>
																		<!--end::User-->
																		<div class="fs-7 text mb-2">Owned by: {{ $poll->user->name }}</a></div>
																		<div class="fs-7 text">Ends on: {{ $poll->end_date->format('d-m-Y H:i:s') }}</div>
																		<div class="fs-7 text">Days left: {{ now()->diffInDays($poll->end_date) }}</div>

																	</div>
																	<!--end::Info-->
																	<!--begin::Action-->
																	<a href="{{route('polls.getId', ['poll' => $poll])}}" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
																	<!--end::Action-->
																</div>
															@endforeach
														@else
															<!-- Display a message when there are no polls for the current day -->
															<div class="text-center mt-4">
																<p>No polls available for {{ $day }}.</p>
															</div>
														@endif
													</div>
												@endforeach
											</div>
											<!--end::Tab Content-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end:::Tab pane-->
							</div>
						</div>
						<div class="col-xl-6 mb-5 mb-xl-10">
							<!--begin::Tables Widget 2-->
							<div class="card card-xl-stretch mb-5 mb-xl-8">
								<!--begin::Header-->
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bold fs-3 mb-1">Best contributers</span>
										<span class="text-muted mt-1 fw-semibold fs-7">Top 5 contributers</span>
									</h3>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body py-3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										@if(count($bestContributors) == 0)
											<div class="text-center mt-4">
												<p>No best contributers available.</p>
											</div>
										@endif
										<table class="table align-middle gs-0 gy-5">
											<!--begin::Table body-->
											<tbody>
												@foreach($bestContributors as $key => $contributor)
													<tr>
														<td class="w-10">
															<div class="symbol symbol-50px me-2">
																<span class="symbol-label">
                                                        			<img src="{{asset('app/assets/media/avatars/300-6.jpg')}}" alt="Emma Smith" class="w-100" />
																</span>
															</div>
														</td>
														<td class="text-start">
															<a href="{{route('users.getId', ['user' => $contributor])}}" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">{{ $contributor->name }}</a>
														</td>
														<td>
															<a  class="text-gray-700 fw-bold mb-1 fs-7">{{ $contributor->email }}</a>
														</td>
														<td class="text-end">
															<span class="text-muted fw-bold">{{ $contributor->total }} Votes</span>
														</td>
													</tr>
												@endforeach
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Table container-->
								</div>
								<!--end::Body-->
							</div>
							<!--end::Tables Widget 2-->
						</div>
						<!--end::Col-->
					</div>
				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Content wrapper-->
		<!--begin::Modal - Add schedule-->
		<div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header">
						<!--begin::Modal title-->
						<h2 class="fw-bold">Add an Event</h2>
						<!--end::Modal title-->
						<!--begin::Close-->
						<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
							<i class="ki-outline ki-cross fs-1"></i>
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
						<!--begin::Form-->
						<form id="kt_modal_add_schedule_form" class="form" action="#">
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<!--begin::Label-->
								<label class="required fs-6 fw-semibold form-label mb-2">Event Name</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" name="event_name" value="" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label mb-2">
									<span class="required">Date & Time</span>
									<span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Select a date & time.">
										<i class="ki-outline ki-information fs-7"></i>
									</span>
								</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="form-control form-control-solid" placeholder="Pick date & time" name="event_datetime" id="kt_modal_add_schedule_datepicker" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<!--begin::Label-->
								<label class="required fs-6 fw-semibold form-label mb-2">Event Organiser</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-solid" name="event_org" value="" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<!--begin::Label-->
								<label class="required fs-6 fw-semibold form-label mb-2">Send Event Details To</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input id="kt_modal_add_schedule_tagify" type="text" class="form-control form-control-solid" name="event_invitees" value="smith@kpmg.com, melody@altbox.com" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center pt-15">
								<button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
								<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
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
	</div>

@endsection

@section('scripts')
	<script src="{{asset('app/assets/js/custom/apps/user-management/users/view/add-schedule.js')}}"></script>
@endsection