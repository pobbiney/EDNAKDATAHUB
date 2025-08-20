@php 

$pageName = "impact"; 

$subpageName = "impact_assessment";

@endphp

@extends('layouts.app')

@section('css')
    <style>
        .my-mr-1 {
            margin-right: 4px;
        }
    </style>
@endsection

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Management of Impacts </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-divide mb-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Impact Assessment</a></li>
                            <li class="breadcrumb-item"><a href="#">Management of Impacts</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /product list -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message_success'))
            <p class="alert alert-success" align="center" style="color:green"><b>{{session('message_success')}}</b></p>
        @endif

        @if (session('message_error'))
            <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Management of Impacts</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('store-impact-mgt', Crypt::encrypt($decodeId))}}"
                                    method="POST">
                                    @csrf
                                    {{-- <button type="button" id="add-concern" class="btn btn-info float-end">Add
                                        Concern</button> --}}
                                    <p class="mb-3"></p>

                                    <div class="row">
                                        <div class="col-xl-3">
                                            <h6>Construction Phase</h6>
                                        </div>
                                        <div class="col-xl-3">
                                            <h6>Management of Impact</h6>
                                        </div>
                                        <div class="col-xl-3">
                                            <h6>Operational Phase</h6>
                                        </div>
                                        <div class="col-xl-3">
                                            <h6>Management of Impact</h6>
                                        </div>
                                    </div>
                                    @php
                                    $i =0;
                                    @endphp
                                    @foreach($envImpact as $item)
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="row mb-2 my-mr-1">
                                                <input type="hidden" name="concerns[{{ $i }}][env_impact_id]" value="{{$item->impact_mgt->id ?? '0'}}">
                                                <input type="hidden" name="concerns[{{ $i }}][impact_id]" value="{{$item->id}}">
                                                 <textarea class="form-control" cols="30"
                                                    rows="2" disabled>{{$item->construction_impact}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="row mb-2 my-mr-1">
                                                 <textarea name="concerns[{{ $i }}][construction_mgt]" class="form-control" cols="30"
                                                    rows="2" required>{{$item->impact_mgt->construction_mgt ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="row mb-2 my-mr-1">
                                                 <textarea class="form-control" cols="30"
                                                    rows="2" disabled>{{$item->operational_impact}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="row mb-2 my-mr-1">
                                                <textarea name="concerns[{{ $i }}][operational_mgt]" class="form-control" cols="30"
                                                    rows="2" required>{{$item->impact_mgt->operational_mgt ?? ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                     @php
                                        $i++;
                                      @endphp
                                    @endforeach
                                    <button type="submit" class="btn btn-success mt-3">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

