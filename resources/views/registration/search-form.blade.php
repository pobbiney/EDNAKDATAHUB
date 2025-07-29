@php 
$pageName = "registration"; 
$subpageName = "search_form";
@endphp

@extends('layouts.app')


@section('content')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Registration Form</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-divide mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Registration Form</a></li>
                         
                        <li class="breadcrumb-item active" aria-current="page">New Registration Form</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                    <h3>Search For Application Form </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                               
                                @if (session('message_success'))
                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                @endif
                    
                                @if (session('message_error'))
                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                @endif
                    <div class="row">
                                    
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
                                <br><br/>
                                <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('assets/img/spinner-grey.gif')}}" > Please wait....</p>
                                <div id="result"></div>
                            </div>
                        </form>           
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
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
              url:"{{ route('registration-forms-search-process')}}",
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