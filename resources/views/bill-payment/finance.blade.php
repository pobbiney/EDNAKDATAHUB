@php 

$pageName = "bill-payments"; 

$subpageName = "bill-payments-finance";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Project Finance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Search Form</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Search Form</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                   
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Project Finance</a></li>
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
                                                <h5 class="card-title">Search Forms</h5>
                                            </div>
                                            <div class="card-body">
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
                                                                        <option value="proponent_name">Proponent Name</option>
                                                                        <option value="contact_number">Telephone</option>
                                                                        <option value="town">Town</option>
                                                                        <option value="project_title">Project Title</option>
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
        </div>
        
    </section>
    <!-- /Tabs -->
        
    
    </div
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
              url:"{{ route('finance-forms-search-process')}}",
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