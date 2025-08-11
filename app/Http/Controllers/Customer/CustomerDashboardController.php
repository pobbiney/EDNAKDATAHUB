<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use App\Models\RenewApp;
use App\Models\PermitApp;
use Illuminate\Http\Request;
use App\Models\CertificateApp;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CustomerDashboardController extends Controller
{
      public function dashboardView()
        {
            if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }

            $user = Formsale::find(Session::get('formsale_id'));

            $sales = Formsale::with('formtype')
                        ->where('formsales.tell', $user->tell)
                        ->orderBy('formsales.id', 'desc')
                        ->get(); 
            $totalFormSold = $sales->count();
            $certificateCount = CertificateApp::where('tel', $user->tell)->get()->count();
            $permitsCount = PermitRegistration::where('contact_number', $user->tell)->where('registration_step','completed')->get()->count();
            $renewalCount = RenewApp::where('mobile',$user->tell)->get()->count();
            $approveCertCount = CertificateApp::where([['status','Approved'],['tel',$user->tell]])->get()->count();
            $approvePermitCount = PermitRegistration::where([['status','vettingApproved'],['contact_number',$user->tell]])->get()->count();
            $latestCertificationData = CertificateApp::where([['tel',$user->tell]])->orderBy('id','DESC')->get()->take(3);
            $latestPermitData = PermitRegistration::where([['contact_number',$user->tell]])->orderBy('id','DESC')->get()->take(5);
            $latestRenewalData = RenewApp::orderBy('id','DESC')->get()->take(3);

            return view('customer.dashboard', compact('user', 'sales', 'totalFormSold', 'certificateCount', 'permitsCount','renewalCount', 'approveCertCount', 'approvePermitCount','latestCertificationData','latestPermitData','latestRenewalData'));
        }
}


        