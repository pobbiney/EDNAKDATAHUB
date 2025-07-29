<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Alarmandwarning;
use App\Models\Buildingtype;
use App\Models\ConstructionType;
use App\Models\Currency;
use App\Models\Drawing;
use App\Models\Firefighting;
use App\Models\Meansofescape;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EquipmentControoller extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function index(){

        $listAlarmWaring = Alarmandwarning::orderBy('name','ASC')->get();
        $listFireFighting = Firefighting::orderBy('name','ASC')->get();
        $listMeansOfEscape = Meansofescape::orderBy('name','ASC')->get();

        return view('equipment.equipment',[
            'listAlarmWaring' => $listAlarmWaring,
            'listFireFighting' => $listFireFighting,
            'listMeansOfEscape' => $listMeansOfEscape
        ]);
    }

    public function alarmSystemInsert(Request $request){

        $request->validate([
            'name' =>'required'
        ]);

        if(Alarmandwarning::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Alarmandwarning();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function alarmSystemInsertEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Alarmandwarning::find($decodeID);

        return view('equipment.edit-alarm-warning',[
            'data' => $data,
            'id' => $id
        ]);
    }


    public function alarmSystemUpdate(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required'
        ]);

        $insertCat = Alarmandwarning::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Record update successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function fightingSystemInsert(Request $request){

        $request->validate([
            'name_fire' =>'required'
        ]);

        if(Firefighting::where('name',$request->name_fire)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Firefighting();
            $insertCat->name = trim($request->name_fire);
            $insertCat->description = $request->fire_description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function fireFightingEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Firefighting::find($decodeID);

        return view('equipment.edit-firefighting',[
            'data' => $data,
            'id' => $id
        ]);
    }

    public function fireFightingEditViewUpdate(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required'
        ]);

        $insertCat = Firefighting::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Record update successfully') : back()->with('message_error','Something went wrong, please try again.');


    }


    public function escapeInsert(Request $request){

        $request->validate([
            'name_escape' =>'required'
        ]);

        if(Meansofescape::where('name',$request->name_escape)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Meansofescape();
            $insertCat->name = trim($request->name_escape);
            $insertCat->description = $request->escape_description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function escapeEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Meansofescape::find($decodeID);

        return view('equipment.edit-mean-escape',[
            'data' => $data,
            'id' => $id
        ]);
    }


    public function escapeEditViewProcess(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required'
        ]);

        $insertCat = Meansofescape::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Record update successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function othersView(){

        $drawingsList = Drawing::orderBy('name','asc')->get();
        $currencyList = Currency::orderBy('name','asc')->get();

        return view('others.others-setup',[
            'drawingsList' => $drawingsList,
            'currencyList' => $currencyList
        ]);
    }


    public function insertDrawings(Request $request){

        $request->validate([
            'name' =>'required'
        ]);

        if(Alarmandwarning::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Drawing();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Record added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function editDrawingsView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Drawing::find($decodeID);

        return view('others.edit-drawings',[
            'data' => $data,
            'id' => $id
        ]);
    }


    public function updateDrawings(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required',
            'status' => 'required'
        ]);

        $insertCat = Drawing::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Record update successfully') : back()->with('message_error','Something went wrong, please try again.');


    }


    public function insertCurrency(Request $request){

        $request->validate([
            'currency' =>'required'
        ]);

        if(Currency::where('name',$request->currency)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Currency();
            $insertCat->name = trim($request->currency);
            $insertCat->description = $request->currency_description;
            $insertCat->status = 1;
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Currency added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }


    public function editCurrencyView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Currency::find($decodeID);

        return view('others.edit-currency',[
            'data' => $data,
            'id' => $id
        ]);
    }

    public function editCurrencyProcess(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required',
            'status' => 'required'
        ]);

        $insertCat = Currency::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Currency updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function buildingSetupView(){

        $listType = Buildingtype::orderBy('name','ASC')->get();
        $listConstruction = ConstructionType::orderBy('name','ASC')->get();


        return view('building-setup.building-setup',[
            'listType' => $listType,
            'listConstruction' => $listConstruction
        ]);
    }

    public function insertBuildingType (Request $request){

        $request->validate([
            'name' =>'required'
        ]);

        if(Buildingtype::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new Buildingtype();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function buildingTypeEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Buildingtype::find($decodeID);

        return view('building-setup.edit-type',[
            'data' => $data,
            'id' => $id
        ]);


    }


    public function updateBuildingType (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required'
        ]);

        $insertCat =  Buildingtype::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Type updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }


    public function insertConstructionType (Request $request){

        $request->validate([
            'type_name' =>'required'
        ]);

        if(ConstructionType::where('name',$request->name)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new ConstructionType();
            $insertCat->name = trim($request->type_name);
            $insertCat->description = $request->type_description;
            $insertCat->status = 'Active';
            $insertCat->createdBy = Auth::User()->id;
            $insertCat->createdOn = Carbon::now();
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function constructionTypeEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = ConstructionType::find($decodeID);

        return view('building-setup.edit-const-type',[
            'data' => $data,
            'id' => $id
        ]);


    }

    public function updateConstructionType (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' =>'required'
        ]);

        $insertCat =  ConstructionType::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
        $insertCat->updatedBy = Auth::User()->id;
        $insertCat->updatedOn = Carbon::now();
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Type updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

}
