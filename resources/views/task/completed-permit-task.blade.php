@php 
$pageName = "task"; 
$subpageName = "permit_task";
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
                         
                        <li class="breadcrumb-item active" aria-current="page">Completed Permit Task  </li>
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
                    <h3>Completed Permit Task </h3>
            </div> 
        </div>
        <div class="card-body">
             <ul class="nav nav-tabs nav-tabs-solid mb-3">
                <li class="nav-item"><a class="nav-link " href="{{route('pending-permit-task-assignment')}}" >Pending Permit Application </a></li>
                <li class="nav-item"><a class="nav-link active" href="{{route('completed-permit-task')}}"  >Completed Permit Jobs </a></li>
                <li class="nav-item"><a class="nav-link  " href="{{route('renewal-permit-app')}}"  >Renewal Permit Applications </a></li>
               
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                                    
                         <div class="table-responsive">
                            <table class="table " id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Applicant Name</th>
                                        <th>Company Name</th>
                                        <th>Telephone </th>
                                        <th>Plot No</th>
                                        <th>Location</th>
                                        <th>City</th>
                                        <th>Assignee</th>
                                        <th>Task Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach($tasks as $task)
                                    
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $task->permitapp->surname }} {{ $task->permitapp->firstname }}</td>
                                            <td>{{ $task->permitapp->companyName }}</td>
                                            <td>{{ $task->permitapp->tel }}</td>
                                            <td>{{ $task->permitapp->plotNo }}</td>
                                            <td>{{ $task->permitapp->location }}</td>
                                            <td>{{ $task->permitapp->city }}</td>
                                            <td>{{ $task->assignees->surname.' '.$task->assignees->firstname}}</td>
                                            
                                            <td>
                                                {{ $task->taskType }} 
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
 
@endsection

@section('scripts')
  
@endsection