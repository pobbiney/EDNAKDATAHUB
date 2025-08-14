 <meta http-equiv="refresh" content="3;url={{ $redirectUrl }}">
@extends('customer.template.layout')


@section('title')
{{__('Applications')}}
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
                    <h3>Permit Application Form </h3>
            </div> 
        </div>
        <div class="card-body">
             
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">     
                   <div class="alert alert-success overflow-hidden p-0" role="alert">
                    <div class="p-3 bg-success text-fixed-white d-flex justify-content-between">
                        <h3 class="aletr-heading mb-0 text-fixed-white">Success Message.</h3>
                        <button type="button" class="btn-close p-0 text-fixed-white" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
                    </div>
                    <hr class="my-0">
                    <div class="p-3">
                        <h4 class="mb-0">Application completed successfully! You’ll be redirected shortly to continue... <a   class="fw-semibold text-decoration-underline text-primary">Redirecting in <span id="countdown">5</span> seconds...</a></h4>
                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
  <script>
        let count = 5;
        const countdown = document.getElementById('countdown');
        const interval = setInterval(() => {
            count--;
            countdown.textContent = count;
            if (count === 0) clearInterval(interval);
        }, 1000);
    </script>
@endsection