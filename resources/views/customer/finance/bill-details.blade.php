@extends('customer.template.layout')


@section('title')
{{__('Bill Details')}}
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
            <h3 class="section-title">Bill Details</h3>
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
                                                                <td style="width: 20%; word-wrap: break-word; white-space: normal;"><span class="td-black"><b>Telephone</b></span></td>
                                                                <td style="width: 40%; word-wrap: break-word; white-space: normal;"><span class="td-black"><b>Application Type</b></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 40%; word-wrap: break-word; white-space: normal;"><p class="black">{{$data->applicantName}}</p></td>
                                                                 <td style="width: 20%; word-wrap: break-word; white-space: normal;"><p class="black">{{$data->tell}}</p></td>
                                                                 <td style="width: 40%; word-wrap: break-word; white-space: normal;"><p class="black">{{$data->formtype->formName}}</p></td>
                                                            </tr>
                                                             {{-- <tr>
                                                                <td style="width: 40%; word-wrap: break-word; white-space: normal;"><span class="td-black">Applicant Name: </span><p class="black">{{$data->applicantName}}</p></td>
                                                                 <td style="width: 30%; word-wrap: break-word; white-space: normal;"><span class="td-black">Telephone: </span><p class="black">{{$data->tell}}</p></td>
                                                                 <td style="width: 30%; word-wrap: break-word; white-space: normal;"><span class="td-black">Application Type: </span><p class="black">{{$data->formtype->formName}}</p></td>
                                                            </tr> --}}
                                                           
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
                                                                <th>Bill</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($bills as $bill)
                                                            <tr>
                                                               <td style="width: 30%; word-wrap: break-word; white-space: normal;">{{ \Carbon\Carbon::parse($bill->createdOn)->format('M d, Y') }}</td>
                                                               <td  style="width: 40%; word-wrap: break-word; white-space: normal;">{{$bill->getBillDescription()}}</td>
                                                                <td  style="width: 30%; word-wrap: break-word; white-space: normal;">GH₵ {{number_format($bill->bill_amount,2)}}</td>
                                                            </tr>
                                                            @endforeach
                                                            @if(($bills->count() >0))
                                                            <tr>
                                                                <td colspan="2" style="text-align: right;"><strong>Total Bills</strong></td>
                                                                <td><strong>GH₵ {{ number_format(($bills->sum('bill_amount')),2) }}</strong></td>
                                                            </tr>
                                                            @else
                                                            <tr>
                                                                <td colspan="3" style="text-align: center;"><span style="color: red">No Bill Found</span></td>
                                                            </tr>
                                                            @endif
                                                        </tbody>  
                                                    </table>
                                                    @if(($bills->sum('bill_amount') >0))
                                                    {{-- <form action="" method="post">
                                                            <button type="submit" class="btn btn-rounded btn-primary float-end mt-2">Make Payment</button>
                                                            <p>{{ number_format(($bills->sum('bill_amount')),2) }}</p>
                                                    </form> --}}
                                                    @endif
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