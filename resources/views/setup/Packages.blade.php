@php $pageName = "setup"; $subpageName = "add_packages"; @endphp

@extends('layouts.app')

 

@section('content')
  
   <div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Setup Manager</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Setup Manager</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Add New Consumer Package</li>
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
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Add New Consumer Package  </h3>
            </div> 
        </div>
       
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">List All Service Providers</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" >
                                        <thead class="table-light">
                                            <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            
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
                                                <td>{{$list->name}}</td>
                                                <td><span class="avatar flex-shrink-0">
													<img alt="Img" src="{{asset($list->logo)}}">
												</span></td>
                                            
                                                <td><a data-bs-toggle="modal" id="showmodal" data-bs-target="#basicModal" data-url="{{ route('service-provider-id',$list->id)  }}" type="button"  class="btn   btn-info" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="tooltip-info" title="Add Packages"  ><i class="tf-icons ti ti-plus" style="color: white"></i></a> </td>
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
                    <div class="col-md-6">
                       <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">List All Consumer Packages  </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <thead class="table-light">
                                            <tr>
                                            <th>#</th>
                                            <th>Provider</th>
                                            <th>Package</th>
                                            <th>Price</th>
                                            
                                            <th>Action</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                             @php
                                            $i=1;
                                            @endphp
                                            @if($packages)
                                            @foreach($packages as $packages)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $packages->provider->name }}</td>
                                                <td>{{$packages->name}}</td>
                                                <td><b>{{ number_format($packages->amount,2)}}</b></td>
                                            
                                                <td><a data-bs-toggle="modal" id="showmodal2" data-bs-target="#basicModal2" data-url="{{ route('package-id',$packages->id)  }}" type="button"  class="btn   btn-success" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="tooltip-info" title="Edit Packages"  ><i class="tf-icons ti ti-edit" style="color: white"></i></a>
                                                 <a onclick="return confirm( 'Are you sure you want to delete this Package?')" href=" {{ url('Packages/'.$packages->id).'/delete' }}"  class="btn btn-danger delete-btn"  ><i class="tf-icons ti ti-trash" style="color: white"></i></a>
                                                </td>
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
@include('setup.edit-package');
@include('setup.packages-modal');
@endsection



@section('scripts')
  <script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#basicModal').modal('show');
    $('#ProverID').val(data.id);
    $('#provName').text(data.name);
    })
    });
    });
</script>

  <script>
    $(document).ready(function(){
    $('body').on('click', '#showmodal2', function(){
    var userUrl = $(this).data('url');
    $.get(userUrl, function(data){
    $('#basicModal2').modal('show');
    $('#Prover_ID').val(data.id);
    $('#prov_Name').text(data.provider.name);
    $('#pack_name').val(data.name);
    $('#pack_amount').val(data.amount);
    
    
    })
    });
    });
</script>

 
@endsection