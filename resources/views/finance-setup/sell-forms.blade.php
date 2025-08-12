@php 
$pageName = "finance_setup"; 
$subpageName = "sell_forms";
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
                         
                        <li class="breadcrumb-item active" aria-current="page">Sell Forms</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Sell Form </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                    <div class="row">
                                    
                                         
                                                @if (session('message_success'))
                                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                                @endif
                                    
                                                @if (session('message_error'))
                                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                                @endif
                                                <form action="{{ route('finance-setup-sell-forms-process') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                           <div class="mb-3">
                                                                <label >Applicant</label>
                                                                
                                                                    <input type="text" class="form-control" name="applicant_name" placeholder="Applicant Name" value="{{auth()->user()->name ?? ''}}" readonly>
                                                                    @error('applicant_name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="col-xl-4">
                                                           <div class="mb-3">
                                                                <label  >Telephone</label>
                                                                 
                                                                    <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
                                                                    @error('telephone') <small style="color:red"> {{ $message}}</small> @enderror
                                                              
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="col-xl-4">
                                                             <div class="mb-3">
                                                                <label >Location</label>
                                                                
                                                                    <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                                                                    @error('location') <small style="color:red"> {{ $message}}</small> @enderror
                                                                 
                                                            </div>
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-3">
                                                            <div class="mb-3">
                                                                <label  >Form Type</label>
                                                                
                                                                    <select id="form_type" name="form_type" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>
                                                                      @foreach ($listForm as $listFormItem)
                                                                          <option value="{{ $listFormItem->id }}" @if (old('form_type') ==$listFormItem->id ) selected @endif>{{ $listFormItem->formName }} -- {{ $listFormItem->formType }}</option>
                                                                      @endforeach
                                                                    </select>
                                                                    @error('form_type') <small style="color:red"> {{ $message}}</small> @enderror
                                                                
                                                            </div>
                                                          
                                                        </div>
                                                         <div class="col-xl-3">
                                                            <div class="mb-3">
                                                                <label  >Permit Type</label>
                                                                
                                                                    <select id="permit_type" name="permit_type" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>
                                                                      @foreach ($listtype as $list)
                                                                          <option value="{{ $list->id }}" @if (old('permit_type') ==$list->id ) selected @endif>{{ $list->name }} </option>
                                                                      @endforeach
                                                                    </select>
                                                                    @error('permit_type') <small style="color:red"> {{ $message}}</small> @enderror
                                                                
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="col-xl-6">
                                                             <div class="mb-3">
                                                                <label >Region</label>
                                                               
                                                                    <select id="region" name="region" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>
                                                                        @foreach ($regionList as $regionListItem)
                                                                            <option value="{{ $regionListItem->id }}"  @if (old('region') ==$regionListItem->id ) selected @endif>{{ $regionListItem->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('region') <small style="color:red"> {{ $message}}</small> @enderror
                                                                
                                                            </div>
                                                          
                                                        </div>
                                                        
                                                    </div>
                                                   
                        
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Sell</button>
                                                    </div>
                                                </form>
                                            
                                </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
 <script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
 </script>
@endsection