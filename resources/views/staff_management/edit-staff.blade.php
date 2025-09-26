@php $pageName = "staff"; $subpageName = "application_forms"; @endphp

@extends('layouts.app')

 

@section('content')
  
   <div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Staff Management</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Staff Management</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Update Staff</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Update Staff Form </h3>
            </div> 
        </div>
         <!-- /product list -->
        @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green"><b>{{session('message_success')}}</b></p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form id="form" method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('edit-staff-process',$staff_id)}}">
                 
                       @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Surname</label>
                                    <input type="text" name="surname" class="form-control" placeholder="Enter Surname" value="{{ $data->surname }}">
                                    @error('surname')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Firstname</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" value="{{ $data->firstname }}">
                                    @error('firstname')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="{{ $data->gender }}"  >{{ $data->gender }}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Phone</label>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ $data->contact_num }}">
                                    @error('phone')<small class="text-danger">{{$message}}</small> @enderror
                                </div>

                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ $data->personal_email }}">
                                    @error('email')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                             </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary" style="float: left">Submit</button>
                        </div>
                    </form>
                </div>
                    <div class="col-md-6">
                       <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">List All Staff</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <thead class="table-light">
                                            <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i=1;
                                            @endphp
                                            @if($list)
                                            @foreach($list as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{$list->surname.' '.$list->firstname}}</td>
                                                <td>{{ $list->contact_num}}</td>
                                                <td>{{ $list->personal_email}}</td>
                                                <td><a  href="{{route('edit-staff',Crypt::encrypt($list->staff_id))}}"  class="btn btn-sm btn-success" style="color: #fff"><i class="fe fe-edit"></i> 
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
@endsection



@section('scripts')
 
 
@endsection