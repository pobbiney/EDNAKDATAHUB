@php 

$pageName = "bill-payments"; 

$subpageName = "finance";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Financial Details</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Serial Number: {{$form->formNumber}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">

                                <div>
                                    <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('assets/img/spinner-grey.gif') }}" > Please wait....</p>
                                    <div id="response" align="center"></div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-12 d-flex">
                                        <div class="card flex-fill bg-white">
                                            <div class="card-header">
                                                <h5 class="card-title">Note</h5>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>The bill above represents the total charge for the requested service. You are required to make FULL PAYMENT to be able to submit your request. Your request will only be processed for the next stage of the process after a successful payment of the total Bill Amount.</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <br>
                                <div class="row">
                                  
                                    <div class="col-lg-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title" style="text-align: center;">Project Information</h4>
                                            </div>
                                            <div class="card-body">
                                                 <div class="row nb-3">
                                                            <div class="col-lg-4">
                                                                <h5 class="mt-2">Applicant: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->proponent_name}}</label>
                                                            
                                                 </div>
                                                  <div class="row nb-3">
                                                            <div class="col-lg-4">
                                                                <h5 class="mt-2">Project Name: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->project_title}}</label>
                                                           
                                                 </div>
                                                  <div class="row nb-3">
                                                             <div class="col-lg-4">
                                                                <h5 class="mt-2">Address: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->address}}</label>
                                                         
                                                 </div>
                                                 <div class="row nb-3">
                                                             <div class="col-lg-4">
                                                                <h5 class="mt-2">Telephone: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->contact_number}}</label>
                                                           
                                                 </div>
                                                 <div class="row nb-3">
                                                            <div class="col-lg-4">
                                                                <h5 class="mt-2">Email: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->email}}</label>
                                                          
                                                 </div>
                                                 <div class="row nb-3">
                                                             <div class="col-lg-4">
                                                                <h5 class="mt-2">Position/Role: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->position}}</label>
                                                          
                                                 </div>
                                                 <div class="row nb-3">
                                                            <div class="col-lg-4">
                                                                <h5 class="mt-2">Town: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->town}}</label>
                                                            
                                                 </div>
                                                  <div class="row nb-3">
                                                             <div class="col-lg-4">
                                                                <h5 class="mt-2">District: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->getDistrict->name}} </label>
                                                           
                                                 </div>
                                                 <div class="row nb-3">
                                                             <div class="col-lg-4">
                                                                <h5 class="mt-2">Region: </h5>
                                                            </div>
                                                            <label class="col-lg-8 col-form-label">{{$permit_reg->getRegion->name}} </label>
                                                         
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title" style="text-align: right;">Outstanding Balance: <span style="color: blue">GH₵ {{number_format($totalBills - $totalPayments,2)}}</span></h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <h6 class="text-center">Bills & Payment</h6>
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Description</th>
                                                                <th>Payment(GH₵)</th>
                                                                <th>Bill(GH₵)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($bills_and_payment as $item)
                                                            <tr>
                                                              <td>{{ \Carbon\Carbon::parse($item->createdOn)->format('M d,Y') }}</td>
                                                                <td>{{$item->description}}</td>
                                                                <td><a href="{{route('payment-print-bill',Crypt::encrypt($item->item_id))}}" target="_blank" style="color: blue">{{ $item->payment !== null ? 'GH₵ ' . number_format($item->payment, 2) : '--' }}</a></td>
                                                                <td>{{ $item->bill !== null ? 'GH₵ ' . number_format($item->bill, 2) : '--' }}</td>
                                                              
                                                            </tr>
                                                            @endforeach
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="2">Total</th>
                                                                    <th><span style="color: green;">GH₵ {{ number_format($totalPayments, 2) }}</span></th>
                                                                    <th><span style="color: red;">GH₵ {{ number_format($totalBills, 2) }}</span></th>
                                                                    <th colspan="2"></th>
                                                                </tr>
                                                            </tfoot>
                                                           
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
                </div>
            </div>
        </div>
        
     
        
    </section>
    <!-- /Tabs -->
        
    
    </div
</div>

@endsection