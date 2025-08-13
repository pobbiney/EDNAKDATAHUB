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
                         
                        <li class="breadcrumb-item active" aria-current="page">New Registration Form</li>
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
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Infrastructure" style="background: #FE9F43;color:#FFFFFF">
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
                                                    <h5>Enter Project  Details</h5>
                                                </div>
                                                <form enctype="multipart/form-data"   method="POST" action="{{route('customer.registration.edit-permit-registration-form-infrastructure-process',$id)}}">
                                                           @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Structures on the site  </label>
                                                                    <input type="text" name="structures" class="form-control" placeholder="Structures on the site Structures on the site"  value="{{   $user->structures  }}"/>
                                                                     @error('structures') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Access to water (source, quantity) </label>
                                                                    <input type="text" name="water" class="form-control" placeholder="Access to water (source, quantity)"  value="{{ $user->water  }}"/>
                                                                     @error('water') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Access to power (type, source, quantity) </label>
                                                                    <input type="text" name="power" class="form-control" placeholder="Access to power (type, source, quantity)"  value="{{   $user->power  }}"/>
                                                                     @error('power') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Drainage provision in the project area  </label>
                                                                    <input type="text" name="drainage" class="form-control" placeholder="Drainage provision in the project area "  value="{{  $user->drainage  }}"/>
                                                                     @error('drainage') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Nearness to water body</label>
                                                                    <input type="text" name="water_body" class="form-control" placeholder="Nearness to water body"  value="{{   $user->water_body   }}"/>
                                                                     @error('water_body') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Access to road to project site   </label>
                                                                    <input type="text" name="road_access" class="form-control" placeholder="Access to road to project site  "  value="{{   $user->road_access   }}"/>
                                                                     @error('road_access') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                             <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label>Other major utilities proposed or existing on site   </label>
                                                                    <input type="text" name="other" class="form-control" placeholder="Other major utilities proposed or existing on site   "  value="{{  $user->other   }}"/>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        
                                                        <div class="text-end">
                                                            <a href="{{ route('customer.registration.edit-permit-registration-form-project',Crypt::encrypt($user->id) ) }}" class="btn btn-soft-secondary" style="float: left">Previous</a>
                                                             <button type="submit" class="btn btn-primary">Update & Continue</button>
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