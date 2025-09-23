@php 
$pageName = "inst"; 
$subpageName = "add_inst";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Institution Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Institution Setup</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page"> Setup</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
        @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green"><b>{{session('message_success')}}</b></p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>View Institution Details</h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								      
								   <div class="tab-content">
									   <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="slider-product-details">
                                                             
                                                                <div class="slider-product">
                                                                    <img src="{{asset($data->logo)}}" alt="img">
                                                                     
                                                                </div>
                                                                 
                                                            </div>
                                                         
                                                    </div>
                                            </div>
                                            </div>
                                     
                                        <div class="col-md-9">
                                           	<div class="productdetails">
                                                <ul class="product-bar">
                                                    <li>
                                                        <h4><b>Institution's Name</b></h4>
                                                        <h6>{{ $data->name }}	</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Short Name</b></h4>
                                                        <h6>{{ $data->short_name }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Location</b></h4>
                                                        <h6>{{ $data->location }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Email</b></h4>
                                                        <h6>{{ $data->email }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Telephone</b></h4>
                                                        <h6>{{ $data->telephone }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Category</b></h4>
                                                        <h6>{{ $data->catname->name }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Type</b></h4>
                                                        <h6>{{$data->typename->name}}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Contact Person</b></h4>
                                                        <h6>{{$data->contact_person_firstname.' '.$data->contact_person_lastname ?? 'N/A'}}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Email</b></h4>
                                                        <h6> {{$data->contact_person_email ?? 'N/A'}}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Designation</b></h4>
                                                        <h6>{{ $data->contact_person_designation ?? 'N/A' }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>Telephone</b></h4>
                                                        <h6>{{$data->contact_person_telephone ?? 'N/A' }}</h6>
                                                    </li>
                                                    <li>
                                                        <h4><b>About</b></h4>
                                                        <h6>{{ $data->about }}</h6>
                                                    </li>
                                                     
                                                </ul>
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
                </div>
                
            </div>
        </div>
    </div>
</div>
 
@endsection

@section('scripts')
 
@endsection