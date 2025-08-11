 @php 
    $pageName = "registration";
    $subpageName = "my_application";
@endphp

@extends('layouts.app')

@section('css')

<style>
    .displayContent {
        display: none;
    }

    .displayContent.active {
        display: block;
    }
</style>


@section('content')

    <div class="content">
          @if (session('message_success'))
        <p class="alert alert-success" align="center" style="color:green">{{session('message_success')}}</p>
        @endif

        @if (session('message_error'))
        <p class="alert alert-danger" align="center" style="color: red">{{session('message_error')}}</p>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Project Description</h5>
                    </div>
                    <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Applicant: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->contact_person ?? ''}}</h5>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Project Name: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->proponent_name ?? ''}}</h5>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Address: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->address ?? ''}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Telephone:</label>
                                        <div class="col-lg-8">
                                             <h5 class="mt-2">{{$project->contact_number}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Email: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->email}}</h5>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Position/Role: </label>
                                        <div class="col-lg-8">
                                             <h5 class="mt-2">{{$project->position}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Town: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->town}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">District: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->getDistrict->name ?? ''}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Region: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->getRegion->name ?? ''}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                           
                    
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="settings-wrapper d-flex">
                    <div class="settings-sidebar" id="sidebar2">
                        <div class="sidebar-inner">
                            <div id="sidebar-menu5" class="sidebar-menu">
                                 <ul>
                                            <li data-target="content1">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-settings fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Project Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content2">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-file fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Document Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content3">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-world fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Infrastructure Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content4">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-device-mobile fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Environment Impact Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content5">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-device-desktop fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Concerns Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content6">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-settings-dollar fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Management Impact Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content7">
                                                <a href="javascript:void(0);" class="active subdrop">
                                                    <i class="ti ti-settings-2 fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Impact Assessment</span>
                                                </a>
                                            </li>
                                            <li data-target="content8">
                                                <a href="javascript:void(0);" class="active subdrop">
                                                    <i class="ti ti-settings-2 fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Review Application</span>
                                                </a>
                                            </li>
                                        </ul>
                            </div>
                        </div>
                    </div>
                    <div id="tab-content">
                        <div id="content1" class="displayContent active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Project</h5>
                                        </div>
                                        <div class="card-body">
                                             <p class="mb-3">This tab provides information about the project, including its title, type, and sector, as well as the project's description,scope and other information.</p>
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Title of the Project:
                                                            </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->project_title ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Sector Project: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->sector->name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Project Category:</label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->category->name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Type of Project: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->type->name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Description of the proposed
                                                            Project:</label>
                                                            <h5 class="mt-2">{{$project->project_description}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Scope of the proposed Project:</label>
                                                        <h5 class="mt-2">{{$project->scope}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Plot/House No: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->plot_number}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Street Name: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->street_name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">GPS Address: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->gps ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Town: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->town ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Region: </label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->getRegion->name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">District:</label>
                                                            <div class="col-lg-8">
                                                                <h5 class="mt-2">{{$project->getDistrict->name ?? ''}}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Major Landmark(If any)</label>
                                                        <h5 class="mt-2">{{$project->landmark ?? ''}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Adjacent Land Uses(Existing)</label>
                                                        <h5 class="mt-2">{{$project->land_uses ?? ''}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Site description (immediate activities and
                                                            adjacent)</label>
                                                            <h5 class="mt-2">{{$project->site_description ?? ''}}</h5>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div id="content2" class="displayContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Documents </h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3">
                                                This tab allows you to preview all the documents that have been uploaded.
                                            </p>
                                                    <div class="col-xl-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Upload Type</th>
                                                                        <th>Document Type</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if($documents->count() > 0)
                                                                    @foreach($documents as $document)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$document->uploadType}}</td>
                                                                            <td>{{$document->drawname->name}}</td>
                                                                            <td>{{ \Carbon\Carbon::parse($document->createdOn)->format('M d,Y') }}</td>
                                                                            <td ><a target="_blank" href="{{$document->path}}"  class="btn btn-success btn-sm"><i class="fas fa-file"></i> View File</a></td>
                                                                        </tr>
                                                                    @endforeach
                                                                    @else
                                                                        <tr>
                                                                            <td colspan="5" class="text-center">No documents uploaded yet</td>
                                                                        </tr>
                                                                    @endif
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content3" class="displayContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Infrastructure </h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3">This section provides information about the project's infrastructure, including access to water, electricity, and other vital services.</p>
                                                <div class="mb-3">
                                                    <label class="form-label">Structures on the site</label>
                                                    <h5 class="mt-2">{{$project->structures ?? ''}}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Access to water (source, quantity)</label>
                                                    <h5 class="mt-2">{{$project->water ?? ''}}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Access to power (type, source,
                                                        quantity)</label>
                                                        <h5 class="mt-2">{{$project->power ?? ''}}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Drainage provision in the project area
                                                    </label>
                                                    <h5 class="mt-2">{{$project->drainage ?? ''}}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nearness to water body</label>
                                                    <h5 class="mt-2">{{$project->water_body ?? ''}}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Access to road to project site </label>
                                                    <h5 class="mt-2">{{$project->road_access ?? ''}}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Other major utilities proposed or existing on
                                                        site </label>
                                                        <h5 class="mt-2">{{$project->other ?? ''}}</h5>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content4" class="displayContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Environmental Impacts </h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3">Potential environmental impacts of proposed undertaking (both
                                                constructional and operational phases)</p>
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <h6>Construction Phase</h6>
                                                          <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <h6>Operational Phase</h6>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <h5 class="mt-2"></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content5" class="displayContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Concerns </h5>
                                        </div>
                                        <div class="card-body">
                                            {{-- <p class="mb-3">
                                                Views of immediate adjourning neighbor’s and relevant stakeholders (if applicable provide evidence of consultation to facilitate identification of key issues/impacts)
                                            </p> --}}
                                            
                                               
                                                    <div class="col-xl-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Full Name</th>
                                                                        <th>Telephone</th>
                                                                        <th>Location to Project</th>
                                                                        <th>Concern/Issue</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content6" class="displayContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Management of Impacts </h5>
                                        </div>
                                        <div class="card-body">
                                             <p class="mb-3 text-white">
                                                Impact provided by the applicant and management of that impact Impact provided by the applicant and management of that impact
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <h6>Construction Phase</h6>
                                                          <div class="row mb-3">
                                                            <div class="col-lg-12">
                                                                <h5 class="mt-2">---</h5>
                                                                <textarea name="" id="" cols="3" class="form-control" disabled></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <h6>Operational Phase</h6>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-12">
                                                                <h5 class="mt-2">----</h5>
                                                                <textarea name="" id="" cols="3" class="form-control" disabled></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content7" class="displayContent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Impact Assessment </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Evaluation of the significance of the identified impacts, considering factors like the magnitude, duration, and extent of the impact
                                                </label>
                                                <h5 class="mt-2">{{$listscreen->evaluation ?? ''}}</h5>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Categorization of the project based on the severity of its environmental impacts, determining whether it requires further environmental assessment
                                                </label>
                                                <h5 class="mt-2">{{$listscreen->getdecision->name ?? ''}}</h5>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Suggestions for appropriate mitigation measures to minimize negative impacts and enhance positive impacts, as well as recommendations for further environmental assessment if necessary.
                                                </label>
                                                <h5 class="mt-2">{{$listscreen->recommendation ?? ''}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div id="content8" class="displayContent">
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Review Application Tab </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                    <label class="form-label">Evaluation</label>
                                                    <h4 class="mt-2"></h4>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Screening Decision /Recommendation</label>
                                                    <h4 class="mt-2"></h4>
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

@endsection

@section('scripts')

    <script>
        const items = document.querySelectorAll("#sidebar-menu5 li[data-target]");
        const contents = document.querySelectorAll("#tab-content .displayContent");

        items.forEach(item => {
            item.addEventListener("click", () => {
                const targetId = item.getAttribute("data-target");

                contents.forEach(content => content.classList.remove("active"));

                const target = document.getElementById(targetId);
                if (target) {
                    target.classList.add("active");
                } else {
                    console.warn("No element found with ID:", targetId);
                }
            });
        });

    </script>

@endsection