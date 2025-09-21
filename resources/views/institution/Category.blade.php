@php 
$pageName = "inst"; 
$subpageName = "inst_cat";
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
                    <h3>Add Category </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								     <ul class="nav nav-tabs tab-style-1 d-sm-flex d-block" role="tablist">
									   <li class="nav-item">
										   <a class="nav-link active"  
											   aria-current="page" href="{{ route('Category') }}">Add Category</a>
									   </li>
									   <li class="nav-item">
										   <a class="nav-link" 
											   href="{{ route('type') }}">Add Type</a>
									   </li>
									   
								   </ul>
								   <div class="tab-content">
									   <div class="tab-pane show active text-muted" id="fill-pill-home" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title">Add Category</h5>
                                                        </div>
                                                        <div class="card-body">
                                                             <form action="{{ route('add-institution-category-process') }}" method="POST">
                                                                @csrf
                                                                 <div class="mb-3">
                                                                    <label class="col-lg-3 col-form-label">Name</label>
                                                                     
                                                                        <input type="text" class="form-control" name="name"  >
                                                                        @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                     
                                                                </div>
                                                                 
                                                                <div class="mb-3">
                                                                    <label class="col-lg-3 col-form-label">Description</label>
                                                                   
                                                                        <textarea type="text" class="form-control" name="description" > </textarea>
                                                                        @error('description') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    
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
                                                            <h5 class="card-title">List All Categories</h5>
                                                        </div>
                                                        <div class="card-body">
                                                             <div class="table-responsive">
                                                                  <table class="table" id="myTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Status</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($listcat as $listcat)
                                                                        <tr>
                                                                            <td>{{$listcat->name}}</td>
                                                                            <td>{{$listcat->status}}</td>
                                                                            <td><a style="color:white;" href="{{ route('edit-category', Crypt::encrypt($listcat->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
                                                                        </tr>
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
                
            </div>
        </div>
    </div>
</div>
 
@endsection

@section('scripts')
 
@endsection