@php 
$pageName = "task"; 
$subpageName = "my_task_gnfs";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Inspection Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Inspection Manager </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Permit Inspection </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
            @if (session('message'))
            <p class="alert alert-success"  >{{session('message')}}</p>
            @endif

            @if (session('message_error'))
            <p class="alert alert-danger" >{{session('message_error')}}</p>
            @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3" style="background: rgb(213, 111, 10)">
            <div class="search-set">
                    <h3>View Permit Inspection</h3>
            </div> 
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
                                                        Applicant : <b>{{ $datas->firstname.' '.$datas->surname }}</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        Plot/House No: {{ $datas->plotNo }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        Location : {{ $datas->location }}
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px">
                                                    <div class="col-md-4">
                                                        City : <b>{{ $datas->city}}</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        District: {{ $datas->dist->name }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        Region : {{ $datas->reg->name }}
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px">
                                                    <div class="col-md-4">
                                                        Postal Address : <b>{{ $datas->address}}</b>
                                                    </div>
                                                    <div class="col-md-4">
                                                        Mobile: {{ $datas->mobile }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        Email : {{ $datas->email }}
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 20px">
                                                    
                                                     
                                                    <div class="col-md-4">
                                                        No of floors : {{ $datas->noFloor }}
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="row" style="margin-top: 20px">
                                                    <h7 style="text-decoration: underline;margin-bottom:5px">ENTER FLOOR DATA</h7>
                                                    <hr/>
                                                    <form enctype="multipart/form-data" action="{{ route('add-permit-floor-process') }}" method="POST">
                                                        @csrf
                                                        
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    @for ($i = 0; $i < $datas->noFloor; $i++)
                                                                    <tr>
                                                                        <td>
                                                                            Select Floor(s)
                                                                        </td>
                                                                        <td>
                                                                            <select class="form-control" name="floor[]"  required>
                                                                                @for ($y = 1; $y<= 10; $y++)
                                                                                <option vallue="{{ $y}}">{{ $y }} </option>
                                                                                @endfor
                                                                            </select>
                                                                        </td>
                                                                         
                                                                             
                                                                        <td>
                                                                            <input type="number" name="length[]" class="form-control" placeholder="Enter Length" required >
                                                                            
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="breadth[]" class="form-control" placeholder="Enter Breadth" required >
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    @endfor
                                                                
                                                                </tbody>
                                                            </table>
                                                            <div class="row" style="display: flex; justify-content: center; align-items: center;margin-top:15px  ">
                                                                <button type="submit" class="btn btn-sm btn-info" style="width: 150px;color:white">Submit Floor</button>
                                                            </div>
                                                         
                                                        <input type="hidden" name="certificateID" value="{{ $datas->id }}"/>
                                                    </form>
                                                </div>
                                                <div class="row" style="margin-top: 20px">
                                                    <h7 style="text-decoration: underline;margin-bottom:5px">DRAWINGS</h7>
                                                    <hr/>
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Path</th>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $i=1;
                                                          @endphp
                                                          @if($results)
                                                          @foreach($results as $results)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $results->drawname->name }}</td>
                                                                <td><a href="" class="btn btn-sm btn-primary">View Drawing</a></td>
                                                            </tr>
                                                            @php
                                                            $i++;
                                                          @endphp
                                                          @endforeach
                                                          @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row" style="margin-top: 20px">
                                                    <h7 style="text-decoration: underline;margin-bottom:5px">Inspector General’s Comments</h7>
                                                    <hr/>
                                                    <form enctype="multipart/form-data" action="{{ route('add-permit-inspector-general-process') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p>How would you rate premises in terms of risk?:</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="risk"  required>
                                                                    <option value="Low">Low</option>
                                                                    <option value="Medium">Medium</option>
                                                                    <option value="High">High</option>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 15px">
                                                            <div class="col-md-6">
                                                                <p>Do you recommend the above premises inspected for a fire certificate?:</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="recommend" required >
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                     
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 15px">
                                                            <div class="col-md-6">
                                                                <p>If no why?:</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" name="reason"  ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 15px">
                                                            <p>APPROVAL</p>
                                                            <div class="col-md-6">
                                                                <p>I authorize for the issuance of fire certificate?:</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="approval" required>
                                                                    <option value="New">New</option>
                                                                    <option value="Renew">Renew</option>
                                                                     
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="row" style="display: flex; justify-content: center; align-items: center;margin-top:15px  ">
                                                            <button type="submit" class="btn btn-sm btn-info" style="width: 100px;color:white">Submit</button>
                                                        </div>
                                                        <input type="hidden" name="appID" value="{{ $datas->id }}"/>
                                                        <input type="hidden" name="regionID" value="{{ $datas->region }}"/>
                                                    </form>
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
    $('#dob').datepicker({
       format: "yyyy-mm-dd",
       autoclose: true
   });
 
</script> 
 
 
@endsection