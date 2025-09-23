@php 
$pageName = "Ins_manager"; 
$subpageName = "permit_ins";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Inspection Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Task Manager </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page"> Complted Permit Inspection  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
        @if (session('message'))
            <p class="alert alert-success"  >{{session('message')}}</p>
            @endif

            @if (session('message_error'))
            <p class="alert alert-danger" >{{session('message_error')}}</p>
            @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3> Complted  Permit Inspection  </h3>
            </div> 
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-solid mb-3">
                <li class="nav-item"><a class="nav-link  active" href="{{route('Permit-Inspection')}}" >List Permit Application </a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('completed-permit-inspection')}}"  >Completed Permit Inspection </a></li>
                
               
            </ul>
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                                    
                         <div class="table-responsive">
                            <table class="table " id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Applicant</th>
                                            <th>Company Name</th>
                                        <th>Telephone </th>
                                        <th>Plot/House No</th>
                                        <th>Location</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @if($list)
                                    @foreach($list as $dist)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $dist->surname.' '.$dist->firstname }}</td>
                                        <td>{{ $dist->companyName }}</td>
                                        <td>{{ $dist->tel }}</td>
                                        <td>{{ $dist->plotNo }}</td>
                                        <td>{{ $dist->location }}</td>
                                        <td>{{ $dist->city }}</td>
                                        <td> 
                                            @if($dist->req->count() > 0) 
                                            <a   class="btn btn-sm btn-danger" style="color: #fff"> Pending Approval</a>
                                            
                                            @else
                                            <a   data-bs-toggle="modal"  id="showmodal" data-bs-target="#basicModal" data-url="{{ route('get-certificate-id',$dist->id)  }}" class="btn btn-sm btn-info" style="color: #fff"> 
                                                Change Request</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
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
 @include('inspection_manager.change-permit-request-modal')
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#basicModal').modal('show');
    $('#certID').val(data.id);
   
    })
    });
    });
</script>
@endsection