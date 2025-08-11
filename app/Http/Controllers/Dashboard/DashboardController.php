<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Applicationform;
use App\Models\CertificateApp;
use App\Models\Formsale;
use App\Models\PermitApp;
use App\Models\PermitRegistration;
use App\Models\Region;
use App\Models\RenewApp;
use App\Models\UsrUserLog;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function index(){

        $totalFormSold = Formsale::get()->count();
        $certificateCount = CertificateApp::get()->count();
        $permitsCount = PermitRegistration::where('registration_step','completed')->get()->count();
        $renewalCount = RenewApp::get()->count();
        $approveCertCount = CertificateApp::where([['status','Approved'],['region',Auth::User()->region_id]])->get()->count();
        $approvePermitCount = PermitApp::where([['status','vettingApproved'],['region',Auth::User()->region_id]])->get()->count();

         $applicationFormType = Applicationform::get();

         $regionList = Region::orderBy('name','ASC')->get();

         $latestCertificationData = CertificateApp::where([['region',Auth::User()->region_id]])->orderBy('id','DESC')->get()->take(3);
          $latestPermitData = PermitApp::where([['region',Auth::User()->region_id]])->orderBy('id','DESC')->get()->take(3);
          $latestPermitData = RenewApp::orderBy('id','DESC')->get()->take(3);

        return view ('dashboard',[
            'totalFormSold' => $totalFormSold,
            'certificateCount' => $certificateCount,
            'permitsCount' => $permitsCount,
            'renewalCount' => $renewalCount,
            'approveCertCount' => $approveCertCount,
            'approvePermitCount' => $approvePermitCount,
            'applicationFormType' => $applicationFormType->random(3),
            'regionList' => $regionList->random(3),
            'latestCertificationData' => $latestCertificationData, 
            'latestPermitData' => $latestPermitData
        ]);
    }

    public function logoutAuthenticationProcess(){
        
        Auth::logout();

        $updateLogs = UsrUserLog::find((int)session('userLogId'));
        $updateLogs->logout_date = Carbon::now();
        $updateLogs->update();

        session()->forget('userLogId');

        return redirect('/');

    }
}
