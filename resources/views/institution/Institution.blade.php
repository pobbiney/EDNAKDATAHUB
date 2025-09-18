@php 
$pageName = "inst"; 
$subpageName = "add_inst";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Institution Manaer</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Institution Setup</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page"> Setup</li>
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
                    <h3>Add Institution</h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                         		<div class="card-body">
								      
								   <div class="tab-content">
									   <div class="tab-pane show active text-muted" id="fill-pill-home" role="tabpanel">
                                            <form enctype="multipart/form-data" action="{{ route('add-institution-process') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Name</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Enter Institution Name">
                                                             @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                         <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Short Name</label>
                                                            <input type="text" name="short_name" class="form-control" placeholder="Enter Short Name">
                                                             @error('short_name') <small style="color:red"> {{ $message}}</small> @enderror
                                                         </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Location</label>
                                                            <input type="text" name="location" class="form-control" placeholder="Enter Location ">
                                                             @error('location') <small style="color:red"> {{ $message}}</small> @enderror
                                                         </div>
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" placeholder="Enter Email ">
                                                             @error('email') <small style="color:red"> {{ $message}}</small> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                         <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Telephone</label>
                                                            <input type="number" name="telephone" class="form-control" placeholder="Enter Telephone Number">
                                                             @error('telephone') <small style="color:red"> {{ $message}}</small> @enderror
                                                         </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Category</label>
                                                            <select class="form-control changecategory" name="category">
                                                                <option value="" selected disabled>--CHOOSE CATEGORY--</option>
                                                                @foreach($listcat as $listcat)
                                                                <option value="{{$listcat->id}}">{{$listcat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                             @error('category') <small style="color:red"> {{ $message}}</small> @enderror
                                                         </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">Type</label>
                                                            <select class="form-control typename" name="type">
                                                                <option value="" selected disabled>--CHOOSE TYPE--</option>
                                                               
                                                            </select>
                                                             @error('type') <small style="color:red"> {{ $message}}</small> @enderror
                                                         </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="col-lg-3 col-form-label">About Institution</label>
                                                            <textarea class="form-control" name="about" rows="7"></textarea>
                                                             @error('about') <small style="color:red"> {{ $message}}</small> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                  <div class="text-end">
                                                       <button type="submit" class="btn btn-primary">Submit</button>
                                                  </div>
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
</div>
 
@endsection

@section('scripts')
  <script>
$(document).ready(function() {
    $(document).on('change', '.changecategory', function() {
        var cat_id = $(this).val();
        
        // Validate the selected value
        if (!cat_id || cat_id <= 0) {
            $(".typename").html('<option value="0" selected disabled>Choose Type</option>');
            return;
        }

        var op = '<option value="0" selected disabled>Choose Type</option>';
        var $districtSelect = $(".typename");
        
        // Show loading state
        $districtSelect.prop('disabled', true).html('<option value="">Loading...</option>');

        $.ajax({
            type: 'GET',
            url: '{!! URL::to('findCategoryData') !!}',
            data: { 'id': cat_id },
            dataType: 'json', // Expect JSON response
            success: function(data) {
                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                } else {
                    op = '<option value="0" selected disabled>No Type found</option>';
                }
                
                $districtSelect.html(op).prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $districtSelect.html('<option value="0" selected disabled>Error loading Type</option>')
                               .prop('disabled', false);
            }
        });
    });
});
</script>
@endsection