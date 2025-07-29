@php 
$pageName = "registration"; 
$subpageName = "my_application";
@endphp

@extends('layouts.app')


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
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Application" >
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item w-100 text-center">
                                                <a href="#company-document" class="nav-link py-2 bg-transparent" data-bs-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Project" style="background: #FE9F43;color:#FFFFFF">
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
                                                    <h5>Enter Project  Details</h5>
                                                </div>
                                                <form enctype="multipart/form-data"   method="POST" action="{{route('registration.edit-permit-registration-form-project-process',$id)}}">
                                                           @csrf
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Project Title</label>
                                                                    <input type="text" name="project_title" class="form-control" placeholder="Enter Project Title" value="{{   $datas->project_title }}"/>
                                                                     @error('project_title') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                             <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Plot/House No</label>
                                                                    <input type="text" name="plot_number" class="form-control" placeholder="Enter House/Plot No" value="{{   $datas->plot_number   }}"/>
                                                                     @error('plot_number') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label>Street Name</label>
                                                                    <input type="text" name="street_name" class="form-control" placeholder="Enter  Street Name" value="{{   $datas->street_name  }}"/>
                                                                     @error('street_name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label>Project Description</label>
                                                                    <textarea class="form-control" name="project_description" > {{  $datas->project_description   }}</textarea>
                                                                    @error('project_description')<small style="color: red">{{$message}}</small>@enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                          <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label>Scope of Project </label>
                                                                    <textarea class="form-control" name="scope" >{{   $datas->scope   }}</textarea>
                                                                    @error('scope')<small style="color: red">{{$message}}</small>@enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label>GPS Address</label>
                                                                    <input type="text" name="gps" class="form-control" placeholder="Enter GPS" value="{{  $datas->gps   }}"/>
                                                                     @error('gps') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                             <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label> Town</label>
                                                                    <input type="text" name="town" class="form-control" placeholder="Enter Town " value="{{   $datas->town  }}"/>
                                                                     @error('town') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label>Region</label>
                                                                     <select class="form-control changeregion" name="region">
                                                                        <option value=""  >--Choose Region--</option>
                                                                        @foreach($regionsList as $list)
                                                                        <option @if ($datas->region==$list->id) selected @endif value="{{ $list->id }}" >{{$list->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('region') <small style="color:red"> {{ $message}}</small> @enderror
                                                                   
                                                                </div>
                                                            </div>
                                                             <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label>District</label>
                                                                    <select   name="district" class="select2 form-control districtname" id="select2-placeholder-single">
                                                                         <option value=""  >--Choose District--</option>
                                                                        @foreach($data as $lists)
                                                                        <option @if ($datas->district==$lists->id) selected @endif value="{{ $lists->id }}"  >{{$lists->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('district') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                 <div class="mb-3">
                                                                    <label>Landmark</label>
                                                                    <input type="text" name="landmark" class="form-control" placeholder="Enter Landmark" value="{{   $datas->landmark   }}">
                                                                 </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                 <div class="mb-3">
                                                                    <label>Adjacent land  Uses (Existing)</label>
                                                                    <input type="text" name="land_uses" class="form-control" placeholder="Enter Land Uses" value="{{   $datas->land_uses   }}">
                                                                 </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                 <div class="mb-3">
                                                                    <label>Site Description</label>
                                                                    <textarea class="form-control" name="site_description">{{   $datas->site_description   }}</textarea>
                                                                     @error('site_description') <small style="color:red"> {{ $message}}</small> @enderror
                                                                 </div>
                                                            </div>

                                                        </div>
                                                         <div class="text-end">
                                                            <a href="{{ route('registration.edit-permit-registration-form-application',Crypt::encrypt($datas->id) ) }}" class="btn btn-soft-secondary" style="float: left">Previous</a>
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
 <script>
$(document).ready(function() {
    $(document).on('change', '.changeregion', function() {
        var cat_id = $(this).val();
        
        // ✅ 1. Validate input (prevent unnecessary AJAX calls)
        if (!cat_id || cat_id <= 0) {
            $(".districtname").html('<option value="0" selected disabled>--Choose Type--</option>');
            return;
        }

        // ✅ 2. Show loading state (better UX)
        var $typeSelect = $(".districtname");
        $typeSelect.prop('disabled', true).html('<option value="">Loading...</option>');

        $.ajax({
            type: 'GET',
            url: '{!! URL::to('findRegionData') !!}',
            data: { 'id': cat_id },
            dataType: 'json', // ✅ 3. Explicitly expect JSON
            success: function(data) {
                var op = '<option value="0" selected disabled>--Choose District--</option>';
                
                // ✅ 4. Check if data exists and is an array
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(function(type) {
                        op += `<option value="${type.id}">${type.name}</option>`;
                    });
                } else {
                    op = '<option value="0" selected disabled>No District available</option>';
                }
                
                $typeSelect.html(op).prop('disabled', false);
            },
            error: function(xhr, status, error) {
                // ✅ 5. Proper error handling
                console.error("AJAX Error:", error);
                $typeSelect.html('<option value="0" selected disabled>Error loading Districts</option>')
                           .prop('disabled', false);
            }
        });
    });
});
</script>
@endsection