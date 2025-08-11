<?php

namespace App\Http\Controllers\Customer;

use App\Models\Drawing;
use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Models\Drawingupload;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ApplicationController extends Controller
{

    public function getAttachedDocView(){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $formsale= Formsale::find(Session::get('formsale_id'));
        $listApp = PermitRegistration::where('registration_step', 'completed')->where('contact_number',$formsale->tell)->get();
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
            
            $tasks = Formsale::with('permit_registrations')->where('tell',$formsale->tell)->get();


            return view('customer.application-tracker.index',compact('tasks'));
    }

      public function jobDetails($id)
        {
                $decodeId = Crypt::decrypt($id);
            
                $datas = Formsale::with(['permit_registrations'])->findOrFail($decodeId);
                
                return view('customer.application-tracker.job-details', [
                    'datas' => $datas,
                    'results' => $datas->trackers
                ]);
        }
}
