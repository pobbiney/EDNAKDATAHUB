@extends('customer.template.layout')


@section('title')
{{__('Impact Assessment')}}
@endsection

@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Impact Assessment</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Impact Assessment </a></li>
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
                    <h3>List Applications</h3>
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
                                        <th>Applicant</th>
                                        <th>Telephone </th>
                                        <th>Project Name</th>
                                        <th>Town</th>
                                        <th>District</th>
                                        <th>Region</th>
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
                                    <td>{{ $app->contact_number }}</td>
                                     <td>{{ $app->project_title }}</td>
                                    <td>{{ $app->town }}</td>
                                    <td>{{ $app->getDistrict->name }}</td>
                                    <td>{{ $app->getRegion->name }}</td>
                                    <td >
                                        <a href="#" class="btn btn-sm btn-success" style="color: white">View</a>    
                                        <a href="{{route('customer-environmental-impact',Crypt::encrypt($app->id))}}" class="btn btn-sm btn-warning" style="color: white">Impact</a>     
                                        <a href="{{route('customer-neighbour-concerns',Crypt::encrypt($app->id))}}" class="btn btn-sm btn-danger" style="color: white">Concerns</a> 
                                        <a href="{{route('customer-impact-mgt',Crypt::encrypt($app->id))}}" class="btn btn-sm btn-info" style="color: white">Impact Management</a>         
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
@endsection

@section('scripts')

@endsection