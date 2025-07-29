<?php

namespace App\Http\Controllers\RenewalManager;

use App\Http\Controllers\Controller;
use App\Models\AppBill;
use App\Models\Applicationform;
use App\Models\InspectionQuestion;
use App\Models\InspectionQuestionType;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\PermitApp;
use App\Models\RenewApp;
use App\Models\CertificateApp;
use App\Models\AuthorizationApp;
use App\Models\BillItem;
use App\Models\Businesstype;
use App\Models\GeneralCommentReport;
use App\Models\ReInspectionReport;
use App\Models\Tracker;

class RenewalController extends Controller
{
    public function getSellRenewalFormView()  {

        $list = Applicationform::where('status', 'Active')
        ->where('id',5)
        ->get();
        $data = Region::all();
        return view('renewal_cert.sell_renewal',['list'=>$list,'data'=>$data]);
        
    }

    public function getAddQtnView()
    {
        $data = InspectionQuestionType::all();
        $qtn = InspectionQuestion::all();
        return view('renewal_cert.add_question',['data'=>$data,'qtn'=>$qtn]);
    }

    public function addQuestion(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'question' =>'required',
            
     
        ]);
        $data =  new InspectionQuestion();
      
        $data->question = $request->question;
        $data->type_id = $request->type;
        
        $data->created_by = Auth::user()->id; 
        $data->created_on= Carbon::now();
        $data->save();
        return $data? back()->with('message','Inspection Question Saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    } 

    public function getEditQuestionView($id)
    {
        $decodeId = Crypt::decrypt($id);
        $datas = InspectionQuestion::find($decodeId);
        $qtntype = InspectionQuestionType::all();
        $qtn = InspectionQuestion::all();
        return view('renewal_cert.edit-question',['id'=>$id,'qtntype'=>$qtntype,'qtn'=>$qtn,'datas'=>$datas]);
    }

    public function editQuestion(Request $request,$id)
    {
        $request->validate([
            'type' => 'required',
            'question' =>'required',
            
     
        ]);

        $decodeId = Crypt::decrypt($id);
        $data =  InspectionQuestion::find($decodeId);
      
        $data->question = $request->question;
        $data->type_id = $request->type;
         
        $data->save();
        return $data? back()->with('message','Inspection Question Updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
    } 

    public function getQtnTypeView(){
        $list = InspectionQuestionType::all();
        return view('renewal_cert.QuestionType',['list'=>$list]);
    }
    
    public function addQuestionType(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'section' =>'required',
            
     
        ]);
        $data =  new InspectionQuestionType();
      
        $data->name = $request->class_name;
        $data->description = $request->description;
        $data->section = $request->section;
        
        $data->created_by = Auth::user()->id; 
        $data->created_on= Carbon::now();
        $data->save();
        return $data? back()->with('message','Inspection Question Type Saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    } 
    
    public function editQuestionTypeView($id)
    {
        $decodeId = Crypt::decrypt($id);
        $datas = InspectionQuestionType::find($decodeId);
      
        $list = InspectionQuestionType::all();
        return view('renewal_cert.edit-question-type',['id'=>$id,'list'=>$list,'datas'=>$datas]);
    }

    public function editQuestionType(Request $request,$id)
    {
        $request->validate([
            'class_name' => 'required',
            'section' =>'required',
            
     
        ]);

        $decodeId = Crypt::decrypt($id);
        $data =  InspectionQuestionType::find($decodeId);
      
        $data->name = $request->class_name;
        $data->description = $request->description;
        $data->section = $request->section;
         
        $data->save();
        return $data? back()->with('message','Inspection Question Type Updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
    } 

    public function getReInspectionView()
    {
        $results = DB::table('certificate_app as CA')
        ->join('authorization_app as AP', 'CA.id', '=', 'AP.applicant_id')
        ->select(
            'AP.id as authorize_id',
            'CA.id as cert_id',
            'CA.firstname',
            'CA.surname',
            'CA.companyName',
            'CA.location',
            'CA.tel',
            'CA.email',
            'CA.city'
        )
        ->where('AP.inspection_status', 'Pending')
        ->where('AP.form_type', 'certificate_app')
        ->get();
        return view('renewal_cert.re-inspection',['results'=>$results]);
    }
    
    public function getReInspectionReportView($id)
    {
        $decodeId = Crypt::decrypt($id);
        $getData = explode("&&", $decodeId);
        [$getID, $getdb, $getAuthID] = $getData;

        // Get authorization data
        $authorization = AuthorizationApp::findOrFail($getAuthID);

        if ($getdb == "certificate_app") {
            // Handle certificate_app case
            $certificate = CertificateApp::findOrFail($getID);
            //$renewData = RenewApp::findOrFail($authorization->renew_app_id);
           

            $list = InspectionQuestionType::with(['questions' => function($query) {
                $query->orderBy('id', 'asc');
            }])
            ->where('section', 'section_one')
            ->orderBy('id', 'asc')
            ->get();
            $data = $list->pluck('questions')->flatten();

            $listdata = InspectionQuestionType::with(['questions' => function($query) {
                $query->orderBy('id', 'asc');
            }])
            ->where('section', 'section_two')
            ->orderBy('id', 'asc')
            ->get();
            $data = $listdata->pluck('questions')->flatten();

            return view('renewal_cert.view-re-inspection-cert-report', [
                'certificate' => $certificate,
                //'renewData' => $renewData,
                'authorization' => $authorization,
                
                'list'=>$list,
                'data'=>$data,
                'getdb'=>$getdb,
                'listdata'=>$listdata
            ]);
        } 
    }

     //inserting into ReInspection table//
     public function addReInspection(Request $request)
     {
        
       
        foreach ($request->question_id as $index => $question_id) {
            $data = new ReInspectionReport();
            $data->question_id = $question_id;
            $data->authorizate_id = $request->authorize_ID;
            $data->form_type = $request->store_name;
            $data->applicant_id = $request->cert_id;
            $data->section = $request->section;
            $data->question_type_id = $request->questionType[$index];
            $data->question_id = $request->question_id[$index];
            $data->response = $request->response[$index];
            $data->condition = $request->condition[$index];
            $data->comment = $request->comment[$index];
            $data->created_by = Auth::user()->id; 
            $data->created_on= Carbon::now();
          
            $data->save();  
        }
            $track = new Tracker();
            $track->formID = $request->cert_id;
            $track->activity = "11";
            $track->createdOn =Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "1";
            $track->regionId= $request->region;
            $track->save();
         return $data? back()->with('message','Re-Inspection  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
         
     }

         //inserting into ReInspection table//
         public function addReInspectionSectionTwo(Request $request)
         {
            
            foreach ($request->sectiontwo_questionID as $index => $sectiontwo_questionID) {
                $data = new ReInspectionReport();
                $data->question_id = $sectiontwo_questionID;
                $data->authorizate_id = $request->authorize_ID;
                $data->form_type = $request->store_name;
                $data->applicant_id = $request->cert_id;
                $data->section = $request->section;
                $data->question_type_id = $request->sectiontwo_questionType[$index];
                //$data->question_id = $request->question_id[$index];
                //$data->response = $request->sectiontwo_response[$index];
                $data->tick = $request->sectiontwo_response[$index];
                $data->number = $request->sectiontwo_number[$index];
                $data->location = $request->sectiontwo_location[$index];
                $data->comment = $request->sectiontwo_comment[$index];
                $data->created_by = Auth::user()->id; 
                $data->created_on= Carbon::now();
              
                $data->save();  
            }
            $datas = new GeneralCommentReport();
            
            $datas->authorizate_id = $request->authorize_ID;
            $datas->form_type = $request->store_name;
            $datas->applicant_id = $request->cert_id;
            $datas->section = $request->section;

            $datas->rate = $request->final_reponse;
            $datas->recommend = $request->final_reponse_two;
            $datas->comment = $request->final_reponse_three;
             
            $datas->created_by = Auth::user()->id; 
            $datas->created_on= Carbon::now();
          
            $datas->save(); 


            AuthorizationApp::where('applicant_id', $request->cert_id)
            ->update([
                'inspection_status' => "Authorize"
            ]);

             return $data? back()->with('message','Re-Inspection  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
             
         }

        

         public function getPermitReInspectionView()
         {
             $results = DB::table('permit_app as CA')
             ->join('authorization_app as AP', 'CA.id', '=', 'AP.applicant_id')
             ->select(
                 'AP.id as authorize_id',
                 'CA.id as cert_id',
                 'CA.firstname',
                 'CA.surname',
                 'CA.companyName',
                 'CA.location',
                 'CA.tel',
                 'CA.email',
                 'CA.city'
             )
             ->where('AP.inspection_status', 'Pending')
             ->where('AP.form_type', 'permit_app')
             ->get();
             return view('renewal_cert.permit-re-inspection',['results'=>$results]);
         }
    
         /* Get Permit Re-Inspection form */
         public function getPermitReInspectionReportView($id)
         {
             $decodeId = Crypt::decrypt($id);
             $getData = explode("&&", $decodeId);
             [$getID, $getdb, $getAuthID] = $getData;
     
             // Get authorization data
             $authorization = AuthorizationApp::findOrFail($getAuthID);
     
             if ($getdb == "permit_app") {
                 // Handle certificate_app case
                 $certificate = PermitApp::findOrFail($getID);
                 //$renewData = RenewApp::findOrFail($authorization->renew_app_id);
                
     
                 $list = InspectionQuestionType::with(['questions' => function($query) {
                     $query->orderBy('id', 'asc');
                 }])
                 ->where('section', 'section_one')
                 ->orderBy('id', 'asc')
                 ->get();
                 $data = $list->pluck('questions')->flatten();
     
                 $listdata = InspectionQuestionType::with(['questions' => function($query) {
                     $query->orderBy('id', 'asc');
                 }])
                 ->where('section', 'section_two')
                 ->orderBy('id', 'asc')
                 ->get();
                 $data = $listdata->pluck('questions')->flatten();
     
                 return view('renewal_cert.view-permit-re-inspection-cert-report', [
                     'certificate' => $certificate,
                     //'renewData' => $renewData,
                     'authorization' => $authorization,
                     
                     'list'=>$list,
                     'data'=>$data,
                     'getdb'=>$getdb,
                     'listdata'=>$listdata
                 ]);
             } 
         }
      //inserting into ReInspection table//
      public function addPermitReInspection(Request $request)
      {
         
        
         foreach ($request->question_id as $index => $question_id) {
             $data = new ReInspectionReport();
             $data->question_id = $question_id;
             $data->authorizate_id = $request->authorize_ID;
             $data->form_type = $request->store_name;
             $data->applicant_id = $request->cert_id;
             $data->section = $request->section;
             $data->question_type_id = $request->questionType[$index];
             $data->question_id = $request->question_id[$index];
             $data->response = $request->response[$index];
             $data->condition = $request->condition[$index];
             $data->comment = $request->comment[$index];
             $data->created_by = Auth::user()->id; 
             $data->created_on= Carbon::now();
           
             $data->save();  
         }
             $track = new Tracker();
             $track->formID = $request->cert_id;
             $track->activity = "11";
             $track->createdOn =Carbon::now();
             $track->createdBy = Auth::user()->id; 
             $track->activity_type = "2";
             $track->regionId= $request->region;
             $track->save();
          return $data? back()->with('message','Permit Re-Inspection  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
          
      }

       //inserting into ReInspection table//
       public function addPermitReInspectionSectionTwo(Request $request)
       {
          
          foreach ($request->sectiontwo_questionID as $index => $sectiontwo_questionID) {
              $data = new ReInspectionReport();
              $data->question_id = $sectiontwo_questionID;
              $data->authorizate_id = $request->authorize_ID;
              $data->form_type = $request->store_name;
              $data->applicant_id = $request->cert_id;
              $data->section = $request->section;
              $data->question_type_id = $request->sectiontwo_questionType[$index];
              //$data->question_id = $request->question_id[$index];
              //$data->response = $request->sectiontwo_response[$index];
              $data->tick = $request->sectiontwo_response[$index];
              $data->number = $request->sectiontwo_number[$index];
              $data->location = $request->sectiontwo_location[$index];
              $data->comment = $request->sectiontwo_comment[$index];
              $data->created_by = Auth::user()->id; 
              $data->created_on= Carbon::now();
            
              $data->save();  
          }
          $datas = new GeneralCommentReport();
          
          $datas->authorizate_id = $request->authorize_ID;
          $datas->form_type = $request->store_name;
          $datas->applicant_id = $request->cert_id;
          $datas->section = $request->section;

          $datas->rate = $request->final_reponse;
          $datas->recommend = $request->final_reponse_two;
          $datas->comment = $request->final_reponse_three;
           
          $datas->created_by = Auth::user()->id; 
          $datas->created_on= Carbon::now();
        
          $datas->save(); 


          AuthorizationApp::where('applicant_id', $request->cert_id)
          ->update([
              'inspection_status' => "Authorize"
          ]);

           return $data? back()->with('message','Permit Re-Inspection  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
           
       }
       
       public function getRenewalCertificateView()
    {
     $results = DB::table('certificate_app as CP')
        ->join('certapproval as CA', 'CP.id', '=', 'CA.appId')
        ->select('CP.*', 'CA.createdOn as ApproveDate')
        ->where('CA.status', 'Approved')
        ->get()
        ->filter(function ($row) {
            // Filter to only include if 1 year or more has passed since approval
            $approveDate = Carbon::parse($row->ApproveDate);
            return $approveDate->diffInYears(Carbon::now()) >= 1;
        });
     return view('renewal_cert.renewal_list',['results'=>$results]);
    }

    public function getRenewCertView($id)
    {
        $decodeId = Crypt::decrypt($id);
         $certificate = CertificateApp::findOrFail($decodeId);
        $list = Businesstype::where('status', 'Active')->get();
         return view('renewal_cert.renew_cert_form',['id'=>$id,'certificate'=>$certificate,'list'=>$list]);

    }

    public function addCertRenewal(Request $request){
               
            // Get amount from bill_item first
          $amt = BillItem::where('premiseuse', $request->userp)->first();
           $amount = $amt->amount;
            $data =  new RenewApp();
            $data->cert_id = $request->cert_id;
            $data->floors = $request->nofloor;
            $data->current_use = $request->userp;
            $data->cont_person = $request->person;
            $data->mobile = $request->contact;
            $data->email = $request->email;
            $data->form_type = "certificate_app";
            $data->createdon =Carbon::now();
            $data->createdby = Auth::user()->id; 
            $data->save();

            $tracker =  new Tracker();
            $tracker->formID = $request->cert_id;
            $tracker->activity = "10";
            $tracker->activity_type = "1";
            $tracker->createdOn =Carbon::now();
            $tracker->createdBy = Auth::user()->id; 
            $tracker->regionId = $request->region_id;
            $tracker->save();

            $appbill =  new AppBill();
            $appbill->formID = $request->cert_id;
            $appbill->bill_type = $request->userp;
            $appbill->bill_amount = $amount;
            $appbill->createdon =Carbon::now();
            $appbill->createdby = Auth::user()->id; 
           
            $appbill->save();

             return $data? back()->with('message','Saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }

          public function getRenewalPermitView()
    {
     $results = DB::table('permit_app as CP')
        ->join('permitapproval as CA', 'CP.id', '=', 'CA.appId')
        ->select('CP.*', 'CA.createdOn as ApproveDate')
        ->where('CA.status', 'Approved')
        ->get()
        ->filter(function ($row) {
            // Filter to only include if 1 year or more has passed since approval
            $approveDate = Carbon::parse($row->ApproveDate);
            return $approveDate->diffInYears(Carbon::now()) >= 1;
        });
     return view('renewal_cert.permit-renewal_list',['results'=>$results]);
    }

    public function getRenewPermitView($id)
    {
        $decodeId = Crypt::decrypt($id);
         $certificate = PermitApp::findOrFail($decodeId);
        $list = Businesstype::where('status', 'Active')->get();
         return view('renewal_cert.renew_permit_form',['id'=>$id,'certificate'=>$certificate,'list'=>$list]);

    }

     public function addPermitRenewal(Request $request){
               
            // Get amount from bill_item first
          $amt = BillItem::where('premiseuse', $request->userp)->first();
           $amount = $amt->amount;
            $data =  new RenewApp();
            $data->cert_id = $request->cert_id;
            $data->floors = $request->nofloor;
            $data->current_use = $request->userp;
            $data->cont_person = $request->person;
            $data->mobile = $request->contact;
            $data->email = $request->email;
            $data->form_type = "permit_app";
            $data->createdon =Carbon::now();
            $data->createdby = Auth::user()->id; 
            $data->save();

            $tracker =  new Tracker();
            $tracker->formID = $request->cert_id;
            $tracker->activity = "10";
            $tracker->activity_type = "2";
            $tracker->createdOn =Carbon::now();
            $tracker->createdBy = Auth::user()->id; 
            $tracker->regionId = $request->region_id;
            $tracker->save();

            $appbill =  new AppBill();
            $appbill->formID = $request->cert_id;
            $appbill->bill_type = $request->userp;
            $appbill->bill_amount = $amount;
            $appbill->createdon =Carbon::now();
            $appbill->createdby = Auth::user()->id; 
           
            $appbill->save();

             return $data? back()->with('message','Saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }
  
}
