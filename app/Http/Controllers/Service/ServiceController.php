<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommanderProfileFormRequest;
use App\Http\Requests\DistrictFormRequest;
use App\Http\Requests\RankClassFormRequest;
use App\Http\Requests\RankFormRequest;
use App\Http\Requests\RegionFormRequest;
use App\Http\Requests\StationFormRequest;
use App\Models\Department;
use App\Models\District;
use App\Models\Rank;
use App\Models\RankClass;
use App\Models\RegBrief;
use App\Models\Region;
use App\Models\RegCommand;
use App\Models\Station;
use App\Models\Staff;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function getRegionView()
    {
        $list = Region::all();
        return view('service.Region',['list'=>$list]);
    }

    //inserting into region table//
    public function addRegion(RegionFormRequest $request)
    {
        $validateData = $request->validated();
        if(Region::where('name',$validateData['name'])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{
        $data = new Region();
        $data->name = $validateData['name'];
        $data->description = $validateData['description'];
        $data->code = $validateData['code'];
        $data->status = "active";
        $data->save();
        return $data? back()->with('message_success','Region saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }
    }
    public function getEditRegionView($id){
        
            $decodeId = Crypt::decrypt($id);
            $datas = Region::find($decodeId);
            $list = Region::all();
            
            return view('service.edit-region',['id'=>$id,'datas'=>$datas,'list'=>$list]);
            
           
    }
   //update region records//
    public function editRegion(RegionFormRequest $request, $id){
        $decodeId = Crypt::decrypt($id);
        $validateData = $request->validated();
        $data =  Region::find($decodeId);
        $data->name = $validateData['name'];
        $data->description = $validateData['description'];
        $data->code = $validateData['code'];
        $data->save();
        return back()->with('message_success','Region updated Successfully'); 
    }

    //Show district form//
    public function getDistrictView()
    {
        $dist = District::all();
        $list = Region::all();
        return view('service.District',['list'=>$list,'dist'=>$dist]);
    }

    //inserting into district table//
    public function addDistrict(DistrictFormRequest $request)
    {
        $validateData = $request->validated();
        if(District::where('name',$validateData['name'])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{
        $data = new District();
        $data->name = $validateData['name'];
       
        $data->region_id = $validateData['region'];
        $data->status = "active";
        $data->save();
        return $data? back()->with('message_success','District saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }
    }
    public function getEditDistrictView($id){
        
        $decodeId = Crypt::decrypt($id);
        $datas = District::find($decodeId);
        $dist = District::all();
        $regs = Region::all();
        
        return view('service.edit-district',['id'=>$id,'datas'=>$datas,'dist'=>$dist,'regs'=>$regs]);
        
       
}

public function editDistrict(DistrictFormRequest $request,$id)
{
    $decodeId = Crypt::decrypt($id);
    $validateData = $request->validated();
    $data =  District::find($decodeId);
    $data->name = $validateData['name'];
    $data->region_id = $validateData['region'];
    $data->save();
    return $data? back()->with('message_success','District updated Successfully'): back()->with('message_error','Something went wrong, please try again.');

}
      //Show Station form//
      public function getStationView()
      {
          $dist = District::all();
          $list = Region::all();
          $stat = Station::all();
          return view('service.Station',['list'=>$list,'dist'=>$dist,'stat'=>$stat]);
      }

      /*Get All districts base on selected region*/
    public function findRegionData(Request $request){
  
        $data=District::select('name','id')->where('region_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}

     //inserting into station table//
     public function addStation(StationFormRequest $request)
     {
        
         $validateData = $request->validated();
         if(Station::where('name',$validateData['name'])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{
         $data = new Station();
         $data->name = $validateData['name'];
         $data->region_id = $validateData['region'];
         $data->district_id = $validateData['district'];
         $data->town = $validateData['town'];
         $data->gps = $validateData['gps'];
         $data->created_by = Auth::user()->id; 
         $data->status = "active";
         $data->save();
         return $data? back()->with('message_success','Office saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
        }
     }

     public function getEditStationView($id){
        
        $decodeId = Crypt::decrypt($id);
        
        $datas = Station::find($decodeId);
        $dist = District::all();
        $regs = Region::all();
        $stat = Station::all();
        
        return view('service.edit-station',['id'=>$id,'datas'=>$datas,'dist'=>$dist,'regs'=>$regs,'stat'=>$stat]);
        
       
}
public function editStation(StationFormRequest $request,$id)
{
    $decodeId = Crypt::decrypt($id);
    $validateData = $request->validated();
    $data =  Station::find($decodeId);
    $data->name = $validateData['name'];
    $data->region_id = $validateData['region'];
    $data->district_id = $validateData['district'];
    $data->town = $validateData['town'];
    $data->gps = $validateData['gps'];
    $data->updated_by = Auth::user()->id; 
    $data->status = "active";
    $data->save();
    return $data? back()->with('message_success','Office saved Successfully'): back()->with('message_error','Something went wrong, please try again.');

}

  //Show Rank Classification form//
  public function getRankClassView()
  {
       $list = RankClass::all();
      return view('service.rank-class',['list'=>$list]);
  }

  public function addRankClass(RankClassFormRequest $request)
  {
     
      $validateData = $request->validated();
      if(RankClass::where('name',$validateData['name'])->get()->count() > 0){

         return back()->with('message_error','Record already exist');

     }else{
      $data = new RankClass();
      $data->name = $validateData['name'];
      $data->description = $validateData['description'];
      $data->status = $validateData['status'];
      $data->save();
      return $data? back()->with('message_success','Rank Classification saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
     }
  }

  public function getEditRankClassView($id){
        
    $decodeId = Crypt::decrypt($id);
    $datas = RankClass::find($decodeId);
    $list = RankClass::all();
    return view('service.edit-rank-class',['id'=>$id,'datas'=>$datas,'list'=>$list]);
    
   
}

public function editRankClass(RankClassFormRequest $request,$id)
{
    $decodeId = Crypt::decrypt($id);
    $validateData = $request->validated();
    $data =  RankClass::find($decodeId);
    $data->name = $validateData['name'];
    $data->description = $validateData['description'];
    $data->status = $validateData['status'];
    
    $data->save();
    return $data? back()->with('message_success','Rank Classification saved Successfully'): back()->with('message_error','Something went wrong, please try again.');

}

  //Show Rank  form//
  public function getRankView()
  {
       $list = RankClass::all();
       $clas = Rank::all();
      return view('service.rank',['list'=>$list,'clas'=>$clas]);
  }

  public function addRank(RankFormRequest $request)
  {
     
      $validateData = $request->validated();
      if(Rank::where('name',$validateData['name'])->get()->count() > 0){

         return back()->with('message_error','Record already exist');

     }else{
      $data = new Rank();
      $data->name = $validateData['name'];
      $data->rank_class = $validateData['classification'];
      $data->description = $validateData['description'];
      $data->status = $validateData['status'];
      $data->save();
      return $data? back()->with('message_success','Rank  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
     }
  }

  public function getEditRankView($id){
        
    $decodeId = Crypt::decrypt($id);
    $datas = Rank::find($decodeId);
    $list = RankClass::all();
    $clas = Rank::all();
    return view('service.edit-rank',['id'=>$id,'datas'=>$datas,'list'=>$list,'clas'=>$clas]);
    
   
}

public function editRank(RankFormRequest $request,$id)
{
    $decodeId = Crypt::decrypt($id);
    $validateData = $request->validated();
    $data =  Rank::find($decodeId);
    $data->name = $validateData['name'];
    $data->rank_class = $validateData['classification'];
    $data->description = $validateData['description'];
    $data->status = $validateData['status'];
    
    $data->save();
    return $data? back()->with('message_success','Rank  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');

}

  //Show Regional Commander   form//
  public function getRegionalCommanderView()
  {
       $list = Region::all();
       $staf = Staff::all();
       $rak = Rank::all();
      return view('service.RegionalCommander',['list'=>$list,'staf'=>$staf,'rak'=>$rak]);
  }

   /*Get region id*/
   public function getCommanderModalView($id)
   {
       $data = Region::find($id);
       return response()->json($data);
   
   }
   public function getCommanderModalView1($id)
   {
       $data = Region::find($id);
       return response()->json($data);
   
   }

   public function addCommander(Request $request)
   {
      
    $request->validate([
        'staff' => 'required',
        'profile'=>'required',
        'education'=>'required',
        'work'=>'required',
        'courses'=>'required',
        'dob'=>'required',
        'marital_status'=>'required',
        'children'=>'required',
        'hobbies'=>'required',
        'rank'=>'required',

    ]);
       if(RegCommand::where('staffID',$request->staff)->get()->count() > 0){
 
          return back()->with('message_error','Record already exist');
 
      }else{
       $data = new RegCommand();
       $data->staffID = $request->staff;
       $data->region_id = $request->region_id;
     
       $data->profile = $request->profile;
       $data->education = $request->education;
       $data->work =$request->work;
       $data->courses = $request->courses;
       $data->dob = $request->dob;
       $data->marital_status =$request->marital_status;
       $data->number_children = $request->children;
       $data->hobbies = $request->hobbies;
       $data->rank = $request->rank;
 
       if($request->hasFile('photo')){
        $file = $request->file('photo');
        $ext = $file->getClientOriginalExtension();
        $filename =time().'.'.$ext;
        $file->move('uploads/CommanderPhotos/',$filename);
        $data->image = $filename;
      }
       
       $data->created_by = Auth::user()->id; 
      
       $data->status = "active";
       $data->save();
       return $data? back()->with('message_success','Profile  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
      }
   }

    //Show Regional Commander   form//
  public function getListCommandersView()
  {
       $list = RegCommand::all();
       $staf = Staff::all();
       $reg = Region::all();
       $rak = Rank::all();
      return view('service.ListCommanders',['list'=>$list,'reg'=>$reg,'staf'=>$staf,'rak'=>$rak]);
  }

  public function getEditCommanderModalView($id)
  {
      $data = RegCommand::find($id);
      return response()->json($data);
  
  }

  public function editCommander(Request $request)
   {
  $request->validate([
    'staff' => 'required',
    'profile'=>'required',
    'education'=>'required',
    'work'=>'required',
    'courses'=>'required',
    'dob'=>'required',
    'marital_status'=>'required',
    'children'=>'required',
    'hobbies'=>'required',
    'region'=>'required',
    'status'=>'required',
    'rank'=>'required'

]);
 
   $data =  RegCommand::find($request->commander_id);
   $data->staffID = $request->staff;
   $data->region_id = $request->region_id;
   
   $data->profile = $request->profile;
   $data->education = $request->education;
   $data->work =$request->work;
   $data->courses = $request->courses;
   $data->dob = $request->dob;
   $data->marital_status =$request->marital_status;
   $data->number_children = $request->children;
   $data->hobbies = $request->hobbies;
   $data->rank = $request->rank;
   $data->region_id = $request->region;
   if($request->hasFile('photo')){
    $file = $request->file('photo');
    $ext = $file->getClientOriginalExtension();
    $filename =time().'.'.$ext;
    $file->move('uploads/CommanderPhotos/',$filename);
    $data->image = $filename;
  }
   
   $data->updatedby = Auth::user()->id; 
  
   $data->status = $request->status;
   $data->save();
   return $data? back()->with('message_success','Profile  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
  
}
  //Show Regional Commander   form//
  public function getBriefHistoryView()
  {
       $list = Region::all();
       $staf = Staff::all();
      return view('service.BriefHistory',['list'=>$list,'staf'=>$staf]);
  }

  public function addRegHistory(Request $request)
  {
     
   $request->validate([
       'staff' => 'required',
       'history'=>'required',
       'about_region'=>'required',
       'staff_strength'=>'required',
       'location'=>'required',
       'gps'=>'required',
       'telephone'=>'required',
       

   ]);
      if(RegBrief::where('region_id',$request->region_id)->get()->count() > 0){

         return back()->with('message_error','Record already exist');

     }else{
      $data = new RegBrief();
      
      $data->region_id = $request->region_id;
      $data->staff_id = $request->staff;
      $data->reg_history = $request->history;
      $data->about_reg = $request->about_region;
      $data->strength =$request->staff_strength;
      $data->location = $request->location;
      $data->gps = $request->gps;
      $data->tel =$request->telephone;
     
      $data->created_by = Auth::user()->id; 
    
      $data->save();
      return $data? back()->with('message_success','Profile  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
     }
  }

  public function getListListRegionsView()
  {
       $list = RegBrief::all();
       $staf = Staff::all();
       $reg = Region::all();
     
      return view('service.ListRegions',['list'=>$list,'reg'=>$reg,'staf'=>$staf]);
  }

  /*Getting Region Brief id */
  public function getEditRegionBriefModalView($id)
  {
      $data = RegBrief::find($id);
      return response()->json($data);
  
  }

  public function editRegHistory(Request $request)
  {
     
   $request->validate([
       'staff' => 'required',
       'history'=>'required',
       'about_region'=>'required',
       'staff_strength'=>'required',
       'location'=>'required',
       'gps'=>'required',
       'telephone'=>'required',
       'status'=>'required'
       

   ]);
      
     $data =  RegBrief::find($request->region_id);
      
      $data->status = $request->status;
      $data->staff_id = $request->staff;
      $data->reg_history = $request->history;
      $data->about_reg = $request->about_region;
      $data->strength =$request->staff_strength;
      $data->location = $request->location;
      $data->gps = $request->gps;
      $data->tel =$request->telephone;
     
      $data->updated_by = Auth::user()->id; 
    
      $data->save();
      return $data? back()->with('message_success','Profile updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
     
  }

  public function getDepartmentView()
  {
        
       $list = Department::all();
      return view('service.department',['list'=>$list]);
  }

  /*saving Department*/ 
  public function addDepartment(Request $request)
  {
    $request->validate([
        'name' => 'required',
        'responsibility'=>'required',
        'purpose'=>'required',
         
 
    ]);
      
      if(Department::where('name',$request->name)->get()->count() > 0){

          return back()->with('message_error','Record already exist');

      }else{
      $data = new Department();
      $data->name = $request->name;
      $data->purpose = $request->purpose;
      $data->responsibility = $request->responsibility;
      $data->status = "Active";
      $data->save();
      return $data? back()->with('message_success','Department saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
      }
  }

  public function getEditDepartmentView($id)
{
    $decodeId = Crypt::decrypt($id);
    $datas = Department::find($decodeId);
    $list = Department::all();
    
    return view('service.edit-department',['id'=>$id,'datas'=>$datas,'list'=>$list]);
}

public function editDepartment(Request $request,$id){

$request->validate([
    'name' => 'required',
    'responsibility'=>'required',
    'purpose'=>'required',
     

]);
$decodeId = Crypt::decrypt($id);

$data =  Department::find($decodeId);
$data->name = $request->name;
$data->purpose = $request->purpose;
$data->responsibility = $request->responsibility;
$data->status = $request->status;

$data->save();
return $data? back()->with('message_success','Department  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');

}
public function getUnitView()
{
      
     $list = Unit::all();
     $dep = Department::all();
    return view('service.unit',['list'=>$list,'dep'=>$dep]);
}

/*add unit */
public function addUnit(Request $request)
{
  $request->validate([
      'name' => 'required',
      'department'=>'required',
      

  ]);
    
    if(Unit::where('name',$request->name)->get()->count() > 0){

        return back()->with('message_error','Record already exist');

    }else{
    $data = new Unit();
    $data->name = $request->name;
    $data->department_id = $request->department;
  
    
    $data->save();
    return $data? back()->with('message_success','Unit saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }
}
/*get unit id*/
public function getEditUnitView($id)
{
    $decodeId = Crypt::decrypt($id);
    $datas = Unit::find($decodeId);
    $list = Unit::all();
    $dep = Department::all();
    
    return view('service.edit-unit',['id'=>$id,'datas'=>$datas,'list'=>$list,'dep'=>$dep]);
}

public function editUnit(Request $request,$id){

    $request->validate([
        'name' => 'required',
        'department'=>'required',
        
    
    ]);
    $decodeId = Crypt::decrypt($id);
    
    $data =  Unit::find($decodeId);
    $data->name = $request->name;
    $data->department_id = $request->department;
   
    $data->status = $request->status;
    
    $data->save();
    return $data? back()->with('message_success','Unit  saved Successfully'): back()->with('message_error','Something went wrong, please try again.');
    
    }

    public function getCommanderView($id)
    {
        $decodeId = Crypt::decrypt($id);
        $datas = RegCommand::find($decodeId);
        
        
        return view('service.view-commander',['id'=>$id,'datas'=>$datas]);
    }

    public function getRegionProfileView($id)
    {
        $decodeId = Crypt::decrypt($id);

        $datas = RegBrief::find($decodeId);
        return view('service.view-region',['id'=>$id,'datas'=>$datas]);
    }
}
