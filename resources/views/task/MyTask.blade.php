@php 
$pageName = "task"; 
$subpageName = "mytask";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Task Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Task Manager </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">My Task </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
        @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green">{{session('message_success')}}</p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Task Assigned</h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                                    
                         <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Proponent Name</th>
                                        <th>Project Title</th>
                                        <th>Telephone </th>
                                        <th>Location</th>
                                        <th>Assignee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                  @endphp
                                  @if($tasks)
                                  @foreach($tasks as $list)
                                   <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $list->permitApp->proponent_name ?? 'N/A' }}</td>
                                    <td>{{ $list->permitApp->project_title ?? 'N/A' }}</td>
                                    <td>{{ $list->permitApp->contact_number ??  'N/A'}}</td>
                                    <td>{{ $list->permitApp->town }}</td>
                                    <td>  {{ $list->taskname->firstname.' '.$list->taskname->surname }}</td>
                                    <td>
                                       
                                    <a   href="{{ route('application-screening',Crypt::encrypt($list->id)) }}" target="_"    class="btn btn-success" style="color: white">  Screen</a>
                                    
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
 
@endsection

@section('scripts')
 
@endsection