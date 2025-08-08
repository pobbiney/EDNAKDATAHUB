<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use App\Models\PermitApp;
use Illuminate\Http\Request;
use App\Models\CertificateApp;
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
            $permitsCount = PermitApp::where('tel', $user->tell)->get()->count();
            $approveCertCount = CertificateApp::where([['status','Approved'],['tel',$user->tell]])->get()->count();
            $approvePermitCount = PermitApp::where([['status','vettingApproved'],['tel',$user->tell]])->get()->count();

            return view('customer.dashboard', compact('user', 'sales', 'totalFormSold', 'certificateCount', 'permitsCount', 'approveCertCount', 'approvePermitCount'));
        }
}
