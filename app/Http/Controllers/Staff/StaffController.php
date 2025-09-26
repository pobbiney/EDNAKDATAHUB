<?php

namespace App\Http\Controllers\Staff;

use App\Models\BankDetail;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\Region;
use App\Models\BusClass;
use App\Models\District;
use App\Models\StaffType;
use App\Models\Nationality;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\Businessclass;
use App\Models\StaffCategory;
use App\Models\StaffDocument;
use App\Models\StaffNextofKin;
use App\Models\DocumentCategory;
use App\Models\StaffClassification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Controllers\HasMiddleware;



class StaffController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

        public function addStaff()
    {
        $list = Staff::orderBy('staff_id','ASC')->get();
        return view('staff_management.create-staff',['list'=>$list]);
    }

    public function saveStaff(Request $request)
   {
     $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',

        ]);


        if(Staff::where('surname',$request->phone)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Staff();
            $insertCat->surname = trim($request->surname);
            $insertCat->firstname = $request->firstname;
            $insertCat->contact_num = $request->phone;
            $insertCat->personal_email = $request->email;
            $insertCat->gender = $request->gender;
            $insertCat->created_by = Auth::User()->id;
           
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Staff added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }
   }

   public function editStaffView($staff_id){
        $decodeID = Crypt::decrypt($staff_id);
        $list = Staff::orderBy('staff_id','ASC')->get();
        $data = Staff::find($decodeID);

        return view('staff_management.edit-staff',['list'=>$list,'data'=>$data,'staff_id'=>$staff_id]);
   }

   public function ediStaff(Request $request, $staff_id)
   {
     $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',

        ]);


           $decodeId = Crypt::decrypt($staff_id);

            $insertCat = Staff::find($decodeId);
            $insertCat->surname = trim($request->surname);
            $insertCat->firstname = $request->firstname;
            $insertCat->contact_num = $request->phone;
            $insertCat->personal_email = $request->email;
            $insertCat->gender = $request->gender;
            $insertCat->updated_by = Auth::User()->id;
           
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Staff updated successfully') : back()->with('message_error','Something went wrong, please try again.');
    }
}
