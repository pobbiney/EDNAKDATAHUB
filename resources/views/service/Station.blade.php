@php 
$pageName = "loc"; 
$subpageName = "locs";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Service Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Service Manager </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Add office </li>
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
                    <h3>Add office </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								   <ul class="nav nav-pills nav-fill mb-3" role="tablist">
									   <li class="nav-item">
										   <a class="nav-link"  aria-current="page"
										   href="{{ route('Region')}}" aria-selected="true">Add Region</a>
									   </li>
									   <li class="nav-item">
										   <a   class="nav-link"  aria-current="page"
										   href="{{ route('District')}}" aria-selected="false">Add District</a>
									   </li>
									   <li class="nav-item">
										   <a class="nav-link active"   aria-current="page"
										   href="{{ route('Station')}}" aria-selected="false">Add office</a>
									   </li>
									   
								   </ul>
								   <div class="tab-content">
									   <div class="tab-pane show active text-muted" id="fill-pill-home" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title">Add New Office</h5>
                                                        </div>
                                                        <div class="card-body">
                                                             <form enctype="multipart/form-data" action="{{ route('add-station-process') }}" method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Name</label>
                                                                            <input type="text" class="form-control" name="name" placeholder="Enter Station Name">
                                                                            @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    </div>
                                                                   <div class="mb-3">
                                                                        <label class="col-form-label">Region</label>
                                                                        <select class="form-control changeregion" name="region">
                                                                            <option value="" selected disabled>--Choose Region--</option>
                                                                            @foreach($list as $list)
                                                                            <option value="{{ $list->id }}" >{{$list->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('region') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">District</label>
                                                                        <select class="form-control districtname" name="district">
                                                                            <option value="" selected disabled>--Choose District--</option>
                                                                            
                                                                        </select>
                                                                        @error('district') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    </div> 
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Town</label>
                                                                        <input type="text" name="town" class="form-control" placeholder="Enter Twon"/>
                                                                        @error('town') <small style="color:red"> {{ $message}}</small> @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">GPS Address</label>
                                                                        <input type="text" name="gps" class="form-control" placeholder="Enter GPS Address"/>
                                                                        @error('gps') <small style="color:red"> {{ $message}}</small> @enderror
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
                                                            <h5 class="card-title">List All offices</h5>
                                                        </div>
                                                        <div class="card-body">
                                                             <div class="table-responsive">
                                                                  <table class="table" id="myTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Name</th>
                                                                            <th>Region</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                        $i=1;
                                                                    @endphp
                                                                    @if($stat)
                                                                    @foreach($stat as $stat)
                                                                        <tr>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $stat->name }}</td>
                                                                            <td>{{ $stat->region->name }} </td>
                                                                            <td> <a href="{{route('edit-station',Crypt::encrypt($stat->id))}}"  class="btn btn-sm btn-success" style="color: #fff"><i class="fe fe-edit"></i> 
                                                                                Edit
                                                                            </a></td>
                                                                        </tr>
                                                                        @php
                                                                        $i++;
                                                                    @endphp
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
$(document).ready(function() {
    $(document).on('change', '.changeregion', function() {
        var cat_id = $(this).val();
        
        // Validate the selected value
        if (!cat_id || cat_id <= 0) {
            $(".districtname").html('<option value="0" selected disabled>Choose District</option>');
            return;
        }

        var op = '<option value="0" selected disabled>Choose District</option>';
        var $districtSelect = $(".districtname");
        
        // Show loading state
        $districtSelect.prop('disabled', true).html('<option value="">Loading...</option>');

        $.ajax({
            type: 'GET',
            url: '{!! URL::to('findRegionData') !!}',
            data: { 'id': cat_id },
            dataType: 'json', // Expect JSON response
            success: function(data) {
                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                } else {
                    op = '<option value="0" selected disabled>No districts found</option>';
                }
                
                $districtSelect.html(op).prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $districtSelect.html('<option value="0" selected disabled>Error loading districts</option>')
                               .prop('disabled', false);
            }
        });
    });
});
</script>
@endsection