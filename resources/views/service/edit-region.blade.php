@php 
$pageName = "loc"; 
$subpageName = "locs";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Service Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Service Manager </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Update Region </li>
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
                    <h3>Update Region </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								   <ul class="nav nav-pills nav-fill mb-3" role="tablist">
									   <li class="nav-item">
										   <a class="nav-link active"   aria-current="page"
										   href="{{ route('Region')}}" aria-selected="true">Add Region</a>
									   </li>
									   <li class="nav-item">
										   <a class="nav-link"   aria-current="page"
										   href="{{ route('District')}}" aria-selected="false">Add District</a>
									   </li>
									   <li class="nav-item">
										   <a class="nav-link"  aria-current="page"
										   href="{{ route('Station')}}" aria-selected="false">Add office</a>
									   </li>
									   
								   </ul>
								   <div class="tab-content">
									   <div class="tab-pane show active text-muted" id="fill-pill-home" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title">Add New Region</h5>
                                                        </div>
                                                        <div class="card-body">
                                                           <form enctype="multipart/form-data" action="{{ route('edit-region-process',$id) }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label class="form-label">Name</label>
                                                                        <input type="text" class="form-control" name="name" placeholder="Enter Region Name" value="{{ $datas->name }}">
                                                                        @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">Description</label>
                                                                        <textarea type="text" class="form-control" name="description" >{{ $datas->description }} </textarea>
                                                                        @error('description') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">Code</label>
                                                                    <input type="text" name="code" class="form-control" placeholder="Enter Region Code" value="{{ $datas->code }}">
                                                                    @error('code') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    

                                                                </div>
                                                                <div class="text-end">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title">List All Regions</h5>
                                                        </div>
                                                        <div class="card-body">
                                                             <div class="table-responsive">
                                                                  <table class="table" id="myTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Name</th>
                                                                            <th>Code</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    
                                                                        @php
                                                                        $i=1;
                                                                    @endphp
                                                                    @if($list)
                                                                    @foreach($list as $lists)
                                                                        <tr>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $lists->name }}</td>
                                                                            <td>{{ $lists->code }}</td>
                                                                            <td> <a href="{{route('edit-region',Crypt::encrypt($lists->id))}}" class="btn btn-sm btn-success" style="color: #fff"><i class="fe fe-edit"></i> 
                                                                                Edit
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