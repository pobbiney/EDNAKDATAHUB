<?php

namespace App\Http\Controllers\IssuanceManager;

use App\Http\Controllers\Controller;
use App\Models\Appmeansofescape;
use App\Models\CertificateApp;
use App\Models\CertIssuance;
use App\Models\PermitApp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IssuanceController extends Controller
{
   public function getPrintCertificateView(){

   $data = CertificateApp::where('certificate_app.status', 'Approved')
        ->where('certificate_app.region', Auth::user()->region_id)
      
        ->get();
    return view('issuance_manager.Print-Certificate',['data'=>$data]);
   }

   public function getPrintApplicationCertView($id){

    $decodeId = Crypt::decrypt($id); // This is certificate_app.id
    $data = CertificateApp::find($decodeId);

    
    if (!$data) {
        abort(404, 'Certificate Application not found.');
    }

      $formId = $data->formId; // get the related formSales.id
 

   $payment = DB::table('payment as p')
    ->select('p.*', 'u.user_fullname', 'f.formNumber')
    ->leftJoin('formsales as f', 'f.id', '=', 'p.formId')
    ->leftJoin('usr_users as u', 'u.id', '=', 'p.createdBy')
    ->where('p.formId', $formId)
    ->first();

   $results = DB::table('appmeansofescape as ae')
    ->join('meansofescape as me', 'me.id', '=', 'ae.ItemId')
    ->select('ae.*', 'me.name')
    ->where('ae.applicationId', $decodeId)
    ->where('ae.status', '!=', 'No') // Exclude status = 'No'
    ->get();

    $fire = DB::table('appfire as ae')
    ->join('firefighting as me', 'me.id', '=', 'ae.ItemId')
    ->select('ae.*', 'me.name')
    ->where('ae.applicationId', $decodeId)
    ->where('ae.status', '!=', 'No') // Exclude status = 'No'
    ->get();

     $alarm = DB::table('appalarm as ae')
    ->join('alarmandwarning as me', 'me.id', '=', 'ae.ItemId')
    ->select('ae.*', 'me.name')
    ->where('ae.applicationId', $decodeId)
    ->where('ae.status', '!=', 'No') // Exclude status = 'No'
    ->get();


     return view('issuance_manager.print_application_cert_details',['data'=>$data,'payment'=>$payment,'results'=>$results,'fire'=>$fire,'alarm'=>$alarm]);

   }

   public function getIssueCertificateView(){
    $data = CertificateApp::with('issuance')->where('status', 'Approved')

    ->where('region', Auth::user()->region_id)
 ->get();
 
    return view('issuance_manager.Issue-Certificate',['data'=>$data]);
   }

   public function addIssueCert(Request $request)
   {
     $request->validate([
         'name' => 'required',
         'telephone' => 'required',
         'email' => 'required',
         'address' => 'required',
         
  
     ]);
     
      $track = new CertIssuance();
      $track->app_id = $request->certID;
      $track->fullname = $request->name;
      $track->tel = $request->telephone;
      $track->email = $request->email;
      $track->address = $request->address;
      $track->region_id = $request->region_id;
      $track->issuedate =Carbon::now();
      $track->month =Carbon::now()->month;
      $track->year =Carbon::now()->year;
      $track->created_by = Auth::user()->id; 
      $track->formtype = "1";
     
      $track->save();

       return $track? back()->with('message','Certificate issued Successfully'): back()->with('message_error','Something went wrong, please try again.');
       
   }

   public function getIssuePermitView(){
    $data = PermitApp::with('issuance')->where('status', 'Approved')

    ->where('region', Auth::user()->region_id)
 ->get();
 
    return view('issuance_manager.Issue-Permit',['data'=>$data]);
   }

   public function addIssuePermit(Request $request)
   {
     $request->validate([
         'name' => 'required',
         'telephone' => 'required',
         'email' => 'required',
         'address' => 'required',
         
  
     ]);
     
      $track = new CertIssuance();
      $track->app_id = $request->certID;
      $track->fullname = $request->name;
      $track->tel = $request->telephone;
      $track->email = $request->email;
      $track->address = $request->address;
      $track->region_id = $request->region_id;
      $track->issuedate =Carbon::now();
      $track->month =Carbon::now()->month;
      $track->year =Carbon::now()->year;
      $track->created_by = Auth::user()->id; 
      $track->formtype = "2";
     
      $track->save();

       return $track? back()->with('message','Certificate issued Successfully'): back()->with('message_error','Something went wrong, please try again.');
       
   }
  
}
