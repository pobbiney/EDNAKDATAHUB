<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BusClass;
use App\Models\Businessclass;
use App\Models\District;
use App\Models\Nationality;
use App\Models\Region;
use App\Models\Staff;
use App\Models\StaffCategory;
use App\Models\StaffClassification;
use App\Models\StaffNextofKin;
use App\Models\StaffType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;



class StaffController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

        public function addStaff()
    {
        
        return view('staff_management.create-staff');
    }

    public function editStaffView($staff_id)
    {
        $decodeId = Crypt::decrypt($staff_id);
        $datas = Staff::find($decodeId);
        
        return view('staff_management.edit-staff',['datas'=>$datas]);
    }

    public function CategoryView()
    {
        $data = StaffCategory::all();
        $datas = StaffType::all();
        $regs = StaffClassification::all();
        return view('staff_management.create-staff-category',['data'=>$data,'regs'=>$regs,'datas'=>$datas]);
    }

    public function listStaffView()
    {
        $data = Staff::all();
        
        return view('staff_management.list-staff',['data'=>$data]);
    }



    //save staff category
    public function createCategory(Request $request)
    {
        
        $validateData = $request;

        $validateData->validate([
            'name' => 'required',
            'status' => 'required'
        ]);


        $data = new StaffCategory;
        $data->name = $validateData['name'];
        $data->description=$request->description;
        $data->status = $validateData['status'];
        $data->created_by = Auth::user()->id;

        $data->created_on = date("Y-m-d H:i:s");
        $data->save();
        return back()->with('message','Staff Category saved Successfully');
    }

    //edit staff category view

    public function editCategoryView ($cat_id)
    {
        $data = StaffCategory::all();
        $decodeId = Crypt::decrypt($cat_id);
        $datas = StaffCategory::where('cat_id',$decodeId)->get()[0];
        return view('staff_management.edit-staff-category',['data'=>$data,'datas'=>$datas, 'cat_id'=>$cat_id]);
    }

    //update staff category table
    public function updatestaffCategory(Request $request,$cat_id)
    {
        $decodeId = Crypt::decrypt($cat_id);
        $validateData = $request;

        $validateData->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
         
        $data =  StaffCategory::where('cat_id',$decodeId)->get()[0];
        $data->name = $validateData['name'];
        $data->description=$request->description;
        $data->status = $validateData['status'];
        $data->status = $validateData['status'];
        $data->update();
        return back()->with('message','Staff Category updated Successfully');
    }
    public function deleteStaffCategory(string $cat_id)
    {
        StaffCategory::where('cat_id',$cat_id)->delete();
        return redirect('create-staff-category')->with('message','Staff Classification  deleted successfully');
    }

    //staff classification

    public function createClassification(Request $request)
    {
        
        $validateData = $request;

        $validateData->validate([
            'class_name' => 'required',
            'class_status' => 'required'
        ]);

        $data = new StaffClassification;
        $data->name = $validateData['class_name'];
        $data->description=$request->class_description;
        $data->status = $validateData['class_status'];
        $data->created_by = Auth::user()->id;  
        $data->updated_by = 0;       
        $data->save();
        return back()->with('message','Staff Classification saved Successfully');
    }

    //Edit Staff Classification
    public function editClassView ($id)
    {
        $data = StaffClassification::all();
        $decodeId = Crypt::decrypt($id);
        $datas = StaffClassification::find($decodeId);
        return view('staff_management.edit-staff-class',['data'=>$data,'datas'=>$datas, 'id'=>$id]);
    }


    //update staff classification
    public function updatestaffClass(Request $request,$id)
    {
        $decodeId = Crypt::decrypt($id);
        $validateData = $request;

         $validateData->validate([
            'class_name' => 'required',
            'class_status' => 'required'
        ]);
         
        $data =  StaffClassification::find($decodeId);
        $data->name = $validateData['class_name'];
        $data->description=$request->class_description;
        $data->status = $validateData['class_status'];
        $data->update();
        return back()->with('message','Staff Classification updated Successfully');
    }
    public function deleteStaffClass(string $id)
    {
        StaffClassification::where('id',$id)->delete();
        return redirect('create-staff-category')->with('message','Staff Classification  deleted successfully');
    }

    public function createType(Request $request)
    {
        
        $validateData = $request;
        $data = new StaffType;
        $data->name = $validateData['type'];
        $data->description=$request->type_description;
        $data->category_id = $validateData['category'];
        $data->status = $validateData['type_status'];
        $data->created_by = Auth::user()->id;
        $data->save();
        return back()->with('message','Staff Type saved Successfully');
    }

     //Edit Staff Type
     public function editTypeView ($id)
     {
         $datas = StaffType::all();
         $bra = StaffCategory::all();
         $decodeId = Crypt::decrypt($id);
         $data = StaffType::find($decodeId);
         return view('staff_management.edit-staff-type',['data'=>$data,'datas'=>$datas,'bra'=>$bra, 'id'=>$id]);
     }

     //update staff type
     public function updatestaffType(Request $request,$id)
    {
        $decodeId = Crypt::decrypt($id);
        $validateData = $request;
 
        $data =  StaffType::find($decodeId);
        $data->name = $validateData['type'];
        $data->description=$request->type_description;
        $data->category_id = $validateData['category'];
        $data->status = $validateData['type_status'];

        $data->created_by = Auth::user()->id;

       
        $data->update();
        return back()->with('message','Staff Type updated Successfully');
    }

    public function deleteStaffType(string $id)
    {
        StaffType::where('id',$id)->delete();
        return redirect('create-staff-category')->with('message','Staff Type  deleted successfully');
    
    }
    //Create staff 
    public function findRegionData(Request $request){

		
	    //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=District::select('name','id')->where('reg_code',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}
    
    public function uploadStaffPhotoView($staff_id)
    {
        $data = Staff::find($staff_id);
        $datas = Staff::all();
      
        return response()->json($data);
   
    
    }

    

    public function saveStaffPhoto(Request $request)
    {
        $validateData = $request;

        $validateData->validate([
            'id_type' => 'required',
            'id_number' => 'required'
        ]);
        $data =  Staff::find($request->staff_id);
        
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
  
            $file->move('uploads/StaffPhotos/',$filename);
            $data->picture = 'uploads/StaffPhotos/'.$filename;
          }
        $data->id_type = $validateData['id_type'];
        $data->id_number = $validateData['id_number'];
        
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect('list-staff')->with('message','Staff Photo/ID  saved successfully');
    }

    public function updateStaffSup(Request $request)
    {
        
        $validateData = $request;

        $validateData->validate([
            'supervisor_id' => 'required'
        ]);
         
        $data =  Staff::find($request->staff_id);
        $data->supervisor_id = $validateData['supervisor_id'];
        
        $data->update();
        return back()->with('message','Staff Supervisor updated Successfully');
    }

    public function viewStaffProfile($staff_id)
    {
        $decodeId = Crypt::decrypt($staff_id);
        $data = Staff::find($decodeId);
        $datas = Staff::all();
        
        // $sta = StaffNextofKin::where('staff_id',$decodeId)->get();
        return view('staff_management.staff-profile',data: ['data'=>$data,'datas'=>$datas,'sta'=>null, 'staff_id'=>$staff_id]);

    }

    public function viewStaffNextKin()
    {
        
        return view('staff_management.next-of-kin'); 
    }

    public function searchProcess (Request $request){


        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $table = "";
 
        if($operation == "equal"){
 
         $result = Staff::where([[$field,$parameter],['status','Active']])->get();
 
        }else{
 
         $result = Staff::where([[$field,'LIKE','%'.$parameter.'%'],['status','Active']])->get();
 
        }

        if($result->count() > 0){
  
            $table .= '<table id="example"  class="table table-striped table-bordered">';
    
            $table .= '<thead> <tr> <th><b>Name</b></th> <th><b>Gender</b></th> <th><b>Nationality</b></th>  <th><b>Employee ID</b></th> <th><b>Phone</b></th> <th><b>Action</b></th> </tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {
                $table .= '<tr>';

                
                $table .= '<td>'.$item->surname.'</td>';
 

                $table .= '<td>'.$item->gender.'</td>';
                $table .= '<td>'.$item->nationality.'</td>';
                $table .= '<td>'.$item->employee_id.'</td>';
                $table .= '<td>'.$item->contact_num.'</td>';
                $table .= '<td><a data-bs-toggle="modal" id="showmodal" data-url="'.route('next-of-kin-get-id',$item->staff_id).'" data-bs-target="#exLargeModal" class="btn btn-sm btn-info" style="color:white">Add next of kin</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

    }

    public function StaffNextofKinModalView($staff_id)
    {
        $data = Staff::find($staff_id);
        return response()->json($data);
 
       
    
    }

    public function ProcessStaffNextofKin(Request $request)
    {
        $validateData = $request->validated();
        $data = new StaffNextofKin();
        $data->firstname = $validateData['firstname'];
        $data->surname = $validateData['surname'];
        $data->staff_id=$request->staffID;
        $data->contact_num = $validateData['contact_num'];
        $data->email = $validateData['con_email'];
        $data->relation = $validateData['relation'];
        $data->contact_address = $validateData['contact_address'];
        $data->notes=$request->note;
        $data->staff_id=$request->staff_id;
        $data->created_on = date("Y-m-d H:i:s");
        
        $data->created_by = Auth::user()->id;
        
        
        $data->save();
        return back()->with('message','Next of Kin  saved Successfully');
    }

    //Edit Staff view

    public function EdittaffView($staff_id)
    {
        $decodeId = Crypt::decrypt($staff_id);
        $datas = Staff::find($decodeId);
        $data = Nationality::all();
        $regs = Region::all();
        $dist = District::all();
        $clas = StaffClassification::all();
        $cat = StaffCategory::all();
        $bra = Branch::all();
        $dep = Businessclass::all();
       
        return view('staff_management.edit-staff',['data'=>$data,'regs'=>$regs,'clas'=>$clas,'cat'=>$cat,'bra'=>$bra,'dep'=>$dep,'datas'=>$datas,'dist'=>$dist,'staff_id'=>$staff_id]);
    }


    //update staff step 1
    public function updateStaff(Request $request,$staff_id)
    {
        $decodeId = Crypt::decrypt($staff_id);
        $validateData = $request;
 
        $data =  Staff::find($decodeId);
        $data->firstname = $validateData['firstname'];
        $data->surname = $validateData['surname'];
        $data->othername=$request->othername;
        $data->gender = $validateData['gender'];
        $data->dob = $validateData['dob'];
        $data->nationality = $validateData['nationality'];
        $data->marital_status_id = $validateData['marital_status_id'];
        $data->region_id = $validateData['region'];
        $data->mmda_id = $validateData['district'];
        $data->status = $validateData['status'];
        $data->town = $validateData['hometown'];
        $data->title = $validateData['title'];
        $data->updated_on = date("Y-m-d H:i:s");
        $data->updated_by = Auth::user()->id;
        $data->update();
        return back()->with('message','Staff Information  updated Successfully');
    }


    public function updateStaff2(Request $request,$staff_id)
    {
        $decodeId = Crypt::decrypt($staff_id);
        $validateData = $request;

         $validateData->validate([
                'employee_id'=>'required',
                'staff_class'=>'required',
                'staff_category'=>'required',
                'branch'=>'required',
                'department'=>'required',
                'unit'=>'required'
            ]);
 
        $data =  Staff::find($decodeId);
        $data->employee_id = $validateData['employee_id'];
        $data->staff_cat_id = $validateData['staff_category'];
       
        $data->staff_class = $validateData['staff_class'];
        $data->branch = $validateData['branch'];
        $data->department = $validateData['department'];
        $data->unit = $validateData['unit'];
        $data->updated_by = Auth::user()->id;
        $data->update();
        return back()->with('message','Staff Information  updated Successfully');
    }

    public function updateStaff3(Request $request,$staff_id)
    {
        $decodeId = Crypt::decrypt($staff_id);
        $validateData = $request;

        $validateData->validate([
                'corporate_email'=>'required|email',
                'personal_email'=>'required|email',
                'contact_num'=>'required',
                'office_num'=>'required',
                'residence'=>'required',
                'digital_address'=>'required',
                'e_region'=>'required'
            ]);
 
        $data =  Staff::find($decodeId);
       // $data->personal_address = $validateData['personal_address'];
       $data->personal_address = $validateData['residence'];
        $data->contact_num = $validateData['contact_num'];
        $data->office_num = $validateData['office_num'];
        $data->personal_email = $validateData['personal_email'];
        $data->corporate_email = $validateData['corporate_email'];
       $data->town=$request->town;
        
        $data->digital_address = $validateData['digital_address'];
        $data->e_region = $validateData['e_region'];
        $data->updated_by = Auth::user()->id;
        $data->update();
        return back()->with('message','Staff Information  updated Successfully');
    }
}
