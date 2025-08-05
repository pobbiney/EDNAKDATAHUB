@php 

$pageName = "task"; 

$subpageName = "job_tracker";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Task Manager</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                         <li class="breadcrumb-item active">Task Manager</li>
                        <li class="breadcrumb-item active">Job Tracker</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       <!-- Tabs -->
       <section class="comp-section">
        {{-- <div class="section-header">
            <h3 class="section-title">Job Tracker</h3>
            <div class="line"></div>
        </div> --}}

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    
                    <div class="card-body">
                       
                        <div class="tab-content">
                            <div class="tab-pane show active" id="solid-tab2">

                                @if (session('message_success'))
                                <p class="alert alert-success" align="center">{{session('message_success')}}</p>
                                @endif
                    
                                @if (session('message_error'))
                                <p class="alert alert-danger" align="center">{{session('message_error')}}</p>
                                @endif
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card bg-white">
                                            <div class="card-header">
                                                <h5 class="card-title">Job Tracker</h5>
                                            </div>
                                            <div class="card-body">
                                                
                                                <div class="tab-content">
                                                    <div class="tab-pane show active" id="solid-tab1">
                                                        <div class="row">
                                                            <div class="col-xl-12 d-flex">
                                                                <div class="card flex-fill">
                                                                    <div class="card-header">
                                                                        <h5 class="card-title">Search  Applications</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                    
                                                                        <div class="table-responsive">
                                                                            <form id="form" method="POST">
                                                                                @csrf
                                                                                <table   class="table table-striped mb-0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="4" align="center"><label><b>Search   Application</b> </label></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                
                                                                                                <select id="field" name="field" class="form-select">
                                                                                                    <option value="applicantName" >Name of Proponent</option>
                                                                                                    <option value = "tell">Telephone Number</option>
                                                                                                    <option value = "serialNumber"> Serial Number</option>
                                                                                                    
                                                                                                </select>
                                                                                            
                                                                                            </td>
                                                                                            <td>
                                                                                                <select id="operator" name="operator" class="form-select">
                                                                                                    <option value="contain">Contains %</option>
                                                                                                    <option value="equal">Equal To ( = )</option>
                                                                                                    
                                                                                                </select>
                                                                                            </td>
                                                                                            <td><input type="text" class="form-control " id="search_parameter" name="search_parameter" placeholder="Search Parameter"><span id="perror" style="color: red;"></span></td>
                                                                                            <td><button type="submit" name="find" id="find" class="btn btn-success btn-sm" ><i class="fa fa-search"></i>  Search</button> </td>
                                                                                        </tr>
                                                                                    </tbody>    
                                                                                </table>
                                                                                
                                                                            </form>
                                                                            <br>
                                                                            <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" >Please wait....</p>
                                                                        <br/><br/>
                                                                            <div id="result"></div>   
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
    $('#dob').datepicker({
       format: "yyyy-mm-dd",
       autoclose: true
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
          $("#perror").html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
          $("html, body").animate({ scrollTop: 0 }, "slow");
          $("#wait").css("display","none");
      }
      else{

          $.ajax({
              type:"POST",
              url:"{{route('task.searchJobTrackerProcess')}}",
              data:form,
              success: function (d) {

                   document.getElementById("find").disabled = false;

                  if(d === "no data"){
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