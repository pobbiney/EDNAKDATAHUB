@extends('customer.template.layout')


@section('title')
{{__('Enquiries')}}
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
            <span style="float: right">
								<a data-id="" id="showmodal" data-bs-toggle="modal" data-bs-target="#basicModal"
									style="color: aliceblue">
									<button type="button" class="btn btn-danger btn-sm">
										<i class="fas fa-plus"> </i> NEW TICKET
									</button>
								</a>
							</span>
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
										<th>Date</th>
										<th>Related Service</th>
										<th>Type</th>
										<th>Subject</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                  @endphp
                                  @if($enquiries)
                                  @foreach($enquiries as $enquiry)
                                   <tr>
                                    <td class="text-dark">{{ $loop->iteration }}</td>
											<td class="text-dark">{{ $enquiry->created_at->format('M d,Y') }}</td>
											<td class="text-dark" style="word-wrap: break-word; white-space: normal;">
												{{$enquiry->service->name}}
											</td>
											<td class="text-dark" style="word-wrap: break-word; white-space: normal;">
												{{$enquiry->type->name}}
											</td>
											<td class="text-dark" style="word-wrap: break-word; white-space: normal;">
												{{ $enquiry->subject }}
											</td>
											<td class="text-dark" style="word-wrap: break-word; white-space: normal;">
												{{$enquiry->description}}
											</td>
											<td class="text-dark" style="word-wrap: break-word; white-space: normal;">
												{{$enquiry->status}}
											</td>
											<td><a href="#" class="view-details btn badges bg-lightgreen" data-bs-toggle="modal"
													data-bs-target="#detailsModal_{{ $enquiry->id }}"> View Details</a>

												<div class="modal fade" id="detailsModal_{{ $enquiry->id }}" tabindex="-1"
													aria-labelledby="detailsModalLabel_{{ $enquiry->id }}" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title text-black"
																	id="detailsModalLabel_{{ $enquiry->id }}">Enquiry
																	Details</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal"
																	aria-label="Close"></button>
															</div>
															<div class="modal-body">
																<div class="row text-dark">
																	<div class="col-md-6 col-sm-6">
																		<label
																			class="control-label"><strong>Date</strong></label>
																		<input type="text" readonly class="form-control"
																			value="{{$enquiry->created_at->format('M d,Y') }}">

																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label
																			class="control-label"><strong>Subject</strong></label>
																		<input type="text" readonly class="form-control"
																			value="{{$enquiry->subject}}">

																	</div>

																</div><br>
																<div class="row text-dark">
																	<div class="col-md-6 col-sm-6">
																		<label class="control-label"><strong>Related
																				Service</strong></label>
																		<input type="text" readonly class="form-control"
																			value="{{$enquiry->service->name}}">

																	</div>
																	<div class="col-md-6 col-sm-6">
																		<label
																			class="control-label"><strong>Type</strong></label>
																		<input type="text" readonly class="form-control"
																			value="{{$enquiry->type->name}}">

																	</div>

																</div><br>
																<div class="row text-dark">
																	<div class="col-md-12 col-sm-12">
																		<label
																			class="control-label"><strong>Description</strong></label>
																		<textarea readonly name="" id="" cols="2"
																			class="form-control">{{$enquiry->description}}</textarea>
																		
																	</div>
																</div><br>
																<div class="row text-dark">
																	<div class="col-md-12 col-sm-12">
																		<label
																			class="control-label"><strong>Status</strong></label>
																		<input type="text" readonly value="{{$enquiry->status}}"
																			class="form-control">

																	</div>
																</div><br>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-danger ms-auto"
																	data-bs-dismiss="modal">Close</button>
															</div>

														</div>
													</div>
												</div>
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

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
		<form method="post" autocomplete="off" action="{{ route('customer-enquiries-submit') }}">
			@csrf
			<div class="modal-dialog" role="document" style="width: 100%">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel1">New Enquiry</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<label class="control-label"><strong>Type</strong></label>
								<select name="typeId" id="typeId" required class="form-control">
									<option value="">--Select here--</option>
									@foreach($types as $type)
										<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>

							</div>

							<div class="col-md-6 col-sm-12">
								<label class="control-label"><strong>Related Service</strong></label>
								<select name="serviceId" id="serviceId" required class="form-control">
									<option value="">--Select here--</option>
									@foreach($services as $service)
										<option value="{{ $service->id }}">{{ $service->name }}</option>
									@endforeach
								</select>
							</div>

						</div><br>



						<div class="row">
							<div class="col-md-12 col-sm-12">
								<label class="control-label"><strong>Subject</strong></label>
								<input type="text" class="form-control" placeholder="Subject" id="subject" name="subject"
									required />
								<span id="subjecterror"></span>
							</div>

						</div><br>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<label class="control-label"><strong>Description</strong></label>
								<textarea class="form-control" placeholder="Description" id="description" name="description"
									required></textarea>
								<span id="descriptionerror"></span>

							</div>

						</div><br>


                        <div class="modal-footer" style="float: left">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						</div>
						<div class="modal-footer" style="float: right">
							<button style="color: white;" type="submit" class="btn btn-success"><small>Submit
									Enquiry</small></button>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>

@endsection


@section('scripts')
 
@endsection