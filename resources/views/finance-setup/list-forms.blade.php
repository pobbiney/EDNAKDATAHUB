@php 

$pageName = "finance_setup"; 

$subpageName = "list_forms";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Finance Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sell Application Forms</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       

       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Finance Management</h3>
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
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Form</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">
                                

                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">Sold Forms</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table  datanew ">
                                                        <thead>
                                                            <tr>
                                                                <th>Application Name</th>
                                                                <th>Telephone</th>
                                                                <th>Form Type</th>
                                                                <th>Amount</th>
                                                                <th>Sold On</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($formList as $formListitem)
                                                            <tr>
                                                                <td><b>{{$formListitem->applicantName}}</b></td>
                                                                <td>{{$formListitem->tell}}</td>
                                                                @if ($formListitem->formTypeDetails() != null)
                                                                <td>{{$formListitem->formTypeDetails()->formName}}</td>
                                                                @else
                                                                 <td>Not Avaliable</td>  
                                                                @endif
                                                                
                                                                <td style="color:green"><b>{{number_format($formListitem->amountPaid,2)}}</b></td>
                                                                <td>{{ $formListitem->createdOn }}</td>

                                                                @if ($formListitem->formTypeDetails() != null)

                                                                @if (number_format($formListitem->formTypeDetails()->amount,2) == number_format($formListitem->amountPaid,2))
                                                                <td><a target="_blank" style="color:white;" href="{{ route('finance-setup-sell-forms-print', Crypt::encrypt($formListitem->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-print"></i> print</a></td> 
                                                                @else
                                                                   <td></td> 
                                                                @endif
                                                                    
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                
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