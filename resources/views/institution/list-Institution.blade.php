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
                <h4 class="fw-bold">Institution Manaer</h4>
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
                                                            <a style="color:white;" href="{{ route('edit-type', Crypt::encrypt($list->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a style="color:white;" href="{{ route('edit-type', Crypt::encrypt($list->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-upload"></i></a>
                                                            <a style="color:white;" href="{{ route('edit-type', Crypt::encrypt($list->id)) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
 
@endsection

@section('scripts')
 
@endsection