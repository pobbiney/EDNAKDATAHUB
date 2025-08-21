<?php

namespace App\Http\Controllers\ImpactAssessment;

use App\Models\ImpactMgt;
use App\Models\Screening;
use App\Models\PermitReview;
use Illuminate\Http\Request;
use App\Models\Drawingupload;
use App\Models\NeighbourConcern;
use App\Models\PermitRegistration;
use App\Models\EnvironmentalImpact;
use App\Http\Controllers\Controller;
use App\Models\Formsale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Controllers\HasMiddleware;

class ImpactController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return ['auth'];
    }

    public function index(){

        return view('impact-assessment.index');
    }

      public function searchImpactAssessment (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $table = "";

        // Base query with join
        $query = PermitRegistration::query();

        // Apply search condition
        if ($operation == "equal") {
            $result = $query->where($field, $parameter)->get();
        } else {
            $result = $query->where($field, 'LIKE', '%' . $parameter . '%')->get();
        }

        if($result->count() > 0){
  
            $table .= '<table id="example"  class="dt-select-table table">';
    
            $table .= '<thead> <tr>   <th><b>Applicant</b></th> <th><b>Telephone</b></th>  <th><b>Project Name</b></th><th><b>Town</b></th> <th><b>Action</b></th> </tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {
                $table .= '<tr>';
                $table .= '<td>'.$item->proponent_name.'</td>';
                $table .= '<td>'.$item->contact_number.' </td>';
                $table .= '<td>'.$item->project_title.'</td>';
                $table .= '<td>' . ($item->town ?? 'N/A') . '  </td>';
                $table .= '<td><a href="'.route('view-app',Crypt::encrypt($item->id)).'" target="_" class="btn btn-sm btn-success m-1" style="color:white"> View</a><a href="'.route('environmental-impact',Crypt::encrypt($item->id)).'" class="btn btn-sm btn-warning m-1" style="color:white"> Impact</a><a href="'.route('neighbour-concerns',Crypt::encrypt($item->id)).'" class="btn btn-sm btn-danger m-1" style="color:white"> Concerns</a><a href="'.route('impact-mgt',Crypt::encrypt($item->id)).'" class="btn btn-sm btn-info m-1" style="color:white"> Impact Management</a></td>';
                $table .= '</tr>';
             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;
    
    
           }else{
    
            return "no data";
    
           }

    }

      public function environmentalView($id){
        $decodeId = Crypt::decrypt($id);
        $impactData = EnvironmentalImpact::where('app_id',$decodeId)->get();
        return view('impact-assessment.environmental-impact',[
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
                'created_by' => Auth::user()->id,
            ]);
        }
        return redirect()->route('impact-assessment')->with('message_success', 'Environmental Impacts saved successfully');
       
    }

    public function concernsView($id){
        $decodeId = Crypt::decrypt($id);

        return view('impact-assessment.neighbour-concerns',[
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
                'created_by' => Auth::user()->id,
            ]);
        }

        return redirect()->route('impact-assessment')->with('message_success', 'Neighbour Concerns saved successfully');
       
    }

    public function impactMgtView($id){
        $decodeId = Crypt::decrypt($id);
        $envImpact= EnvironmentalImpact::with('impact_mgt')->where('app_id',$decodeId)->get();
      
        return view('impact-assessment.impact-mgt',[
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
                    'created_by' => Auth::user()->id,
                ]);
            }
        }

        return redirect()->route('impact-assessment')->with('message_success', 'Management of Impacts saved successfully');
       
    }

      public function viewApp($id){
        $decodeID = Crypt::decrypt($id);
        $project = PermitRegistration::findOrFail($decodeID);
        $formsale = Formsale::findOrFail($project->formID);

        $listscreen = Screening::where('formId',$formsale->id)->first();
         $list = PermitReview::where('formId',$formsale->id)->first();
         $documents = Drawingupload::where('appId',$project->id)->get();
        $envImpact = EnvironmentalImpact::where('app_id',$project->id)->get();
        $concerns = NeighbourConcern::where('app_id',$project->id)->get();
        $impactMgt = EnvironmentalImpact::with('impact_mgt')->where('app_id',$project->id)->get();
        return view('impact-assessment.view',[
            'project' => $project,'listscreen'=>$listscreen,'list'=>$list,'documents' => $documents,
            'envImpact' => $envImpact, 'concerns' => $concerns, 'impactMgt' => $impactMgt
        ]);
    }


}
