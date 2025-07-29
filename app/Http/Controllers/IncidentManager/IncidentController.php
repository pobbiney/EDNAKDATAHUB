<?php

namespace App\Http\Controllers\IncidentManager;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\IncidentCategory;
use App\Models\IncidentClass;
use App\Models\IncidentImage;
use App\Models\IncidentReport;
use App\Models\IncidentTask;
use App\Models\IncidentType;
use App\Models\Region;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IncidentController extends Controller
{
    public function getClassificationView(){
        $data = IncidentClass::all();
        return view('incident_manager.Setup',['data'=>$data]);
    }


    //Saving into Incident Classification Table
    public function addIncidentClass(Request $request){
        //Check for field validation
        $request->validate([
            'name' => 'required',
     
        ]);
        $data =  new IncidentClass();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        return $data? back()->with('message','Incident Classification  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }

    // Updating Incident Classification Table
    public function getEditClassificationView($id){

        $decodeId = Crypt::decrypt($id); // Decrypting Incident Classification id
        $list = IncidentClass::find($decodeId);
        $data = IncidentClass::all();

        return view('incident_manager.edit-incident-class',['id'=>$id,'data'=>$data,'list'=>$list]);

    }

    public function getEditClassification(Request $request ,$id){
         $request->validate([
            'name' => 'required',
            'status' => 'required',
     
        ]); 

    $decodeId = Crypt::decrypt($id);
     
    $data =  IncidentClass::find($decodeId);
    $data->name = $request->name;
    $data->description = $request->description;
    $data->status = $request->status;

    $data->save();
    return $data? back()->with('message','Incident Classification updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }

    public function getCategoryView()
    {
        $list = IncidentClass::all();
        $data = IncidentCategory::all();
        return view('incident_manager.incident-category',['list'=>$list,'data'=>$data]);

    }

    public function addIncidentCategory(Request $request){
        //Check for field validation
        $request->validate([
            'name' => 'required',
            'classification' => 'required',
     
        ]);
        $data =  new IncidentCategory();
        $data->name = $request->name;
        $data->incident_class = $request->classification;
        $data->description = $request->description;
        $data->save();
        return $data? back()->with('message','Incident Category  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }


    //Showing Incident Category Edit Form
    public function getEditCategoryView($id){
    
        $decodeId = Crypt::decrypt($id); // Decrypting Incident Category id
        $list = IncidentCategory::find($decodeId);
        $data = IncidentCategory::all();
        $class = IncidentClass::all();

        return view('incident_manager.edit-incident-category',['id'=>$id,'data'=>$data,'list'=>$list,'class'=>$class]);
    }

    //Showing Incident Type Form

    public function getIncidentTypeView(){
        $list = IncidentCategory::all();
        $data = IncidentType::all();
        return view('incident_manager.incident-type',['list'=>$list,'data'=>$data]);
    }

    //Updating Incident Category Table
    public function EditIncidentCategory(Request $request, $id)
    {
     
        $request->validate([
            'name' => 'required',
            'classification' => 'required',
     
        ]);
        $decodeId = Crypt::decrypt($id);
     
        $data =  IncidentCategory::find($decodeId);
        
        $data->name = $request->name;
        $data->incident_class = $request->classification;
        $data->description = $request->description;
        $data->save();
        return $data? back()->with('message','Incident Category  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }

    //Saving Incident Type
    public function addIncidentType(Request $request){

         //Check for field validation
         $request->validate([
            'name' => 'required',
            'category' => 'required',
     
        ]);
        $data =  new IncidentType();
        $data->name = $request->name;
        $data->class_id = $request->category;
      
        $data->save();
        return $data? back()->with('message','Incident Type  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }
    //Calling Incident Edit Type Form

    public function getEditTypeView($id){
        $list = IncidentCategory::all();
        $decodeId = Crypt::decrypt($id); // Decrypting Incident Type id
        $datas = IncidentType::find($decodeId);
        $data = IncidentType::all();
        return view('incident_manager.edit-incident-type',['id'=>$id,'list'=>$list,'datas'=>$datas,'data'=>$data]);
    }

    //Updating Incident type table
    public function EditIncidentType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
     
        ]);
        $decodeId = Crypt::decrypt($id);
     
        $data =  IncidentType::find($decodeId);
        
        $data->name = $request->name;
        $data->class_id = $request->category;
        $data->status = $request->status;
        $data->save();
        return $data? back()->with('message','Incident Category  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }

    public function getIncidentView(){
        $reg = Region::all();
        $cat = IncidentCategory::all();
        $type = IncidentType::all();
        $list = Incident::where('region_id', Auth::user()->region_id)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();
       
        return view('incident_manager.Add-Incident',['reg'=>$reg,'cat'=>$cat,'type'=>$type,'list'=>$list]);
    }

     /*Get All Type base on selected category*/
     public function findTypeData(Request $request){
  
        $data=IncidentType::select('name','id')->where('class_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    public function addIncident(Request $request){

         $request->validate([
            'region' => 'required',
            'category' => 'required',
            'type' => 'required',
            'location' => 'required',
            'description' => 'required',
            'name' => 'required',
            'phone' => 'required',
     
        ]);

         $data =  new Incident();
        $data->region_id = $request->region;
        $data->cat_id = $request->category;
        $data->type_id = $request->type;
        $data->location = $request->location;
        $data->narration = $request->description;
        $data->full_name = $request->name;
        $data->contact_no = $request->phone;
        $data->date =Carbon::now();
        $data->user_id = Auth::user()->id; 

         $data->save();

       if($request->hasFile('image'))
        {

        foreach($request->file ('image') as $img)
        {
        $destinationPath ='uploads/IncidentImages/';
        $imgpath = $img->getClientOriginalName();
        $img->move($destinationPath,$imgpath);
        $imgData = new IncidentImage();
        $imgData->incident_id=$data->id;
        $imgData->image=$imgpath;
        
        $imgData->save();
        }
       }
        return $data? back()->with('message','Incident   saved Successfully'): back()->with('message_error','Something went wrong, please try again.');

    }

    public function getEditIncidentView($id){

        $decodeId = Crypt::decrypt($id); // Decrypting Incident  id
        $datas = Incident::find($decodeId);
        $reg = Region::all();
        $cat = IncidentCategory::all();
        $type = IncidentType::all();
        $list = Incident::where('region_id', Auth::user()->region_id)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();
      
        return view('incident_manager.edit-incident',['id'=>$id,'reg'=>$reg,'cat'=>$cat,'type'=>$type,'list'=>$list,'datas'=>$datas]);
    }

    public function editIncident(Request $request, $id){

        $request->validate([
            'region' => 'required',
            'category' => 'required',
            'type' => 'required',
            'location' => 'required',
            'description' => 'required',
            'name' => 'required',
            'phone' => 'required',
     
        ]);
        $decodeId = Crypt::decrypt($id); 
        $data =  Incident::find($decodeId);
        
        $data->region_id = $request->region;
        $data->cat_id = $request->category;
        $data->type_id = $request->type;
        $data->location = $request->location;
        $data->narration = $request->description;
        $data->full_name = $request->name;
        $data->contact_no = $request->phone;
        $data->updated_on =Carbon::now();
        $data->updated_by = Auth::user()->id; 

         $data->save();

         if($request->hasFile('image'))
         {
 
         foreach($request->file ('image') as $img)
         {
         $destinationPath ='uploads/IncidentImages/';
         $imgpath = $img->getClientOriginalName();
         $img->move($destinationPath,$imgpath);
         $imgData = new IncidentImage();
         $imgData->incident_id=$data->id;
         $imgData->image=$imgpath;
         
         $imgData->save();
         }
        }
         return $data? back()->with('message','Incident updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
 

    }

    public function destroy_image($img_id)
    {
        $data=IncidentImage::where('id',$img_id)->first();
        Storage::delete($data->image);
        
        IncidentImage::where('id',$img_id)->delete();
        return response()->json(['bool'=>true]);
    }

    public function getManageIncidentView()
    {
        $reg = Region::all();
        $staf = Staff::all();
        $cat = IncidentCategory::all();
        $type = IncidentType::all();
        $list = Incident::where('region_id', Auth::user()->region_id)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();
        $data = $list->pluck('tasks')->flatten();
       
        return view('incident_manager.ManageIncident',['reg'=>$reg,'cat'=>$cat,'type'=>$type,'list'=>$list,'staf'=>$staf,'data'=>$data]);
    }

     public function getIcidentID($id)
  {
      $data = Incident::find($id);
      
      return response()->json($data);
  
  }

  public function AssignIncident(Request $request){
     //Check for field validation
         $request->validate([
            'staff' => 'required',
            'description' => 'required',
     
        ]);
        $data =  new IncidentTask();
        $data->incident_id = $request->IncidentID;
        $data->description = $request->description;
        $data->assignedto = $request->staff;
        $data->regionId =  Auth::user()->region_id; 
        $data->createdBy =  Auth::user()->id; 
      
        $data->save();
        return $data? back()->with('message','Incident Assigned   Successfully'): back()->with('message_error','Something went wrong, please try again.');
  }

    public function getTaskModalView($id)
  {
      $data = IncidentTask::find($id);
      return response()->json($data);
  
  }

  public function ReassignIncident(Request $request)
  {
    //Check for field validation
         $request->validate([
            'staff' => 'required',
            'description' => 'required',
     
        ]);
          $data =  IncidentTask::find($request->task_id);
        
        $data->description = $request->description;
        $data->assignedto = $request->staff;
  
      
        $data->save();
        return $data? back()->with('message','Incident Reassigned   Successfully'): back()->with('message_error','Something went wrong, please try again.');
  }

  public function getReportIncidentView(){

        
          $userID = Auth::id(); // Assuming the logged-in user
    
         $list = IncidentTask::where('assignedto', $userID)
        
        ->get();
       
        return view('incident_manager.IncidentReport',[ 'list'=>$list]);
  }

  public function getIncidentTypeID($id)
  {
      $data = IncidentTask::find($id);
      
      return response()->json($data);
  
  }

  public function addIncidentReport(Request $request){
    
        $request->validate([
            'feedback' => 'required',
            
     
        ]);
        $data =  new IncidentReport();
        $data->incident_id = $request->IncidentID;
        $data->assignedto = $request->assignedto;
        $data->feedback = $request->feedback;
        $data->region_id = $request->regionID;
      
         $data->save();

       if($request->hasFile('image'))
        {

        foreach($request->file ('image') as $img)
        {
        $destinationPath ='uploads/IncidentImages/';
        $imgpath = $img->getClientOriginalName();
        $img->move($destinationPath,$imgpath);
        $imgData = new IncidentImage();
        $imgData->incident_id= $request->IncidentID;
        $imgData->image=$imgpath;
        
        $imgData->save();
        }
       }
        return $data? back()->with('message','Report   saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
 


  }
    
}
