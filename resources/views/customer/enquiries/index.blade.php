@extends('customer.template.layout')


@section('title')
{{__('Enquiries')}}
@endsection

@section('css')
<style>
    .nav-link.active {
    background-color: #3EB780 !important;
    color: #fff !important;
    border: 1px solid #3EB780 !important;
}
</style>
@endsection

@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Enquiries</h4>
                <nav aria-label="breadcrumb">
                    {{-- <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Task Manager </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">My Task </li>
                    </ol> --}}
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
        @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green">{{session('message_success')}}</p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>List Enquiries</h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                            
                    <div class="row">
                                    <div class="col-md-12">
										<div class="card bg-white">
											
											<div class="card-body">
												<ul class="nav nav-tabs nav-tabs-solid nav-justified">
													<li class="nav-item" ><a class="nav-link active" href="#solid-justified-tab1" data-bs-toggle="tab">PENDING</a></li>
													<li class="nav-item"><a class="nav-link" href="#solid-justified-tab2" data-bs-toggle="tab">CLOSED</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane show active" id="solid-justified-tab1">
														<div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table datanew">
                                                                    <thead>
                                                                        <tr>
                                                                            <th >#</th>
                                                                            <th >Date</th>
                                                                            <th>Related Service</th>
                                                                            <th>Type</th>
                                                                            <th>Subject</th>
                                                                            <th>Description</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($pending as $pendingItem)
                                                                        <tr>
                                                                            <td class="text-dark">{{ $loop->iteration }}</td>
                                                                            <td class="text-dark">{{ \Carbon\Carbon::parse($pendingItem->created_at)->format('M d,Y') }}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$pendingItem->service->name}}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$pendingItem->type->name}}</td>
                                                                            <td class="text-dark"  style="word-wrap: break-word; white-space: normal;">{{ $pendingItem->subject }}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;"> {{$pendingItem->description}}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$pendingItem->status}}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
													</div>
													<div class="tab-pane" id="solid-justified-tab2">
															<div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table datanew">
                                                                    <thead>
                                                                        <tr>
                                                                           	<th >#</th>
                                                                            <th >Date</th>
                                                                            <th>Related Service</th>
                                                                            <th>Type</th>
                                                                            <th>Subject</th>
                                                                            <th>Description</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($closed as $closedItem)
                                                                        <tr>
                                                                            <td class="text-dark">{{ $loop->iteration }}</td>
                                                                            <td class="text-dark">{{ \Carbon\Carbon::parse($closedItem->created_at)->format('M d,Y') }}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$closedItem->service->name}}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$closedItem->type->name}}</td>
                                                                            <td class="text-dark"  style="word-wrap: break-word; white-space: normal;">{{ $closedItem->subject }}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;"> {{$closedItem->description}}</td>
                                                                            <td class="text-dark" style="word-wrap: break-word; white-space: normal;">{{$closedItem->status}}</td>
                                                                        </tr>
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
	
									
								</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
 
@endsection