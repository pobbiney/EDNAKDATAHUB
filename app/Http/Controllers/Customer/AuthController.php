<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view('customer.auth.login');
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




       
