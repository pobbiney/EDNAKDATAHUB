@php 
$pageName = "review"; 
$subpageName = "review_permit";
@endphp

@extends('layouts.app')

@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Review Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Review Manager </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Review Permit </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    @if (session('message_success'))
    <p class="alert alert-success" align="center" style="color:green">{{session('message_success')}}</p>
    @endif

    @if (session('message_error'))
    <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
    @endif
    
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <h3>Review Permit </h3>
            </div> 
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Proponent Name</th>
                                        <th>Project Title</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Total Bill (GHC)</th>
                                        <th>Amount Paid (GHC)</th>
                                        <th>Balance (GHC)</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @if($tasks)
                                    @foreach($tasks as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $list->proponent_name ?? 'N/A' }}</td>
                                        <td>{{ $list->project_title ?? 'N/A' }}</td>
                                        <td>{{ $list->contact_number ?? 'N/A' }}</td>
                                        <td>{{ $list->email ?? 'N/A' }}</td>
                                        <td>{{ $list->town ?? 'N/A' }}</td>
                                        <td>{{ number_format($list->total_bill, 2) }}</td>
                                        <td>{{ number_format($list->total_paid, 2) }}</td>
                                        <td class="{{ $list->balance > 0 ? 'text-danger fw-bold' : ($list->balance < 0 ? 'text-warning' : 'text-success') }}">
                                            {{ number_format($list->balance, 2) }}
                                        </td>
                                        <td>
                                            @if($list->balance == 0)
                                                <span class="badge bg-success">Fully Paid</span>
                                            @elseif($list->balance > 0)
                                                <span class="badge bg-danger">Balance Due</span>
                                            @else
                                                <span class="badge bg-warning">Overpayment</span>
                                            @endif
                                        </td>
                                        <td>
                                            
                                            @if($list->has_outstanding_bill)
                                            <span class="badge bg-warning mt-1" title="Outstanding bill balance">
                                                Payment Required
                                            </span>
                                            @else
                                            <a href="{{ route('review_permit_application', Crypt::encrypt($list->formID)) }}" target="_" class="btn btn-primary" style="color: white">
                                                Review
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
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

@endsection

@section('scripts')
 
@endsection