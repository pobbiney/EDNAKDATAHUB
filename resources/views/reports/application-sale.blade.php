@php 

$pageName = "reports"; 

$subpageName = "reports-application";

@endphp

@extends('layouts.app')


@section('content')
<div class="content">
    <div class="content container-fluid">
				
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Reports</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports Manager</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">Reports Manager</h3>
            <div class="line"></div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h5 class="card-title">Report</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-solid">
                             <li class="nav-item"><a class="nav-link active"  href="#solid-tab3" data-bs-toggle="tab">Application Report</a></li>
                        </ul>
                        <div class="tab-content">
                            

                            <div class="tab-pane show active" id="solid-tab3">
                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">Application Report</h5>
                                            </div>
                                            <div class="card-body">
                                                <form id="form" method="POST">
                                                    @csrf
                                                <div class="table-responsive">
                                                    <table align="center"  class="table table-striped table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="4" align="center"><label>Generate</label></td>
                                                            </tr>
                                                            <tr>
                                                                
                                                               
                                                                <td align="center">
                                                                    
                                                                   <b>Form Type</b>
                                                                   
                                                                </td>
                                                                <td align="center">
                                                                    
                                                                   <b>Start Date</b>
                                                                   
                                                                </td>
                                                                <td align="center">
                                                                    
                                                                   <b>End Date</b>
                                                                   
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                               
                                                                <td>
                                                                   <select class="form-select" name="form_type" id="form_type" required>
                                                                        <option value="">-- SELECT FORM TYPE --</option>
                                                                        @foreach ($applicationForm as $applicationFormItem)
                                                                            <option value="{{ $applicationFormItem->id }}">{{ $applicationFormItem->formName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                   <span id="form_typeerror"></span>
                                                                </td>
                                                                <td><input type="date" name="startdate_two" id="startdate_two" class="form-control" placeholder="Enter Start Date">
                                                                <span id="startdate_twoerror"></span></td>
                                                                <td><input type="date" name="enddate_two" id="enddate_two" class="form-control" placeholder="Enter End Date">
                                                                <span id="enddate_twoerror"></span></td>
                                                               
                                                                <td><button type="submit" name="search_two" id="search_two" class="btn btn-success btn-sm" ><i class="fa fa-list"></i></button> </td>
                                                            </tr>
                                                        </tbody>    
                                                    </table>
                                                    <br>
                                                    <p align="center" style="display:none; color: limegreen;" id="wait_two"><img src="{{ asset('images/spinner-grey.gif')}}" > Please wait....</p>
                                                    <div id="resultTwo"></div>
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



    $(document).on('click','#search_two',function(e){
    e.preventDefault();

       
        $("#form_typeerror").empty();
        $("#enddate_twoerror").empty();
        $("#startdate_twoerror").empty();
    
        
        var startdate_two =$.trim($("#startdate_two").val());
        var enddate_two =$.trim($("#enddate_two").val());
        var formtype  = $.trim($("#form_type").val());

    if (startdate_two.length == 0) {

        $('#startdate_twoerror').html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
        $("html, body").animate({ scrollTop: 0 }, "slow");

    }
    if (enddate_two.length == 0) {

        $('#enddate_twoerror').html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
        $("html, body").animate({ scrollTop: 0 }, "slow");

    }
    if (formtype.length == 0) {

        $('#form_typeerror').html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
        $("html, body").animate({ scrollTop: 0 }, "slow");

    }
    if(formtype.length != 0 && enddate_two.length != 0 && startdate_two.length != 0){

        $('#wait_two').css('display', 'block');

        document.getElementById("search_two").disabled = true;

        $.ajax({
            url:"{{ route('reports-application-sales-process') }}",
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                'startdate':startdate_two,
                'enddate':enddate_two,
                'formtype':formtype
            },
            success:function(data){
                $('#wait_two').css('display', 'none');

                document.getElementById("search_two").disabled = false;

                if ($.trim(data) == "error") {

                    $("#resultTwo").html('<p class="alert alert-danger" align="center">No Records Found</p>');
                    
                }else{

                    $('#resultTwo').html(data);


                }
            }
        });

    }
});
    </script>
@endsection