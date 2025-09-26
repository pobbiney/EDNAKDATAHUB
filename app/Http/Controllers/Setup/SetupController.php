<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\AgentPackage;
use App\Models\AgentPlan;
use App\Models\ConsumerPackage;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Expr\FuncCall;

class SetupController extends Controller
{
    public function  viewServiceProvider(){
        $list = ServiceProvider::all();
        return view('setup.ServiceProvider',['list'=>$list]);
    }

    public function addServiceProvider(Request $request){
        
         $request->validate([
            'logo' => 'required',
            'name' => 'required',
            
            
        ]);
        $insertCat =  new ServiceProvider();
        
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
            $file->move('uploads/serviceprovider/',$filename);
            $insertCat->logo = 'uploads/serviceprovider/'.$filename;
          }
        
        $insertCat->name = $request->name;
        $insertCat->status = "Active";
        $insertCat->save();

       
       return $insertCat ? back()->with('message_success','Service Provider added successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function viewEditServiceProvider($id){
         $decodeID = Crypt::decrypt($id);
        $list = ServiceProvider::orderBy('id','ASC')->get();
        $data = ServiceProvider::find($decodeID);

        return view('setup.edit-ServiceProvider',['list'=>$list,'data'=>$data,'id'=>$id]);
    }

    public function editServiceProvider(Request $request, $id){
         $request->validate([
            'name' => 'required',
            'status' => 'required',
            
            
        ]);
         $decodeId = Crypt::decrypt($id);
         $insertCat =  ServiceProvider::find($decodeId);
        
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
            $file->move('uploads/serviceprovider/',$filename);
            $insertCat->logo = 'uploads/serviceprovider/'.$filename;
          }
        
        $insertCat->name = $request->name;
        $insertCat->status = $request->status;
        
        $insertCat->save();

       return $insertCat ? back()->with('message_success','Service Provider updated successfully') : back()->with('message_error','Something went wrong, please try again.');
    }

    public function packagesView()
    {
        $list = ServiceProvider::all();
        $packages = ConsumerPackage::all();
        return view('setup.Packages',['list'=>$list,'packages'=>$packages]);
    }

       public function getServiceProvidersID($id)
    {
        $data = ServiceProvider::find($id);
        return response()->json($data);
   
    
    }

    public function addPackages(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'amount' => 'required',
            
            
        ]);
            $insertCat = new ConsumerPackage();
            $insertCat->name = trim($request->name);
            $insertCat->amount = $request->amount;
            $insertCat->provider_id = $request->provider_id;
           
            $insertCat = $insertCat->save();
            return $insertCat ? back()->with('message_success','Package  added successfully') : back()->with('message_error','Something went wrong, please try again.');
    }

    public function getPackageID($id){
         $data = ConsumerPackage::with('provider')->find($id);
   
      
        return response()->json($data);
    }

     public function editPackages(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'amount' => 'required',
            
            
        ]);
            $insertCat = ConsumerPackage::find($request->providers_id);
            $insertCat->name = trim($request->name);
            $insertCat->amount = $request->amount;
            
            $insertCat = $insertCat->save();
            return $insertCat ? back()->with('message_success','Package  updated successfully') : back()->with('message_error','Something went wrong, please try again.');
    }

    public function destroy(string $id)
    {
        ConsumerPackage ::where('id',$id)->delete();
        

        return redirect('Packages')->with('message_success','Package deleted successfully!');
    }

public function viewAgentPackage()
    {
        $list = ServiceProvider::all();
        $packages = AgentPackage::all();
        return view('setup.AgentPackage',['list'=>$list,'packages'=>$packages]);
    }

    public function addAgentPackages(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'amount' => 'required',
            
            
        ]);
            $insertCat = new AgentPackage();
            $insertCat->name = trim($request->name);
            $insertCat->amount = $request->amount;
            $insertCat->provider_id = $request->provider_id;
           
            $insertCat = $insertCat->save();
            return $insertCat ? back()->with('message_success','Package  added successfully') : back()->with('message_error','Something went wrong, please try again.');
    }

     public function editAgentPackages(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'amount' => 'required',
            
            
        ]);
            $insertCat = AgentPackage::find($request->providers_id);
            $insertCat->name = trim($request->name);
            $insertCat->amount = $request->amount;
            
            $insertCat = $insertCat->save();
            return $insertCat ? back()->with('message_success','Package  updated successfully') : back()->with('message_error','Something went wrong, please try again.');
    }

     public function getAgentPackageID($id){
         $data = AgentPackage::with('provider')->find($id);
   
      
        return response()->json($data);
    }
  
      public function destroyagent(string $id)
    {
        AgentPackage ::where('id',$id)->delete();
        

        return redirect('AgentPackage')->with('message_success','Package deleted successfully!');
    }

     public function viewAgentPlan(){
        $list = AgentPlan::all();
        return view('setup.AgentPlan',['list'=>$list]);
     }

     public function addAgentPlan(Request $request)
     {
         $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'duration' => 'required',
            
            
        ]);
            $insertCat = new AgentPlan();
            $insertCat->name = trim($request->name);
            $insertCat->amount = $request->amount;
            $insertCat->duration = $request->duration;
            $insertCat->status = $request->status;

             if($request->hasFile('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
            $file->move('uploads/agentplan/',$filename);
            $insertCat->image = 'uploads/agentplan/'.$filename;
          }
           
            $insertCat = $insertCat->save();
            return $insertCat ? back()->with('message_success','Plan  added successfully') : back()->with('message_error','Something went wrong, please try again.');
     }

     public function editAgentPlanView($id){
          $decodeID = Crypt::decrypt($id);
        $list = AgentPlan::orderBy('id','ASC')->get();
        $data = AgentPlan::find($decodeID);

        return view('setup.edit-agentplan',['list'=>$list,'data'=>$data,'id'=>$id]);

     }

     public function editAgentPlan(Request $request,$id){
          $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'duration' => 'required',
            
            
        ]);
         $decodeId = Crypt::decrypt($id);
         $insertCat =  AgentPlan::find($decodeId);
        
         $insertCat->name = trim($request->name);
            $insertCat->amount = $request->amount;
            $insertCat->duration = $request->duration;
            $insertCat->status = $request->status;

             if($request->hasFile('logo')){
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
            $file->move('uploads/agentplan/',$filename);
            $insertCat->image = 'uploads/agentplan/'.$filename;
          }
           
            $insertCat = $insertCat->save();
            return $insertCat ? back()->with('message_success','Plan  updated successfully') : back()->with('message_error','Something went wrong, please try again.');
    }
     
}
