@extends('customer.template.layout')

@section('title')
    {{__('Dashboard')}}
@endsection

@section('content')
    <div class="content">

				<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2">
					<div class="mb-3">
						<h1 class="mb-1">Welcome, {{$user->applicantName}}</h1>
						<p class="fw-medium">Have a   great day !!!</p>
					</div>
					{{-- <div class="input-icon-start position-relative mb-3">
						<span class="input-icon-addon fs-16 text-gray-9">
							<i class="ti ti-calendar"></i>
						</span>
						<input type="text" class="form-control date-range bookingrange" placeholder="Search Product">
					</div> --}}
				</div>

				

				<div class="row">
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card bg-primary sale-widget flex-fill">
							<div class="card-body d-flex align-items-center">
								<span class="sale-icon bg-white text-primary">
									<i class="ti ti-file-text fs-24"></i>
								</span>
								<div class="ms-2">
									<p class="text-white mb-1">Total Forms Sold</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">{{ number_format($totalFormSold) }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card bg-secondary sale-widget flex-fill">
							<div class="card-body d-flex align-items-center">
								<span class="sale-icon bg-white text-secondary">
									<i class="ti ti-repeat fs-24"></i>
								</span>
								<div class="ms-2">
									<p class="text-white mb-1">Permit Applied</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">{{ number_format($permitsCount) }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card bg-teal sale-widget flex-fill">
							<div class="card-body d-flex align-items-center">
								<span class="sale-icon bg-white text-teal">
									<i class="ti ti-gift fs-24"></i>
								</span>
								<div class="ms-2">
									<p class="text-white mb-1">Approved Permits</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">{{ number_format($approvePermitCount) }}</h4>
									
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card bg-info sale-widget flex-fill">
							<div class="card-body d-flex align-items-center">
								<span class="sale-icon bg-white text-info">
									<i class="ti ti-brand-pocket fs-24"></i>
								</span>
								<div class="ms-2">
									<p class="text-white mb-1">Expired Permits</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">--</h4>
										
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">

					<!-- Profit -->
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card revenue-widget flex-fill">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
									<div>
										<h4 class="mb-1">0</h4>
										<p>Turn Around Time</p>
									</div>
									<span class="revenue-icon bg-cyan-transparent text-cyan">
										<i class="fa-solid fa-layer-group fs-16"></i>
									</span>
								</div>
								
							</div>
						</div>
					</div>
					<!-- /Profit -->

					<!-- Invoice -->
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card revenue-widget flex-fill">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
									<div>
										<h4 class="mb-1">0</h4>
										<p>Certificate Applied</p>
									</div>
									<span class="revenue-icon bg-teal-transparent text-teal">
										<i class="ti ti-chart-pie fs-16"></i>
									</span>
								</div>
								
							</div>
						</div>
					</div>
					<!-- /Invoice -->

					<!-- Expenses -->
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card revenue-widget flex-fill">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
									<div>
										<h4 class="mb-1">0</h4>
										<p>Approved Certificates</p>
									</div>
									<span class="revenue-icon bg-orange-transparent text-orange">
										<i class="ti ti-lifebuoy fs-16"></i>
									</span>
								</div>
								
							</div>
						</div>
					</div>
					<!-- /Expenses -->

					<!-- Returns -->
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card revenue-widget flex-fill">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
									<div>
										<h4 class="mb-1">0</h4>
										<p>Renewal Applications</p>
									</div>
									<span class="revenue-icon bg-indigo-transparent text-indigo">
										<i class="ti ti-hash fs-16"></i>
									</span>
								</div>
								
							</div>
						</div>
					</div>
					<!-- /Returns -->

				</div>
	
				
				<div class="row">


                    <!-- Recent Transactions -->
					<div class="col-xl-6 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-3">
								<div class="d-inline-flex align-items-center">
									<span class="title-icon bg-soft-orange fs-16 me-2"><i class="ti ti-flag"></i></span>
									<h5 class="card-title mb-0">Recent Transactions</h5>
								</div>
								<a href="#" class="fs-13 fw-medium text-decoration-underline">View All</a>
							</div>
							<div class="card-body p-0">
								<ul class="nav nav-tabs nav-justified transaction-tab">
									<li class="nav-item"><a class="nav-link active" href="#sale" data-bs-toggle="tab">Permit</a></li>
									<li class="nav-item"><a class="nav-link" href="#purchase-transaction" data-bs-toggle="tab">---</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane show active" id="sale">
										<div class="table-responsive">
											<table class="table table-borderless custom-table">
												<thead class="thead-light">
													<tr>
														<th>Project Title</th>
														<th>Location</th>
														<th>Current Stage</th>
													</tr>
												</thead>
												<tbody>
													@foreach($latestPermitData as $item)
													<tr>
														<td>{{$item->project_title}}</td>
														<td>{{$item->address}}</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>{{$item->formsale->currentStage->activityname->activity}}</span></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="purchase-transaction">
										<div class="table-responsive">
											
										</div>
									</div>
									
								</div>						
							</div>
						</div>
					</div>
					<!-- /Recent Transactions -->

				

				</div>
				
			</div>
@endsection
