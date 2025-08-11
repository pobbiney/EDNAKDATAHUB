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
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Permit Application Form </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                                @if (session('message_success'))
                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                @endif
                    
                                @if (session('message_error'))
                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                @endif
                    <div class="row">
                                    
                        
                         <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav nav-pills d-flex justify-content-between">
                                            <li class="nav-item w-100 text-center" >
                                                <a href="#seller-details" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Application" style="background: #FE9F43;color:#FFFFFF">
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
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Infrastructure">
                                                        <i class="fas fa-home"></i>
                                                    </div>
                                                </a>
                                            </li>
                                             <li class="nav-item w-100 text-center">
                                                <a href="#bank-detail" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Declaration">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane active" id="seller-details">
                                                <div class="mb-4">
                                                    <h5>Enter Application  Details</h5>
                                                </div>
                                                <form enctype="multipart/form-data"  method="POST" action="{{route('customer.registration.edit-permit-registration-form-application-process',$id)}}">
                                                           @csrf
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Name of Proponent</label>
                                                                    <input type="text" name="proponent_name" class="form-control" placeholder="Enter Proponent's Name" value="{{   $data->proponent_name  }}"/>
                                                                     @error('proponent_name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                             <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Name of Contact Person</label>
                                                                    <input type="text" name="contact_person" class="form-control" placeholder="Enter Contact Person's Name" value="{{ $data->contact_person }}"/>
                                                                     @error('contact_person') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>City</label>
                                                                    <input type="text" name="city" class="form-control" placeholder="Enter  City" value="{{ $data->city }}"/>
                                                                     @error('city') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label>Address</label>
                                                                    <textarea class="form-control" name="address" >{{ $data->address }}</textarea>
                                                                    @error('address')<small style="color: red">{{$message}}</small>@enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Position</label>
                                                                    <input type="text" name="position" class="form-control" placeholder="Enter Position" value="{{ $data->position }}"/>
                                                                     @error('position') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                             <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label> Contact Number</label>
                                                                    <input type="number" name="contact_number" class="form-control" placeholder="Enter Contact Number" value="{{ $data->contact_number }}"/>
                                                                     @error('contact_number') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Email</label>
                                                                    <input type="email" name="email" class="form-control" placeholder="Enter Email " value="{{ $data->email }}"/>
                                                                     @error('email') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="text-end">
                                                             <button type="submit" class="btn btn-primary">Update & Continue</button>
                                                        </div>
                                                        <input type="hidden" name="application_id" value="{{ $data->id }}"/>

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