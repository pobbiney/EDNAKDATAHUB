<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Region;
use App\Models\Drawing;
use App\Models\District;
use App\Models\Formsale;
use App\Models\Screening;
use App\Models\ProjectType;
use App\Models\PermitReview;
use Illuminate\Http\Request;
use App\Models\Drawingupload;
use App\Models\ProjectSector;
use App\Models\ProjectCategory;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class RegController extends Controller
{
    public function getApplicationView(){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $formsale= Formsale::find(Session::get('formsale_id'));

        $listApp = PermitRegistration::where('contact_number',$formsale->tell)->get();
        return view('customer.registration.MyApplication',['listApp'=>$listApp]);

    }

    public function openEditPermitApplicationView($id){

        $decodeID = Crypt::decrypt($id);
        
        $data = PermitRegistration::find($decodeID);
        return view('customer.registration.edit-permit-registration-form-application',
        ['data'=>$data,'id'=>$id]);
    }

    public function editPermitApplication(Request $request, $id)
    {
        $decodeID = Crypt::decrypt($id);
        $request->validate([
            'proponent_name' => 'required',
            'email' => 'required|email|email',
            'contact_person' => 'required',
            'city' => 'required',
            'address' => 'required',
            'position' => 'required',
            'contact_number' => 'required',
        ]);

        $insertApp = PermitRegistration::findOrFail($decodeID);
        $insertApp->proponent_name = $request->proponent_name;
        $insertApp->contact_person = $request->contact_person;
        $insertApp->city = $request->city;
        $insertApp->email = $request->email;
        $insertApp->address = $request->address;
        $insertApp->position = $request->position;
        $insertApp->contact_number = $request->contact_number;
    
    
        $insertApp->save();

        return view('customer.registration.success-message', [
        'redirectUrl' => route('customer.registration.edit-permit-registration-form-project',Crypt::encrypt($insertApp->id))
    ]);
    }

    public function openEditPermitProjectView($id){
    
        $decodeID = Crypt::decrypt($id);
        
        $datas = PermitRegistration::find($decodeID);
        $regionsList  = Region::all();
        $data  = District::all();
        $sec = ProjectSector::all();
        $catlist = ProjectCategory::all();
        $typelist = ProjectType::all();
        
        return view('customer.registration.edit-permit-registration-form-project',
        ['datas'=>$datas,'id'=>$id,'regionsList'=>$regionsList,'data'=>$data,'sec'=>$sec,'catlist'=>$catlist,'typelist'=>$typelist]);
    }

    public function editPermitProject(Request $request, $id){

        $decodeID = Crypt::decrypt($id);
        $request->validate([
            'project_title' => 'required',
            'plot_number' => 'required',
            'street_name' => 'required',
            'project_description' => 'required',
            'scope' => 'required',
            'gps' => 'required',
            'town' => 'required',
            'region' => 'required',
            'district' => 'required',
            'site_description' => 'required',
            'type' => 'required',
            'sector' => 'required',
            'category' => 'required',
        ]);

        

    $insertApp = PermitRegistration::findOrFail($decodeID);
        $insertApp->project_title = $request->project_title;
        $insertApp->plot_number = $request->plot_number;
        $insertApp->street_name = $request->street_name;
        $insertApp->project_description = $request->project_description;
        $insertApp->scope = $request->scope;
        $insertApp->gps = $request->gps;
        $insertApp->town = $request->town;
        $insertApp->region = $request->region;
        $insertApp->district = $request->district;
        $insertApp->landmark = $request->landmark;
        $insertApp->land_uses = $request->land_uses;
        $insertApp->site_description = $request->site_description;
        $insertApp->sector_id = $request->sector;
        $insertApp->cat_id = $request->category;
        $insertApp->type_id = $request->type;
    
        $insertApp->save();

        
        return view('customer.registration.success-message', [
            'redirectUrl' => route('customer.registration.edit-permit-registration-form-infrastructure',Crypt::encrypt($insertApp->id))
        ]);

    }

    public function resume($id)
    {
        $user = PermitRegistration::findOrFail($id);

        // Store ID in session for multi-step tracking
        Session::put('incomplete_user_id', $user->id);

        // Redirect to next step based on `registration_step`
        switch ($user->registration_step) {
            case 'Step1':
                return redirect()->route('registration.permit-registration-form-project'); // Step 2
            case 'Step2':
                return redirect()->route('registration.permit-registration-form-infrastructure');   // Step 3
            case 'Step3':
                return redirect()->route('registration.permit-registration-form-declaration');        // Review
            default:
                return redirect()->route('registration.permit-registration-form-application'); // Step 1
        }
    }


    
    public function viewApplication($id){
        $decodeID = Crypt::decrypt($id);
        $project = PermitRegistration::where('formId',$decodeID)->first();
        $listscreen = Screening::where('formId',$decodeID)->first();
         $list = PermitReview::where('formId',$decodeID)->first();
         $documents = Drawingupload::where('appId',$project->id)->get();
        return view('customer.registration.view-application',[
            'project' => $project,'listscreen'=>$listscreen,'list'=>$list,'documents' => $documents
        ]);
    }

    public function getAttachedDocView(){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $formsale= Formsale::find(Session::get('formsale_id'));
        $listApp = PermitRegistration::where('registration_step', 'completed')->where('contact_number',$formsale->tell)->get();
        return view('customer.registration.DocumentAttachment',['listApp'=>$listApp]);

    }

    public function getAttachDrawingForms (Request $request){

        $listDrawings = Drawing::get();

        $tableOne = '';

         $tableOne .= '<table class="table table-striped table-bordered">';
         
         foreach ($listDrawings as $key) {

            $tableOne .= '<tr>';

             $tableOne .= '<td>'.$key->name.'</td>';
             $tableOne .= '<td><input type="file" class="form-control" name="drawings'.$key->id.'"></td>';

             $tableOne .= '</tr>';
            
         }

         $tableOne .= '</table>';
          return $tableOne;

    }

    public function uploadAttachDrawingsProcess (Request $request){

        $listDrawings = Drawing::get();
        $documentCode = substr(rand(0,time()),0,9);

        $listCount = 0;

        foreach ($listDrawings as $key) {

            if(!empty($request["drawings".$key->id])){

               $listCount++; 

            }
            
        }

        if($listCount <= 0){


            return back()->with('message_error','No documents detected. Please upload at least one to proceed.');
        }

        $baseUrl = url('/').'/public/';

         foreach ($listDrawings as $keyTwo) {
            

            if($request->has("drawings".$keyTwo->id)){

            $docsName = 'drawingsUpload/'.$documentCode.'-drawings-'.time().rand(1,1000).'.'.$request->file('drawings'.$keyTwo->id)->extension();
            $request->file("drawings".$keyTwo->id)->move(public_path('drawingsUpload'),$docsName);

            $insertDrawings = new Drawingupload();
            $insertDrawings->path = $baseUrl.$docsName;
            $insertDrawings->uploadType = 'permitApplication';
            $insertDrawings->drawingType = $keyTwo->id;
            $insertDrawings->createdOn =  Carbon::now();
            $insertDrawings->createdBy = 0;
            $insertDrawings->appId = $request->formID;
            $status = $insertDrawings->save();

            }

        }

        return $status ? back()->with('message_success','Document uploaded successfully') : back()->with('message_error','Something went wrong, please try again.'); 


    }

}
