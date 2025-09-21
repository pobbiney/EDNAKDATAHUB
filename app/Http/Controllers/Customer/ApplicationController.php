<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Region;
use App\Models\Drawing;
use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Models\Drawingupload;
use App\Models\Applicationform;
use App\Models\PermitRegistration;
use App\Models\Applicationformtype;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Sms\SmsController;

class ApplicationController extends Controller
{

    public function getAttachedDocView(){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $formsale= Formsale::find(Session::get('formsale_id'));
        $listApp = PermitRegistration::where('registration_step', 'completed')->where('contact_number',$formsale->tell)->latest('id')->get();
        return view('customer.registration.DocumentAttachment',['listApp'=>$listApp]);

    }

    public function getAttachDrawingForms (Request $request){

        $listDrawings = Drawing::get();

        $tableOne = '';

         $tableOne .= '<table class="table table-striped table-bordered">';
         
         foreach ($listDrawings as $key) {

            $tableOne .= '<tr>';

             $tableOne .= '<td>'.$key->name.'</td>';
             $tableOne .= '<td><input type="file" class="form-control" name="drawings'.$key->id.'"></td>';

             $tableOne .= '</tr>';
            
         }

         $tableOne .= '</table>';
          return $tableOne;

    }

    public function uploadAttachDrawingsProcess (Request $request){

        $listDrawings = Drawing::get();
        $documentCode = substr(rand(0,time()),0,9);

        $listCount = 0;

        foreach ($listDrawings as $key) {

            if(!empty($request["drawings".$key->id])){

               $listCount++; 

            }
            
        }

        if($listCount <= 0){


            return back()->with('message_error','No documents detected. Please upload at least one to proceed.');
        }

        $baseUrl = url('/').'/public/';

         foreach ($listDrawings as $keyTwo) {
            

            if($request->has("drawings".$keyTwo->id)){

            $docsName = 'drawingsUpload/'.$documentCode.'-drawings-'.time().rand(1,1000).'.'.$request->file('drawings'.$keyTwo->id)->extension();
            $request->file("drawings".$keyTwo->id)->move(public_path('drawingsUpload'),$docsName);

            $insertDrawings = new Drawingupload();
            $insertDrawings->path = $baseUrl.$docsName;
            $insertDrawings->uploadType = 'permitApplication';
            $insertDrawings->drawingType = $keyTwo->id;
            $insertDrawings->createdOn =  Carbon::now();
            $insertDrawings->createdBy = 0;
            $insertDrawings->appId = $request->formID;
            $status = $insertDrawings->save();

            }

        }

        return $status ? back()->with('message_success','Document uploaded successfully') : back()->with('message_error','Something went wrong, please try again.'); 


    }

    public function trackApplicationView(){
         if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
            $formsale= Formsale::find(Session::get('formsale_id'));
            
            $tasks = PermitRegistration::where('contact_number',$formsale->tell)->get();

            return view('customer.application-tracker.index',compact('tasks'));
    }

      public function jobDetails($id)
        {
                $decodeId = Crypt::decrypt($id);
                $permit_reg = PermitRegistration::findOrFail($decodeId);
                $formID = $permit_reg->formID;
                $datas = Formsale::with(['permit_registrations'])->findOrFail($formID);
                
                return view('customer.application-tracker.job-details', [
                    'datas' => $datas,
                    'results' => $datas->trackers
                ]);
        }

        public function customerBuyForm(){
            if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
            $formsale= Formsale::find(Session::get('formsale_id'));
            $listForm = Applicationform::orderBy('formName','ASC')->get();
            $regionList = Region::orderBy('name','ASC')->get();
            $listtype = Applicationformtype::all();

            return view('customer.registration.buy-new-form',[
                'formsale' => $formsale,
                'listForm' => $listForm,
                'regionList' =>$regionList,
                'listtype' =>$listtype
            ]);

        }

    public function sellFormsProcess (Request $request){

        $sendSMS = new SmsController();

        $request->validate([
            'applicant_name' => 'required',
            'telephone' => 'required|regex:/[0-9]/',
            'location' => 'required',
            'form_type' => 'required',
            'region' => 'required',
            'permit_type' => 'required',
            'district' => 'required'
        ]);


        $regionData = Region::find($request->region);
        $formData = Applicationform::find($request->form_type);

        $formCount = Formsale::get()->count() + 1;


        $formNumber = $regionData->code.'-'.$regionData->id.' '.$formData->amount.'0'.$formCount;

        $pin = rand(1000, 9999).''.$formCount;


        $insertSale = new Formsale();
        $insertSale->applicantName = $request->applicant_name;
        $insertSale->tell = $request->telephone;
        $insertSale->formType = $request->form_type;
        $insertSale->serialNumber = base64_encode($formNumber);
        $insertSale->pin = base64_encode($pin);
        $insertSale->formNumber = $formNumber;
        $insertSale->regionId = $request->region;
        $insertSale->district_id = $request->district;
        $insertSale->amountPaid = $formData->amount;
        $insertSale->password = sha1($pin);
        $insertSale->location = $request->location;
        $insertSale->permit_type = $request->permit_type;

        $insertSale->createdBy =  0;
        $insertSale->createdOn = Carbon::now();
        $insertSale->status =  'Pending';

        $status =  $insertSale->save();

        if($status){

            $message = 'Your Form Number is '.$formNumber.' and your PIN is '.$pin.'. You purchased the '.$formData->formName.' Form at GHS '.number_format($formData->amount,2);

            $sendSMS->sendSMS($request->telephone,$message);

            return back()->with('message_success','Application Forms Bought Successfully');

        }else{

            return back()->with('message_error','Something went wrong, please try again.');


        }

    }

      public function buyFormsProcess (Request $request){

        $sendSMS = new SmsController();

        $request->validate([
            'applicant_name' => 'required',
            'telephone' => 'required|regex:/[0-9]/',
            'location' => 'required',
            'form_type' => 'required',
            'region' => 'required',
            'permit_type' => 'required',
            'district' => 'required'
        ]);


        $regionData = Region::find($request->region);
        $formData = Applicationform::find($request->form_type);

        $formCount = Formsale::get()->count() + 1;

        $formNumber = $regionData->code.'-'.$regionData->id.' '.$formData->amount.'0'.$formCount;

        $pin = rand(1000, 9999).''.$formCount;

        $insertSale = new Formsale();
        $insertSale->applicantName = $request->applicant_name;
        $insertSale->tell = $request->telephone;
        $insertSale->formType = $request->form_type;
        $insertSale->serialNumber = base64_encode($formNumber);
        $insertSale->pin = base64_encode($pin);
        $insertSale->formNumber = $formNumber;
        $insertSale->regionId = $request->region;
        $insertSale->district_id = $request->district;
        $insertSale->amountPaid = $formData->amount;
        $insertSale->password = sha1($pin);
        $insertSale->location = $request->location;
        $insertSale->permit_type = $request->permit_type;

        $insertSale->createdBy =  0;
        $insertSale->createdOn = Carbon::now();
        $insertSale->status =  'Pending';

        $status =  $insertSale->save();

        if($status){

            $message = 'Your Form Number is '.$formNumber.' and your PIN is '.$pin.'. You purchased the '.$formData->formName.' Form at GHS '.number_format($formData->amount,2);
            $sendSMS->sendSMS($request->telephone,$message);
            $pin = $insertSale->pin;

            return back()->with('registration_success',[$pin,$formNumber]);

        }else{
            return back()->with('message_error','Something went wrong, please try again.');
        }

    }

    
}
