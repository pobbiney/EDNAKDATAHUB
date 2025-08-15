@extends('customer.template.layout')


@section('title')
{{__('Attach Document')}}
@endsection


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Registration Form</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Application </a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">Document Attachment</li>
                    </ol>
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
                    <h3>List Completed Applications</h3>
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
                                                    <th>Proponent Name</th>
                                                    <th>City</th>
                                                    <th>Address</th>
                                                    <th>Contact</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @php
                                                $i=1;
                                                @endphp
                                                @foreach ($listApp as $list)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$list->appname->applicantName ?? 'N/A'}}</td>
                                                    <td>{{$list->proponent_name ?? 'N/A'}}</td>
                                                    <td>{{$list->city ?? 'N/A'}}</td>
                                                    <td>{{$list->address ?? 'N/A'}}</td>
                                                    <td>{{$list->contact_number ?? 'N/A'}}</td>
                                                   
                                                        
                                                        <td>
                                                             <span class="badge badge-success d-flex align-items-center badge-xs"> Completed</span>
                                                        </td>
                                                        <td>   <button data-bs-toggle="modal" data-id="{{ $list->id }}" id="showmodal"  data-bs-target="#standard-modal" class="btn btn-warning"><i class="fe fe-upload"></i> Attach Document</button></td>
                                                    
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
@include('customer.registration.document-attachment-modal')
@endsection

@section('scripts')
<script>
    $(document).on('click','#showmodal',function(e){
        e.preventDefault();

        $('#listRecords').empty();

        let formsID = $(this).data('id');

        $('#formID').val(formsID);

        $("#wait").css("display","block");

        document.getElementById("showmodal").disabled = true;


         $.ajax({
        type:"POST",
        url:"{{ route('customer-application-attach-drawings-get-forms') }}",
        data:{
            "_token": "{{ csrf_token() }}",
            'formsID': formsID
        },
        success:function (d) {

            $("#wait").css("display","none");

            document.getElementById("showmodal").disabled = false;

            $('#listRecords').html(d);

            
        }

        });
    });
</script>
@endsection