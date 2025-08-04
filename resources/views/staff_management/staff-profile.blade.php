@php $pageName = "staff"; $subpageName = "application_forms"; @endphp

@extends('layouts.app')

@section('content')
     <!-- Content -->
    
      <div class="container-xxl flex-grow-1 container-p-y">
        
            <div class="row">
                <div class="col-12">
                <div class="card mb-6">
                    <div class="user-profile-header-banner">
                    <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ asset('uploads/StaffPhotos/'.$data->picture) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img">
                    </div>
                    <div class="flex-grow-1 mt-3 mt-lg-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4 class="mb-2 mt-lg-6">{{ $data->surname }} {{ $data->firstname }}</h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                            <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class='ti ti-palette ti-lg'></i><span class="fw-medium">{{ $data->employee_id }}</span>
                            </li>
                            <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class='ti ti-user ti-lg'></i><span class="fw-medium">{{ $data->position }}</span>
                            </li>
                            <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class='ti ti-calendar ti-lg'></i><span class="fw-medium"> {{ $data->dob }}</span></li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-success mb-1">
                            <i class='ti ti-user-check ti-xs me-2'></i>{{ $data->status }}
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-12">
                 
                <div class="nav-align-top mb-6">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                                <li class="nav-item mb-1 mb-sm-0">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true"><span class="d-none d-sm-block"><i class="tf-icons ti ti-users ti-sm me-1_5 align-text-bottom"></i> Personal Profile <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1_5 pt-50">1</span></span><i class="ti ti-users ti-sm d-sm-none"></i></button>
                                </li>
                                <li class="nav-item mb-1 mb-sm-0">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false"><span class="d-none d-sm-block"><i class="tf-icons ti ti-file ti-sm me-1_5 align-text-bottom"></i> Employee Details <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1_5 pt-50">2</span></span><i class="ti ti-file ti-sm d-sm-none"></i></button>
                                </li>
                                <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false"><span class="d-none d-sm-block"><i class="tf-icons ti ti-settings ti-sm me-1_5 align-text-bottom"></i> Employee Contact <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1_5 pt-50">3</span></span><i class="ti ti-settings ti-sm d-sm-none"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Name:</b> {{ $data->title }} {{ $data->surname }} {{ $data->firstname }}</label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Gender:</b> {{ $data->gender }} </label>
                            </div>
                            
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Nationality:</b> {{ $data->nationality }}</label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Employee ID:</b> {{ $data->employee_id }} </label>
                            </div>
                           
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Marital Status:</b> {{ $data->marital_status }}</label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Branch:</b>  </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Date of Birht:</b> {{ $data->dob }} </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Region:</b>  </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>District:</b> </label>
                            </div>
                          
                            <div class="col-md-6">
                                <label><b>Town:</b> {{ $data->town }}</label>
                            </div>
                           
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <h5>Next of Kin</h5>
                            <table id="example" class="table" >
                                <thead class="table-light">
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Contact Address</th>
                                        <th>Relationship</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sta)
                                    @foreach($sta as $reg)
                                    <tr>
                                        <td>{{ $reg->surname }} {{ $reg->firstname }}</td>
                                        <td>{{ $reg->contact_num }}</td>
                                        <td>{{ $reg->email }}</td>
                                        <td>{{ $reg->contact_address }}</td>
                                        <td>{{ $reg->relation }}</td>
                                        <td>{{ $reg->notes }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        
                        
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Employee ID:</b> {{ $data->employee_id }} </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Staff Classification:</b> {{ $data->staff_class }} </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Staff Category:</b> </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Staff Branch:</b>  </label>
                            </div>
                        </div>
                       
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Department:</b> </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Unit:</b> {{ $data->unit }} </label>
                            </div>
                        </div>
                     
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Official Email Address:</b> {{ $data->corporate_email }} </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Personal Email:</b> {{ $data->personal_email }} </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Mobile Number:</b> {{ $data->contact_num }} </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Official Number:</b> {{ $data->office_num }} </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Residential Address:</b> {{ $data->personal_address }} </label>
                            </div>
                            <div class="col-md-6">
                                <label><b>Residential Digital Address:</b> {{ $data->digital_address }} </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                                <label><b>Region :</b> </label>
                            </div>
                            
                        </div>
                    </div>
                  </div>
                </div>
             </div>
      </div>
      
 

@endsection

@section('script')
    <script>
    
    </script> 
@endsection