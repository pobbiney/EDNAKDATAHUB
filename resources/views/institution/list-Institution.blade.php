@php 
$pageName = "inst"; 
$subpageName = "inst-list";
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
                    <h3>List Institutions</h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								      
								   <div class="tab-content">
									   <div class="tab-pane show active text-muted" id="fill-pill-home" role="tabpanel">
                                           <div class="table-responsive">
                                                <table class="table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Short Name</th>
                                                        <th>Location</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @php
                                                        $i=1;
                                                        @endphp
                                                        @foreach ($list as $list)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$list->name}}</td>
                                                        <td>{{$list->short_name}}</td>
                                                        <td>{{$list->location}}</td>
                                                        <td>{{$list->email}}</td>
                                                        <td>{{$list->telephone}}</td>
                                                        <td>
                                                            <a style="color:white;" href="{{route('edit-institution', Crypt::encrypt($list->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a data-bs-toggle="modal" id="showmodal" data-bs-target="#basicModal" data-url="{{ route('institution-upload-image',$list->id)  }}" type="button"  class="btn btn-sm  btn-info" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="tooltip-info" title="Upload Logo"  ><i class="tf-icons ti ti-camera" style="color: white"></i></a> 
                                                            <a data-bs-toggle="modal" id="showmodal2" data-bs-target="#basicModal2" data-url="{{ route('institution-upload-image',$list->id)  }}" type="button"  class="btn btn-sm  btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="tooltip-warning" title="Add Contact Person"  ><i class="tf-icons ti ti-users" style="color: white"></i></a> 
                                                            <a style="color:white;" href="{{ route('view-institution-details', Crypt::encrypt($list->id)) }}" target="_" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
                </div>
                
            </div>
        </div>
    </div>
</div>

@include('institution.upload-institution-logo');
@include('institution.add-contact-person-modal');
 
@endsection

@section('scripts')
 <script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#basicModal').modal('show');
    $('#InstID').val(data.id);
    $('#inst_name').text(data.name);
    $('#inst_loc').text(data.location);
    $('#inst_email').text(data.email);
    $('#inst_tel').text(data.telephone);
    
    
    })
    });
    });
</script>
<script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal2', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#basicModal2').modal('show');
    $('#InstID2').val(data.id);
    $('#inst_name2').text(data.name);
    $('#inst_loc2').text(data.location);
    $('#inst_email2').text(data.email);
    $('#inst_tel2').text(data.telephone);
    
    
    })
    });
    });
</script> 
@endsection