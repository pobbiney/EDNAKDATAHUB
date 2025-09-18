@extends('customer.template.layout')


@section('title')
{{__('Applications')}}
@endsection

@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Registration Form</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Application </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">List Forms</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>List Forms</h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                                    
                         <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Applicant Name</th>
                                                    <th>Telephone</th>
													<th>Form Type</th>
													<th>Amount</th>
													<th>Bought On</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @php
                                                $i=1;
                                                @endphp
                                                @foreach($sales as $item)
													<tr>
                                                         <td>{{$i}}</td>
														<td>{{$item->applicantName}}</td>
														<td>{{$item->tell}}</td>
														<td>{{$item->formtype->formName}}</td>
														<td>GH₵ {{number_format($item->amountPaid,2)}}</td>
														 <td>{{ \Carbon\Carbon::parse($item->createdOn)->format('M d,Y') }}</td>
														 <td>
															<a href="{{route('customer-registration-open-permit-forms',Crypt::encrypt($item->id))}}" class="btn btn-success" style="color: white">Fill Form</a>
														</td>
													</tr>
													  @php
                                                $i++;
                                                @endphp
                                               
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

@endsection


@section('scripts')
 
@endsection