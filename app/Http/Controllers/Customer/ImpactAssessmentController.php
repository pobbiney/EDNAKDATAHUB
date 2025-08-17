<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use App\Models\EnvironmentalImpact;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ImpactAssessmentController extends Controller
{
     public function index(){
         if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }

        $formsale= Formsale::find(Session::get('formsale_id'));

        $data = PermitRegistration::where('contact_number',$formsale->tell)->get();

        return view('customer.impact-assessment.index',['data'=>$data]);
    }

     public function environmentalView($id){
         if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $decodeId = Crypt::decrypt($id);
        $impactData = EnvironmentalImpact::where('app_id',$decodeId)->get();
        return view('customer.impact-assessment.environmental-impact',[
            'decodeId' => $decodeId,
            'impactData' => $impactData
        ]);
    }

    public function storeEnvironmentalView(Request $request,$id){
        $validated = $request->validate([
            'impacts' => 'required|array',
            'impacts.*.impact' => 'required',
            'impacts.*.operational_impact' => 'required',
        ]);

        $decodeId = Crypt::decrypt($id);
        $permit = PermitRegistration::findOrFail($decodeId);

        foreach ($validated['impacts'] as $impactData) {
            $permit->environmental_impacts()->create([
                'app_id' => $decodeId,
                'construction_impact' => $impactData['impact'],
                'operational_impact' => $impactData['operational_impact'],
                'created_by' => 0,
            ]);
        }

        return redirect()->route('customer-impact-assessment')->with('message_success', 'Environmental Impacts saved successfully');
       
    }
}
