@php 

$pageName = "bill-payments"; 

$subpageName = "finance";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Financial Details</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Serial Number: {{$form->formNumber}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">

                                <div>
                                    <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('assets/img/spinner-grey.gif') }}" > Please wait....</p>
                                    <div id="response" align="center"></div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-12 d-flex">
                                        <div class="card flex-fill bg-white">
                                            <div class="card-header">
                                                <h5 class="card-title">Note</h5>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>The bill above represents the total charge for the requested service. You are required to make FULL PAYMENT to be able to submit your request. Your request will only be processed for the next stage of the process after a successful payment of the total Bill Amount.</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <br>
                                <div class="row">
                                  
                                    <div class="col-lg-5">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title" style="text-align: center;">Project Description</h4>
                                            </div>
                                            <div class="card-body">
                                                 <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Applicant: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->proponent_name}}</h5>
                                                            </div>
                                                 </div>
                                                  <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Project Name: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->project_title}}</h5>
                                                            </div>
                                                 </div>
                                                  <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Address: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->address}}</h5>
                                                            </div>
                                                 </div>
                                                 <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Telephone: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->contact_number}}</h5>
                                                            </div>
                                                 </div>
                                                 <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Email: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->email}}</h5>
                                                            </div>
                                                 </div>
                                                 <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Position/Role: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->position}}</h5>
                                                            </div>
                                                 </div>
                                                 <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Town: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->town}}</h5>
                                                            </div>
                                                 </div>
                                                  <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">District: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->district}}</h5>
                                                            </div>
                                                 </div>
                                                 <div class="row nb-3">
                                                            <label class="col-lg-4 col-form-label">Region: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$permit_reg->region}}</h5>
                                                            </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Description</th>
                                                                <th>Credit(GH₵)</th>
                                                                <th>Debit(GH₵)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
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