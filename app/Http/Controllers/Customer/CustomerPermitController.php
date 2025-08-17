<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CustomerPermitController extends Controller
{
    public function getPrintCertificateView(){
         if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }

        $formsale= Formsale::find(Session::get('formsale_id'));

        $data = PermitRegistration::where('status', 'approved')
                ->where('region', $formsale->regionId)
                ->where('contact_number',$formsale->tell)
                ->get();

        return view('customer.permits.permit',['data'=>$data]);
    }

      public function getPrintApplicationCertView($id){

        $decodeId = Crypt::decrypt($id); 
        $data = PermitRegistration::find($decodeId);
        $list = Formsale::where('id', $data->formID)->first();
        return view('customer.permits.print-application-cert-details',['data'=>$data,'list'=>$list]);

    }
}
