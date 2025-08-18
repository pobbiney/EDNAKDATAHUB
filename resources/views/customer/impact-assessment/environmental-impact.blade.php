@extends('customer.template.layout')


@section('title')
    {{__('Environmental Impacts')}}
@endsection

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Environmental Impacts</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-divide mb-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Impact Assessment</a></li>
                            <li class="breadcrumb-item"><a href="#">Environmental Impacts</a></li>
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
                                <h5 class="card-title">Environmental Impacts </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('customer-store-environmental-impact', Crypt::encrypt($decodeId))}}"
                                    method="POST">
                                    @csrf
                                    <button type="button" id="add-impact" class="btn btn-info float-end">Add Environmental
                                        Impact</button>
                                    <p class="mb-3">Potential environmental impacts of proposed undertaking (both
                                        constructional and operational phases)</p>

                                    {{-- @if(count($impactData) > 0)

                                        <div class="row">
                                            <h5>Saved Environmental Impacts</h5>
                                            <div class="col-xl-6">
                                                <h6>Construction Phase</h6>
                                            </div>
                                            <div class="col-xl-6">
                                                <h6>Operational Phase</h6>
                                            </div>
                                        </div>
                                        @foreach($impactData as $item)
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-9">
                                                            <textarea class="form-control" cols="30" rows="2"
                                                                disabled>{{$item->construction_impact}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-9">
                                                            <textarea class="form-control" cols="30" rows="2"
                                                                disabled>{{$item->operational_impact}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif --}}


                                    <div class="row">
                                        <div class="col-xl-6">
                                            <h6>Construction Phase</h6>
                                        </div>
                                        <div class="col-xl-6">
                                            <h6>Operational Phase</h6>
                                        </div>
                                    </div>
                                    <div id="impacts-wrapper">
                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="impact-group">
                                                <div class="row">
                                                    <div class="col-xl-5">
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <textarea name="impacts[{{ $i }}][impact]" class="form-control"
                                                                    cols="30" rows="2" required></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5">
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <textarea name="impacts[{{ $i }}][operational_impact]"
                                                                    class="form-control" cols="30" rows="2" required></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($i > 1)
                                                        <div class="col-xl-2">
                                                            <button type="button" class="btn btn-link text-danger remove-impact">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    @endif


                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Save Impacts</button>
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
        let impactIndex = 3;

        document.getElementById('add-impact').addEventListener('click', function () {
            const wrapper = document.getElementById('impacts-wrapper');

            const newGroup = document.createElement('div');
            newGroup.classList.add('impact-group');

            newGroup.innerHTML = `
                <div class="row">
                    <div class="col-xl-5">
                        <div class="row mb-3">
                            <div class="col-lg-9">
                                <textarea name="impacts[\${impactIndex}][impact]" class="form-control" cols="30" rows="2"  required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="row mb-3">
                            <div class="col-lg-9">
                                <textarea name="impacts[\${impactIndex}][operational_impact]" class="form-control" cols="30" rows="2"  required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <button type="button" class="btn btn-link text-danger remove-impact">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;

            wrapper.appendChild(newGroup);
            impactIndex++;
        });


        document.getElementById('impacts-wrapper').addEventListener('click', function (e) {
            if (e.target.closest('.remove-impact')) {
                e.target.closest('.impact-group').remove();
            }
        });
    </script>



@endsection