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
                    <h3>Add Application Form </h3>
            </div> 
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-solid mb-3">
                <li class="nav-item"><a class="nav-link active" href="{{route('finance-setup-application-forms')}}" >Application Form</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('form-type')}}"  >From Type</a></li>
               
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                     @if (session('message_success'))
                    <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                    @endif
        
                    @if (session('message_error'))
                    <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                    @endif
                    <form enctype="multipart/form-data" action="{{ route('finance-setup-application-forms-process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="col-lg-3 col-form-label">Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="form_name">
                                        @error('form_name') <small style="color:red"> {{ $message}}</small> @enderror
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="col-lg-3 col-form-label">Currency</label>
                                    <div class="col-lg-9">
                                        <select id="currency" name="currency" class="form-select select2" data-allow-clear="true">
                                            <option value="">-- SELECT --</option>

                                            @foreach ($currencyList as $currencyListItem)
                                                <option value="{{ $currencyListItem->name }}" @if (old('status') == $currencyListItem->name) selected @endif>{{ $currencyListItem->name }}</option> 
                                            @endforeach
                                            
                                            
                                        </select>
                                        @error('currency') <small style="color:red"> {{ $message}}</small> @enderror
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="col-lg-3 col-form-label">Bill Type</label>
                                    <div class="col-lg-9">
                                        <select id="form_type" name="form_type" class="form-control" data-allow-clear="true">
                                            <option value="">-- SELECT --</option>
                                            <option value="New">New</option>
                                            <option value="Renew">Renew</option>
                                        </select>
                                        @error('form_type') <small style="color:red"> {{ $message}}</small> @enderror
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="col-lg-3 col-form-label">Amount</label>
                                    <div class="col-lg-9">
                                        <input type="number" class="form-control" name="amount">
                                        @error('amount') <small style="color:red"> {{ $message}}</small> @enderror
                                    </div>
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
                                        <table class="table  datanew " id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>Application Form</th>
                                                    <th>Type</th>
                                                    <th>Currency</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listForms as $listFormsItem)
                                                <tr>
                                                    <td>{{$listFormsItem->formName}}</td>
                                                    <td>{{$listFormsItem->formType}}</td>
                                                    <td>{{$listFormsItem->currency}}</td>
                                                    <td style="color:green"><b>{{number_format($listFormsItem->amount,2)}}</b></td>
                                                    <td><a style="color:white;" href="{{ route('finance-setup-application-forms-edit-view', Crypt::encrypt($listFormsItem->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
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

@endsection

@section('scripts')
 <script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
 </script>
@endsection