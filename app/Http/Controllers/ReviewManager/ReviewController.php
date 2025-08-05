<?php

namespace App\Http\Controllers\ReviewManager;

use App\Http\Controllers\Controller;
use App\Models\Appaccessroute;
use App\Models\Appalarm;
use App\Models\Appfire;
use App\Models\Appmeansofescape;
use App\Models\AuthorizationApp;
use App\Models\BillItem;
use App\Models\Certapproval;
use App\Models\CertificateApp;
use App\Models\Certvetting;
use App\Models\Drawingupload;
use App\Models\Floortable;
use App\Models\GeneralCommentReport;
use App\Models\InspectionQuestionType;
use App\Models\Meansofescape;
use App\Models\PermitApp;
use App\Models\Permitapproval;
use App\Models\PermitRegistration;
use App\Models\PermitReview;
use App\Models\Permitvetting;
use App\Models\ScreenDecision;
use App\Models\Screening;
use App\Models\Task;
use App\Models\Tracker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Expr\FuncCall;

class ReviewController extends Controller
{
    public function getProcessCertificateView(){

       $list = CertificateApp::where('status', 'Inspected')
           ->where('region', Auth::user()->region_id)
        ->get();
        return view('review_manager.process_certificate',['list'=>$list]);
    }

    public function getProcessCertificateDetailsView($id){

        $decodeId = Crypt::decrypt($id);
         $data =  CertificateApp::find($decodeId);
         
        $drawings = Drawingupload::where('appId', $decodeId)
        ->where('uploadType' ,'certificateApplication')
        ->get();

         $floor = Floortable::where('applicationId', $decodeId)
        ->where('applicationType' ,'certificateApplication')
        ->get();
      $means = Appmeansofescape::with('meansofescape') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('meansofescape', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();
         return view('review_manager.view-application-cert-details',['data'=>$data,'drawings'=>$drawings,'floor'=>$floor,
          'means'=>$means
        
        
        ]);

    }

    public function reviewCertificate(Request $request)
    {
       
        $data =  CertificateApp::find($request->certID);   
        $data->status = "Reviewed";
        $data->save();

        $track = new Tracker();
        $track->formID = $request->certID;
        $track->activity = "7";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "1";
        $track->regionId= $request->region;
        $track->save();

        return $data? back()->with('message','Application has been reviewed  Successfully'): back()->with('message_error','Something went wrong, please try again.');
        
    }

    public function reviewCertificateDecline(Request $request)
    {
       
        $data =  CertificateApp::find($request->certID);   
        $data->status = "Review Declined";
        $data->save();

        $track = new Tracker();
        $track->formID = $request->certID;
        $track->activity = "14";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "1";
        $track->regionId= $request->region;
        $track->save();

        return $data? back()->with('message','Application has been declined  Successfully'): back()->with('message_error','Something went wrong, please try again.');
        
    }

     public function getProcessPermitView(){

       $list = PermitApp::where('status', 'Inspected')
           ->where('region', Auth::user()->region_id)
        ->get();
        return view('review_manager.process_permit',['list'=>$list]);
    }

    public function getProcessPermitDetailsView($id){

        $decodeId = Crypt::decrypt($id);
         $data =  PermitApp::find($decodeId);
         
        $drawings = Drawingupload::where('appId', $decodeId)
        ->where('uploadType' ,'permitApplication')
        ->get();

         $floor = Floortable::where('applicationId', $decodeId)
        ->where('applicationType' ,'permitApplication')
        ->get();

       
    
      $means = Appmeansofescape::with('meansofescape') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('meansofescape', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();
         return view('review_manager.view-application-permit-details',['data'=>$data,'drawings'=>$drawings,'floor'=>$floor,
          'means'=>$means
        
        
        ]);

    }

    public function reviewPermit(Request $request)
    {
       
        $data =  PermitApp::find($request->certID);   
        $data->status = "Reviewed";
        $data->save();

        $track = new Tracker();
        $track->formID = $request->certID;
        $track->activity = "7";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "2";
        $track->regionId= $request->region;
        $track->save();

        return $data? back()->with('message','Application has been reviewed  Successfully'): back()->with('message_error','Something went wrong, please try again.');
        
    }

    public function reviewPermitDecline(Request $request)
    {
       
        $data =  PermitApp::find($request->certID);   
        $data->status = "Review Declined";
        $data->save();

        $track = new Tracker();
        $track->formID = $request->certID;
        $track->activity = "14";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "2";
        $track->regionId= $request->region;
        $track->save();

        return $data? back()->with('message','Application has been declined  Successfully'): back()->with('message_error','Something went wrong, please try again.');
        
    }

    public function getReviewCertificate(){

        $data = CertificateApp::where('status', 'Reviewed')
        ->where('region', Auth::user()->region_id)
     ->get();
     return view('review_manager.review_certificate',['data'=>$data]);

    }

    public function getReviewVetCertificate($id)
    {
        $decodeId = Crypt::decrypt($id);
        $data =  CertificateApp::find($decodeId);

        $floor = Floortable::where('applicationId', $decodeId)
        ->where('applicationType' ,'certificateApplication')
        ->get();
        $drawings = Drawingupload::where('appId', $decodeId)
        ->where('uploadType' ,'certificateApplication')
        ->get();
 
      $means = Appmeansofescape::with('meansofescape') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('meansofescape', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();


    $fire = Appfire::with('appfire') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appfire', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();
    $alram = Appalarm::with('appalarm') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appalarm', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();

    $access = Appaccessroute::with('appaccess') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appaccess', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();

        return view('review_manager.vet_application_cert_details',['data'=>$data,'floor'=>$floor,'drawings'=>$drawings,
        'means'=>$means,'fire'=>$fire,'alarm'=>$alram,'access'=>$access
      ]);
    }

    public function ProcessCertReviewApproval(Request $request)
    {
     
        $application = CertificateApp::findOrFail($request->application_ID);
        
        // Update application status based on action
        if ($request->action === 'approve') {
            $application->status = 'Vet Approved';
            $application->save();

            $vet = new Certvetting();
            $vet->appId = $request->application_ID;
        
            $vet->vettedOn =Carbon::now();
            $vet->vettedBy = Auth::user()->id; 
            $vet->status = "Approved";
            $vet->comment= $request->comment;
            $vet->reason= $request->reason;
            $vet->save();

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "7";
            $track->createdOn =Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "1";
            $track->regionId= $request->region;
            $track->save();
            $message = 'Application approved successfully!';
        } else {
            $application->status = 'Vet Declined';
            $application->save(); 

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "14";
            $track->createdOn =Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "1";
            $track->regionId= $request->region;
            $track->save();
            
            $message = 'Application declined.';
        }
        

         return redirect()->back()->with('message', $message);
        
    }


    //Showing List of Reviewed Permit Application//
    public function getReviewPermit(){
        
    
            $tasks = PermitRegistration::where('status','screened')
            ->where('region', Auth::user()->region_id)
            ->get();
           return view('review_manager.review_permit',['tasks'=>$tasks]);

    }
    

//Display Reviewed Permit Application for Approval//
      public function getReviewVetPermit($id)
    {
         $decodeID = Crypt::decrypt($id);
         $project = PermitRegistration::where('formID',$decodeID)->first();
         $listscreen = Screening::where('formId',$decodeID)->first();
         $list = ScreenDecision::all();
        return view('review_manager.review_permit_application',[
            'project' => $project,'listscreen'=>$listscreen,'list'=>$list
        ]);
           
      
    }

    //Review Approval for permit Application//

        public function ProcessPermitReviewApproval(Request $request)
    {
     
        $application = PermitApp::findOrFail($request->application_ID);
        
        // Update application status based on action
        if ($request->action === 'approve') {
            $application->status = 'Vet Approved';
            $application->save();

            $vet = new Permitvetting();
            $vet->appId = $request->application_ID;
        
            $vet->vettedOn =Carbon::now();
            $vet->vettedBy = Auth::user()->id; 
            $vet->status = "Approved";
            $vet->comment= $request->comment;
            $vet->reason= $request->reason;
            $vet->save();

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "7";
            $track->createdOn =Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "2";
            $track->regionId= $request->region;
            $track->save();
            $message = 'Application approved successfully!';
        } else {
            $application->status = 'Vet Declined';
            $application->save(); 

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "14";
            $track->createdOn =Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "2";
            $track->regionId= $request->region;
            $track->save();
            
            $message = 'Application declined.';
        }
        

         return redirect()->back()->with('message', $message);
        
    }
   
    public function getVetCertificate()
    {
          $list = AuthorizationApp::where('form_type', 'certificate_app')
           ->where('inspection_status', 'Authorize')
        ->get();
        return view('review_manager.vet_certificate',['list'=>$list]);
    }
   
      public function getReviewVetCertificateReport($id)
    {
        $decodeId = Crypt::decrypt($id);
        $data =  CertificateApp::find($decodeId);


         $questionTypes = InspectionQuestionType::where('section', 'section_one')
        ->orderBy('id', 'ASC')
        ->with(['questions.responses' => function($query) {
            $query->where('form_type', 'certificate_app')
                  ->where('section', 'section_one');
        }])
        ->get();

        

        $sectionTwo = InspectionQuestionType::with(['questions.responses' => function($query) {
            $query->where('form_type', 'certificate_app')
                  ->where('section', 'section_two');
        }])
        ->where('section', 'section_two')
        ->orderBy('id')
        ->get();

        $generalComment = GeneralCommentReport::where('applicant_id', $decodeId)
        ->where('form_type', 'certificate_app')
        ->first();

        return view('review_manager.InspectionReportCert',['data'=>$data,'sectionTwo'=>$sectionTwo,'questionTypes'=>$questionTypes,'generalComment'=>$generalComment
      ]);
    }

    public function getVetPermit(){
        
          $list = AuthorizationApp::where('form_type', 'permit_app')
           ->where('inspection_status', 'Authorize')
        ->get();
        return view('review_manager.vet_permit',['list'=>$list]);
    }

    public function getReviewVetPermitReport($id){
         $decodeId = Crypt::decrypt($id);
        $data =  PermitApp::find($decodeId);


         $questionTypes = InspectionQuestionType::where('section', 'section_one')
        ->orderBy('id', 'ASC')
        ->with(['questions.responses' => function($query) {
            $query->where('form_type', 'permit_app')
                  ->where('section', 'section_one');
        }])
        ->get();

        

        $sectionTwo = InspectionQuestionType::with(['questions.responses' => function($query) {
            $query->where('form_type', 'permit_app')
                  ->where('section', 'section_two');
        }])
        ->where('section', 'section_two')
        ->orderBy('id')
        ->get();

        $generalComment = GeneralCommentReport::where('applicant_id', $decodeId)
        ->where('form_type', 'permit_app')
        ->first();

        return view('review_manager.InspectionReportPermit',['data'=>$data,'sectionTwo'=>$sectionTwo,'questionTypes'=>$questionTypes,'generalComment'=>$generalComment
      ]);
    }

    public function getApproveCertificateView(){
        $data = CertificateApp::where('status', 'Vet Approved')
        ->where('region', Auth::user()->region_id)
     ->get();
     return view('review_manager.approve_certificate',['data'=>$data]);
    }

    public function getApproveCertDetailsView($id){
        $decodeId = Crypt::decrypt($id);
        $data =  CertificateApp::find($decodeId);

        $floor = Floortable::where('applicationId', $decodeId)
        ->where('applicationType' ,'certificateApplication')
        ->get();
        $drawings = Drawingupload::where('appId', $decodeId)
        ->where('uploadType' ,'certificateApplication')
        ->get();
 
      $means = Appmeansofescape::with('meansofescape') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('meansofescape', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();


    $fire = Appfire::with('appfire') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appfire', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();
    $alram = Appalarm::with('appalarm') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appalarm', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();

    $access = Appaccessroute::with('appaccess') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appaccess', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();

    $billItems = BillItem::where('billType', 1)
            ->where('status', 'Active')
            ->get();
        return view('review_manager.approve_application_cert_details',['data'=>$data,'floor'=>$floor,'drawings'=>$drawings,
        'means'=>$means,'fire'=>$fire,'alarm'=>$alram,'access'=>$access,'billItems'=>$billItems
    ]);


    }

  //Approving Certificate
    public function addApproveCertificate(Request $request)
    {
     
        $application = CertificateApp::findOrFail($request->application_ID);
        
        // Update application status based on action
        if ($request->action === 'approve') {
            $application->status = 'Approved';
            $application->save();

            $vet = new Certapproval();
            $vet->appId = $request->application_ID;
        
            $vet->createdOn = Carbon::now();
            $vet->createdBy = Auth::user()->id; 
            $vet->status = "Approved";
            $vet->comment= $request->comment;
            $vet->reason= $request->reason;
            $vet->region_id= $request->region;
            $vet->save();

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "8";
            $track->createdOn = Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "1";
            $track->regionId= $request->region;
            $track->save();
            $message = 'Application approved successfully!';
        } else {
            $application->status = 'Approval Declined';
            $application->save(); 

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "15";
            $track->createdOn = Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "1";
            $track->regionId= $request->region;
            $track->save();
            
            $message = 'Application declined.';
        }
        

         return redirect()->back()->with('message', $message);
        
    }

    public function getApprovePermitView(){

    $data = PermitApp::where('status', 'Vet Approved')
        ->where('region', Auth::user()->region_id)
     ->get();
     return view('review_manager.approve_permit',['data'=>$data]);

    }

    public function getApprovePermitDetailsView($id){
        $decodeId = Crypt::decrypt($id);
        $data =  PermitApp::find($decodeId);

        $floor = Floortable::where('applicationId', $decodeId)
        ->where('applicationType' ,'permitApplication')
        ->get();
        $drawings = Drawingupload::where('appId', $decodeId)
        ->where('uploadType' ,'permitApplication')
        ->get();
 
      $means = Appmeansofescape::with('meansofescape') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('meansofescape', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();


    $fire = Appfire::with('appfire') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appfire', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();
    $alram = Appalarm::with('appalarm') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appalarm', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();

    $access = Appaccessroute::with('appaccess') // Eager load the relationship
    ->where('applicationId', $decodeId)
  
    ->whereHas('appaccess', function($query) {
        $query->where('status', 'Active'); // Only where Meansofescape is active
    })
    ->get();

    $billItems = BillItem::where('billType', 1)
            ->where('status', 'Active')
            ->get();
        return view('review_manager.approve_application_permit_details',['data'=>$data,'floor'=>$floor,'drawings'=>$drawings,
        'means'=>$means,'fire'=>$fire,'alarm'=>$alram,'access'=>$access,'billItems'=>$billItems
    ]);


    }

    //Approving Permit
    public function addApprovePermit(Request $request)
    {
     
        $application = PermitApp::findOrFail($request->application_ID);
        
        // Update application status based on action
        if ($request->action === 'approve') {
            $application->status = 'Approved';
            $application->save();

            $vet = new Permitapproval();
            $vet->appId = $request->application_ID;
        
            $vet->createdOn = Carbon::now();
            $vet->createdBy = Auth::user()->id; 
            $vet->status = "Approved";
            $vet->comment= $request->comment;
            $vet->reason= $request->reason;
            $vet->region_id= $request->region;
            $vet->save();

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "8";
            $track->createdOn = Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "2";
            $track->regionId= $request->region;
            $track->save();
            $message = 'Application approved successfully!';
        } else {
            $application->status = 'Approval Declined';
            $application->save(); 

            $track = new Tracker();
            $track->formID = $request->application_ID;
            $track->activity = "15";
            $track->createdOn = Carbon::now();
            $track->createdBy = Auth::user()->id; 
            $track->activity_type = "2";
            $track->regionId= $request->region;
            $track->save();
            
            $message = 'Application declined.';
        }
        

         return redirect()->back()->with('message', $message);
        
    }

    public function getSearchPermitView(){
        
        return view('review_manager.search-permit-application');
    }


     /*searching for application*/
     public function searchPermitProcess (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $table = "";
 
        if($operation == "equal"){
 
            $result = PermitApp::where('status', 'Vet Approved')
            ->where([[$field,$parameter]])->get();
 
        }else{
 
            $result = PermitApp::where('status', 'Vet Approved')
            ->where([[$field,'LIKE','%'.$parameter.'%']
            ])->get();
 
        }

        if($result->count() > 0){
  
            $table .= '<table id="example"  class="dt-select-table table">';
    
            $table .= '<thead> <tr> <th><b>Applicant</b></th> <th><b>Company Name</b></th> <th><b>Telephone</b></th>  <th><b>Plot/House No</b></th> <th><b>Location</b></th><th><b>City</b></th> <th><b>Action</b></th> </tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {
                $table .= '<tr>';

                $table .= '<td>'.$item->surname.' '.$item->firstname.'</td>';
 

                $table .= '<td>'.$item->companyName.'</td>';
                $table .= '<td>'.$item->tel.' </td>';
                $table .= '<td>'.$item->plotNo.' </td>';
                $table .= '<td>'.$item->location.'</td>';
                $table .= '<td>'.$item->city.'</td>';
                $table .= '<td><a href="'.route('approve_application_permit_details',Crypt::encrypt($item->id)).'" target="_" class="btn btn-sm btn-primary" style="color:white"> Process</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

        }

        public function getSearchCertView(){
        
            return view('review_manager.search-cert-application');
        }
    
            /*searching for application*/
     public function searchCertProcess (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $table = "";
 
        if($operation == "equal"){
 
            $result = CertificateApp::where('status', 'Vet Approved')
            ->where([[$field,$parameter]])->get();
 
        }else{
 
            $result = CertificateApp::where('status', 'Vet Approved')
            ->where([[$field,'LIKE','%'.$parameter.'%']
            ])->get();
 
        }

        if($result->count() > 0){
  
            $table .= '<table id="example"  class="dt-select-table table">';
    
            $table .= '<thead> <tr> <th><b>Applicant</b></th> <th><b>Company Name</b></th> <th><b>Telephone</b></th>  <th><b>Plot/House No</b></th> <th><b>Location</b></th><th><b>City</b></th> <th><b>Action</b></th> </tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {
                $table .= '<tr>';

                $table .= '<td>'.$item->surname.' '.$item->firstname.'</td>';
 

                $table .= '<td>'.$item->companyName.'</td>';
                $table .= '<td>'.$item->tel.' </td>';
                $table .= '<td>'.$item->plotNo.' </td>';
                $table .= '<td>'.$item->location.'</td>';
                $table .= '<td>'.$item->city.'</td>';
                $table .= '<td><a href="'.route('approve_application_cert_details',Crypt::encrypt($item->id)).'" target="_" class="btn btn-sm btn-primary" style="color:white"> Process</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

        }

    public function addReview(Request $request){
        $request->validate([
        'evaluation' => 'required',
        'decision_id' => 'required',
        'recommendation' => 'required',
       
        
    ]);

    $insertApp = new PermitReview();
    $insertApp->formId = $request->permit_id;
    $insertApp->application_type = "permit";
    $insertApp->evaluation = $request->evaluation;
    $insertApp->decision_id = $request->decision_id;
    $insertApp->recommendation = $request->recommendation;
    $insertApp->region_id = $request->region_id;
    $insertApp->created_by = Auth::user()->id; 
     
    $insertApp->save();
    if($request->decision_id == 1){
    $track = new Tracker();
    $track->formID = $request->permit_id;
    $track->activity = "7";
    $track->createdOn =Carbon::now();
    $track->createdBy = Auth::user()->id; 
    $track->activity_type = "1";
    $track->regionId= $request->region_id;
    $track->save();
    }
    else{
         $track = new Tracker();
    $track->formID = $request->permit_id;
    $track->activity = "14";
    $track->createdOn =Carbon::now();
    $track->createdBy = Auth::user()->id; 
    $track->activity_type = "1";
    $track->regionId= $request->region_id;
    $track->save();
    }

     PermitRegistration::where('formID', $request->permit_id)
            ->update([
                'status' => "reviewed"
            ]);

    Task::where('application_id', $request->permit_id)
    ->update([
        'status' => "reviewed"
    ]);

  

  
   return $insertApp? back()->with('message_success','Application  Reviewed Successfully'): back()->with('message_error','Something went wrong, please try again.');

       }

       public function getReviewPermitReport($id)
       {
        $decodeID = Crypt::decrypt($id);
         $project = PermitRegistration::where('formID',$decodeID)->first();
       
         $listscreen = Screening::where('formId',$decodeID)->first();
        return view('review_manager.view-review_permit_application',[
            'project' => $project,'listscreen'=>$listscreen
        ]);
       }

}
