@php 
$pageName = "finance_setup"; 
$subpageName = "application_forms";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Financial Setup</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Financial Setup</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Application Forms</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Add Form Type</h3>
            </div> 
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-solid mb-3">
                <li class="nav-item"><a class="nav-link " href="{{route('finance-setup-application-forms')}}" >Application Form</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{route('form-type')}}"  >From Type</a></li>
               
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                     @if (session('message_success'))
                    <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                    @endif
        
                    @if (session('message_error'))
                    <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                    @endif
                    <form action="{{ route('finance-setup-application-forms-type-process') }}" method="POST">
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

                      

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                     <div class="row" style="margin-top:20px">
                        <div class="col-xl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title">List Forms</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Application Form Type</th>
                                                    <th>Status</th>
                                                     
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 
                                               
                                                @php
                                                $i=1;
                                                @endphp
                                                @foreach ($listtype as $list)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{$list->name}}</td>
                                                    <td>{{$list->status}}</td>
                                                    <td><a style="color:white;" href="{{ route('edit-form-type', Crypt::encrypt($list->id)) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
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