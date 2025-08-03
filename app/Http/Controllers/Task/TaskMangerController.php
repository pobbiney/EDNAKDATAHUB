<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\AuthorizationApp;
use App\Models\CertificateApp;
use App\Models\Payment;
use App\Models\PermitApp;
use App\Models\RenewApp;
use App\Models\Staff;
use App\Models\Task;
use App\Models\Tracker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Sms\SmsController;
use App\Models\AppBill;
use App\Models\BillItem;
use App\Models\Formsale;
use App\Models\PermitRegistration;
use App\Models\Region;
use App\Models\ScreenDecision;
use App\Models\Screening;
use Illuminate\Support\Facades\DB;

class TaskMangerController extends Controller
{
    public function getNewJobView()
    {
        $list = PermitRegistration::where(function($query) {
            $query->where('status', 'Pending')
            ->where('registration_step', 'completed')
             ->orWhere('status', 'pendingProcessing');
        })
       
        ->where('region', Auth::user()->region_id)
        ->with(['tasks' => function($query) {
            $query->where('taskType', 'permit');
        }])
        ->get();
    
    // Get all tasks from all certificates (flatten collection)
    $data = $list->pluck('tasks')->flatten();
    $staf = Staff::where('region_id', Auth::user()->region_id)
    ->get();
            return view('task.JobAssignment',['list'=>$list,'data'=>$data,'staf'=>$staf]);
        }

    public function getCertificateModalView($id)
  {
      $data = PermitRegistration::find($id);
      return response()->json($data);
  
  }

  public function getPermitModalView($id)
  {
      $data = PermitApp::find($id);
      return response()->json($data);
  
  }

  public function getTaskModalView($id)
  {
      $data = Task::find($id);
      return response()->json($data);
  
  }
  
    /*saving Task*/ 
    public function assignTask(Request $request)
    {
      $request->validate([
          'staff' => 'required',
          'description' => 'required',
          
   
      ]);
        
        // Check if payment exists (corrected logic)
    $paymentExists = Payment::where('bill_type_id', 2)
    ->where('formId', $request->certID)
    ->exists();

    if (!$paymentExists) {
        return back()->with('message_error', 'Payment of processing fee is required before assigning a task.');
    }


        $data = new task();
        $data->description = $request->description;
        $data->assignee = $request->staff;
        $data->application_id = $request->certID;
        
        $data->taskType = "permit";
        $data->createdOn =Carbon::now();
        $data->createdBy = Auth::user()->id; 
        $data->status = "Active";
        $data->region_id= $request->regionID;
        $data->save();
       // Create the task
    
         $cert = PermitRegistration::where('formID', $request->certID)->first();
        if ($cert) {
            $cert->status = "Pending";
            $cert->save();
        }

        $track = new Tracker();
        $track->formID = $request->certID;
        $track->activity = "4";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "1";
        $track->regionId= $request->regionID;
        $track->save();


        return $data? back()->with('message_success','Task assigned Successfully'): back()->with('message_error','Something went wrong, please try again.');
    
    }

