@php 

$pageName = "reports"; 

$subpageName = "forms-report";

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
                            <li class="nav-item"><a class="nav-link active"  href="#solid-tab2" data-bs-toggle="tab">Certificate</a></li>
                             <li class="nav-item"><a class="nav-link"  href="#solid-tab3" data-bs-toggle="tab">Permit</a></li>
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
                                                <h5 class="card-title">Certificate</h5>
                                            </div>
                                            <div class="card-body">
                                                <form id="form" method="POST">
                                                    @csrf
                                               <div class="table-responsive">
                                                    <table align="center"  class="table table-striped table-bordered" style="width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="4" align="center"><label>Certificate</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">
                                                                    
                                                                   <b>Select Year</b>
                                                                   
                                                                </td>
                                                               
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                   <select class="form-select" name="year" id="year" required>
                                                                        <option value="" selected disabled>-- SELECT YEAR --</option>
                                                                        <?php for($i=date('Y'); $i>=2000; $i--){?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                   <span id="yearerror"></span>
                                                                </td>
                                                               
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

                            <div class="tab-pane show" id="solid-tab3">
                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                <h5 class="card-title">Monthly Report</h5>
                                            </div>
                                            <div class="card-body">
                                                <form id="form" method="POST">
                                                    @csrf
                                                <div class="table-responsive">
                                                    <table align="center"  class="table table-striped table-bordered" style="width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="4" align="center"><label>Generate</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">
                                                                    
                                                                   <b>Select Year</b>
                                                                   
                                                                </td>
                                                               
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                   <select class="form-select" name="year_two" id="year_two" required>
                                                                        <option value="" selected disabled>-- SELECT YEAR --</option>
                                                                        <?php for($i=date('Y'); $i>=2000; $i--){?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                   <span id="year_twoerror"></span>
                                                                </td>
                                                               
                                                                <td><button type="submit" name="findTwo" id="findTwo" class="btn btn-success btn-sm" ><i class="fa fa-list"></i></button> </td>
                                                            </tr>
                                                        </tbody>    
                                                    </table>
                                                    <br>
                                                    <p align="center" style="display: none; color: limegreen;" id="waitTwo"><img src="{{ asset('images/spinner-grey.gif')}}" > Please wait....</p>
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

    $(document).on('click','#find',function(e){
    e.preventDefault();

        $("#yearerror").empty();
       
        

        var year  = $.trim($("#year").val());
       
 

    if (year.length == 0) {

        $('#yearerror').html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
        $("html, body").animate({ scrollTop: 0 }, "slow");

    }else{

        $('#wait').css('display', 'block');
        

        document.getElementById("find").disabled = true;

        $.ajax({
            url:"{{ route('reports-turnovercertificate-year-general-process') }}",
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                'year':year
            },
            success:function(data){
                $('#wait').css('display', 'none');

                console.log(data);

                document.getElementById("find").disabled = false;

                if ($.trim(data) == "error") {

                    $("#result").html('<p class="alert alert-danger" align="center">No Records Found</p>');
                    
                }else{

                    $('#result').html(data);


                }
            }
        });

    }
});
    
</script>



  <script>

    $(document).on('click','#findTwo',function(e){
    e.preventDefault();

        $("#year_twoerror").empty();
       
        

        var year  = $.trim($("#year_two").val());
       
 

    if (year.length == 0) {

        $('#year_twoerror').html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
        $("html, body").animate({ scrollTop: 0 }, "slow");

    }else{

        $('#waitTwo').css('display', 'block');
        

        document.getElementById("findTwo").disabled = true;

        $.ajax({
            url:"{{ route('reports-turnoverpermit-year-general-process') }}",
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                'year':year
            },
            success:function(data){
                $('#waitTwo').css('display', 'none');

                document.getElementById("findTwo").disabled = false;

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