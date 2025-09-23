@php 

$pageName = "task"; 

$subpageName = "job_tracker";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Track Application</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                         <li class="breadcrumb-item active">Task Manager</li>
                        <li class="breadcrumb-item active">Job Tracker</li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Job Details</h3>
            <div class="line"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    
                    <div class="card-body">
                       
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">

                                @if (session('message_success'))
                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                @endif
                    
                                @if (session('message_error'))
                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                @endif
                                

                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="card bg-white">
                                            <div class="card-header" style="background: rgb(213, 111, 10)">
                                                <h5 class="card-title" style="color: white">Track Job </h5>
                                            </div>
                                            <div class="card-body">
                                                
                                                <div class="tab-content">
                                                    <div class="tab-pane show active" id="solid-tab1">
                                                        <div class="row">
                                                            <div class="col-xl-12 d-flex">
                                                                <div class="card flex-fill">
                                                                
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                Applicant: <b>{{ $datas->permit_registrations->contact_person ?? '' }}</b>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            Project Name: <b> {{ $datas->permit_registrations->proponent_name ?? '' }} </b>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                Telephone : <b>{{ $datas->permit_registrations->contact_number ?? '' }} </b>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="margin-top: 15px;">
                                                                            <div class="col-md-4">
                                                                                Address : <b>{{ $datas->permit_registrations->address ?? '' }}</b>
                                                                            </div>
                                                                             <div class="col-md-4">
                                                                                Email : <b>{{ $datas->permit_registrations->email ?? '' }}</b>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            Position : <b> {{ $datas->permit_registrations->position ?? '' }}</b>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            
                                                                            </div>
                                                                        </div>
                                                                        <br><br><br>
                                                                        <table class="table mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Date/Time</th>
                                                                                    <th>Activity Description</th>
                                                                                    <th>Performed By</th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody>
                                                                                @php
                                                                                    $i=1;
                                                                                @endphp
                                                                                @if($results)
                                                                                @foreach($results as $result)
                                                                                <tr>
                                                                                    <td>{{ $i}}</td>
                                                                                    <td>{{ $result->createdOn ?? '' }}</td>
                                                                                    <td> {{ $result->activityname->activity ?? '' }} </td>
                                                                                    <td>{{ ($result->staff->firstname ?? '') . ' ' . ($result->staff->surname ?? '') }} </td>

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
        
    </section>
    <!-- /Tabs -->
        
    
    </div
</div>


@endsection

