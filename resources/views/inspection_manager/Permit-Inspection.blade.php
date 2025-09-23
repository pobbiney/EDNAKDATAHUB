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
                         
                        <li class="breadcrumb-item active" aria-current="page">  Permit Inspection  </li>
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
                    <h3>   Permit Application Inspection</h3>
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
                                        <td> <a  href="{{route('view-inspection-permit-details',Crypt::encrypt($dist->id))}}" target="_"  class="btn btn-sm btn-success" style="color: #fff"> 
                                            Process
                                        </a></td>
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
 
@endsection

@section('scripts')
  
@endsection