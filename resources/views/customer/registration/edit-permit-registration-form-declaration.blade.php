@extends('customer.template.layout')


@section('title')
{{__('Edit Application')}}
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
                        <li class="breadcrumb-item"><a href="#"> Registration Form</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Edit Registration Form</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
         @if (session('message_success'))
                <div class="alert alert-success overflow-hidden p-0" role="alert">
                    <div class="p-3 bg-success text-fixed-white d-flex justify-content-between">
                        <h3 class="aletr-heading mb-0 text-fixed-white">Success Message.</h3>
                        <button type="button" class="btn-close p-0 text-fixed-white" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
                    </div>
                    <hr class="my-0">
                    <div class="p-3">
                        <h4 class="mb-0">{{session('message_success')}}</h4>
                    </div>
                </div><br>
                  @endif
        
                    @if (session('message_error'))
                    <div class="alert alert-danger overflow-hidden p-0" role="alert">
                    <div class="p-3 bg-danger text-fixed-white d-flex justify-content-between">
                        <h3 class="aletr-heading mb-0 text-fixed-white">Error Message.</h3>
                        <button type="button" class="btn-close p-0 text-fixed-white" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
                    </div>
                    <hr class="my-0">
                    <div class="p-3">
                        <h4 class="mb-0">{{session('message_error')}}</h4>
                    </div>
                </div>
                @endif 
    <div class="card">
         
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3" >
            <div class="search-set">
                    <h3>Permit Application Form </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                                
                    <div class="row">
                                    
                        
                         <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav nav-pills d-flex justify-content-between">
                                            <li class="nav-item w-100 text-center" >
                                                <a href="#seller-details" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Application" >
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item w-100 text-center">
                                                <a href="#company-document" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Project" >
                                                        <i class="fas fa-map-pin"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                             <li class="nav-item w-100 text-center">
                                                <a href="#bank-detail" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Infrastructure" >
                                                        <i class="fas fa-home"></i>
                                                    </div>
                                                </a>
                                            </li>
                                             <li class="nav-item w-100 text-center">
                                                <a href="#bank-detail" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Declaration" style="background: #FE9F43;color:#FFFFFF">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane active" id="seller-details">
                                                <div class="mb-4">
                                                    <h5>Enter Daclaration  Details</h5>
                                                </div>
                                                <form enctype="multipart/form-data"   method="POST" action="{{route('customer.registration.edit-permit-registration-form-declaration-process',$id)}}">
                                                           @csrf
                                                      
                                                        <p style="margin: 0; padding: 0;font-size:large">
                                                            <span style="font-size: x-large">I</span>, <input type="text" class="form-control" name="applied_by" style="display: inline-block; width: 400px; vertical-align: middle;" value="{{ $user->applied_by }}" /> @error('applied_by') <small style="color:red"> {{ $message}}</small> @enderror
                                                            hereby declare that the information provided on this form is true to the best of my knowledge and shall provide any additional information that shall come to my notice in the course of processing the application. I also declare that the information provided is true.
                                                            </p><br/>
                                                        <div class="text-end">
                                                            <a href="{{ route('customer.registration.edit-permit-registration-form-infrastructure',Crypt::encrypt($user->id)) }}" class="btn btn-soft-secondary" style="float: left">Previous</a>
                                                             <button type="submit" class="btn btn-success">Complete Application Update</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
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