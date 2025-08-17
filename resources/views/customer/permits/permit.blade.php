@extends('customer.template.layout')


@section('title')
{{__('Permits')}}
@endsection

@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Permit Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Permits/Certificates </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Permits</li>
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
                    <h3>Generate Permit</h3>
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
                                        <th>Applicant Name</th>
                                        <th>Project Title</th>
                                        <th>Telephone </th>
                                        <th>Plot No</th>
                                        <th>Location</th>
                                        <th>City</th>
                                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                  @endphp
                                    @foreach($data as  $app)
                                    
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $app->proponent_name }}</td>
                                    <td>{{ $app->project_title }}</td>
                                    <td>{{ $app->contact_number }}</td>
                                    <td>{{ $app->plot_number }}</td>
                                    <td>{{ $app->address }}</td>
                                    <td>{{ $app->city }}</td>
                                    <td >
                                        <a href="{{route('customer-print-application-cert-details',Crypt::encrypt($app->id))}} " target="_" class="btn btn-sm btn-success" style="color: white"><i class="fa fa-eye"></i> Preview Permit</a>          
                                    </td>
                                </tr>
                                        @php
                                        $i++;
                                      @endphp
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
@include('customer.permits.issue-cert-modal') 
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#standard-modal').modal('show');
    $('#certID').val(data.formID);
    $('#companyName').text(data.project_title);
    $('#applicantName').text(data.proponent_name);
    $('#telephone').text(data.contact_number);
    $('#cityName').text(data.city);
    $('#regionName').val(data.region);

   
    })
    });
    });
</script>
@endsection