@extends('customer.template.layout')

@section('title')
    {{__('Dashboard')}}
@endsection

@section('content')
    <div class="content">

				<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2">
					<div class="mb-3">
						<h1 class="mb-1">Welcome, Admin</h1>
						<p class="fw-medium">You have <span class="text-primary fw-bold">200+</span> Orders, Today</p>
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
									<p class="text-white mb-1">Total Sales</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">$48,988,078</h4>
										<span class="badge badge-soft-primary"><i class="ti ti-arrow-up me-1"></i>+22%</span>
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
									<p class="text-white mb-1">Total Sales Return</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">$16,478,145</h4>
										<span class="badge badge-soft-danger"><i class="ti ti-arrow-down me-1"></i>-22%</span>
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
									<p class="text-white mb-1">Total Purchase</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">$24,145,789</h4>
										<span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span>
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
									<p class="text-white mb-1">Total Purchase Return</p>
									<div class="d-inline-flex align-items-center flex-wrap gap-2">
										<h4 class="text-white">$18,458,747</h4>
										<span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span>
									</div>
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
										<h4 class="mb-1">$8,458,798</h4>
										<p>Profit</p>
									</div>
									<span class="revenue-icon bg-cyan-transparent text-cyan">
										<i class="fa-solid fa-layer-group fs-16"></i>
									</span>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<p class="mb-0"><span class="fs-13 fw-bold text-success">+35%</span> vs Last Month</p>
									<a href="profit-and-loss.html" class="text-decoration-underline fs-13 fw-medium">View All</a>
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
										<h4 class="mb-1">$48,988,78</h4>
										<p>Invoice Due</p>
									</div>
									<span class="revenue-icon bg-teal-transparent text-teal">
										<i class="ti ti-chart-pie fs-16"></i>
									</span>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<p class="mb-0"><span class="fs-13 fw-bold text-success">+35%</span> vs Last Month</p>
									<a href="invoice-report.html" class="text-decoration-underline fs-13 fw-medium">View All</a>
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
										<h4 class="mb-1">$8,980,097</h4>
										<p>Total Expenses</p>
									</div>
									<span class="revenue-icon bg-orange-transparent text-orange">
										<i class="ti ti-lifebuoy fs-16"></i>
									</span>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<p class="mb-0"><span class="fs-13 fw-bold text-success">+41%</span> vs Last Month</p>
									<a href="expense-list.html" class="text-decoration-underline fs-13 fw-medium">View All</a>
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
										<h4 class="mb-1">$78,458,798</h4>
										<p>Total Payment Returns</p>
									</div>
									<span class="revenue-icon bg-indigo-transparent text-indigo">
										<i class="ti ti-hash fs-16"></i>
									</span>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<p class="mb-0"><span class="fs-13 fw-bold text-danger">-20%</span> vs Last Month</p>
									<a href="sales-report.html" class="text-decoration-underline fs-13 fw-medium">View All</a>
								</div>
							</div>
						</div>
					</div>
					<!-- /Returns -->

				</div>

				
				<div class="row">

					<!-- Top Selling Products -->
					<div class="col-xxl-4 col-md-6 d-flex">
						<div class="card flex-fill">
							<div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
								<div class="d-inline-flex align-items-center">
									<span class="title-icon bg-soft-pink fs-16 me-2"><i class="ti ti-box"></i></span>
									<h5 class="card-title mb-0">Top Selling Products</h5>
								</div>
								<div class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle btn btn-sm btn-white" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="ti ti-calendar me-1"></i>Today
									</a>
									<ul class="dropdown-menu p-3">
										<li>
											<a href="javascript:void(0);" class="dropdown-item">Today</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item">Weekly</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item">Monthly</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body sell-product">
								<div class="d-flex align-items-center justify-content-between border-bottom">
									<div class="d-flex align-items-center">
										<a href="javascript:void(0);" class="avatar avatar-lg">
											<img src="assets/img/products/product-01.jpg" alt="img">
										</a>
										<div class="ms-2">
											<h6 class="fw-bold mb-1"><a href="javascript:void(0);">Charger Cable - Lighting</a></h6>
											<div class="d-flex align-items-center item-list">			
												<p>$187</p>
												<p>247+ Sales</p>
											</div>
										</div>
									</div>
									<span class="badge bg-outline-success badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-up-left me-1"></i>25%</span>
								</div>
								<div class="d-flex align-items-center justify-content-between border-bottom">
									<div class="d-flex align-items-center">
										<a href="javascript:void(0);" class="avatar avatar-lg">
											<img src="assets/img/products/product-16.jpg" alt="img">
										</a>
										<div class="ms-2">
											<h6 class="fw-bold mb-1"><a href="javascript:void(0);">Yves Saint Eau De Parfum</a></h6>
											<div class="d-flex align-items-center item-list">			
												<p>$145</p>
												<p>289+ Sales</p>
											</div>
										</div>
									</div>
									<span class="badge bg-outline-success badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-up-left me-1"></i>25%</span>
								</div>
								<div class="d-flex align-items-center justify-content-between border-bottom">
									<div class="d-flex align-items-center">
										<a href="javascript:void(0);" class="avatar avatar-lg">
											<img src="assets/img/products/product-03.jpg" alt="img">
										</a>
										<div class="ms-2">
											<h6 class="fw-bold mb-1"><a href="javascript:void(0);">Apple Airpods 2</a></h6>
											<div class="d-flex align-items-center item-list">			
												<p>$458</p>
												<p>300+ Sales</p>
											</div>
										</div>
									</div>
									<span class="badge bg-outline-success badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-up-left me-1"></i>25%</span>
								</div>
								<div class="d-flex align-items-center justify-content-between border-bottom">
									<div class="d-flex align-items-center">
										<a href="javascript:void(0);" class="avatar avatar-lg">
											<img src="assets/img/products/product-04.jpg" alt="img">
										</a>
										<div class="ms-2">
											<h6 class="fw-bold mb-1"><a href="javascript:void(0);">Vacuum Cleaner</a></h6>
											<div class="d-flex align-items-center item-list">			
												<p>$139</p>
												<p>225+ Sales</p>
											</div>
										</div>
									</div>
									<span class="badge bg-outline-danger badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-down-left me-1"></i>21%</span>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
										<a href="javascript:void(0);" class="avatar avatar-lg">
											<img src="assets/img/products/product-05.jpg" alt="img">
										</a>
										<div class="ms-2">
											<h6 class="fw-bold mb-1"><a href="javascript:void(0);">Samsung Galaxy S21 Fe 5g</a></h6>
											<div class="d-flex align-items-center item-list">			
												<p>$898</p>
												<p>365+ Sales</p>
											</div>
										</div>
									</div>
									<span class="badge bg-outline-success badge-xs d-inline-flex align-items-center"><i class="ti ti-arrow-up-left me-1"></i>25%</span>
								</div>
							</div>
						</div>
					</div>
					<!-- /Top Selling Products -->

                    <!-- Recent Transactions -->
					<div class="col-xl-8 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-3">
								<div class="d-inline-flex align-items-center">
									<span class="title-icon bg-soft-orange fs-16 me-2"><i class="ti ti-flag"></i></span>
									<h5 class="card-title mb-0">Recent Transactions</h5>
								</div>
								<a href="online-orders.html" class="fs-13 fw-medium text-decoration-underline">View All</a>
							</div>
							<div class="card-body p-0">
								<ul class="nav nav-tabs nav-justified transaction-tab">
									<li class="nav-item"><a class="nav-link active" href="#sale" data-bs-toggle="tab">Sale</a></li>
									<li class="nav-item"><a class="nav-link" href="#purchase-transaction" data-bs-toggle="tab">Purchase</a></li>
									<li class="nav-item"><a class="nav-link" href="#quotation" data-bs-toggle="tab">Quotation</a></li>
									<li class="nav-item"><a class="nav-link" href="#expenses" data-bs-toggle="tab">Expenses</a></li>
									<li class="nav-item"><a class="nav-link" href="#invoices" data-bs-toggle="tab">Invoices</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane show active" id="sale">
										<div class="table-responsive">
											<table class="table table-borderless custom-table">
												<thead class="thead-light">
													<tr>
														<th>Date</th>
														<th>Customer</th>
														<th>Status</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>24 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer16.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6><a href="javascript:void(0);" class="fw-bold">Andrea Willer</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="fs-16 fw-bold text-gray-9">$4,560</td>
													</tr>
													<tr>
														<td>23 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer17.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6><a href="javascript:void(0);" class="fw-bold">Timothy Sandsr</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="fs-16 fw-bold text-gray-9">$3,569</td>
													</tr>
													<tr>
														<td>22 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer18.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6><a href="javascript:void(0);" class="fw-bold">Bonnie Rodrigues</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-pink badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Draft</span></td>
														<td class="fs-16 fw-bold text-gray-9">$4,560</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer15.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6><a href="javascript:void(0);" class="fw-bold">Randy McCree</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="fs-16 fw-bold text-gray-9">$2,155</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer13.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6><a href="javascript:void(0);" class="fw-bold">Dennis Anderson</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="fs-16 fw-bold text-gray-9">$5,123</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="purchase-transaction">
										<div class="table-responsive">
											<table class="table table-borderless custom-table">
												<thead class="thead-light">
													<tr>
														<th>Date</th>
														<th>Supplier</th>
														<th>Status</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>24 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">Electro Mart</a>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="text-gray-9">$1000</td>
													</tr>
													<tr>
														<td>23 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">Quantum Gadgets</a>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="text-gray-9">$1500</td>
													</tr>
													<tr>
														<td>22 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">Prime Bazaar</a>
														</td>
														<td><span class="badge badge-cyan badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Pending</span></td>
														<td class="text-gray-9">$2000</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">Alpha Mobiles</a>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="text-gray-9">$1200</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">Aesthetic Bags</a>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="text-gray-9">$1300</td>
													</tr>
													<tr>
														<td>28 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">Sigma Chairs</a>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="text-gray-9">$1600</td>
													</tr>
													<tr>
														<td>26 May 2025</td>
														<td>
															<a href="javascript:void(0);" class="fw-semibold">A-Z Store	s</a>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Completed</span></td>
														<td class="text-gray-9">$1100</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="quotation">
										<div class="table-responsive">
											<table class="table table-borderless custom-table">
												<thead class="thead-light">
													<tr>
														<th>Date</th>
														<th>Customer</th>
														<th>Status</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>24 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer16.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-medium"><a href="javascript:void(0);">Andrea Willer</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Sent</span></td>
														<td class="text-gray-9">$4,560</td>
													</tr>
													<tr>
														<td>23 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer17.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-medium"><a href="javascript:void(0);">Timothy Sandsr</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-warning badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Ordered</span></td>
														<td class="text-gray-9">$3,569</td>
													</tr>
													<tr>
														<td>22 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer18.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-medium"><a href="javascript:void(0);">Bonnie Rodrigues</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-cyan badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Pending</span></td>
														<td class="text-gray-9">$4,560</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer15.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-medium"><a href="javascript:void(0);">Randy McCree</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-warning badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Ordered</span></td>
														<td class="text-gray-9">$2,155</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer13.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-medium"><a href="javascript:void(0);">Dennis Anderson</a></h6>
																	<span class="fs-13 text-orange">#114589</span>
																</div>
															</div>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Sent</span></td>
														<td class="text-gray-9">$5,123</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="expenses">
										<div class="table-responsive">
											<table class="table table-borderless custom-table">
												<thead class="thead-light">
													<tr>
														<th>Date</th>
														<th>Expenses</th>
														<th>Status</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>24 May 2025</td>
														<td>
															<h6 class="fw-medium"><a href="javascript:void(0);">Electricity Payment</a></h6>
															<span class="fs-13 text-orange">#EX849</span>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Approved</span></td>
														<td class="text-gray-9">$200</td>
													</tr>
													<tr>
														<td>23 May 2025</td>
														<td>
															<h6 class="fw-medium"><a href="javascript:void(0);">Electricity Payment</a></h6>
															<span class="fs-13 text-orange">#EX849</span>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Approved</span></td>
														<td class="text-gray-9">$200</td>
													</tr>
													<tr>
														<td>22 May 2025</td>
														<td>
															<h6 class="fw-medium"><a href="javascript:void(0);">Stationery Purchase</a></h6>
															<span class="fs-13 text-orange">#EX848</span>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Approved</span></td>
														<td class="text-gray-9">$50</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<h6 class="fw-medium"><a href="javascript:void(0);">AC Repair Service</a></h6>
															<span class="fs-13 text-orange">#EX847</span>
														</td>
														<td><span class="badge badge-cyan badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Pending</span></td>
														<td class="text-gray-9">$800</td>
													</tr>
													<tr>
														<td>21 May 2025</td>
														<td>
															<h6 class="fw-medium"><a href="javascript:void(0);">Client Meeting</a></h6>
															<span class="fs-13 text-orange">#EX846</span>
														</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Approved</span></td>
														<td class="text-gray-9">$100</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="invoices">
										<div class="table-responsive">
											<table class="table table-borderless custom-table">
												<thead class="thead-light">
													<tr>
														<th>Customer</th>
														<th>Due Date</th>
														<th>Status</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer16.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-bold"><a href="javascript:void(0);">Andrea Willer</a></h6>
																	<span class="fs-13 text-orange">#INV005</span>
																</div>
															</div>
														</td>
														<td>24 May 2025</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Paid</span></td>
														<td class="text-gray-9">$1300</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer17.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-bold"><a href="javascript:void(0);">Timothy Sandsr</a></h6>
																	<span class="fs-13 text-orange">#INV004</span>
																</div>
															</div>
														</td>
														<td>23 May 2025</td>
														<td><span class="badge badge-warning badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Overdue</span></td>
														<td class="text-gray-9">$1250</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer18.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-bold"><a href="javascript:void(0);">Bonnie Rodrigues</a></h6>
																	<span class="fs-13 text-orange">#INV003</span>
																</div>
															</div>
														</td>
														<td>22 May 2025</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Paid</span></td>
														<td class="text-gray-9">$1700</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer15.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-bold"><a href="javascript:void(0);">Randy McCree</a></h6>
																	<span class="fs-13 text-orange">#INV002</span>
																</div>
															</div>
														</td>
														<td>21 May 2025</td>
														<td><span class="badge badge-danger badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Unpaid</span></td>
														<td class="text-gray-9">$1500</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex align-items-center file-name-icon">
																<a href="javascript:void(0);" class="avatar avatar-md">
																	<img src="assets/img/customer/customer13.jpg" class="img-fluid" alt="img">
																</a>
																<div class="ms-2">
																	<h6 class="fw-bold"><a href="javascript:void(0);">Dennis Anderson</a></h6>
																	<span class="fs-13 text-orange">#INV001</span>
																</div>
															</div>
														</td>
														<td>21 May 2025</td>
														<td><span class="badge badge-success badge-xs d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Paid</span></td>
														<td class="text-gray-9">$1000</td>
													</tr>
												</tbody>
											</table>
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
