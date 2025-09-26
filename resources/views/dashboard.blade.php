@php $pageName = "dashboard"; $subpageName = ""; @endphp

@extends('layouts.app')


@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2" style="margin-left: 20px">
					<div class="mb-3">
						<h1 class="mb-1">Welcome, {{auth()->user()->name}}</h1>
						<p class="fw-medium">Have a   great day !!!</p>
					</div>
					<div class="input-icon-start position-relative mb-3">
						<span class="input-icon-addon fs-16 text-gray-9">
							<i class="ti ti-calendar"></i>
						</span>
						<input type="text" class="form-control date-range bookingrange" placeholder="Search Product">
					</div>
				</div>

				<div class="alert bg-orange-transparent alert-dismissible fade show mb-4">
					<div>
						<span><i class="ti ti-info-circle fs-14 text-orange me-2"></i>Your Product </span> <span class="text-orange fw-semibold"> Apple Iphone 15 is running Low, </span> already below 5 Pcs., <a href="javascript:void(0);" class="link-orange text-decoration-underline fw-semibold" data-bs-toggle="modal" data-bs-target="#add-stock">Add Stock</a>
					</div>
					<button type="button" class="btn-close text-gray-9 fs-14" data-bs-dismiss="alert" aria-label="Close"><i class="ti ti-x"></i></button>
				</div>

				<div class="row" style="margin-left: 10px">
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="card bg-primary sale-widget flex-fill">
							<div class="card-body d-flex align-items-center">
								<span class="sale-icon bg-white text-primary">
									<i class="ti ti-file-text fs-24"></i>
								</span>
								<div class="ms-2">
									<p class="text-white mb-1">Total Forms Sold</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">  </h4>
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
										<h4 class="text-white"> </h4>
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
										<h4 class="text-white"> </h4>
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
				</div>

				
				<div class="row" style="margin-left: 10px">

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

				{{-- <div class="row">
					<div class="col-lg-4 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header pb-0 d-flex justify-content-between align-items-center">
								<h4 class="card-title mb-0">Turn Around Time</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive dataview">
									<table class="table datatable ">
										<thead>
											<tr>
												<th>Type</th>
												<th>Total</th>
												<th>TRT</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($applicationFormType as $item)
												<tr>
												<td align="center">{{ $item->formName }}</td>
												<td class="productimgname" align="center">
													
													<a href="#">{{ number_format($item->getFormCounts()) }}</a>
												</td>
												<td align="center">0.2 Day</td>
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div> --}}


@endsection

@section('scripts')
    
@endsection