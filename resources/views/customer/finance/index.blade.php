@extends('customer.template.layout')


@section('title')
{{__('Finance')}}
@endsection

@section('css')
<style>
    .nav-link.active {
    background-color: #3EB780 !important;
    color: #fff !important;
    border: 1px solid #3EB780 !important;
}
</style>
@endsection

@section('content')
<div class="content">
    <div class="content container-fluid">
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Finance</h3>
            <div class="line"></div>
        </div>

            

        	<div class="row">
                                    <div class="col-md-12">
										<div class="card bg-white">
											
											<div class="card-body">
												<ul class="nav nav-tabs nav-tabs-solid nav-justified">
													<li class="nav-item"><a class="nav-link active" href="#solid-justified-tab1" data-bs-toggle="tab">BILLS</a></li>
													<li class="nav-item"><a class="nav-link" href="#solid-justified-tab2" data-bs-toggle="tab">PAYMENTS</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane show active" id="solid-justified-tab1">
														<div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table datanew">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Applicant Name</th>
                                                                            <th>Telephone</th>
                                                                            <th>Application Type</th>
                                                                            <th>Total Bill</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($sales as $sale)
                                                                        <tr style="font-size: medium;">
                                                                            <td class="text-dark">{{ $loop->iteration }}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$sale->applicantName}}</td>
                                                                                <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$sale->tell}}</td>
                                                                            <td class="text-dark"  style="word-wrap: break-word; white-space: normal;">{{ $sale->formtype->formName }}</td>
                                                                            <td class="text-dark">GH₵ 
                                                                                 {{ number_format($sale->appBills?->sum('bill_amount')?? 0, 2) }}
                                                                            </td>
                                                                            <td><a href="{{route('customer-bill-details',Crypt::encrypt($sale->id))}}" data-id="" class="btn btn-warning btn-sm"><i class="fas fa-credit-card"></i> View Bills</a></td>
                                                                         
                                                                        </tr>
                                                                        @endforeach
                                                                        
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
													</div>
													<div class="tab-pane" id="solid-justified-tab2">
															<div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table datanew">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Applicant Name</th>
                                                                            <th>Telephone</th>
                                                                            <th>Application Type</th>
                                                                            <th>Total Payment</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($sales as $sale)
                                                                        <tr>
                                                                            <td class="text-dark">{{ $loop->iteration }}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$sale->applicantName}}</td>
                                                                                <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$sale->tell}}</td>
                                                                            <td class="text-dark"  style="word-wrap: break-word; white-space: normal;">{{ $sale->formtype->formName }}</td>
                                                                            <td class="text-dark">GH₵ 
                                                                                 {{ number_format($sale->payments?->sum('amount')?? 0, 2) }}
                                                                            </td>
                                                                            <td ><a href="{{route('customer-payment-details',Crypt::encrypt($sale->id))}}" data-id="" class="btn btn-info btn-sm"><i class="fas fa-credit-card"></i> View Payments</a>
                                                                         
                                                                            </td>
                                                        
                                                                        </tr>
                                                                        @endforeach
                                                                        
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
	
									
								</div>
        
    </section>
    <!-- /Tabs -->
        
    
    </div
</div>

@endsection


@section('scripts')
 
@endsection