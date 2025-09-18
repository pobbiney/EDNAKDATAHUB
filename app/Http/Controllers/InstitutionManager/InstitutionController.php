<?php

namespace App\Http\Controllers\InstitutionManager;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\InstitutionCategory;
use App\Models\InstitutionType;
use Illuminate\Support\Facades\Crypt;

class InstitutionController extends Controller
{
    public function CategoryView(){
        $listcat = InstitutionCategory::all();
        return view('institution.Category',['listcat'=>$listcat]);
    }

    public function addCategory(Request $request){
         $request->validate([
            'name' => 'required',
            'description'=> 'required'
            
        ]);

         if(InstitutionCategory::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new InstitutionCategory();
            $insertCat->name = $request->name;
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
             
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }
    }

    public function editCategoryView($id){
         $decodeID = Crypt::decrypt($id);

        $data = InstitutionCategory::find($decodeID);
        $listcat = InstitutionCategory::all();

        return view('institution.edit-category',['data'=>$data,'listcat'=>$listcat,'id'=>$id]);
    }

    public function updateCategory(Request $request, $id)
    {
          $request->validate([
            'name' =>'required',
            'status'=> 'required',
            'description'=> 'required'
        ]);

        
             $decodeID = Crypt::decrypt($id);
            $insertCat = InstitutionCategory::find($decodeID);
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description;
            $insertCat->status = $request->status;
            
           
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record updated successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function typeview(){
        $listcat = InstitutionCategory::all();
        $listtype = InstitutionType::all();
        return view('institution.type',['listcat'=>$listcat,'listtype'=>$listtype]);
    }

     public function addType(Request $request){
         $request->validate([
            'name' => 'required',
            'description'=> 'required',
            'type'=> 'required'
            
        ]);

         if(InstitutionType::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new InstitutionType();
            $insertCat->name = $request->name;
            $insertCat->cat_id = $request->category;
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
             
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }
    }

    public function editTypeView($id)
    {
         $decodeID = Crypt::decrypt($id);

        $data = InstitutionType::find($decodeID);
        $listcat = InstitutionCategory::all();
        $listtype = InstitutionType::all();

        return view('institution.edit-type',['data'=>$data,'listcat'=>$listcat,'id'=>$id,'listtype'=>$listtype]);
    }

     public function updateType(Request $request, $id)
    {
          $request->validate([
            'name' =>'required',
            'status'=> 'required',
            'description'=> 'required'
        ]);

        
             $decodeID = Crypt::decrypt($id);
            $insertCat = InstitutionType::find($decodeID);
            $insertCat->name = trim($request->name);
            $insertCat->cat_id = trim($request->category);
            $insertCat->description = $request->description;
            $insertCat->status = $request->status;
            
           
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record updated successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function InstitutionView(){
        $listcat = InstitutionCategory::all();
        return view('institution.Institution',['listcat'=>$listcat]);
    }

       /*Get All Types base on selected Category*/
    public function findCategoryData(Request $request){
  
        $data=InstitutionType::select('name','id')->where('cat_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    public function addInstitution(Request $request){
         $request->validate([
            'name' => 'required',
            'short_name'=> 'required',
            'location'=> 'required',
            'email'=> 'required',
            'telephone'=> 'required',
            'category'=> 'required',
            'type'=> 'required',
            'about'=> 'required',
            
        ]);

         if(Institution::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Institution();
            $insertCat->name = $request->name;
            $insertCat->short_name = $request->short_name;
            $insertCat->location = $request->location;
            $insertCat->email = $request->email;
            $insertCat->telephone = $request->telephone;
            $insertCat->category_id = $request->category;
            $insertCat->type_id = $request->type;
            $insertCat->about = $request->about;
             
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }
    }

    public function listInstitutionView(){
        $list = Institution::orderBy('name','ASC')->get();
        return view('institution.list-Institution',['list'=>$list]);
    }
}
