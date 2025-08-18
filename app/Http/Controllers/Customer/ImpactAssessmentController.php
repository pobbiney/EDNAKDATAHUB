<?php

namespace App\Http\Controllers\Customer;

use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use App\Models\EnvironmentalImpact;
use App\Models\ImpactMgt;
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

    public function concernsView($id){
         if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $decodeId = Crypt::decrypt($id);

        return view('customer.impact-assessment.neighbour-concerns',[
            'decodeId' => $decodeId,
        ]);
    }

    public function storeConcerns(Request $request,$id){
        $validated = $request->validate([
            'concerns' => 'required|array',
            'concerns.*.fullname' => 'required',
            'concerns.*.telephone' => 'required',
            'concerns.*.location' => 'required',
            'concerns.*.concern' => 'required',
        ]);

        
        $decodeId = Crypt::decrypt($id);
        $permit = PermitRegistration::findOrFail($decodeId);

        foreach ($validated['concerns'] as $impactData) {
            $permit->concerns()->create([
                'app_id' => $decodeId,
                'full_name' => $impactData['fullname'],
                'telephone' => $impactData['telephone'],
                'location' => $impactData['location'],
                'concern' => $impactData['concern'],
                'created_by' => 0,
            ]);
        }

        return redirect()->route('customer-impact-assessment')->with('message_success', 'Neighbour Concerns saved successfully');
       
    }

    public function impactMgtView($id){
         if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $decodeId = Crypt::decrypt($id);
        $envImpact= EnvironmentalImpact::with('impact_mgt')->where('app_id',$decodeId)->get();
      
        return view('customer.impact-assessment.impact-mgt',[
            'decodeId' => $decodeId,
            'envImpact' =>$envImpact
        ]);
    }

      public function storeImpactMgt(Request $request,$id){
        
        $validated = $request->validate([
            'concerns' => 'required|array',
            'concerns.*.env_impact_id' => 'required',
             'concerns.*.impact_id' => 'required',
            'concerns.*.operational_mgt' => 'required',
            'concerns.*.construction_mgt' => 'required',
        ]);
         
        $decodeId = Crypt::decrypt($id);
        
       

        foreach ($validated['concerns'] as $impactData) {
            if($impactData['env_impact_id'] != 0){
                $impact = ImpactMgt::where('env_impact_id',$impactData['impact_id'])->first();
                $impact->operational_mgt = $impactData['operational_mgt'];
                $impact->construction_mgt = $impactData['construction_mgt'];
                $impact->update();
            }else{
                $env_impact = EnvironmentalImpact::findOrFail($impactData['impact_id']);
                $env_impact->impact_mgt()->create([
                    'app_id' => $decodeId,
                    'env_impact_id' => $impactData['impact_id'],
                    'operational_mgt' => $impactData['operational_mgt'],
                    'construction_mgt' => $impactData['construction_mgt'],
                    'created_by' => 0,
                ]);
            }
        }

        return redirect()->route('customer-impact-assessment')->with('message_success', 'Management of Impacts saved successfully');
       
    }
}
