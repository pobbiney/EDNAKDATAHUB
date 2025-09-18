<?php

namespace App\Http\Controllers\InstitutionManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstitutionCategory;
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
}
