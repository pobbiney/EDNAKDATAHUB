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
                                            <h5 class="mt-2">{{$project->contact_person ?? 'N/A'}}</h5>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Project Name: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->proponent_name ?? 'N/A'}}</h5>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Address: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->address ?? 'N/A'}}</h5>
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
                                            <h5 class="mt-2">{{$project->getDistrict->name ?? 'N/A'}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Region: </label>
                                        <div class="col-lg-8">
                                            <h5 class="mt-2">{{$project->getRegion->name ?? 'N/A'}}</h5>
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
                                    <li class="submenu-open">
                                        <ul>
                                            <li data-target="content1">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-settings fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Project Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content2">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-world fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Infrastructure Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content3">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-device-mobile fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Environment Impact Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content4">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-device-desktop fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Concerns Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content5">
                                                <a href="javascript:void(0);">
                                                    <i class="ti ti-settings-dollar fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Management Impact Tab</span>
                                                </a>
                                            </li>
                                            <li data-target="content6">
                                                <a href="javascript:void(0);" class="active subdrop">
                                                    <i class="ti ti-settings-2 fs-18"></i>
                                                    <span class="fs-14 fw-medium ms-2">Impact Assessment</span>
                                                </a>
                                            </li>
                                        </ul>
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
                                                            <label class="col-lg-4 col-form-label"><h6>Title of the Project:</h6>
                                                            </label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->project_title ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Sector Project: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->sector->name ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Project Category:</h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->category->name ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Type of Project: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->type->name ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label"><h6>Description of the proposed project:</h6>
                                                            </label>
                                                            <p class="mt-1">{{$project->project_description}}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label"><h6>Scope of the proposed Project: </h6></label>
                                                        <p class="mt-1">{{$project->scope}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Plot/House No: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->plot_number}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Street Name: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->street_name ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>GPS Address: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->gps ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Town: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->town ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>Region: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->getRegion->name ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label"><h6>District: </h6></label>
                                                            <div class="col-lg-8">
                                                                <p class="mt-1">{{$project->getDistrict->name ?? 'N/A'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label"><h6>Major Landmark(If any)</h6></label>
                                                        <p class="mt-1">{{$project->landmark ?? 'N/A'}}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label"><h6>Adjacent Land Uses(Existing)</h6></label>
                                                        <p class="mt-1">{{$project->land_uses ?? 'N/A'}}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label"><h6>Site description (immediate activities andadjacent)</h6></label>
                                                        <p class="mt-1">{{$project->site_description ?? 'N/A'}}</p>
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
                                            <h5 class="card-title">Infrastructure </h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3">This section provides information about the project's infrastructure, including access to water, electricity, and other vital services.</p>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Structures on the site</h6></label>
                                                    <p class="mt-1">{{$project->structures ?? 'N/A'}}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Access to water (source, quantity)</h6></label>
                                                     <p class="mt-1">{{$project->water ?? 'N/A'}}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Access to power (type, source,quantity)</h6></label>
                                                    <p class="mt-1">{{$project->power ?? 'N/A'}}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Drainage provision in the project area</h6>
                                                    </label>
                                                     <p class="mt-1">{{$project->drainage ?? 'N/A'}}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Nearness to water body</h6></label>
                                                      <p class="mt-1">{{$project->water_body ?? 'N/A'}}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Access to road to project site </h6></label>
                                                    <p class="mt-1">{{$project->road_access ?? 'N/A'}}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><h6>Other major utilities proposed or existing on site </h6></label>
                                                    <p class="mt-1">{{$project->other ?? 'N/A'}}</p>
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
                                            <h5 class="card-title">Environmental Impacts </h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-3">Potential environmental impacts of proposed undertaking (both
                                                constructional and operational phases)</p>
                                            
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <h6>Construction Phase</h6>
                                                </div>
                                                <div class="col-xl-6">
                                                    <h6>Operational Phase</h6>
                                                </div>
                                            </div>
                                            @foreach($envImpact as $item)
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <div class="col-lg-10">
                                                                <p>{{$item->construction_impact}}</p>
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <div class="col-lg-10">
                                                                <p>{{$item->operational_impact}}</p>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                  
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
                                                                        <th><h6>Full Name</h6></th>
                                                                        <th><h6>Telephone</h6></th>
                                                                        <th><h6>Location to Project</h6></th>
                                                                        <th><h6>Concern/Issue</h6></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     @if($impactMgt->count() > 0)
                                                                    @foreach($concerns as $item)
                                                                        <tr>
                                                                            <td><p>{{$loop->iteration}}</p></td>
                                                                            <td><p>{{$item->full_name}}</p></td>
                                                                            <td><p>{{$item->telephone}}</p></td>
                                                                            <td><p>{{$item->location}}</p></td>
                                                                            <td><p>{{$item->concern}}</p></td>
                                                                           
                                                                        </tr>
                                                                    @endforeach
                                                                    @else
                                                                        <div class="row">
                                                                            <h6>N/A</h6>
                                                                        </div>
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
                        <div id="content5" class="displayContent">
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Management of Impacts </h5>
                                        </div>
                                        <div class="card-body">
                                         <div class="row mb-2">
                                                <div class="col-xl-12">
                                                    <h5>Construction Phase</h5>
                                                </div>
                                        </div>
                                        @if($impactMgt->count() > 0)
                                            @foreach($impactMgt as $item)
                                                <div class="row">
                                                    <h6>{{$item->construction_impact}}</h6>
                                                    <li>{{$item->impact_mgt->construction_mgt}}</li>
                                                </div>
                                            @endforeach
                                             @else
                                         <div class="row">
                                                <h6>N/A</h6>
                                            </div>
                                        @endif
                                        <div class="row mt-3 mb-2">
                                                <div class="col-xl-12">
                                                    <h5>Operational Phase</h5>
                                                </div>
                                        </div>
                                         @if($impactMgt->count() > 0)
                                            @foreach($impactMgt as $item)
                                                <div class="row">
                                                    <h6>{{$item->operational_impact}}</h6>
                                                    <li>{{$item->impact_mgt->operational_mgt}}</li>
                                                </div>
                                            @endforeach
                                         @else
                                         <div class="row">
                                                <h6>N/A</h6>
                                            </div>
                                        @endif
                                            
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
                                            <h5 class="card-title">Impact Assessment </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label"><h6>Evaluation of the significance of the identified impacts, considering factors like the magnitude, duration, and extent of the impact</h6>
                                                </label>
                                                <p class="mt-1">{{$listscreen->evaluation ?? 'N/A'}}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><h6>Categorization of the project based on the severity of its environmental impacts, determining whether it requires further environmental assessment</h6>
                                                </label>
                                                <p class="mt-1">{{$listscreen->getdecision->name ?? 'N/A'}}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><h6>Suggestions for appropriate mitigation measures to minimize negative impacts and enhance positive impacts, as well as recommendations for further environmental assessment if necessary.</h6>
                                                </label>
                                                 <p class="mt-1">{{$listscreen->recommendation ?? 'N/A'}}</p>
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