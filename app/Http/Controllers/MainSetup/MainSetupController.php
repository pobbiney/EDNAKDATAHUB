<?php

namespace App\Http\Controllers\MainSetup;

use Carbon\Carbon;
use App\Models\Phase;
use App\Models\Activity;
use App\Models\ProjectType;
use App\Models\ActivityType;
use App\Models\Businesstype;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\Businessclass;
use App\Models\ProjectSector;
use App\Models\ProjectCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Controllers\HasMiddleware;

class MainSetupController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function facilityView (){

        $busCLass = Businessclass::orderBy('name','ASC')->get();
        $busType = Businesstype::orderBy('name','ASC')->get();

        return view ('main-setup.facility-view',[
            'busCLass' => $busCLass,
            'busType' => $busType
        ]);
    }

      public function typefacilityView (){

        $busCLass = Businessclass::orderBy('name','ASC')->get();
        $busType = Businesstype::orderBy('name','ASC')->get();

        return view ('main-setup.facility-type',[
            'busCLass' => $busCLass,
            'busType' => $busType
        ]);
    }

    public function insertFacilityProcess (Request $request){

        $request->validate([
            'classification' => 'required'
        ]);


        if(Businessclass::where('name',$request->classification)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Businessclass();
            $insertCat->name = trim($request->classification);
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Classification added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function facilityEditView ($id){

        $decodeID = Crypt::decrypt($id);
        $busCLass = Businessclass::orderBy('name','ASC')->get();
        $data = Businessclass::find($decodeID);

        return view ('main-setup.edit-facility-view',[
            'busCLass' => $busCLass,
            'data' => $data,
            'id' => $id
        ]);
    }

    public function updateFacilityProcess (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'classification' => 'required',
            'status' => 'required'
        ]);


        $insertCat =  Businessclass::find($decodeID);
        $insertCat->name = trim($request->classification);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Classification updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function insertFacilityTypeProcess (Request $request){

        $request->validate([
            'type_name' => 'required',
            'type_classification' => 'required'
        ]);


        if(Businesstype::where([['name',$request->name],['busClassId' ,$request->type_classification]])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Businesstype();
            $insertCat->name = trim($request->type_name);
            $insertCat->description = $request->description;
            $insertCat->busClassId = $request->type_classification;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function facilityTypeEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $busCLass = Businessclass::orderBy('name','ASC')->get();
        $data = Businesstype::find($decodeID);
         $busType = Businesstype::orderBy('name','ASC')->get();

        return view ('main-setup.edit-facility-type-view',[
            'busCLass' => $busCLass,
            'id' => $id,
            'data' => $data,
             'busType' => $busType
        ]);
    }

    public function insertFacilityTypeEditProcess (Request $request, $id){

        $decodeID = Crypt::decrypt($id);


        $request->validate([
            'type_name' => 'required',
            'type_classification' => 'required',
            'status' => 'required'
        ]);


        $insertCat = Businesstype::find($decodeID);
            $insertCat->name = trim($request->type_name);
            $insertCat->description = $request->description;
            $insertCat->busClassId = $request->type_classification;
            $insertCat->status = $request->status;
            $insertCat->updatedBy = Auth::User()->id;
            $insertCat->updatedOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function activityView (){

         $activityClass = ActivityType::orderBy('name','ASC')->get();
         $activity = Activity::orderBy('activity','ASC')->get();

        return view ('activity-setup.activity',[
            'activityClass' => $activityClass,
            'activityList' => $activity
        ]);
    }

     public function AddactivityView (){

         $activityClass = ActivityType::orderBy('name','ASC')->get();
         $activity = Activity::orderBy('activity','ASC')->get();

        return view ('activity-setup.add-activity',[
            'activityClass' => $activityClass,
            'activityList' => $activity
        ]);
    }


    public function addActivityTypeProcess (Request $request){

        $request->validate([
            'type' => 'required'
        ]);


        if(ActivityType::where('name',$request->type)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new ActivityType();
            $insertCat->name = trim($request->type);
            $insertCat->status = 'Active';
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Activity type added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function editAddActivityTypeProcess($id){

        $decodeID = Crypt::decrypt($id);

        $data = ActivityType::find($decodeID);
         $activityClass = ActivityType::orderBy('name','ASC')->get();

        return view ('activity-setup.edit-activity',[
             'activityClass' => $activityClass,
            'data' => $data,
            'id' => $id
        ]);

    }

    public function updtaeActivityTypeProcess (Request $request,$id){
        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'type' => 'required',
            'status' => 'required'
        ]);


        $insertCat = ActivityType::find($decodeID);
        $insertCat->name = trim($request->type);
        $insertCat->status = $request->status;
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Activity type update successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function insertActivityProcess (Request $request){

        $request->validate([
            'activity' => 'required',
            'activity_type' => 'required'
        ]);


        if(Activity::where([['activity',$request->activity],['activity_type',$request->activity_type]])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Activity();
            $insertCat->activity = trim($request->activity);
            $insertCat->activity_type = $request->activity_type;
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Activity added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function editActivityView ($id){

        $decodeID = Crypt::decrypt($id);

        $activityClass = ActivityType::orderBy('name','ASC')->get();

        $data = Activity::find($decodeID);
        $activity = Activity::orderBy('activity','ASC')->get();
        

       return view ('activity-setup.edit-activity-main',[
        'activityList' => $activity,
           'activityClass' => $activityClass,
           'id' => $id,
           'data' => $data
           
       ]);
   }

   public function UpdateActivityProcess (Request $request,$id){

    $decodeID = Crypt::decrypt($id);

    $request->validate([
        'activity' => 'required',
        'activity_type' => 'required',
        'status' => 'required'
    ]);


    $insertCat = Activity::find($decodeID);
    $insertCat->activity = trim($request->activity);
    $insertCat->activity_type = $request->activity_type;
    $insertCat->description = $request->description;
    $insertCat->status = $request->status;
    $insertCat->updatedby = Auth::User()->id;
    $insertCat->updated_on = Carbon::now();
    $status = $insertCat->save();

    return $status ? back()->with('message_success','Activity updated successfully') : back()->with('message_error','Something went wrong, please try again.');


}

public function phaseView(){
    $listphase = Phase::all();
    return view ('main-setup.addPhase',['listphase'=>$listphase]);
}

 public function addPhase(Request $request){

         $request->validate([
            'name' => 'required',
         
            'status' => 'required',
             
        ]);

            $insertCat = new Phase();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Phase added successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function editphaseView($id){
     $decodeID = Crypt::decrypt($id);
     
    $data = Phase::find($decodeID);
    $listphase = Phase::all();
    return view ('main-setup.edit-phase',['listphase'=>$listphase,'data'=>$data,'id'=>$id]);
   }

   public function editphase(Request $request, $id)
   {
        $decodeID = Crypt::decrypt($id);
         $request->validate([
            'name' => 'required',
         
            'status' => 'required',
             
        ]);

           $insertCat = Phase::find($decodeID);
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Phase updated successfully') : back()->with('message_error','Something went wrong, please try again.');
   }

   public function projectsectorview()
   {
    $listsector = ProjectSector::all();
    return view('main-setup.Project-Sector',['listsector'=>$listsector]);
   }

    public function addSector(Request $request){

         $request->validate([
            'name' => 'required',
         
            'status' => 'required',
             
        ]);

            $insertCat = new ProjectSector();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Sector added successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function editsectorView($id){
     $decodeID = Crypt::decrypt($id);
     
    $data = ProjectSector::find($decodeID);
    $listsector = ProjectSector::all();
    return view ('main-setup.edit-sector',['listsector'=>$listsector,'data'=>$data,'id'=>$id]);
   }

    public function editSector(Request $request, $id)
   {
        $decodeID = Crypt::decrypt($id);
         $request->validate([
            'name' => 'required',
            'status' => 'required',
             
        ]);

            $insertCat = ProjectSector::find($decodeID);
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Sector updated successfully') : back()->with('message_error','Something went wrong, please try again.');
   }

    public function projectcategoryview()
   {
    $listsector = ProjectCategory::all();
    $sectorlist = ProjectSector::all();
    return view('main-setup.Project-Category',['listsector'=>$listsector,'sectorlist'=>$sectorlist]);
   }

    public function addCategory(Request $request){

         $request->validate([
            'name' => 'required',
            'status' => 'required',
            'sector'=> 'required'
             
        ]);

            $insertCat = new ProjectCategory();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description;
            $insertCat->sector_id = $request->sector;  
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Category added successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function editcategoryView($id){
     $decodeID = Crypt::decrypt($id);
     
    $data = ProjectCategory::find($decodeID);
    $sectorlist = ProjectSector::all();
    $listsector = ProjectCategory::all();
    return view ('main-setup.edit-category',['listsector'=>$listsector,'data'=>$data,'id'=>$id,'sectorlist'=>$sectorlist]);
   }

    public function editCategory(Request $request, $id)
   {
        $decodeID = Crypt::decrypt($id);
         $request->validate([
            'name' => 'required',
            'status' => 'required',
            'sector' => 'required'
             
        ]);

            $insertCat = ProjectCategory::find($decodeID);
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->sector_id = $request->sector; 
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Category updated successfully') : back()->with('message_error','Something went wrong, please try again.');
   }

   public function projecttypeview ()
   {
    $cat = ProjectCategory::all();
    $sec = ProjectSector::all();
    $typelist = ProjectType::all();
    return view('main-setup.Project-Type',['cat'=>$cat,'sec'=>$sec,'typelist'=>$typelist]);
   }

    public function addType(Request $request){

         $request->validate([
            'name' => 'required',
            'status' => 'required',
            'category'=> 'required',
            'sector'=> 'required',
             
        ]);

            $insertCat = new ProjectType();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->status = $request->status;
            $insertCat->category_id = $request->category; 
            $insertCat->sector_id = $request->sector;   
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type added successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

     public function edittypeView($id){
     $decodeID = Crypt::decrypt($id);
     
    $data = ProjectType::find($decodeID);
    $cat = ProjectCategory::all();
    $sec = ProjectSector::all();
    $typelist = ProjectType::all();
    return view ('main-setup.edit-type',['typelist'=>$typelist,'data'=>$data,'id'=>$id,'cat'=>$cat,'sec'=>$sec]);
   }

     public function editType(Request $request, $id){
        $decodeID = Crypt::decrypt($id);
         $request->validate([
            'name' => 'required',
            'status' => 'required',
            'category'=> 'required',
            'sector'=> 'required',
             
        ]);

            $insertCat = ProjectType::find($decodeID);
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description; 
            $insertCat->status = $request->status;
            $insertCat->category_id = $request->category; 
            $insertCat->sector_id = $request->sector;   
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type updated successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

      /*Get All Categories base on selected sector*/
    public function findCategoryData(Request $request){
  
        $data=ProjectCategory::select('name','id')->where('sector_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    //Get All Document Type base on selected Category
    public function findDocTypeData(Request $request){
        $data = DocumentType::select('name','id')->where('category_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
    }
}
