<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{

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
