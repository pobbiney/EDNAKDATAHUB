@php 

$pageName = "bill-payments"; 

$subpageName = "make_payment";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Finance Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Make Payments</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Finance Management</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5 class="card-title">List Application Forms</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Make Payments</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">

                                @if (session('message_success'))
                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                @endif
                    
                                @if (session('message_error'))
                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                @endif
                                

                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">Process Payments</h5>
                                            </div>
                                            <form id="form" method="POST">
                                                    @csrf
                                                <div class="table-responsive">
                                                    <table align="center"  class="table table-striped table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="4" align="center"><label>Search Forms </label></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    
                                                                    <select id="field" name="field" class="form-select">
                                                                        <option value="applicantName">Applicant Name</option>
                                                                        <option value="tell">Telephone</option>
                                                                        <option value="formNumber">Form number</option>
                                                                        <option value="location">Location</option>
                                                                    </select>
                                                                   
                                                                </td>
                                                                <td>
                                                                    <select id="operator" name="operator" class="form-select">
                                                                        <option value="equal">Equal To ( = )</option>
                                                                        <option value="contain">Contains %</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" class="form-control " id="search_parameter" name="search_parameter" placeholder="Search Parameter"><span id="perror" style="color: red;"></span></td>
                                                                <td><button type="submit" name="find" id="find" class="btn btn-success btn-sm" ><i class="fa fa-list"></i></button> </td>
                                                            </tr>
                                                        </tbody>    
                                                    </table>
                                                    <br>
                                                    <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > Please wait....</p>
                                                    <div id="result"></div>
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
        
    </section>
    <!-- /Tabs -->
        
    
    </div
</div>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <form method="post" autocomplete="off" action="{{ route('process-make-payment-process') }}">
      @csrf
          <div class="modal-dialog" role="document" style="width: 100%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Make Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">

                        

                        <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > fetching information, please wait ....</p>

                        <div class="table-responsive">
                          <div id="listRecords"></div>
                        </div>
                         <hr>
                        <table class="table table-striped table-bordered table-responsive">
                            <tbody>
                                <tr>
                                <td> <label>Amount Paid:</label> <input type="text" class="form-control" id="amountPaid" name="amountPaid" required/></td>
                                <td> <label>Bill Type:</label>
                                    <select required class="form-select" id="bill_type" name="bill_type" required><option value="" selected disabled>--Choose Option--</option>
                                        @foreach ($billTypeList as $billTypeListItem)
                                           <option value="{{ $billTypeListItem->id }}">{{ $billTypeListItem->name }}</option>
                                        @endforeach
                                 
                             
                                  </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td> <label>Payment Mode:</label><select class="form-select" id="payment_mode" name="payment_mode" required><option value="" selected disabled>--Choose Option--</option>
                                     <option value="Cheque">Cheque</option>
                                      <option value="Cash">Cash</option></select>
                                      </td>
                                    </tr>
                                <tr>
                                <td colspan="2"><label>Comment/Cheque No:</label><textarea class="form-control" id="comment" name="comment"></textarea></td>
                                </tr>
                            </tbody>
                         </table>
                         <input type="hidden" id="formId" name="formId">
                        
                        <div class="modal-footer" style="float: right">
                            <button type="button" class="btn btn-danger mb-3" data-bs-dismiss="modal">Close</button>
                            <button style="color: white;" type="submit" class="btn btn-info mb-3"><small>Make Payment</small></button>
                        </div>
                    </div>
                    
                </div>
            </div>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        $(document).on('click','#makePaymentBtn',function(e){
            e.preventDefault();

            $('#listRecords').empty();

            let formsID = $(this).data('id');

            $('#formId').val(formsID);

            $("#wait").css("display","block");

            document.getElementById("makePaymentBtn").disabled = true;


            $.ajax({
            type:"POST",
            url:"{{ route('process-make-payment-fetch-info') }}",
            data:{
                "_token": "{{ csrf_token() }}",
                'formsID': formsID
            },
            success:function (d) {

                console.log(d);

                $("#wait").css("display","none");

                document.getElementById("makePaymentBtn").disabled = false;

                $('#listRecords').html(d);

                
            }

            });
  
        });
    </script>

    <script>
    $(document).on("click","#find",function(e){
      e.preventDefault();
      $("#perror").empty();
      document.getElementById("find").disabled = true;

      $("#wait").css("display","block");
      var parameter  = $("#search_parameter").val();
      var form  = $("#form").serialize();
      if(parameter === ''){
        document.getElementById("find").disabled = false;
          $("#perror").html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
          $("html, body").animate({ scrollTop: 0 }, "slow");
          $("#wait").css("display","none");
      }
      else{

          $.ajax({
              type:"POST",
              url:"{{ route('search-make-payment-process')}}",
              data:form,
              success: function (d) {

                console.log(d);

                   document.getElementById("find").disabled = false;

                  if(d === "no_data"){
                      $("#result").html('<p class=" alert alert-danger" align="center"> Sorry no data found.</p>');
                      $("html, body").animate({ scrollTop: 0 }, "slow");
                      $("#wait").css("display","none");
                  }
                  else{
                      $("#result").html(d);
                      $("html, body").animate({ scrollTop: 0 }, "slow");
                      $("#wait").css("display","none");
                  }
              }
          });
      }
  });
</script> 
@endsection