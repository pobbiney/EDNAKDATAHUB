<?php

namespace App\Http\Controllers\InspectionManager;

use App\Http\Controllers\Controller;
use App\Models\Accessroute;
use App\Models\Alarmandwarning;
use App\Models\Appaccessroute;
use App\Models\Appalarm;
use App\Models\AppBill;
use App\Models\Appfire;
use App\Models\Applicationmeansofescape;
use App\Models\Appmeansofescape;
use Illuminate\Http\Request;
use App\Models\CertificateApp;
use App\Models\Changerequest;
use App\Models\Drawingupload;
use App\Models\Firefighting;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Floortable;
use App\Models\Meansofescape;
use App\Models\Payment;
use App\Models\PermitApp;
use App\Models\Tracker;
use Carbon\Carbon;
 

class CertificateController extends Controller
{
    public function getCertificateView()
    {
        $list = CertificateApp::with(['tasks' => function ($query) {
            $query->where('assignee', Auth::user()->id)
                  ->where('taskType', 'certificate');
        }])
        ->where('status', 'Pending')
        ->whereHas('tasks', function ($query) {
            $query->where('assignee', Auth::user()->id)
          
            ->where('taskType', 'certificate');
        })
        ->get();
        return view('inspection_manager.Certificate',['list'=>$list]);
    }

    public function getCertificateInspectionDetails($id)
     {
        $decodeId = Crypt::decrypt($id);
        $datas = CertificateApp::find($decodeId);
        $list = CertificateApp::all();

        // Get related drawing uploads for this specific certificate
        $results = Drawingupload::where('appId', $decodeId)
        ->where('uploadType' ,'certificateApplication')
        ->get();

        $data = Meansofescape::where('status', 'Active')->get();
        $fire = Firefighting::where('status', 'Active')->get();
        $alarm = Alarmandwarning::where('status', 'Active')->get();
        $routes = Accessroute::where('status', 'Active')->get();
        
        return view('inspection_manager.view-inspection-cert-details',['id'=>$id,'datas'=>$datas,'list'=>$list,
        'results'=>$results,'data'=>$data,'fire'=>$fire,'alarm'=>$alarm,'routes'=>$routes]);
    }

