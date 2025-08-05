@php 

$pageName = "reports"; 

$subpageName = "reports-national";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Report Manager</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Forms</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       

       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Report Manager</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5 class="card-title">List Sold Forms</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">List</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">
                                

                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">Report Manager</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table  datanew ">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Application Name</th>
                                                                <th>Telephone</th>
                                                                <th>Form Type</th>
                                                                <th>Amount</th>
                                                                <th>Sold On</th>
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($formList as $formListitem)
                                                            <tr>
                                                                <td>{{ $loop->index +1 }}</td>
                                                                <td><b>{{$formListitem->applicantName}}</b></td>
                                                                <td>{{$formListitem->tell}}</td>
                                                                @if ($formListitem->formTypeDetails() != null)
                                                                <td>{{$formListitem->formTypeDetails()->formName}}</td>
                                                                @else
                                                                 <td>Not Avaliable</td>  
                                                                @endif
                                                                
                                                                <td style="color:green"><b>{{number_format($formListitem->amountPaid,2)}}</b></td>
                                                                <td>{{ $formListitem->createdOn }}</td>

                                                              
                                                                
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
        
    </section>
    <!-- /Tabs -->
        
    
    </div
</div>
@endsection

@section('scripts')
    
@endsection