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
                         
                        <li class="breadcrumb-item active" aria-current="page">List Registrations</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>List Applications</h3>
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
                                                    <th>Proponent Name</th>
                                                    <th>City</th>
                                                    <th>Address</th>
                                                    <th>Contact</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @php
                                                $i=1;
                                                @endphp
                                                @foreach ($listApp as $list)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$list->appname->applicantName ?? ''}}</td>
                                                    <td>{{$list->proponent_name ?? ''}}</td>
                                                    <td>{{$list->city ?? ''}}</td>
                                                    <td>{{$list->address ?? ''}}</td>
                                                    <td>{{$list->contact_number ?? ''}}</td>
                                                   
                                                        @if ($list->registration_step =='completed')
                                                        <td>
                                                             <span class="badge badge-success d-flex align-items-center badge-xs"> Completed</span>
                                                        </td>
                                                        <td> <a href="{{ route('customer.view-application', Crypt::encrypt($list->formID)) }}" target="_" class="btn btn-info"><i class="fe fe-eye"></i> View</a></td>
                                                        
                                                        
                                                         @else  
                                                         <td>
                                                            <span class="badge badge-danger d-flex align-items-center badge-xs">Inomplete</span>
                                                        </td>
                                                         <td> <a href="{{ route('customer.registration.edit-permit-registration-form-application', Crypt::encrypt($list->id)) }}" target="_" class="btn btn-info"><i class="fe fe-edit"></i> Edit</a>  </td>
                                                        
                                                     </td>
                                                        
                                                        @endif

                                                    
                                                     
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