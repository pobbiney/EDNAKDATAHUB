@php 
$pageName = "main-setup"; 
$subpageName = "sector";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Main Setup</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Main Setup</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Project Type</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Update Type </h3>
            </div> 
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-solid mb-3">
                <li class="nav-item"><a class="nav-link " href="{{route('Project-Sector')}}" >Sector </a></li>
                <li class="nav-item"><a class="nav-link " href="{{route('Project-Category')}}"  >Category </a></li>
                <li class="nav-item"><a class="nav-link active" href="{{route('Project-Type')}}"  >Type </a></li>
               
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                     @if (session('message_success'))
                    <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                    @endif
        
                    @if (session('message_error'))
                    <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                    @endif
                    <form enctype="multipart/form-data" action="{{ route('edit-project-type-process', $id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  >Name</label>
                                    
                                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                                        @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                     
                                </div>
                            
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  >Status</label>
                                    
                                        <select   name="status" class="form-select select2" data-allow-clear="true">
                                            <option  value="{{$data->status}}">{{$data->status}}</option>
                                            <option value ="Active">Active</option>
                                            <option value ="Inactive">Inactive</option>
                                        </select>
                                        @error('status') <small style="color:red"> {{ $message}}</small> @enderror
                                     
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label>Description</div>
                                    <textarea class="form-control" name="description">{{$data->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  >Category</label>
                                    
                                       <select class="form-control" name="category">
                                        <option value="" selected disabled>--SELECT CATEGORY--</option>
                                        @foreach($cat as $cat)
                                        <option @if($cat->id==$data->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach

                                       </select>
                                        @error('category') <small style="color:red"> {{ $message}}</small> @enderror
                                     
                                </div>
                            
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  >Status</label>
                                    
                                        <select class="form-control" name="sector">
                                        <option value="" selected disabled>--SELECT CATEGORY--</option>
                                        @foreach($sec as $sec)
                                        <option @if($sec->id==$data->sector_id) selected @endif value="{{$sec->id}}">{{$sec->name}}</option>
                                        @endforeach

                                       </select>
                                        @error('sector') <small style="color:red"> {{ $message}}</small> @enderror
                                       
                                     
                                </div>
                                
                            </div>
                        </div>
                        
                        <br/>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                     <div class="row" style="margin-top:20px">
                        <div class="col-xl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title">List Type</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type Name </th>
                                                    <th>Category</th>
                                                    <th>Sector</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @php
                                                $i=1;
                                                @endphp
                                                @foreach ($typelist as $list)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$list->name}}</td>
                                                    <td>{{$list->catname->name}}</td>
                                                    <td>{{$list->secname->name}}</td>
                                                    <td>{{$list->status}}</td>
                                                    <td><a style="color:white;" href="{{ route('edit-type', Crypt::encrypt($list->id)) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
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

@endsection

@section('scripts')
 
@endsection