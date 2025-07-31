@php 

$pageName = "finance_setup"; 

$subpageName = "bill_setup";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Finance Setup</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Finance Setup</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       

       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Finance Setup</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5 class="card-title">Forms</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">Add Bill Type</a></li>
                            <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">Bill</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab1">
                                <div>
                                    <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif') }}" > Please wait....</p>
                                    <div id="response" align="center"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">Add Bill Type</h5>
                                            </div>
                                            <div class="card-body">
                                                @if (session('message_success'))
                                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                                @endif
                                    
                                                @if (session('message_error'))
                                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                                @endif
                                                <form action="{{ route('finance-setup-insert-type-process') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group row mb-3">
                                                        <label class="col-lg-3 col-form-label">Name</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                                            @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-lg-3 col-form-label">Description</label>
                                                        <div class="col-lg-9">
                                                            <textarea type="text" class="form-control" name="description" >{{ old('description') }}</textarea>
                                                            @error('description') <small style="color:red"> {{ $message}}</small> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">List Facility</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table  datanew ">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($listType as $listTypeitem)
                                                            <tr>
                                                                <td>{{$listTypeitem->name}}</td>
                                                                <td><a style="color:white;" href="{{ route('finance-setup-edit-type-view', Crypt::encrypt($listTypeitem->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
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
                            <div class="tab-pane show" id="solid-tab2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Add Bill</h5>
                                            </div>
                                            <div class="card-body">
                                                @if (session('message_success'))
                                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                                @endif
                                    
                                                @if (session('message_error'))
                                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                                @endif
                                                <form action="{{ route('finance-setup-insert-bill') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-lg-3 col-form-label">Name</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" name="bill_name">
                                                                    @error('bill_name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group row mb-3" >
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
                                                            <div class="form-group row mb-3">
                                                                <label class="col-lg-3 col-form-label">Bill Type</label>
                                                                <div class="col-lg-9">
                                                                    <select id="bill_type" name="bill_type" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>

                                                                        @foreach ($listType as $listTypeItem)
                                                                            <option value="{{ $listTypeItem->id }}" @if (old('bill_type') == $listTypeItem->id) selected @endif>{{ $listTypeItem->name }}</option> 
                                                                        @endforeach
                                                                        
                                                                        
                                                                    </select>
                                                                    @error('bill_type') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-lg-3 col-form-label">Amount</label>
                                                                <div class="col-lg-9">
                                                                    <input type="number" class="form-control" name="amount">
                                                                    @error('amount') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-lg-3 col-form-label">Sector</label>
                                                                <div class="col-lg-9">
                                                                    <select id="sector" name="sector" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>

                                                                        @foreach ($listSetor as $listSetorItem)
                                                                            <option value="{{ $listSetorItem->id }}" @if (old('sector') == $listSetorItem->id) selected @endif>{{ $listSetorItem->name }}</option> 
                                                                        @endforeach
                                                                        
                                                                        
                                                                    </select>
                                                                    @error('sector') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-lg-3 col-form-label">Category</label>
                                                                <div class="col-lg-9">
                                                                    <select id="category" name="category" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>

                                                                        @foreach ($listProjectCatefory as $listProjectCateforyItem)
                                                                            <option value="{{ $listProjectCateforyItem->id }}" @if (old('category') == $listProjectCateforyItem->id) selected @endif>{{ $listProjectCateforyItem->name }}</option> 
                                                                        @endforeach
                                                                        
                                                                        
                                                                    </select>
                                                                    @error('category') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                          
                                                        </div>

                                                        <div class="col-xl-4">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-lg-3 col-form-label">Type</label>
                                                                <div class="col-lg-9">
                                                                    <select id="types" name="types" class="form-select select2" data-allow-clear="true">
                                                                        <option value="">-- SELECT --</option>  
                                                                    </select>
                                                                    @error('types') <small style="color:red"> {{ $message}}</small> @enderror
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        
                                                    </div>
                                                    <h5 class="card-title">Bill Description</h5>
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            
                                                          <textarea class="form-control" name="bill_description" id="bill_description" cols="5" rows="10" ></textarea>
                                                        </div>
                                                        
                                                        
                                                    </div><br>
                        
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">List Bill</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table  datanew ">
                                                        <thead>
                                                            <tr>
                                                                <th>Bill</th>
                                                                <th>Bill Type</th>
                                                                <th>Currency</th>
                                                                <th>Amount</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($listBill as $listBillItem)
                                                            <tr>
                                                                <td>{{$listBillItem->name}}</td>
                                                                <td>{{$listBillItem->getBillType()}}</td>
                                                                <td>{{$listBillItem->currency}}</td>
                                                                <td style="color:green"><b>{{number_format($listBillItem->amount,2)}}</b></td>
                                                                <td><a style="color:white;" href="{{ route('finance-setup-edit-bill-view', Crypt::encrypt($listBillItem->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
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

  <script>
    $(document).on("change","#category",function(){
    
    var dropvalue = $("#category").val();
    
    $("#wait").css("display", "block");
    
    $.ajax({
        type: "POST",
        url: "{{ route('finance-setup-project-type-drop') }}",
        data:{
            "_token": "{{ csrf_token() }}",
            'category_id': dropvalue
        },
        success:function(data) {

            $("#wait").css("display", "none");
    
            $('#types').html(data);
           
        }
    
       });
    });
    </script>
    
@endsection