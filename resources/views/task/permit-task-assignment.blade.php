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
                         
                        <li class="breadcrumb-item active" aria-current="page">Permit Task Assignment </li>
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
                    <h3>Permit Task Assignment</h3>
            </div> 
        </div>
        <div class="card-body">
             
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
                                        <th>Location</th>
                                        <th>Assignee</th>
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
                                    <td>{{ $list->firstname.' '.$list->surname }}</td>
                                    <td>{{ $list->companyName }}</td>
                                    <td>{{ $list->tel }}</td>
                                    <td>{{ $list->location }}</td>
                                    <td> @foreach($list->tasks as $lists)
                                        <p>{{ $lists->taskname->firstname.' '.$lists->taskname->surname}}</p>
                                        
                                        
                                        @endforeach </td>
                                    <td>
                                        @if($list->tasks->count() > 0)
                                        <a data-bs-toggle="modal"  id="showedit" data-target="#myModal" data-url="{{ route('get-task-id',$lists->id)  }}" class="btn btn-sm btn-success" style="color: white"><i class="fa fa-undo"></i> Reassign Task</a>
                                        @else
                                        
                                    <a data-bs-toggle="modal"  id="showmodal" data-bs-target="#basicModal" data-url="{{ route('get-permit-id',$list->id)  }}"    class="btn btn-sm btn-info" style="color: white"><i class="fa fa-share-square"></i> Assign Task</a>
                                    @endif
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
 @include('task.reassign-permit-job-modal');
@include('task.assign-permit-job-modal'); 
@endsection

@section('scripts')
 <script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#basicModal').modal('show');
    $('#certID').val(data.id);
    $('#regID').val(data.region);
    })
    });
    });
</script>
<script>
    $(document).ready(function(){
    $('body').on('click', '#showedit', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#myModal').modal('show');
    $('#taskID').val(data.id);
    $('#appID').val(data.taskId);
    $('#assignee').val(data.assignee);
    $('#description').val(data.description);
    $('#regionId').val(data.region_id);
    })
    });
    });
</script>
@endsection