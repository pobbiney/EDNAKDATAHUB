@php 
$pageName = "main-setup"; 
$subpageName = "others";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Main Setup</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Main Setup</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Other Setup</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
        @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green"><b>{{session('message_success')}}</b></p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Add Currency </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								   <ul class="nav nav-pills nav-fill mb-3" role="tablist">
                                     <li class="nav-item">
										   <a class="nav-link  "   aria-current="page"
										   href="{{ route('add-doc-type')}}" aria-selected="true">Add Document Type</a>
									   </li>
									   <li class="nav-item">
										   <a class="nav-link "   aria-current="page"
										   href="{{ route('others-setup')}}" aria-selected="true">Add Document</a>
									   </li>
									   <li class="nav-item">
										   <a class="nav-link active"   aria-current="page"
										   href="{{ route('add-currency')}}" aria-selected="false">Add Currency</a>
									   </li>
									 
									   
								   </ul>
								   <div class="tab-content">
									   <div class="tab-pane show active text-muted" id="fill-pill-home" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title">Add Currency</h5>
                                                        </div>
                                                        <div class="card-body">
                                                              <form action="{{ route('others-insert-currency-process') }}" method="POST">
                                                                    @csrf
                                                                   <div class="mb-3">
                                                                        <label class="col-lg-3 col-form-label">Name</label>
                                                                        
                                                                            <input type="text" class="form-control" name="currency" value="{{ old('currency') }}">
                                                                            @error('currency') <small style="color:red"> {{ $message}}</small> @enderror
                                                                         
                                                                    </div>
                                                
                                                                   <div class="mb-3">
                                                                        <label class="col-lg-3 col-form-label">Description</label>
                                                                       
                                                                            <textarea type="text" class="form-control" name="currency_description" >{{ old('currency_description') }}</textarea>
                                                                            @error('currency_description') <small style="color:red"> {{ $message}}</small> @enderror
                                                                        
                                                                    </div>
                                                                    <div class="text-end">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title">List All Currencies</h5>
                                                        </div>
                                                        <div class="card-body">
                                                             <div class="table-responsive">
                                                                  <table class="table" id="myTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($currencyList as $currencyListItem)
                                                                        <tr>
                                                                            <td>{{$currencyListItem->name}}</td>
                                                                            
                                                                            <td><a style="color:white;" href="{{ route('others-edit-currency-view', Crypt::encrypt($currencyListItem->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a></td>
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
                </div>
                
            </div>
        </div>
    </div>
</div>
 
@endsection

@section('scripts')
 
@endsection