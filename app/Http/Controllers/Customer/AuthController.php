<?php

namespace App\Http\Controllers\Customer;

use App\Models\Region;
use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Models\Applicationform;
use App\Models\Applicationformtype;
use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
          $listForm = Applicationform::orderBy('formName','ASC')->get();
            $regionList = Region::orderBy('name','ASC')->get();
            $districtList = District::orderBy('name','ASC')->get();
            $listtype = Applicationformtype::all();

        return view('customer.auth.login',[
              'listForm' => $listForm,
                'regionList' =>$regionList,
                'listtype' =>$listtype,
                'districtList'=>$districtList
        ]);
    }

     public function customerAuthenticationProcess(Request $request){

         $request->validate([
            'formNumber' => 'required|string',
            'password' => 'required',
        ]);

       $formSale = Formsale::where('formNumber', $request->formNumber)->first();
         if ($formSale && sha1(base64_decode($request->password)) === $formSale->password ) {
            Session::put('formsale_id', $formSale->id);
            return redirect()->route('customer-dashboard')->with('success', 'Login successful.');
         }
         return back()->with('login_error_message','Invalid Credentials');
        
    }

   

    public function customerLogoutAuthenticationProcess(Request $request)
    {
        $request->session()->forget('formsale_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer-login')->with('success', 'Account logged out successfully');
    }


}




       
