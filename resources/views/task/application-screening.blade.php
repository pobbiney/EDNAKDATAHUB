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
                                            <input type="text" value="{{$project->contact_person ?? ''}}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Project Name: </label>
                                        <div class="col-lg-8">
                                            <input type="text" value="{{$project->proponent_name ?? ''}}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Address: </label>
                                        <div class="col-lg-8">
                                            <input type="text" value="{{$project->address ?? ''}}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Telephone:</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" value="{{$project->contact_number}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Email: </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" value="{{$project->email}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Position/Role: </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" value="{{$project->position}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Town: </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" value="{{$project->town}}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">District: </label>
                                        <div class="col-lg-8">
                                            <input type="text" value="" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Region: </label>
                                        <div class="col-lg-8">
                                            <input type="text" value="{{$project->getRegion->name ?? ''}}" class="form-control" 
                                                disabled>
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
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Title of the Project:
                                                            </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" value="{{$project->project_title ?? ''}}"
                                                                    class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Sector Project: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Project Category:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Type of Project: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Description of the proposed
                                                            Project:</label>
                                                        <textarea class="form-control" rows="3"
                                                            disabled>{{$project->project_description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Scope of the proposed Project:</label>
                                                        <textarea class="form-control" rows="3"
                                                            disabled>{{$project->scope}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Plot/House No: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control"
                                                                    value="{{$project->plot_number}}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Street Name: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" value="{{$project->street_name ?? ''}}"
                                                                    class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">GPS Address: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control"
                                                                    value="{{$project->gps ?? ''}}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Town: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control"
                                                                    value="{{$project->town ?? ''}}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">Region: </label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control"
                                                                    value="{{$project->getRegion->name ?? ''}}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="row mb-3">
                                                            <label class="col-lg-4 col-form-label">District:</label>
                                                            <div class="col-lg-8">
                                                                <input type="text" class="form-control"
                                                                    value="{{$project->getDistrict->name ?? ''}}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Major Landmark(If any)</label>
                                                        <input type="text" rows="3" class="form-control"
                                                            value="{{$project->landmark ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Adjacent Land Uses(Existing)</label>
                                                        <textarea rows="3" class="form-control"
                                                            disabled> {{$project->land_uses ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Site description (immediate activities and
                                                            adjacent)</label>
                                                        <textarea rows="3" class="form-control"
                                                            disabled>{{$project->site_description ?? ''}} </textarea>
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
                                                <div class="mb-3">
                                                    <label class="form-label">Structures on the site</label>
                                                    <input type="text" class="form-control" value="{{$project->structures ?? ''}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Access to water (source, quantity)</label>
                                                    <input type="text" class="form-control" value="{{$project->water ?? ''}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Access to power (type, source,
                                                        quantity)</label>
                                                    <input type="email" class="form-control" value="{{$project->power ?? ''}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Drainage provision in the project area
                                                    </label>
                                                    <input type="text" class="form-control" value="{{$project->drainage ?? ''}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nearness to water body</label>
                                                    <input type="text" class="form-control" value="{{$project->water_body ?? ''}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Access to road to project site </label>
                                                    <input type="text" class="form-control" value="{{$project->road_access ?? ''}}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Other major utilities proposed or existing on
                                                        site </label>
                                                    <input type="text" class="form-control" value="{{$project->other ?? ''}}" disabled>
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
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <h6>Construction Phase</h6>
                                                          <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="password" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <h6>Operational Phase</h6>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-9">
                                                                <input type="password" class="form-control">
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
                        <div id="content4" class="displayContent"></div>
                        <div id="content5" class="displayContent"></div>
                        <div id="content6" class="displayContent">
                            <div class="row">
                               
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Impact Assessment Page</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Evaluation of the significance of the identified impacts, considering factors like the magnitude, duration, and extent of the impact. </p>
                                            <div class="mb-3">
                                                <textarea class="form-control" name="evaluation"></textarea>
                                                  @error('type') <small style="color:red"> {{ $message}}</small> @enderror
                                            </div>
                                            <h4>Screening Decision /Recommendation</h4>
                                            <p>Categorization of the project based on the severity of its environmental impacts, determining whether it requires further environmental assessment </p>
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