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
                         
                        <li class="breadcrumb-item active" aria-current="page">Project Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Update Category </h3>
            </div> 
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-solid mb-3">
                <li class="nav-item"><a class="nav-link " href="{{route('Project-Sector')}}" >Sector </a></li>
                <li class="nav-item"><a class="nav-link active" href="{{route('Project-Category')}}"  >Category </a></li>
                 <li class="nav-item"><a class="nav-link" href="{{route('form-type')}}"  >Type </a></li>
               
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                     @if (session('message_success'))
                    <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                    @endif
        
                    @if (session('message_error'))
                    <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                    @endif
                    <form action="{{ route('edit-project-category-process',$id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label  >Name</label>
                                    
                                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                                        @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                     
                                </div>
                            
                            </div>
                               <div class="col-xl-4">
                                <div class="mb-3">
                                    <label  >Sector</label>
                                    <select class="form-control" name="sector">
                                        <option value="" selected disabled>--SELECT SECTOR--</option>
                                        @foreach ($sectorlist as $list )
                                        <option @if ($list->id==$data->sector_id) selected @endif value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                     @error('sector') <small style="color:red"> {{ $message}}</small> @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label  >Status</label>
                                    
                                        <select   name="status" class="form-select select2" data-allow-clear="true">
                                            <option value="{{$data->status}}">{{$data->status}}</option>
                                            <option value ="Active">Active</option>
                                            <option value ="Inactive">Inactive</option>
                                        </select>
                                        @error('status') <small style="color:red"> {{ $message}}</small> @enderror
                                     
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Description</div>
                                    <textarea class="form-control" name="description">{{$data->description}}</textarea>
                                </div>
                            </div>
                        </div><br/>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                     <div class="row" style="margin-top:20px">
                        <div class="col-xl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title">List Category</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Name </th>
                                                    <th>Sector</th>
                                                    <th>Status</th>
                                                     
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            
                                                     
                                                @php
                                                $i=1;
                                                @endphp
                                                @foreach ($listsector as $list)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{$list->name}}</td>
                                                     <td>{{$list->sectorname->name ?? 'N/A'}}</td>
                                                    <td>{{$list->status}}</td>
                                                    <td><a style="color:white;" href="{{ route('edit-category', Crypt::encrypt($list->id)) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
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