     /*updating Task*/ 
     public function ReassignTask(Request $request)
     {
       $request->validate([
           'staff' => 'required',
    
       ]);
     
       
        $data =  Task::find($request->task_id);
        $data->description = $request->description;
        $data->assignee = $request->staff;
        $data->updateOn =Carbon::now();
        $data->updateBy = Auth::user()->id; 
        $data->save();

        $track = new Tracker();
        $track->formID = $request->CertID;
        $track->activity = "4";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "1";
        $track->regionId= $request->region_id;
        $track->save();

         return $data? back()->with('message_success','Task assigned  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
         
     }

     public function getPermitTaskView()
     {
         $list = PermitApp::where(function($query) {
             $query->where('status', 'Pending')
         
                   ->orWhere('status', 'pendingProcessing');
         })
          ->where('formType', 2) // Add this condition for formType = 1
         ->where('region', Auth::user()->region_id)
         ->with(['tasks' => function($query) {
             $query->where('taskType', 'permit');
         }])->get();
     
     // Get all tasks from all certificates (flatten collection)
     $data = $list->pluck('tasks')->flatten();
     $staf = Staff::where('region_id', Auth::user()->region_id)
    ->get();
             return view('task.permit-task-assignment',['list'=>$list,'data'=>$data,'staf'=>$staf]);
         }

          /*saving Permit Task*/ 
    public function assignPermitTask(Request $request)
    {
      $request->validate([
          'staff' => 'required',
          
   
      ]);
        
          
        // Check if payment exists (corrected logic)
    $paymentExists = Payment::where('bill_type_id', 2)
    ->where('formId', $request->permitID)
    ->exists();

    if (!$paymentExists) {
        return back()->with('message_error', 'Payment of processing fee is required before assigning a task.');
    }
        $data = new task();
        $data->description = $request->description;
        $data->assignee = $request->staff;
        $data->application_id = $request->permitID;
        $data->taskType = "permit";
        $data->createdOn = Carbon::now();
        $data->region_id= $request->regionId;
        $data->status = "Active";
        $data->createdBy = Auth::user()->id; 
        $data->save();

        $cert =  PermitApp::find($request->permitID);
        $cert->status="Pending";
        $cert->save();

        $track = new Tracker();
        $track->formID = $request->permitID;
        $track->activity = "4";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "2";
        $track->regionId= $request->regionId;
        $track->save();


        return $data? back()->with('message','Task assigned Successfully'): back()->with('message_error','Something went wrong, please try again.');
        
    }

      /*updating Permit Task*/ 
      public function ReassignPermitTask(Request $request)
      {
        $request->validate([
            'staff' => 'required',
            
     
        ]);
        
         $data =  Task::find($request->task_id);
         $data->description = $request->description;
         $data->assignee = $request->staff;
         $data->updateOn =Carbon::now();
         
         $data->updateBy = Auth::user()->id; 
         $data->save();
 
         
 
         $track = new Tracker();
         $track->formID = $request->permitID;
         $track->activity = "4";
         $track->createdOn =Carbon::now();
         $track->createdBy = Auth::user()->id; 
         $track->activity_type = "2";
         $track->regionId= $request->region_id;
         $track->save();
 
          return $data? back()->with('message','Task assigned  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
          
      }

      public function getReInspectionFormView($id)
      {
        $decodeId = Crypt::decrypt($id);
       
    // For certificate_app query
    $certificate = CertificateApp::find($decodeId); // Returns single model or null

    
                $list = Staff::all();

                return view('task.re-inspection-form',['certificate'=>$certificate, 'list'=>$list]);
        
 
        } 

         public function getPermitReInspectionFormView($id)
      {
        $decodeId = Crypt::decrypt($id);
       
    // For permit_app query
     $permit = PermitApp::find($decodeId); // Returns single model or null

    
                $list = Staff::all();

                return view('task.permit-re-inspection-form',['permit'=>$permit, 'list'=>$list]);
        
 
        } 
    
        public function addAuthorize(Request $request)
        {


            $sendSMS = new SmsController();

            $companyName = request()->input('companyName');
            $location = request()->input('location');
            $tel = request()->input('tel');

            // Get officer first
           $officer = Staff::findOrFail($request->officer);
           $officerName = $officer->firstname.' '.$officer->surname;
           $officerphone = $officer->phone;

            $data =  new AuthorizationApp();
            $data->renew_app_id = $request->renew_id;
            $data->assigned_officer = $request->officer;
            $data->purpose = $request->activity;
            $data->date = $request->datee;
            $data->applicant_id = $request->cert_id;
            $data->form_type = "certificate_app";
            $data->created_on =Carbon::now();
            $data->created_by = Auth::user()->id; 
            $data->save();

            $cert =  new Task();
            $cert->description = $request->activity;
            $cert->assignee = $request->officer; 
            $cert->application_id = $request->cert_id;
            $cert->createdOn = Carbon::now();
            $cert->createdBy = Auth::user()->id; 
            $cert->taskType = "certificateRenewal";
            $cert->status = "Active";
            $cert->region_id = $request->region_id;
            $cert->save();

            CertificateApp::where('id', $request->cert_id)
            ->update([
                'status' => "Authorize"
            ]);
            $message = 'Hello  '.$officerName.', you have been assigned a task for inspection of '.$companyName.' at '.$location.'. You may contact the proponent on '.$tel.' for further directions.
             Thank you' ;
            $sendSMS->sendSMS($officerphone,$message);
             return $data? back()->with('message','Authorization Made Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }
    


         public function addPermitAuthorize(Request $request)
        {


            $sendSMS = new SmsController();

            $companyName = request()->input('companyName');
            $location = request()->input('location');
            $tel = request()->input('tel');

            // Get officer first
           $officer = Staff::findOrFail($request->officer);
           $officerName = $officer->firstname.' '.$officer->surname;
           $officerphone = $officer->phone;

            $data =  new AuthorizationApp();
            $data->renew_app_id = $request->renew_id;
            $data->assigned_officer = $request->officer;
            $data->purpose = $request->activity;
            $data->date = $request->datee;
            $data->applicant_id = $request->cert_id;
            $data->form_type = "permit_app";
            $data->created_on =Carbon::now();
            $data->created_by = Auth::user()->id; 
            $data->save();

            $cert =  new Task();
            $cert->description = $request->activity;
            $cert->assignee = $request->officer; 
            $cert->application_id = $request->cert_id;
            $cert->createdOn = Carbon::now();
            $cert->createdBy = Auth::user()->id; 
            $cert->taskType = "permitRenewal";
            $cert->status = "Active";
            $cert->region_id = $request->region_id;
            $cert->save();

            PermitApp::where('id', $request->cert_id)
            ->update([
                'status' => "Authorize"
            ]);
            $message = 'Hello  '.$officerName.', you have been assigned a task for inspection of '.$companyName.' at '.$location.'. You may contact the proponent on '.$tel.' for further directions.
Thank you' ;

            $sendSMS->sendSMS($officerphone,$message);
    
             return $data? back()->with('message','Authorization Made Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }
  
    public function getRegionalAssignmentView()
    {

        $list = Region::all();
        return view('task.RegionalAssignment',['list'=>$list]);
    }

      /*searching for application*/
     public function searchProcess (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $table = "";
 
        if($operation == "equal"){
 
         $result = Formsale::where([[$field,$parameter]])->get();
 
        }else{
 
         $result = Formsale::where([[$field,'LIKE','%'.$parameter.'%']
         ])->get();
 
        }

        if($result->count() > 0){
  
            $table .= '<table id="example"  class="dt-select-table table">';
    
            $table .= '<thead> <tr>   <th><b>Company Name</b></th> <th><b>Telephone</b></th>  <th><b>Location</b></th><th><b>Region</b></th><th><b>Form Type</b></th> <th><b>Action</b></th> </tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {
                $table .= '<tr>';
                $table .= '<td>'.$item->applicantName.'</td>';
                $table .= '<td>'.$item->tell.' </td>';
                $table .= '<td>'.$item->location.'</td>';
               // Updated region column to show N/A if empty
            $table .= '<td>';
            $table .= (!empty($item->regionId) && $item->regs) ? $item->regs->name : 'N/A';
            $table .= '</td>';
                $table .= '<td>'.$item->formtype->formName.'</td>';
                $table .= '<td><a data-bs-toggle="modal"  id="showmodal" data-bs-target="#basicModal" data-url="'.route('get-app-id',$item->id).'"   class="btn btn-sm btn-primary" style="color:white"> Assign Region</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

        }
    public function getAppIDView($id)
    {
        $data = Formsale::find($id);
      return response()->json($data);
    }

    public function addassignRegion (Request $request)
    {
         $request->validate([
            'region' => 'required',
        ]);
         if ($request->form_type == 1) {
            // Update certificate_app

            Formsale::where('id', $request->app_id)
                ->update(['regionId' => $request->region]); 

            CertificateApp::where('formId', $request->app_id)
                ->update(['region' => $request->region]);
        } elseif ($request->formType_id == 2) {
            // Update permit_app
            Formsale::where('id', $request->app_id)
                ->update(['regionId' => $request->region]); 

            PermitApp::where('formId', $request->app_id)
                ->update(['region' => $request->region]);
        }

          return  back()->with('message','Region changed  Successfully');
    }

    public function getJobTrackerView(){
        return view('task.JobTracker');
    }

     /*searching for application*/
     public function JobTracker (Request $request){
        $field = $request->field;
    $operation = $request->operator;
    $parameter = $request->search_parameter;

    $table = "";

    // Base query with join
    $query = Formsale::leftJoin('certificate_app', 'formsales.id', '=', 'certificate_app.formId')
        ->select('formsales.*', 'certificate_app.status as cert_status', 'certificate_app.id as cert_id');

    // Apply search condition
    if ($operation == "equal") {
        $result = $query->where($field, $parameter)->get();
    } else {
        $result = $query->where($field, 'LIKE', '%' . $parameter . '%')->get();
    }

        if($result->count() > 0){
  
            $table .= '<table id="example"  class="dt-select-table table">';
    
            $table .= '<thead> <tr>   <th><b>Company Name</b></th> <th><b>Telephone</b></th>  <th><b>Form Type</b></th><th><b>Current Stage </b></th> <th><b>Action</b></th> </tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {
              
                $table .= '<tr>';
                $table .= '<td>'.$item->applicantName.'</td>';
                $table .= '<td>'.$item->tell.' </td>';
                $table .= '<td>'.$item->formtype->formName.'</td>';
                $table .= '<td>' . ($item->cert_status ?? 'N/A') . '  </td>';
                $table .= '<td><a href="'.route('view-job-tracker',Crypt::encrypt($item->id)).'" target="_"   class="btn btn-sm btn-primary" style="color:white"> View</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

        }

        public function getJobTrackerDetailView($id)
      {
            $decodeId = Crypt::decrypt($id);
        
            // Eager load the relationships
            $datas = Formsale::with(['certificates', 'trackers'])->findOrFail($decodeId);
            
            return view('task.view-job-tracker', [
                'datas' => $datas,
                'results' => $datas->trackers
            ]);
       }

       public function getApplicationScreeningView($id){
          $decodeID = Crypt::decrypt($id);
        $project = PermitRegistration::find($decodeID);
         $list = ScreenDecision::all();
        return view('task.application-screening',[
            'project' => $project,'list'=>$list
        ]);
           
       } 

       public function addScreening(Request $request){
        $request->validate([
        'evaluation' => 'required',
        'severity' => 'required',
        'recommendation' => 'required',
       
        
    ]);

    $insertApp = new Screening();
    $insertApp->formId = $request->permit_id;
    $insertApp->application_type = "permit";
    $insertApp->evaluation = $request->evaluation;
    $insertApp->severity = $request->severity;
    $insertApp->recommendation = $request->recommendation;
    $insertApp->region_id = $request->region_id;
    $insertApp->created_by = Auth::user()->id; 
     
    $insertApp->save();

    $track = new Tracker();
    $track->formID = $request->permit_id;
    $track->activity = "5";
    $track->createdOn =Carbon::now();
    $track->createdBy = Auth::user()->id; 
    $track->activity_type = "1";
    $track->regionId= $request->region_id;
    $track->save();

     PermitRegistration::where('id', $request->permit_id)
            ->update([
                'status' => "screened"
            ]);

    Task::where('application_id', $request->permit_id)
    ->update([
        'status' => "screened"
    ]);

   $billitem = BillItem::where('type', $request->type_id)->first(); // get first item
    $amount = $billitem ? $billitem->amount : 0;
     // Save to AnotherTable
    $appbill = new AppBill();
    $appbill->formId = $request->permit_id;
    $appbill->bill_type = $request->type_id;
    $appbill->bill_amount = $amount;
    $appbill->createdon =Carbon::now();
    $appbill->createdby = Auth::user()->id;
    $appbill->status =  "Active";
    $appbill->save();

  
   return $insertApp? back()->with('message_success','Application  Screened Successfully'): back()->with('message_error','Something went wrong, please try again.');

       }

       public function getAppScreeningView($id){
          $decodeID = Crypt::decrypt($id);
        $project = PermitRegistration::where('formID',$decodeID)->first();
         $list = ScreenDecision::all();
        return view('task.application-screening',[
            'project' => $project,'list'=>$list
        ]);
           
       } 

       public function getViewScreening($id)
       {
          $decodeID = Crypt::decrypt($id);
         $project = PermitRegistration::where('formID',$decodeID)->first();
       
         $listscreen = Screening::where('formId',$decodeID)->first();
        return view('task.viewScreening',[
            'project' => $project,'listscreen'=>$listscreen
        ]);
       }

}
