@php 
$pageName = "main-setup"; 
$subpageName = "phase";
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
                         
                        <li class="breadcrumb-item active" aria-current="page">Phase</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Add Phase </h3>
            </div> 
        </div>
        <div class="card-body">
            
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                     @if (session('message_success'))
                    <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                    @endif
        
                    @if (session('message_error'))
                    <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                    @endif
                    <form action="{{ route('add-phase-process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  >Name</label>
                                    
                                        <input type="text" class="form-control" name="name">
                                        @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                     
                                </div>
                            
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  >Status</label>
                                    
                                        <select   name="status" class="form-select select2" data-allow-clear="true">
                                            <option value="">-- SELECT --</option>
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
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div><br/>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                     <div class="row" style="margin-top:20px">
                        <div class="col-xl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title">List Phase</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                     
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            
                                                     
                                                @php
                                                $i=1;
                                                @endphp
                                                @foreach ($listphase as $list)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{$list->name}}</td>
                                                    <td>{{$list->status}}</td>
                                                    <td><a style="color:white;" href="{{ route('edit-phase', Crypt::encrypt($list->id)) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
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