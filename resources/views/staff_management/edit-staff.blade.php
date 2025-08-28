@php $pageName = "staff"; $subpageName = "application_forms"; @endphp

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('assets_two/vendor/libs/bs-stepper/bs-stepper.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_two/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets_two/vendor/libs/%40form-validation/form-validation.css') }}" />
@endsection




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
                    <h3>Edit Staff Details </h3>
            </div> 
        </div>
        <div class="card-body">
             @if(Session::has('message'))
                <div class="alert alert-solid-success d-flex align-items-center" role="alert">
                  <span class="alert-icon rounded">
                    <i class="ti ti-check"></i>
                  </span>
                  {{session('message')}}
                </div>
            @endif
            <div class="nav-align-top nav-tabs-shadow mb-6">
    <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><span class="d-none d-sm-block"><i class="tf-icons ti ti-users ti-sm me-1_5"></i> Personal Profile <i class="ti ti-home ti-sm d-sm-none"></i></button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false"><span class="d-none d-sm-block"><i class="tf-icons ti ti-home ti-sm me-1_5"></i> Employee Details</span>
                <i
                class="ti ti-user ti-sm d-sm-none"></i>
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false"><span class="d-none d-sm-block"><i class="tf-icons ti ti-phone ti-sm me-1_5"></i>Employee Contact</span><i class="ti ti-message-dots ti-sm d-sm-none"></i></button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
            <form id="form" method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('edit-staff-process',$staff_id)}}">
                @csrf
                <div class="row g-6 mb-3">
                    <div class="content-header mb-3">
                      <br>
                        <h6 class="mb-0">Personal Details</h6>
                        <small>Enter Your Personal Details.</small>
                    </div>
                    <div class="row mb-3">
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <div class="col-lg-12">
                                        <div class="text-left m-2" >
                                        <img src="{{ asset($datas->picture) }}" alt="No Image"  style="height:100px; width:auto; border:1px solid #ccc; border-radius:5px;padding:5px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-b-10">
                                    <label class="col-form-label">Replace Image </label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="file" name="photo" accept="image/*" >
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="username">Title</label>
                        <select class="form-control" name="title">
                            <option value="{{ $datas->title }}">{{ $datas->title }}</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                        </select>
                        <small class="text-danger">@error('title'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="surname">Surname</label>
                        <input type="text" class="form-control" placeholder="Enter Surnaname" name="surname" value="{{ $datas->surname }}">
                        <small class="text-danger">@error('surname'){{$message}}@enderror </small>
                    </div>
                     <div class="col-sm-4">
                        <label class="form-label">Firstname</label>
                        <input type="text" class="form-control" placeholder="Enter First Name" name="firstname" value="{{ $datas->firstname }}">
                        <small class="text-danger">@error('firstname'){{$message}}@enderror </small>
                    </div>
                  
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px">
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Othername</label>
                        <input type="text" class="form-control" placeholder="Enter Other Name" name="othername" value="{{ $datas->othername }}">

                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Gender</label>
                        <select class="form-control" name="gender">
                            <option value="{{ $datas->gender }}">{{$datas->gender}}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <small class="text-danger">@error('gender'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Date of Birth</label>
                        <input type="date" class="form-control dob-picker" placeholder="YYYY-MM-DD" name="dob" value="{{ $datas->dob }}">
                        <small class="text-danger">@error('dob'){{$message}}@enderror </small>
                    </div>
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px">
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Nationality</label>
                        <select class="select2 form-select" data-allow-clear="true" name="nationality">
                            <option value="{{ $datas->nationality }}">{{ $datas->nationality }}</option>
                            @foreach($data as $procats)
                            <option value="{{$procats->nationality}}">{{$procats->nationality}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('nationality'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Marital Status</label>
                        <select class="form-control" name="marital_status_id" id="marital_status_id">
                            <option value="{{ $datas->marital_status_id }}">{{ $datas->marital_status_id }}</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widow">widow</option>
                            <option value="Widower">Widower</option>
                        </select>
                        <small class="text-danger">@error('marital_status_id'){{$message}}@enderror </small>
                    </div>
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px;">
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Hometown</label>
                        <input type="text" class="form-control" placeholder="Enter Hometown" name="hometown" value="{{ $datas->hometown }}">
                        <small class="text-danger">@error('hometown'){{$message}}@enderror </small>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Region</label>
                        <select class="select2 form-select changeregion" data-allow-clear="true" name="region">
                            <option value="" selected disabled>--Choose Region--</option>
                            @foreach($regs as $reg)
                            <option @if($reg->id== $datas->region_id ) selected @endif value="{{$reg->id}}">{{$reg->name}}</option>
                            @endforeach

                        </select>
                        <small class="text-danger">@error('region'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">District</label>
                        <select id="multicol-country" class="select2 form-select districtname" data-allow-clear="true" name="district">
                            <option selected disabled>--Choose District--</option>
                            @foreach($dist as $dis)
                            <option @if($dis->id==$datas->mmda_id ) selected @endif value="{{$dis->id}}">{{$dis->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('district'){{$message}}@enderror </small>
                    </div>
                    <div class="row g-6" style="margin-top:2px;">
                        <div class="col-md-3">
                            <label class="form-label" for="confirm-password">Status</label>
                            <select class="form-control" name="status">
                                <option value="{{ $datas->status }}">{{ $datas->status }}</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                            <small class="text-danger">@error('status'){{$message}}@enderror </small>
                            <input type="hidden" name="staff_id" id="staff_ID" />
                        </div>

                    </div>
                    
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px;">
                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
            <form id="form" method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('edit-staff-process2',$staff_id)}}">
                @csrf
                <div class="content-header mb-4">
                    <h6 class="mb-0">Employee Details</h6>
                    <small>Enter Your Employee Details.</small>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Employee ID</label>
                        <input type="text" class="form-control" placeholder="Enter Employee ID" name="employee_id" value="{{ $datas->employee_id }}">
                        <small class="text-danger">@error('employee_id'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Staff Classification</label>
                        <select class="select2 form-select " data-allow-clear="true" name="staff_class">
                            <option value="" selected disabled>--Choose Classification--</option>
                            @foreach($clas as $class)
                            <option @if($class->name==$datas->staff_class ) selected @endif value="{{$class->name}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('staff_class'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Staff Category</label>
                        <select class="select2 form-select " data-allow-clear="true" name="staff_category">
                            <option value="" selected disabled>--Choose Category--</option>
                            @foreach($cat as $cats)
                            <option @if($cats->cat_id==$datas->staff_cat_id ) selected @endif value="{{$cats->cat_id}}">{{$cats->name}}</option>
                            @endforeach

                        </select>
                        <small class="text-danger">@error('staff_category'){{$message}}@enderror </small>
                    </div>
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px;">
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Branch</label>
                        <select id="multicol-country" class="select2 form-select " data-allow-clear="true" name="branch">
                            <option value="" selected disabled>--Choose Branch--</option>
                            @foreach($bra as $bras)
                            <option @if($bras->id==$datas->branch ) selected @endif value="{{$bras->id}}">{{$bras->branch_name}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('branch'){{$message}}@enderror </small>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Department</label>
                        <select class="select2 form-select" data-allow-clear="true" name="department">
                            <option value="" selected disabled>--Choose Department--</option>
                            @foreach($dep as $deps)
                            <option @if($deps->id==$datas->department ) selected @endif value="{{$deps->id}}">{{$deps->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('department'){{$message}}@enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Staff Unit</label>
                        <input type="text" class="form-control" placeholder="Enter Unit" name="unit" value="{{ $datas->unit }}">
                        <small class="text-danger">@error('unit'){{$message}}@enderror </small>
                    </div>
                </div>
                <br/>
                <div class="row g-6 mb-3" style="margin-top:2px;">
                  <div class="col-md-4">
                      <button type="submit" class="btn btn-success">UPDATE</button>
                  </div>
                </div> 

            </form>
        </div>
        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
            <form id="form" method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('edit-staff-process3',$staff_id)}}">
                @csrf
                <div class="content-header mb-4">
                    <h6 class="mb-0">Employee Contact Details</h6>
                    <small>Enter Your Contact Details.</small>
                </div>

                <div class="row g-6 mb-3">
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Official Email Address</label>
                        <input type="text" class="form-control" placeholder="Enter Official Email Address" name="corporate_email" value="{{ $datas->corporate_email }}">
                        <small class="text-danger">@error('corporate_email'){{$message}}@enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Personal Email Address</label>
                        <input type="text" class="form-control" placeholder="Enter Personal Email Address" name="personal_email" value="{{ $datas->personal_email }}">
                        <small class="text-danger">@error('personal_email'){{$message}}@enderror </small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password"> Mobile Number </label>
                        <input type="number" class="form-control" placeholder="Enter Mobile Number" name="contact_num" value="{{ $datas->contact_num }}">
                        <small class="text-danger">@error('contact_num'){{$message}}@enderror </small>
                    </div>
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px ">
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Official Number </label>
                        <input type="number" class="form-control" placeholder="Enter Official Number" name="office_num" value="{{ $datas->office_num }}">
                        <small class="text-danger">@error('office_num'){{$message}}@enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Residential Address</label>
                        <input type="text" class="form-control" placeholder="Enter Residential  Address" name="residence" value="{{ $datas->personal_address }}">
                        <small class="text-danger">@error('residence'){{$message}}@enderror </small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password"> Residential Digital Address </label>
                        <input type="text" class="form-control" placeholder="Enter Residential Digital Address " name="digital_address" value="{{ $datas->digital_address }}">
                        <small class="text-danger">@error('digital_address'){{$message}}@enderror </small>
                    </div>
                </div>
                <div class="row g-6 mb-3" style="margin-top:2px ">
                    <div class="col-md-4">
                        <label class="form-label" for="confirm-password">Town </label>
                        <input type="text" class="form-control" placeholder="Enter Town/Suburb " name="town" value="{{ $datas->town }}">
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="confirm-password">Region</label>
                        <select class="select2 form-select" data-allow-clear="true" name="e_region">
                            <option value="" selected disabled>--Choose Region--</option>
                            @foreach($regs as $reg)
                            <option @if($reg->id==$datas->e_region ) selected @endif value="{{$reg->id}}">{{$reg->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('e_region'){{$message}}@enderror </small>
                    </div>
                </div>
                <br/>
                <div class="row g-6 mb-3" style="margin-top:2px ">
                  <div class="col-md-4">
                      <button type="submit" class="btn btn-success">UPDATE</button>
                  </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
   $('#dobs').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    
</script>
<script>
  $(document).ready(function(){
      $(document).on('change','.changeregion',function(){
    //    console.log("Hello world");
       var cat_id = $(this).val();
    //    console.log(cat_id);

       var div=$(this).parent();

       var op ='';
       $.ajax({
        type:'get',
        url:'{!!URL::to('findRegionData')!!}',
        data:{'id':cat_id},
        success:function(data){
         //console.log('success');
        //  console.log(data);

         op+='<option value="0" selected disabled>Choose District</option>';
    for(var i=0;i<data.length;i++){
    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

          }
          $(".districtname").html(op);
          
        },
        error:function(){
        }
       });
      });

  });
  </script>
@endsection