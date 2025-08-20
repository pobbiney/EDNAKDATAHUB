@php 

$pageName = "impact"; 

$subpageName = "impact_assessment";

@endphp

@extends('layouts.app')

@section('css')
    <style>
        .my-mr-1 {
            margin-right: 4px;
        }
    </style>
@endsection


@section('content')

    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Concerns</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-divide mb-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Impact Assessment</a></li>
                            <li class="breadcrumb-item"><a href="#">Concerns</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /product list -->
        @if (session('message_success'))
            <p class="alert alert-success" align="center" style="color:green"><b>{{session('message_success')}}</b></p>
        @endif

        @if (session('message_error'))
            <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Concerns </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('store-neighbour-concerns', Crypt::encrypt($decodeId))}}"
                                    method="POST">
                                    @csrf
                                    <button type="button" id="add-concern" class="btn btn-info float-end">Add
                                        Concern</button>
                                    <p class="mb-3">Views of immediate adjourning neighbour's and relevant stakeholders (if
                                        applicable provide evidence of consultation to facilitate identification of key
                                        issues/impacts)</p>

                                    <div class="row">
                                        <div class="col-xl-3">
                                            <h6>Full Name</h6>
                                        </div>
                                        <div class="col-xl-2">
                                            <h6>Telephone</h6>
                                        </div>
                                        <div class="col-xl-2">
                                            <h6>Location to Project</h6>
                                        </div>
                                        <div class="col-xl-4">
                                            <h6>Concern/Issue</h6>
                                        </div>
                                    </div>
                                    <div id="concerns-wrapper">
                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="concern-group">
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        <div class="row mb-2 my-mr-1">
                                                            <input type="text" name="concerns[{{ $i }}][fullname]" required
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <div class="row mb-2 my-mr-1">
                                                            <input type="text" name="concerns[{{ $i }}][telephone]" required
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <div class="row mb-2 my-mr-1">
                                                            <input type="text" name="concerns[{{ $i }}][location]" required
                                                                class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4">
                                                        <div class="row mb-2 my-mr-1">
                                                            <textarea name="concerns[{{ $i }}][concern]"
                                                                class="form-control" cols="30" rows="2" required></textarea>
                                                        </div>
                                                    </div>
                                                    @if($i > 1)
                                                        <div class="col-xl-1 p-3">
                                                            <button type="button" class="btn btn-link text-danger remove-concern">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    @endif


                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Save</button>
                                </form>
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
        let concernIndex = 3;

        document.getElementById('add-concern').addEventListener('click', function () {
            const wrapper = document.getElementById('concerns-wrapper');

            const newGroup = document.createElement('div');
            newGroup.classList.add('concern-group');

            newGroup.innerHTML = `
                <div class="row">
                    <div class="col-xl-3">
                        <div class="row mb-2 my-mr-1">
                             <input type="text" name="concerns[\${concernIndex}][fullname]" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-xl-2">
                         <div class="row mb-2 my-mr-1">
                             <input type="text" name="concerns[\${concernIndex}][telephone]" required class="form-control" />
                        </div>
                    </div>
                     <div class="col-xl-2">
                         <div class="row mb-2 my-mr-1">
                             <input type="text" name="concerns[\${concernIndex}][location]" required class="form-control" />
                        </div>
                    </div>
                     <div class="col-xl-4">
                         <div class="row mb-2 my-mr-1">
                              <textarea name="concerns[\${concernIndex}][concern]" class="form-control" cols="30" rows="2"  required></textarea>
                          
                        </div>
                    </div>
                    <div class="col-xl-1">
                        <button type="button" class="btn btn-link text-danger remove-concern">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;

            wrapper.appendChild(newGroup);
            concernIndex++;
        });


        document.getElementById('concerns-wrapper').addEventListener('click', function (e) {
            if (e.target.closest('.remove-concern')) {
                e.target.closest('.concern-group').remove();
            }
        });
    </script>



@endsection