     //inserting into floortable table//
     public function addFloor(Request $request)
     {
        
       
        foreach ($request->floor as $index => $floorNumber) {
            $floor = new Floortable();
            $floor->floorNumber = $floorNumber;
            $floor->length = $request->length[$index];
            $floor->breadth = $request->breadth[$index];
            $floor->applicationId = $request->certificateID;
            $floor->applicationType = "certificateApplication";
            $floor->save();
        }
         return $floor? back()->with('message','Floor saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
         
     }

     //inserting into means of escape
     public function addMeansOfescape(Request $request)
    {
            $validatedData = $request->validate([
            'ItemId' => 'required|array',
            'ItemId.*' => 'required|integer',
            'status' => 'required|array',
            'status.*' => 'required|in:Yes,No',
            'number' => 'array',
            'number.*' => 'nullable',
            'comment' => 'array',
            'comment.*' => 'nullable',
            'certID' => 'required|integer'
        ]);

        // Add conditional validation
        foreach ($request->status as $index => $status) {
            if ($status === 'Yes') {
                $request->validate([
                    "number.$index" => 'required|numeric|min:0',
                    "comment.$index" => 'required|string'
                ]);
            }
        }

        try {
            DB::beginTransaction();
            
            foreach ($request->ItemId as $index => $ItemId) {
                Appmeansofescape::create([
                    'ItemId' => $ItemId,
                    'status' => $request->status[$index],
                    'number' => $request->status[$index] === 'Yes' ? $request->number[$index] : null,
                    'location' => $request->status[$index] === 'Yes' ? $request->comment[$index] : null,
                    'applicationId' => $request->certID
                ]);
            }
            
            DB::commit();
            
            return back()->with('message', 'Means of Escape saved successfully!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error saving data: ' . $e->getMessage());
        }
    } 
    
      //inserting into fire fighting 
      public function addfireFighting(Request $request)
    {
         
            $validatedData = $request->validate([
            'ItemId' => 'required|array',
            'ItemId.*' => 'required|integer',
            'status' => 'required|array',
            'status.*' => 'required|in:Yes,No',
            'number' => 'array',
            'number.*' => 'nullable',
            'comment' => 'array',
            'comment.*' => 'nullable',
            'appID' => 'required|integer'
        ]);

        // Add conditional validation
        foreach ($request->status as $index => $status) {
            if ($status === 'Yes') {
                $request->validate([
                    "number.$index" => 'required|numeric|min:0',
                    "comment.$index" => 'required|string'
                ]);
            }
        }

        try {
            DB::beginTransaction();
            
            foreach ($request->ItemId as $index => $ItemId) {
                Appfire::create([
                    'ItemId' => $ItemId,
                    'status' => $request->status[$index],
                    'number' => $request->status[$index] === 'Yes' ? $request->number[$index] : null,
                    'location' => $request->status[$index] === 'Yes' ? $request->comment[$index] : null,
                    'applicationId' => $request->appID
                ]);
            }
            
            DB::commit();
            
            return back()->with('message', 'Fire Fighting Equipment saved successfully!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error saving data: ' . $e->getMessage());
        }
    }  

     //inserting into alarm devices  
     public function addAlarm(Request $request)
     {
         
            $validatedData = $request->validate([
            'ItemId' => 'required|array',
            'ItemId.*' => 'required|integer',
            'status' => 'required|array',
            'status.*' => 'required|in:Yes,No',
            'number' => 'array',
            'number.*' => 'nullable',
            'comment' => 'array',
            'comment.*' => 'nullable',
            'appID' => 'required|integer'
        ]);

        // Add conditional validation
        foreach ($request->status as $index => $status) {
            if ($status === 'Yes') {
                $request->validate([
                    "number.$index" => 'required|numeric|min:0',
                    "comment.$index" => 'required|string'
                ]);
            }
        }

        try {
            DB::beginTransaction();
            
            foreach ($request->ItemId as $index => $ItemId) {
                Appalarm::create([
                    'ItemId' => $ItemId,
                    'status' => $request->status[$index],
                    'number' => $request->status[$index] === 'Yes' ? $request->number[$index] : null,
                    'location' => $request->status[$index] === 'Yes' ? $request->comment[$index] : null,
                    'applicationId' => $request->appID
                ]);
            }
            
            DB::commit();
            
            return back()->with('message', ' Alarm And Warning Devices saved successfully!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error saving data: ' . $e->getMessage());
        }
    }
     //inserting into access route  
     public function addAccessRoute(Request $request)
     {
            
            $validatedData = $request->validate([
            'ItemId' => 'required|array',
            'ItemId.*' => 'required|integer',
            'status' => 'required|array',
            'status.*' => 'required|in:Yes,No',
            'number' => 'array',
            'number.*' => 'nullable',
            'comment' => 'array',
            'comment.*' => 'nullable',
            'appID' => 'required|integer'
        ]);

        // Add conditional validation
        foreach ($request->status as $index => $status) {
            if ($status === 'Yes') {
                $request->validate([
                    "number.$index" => 'required|numeric|min:0',
                    "comment.$index" => 'required|string'
                ]);
            }
        }

        try {
            DB::beginTransaction();
            
            foreach ($request->ItemId as $index => $ItemId) {
                Appaccessroute::create([
                    'ItemId' => $ItemId,
                    'status' => $request->status[$index],
                    'number' => $request->status[$index] === 'Yes' ? $request->number[$index] : null,
                    'location' => $request->status[$index] === 'Yes' ? $request->comment[$index] : null,
                    'applicationId' => $request->appID
                ]);
            }

            $app = Appaccessroute::findOrFail($request->appID);
            $appaccess = Appaccessroute::all(); // Your base data
            
            DB::commit();
            
            return back()->with('message', ' Access Route  saved successfully!',['app'=>$app]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error saving data: ' . $e->getMessage());
        }  
    }

     //inserting into access route  
     public function addInspectorGeneral(Request $request)
     {
        
        
        $data =  CertificateApp::find($request->appID);
        $data->risk = $request->risk;
        $data->recommended = $request->recommend;
        $data->reason = $request->reason;
        $data->approveFor = $request->approval;
        $data->status = "Inspected";
        $data->save();

        $track = new Tracker();
        $track->formID = $request->appID;
        $track->activity = "5";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "1";
        $track->regionId= $request->regionID;
        $track->save();

        Task::where('taskId', $request->appID)
        ->update([
            'status' => "completed"
        ]);
          
       
        return $data? back()->with('message','Approved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }  

    public function getSearchAppView()

    {
        return view('inspection_manager.search-app');
    }

     /*searching for application*/
     public function searchProcess (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $table = "";
 
        if($operation == "equal"){
 
         $result = CertificateApp::where([[$field,$parameter]])->get();
 
        }else{
 
         $result = CertificateApp::where([[$field,'LIKE','%'.$parameter.'%'],
         ['status','Pending']
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
                $table .= '<td><a href="'.route('view-inspection-cert-details',Crypt::encrypt($item->id)).'" target="_" class="btn btn-sm btn-primary" style="color:white"> Process</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

        }

        public function getCompletedInspectionView() 
        {
            $list = CertificateApp::with(['tasks' => function ($query) {
                $query->where('assignee', Auth::user()->id)
                      ->where('taskType', 'certificate');
            }])
            ->where('status', 'Inspected')
             
            ->whereHas('tasks', function ($query) {
                $query->where('assignee', Auth::user()->id)
              
                ->where('taskType', 'certificate');
            })
            ->get();

            $data = Changerequest::whereIn('requestTypeId', $list->pluck('id'))
    ->where('requestType', 'certificate')
    ->where('status', 'Active')
    ->pluck('requestTypeId')
    ->toArray();



            return view('inspection_manager.completed-inspection',['list'=>$list,'data'=>$data]);
        }

             //inserting into change request  
     public function addChangeRequest(Request $request)
     {
        
        $request->validate([
            'change_request' => 'required',
            
     
        ]);
        $data =  new Changerequest();
      
        $data->description = $request->change_request;
        $data->requestType = "certificate";
        $data->requestTypeId = $request->certID;
        $data->status = "Active";
        $data->createdBy = Auth::user()->id; 
        $data->createdOn = Carbon::now();
        $data->save();
        return $data? back()->with('message','Request Changes Successfully'): back()->with('message_error','Something went wrong, please try again.');
    } 

    /* get permit inspection form */

    public function getPermitInspectionView()

    {

        $list = PermitApp::with(['tasks' => function ($query) {
            $query->where('assignee', Auth::user()->id)
                  ->where('taskType', 'permit');
        }])
        ->where('status', 'Pending')
        ->whereHas('tasks', function ($query) {
            $query->where('assignee', Auth::user()->id)
          
            ->where('taskType', 'permit');
        })
        ->get();
        return view('inspection_manager.Permit-Inspection',['list'=>$list]);
        
    }

    public function getPermitInspectionDetails($id)
     {
        $decodeId = Crypt::decrypt($id);
        $datas = PermitApp::find($decodeId);
        $list = PermitApp::all();

        // Get related drawing uploads for this specific certificate
        $results = Drawingupload::where('appId', $decodeId)
        ->where('uploadType','permitApplication')
        ->get();

        $data = Meansofescape::where('status', 'Active')->get();
        $fire = Firefighting::where('status', 'Active')->get();
        $alarm = Alarmandwarning::where('status', 'Active')->get();
        $routes = Accessroute::where('status', 'Active')->get();
        
        return view('inspection_manager.view-inspection-permit-details',['id'=>$id,'datas'=>$datas,'list'=>$list,
        'results'=>$results,'data'=>$data,'fire'=>$fire,'alarm'=>$alarm,'routes'=>$routes]);
    }

         //inserting into floortable table//
         public function addPermitFloor(Request $request)
         {
            
           
            foreach ($request->floor as $index => $floorNumber) {
                $floor = new Floortable();
                $floor->floorNumber = $floorNumber;
                $floor->length = $request->length[$index];
                $floor->breadth = $request->breadth[$index];
                $floor->applicationId = $request->certificateID;
                $floor->applicationType = "permitApplication";
                $floor->save();
            }
             return $floor? back()->with('message','Floor saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
             
         }

          //inserting into access route  
     public function addPermitInspectorGeneral(Request $request)
     {
        
        
        $data =  PermitApp::find($request->appID);
      
        $data->risk = $request->risk;
        $data->recommended = $request->recommend;
        $data->reason = $request->reason;
        $data->approveFor = $request->approval;
        $data->status = "pendingBilling";
        $data->save();

        $track = new Tracker();
        $track->formID = $request->appID;
        $track->activity = "5";
        $track->createdOn =Carbon::now();
        $track->createdBy = Auth::user()->id; 
        $track->activity_type = "2";
        $track->regionId= $request->regionID;
        $track->save();
          
       
        return $data? back()->with('message','Approved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }  

    public function getCompletedPermitView() 
    {
        $list = PermitApp::with(['tasks' => function ($query) {
            $query->where('assignee', Auth::user()->id)
                  ->where('taskType', 'permit');
        }])
        ->where('status', 'Inspected')
        
        ->whereHas('tasks', function ($query) {
            $query->where('assignee', Auth::user()->id)
            ->where('taskType', 'permit');
        })
        ->get();

        $data = Changerequest::whereIn('requestTypeId', $list->pluck('id'))
        ->where('requestType', 'permit')
        ->where('status', 'Active')
        ->pluck('requestTypeId')
        ->toArray();

 

        return view('inspection_manager.completed-permit-inspection',['list'=>$list,'data'=>$data]);
    }

                 //inserting into change request  
                 public function addPermitChangeRequest(Request $request)
                 {
                    $request->validate([
                        'change_request' => 'required',
                        
                 
                    ]);
                    
                    $data =  new Changerequest();
                  
                    $data->description = $request->change_request;
                    $data->requestType = "permit";
                    $data->requestTypeId = $request->certID;
                    $data->status = "Active";
                    $data->createdBy = Auth::user()->id; 
                    $data->createdOn = Carbon::now();
                    $data->save();
                    return $data? back()->with('message','Request Changes Successfully'): back()->with('message_error','Something went wrong, please try again.');
                } 

                public function getSearchPermitAppView()

                {
                    return view('inspection_manager.search-permit-app');
                }
            
                 /*searching for application*/
                 public function searchProcessPermit (Request $request){
                    $field = $request->field;
                    $operation = $request->operator;
                    $parameter = $request->search_parameter;
            
                    $table = "";
             
                    if($operation == "equal"){
             
                     $result = PermitApp::where([[$field,$parameter]])->get();
             
                    }else{
             
                     $result = PermitApp::where([[$field,'LIKE','%'.$parameter.'%'],
                     ['status','Pending']
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
                            $table .= '<td><a href="'.route('view-inspection-permit-details',Crypt::encrypt($item->id)).'" target="_" class="btn btn-sm btn-primary" style="color:white"> Process</a></td>';
                            $table .= '</tr>';
                         }
               
                        $table .= '</tbody>';
                
                        $table .='</table>';
                
                        return $table;
                
                
                       }else{
                
                        return "no data";
                
                       }
            
                    }   
        public function getChangeRequestView() 
        {
            $list = Changerequest::where('status', 'Active')->get();
            return view('inspection_manager.ChangeRequest',['list'=>$list]);
        }   
        public function getChangeRequestModalView($id)
        {
            $data = Changerequest::find($id);
            return response()->json($data);
        
        }   
        
        public function addProcessChangeRequest(Request $request)
        {
            $request->validate([
                'description' => 'required',
                'status' => 'required',
                
         
            ]);
            
            $data =  Changerequest::find($request->RequestID);
          
            $data->comments = $request->description;
           
            $data->status = $request->status;
            $data->approvedBy = Auth::user()->id; 
            $data->approvedOn = Carbon::now();
            $data->save();
            return $data? back()->with('message','Process Change Request Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }

        public function getapprovedRequestView()
        {
            $list = Changerequest::where('status','!=', 'Active')->get();
            return view ('inspection_manager.approved-request',['list'=>$list]);
        }

        public function getMyTaskView()
        {
            $userID = Auth::id(); // Assuming the logged-in user
    
            $tasks = Task::with(['certificateApp', 'assignees'])
            ->where('assignee', $userID)
            ->where('status', 'Active')
            ->where('taskType', 'certificate')
            
            ->get();
    
      
        
            
            return view('task.MyTask', ['tasks'=>$tasks]);
        }
    
    public function getPendingMyTaskView(){

            $userID = Auth::id(); // Assuming the logged-in user
    
            $tasks = Task::with(['permitapp', 'assignees'])
            ->where('assignee', $userID)
            ->where('status', 'Active')
            ->where('taskType', 'permit')
          
            ->get();
    
     
        
            
            return view('task.pending-permit-task-assignment', ['tasks'=>$tasks]);

    }
    public function getCompletedTaskView()
    {
        $userID = Auth::id(); // Assuming the logged-in user
    
        $tasks = Task::with(['certificateApp', 'assignees'])
        ->where('assignee', $userID)
        ->where('status', 'Completed')
        ->where('taskType', 'certificate')
       
        ->get();

        return view('task.completed-task', ['tasks'=>$tasks]);

    }
    public function getCompletedPermitTaskView()
    {
        $userID = Auth::id(); // Assuming the logged-in user
    
        $tasks = Task::with(['permitapp', 'assignees'])
        ->where('assignee', $userID)
        ->where('status', 'Completed')
        ->where('taskType', 'permit')
       
        ->get();

        return view('task.completed-permit-task', ['tasks'=>$tasks]);

    }
   
    public function getRenewalAssignmentView()
    {

       $results = CertificateApp::select([
            'id',
            'firstname',
            'surname',
            'companyName',
            'location',
            'tel',
            'email',
            'formId'
        ])
        ->where('status', 'pendingProcessing')
        ->where('formType', 5)
        ->where('region', Auth::user()->region_id) // Added region filter like in your other method
        ->get();
        return view('task.Renewal-Assignment',['results'=>$results]);
    }

    /* Fetching data from certicate and renewal_app table for permit renewal inspection */
     public function getPermitRenewalAssignmentView()
    {

        $results = PermitApp::select([
            'id',
            'firstname',
            'surname',
            'companyName',
            'location',
            'tel',
            'email',
            'formId'
        ])
       ->where('status', 'pendingProcessing')
        ->where('formType', 6)
        ->where('region', Auth::user()->region_id) // Added region filter like in your other method
        ->get();

    
        return view('task.Permit-Renewal-Assignment',['results'=>$results]);
    }

    public function getRenewalApp(){

        $tasks = CertificateApp::where('formType', 5)
        ->where('region',Auth::user()->region_id)
        ->get();
        return view('task.renewal-certificate-app',['tasks'=>$tasks]);
    }

    public function getRenewalPermitApp(){

        $tasks = CertificateApp::where('formType', 6)
        ->where('region',Auth::user()->region_id)
        ->get();
        return view('task.renewal-permit-app',['tasks'=>$tasks]);
    }
}
