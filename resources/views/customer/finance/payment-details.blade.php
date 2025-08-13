@extends('customer.template.layout')


@section('title')
{{__('Payment Details')}}
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
            <h3 class="section-title">Payment Details</h3>
            <div class="line"></div>
        </div>

         <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Serial Number :{{$data->formNumber}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">

                                <div>
                                    <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('assets/img/spinner-grey.gif') }}" > Please wait....</p>
                                    <div id="response" align="center"></div>
                                </div>
                                
                                <br>
                                <div class="row">
                                     <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title" style="text-align: center;">Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 40%; word-wrap: break-word; white-space: normal;"><span class="td-black"><b>Applicant Name</b></span></td>
                                                                <td style="width: 30%; word-wrap: break-word; white-space: normal;"><span class="td-black"><b>Telephone</b></span></td>
                                                                <td style="width: 30%; word-wrap: break-word; white-space: normal;"><span class="td-black"><b>Application Type</b></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 40%; word-wrap: break-word; white-space: normal;"><p class="black">{{$data->applicantName}}</p></td>
                                                                 <td style="width: 30%; word-wrap: break-word; white-space: normal;"><p class="black">{{$data->tell}}</p></td>
                                                                 <td style="width: 30%; word-wrap: break-word; white-space: normal;"><p class="black">{{$data->formtype->formName}}</p></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Description</th>
                                                                <th>Payment</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           @foreach($payments as $payment)
                                                            <tr>
                                                               <td style="width: 27%; word-wrap: break-word; white-space: normal;">{{ \Carbon\Carbon::parse($payment->createdOn)->format('M d, Y') }}</td>
                                                               <td style="width: 38%; word-wrap: break-word; white-space: normal;">{{$payment->getPaymentType()}}</td>
                                                                <td style="width: 20%; word-wrap: break-word; white-space: normal;">GH₵ {{number_format($payment->amount,2)}}</td>
                                                                <td style="width: 15%; word-wrap: break-word; white-space: normal;">
                                                                    <a target="_blank" href="{{route('download-receipt',Crypt::encrypt($payment->id))}}" data-id="" class="btn badges bg-lightgreen" style="color: white; ">
                                                                        <i class="fas fa-print"></i> 
                                                                         <span >View Receipt</span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @if($payments->count() > 0)
                                                            <tr>
                                                                <td colspan="2" style="text-align: right;"><strong>Total Payments</strong></td>
                                                                <td><strong>GH₵ {{ number_format(($payments->sum('amount')),2) }}</strong></td>
                                                                <td></td>
                                                               
                                                            </tr>
                                                            @else
                                                            <tr>
                                                                <td colspan="4" style="text-align: center;"><span style="color:red">No Payment Found</span></td>
                                                            @endif
                                                           
                                                            
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


@section('scripts')
 
@endsection