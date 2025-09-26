@php $pageName = "setup"; $subpageName = "add_setup"; @endphp

@extends('layouts.app')

 

@section('content')
  
   <div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Setup Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Setup Manager</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page"> Update   Service Provider</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
     @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green"><b>{{session('message_success')}}</b></p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3> Update   Service Provider </h3>
            </div> 
        </div>
         <!-- /product list -->
       
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form id="form" method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('edit-service-provider-process',$id)}}">
                 
                       @csrf
                        <div class="row">
                            
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Service Provider's Name" value="{{ $data->name }}">
                                    @error('name')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                             
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Logo</label>
                                    <input type="file" name="logo" class="form-control"  >
                                   
                                </div>
                                

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="{{ $data->status }}">{{ $data->status }}</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                     @error('status')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                            </div>
                         
                         
                     
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" style="float: left">Submit</button>
                        </div>
                    </form>
                </div>
                    <div class="col-md-6">
                       <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">List All Service Providers</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <thead class="table-light">
                                            <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            
                                            <th>Action</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i=1;
                                            @endphp
                                            @if($list)
                                            @foreach($list as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{$list->name}}</td>
                                                <td><span class="avatar flex-shrink-0">
													<img alt="Img" src="{{asset($list->logo)}}">
												</span></td>
                                            
                                                <td><a  href="{{route('edit-ServiceProvider',Crypt::encrypt($list->id))}}"  class="btn btn-sm btn-success" style="color: #fff"><i class="fe fe-edit"></i> 
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
@endsection



@section('scripts')
 
@endsection