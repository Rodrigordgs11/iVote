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
										<span class="text-gray-900 fs-1 fw-bold me-2">{{ $progressBar }}%</span>
										<span class="fw-semibold text-muted fs-7">20k Goal</span>
									</div>
									<div class="progress h-7px bg-info bg-opacity-50 mt-7">
										<div class="progress-bar bg-info" role="progressbar" style="width: {{ $progressBar }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
										<span class="text-gray-900 fs-1 fw-bold me-2">15%</span>
										<span class="fw-semibold text-muted fs-7">48k Goal</span>
									</div>
									<div class="progress h-7px bg-primary bg-opacity-50 mt-7">
										<div class="progress-bar bg-primary" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
									<a href="#" class="card-title fw-bold text-warning fs-5 mb-3 d-block">Number of Visits to Landing Page</a>
									<div class="py-1">
										<span class="text-gray-900 fs-1 fw-bold me-2">15%</span>
										<span class="fw-semibold text-muted fs-7">48k Goal</span>
									</div>
									<div class="progress h-7px bg-warning bg-opacity-50 mt-7">
										<div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
										<span class="text-gray-900 fs-1 fw-bold me-2">15%</span>
										<span class="fw-semibold text-muted fs-7">48k Goal</span>
									</div>
									<div class="progress h-7px bg-success bg-opacity-50 mt-7">
										<div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
								<!--begin:::Tab pane-->
								<div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
									<!--begin::Card-->
									<div class="card pt-4 mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header border-0">
											<!--begin::Card title-->
											<div class="card-title">
												<h2>Profile</h2>
											</div>
											<!--end::Card title-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body pt-0 pb-5">
											<!--begin::Table wrapper-->
											<div class="table-responsive">
												<!--begin::Table-->
												<table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
													<tbody class="fs-6 fw-semibold text-gray-600">
														<tr>
															<td>Email</td>
															<td>smith@kpmg.com</td>
															<td class="text-end">
																<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
																	<i class="ki-outline ki-pencil fs-3"></i>
																</button>
															</td>
														</tr>
														<tr>
															<td>Password</td>
															<td>******</td>
															<td class="text-end">
																<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
																	<i class="ki-outline ki-pencil fs-3"></i>
																</button>
															</td>
														</tr>
														<tr>
															<td>Role</td>
															<td>Administrator</td>
															<td class="text-end">
																<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
																	<i class="ki-outline ki-pencil fs-3"></i>
																</button>
															</td>
														</tr>
													</tbody>
												</table>
												<!--end::Table-->
											</div>
											<!--end::Table wrapper-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
									<!--begin::Card-->
									<div class="card pt-4 mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header border-0">
											<!--begin::Card title-->
											<div class="card-title flex-column">
												<h2 class="mb-1">Two Step Authentication</h2>
												<div class="fs-6 fw-semibold text-muted">Keep your account extra secure with a second authentication step.</div>
											</div>
											<!--end::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Add-->
												<button type="button" class="btn btn-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
												<i class="ki-outline ki-fingerprint-scanning fs-3"></i>Add Authentication Step</button>
												<!--begin::Menu-->
												<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														<a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_auth_app">Use authenticator app</a>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														<a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">Enable one-time password</a>
													</div>
													<!--end::Menu item-->
												</div>
												<!--end::Menu-->
												<!--end::Add-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body pb-5">
											<!--begin::Item-->
											<div class="d-flex flex-stack">
												<!--begin::Content-->
												<div class="d-flex flex-column">
													<span>SMS</span>
													<span class="text-muted fs-6">+61 412 345 678</span>
												</div>
												<!--end::Content-->
												<!--begin::Action-->
												<div class="d-flex justify-content-end align-items-center">
													<!--begin::Button-->
													<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">
														<i class="ki-outline ki-pencil fs-3"></i>
													</button>
													<!--end::Button-->
													<!--begin::Button-->
													<button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" id="kt_users_delete_two_step">
														<i class="ki-outline ki-trash fs-3"></i>
													</button>
													<!--end::Button-->
												</div>
												<!--end::Action-->
											</div>
											<!--end::Item-->
											<!--begin:Separator-->
											<div class="separator separator-dashed my-5"></div>
											<!--end:Separator-->
											<!--begin::Disclaimer-->
											<div class="text-gray-600">If you lose your mobile device or security key, you can 
											<a href='#' class="me-1">generate a backup code</a>to sign in to your account.</div>
											<!--end::Disclaimer-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
									<!--begin::Card-->
									<div class="card pt-4 mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header border-0">
											<!--begin::Card title-->
											<div class="card-title flex-column">
												<h2>Email Notifications</h2>
												<div class="fs-6 fw-semibold text-muted">Choose what messages you’d like to receive for each of your accounts.</div>
											</div>
											<!--end::Card title-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body">
											<!--begin::Form-->
											<form class="form" id="kt_users_email_notification_form">
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_0" type="checkbox" value="0" id="kt_modal_update_email_notification_0" checked='checked' />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_0">
															<div class="fw-bold">Successful Payments</div>
															<div class="text-gray-600">Receive a notification for every successful payment.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_1" type="checkbox" value="1" id="kt_modal_update_email_notification_1" />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_1">
															<div class="fw-bold">Payouts</div>
															<div class="text-gray-600">Receive a notification for every initiated payout.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_2" type="checkbox" value="2" id="kt_modal_update_email_notification_2" />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_2">
															<div class="fw-bold">Application fees</div>
															<div class="text-gray-600">Receive a notification each time you collect a fee from an account.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_3" type="checkbox" value="3" id="kt_modal_update_email_notification_3" checked='checked' />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_3">
															<div class="fw-bold">Disputes</div>
															<div class="text-gray-600">Receive a notification if a payment is disputed by a customer and for dispute resolutions.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_4" type="checkbox" value="4" id="kt_modal_update_email_notification_4" checked='checked' />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_4">
															<div class="fw-bold">Payment reviews</div>
															<div class="text-gray-600">Receive a notification if a payment is marked as an elevated risk.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_5" type="checkbox" value="5" id="kt_modal_update_email_notification_5" />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_5">
															<div class="fw-bold">Mentions</div>
															<div class="text-gray-600">Receive a notification if a teammate mentions you in a note.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_6" type="checkbox" value="6" id="kt_modal_update_email_notification_6" />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_6">
															<div class="fw-bold">Invoice Mispayments</div>
															<div class="text-gray-600">Receive a notification if a customer sends an incorrect amount to pay their invoice.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_7" type="checkbox" value="7" id="kt_modal_update_email_notification_7" />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_7">
															<div class="fw-bold">Webhooks</div>
															<div class="text-gray-600">Receive notifications about consistently failing webhook endpoints.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<div class='separator separator-dashed my-5'></div>
												<!--begin::Item-->
												<div class="d-flex">
													<!--begin::Checkbox-->
													<div class="form-check form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input me-3" name="email_notification_8" type="checkbox" value="8" id="kt_modal_update_email_notification_8" />
														<!--end::Input-->
														<!--begin::Label-->
														<label class="form-check-label" for="kt_modal_update_email_notification_8">
															<div class="fw-bold">Trial</div>
															<div class="text-gray-600">Receive helpful tips when you try out our products.</div>
														</label>
														<!--end::Label-->
													</div>
													<!--end::Checkbox-->
												</div>
												<!--end::Item-->
												<!--begin::Action buttons-->
												<div class="d-flex justify-content-end align-items-center mt-12">
													<!--begin::Button-->
													<button type="button" class="btn btn-light me-5" id="kt_users_email_notification_cancel">Cancel</button>
													<!--end::Button-->
													<!--begin::Button-->
													<button type="button" class="btn btn-primary" id="kt_users_email_notification_submit">
														<span class="indicator-label">Save</span>
														<span class="indicator-progress">Please wait... 
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
													</button>
													<!--end::Button-->
												</div>
												<!--begin::Action buttons-->
											</form>
											<!--end::Form-->
										</div>
										<!--end::Card body-->
										<!--begin::Card footer-->
										<!--end::Card footer-->
									</div>
									<!--end::Card-->
								</div>
								<!--end:::Tab pane-->
								<!--begin:::Tab pane-->
								<div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
									<!--begin::Card-->
									<div class="card pt-4 mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header border-0">
											<!--begin::Card title-->
											<div class="card-title">
												<h2>Login Sessions</h2>
											</div>
											<!--end::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Filter-->
												<button type="button" class="btn btn-sm btn-flex btn-light-primary" id="kt_modal_sign_out_sesions">
												<i class="ki-outline ki-entrance-right fs-3"></i>Sign out all sessions</button>
												<!--end::Filter-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body pt-0 pb-5">
											<!--begin::Table wrapper-->
											<div class="table-responsive">
												<!--begin::Table-->
												<table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
													<thead class="border-bottom border-gray-200 fs-7 fw-bold">
														<tr class="text-start text-muted text-uppercase gs-0">
															<th class="min-w-100px">Location</th>
															<th>Device</th>
															<th>IP Address</th>
															<th class="min-w-125px">Time</th>
															<th class="min-w-70px">Actions</th>
														</tr>
													</thead>
													<tbody class="fs-6 fw-semibold text-gray-600">
														<tr>
															<td>Australia</td>
															<td>Chome - Windows</td>
															<td>207.12.39.356</td>
															<td>23 seconds ago</td>
															<td>Current session</td>
														</tr>
														<tr>
															<td>Australia</td>
															<td>Safari - iOS</td>
															<td>207.15.13.165</td>
															<td>3 days ago</td>
															<td>
																<a href="#" data-kt-users-sign-out="single_user">Sign out</a>
															</td>
														</tr>
														<tr>
															<td>Australia</td>
															<td>Chrome - Windows</td>
															<td>207.47.26.163</td>
															<td>last week</td>
															<td>Expired</td>
														</tr>
													</tbody>
												</table>
												<!--end::Table-->
											</div>
											<!--end::Table wrapper-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
									<!--begin::Card-->
									<div class="card pt-4 mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header border-0">
											<!--begin::Card title-->
											<div class="card-title">
												<h2>Logs</h2>
											</div>
											<!--end::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Button-->
												<button type="button" class="btn btn-sm btn-light-primary">
												<i class="ki-outline ki-cloud-download fs-3"></i>Download Report</button>
												<!--end::Button-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body py-0">
											<!--begin::Table wrapper-->
											<div class="table-responsive">
												<!--begin::Table-->
												<table class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5" id="kt_table_users_logs">
													<tbody>
														<tr>
															<td class="min-w-70px">
																<div class="badge badge-light-danger">500 ERR</div>
															</td>
															<td>POST /v1/invoice/in_8019_1059/invalid</td>
															<td class="pe-0 text-end min-w-200px">22 Sep 2023, 8:43 pm</td>
														</tr>
														<tr>
															<td class="min-w-70px">
																<div class="badge badge-light-danger">500 ERR</div>
															</td>
															<td>POST /v1/invoice/in_8019_1059/invalid</td>
															<td class="pe-0 text-end min-w-200px">22 Sep 2023, 6:05 pm</td>
														</tr>
														<tr>
															<td class="min-w-70px">
																<div class="badge badge-light-warning">404 WRN</div>
															</td>
															<td>POST /v1/customer/c_654c84cb82604/not_found</td>
															<td class="pe-0 text-end min-w-200px">25 Jul 2023, 2:40 pm</td>
														</tr>
														<tr>
															<td class="min-w-70px">
																<div class="badge badge-light-success">200 OK</div>
															</td>
															<td>POST /v1/invoices/in_3450_2317/payment</td>
															<td class="pe-0 text-end min-w-200px">05 May 2023, 11:05 am</td>
														</tr>
														<tr>
															<td class="min-w-70px">
																<div class="badge badge-light-warning">404 WRN</div>
															</td>
															<td>POST /v1/customer/c_654c84cb82604/not_found</td>
															<td class="pe-0 text-end min-w-200px">22 Sep 2023, 9:23 pm</td>
														</tr>
													</tbody>
												</table>
												<!--end::Table-->
											</div>
											<!--end::Table wrapper-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
									<!--begin::Card-->
									<div class="card pt-4 mb-6 mb-xl-9">
										<!--begin::Card header-->
										<div class="card-header border-0">
											<!--begin::Card title-->
											<div class="card-title">
												<h2>Events</h2>
											</div>
											<!--end::Card title-->
											<!--begin::Card toolbar-->
											<div class="card-toolbar">
												<!--begin::Button-->
												<button type="button" class="btn btn-sm btn-light-primary">
												<i class="ki-outline ki-cloud-download fs-3"></i>Download Report</button>
												<!--end::Button-->
											</div>
											<!--end::Card toolbar-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body py-0">
											<!--begin::Table-->
											<!-- <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5" id="kt_table_customers_events">
												<tbody>
													<tr>
														<td class="min-w-400px">
														<a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">25 Jul 2023, 5:30 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">Invoice 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#KIO-45656</a>status has changed from 
														<span class="badge badge-light-succees me-1">In Transit</span>to 
														<span class="badge badge-light-success">Approved</span></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2023, 5:30 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">
														<a href="#" class="text-gray-600 text-hover-primary me-1">Brian Cox</a>has made payment to 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary">#OLP-45690</a></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">22 Sep 2023, 9:23 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">Invoice 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#DER-45645</a>status has changed from 
														<span class="badge badge-light-info me-1">In Progress</span>to 
														<span class="badge badge-light-primary">In Transit</span></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">19 Aug 2023, 8:43 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">
														<a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2023, 6:05 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">Invoice 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#SEP-45656</a>status has changed from 
														<span class="badge badge-light-warning me-1">Pending</span>to 
														<span class="badge badge-light-info">In Progress</span></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">21 Feb 2023, 8:43 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">Invoice 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#WER-45670</a>is 
														<span class="badge badge-light-info">In Progress</span></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2023, 6:05 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">Invoice 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#WER-45670</a>is 
														<span class="badge badge-light-info">In Progress</span></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">25 Jul 2023, 6:05 pm</td>
													</tr>
													<tr>
														<td class="min-w-400px">
														<a href="#" class="text-gray-600 text-hover-primary me-1">Sean Bean</a>has made payment to 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">22 Sep 2023, 11:05 am</td>
													</tr>
													<tr>
														<td class="min-w-400px">
														<a href="#" class="text-gray-600 text-hover-primary me-1">Brian Cox</a>has made payment to 
														<a href="#" class="fw-bold text-gray-900 text-hover-primary">#OLP-45690</a></td>
														<td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2023, 6:43 am</td>
													</tr>
												</tbody>
											</table> -->
											<!--end::Table-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Card-->
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
										<table class="table align-middle gs-0 gy-5">
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="assets/media/svg/brand-logos/plurk.svg" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td class="align-items-start">
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Top Authors</a>
														<span class="text-muted fw-semibold d-block fs-7">Successful Fellas</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-bold">4600 Users</span>
													</td>
												</tr>
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